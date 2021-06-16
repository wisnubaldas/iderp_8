<?php

namespace App\Traits;
use App\Models\AcuraMaster\Depo;
use App\Models\AcuraMaster\Regional;
use App\Models\User;
use \Carbon\Carbon;
use Excel;
use App\Imports\TargetLama;
use App\Imports\TargetBaru;
use App\Models\Report\TargetBaru as TB;
use App\Models\Report\TargetLama as TL;
use App\Models\Report\BarangPenjualan;
use App\Models\Report\EvaluasiKerja;
use DataTables;
use PDF;
trait EvaluasiTrait
{
    public function check_role_access($user = null)
    {
        if(!$user)
        {
            $user = auth()->user();
        }
        $role = $user->roles->pluck('name','id');
        $permission = $user->permissions->pluck('name','id');
        return compact('role','permission');
    }
    public function get_all_depo($auth = null)
    {
        if(!$auth)
        {
            return Depo::all();
        }

        if($auth->hasRole('kadep'))
        {
            // dd($auth->permissions->pluck('name'));
            return Depo::whereIn('id_depo',$auth->permissions->pluck('name'))->get();
        }
        if($auth->hasRole('rm'))
        {
            $regional = Regional::whereIn('code',$auth->permissions->pluck('name'))->get();
            return Depo::whereIn('region_id',$regional->pluck('id'))->get();
        }
        if($auth->hasRole(['manager','administrator']))
        {
            return Depo::all();
        }
    }

    public function get_date_target()
    {
        $tl_date = TL::select('tgl')->groupBy('tgl')->get();
        $tb_date = TB::select('tgl')->groupBy('tgl')->get();
        return compact('tl_date','tb_date');
    }
    public function persentase($awal,$pembagi)
    {
        return (integer)$awal/(integer)$pembagi*100;
    }
    public function get_target_lama($bulan,$tahun,$id_depo)
    {
        return TL::select(['qty','profit'])
                    ->whereYear('tgl','=',$tahun)
                    ->whereMonth('tgl','=',$bulan)
                    ->where('depo_id','=',$id_depo)
                    ->first();
    }
    public function get_target_baru($bulan,$tahun,$id_depo)
    {
        return TB::select(['qty','profit'])
                        ->whereYear('tgl','=',$tahun)
                        ->whereMonth('tgl','=',$bulan)
                        ->where('depo_id','=',$id_depo)
                        ->first();
    }
    public function cari_tgl_pendirian($tgl_pendirian)
    {
        $date = Carbon::parse($tgl_pendirian);
        $now = Carbon::now();
        $diff = $date->diff($now);
        return (Object)[
            'tgl'=>$tgl_pendirian,
            'tahun'=>$diff->y,
            'bulan'=>$diff->m
        ];
    }
    public function get_ranking($data)
    {
        $sorted = collect($data)->sortBy('pencapaian.profit');
        $x = $sorted->values()->map(function ($item, $key){
            $item['ranking_profit'] = $key+1;
            return $item;
        })->sortBy('pencapaian.qty');

        $xx = $x->values()->map(function ($item, $key){
            $item['ranking_qty'] = $key+1;
            return $item;
        })->reverse();
        return $xx->values();
    }
    public function evalusai_data($request)
    {
        $result = [];
        $target_lama_bulan = \Carbon\Carbon::parse($request->target_lama);
        $target_baru_bulan = \Carbon\Carbon::parse($request->target_baru);
        $b = $this->tree_month_range($request->bulan);
        // $bulan = \Carbon\Carbon::createFromFormat('m-Y',$request->bulan);
        // $tiga_bulan  = \Carbon\Carbon::createFromFormat('m-Y',$request->bulan)->addMonth(2);
        
        $rata_pencapaianX = BarangPenjualan::select(['id_depo','total_jual','jumlah_kirim'])
                            ->whereBetween('tgl_jual', [$b['bulan_awal'],$b['bulan_ketiga']])->get();

        if($rata_pencapaianX->count() == 0)
        {
            return null;
        }

        $rata_pencapaianX = $rata_pencapaianX->groupBy('id_depo')->transform(function ($item, $key) {
            return (Object) [
                            'profit'=>$item->sum('total_jual'),
                            'qty'=>$item->sum('jumlah_kirim')
                        ];
        });

        foreach (Depo::all() as $depo) {
            $target_baru = $this->get_target_baru($target_baru_bulan->format('m'),$target_baru_bulan->format('Y'),$depo->id);
            $target_lama = $this->get_target_lama($target_lama_bulan->format('m'),$target_lama_bulan->format('Y'),$depo->id);
            // target lama dan baru
            $tgl_pendirian = $this->cari_tgl_pendirian($depo->tgl_pendirian);
            $rata_pencapaian = $rata_pencapaianX[$depo->id_depo];
            $pencapaian = (Object)[
                'qty'=>$this->persentase($rata_pencapaian->qty,$target_lama->qty),
                'profit'=>$this->persentase($rata_pencapaian->profit,$target_lama->profit)
            ];
            $sim_pencapaian = (Object)[
                'qty'=>$this->persentase($rata_pencapaian->qty,$target_baru->qty),
                'profit'=>$this->persentase($rata_pencapaian->profit,$target_baru->profit)
            ];
            $nil_tengah = ($sim_pencapaian->qty+$sim_pencapaian->profit/2);
            $id = $depo->id;
            $nama = $depo->nama_depo;
            $id_depo = $depo->id_depo;
            $tlc = $depo->tree_code;
            array_push($result,
                compact('id','nama','id_depo','tlc','target_baru','target_lama','tgl_pendirian','rata_pencapaian','pencapaian','sim_pencapaian','nil_tengah')
            );
        }
        return $this->get_ranking($result);
    }
    public function post_data($status,$request)
    {
        // menangkap file excel
		$file = $request->file('file');
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_excel',$nama_file);

        switch ($status) {
            case 'target_lama':
                return Excel::import(new TargetLama($request->bulan), public_path('/file_excel/'.$nama_file));
                break;
            case 'target_baru':
                return Excel::import(new TargetBaru($request->bulan), public_path('/file_excel/'.$nama_file));
                break;
            default:
                return dump('mau apa lu...???');
                break;
        }
    }
    // save data evaluasi
    public function save_data_evaluasi($data)
    {
        if(isset($data->depo) && count($data->form) != 0)
        {

            $form = [];
            foreach ($data->form as $v) {
                if($v->value == "")
                {
                    abort(500, 'Data harus lengkap.....');
                }
                if($v->name == 'saran')
                {
                    $form['saran'][] = $v->value;
                }else{
                    $form['penjelasan'] = $v->value;
                }
            }

            $id = auth()->user()->id;

            $dev = EvaluasiKerja::where('user_id', $id)
                                ->where('depo_id',$data->depo->id)
                                ->where('target_lama',$data->param->target_lama)
                                ->where('target_baru',$data->param->target_baru)
                                ->whereMonth('tgl','=',\Carbon\Carbon::createFromFormat('m-Y',$data->param->bulan))
                                ->first();
            if ($dev !== null) {
                $dev->user_id = $id;
                $dev->depo_id = $data->depo->id;
                $dev->data_depo = json_encode($data->depo);
                $dev->data_form = json_encode($form);
                $dev->data_param = json_encode($data->param);
                $dev->target_lama = $data->param->target_lama;
                $dev->target_baru = $data->param->target_baru;
                $dev->tgl = \Carbon\Carbon::createFromFormat('m-Y',$data->param->bulan);
                $dev->save();
                return $dev->id;
            } else {
                $dev = new EvaluasiKerja;
                $dev->user_id = $id;
                $dev->depo_id = $data->depo->id;
                $dev->data_depo = json_encode($data->depo);
                $dev->data_form = json_encode($form);
                $dev->target_lama = $data->param->target_lama;
                $dev->target_baru = $data->param->target_baru;
                $dev->data_param = json_encode($data->param);
                $dev->tgl = \Carbon\Carbon::createFromFormat('m-Y',$data->param->bulan);
                $dev->save();
                return $dev->id;
            }
        }
    }
    // Data tables 
    public function data_grid()
    {
        $ra = $this->check_role_access();
        if(auth()->user()->hasRole(['kadep','rm','manager']))
        {
            $ev = EvaluasiKerja::with('user')->where('user_id',auth()->user()->id);
        }else{
            $ev = EvaluasiKerja::with('user');
        }
        
        return DataTables::of($ev)
        ->addColumn('action', function ($a) {
            $btn = '<div class="btn-group" >';
            // $btn .= '<a id="print-pdf" target="_blank" href="/report/pdf-data-evaluasi/'.$a->tgl.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Print PDF</a>';
            $btn .= '<a target="_blank" href="/report/pdf-data-evaluasi/'.$a->tgl.'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Detail</a>';
            $btn .= '</div>';
            return $btn;
        })
        ->editColumn('data_depo', function($a){
            
            return Depo::find($a->depo_id)->nama_depo;
        })
        ->editColumn('data_form', function($a){
            $user = User::find($a->user_id);
            return $user->name;
        })
        ->make();
    }

    public function print_pdf($tgl)
    {
        $evaluasi = EvaluasiKerja::with(['user'=>function($us){
            return $us->with(['roles','permissions']);
        }])->whereMonth('tgl',\Carbon\Carbon::createFromFormat('m-Y',$tgl))->get();

        $result = $evaluasi->transform(function ($item, $key) {
                            $form = json_decode($item->data_form);
                            $data_depo = json_decode($item->data_depo);
                            $res = [];
                            $res['id'] = $item->id;
                            $res['user_id'] = $item->user_id;
                            $res['user_role'] = $item->user->roles->pluck('name')[0];
                            $res['tgl'] = $item->tgl;
                            $res['target_lama'] = $item->target_lama;
                            $res['target_baru'] = $item->target_baru;
                            $res['depo'] = $data_depo->nama;
                            $res['tgl_pendirian'] = \Carbon\Carbon::parse($data_depo->tgl_pendirian->tgl)->format('d F Y');
                            $res['massa_thn'] = $data_depo->tgl_pendirian->tahun;
                            $res['massa_bln'] = $data_depo->tgl_pendirian->bulan;
                            $res['tl_qty'] = number_format($data_depo->target_lama->qty);
                            $res['tl_profit'] = number_format($data_depo->target_lama->profit,2);
                            $res['rrp_qty'] = number_format($data_depo->rata_pencapaian->qty);
                            $res['rrp_profit'] = number_format($data_depo->rata_pencapaian->profit,2);
                            $res['pp_qty'] = number_format($data_depo->pencapaian->qty,2);
                            $res['pp_qty_r'] = number_format($data_depo->ranking_qty);
                            $res['pp_profit'] = number_format($data_depo->pencapaian->profit,2);
                            $res['pp_profit_r'] = number_format($data_depo->ranking_profit);
                            $res['tb_qty'] = number_format($data_depo->target_baru->qty,2);
                            $res['tb_profit'] = number_format($data_depo->target_baru->profit,2);
                            $res['sp_qty'] = number_format($data_depo->sim_pencapaian->qty,2);
                            $res['sp_profit'] = number_format($data_depo->sim_pencapaian->profit,2);
                            $res['nt'] = number_format($data_depo->nil_tengah,2);
                            $res['saran'] = $form->saran;
                            $res['penjelasan'] = $form->penjelasan;
                            return $res;
                            })->groupBy(['target_lama', function ($item) {
                                return $item['target_baru'];
                            },'depo'], $preserveKeys = true);
        // mapping data 
        $result = $this->mapping_data($result);
        // return view('backend.report.pdf-evaluasi', compact('result'));
        $pdf = PDF::loadView('backend.report.pdf-evaluasi', compact('result'));
        return $pdf
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-bottom', 5)
                    ->setOption('margin-top', 5)
                    ->setOption('margin-right', 5)
                    ->setOption('margin-left', 5)
                    ->download($tgl.'.pdf');
    }
    public function mapping_data($data)
    {
        $packagex = [];
        foreach ($data as $key => $set_one) {
            foreach ($set_one->values() as $key => $set_two) {
                $package = [];
                foreach ($set_two as $depo => $datax) {
                    $b = $this->tree_month_range(\Carbon\Carbon::parse($datax->values()[0]['tgl'])->format('m-Y'));
                    $package[$depo]['title'] = 'Berdasarkan data '.$b['bulan_awal']->format('F').' s/d '.$b['bulan_ketiga']->addMonth(2)->format('F Y').
                    ' dan Target Qty dan Profit Baru berlaku '.\Carbon\Carbon::parse($datax->values()[0]['target_baru'])->format('d F Y');
                    $package[$depo]['depo'] = $depo;
                    $dta = $datax->values()[0];
                    unset($dta['saran']);
                    unset($dta['penjelasan']);
                    $package[$depo]['data'] = $dta;
                    foreach ($datax as $review) {
                        $package[$depo]['review'][$review['user_role']] = [
                            'saran'=>$review['saran'],
                            'penjelasan'=>$review['penjelasan']
                        ];
                    }
                }
                array_push($packagex,$package);
            }
        } // end loop
        return $packagex;
    }
    public function tree_month_range($bulan)
    {
        $bulan_awal = \Carbon\Carbon::createFromFormat('m-Y',$bulan);
        $bulan_ketiga  = \Carbon\Carbon::createFromFormat('m-Y',$bulan)->addMonth(2);
        return compact('bulan_awal','bulan_ketiga');
    }
}
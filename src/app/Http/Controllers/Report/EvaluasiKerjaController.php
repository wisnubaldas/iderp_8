<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\EvaluasiTrait;
class EvaluasiKerjaController extends Controller
{
    use EvaluasiTrait;
    public function index(Request $request)
    {
        $data = $title = $depo = $param = null;
        if($request->method() == 'POST')    
        {
            $request->validate([
                'bulan' => 'required',
                'target_lama' => 'required',
                'target_baru' => 'required',
            ]);

            $bulan = \Carbon\Carbon::createFromFormat('m-Y',$request->bulan)->locale('id_ID');
            $title = 'Berdasarkan data '.$bulan->format('F').' s/d '.$bulan->addMonth(2)->format('F Y').
                     ' dan Target Qty dan Profit Baru berlaku '.\Carbon\Carbon::parse($request->target_baru)->format('d F Y');
            $data = $this->evalusai_data($request);
            if($data)
            {
                $param = $request->all();
                unset($param['_token']);

                // get data depo by auth
                $depo = $this->get_all_depo(auth()->user());
                // dd($depo);
                $depo = $depo->pluck('nama_depo','id_depo');
            }else{
                return back()->withErrors(['Data tidak di temukan']); 
            }
        }
        $date_target = $this->get_date_target();
       
        return view('backend.report.evaluasi-kinerja',compact('data','title','date_target','depo','param'));
    }
    public function get_evaluasi(Request $request)
    {
        $msg = $this->evalusai_data($request);
        $depo = $this->get_all_depo();
        return view('backend.report.evaluasi-kinerja',compact('msg','depo'));
    }
    public function upload_data($status = null, Request $request)
    {
        if($request->ajax())
        {
            return $this->data_grid();
        }

        if ($status) {
            // validasi
            $request->validate([
                'file' => 'file|mimes:xls,xlsx',
                'bulan'=>'required',
            ]);
            $this->post_data($status,$request);
            return back();
        }

        $depo = $this->get_all_depo();
        return view('backend.report.upload-data-evaluasi',compact('depo'));
    }
    public function post_data_evaluasi(Request $request)
    {
        $data = json_decode($request->evaluasi);
        return $this->save_data_evaluasi($data);
    }
    public function pdf_evaluasi(Request $request)
    {
        return $this->print_pdf($request->bulan);
    }
}

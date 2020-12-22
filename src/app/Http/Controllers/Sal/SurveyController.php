<?php

namespace App\Http\Controllers\Sal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Str;
// model
use App\Models\Report\Ranking;
use App\Models\Report\Brand;
use App\Models\Report\DepoToko;
use App\Models\Report\Depo;
use App\Models\Report\Regional;
use App\Models\Blog\Ukuran;
use App\Models\Marketing\NotifSurvey;
use App\Models\Marketing\Motif;
use App\Models\Marketing\DepoSurvey;
use App\Models\Marketing\ImageSurvey;
use App\Http\Requests\StoreSurvey;
use App\DataTables\SurveyNotifDataTable;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\URL;
use DB;
use PDF;
use SnappyImage;
use Image;
use App\Helpers\Survey as SurveyHelper;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifSurvey as MailNotifSurvey;
use View;
use App\Imports\CustomersExcel;
use Maatwebsite\Excel\Facades\Excel;

class SurveyController extends Controller
{
    protected $role;
    public function __construct()
    {
        $this->middleware('auth');   
    }
    public function index()
    {
        $brand = Brand::all();
        $depo = Regional::with('depo_regional')->orderBy('urut_reg')->get();
        $ukuran = Ukuran::all();
       return view('backend._report.survey',compact('depo','ukuran','brand'));
    }
    public function submitSurvey(StoreSurvey $r)
    {
        $random = Str::upper(Str::random(5));
        $number = 'CJFI'.$random.'-'.strtotime('now');
        $s = new NotifSurvey;
        $s->survey_no = $number;
        $s->tgl = Carbon::create($r->tgl);
        $s->brand = $r->brand;
        $s->depo = $r->depo;
        $s->motif = $r->motif;
        $s->ukuran_id = $r->ukuran;
        $s->customer = $r->customer;
        $s->warna = $r->warna;
        $s->p_harga = $r->harga;
        $s->kode_barang = $r->kode_barang;
        $s->status_id = 1;
        $s->save();
        $motif = new Motif;
        $motif->nama = $r->motif;
        $motif->save();
        // return $r->validated();
        return back();
    }
    public function grid_status(SurveyNotifDataTable $datatables)
    {
        return view('backend._report.grid_status');
    }
    public function get_status()
    {
        $sr = NotifSurvey::with(['depo_detail','status','ukuran'])->orderBy('updated_at','desc');
        return DataTables::of($sr)
        ->addColumn('status',function($sr){
            switch ($sr->status->id) {
                case 1:
                    return '<button class="btn btn-danger btn-xs">'.$sr->status->status.'</button>';
                    break;
                case 2:
                    return '<button class="btn btn-warning btn-xs">'.$sr->status->status.'</button>';
                    break;
                case 4:
                    return '<button class="btn btn-primary btn-xs">'.$sr->status->status.'</button>';
                    break;
                case 5:
                    return '<button class="btn btn-danger btn-xs">'.$sr->status->status.'</button>';
                    break;
                case 8:
                        return '<button class="btn btn-info btn-xs">'.$sr->status->status.'</button>';
                        break;
                default:
                return '<button class="btn btn-success btn-xs">'.$sr->status->status.'</button>';
                    break;
            }
               
        })
        ->addColumn('action', function ($sr) {
            // dd($sr->status->id);
            $appr = Str::random(40);
            $rej = Str::random(50);
            $one = "<li class=\"\"><a class=\"dropdown-item \" href=\"/report/survey/review_depo/{$sr->id}\">Review</a></li>";
            $two = "<li class=\"\"><a class=\"dropdown-item \" href=\"/report/survey/review_depo/{$sr->id}\">Review</a></li>";
            $tree = "<li class=\"\"><a class=\"dropdown-item\" href=\"/report/survey/print_survey/{$sr->id}\">Print Survey</a></li>";
            $five = "<li class=\"\"><a class=\"dropdown-item\" href=\"#\">#</a></li>";
            switch ($sr->status->id) {
                case 3:
                    $action = $one;
                    break;
                case 2:
                    $action = $two;
                    break;
                case 5:
                    $action = $one; 
                    break;
                case 1:
                    $action = $five;
                    break;
                default:
                    $action = $tree;
                    break;
            }

            return "<div class=\"btn-group\">
                        <button data-toggle=\"dropdown\" class=\"btn btn-primary btn-xs dropdown-toggle\" aria-expanded=\"false\">
                                Action 
                        </button>
                        <ul class=\"dropdown-menu\" x-placement=\"bottom-start\">
                            {$action}
                        </ul>
                    </div>";
        })
        ->rawColumns(['action','status'])
        ->make();   
    }
    public function getDepo(Request $r)
    {
        return DepoToko::select(['id_toko','nama_toko'])->where('id_depo',$r->id)->get();
    }
    public function getCustomer(Request $r)
    {
        // dd($r->toArray());
        // $toko = DepoToko::select(['id_toko','nama_toko'])->where('id_depo',$r->depo)->whereIn('id_toko',$r->id);
        $toko = $this->customers($r->id,$r->depo);
        return DataTables::of($toko)->make();
    }
    public function depo_survey(Request $r)
    {
        $this->role = Auth::user()->getRoleNames()->toArray();
        if (request()->ajax()) { 
            if($r->segment(4) == 'proses_survey')
            {
                $data = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey']);
                
                if(!in_array('super-admin',$this->role))
                {
                    $data->where('depo',Auth::user()->depo_id);
                }
                $data->whereIn('status_id',[1,5,4,2,8,7,6])->orderBy('updated_at','desc');
                return DataTables::of($data)
                        ->addColumn('action', function ($sr) {
                            $one = "<div class=\"btn-group\">
                                        <button data-toggle=\"dropdown\" class=\"btn btn-primary btn-xs dropdown-toggle\" aria-expanded=\"false\">
                                                Action 
                                        </button>
                                        <ul class=\"dropdown-menu\" x-placement=\"bottom-start\">
                                            <li><a class=\"dropdown-item\" href=\"/report/survey/proses_depo_survey/{$sr->id}\">Proses</a></li>
                                            <li><a class=\"dropdown-item\" href=\"/report/survey/depo_survey?print_form={$sr->id}\" target=\"_blank\">Print Form Survey</a></li>
                                            <li><a class=\"dropdown-item\" href=\"/report/survey/post_depo_survey/{$sr->id}\">Kirim Survey</a></li>
                                        </ul>
                                    </div>";
                            $two = "<div class=\"btn-group\">
                                        <button data-toggle=\"dropdown\" class=\"btn btn-primary btn-xs dropdown-toggle\" aria-expanded=\"false\">
                                                Action 
                                        </button>
                                        <ul class=\"dropdown-menu\" x-placement=\"bottom-start\">
                                            <li><a class=\"dropdown-item\" href=\"/report/survey/proses_depo_survey/{$sr->id}\">Review Kembali</a></li>
                                        </ul>
                                    </div>";
                            $finish = '<span class="text-success font-bold fa-2x fa fa-check no-paddings no-margins"></span>';
                            $blank = '<span class="text-warning font-bold fa-2x fa fa-warning no-paddings no-margins"></span>';
                            switch ($sr->status->id) {
                                case 5:
                                    return $two;
                                    break;
                                case 4:
                                    return $blank;
                                    break;
                                case 8:
                                    return $blank;
                                    break;
                                case 8:
                                    return $blank;
                                    break;
                                case 7:
                                    return $finish;
                                    break;
                                default:
                                    return $one;
                                    break;
                            }
                            
                        })
                        ->addColumn('status',function($sr){
                            return "<span class=\"navy stroke-navy font-bold\">{$sr->status->status}</span>";
                        })
                        ->rawColumns(['action','status'])
                        ->make(); 
            }
        }
        if($r->print_form)
        {
            $m = NotifSurvey::with(['depo_survey'])->find($r->print_form);
            // return view('backend._report.pdf_form_survey', compact('m'));
            if($m->status_id != 2){
                return back()->withErrors(['Form tidak dapat di cetak sebelum di proses....!!!!',500]);
            }
            $pdf = PDF::loadView('backend._report.pdf_form_survey',compact('m'))
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-bottom', 0);
            return $pdf->download('form_survey.pdf');
        }
        return view('backend._report.depo_survey');
    }
    public function proses_depo_survey($id)
    {
        $data = NotifSurvey::with(['depo_detail','status','ukuran'])->find($id);
        if(!in_array($data->status_id,[1,5]))
        {
            return back()->withErrors(['Survey sedang dalam proses di lapangan...!!!',500]);
        }
        $customer = $this->customers($data->customer,$data->depo);
        return view('backend._report.depo_proses',compact('data','customer'));
    }
    public function save_proses_depo_survey(Request $r)
    {
        $data = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey'])
                ->where('survey_no',$r->survey_no)->first();
        $data->harga = $r->form_respon[0]['harga_depo'];
        $data->save();
        $depo_survey = new DepoSurvey;
        $depo_survey->s_start = Carbon::now();
        $depo_survey->status_id = 2;
        $depo_survey->customer = $r->toArray();
        $depo_survey->notif_id = $data->id;
        $depo_survey->save();
        $data->status_id = 2;
        $data->save();
    }
    public function post_depo_survey($id)
    {
        $ds = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey','image'])
                          ->find($id);
        if($ds->status_id == 1)
        {
            return back()->withErrors(['Survey tidak bisa di kembalikan sebelum melakukan survey....!!!',500]);
        }

        return view('backend._report.post_depo_survey',compact('ds'));
    }
    public function update_data_survey(Request $r){
        $s = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey','image'])
                          ->where('survey_no',$r->survey_no)
                          ->first();
        // dump($r->all());
        // dd($s);

        // $customer_survey = [];
        $s->depo_survey->s_end = Carbon::now();
        $s->status_id = 3;
        foreach ($r->all() as $k => $v) {
            if($k == 'vot')
            {
                $s->depo_survey->vote = $v;
            }
            if($k == 'order')
            {
                $s->depo_survey->order = $v;
            }
                if($k == 'imageNya')
            {    
                $cek = ImageSurvey::where('notif_id',$s->id)->delete();
                    foreach ($r->imageNya as $img) {
                        $save_image = new ImageSurvey;
                        $save_image->notif_id = $s->id;
                        $save_image->image_name = Str::random(8).'.jpg';
                        $save_image->image = $img;
                        $save_image->save();
                    }   
            }
            
        }
        $s->depo_survey->status_id = 3;
        $s->depo_survey->save();
        $s->save();
        // dd($s->survey_no);
        
        return redirect()->route('report.deposurvey');      
    }
    public function review_depo($id,$siapa = null,Request $r)
    {

        $data = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey','image'])->find($id);
        if(in_array($data->status_id,[2]))
        {
            return back()->withErrors(['Survey belom dapat direview....!!!',500]);
        }
        $vote = json_decode($data->depo_survey->vote, true);
        $order = json_decode($data->depo_survey->order, true);
        // dd($data->depo_survey->customer['form_respon']);
        // dump($data->depo_survey->customer);
        $customer = $data->depo_survey->customer;
        foreach ($data->depo_survey->customer['form_respon'] as $k => $v) {
            $customer['survey'][$k] = [
                'id_form'=>$v['form_id'],
                'nama_sales'=>$v['sales']
            ];
            foreach ($v['customer'] as $i => $val) {
                $id = SurveyHelper::toko($val['id'])->id;
                $nama = SurveyHelper::toko($val['id'])->nama;
                $customer['survey'][$k]['hasil'][] = [
                    'id'=>$id,
                    'nama'=>$nama,
                    'voting'=>SurveyHelper::status_vote($vote[$id]),
                    'order'=>$order[$id]
                ];
            }
        }
       
        if ($r->hasValidSignature()) {
            $apprf_data = ['siapa'=>$siapa];
            $res = compact('data','apprf_data','customer');
        }else{
            $res = compact('data','customer');
        }
        return view('backend._report.review_depo',$res);
    }
    public function reject_survey($id) // approve kadep rm lewat wa
    {
        $dNotif = NotifSurvey::where('survey_no',$id)->with(['depo_survey','depo_detail','status','ukuran'])->first();
        $user_id = Auth::user()->hasAnyPermission(['staff']);
        if($user_id)
        {
            $dNotif->status_id = 5;
            $dNotif->save();
            $dNotif->depo_survey->status_id = 5;
            $dNotif->depo_survey->save();
            return back()->with('success', 'Data survey tidak di setujui...');  
        }
        return back()->withErrors(['Anda tidak mempunyai hak akses...!!!']);
        
    }
    public function approve_kadep($id,$user)
    {
        $user_id = User::find($user)->permissions;
        foreach ($user_id as $key => $value) {
            if($value->name == 'kadep'){
                $data = NotifSurvey::with(['depo_survey'])->find($id);
                $data->depo_survey->status_id = 6;
                $data->depo_survey->save();
                $data->status_id = 6;
                $data->save();
                return redirect()->route('report.deposurvey');
            }
            if($value->name == 'rm')
            {
                $data = NotifSurvey::with(['depo_survey'])->find($id);
                $data->depo_survey->status_id = 7;
                $data->depo_survey->save();
                $data->status_id = 7;
                $data->save();
                return redirect()->route('report.deposurvey');

            }
        }
        return redirect()->route('report.deposurvey')->withErrors(['Anda tidak mempunyai hak akses...!!!']);
    }
    protected function sendWhatsappNotification(string $otp, string $recipient,$id,$url)
    {
        $twilio_whatsapp_number = env("TWILIO_WHATSAPP_NUMBER",'+14155238886');
        $account_sid = env('TWILIO_ACCOUNT_SID','ACb74608de570c3a5851286dce8970a418');
        $auth_token = env("TWILIO_AUTH_TOKEN",'65ca10485a2e0c9bec3ad7674d3ff422');
        $client = new Client($account_sid, $auth_token);
        $message = $otp;
        return $client->messages->create("whatsapp:$recipient", 
                        array(
                        'from' => "whatsapp:$twilio_whatsapp_number", 
                        'body' => "No Survey: ".$otp."  Approve link:".$url,
                        'mediaUrl' => "https://bradnailer24h.com/wp-content/uploads/2019/06/types-of-tile-flooring.jpg",
                        'statusCallback'=>$url
                        )
                    );
    }

    public function print_survey($id)
    {
        $m = NotifSurvey::with(['depo_survey'])->find($id);
            // return view('backend._report.pdf_print_survey', compact('m'));
            if(!in_array($m->status_id,[8,7,6])){
                return back()->withErrors(['Form tidak dapat di cetak sebelum di proses....!!!!',500]);
            }
            $pdf = PDF::loadView('backend._report.pdf_print_survey',compact('m'))
                    ->setPaper('a4')
                    ->setOrientation('landscape')
                    ->setOption('margin-bottom', 0);
            return $pdf->download('Summary_'.$m->survey_no.'.pdf');
    }
    public function approve_survey($id,Request $r) //
    {
        // approve survey
        $dNotif = NotifSurvey::where('survey_no',$id)->with(['depo_survey','depo_detail','status','ukuran'])->first();
        $user_id = Auth::user()->hasAnyPermission(['staff']);

        if($user_id)
        {
            $dNotif->status_id = 8;
            $dNotif->save();
            $dNotif->depo_survey->status_id = 8;
            $dNotif->depo_survey->save();
            //  $messeage = View::make('backend._report.mail_notif',['data'=>$dNotif]);
            // $img = Image::make($messeage)->resize(300, 200);
            // return $img->response('dasdasd.jpg');

            // $img = pdf::make('backend._report.mail_notif',['data'=>$dNotif]);
            // $img->download('invoice.png');

            // $messeage = View::make('backend._report.mail_notif',['data'=>$dNotif]);
            // SurveyHelper::send_wa($messeage);
            // return view('backend._report.mail_notif',['data'=>$dNotif]);
            // Mail::to('wisnubaldas@gmail.com')->send(new MailNotifSurvey($dNotif));
            return back()->with('success', 'Data survey delah di setujui...');  
        }
        // return back()->withErrors(['Anda tidak mempunyai hak akses...!!!']);
        

        // if(Str::length($r->id) == 40)
        // {
        //     $data['status'] = 'a';
        //     $data['title'] = 'Form Approve';
        //     $data['survey'] = $dNotif;
        //     if ($r->isMethod('post')) {
        //         $dNotif->kode_barang = $r->kode_barang;
        //         $dNotif->p_harga = $r->p_harga;
        //         $dNotif->status_id = 8;
        //         $dNotif->save();
        //         $dNotif->depo_survey->status_id = 8;
        //         $dNotif->depo_survey->save();
        //         $phone = [
        //                     [
        //                         'name'=>'SUBEKTI',
        //                         'posisi'=>'KADEP',
        //                         'phone'=>'+6282120650078'
        //                     ],
        //                     [
        //                         'name'=>'SUTISNA',
        //                         'posisi'=>'RM',
        //                         'phone'=>'+6281316185608'
        //                     ]
        //                 ];
                            
        //         foreach ($phone as $key => $value) {
        //             $url =  URL::temporarySignedRoute(
        //                 'sign_review', now()->addMinutes(5), ['id'=>$id,'user'=>1,'siapa'=>$value['posisi']]
        //             );
        //             $s = $this->sendWhatsappNotification($dNotif->survey_no,$value['phone'],$id,$url);
        //             dd($url);

        //         }
        //         return back();
        //     }
        // }
        // if(Str::length($r->id) == 50)
        // {
        //     $data['status'] = 'r';
        //     $data['title'] = 'Form Reject: ';
        //     $data['survey'] = $dNotif;
        //     if ($r->isMethod('post')) {
        //         $dNotif->depo_survey->note = $r->note;
        //         $dNotif->depo_survey->status_id = 5;
        //         $dNotif->depo_survey->save();
        //         $dNotif->status_id = 5;
        //         $dNotif->save();
        //         return back();
        //     }
        // }
        // return view('backend._report.approve_reject',compact('data'));
    }
    public function upload_data_customer(Request $r)
    {
        if ($r->hasFile('image')) {
            return (new CustomersExcel)->toCollection($r->file('image'));
        }
    }
    public function depo_review_reject($id)
    {
        // $data = NotifSurvey::with(['depo_detail','status','ukuran','depo_survey'])->find($id);
        // return $data;
        // return view('backend._report.survey_reject',compact('data'));
        return redirect()->route('report.survey.proses',$id);
    }
    protected function customers($data,$depo)
    {
        return DepoToko::select(['id_toko','nama_toko'])
                            ->whereIn('id_toko',$data)
                            ->where('id_depo',$depo)->get();
    }

}
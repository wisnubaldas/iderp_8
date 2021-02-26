<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MenuModule;
use DB;
use PDF;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return DB::connection('cost')->select('select * from alumina');
        // return phpinfo();
        // session()->forget('user.modul');
        // $breadcrumb = self::breadcrumb();
        // return view('home',compact('breadcrumb'));
        return view('backend.index');
    }
    protected static function breadcrumb()
    {
        return [
            'title'=>'Module '.config('app.name'),
            'breadcrumb'=>['home','module'],
            'action'=>['link'=>'#','title'=>'Get Module']
        ];
    }
    public function tes()
    {
        return view('tes_pdf');
        $pdf = PDF::loadView('tes_pdf')
                ->setPaper('a4')
                // ->setOption('viewport-size', '1366x1024')
                // ->setOrientation('landscape')
                // ->setOption('load-error-handling',true)
                // ->setOption('window-status',200)
                // ->setOption('debug-javascript',true)
                ->setOption('margin-bottom', 0);
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 4000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->inline();
    }
}

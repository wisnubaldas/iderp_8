<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MenuModule;
use DB;
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
        session()->forget('user.modul');
        $breadcrumb = self::breadcrumb();
        return view('home',compact('breadcrumb'));
    }
    protected static function breadcrumb()
    {
        return [
            'title'=>'Module '.config('app.name'),
            'breadcrumb'=>['home','module'],
            'action'=>['link'=>'#','title'=>'Get Module']
        ];
    }
}

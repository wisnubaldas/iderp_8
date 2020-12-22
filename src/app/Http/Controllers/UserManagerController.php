<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MenuModule;
use DB;
class UserManagerController extends Controller
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
        
        // session()->forget('user.modul');
        $breadcrumb = self::breadcrumb();
        return view('user-manager',compact('breadcrumb'));
    }
    protected static function breadcrumb()
    {
        return [
            'title'=>'Module '.config('app.name'),
            'breadcrumb'=>['home','module','system','User Manager'],
            'action'=>['link'=>'#','title'=>'User Manager']
        ];
    }
}

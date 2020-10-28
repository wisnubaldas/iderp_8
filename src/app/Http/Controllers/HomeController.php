<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\MenuModule;
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
        $breadcrumb = self::breadcrumb();
        return view('home',compact('breadcrumb'));
    }
    protected static function breadcrumb()
    {
        return [
            'title'=>'Module IDERP',
            'breadcrumb'=>['home','module'],
            'action'=>['link'=>'#','title'=>'Get Module']
        ];
    }
}

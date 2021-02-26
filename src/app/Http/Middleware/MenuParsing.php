<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\MenuModule;
use App\Models\Admin\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
class MenuParsing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = User::with('modules')->find(Auth::user()->id);
        // $master = [
        //     'menu'=>[],
        //     'modul'=>$user->modules,
        //     'animate'=>self::animate(['fadeInRightBig','fadeInLeftBig','fadeInDownBig','fadeInUpBig'])
        // ];
        // if ($request->is('dashboard/*')) {
        //     $modul = Crypt::decryptString($request->segment(2));
        //     $request->session()->put('user.modul',$modul);
        //     $menu = MenuModule::with('menus')->where('name',$modul)->first();
        //     if($menu->menus->count() !== 0)
        //     {
        //         $master['menu'] = self::buildTreeFromObjects($menu->menus);
        //     }
        //     view()->share('master',$master);
        //     return $next($request);
        // }else{
        //     $modul = $request->session()->get('user.modul');
        //     if($modul)
        //     {
        //         $menu = MenuModule::with('menus')->where('name',$modul)->first();
        //         $master['menu'] = self::buildTreeFromObjects($menu->menus);
        //         view()->share('master',$master);
        //         return $next($request);
        //     }
            return $next($request);
        // }
        
    }
    private static function animate($animate)
    {
        $rand_keys = array_rand($animate, 2);
        return $animate[$rand_keys[0]];
    }
    private static function buildTreeFromObjects($items) {

        $childs = [];
    
        foreach ($items as $item)
            $childs[$item->parent_id][] = $item;
    
        foreach ($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];
    
        return $childs[0];
    }
}

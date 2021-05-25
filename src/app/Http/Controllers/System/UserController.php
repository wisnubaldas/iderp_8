<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AcuraMaster\Depo;
use DataTables;
class UserController extends Controller
{
    protected function user_grid()
    {
        $users = User::select(['id','name','email','updated_at','depo_id','active']);
        return Datatables::of($users)
        ->addColumn('action', function ($user) {
            $button = '<div class="btn-group">';
            $button .= '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $button .= '<a href="#delete-'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            $button .= '</div>';
            return $button;
        })
        ->editColumn('m_depo_id',function($user){
                $depo = Depo::find($user->m_depo_id);
                if($depo){
                    return $depo->nama_depo;
                }
                return 'Tidak ada depo';
        })
        ->editColumn('active', function($user){
                if($user->active == 1)
                {
                    $cek = 'checked';
                }else{
                    $cek = '';
                }
                return '<div class="switch">
                <div class="onoffswitch">
                    <input type="checkbox" '.$cek.' class="onoffswitch-checkbox" data-user="'.$user->id.'" id="edit-'.$user->id.'" data-active="'.$user->active.'" onchange="handleChange(this);">
                    <label class="onoffswitch-label" for="edit-'.$user->id.'">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>';
        })
        ->rawColumns(['active','action'])
        ->make();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($grid = null)
    {
        if($grid)
        {
            return $this->user_grid();
        }
        return view('backend.system.user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function add_user()
    {
        return view('backend.system.user_add');
    }
    public function set_active(Request $request)
    {
        $user = User::find($request->id);
        if($user->active == 0){
            $user->active = 1;
        }else{
            $user->active = 0;
        }
        $user->save();
    }
}

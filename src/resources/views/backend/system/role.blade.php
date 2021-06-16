@extends('backend.index')
@section('content')
<div class="container wrapper wrapper-content animated fadeInRight">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Add<small> Roles acces user</small></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-6 b-r">
                    <form role="form" action="{{url('/system/roles-acces')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Create Role</label> 
                            <input type="text"  class="form-control" name="role">
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                <strong>Save</strong>
                            </button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <ul class="list-inline">
                        @foreach ($role_permission as $item)
                            <li class="list-inline-item">
                                {{$item->name}}
                                <ul>
                                    @foreach ($item->permissions as $per)
                                        <li>{{$per->name}}</li>
                                    @endforeach
                                </ul>
                                
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled">
                        @foreach ($role as $idx => $item)
                            <li>
                                <div class="btn-group btn-group-sm p-xxs">
                                    <a class="btn btn-primary text-uppercase" href="javascript:;">{{$item}}</a>
                                    <a class="btn btn-outline-danger" href="/system/roles-acces/delete-roles-ksasd-asdasd-asdasd-asd/{{$idx}}">Delete</a>
                                    <div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Give Permission To
                                        </button>
                                        <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach ($permission as $perId => $perItem)
                                                <a class="dropdown-item" href="{{url('/system/async/'.$idx.'/role/'.$perId)}}">{{$perItem}}</a>
                                            @endforeach
                                        </div>
                                      </div>
                                      <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Revoke Permission To
                                        </button>
                                        <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton2">
                                            @foreach ($permission as $perId => $perItem)
                                                <a class="dropdown-item" href="{{url('/system/async/'.$idx.'/revoke_role/'.$perId)}}">{{$perItem}}</a>
                                            @endforeach
                                        </div>
                                      </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('css')
    <style>
        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }
    </style>
@endpush

@push('script')
    <script>
        function handleChange(a)
        {
            $.ajax({
                        method: "POST",
                        url: '/system/set_active',
                        data:{
                            id:a.dataset.user,
                            active:a.dataset.active
                        }
                        }).done(function( msg ) {
                        //    console.log(msg)
                            table.ajax.reload();
                    }).fail(function(a){
                            console.log(a)
                    });
        }
        
    </script>
@endpush
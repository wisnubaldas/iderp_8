@extends('backend.index')
@section('content')
<div class="container wrapper wrapper-content animated fadeInRight">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Add<small> Permission user</small></h5>
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
                    <form role="form" action="{{url('/system/permission-user')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Create Permission</label> 
                            <input type="text"  class="form-control" name="permission">
                        </div>
                        <div>
                            <button class="btn btn-sm btn-success float-right m-t-n-xs" type="submit">
                                <strong>Save</strong>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <ul>
                        @foreach ($per as $idx => $item)
                            <li>
                                {{$item}} <a href="/system/roles-acces/delete-permission-ksasd-asdasd-asdasd-asd/{{$idx}}">Delete</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
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
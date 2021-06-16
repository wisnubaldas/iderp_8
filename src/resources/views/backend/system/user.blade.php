@extends('backend.index')
@section('content')
<div class="container">
    <a href="{{url('/system/add_user')}}" class="btn btn-primary">Add User</a>
    <x-form.data-table :thead="['id','name','email','updated_at','active','action']" link="{{url('/system/user_manager/grid')}}">
    </x-form.data-table>
</div>
    
@endsection
@push('script')
    <script>
        function handleChange(a)
        {
            // console.log('active ?',a.dataset.active,'user?',a.dataset.user)
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
            // console.log(table)
        }
        //  jQuery(function(a){
        //     let x = $('.onoffswitch-checkbox')
        //     console.log(x)
        //  })
    </script>
@endpush
@push('css')
    <style>
        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }
    </style>
@endpush
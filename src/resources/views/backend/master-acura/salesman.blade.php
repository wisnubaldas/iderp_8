@extends('backend.index')
@section('content')
<div class="container">
        <div class="ibox">
            <div class="ibox-title">
                <a href="#" class="btn btn-primary" id="create-sales">Create Salesman</a>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="fullscreen-link">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="scroll_content">
                    <x-form.data-table :thead=$salesman link="{{url('acura-master/salesman/grid')}}">
                        <x-slot name="cols">
                            <colgroup>
                                <col width="10px" class="text-center">
                                <col>
                                <col>
                                <col>
                                <col width="10px">
                                <col width="50px">
                            </colgroup>
                        </x-slot>
                    </x-form.data-table>
                </div>
                <form action="{{url('acura-master/salesman/save')}}" method="POST">
                    @csrf
                    <div id="edit-form"></div>
                </form>
                
                <div id="create-form">
                    <form action="{{url('acura-master/salesman/save')}}" method="POST">
                        @csrf
                        <x-form.modal :formInput=$form_input id="modal-lama" title="Salesman"/>
                    </form>
                    
                </div>
            </div>
        </div>
</div>
    
@endsection
@push('script')
    <script>
        function handleChange(a)
        {
            // console.log('active ?',a.dataset.active,'user?',a.dataset.user)
            $.ajax({
                        method: "POST",
                        url: '/acura-master/salesman',
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

        function getEdit(a)
            {
                let x = a.attributes['data-link'].value
                $.ajax({
                        method: "GET",
                        url: x,
                        }).done(function( msg ) {
                            $('#edit-form').html(msg)
                            $('#modal-baru').modal({
                                backdrop:'static'
                            });
                    }).fail(function(a){
                            return a;
                    });
            }
        jQuery(function(a){

        })

        $(document).ready(function () {
            $('#create-sales').on('click',function(a){
                $('#modal-lama').modal({
                    backdrop:'static'
                });
            })

            // Add slimscroll to element
            $('.scroll_content').slimscroll({
                height: '600px'
            })

            // hidden kolom datatables sesuai custom templatenya
            var column = table.column(4);
            column.visible( ! column.visible() );
        });
    </script>
@endpush

@push('script')
    <!-- Data picker -->
   <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
@endpush
@push('css')
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endpush
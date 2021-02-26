@extends('backend.index')
@section('content')
<div class="container">
        <div class="ibox">
            <div class="ibox-title">
                <a href="#" class="btn btn-primary" id="create-sales">Create Supplier</a>
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
                    <x-form.data-table :thead=$salesman link="{{url('acura-master/customer/grid')}}">
                        <x-slot name="cols">
                            
                        </x-slot>
                    </x-form.data-table>
                </div>
                <form action="{{url('acura-master/customer/save')}}" method="POST">
                    @csrf
                    <div id="edit-form"></div>
                </form>
                
                <div id="create-form">
                    <form action="{{url('acura-master/customer/save')}}" method="POST">
                        @csrf
                        <x-form.modal :formInput=$form_input id="modal-lama" title="Customer"/>
                    </form>
                    
                </div>
            </div>
        </div>
</div>
    
@endsection
@push('script')
    <script>
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
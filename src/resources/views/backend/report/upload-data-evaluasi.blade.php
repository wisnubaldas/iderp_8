@extends('backend.index')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger container">
        <div class="row">
            <div class="col-md-3">
                <i class="fa fa-exclamation-triangle fa-4x" aria-hidden="true"></i>
            </div>
            <div class="col-md-9">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title bg-warning">
                        <h5>Upload Data Target Lama</h5>
                        <a href="/file_sample/target_lama.xlsx" class="btn btn-info btn-sm float-right">Sample File Excel Data Target Lama</a>
                    </div>
                    <div class="ibox-content no-margins">
                        <form role="form" action="/report/evaluasi-kinerja-dan-solusi-perbaikan/upload_data/target_lama" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Data Bulan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control" name="bulan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input id="logo" type="file" class="custom-file-input" name="file" required>
                                                <label for="logo" class="custom-file-label">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <button class="btn btn-warning btn-block" type="submit">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="ibox ">
                    <div class="ibox-title bg-primary">
                        <h5>Upload Data Target Baru</h5>
                        <a href="/file_sample/target_baru.xlsx" class="btn btn-info btn-sm float-right">Sample File Excel Data Rata2 Pencapaian</a>
                    </div>
                    <div class="ibox-content no-margins">
                        <form role="form" action="/report/evaluasi-kinerja-dan-solusi-perbaikan/upload_data/target_baru" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Data Bulan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control" name="bulan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">File</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input id="logo" type="file" class="custom-file-input" name="file">
                                                <label for="logo" class="custom-file-label">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="box">
                    <div class="ibox-title bg-success">
                        <h5>Generate Report Kinerja</h5>
                    </div>
                    <div class="ibox-content no-margins row">
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Bulan Evaluasi</th>
                                            <th>Depo</th>
                                            <th>User</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <form method="POST" action="{{url('/report/pdf-data-evaluasi/')}}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Report Bulan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" name="bulan">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-success" type="submit">Print</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
@endsection

@push('css')
    <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endpush
@push('script')
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        jQuery(function() {
            $('.dataTables-example').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/report/evaluasi-kinerja-dan-solusi-perbaikan/upload_data',
                columns: [
                            {data: 'tgl', name: 'tgl'},
                            {data: 'data_depo', name: 'data_depo'},
                            {data: 'data_form', name: 'data_form'},
                            {data: 'action', name: 'action'},
                        ],
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            $(".alert").slideUp(10000);
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
            $(".select2_demo_1").select2();
            $('.date').datepicker({
                changeMonth: true,
                changeYear: true,
                startView: "months",
                minViewMode: "months",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "mm-yyyy",
                onClose: function(dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
        })

    </script>
@endpush

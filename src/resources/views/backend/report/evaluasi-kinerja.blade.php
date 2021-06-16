@extends('backend.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        @if ($title)
                        <h5>{{$title}} </h5>
                        @else
                        <h5>Form Evaluasi Kinerja & Solusi Perbaikan </h5>
                        @endif
                        
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content no-margins">

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{$errors->first()}}.
                            </div>
                        @endif
                        <form role="form" action="/report/evaluasi-kinerja-dan-solusi-perbaikan" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="col-sm-12 col-form-label">Data Bulan</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" name="bulan">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-sm-12 col-form-label">Data Target Lama Bulan</label>
                                    <select name="target_lama" id="target_lama" class="form-control select2_demo_1">
                                       @foreach ($date_target['tl_date'] as $item)
                                           <option value="{{$item->tgl}}">{{\Carbon\Carbon::create($item->tgl)->format('d F Y')}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label class="col-sm-12 col-form-label">Data Target Baru Berlaku Bulan</label>
                                    <select name="target_baru" id="target_baru" class="form-control select2_demo_1">
                                        @foreach ($date_target['tb_date'] as $item)
                                            <option value="{{$item->tgl}}">{{\Carbon\Carbon::create($item->tgl)->format('d F Y')}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group m-t-lg">
                                        <button class="btn btn-success btn-block" type="submit">Show</button>
                                    </div>
                                </div>
                            </div>  
                        </form>
                    </div>
                    <div class="ibox-content">
                        @if($data)
                            <x-table-evaluasi-kerja :data-evaluasi="$data" :depo="$depo" :param="$param"/>  
                        @endif
                    </div>
                    <div class="ibox-footer">
                        <span class="float-right">
                          The righ side of the footer
                        </span>
                        This is simple footer example
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="{{asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
@endpush
@push('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script>

        jQuery(function(){
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

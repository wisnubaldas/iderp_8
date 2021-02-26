<div class="modal inmodal fade" {{$attributes ?? ''}} id="modal-baru" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form {{$title ?? ''}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($form_input as $item)
                        @switch($item['type'])
                            @case('input')
                                <div class="form-group col-4">
                                    <label>{{Str::upper($item['name'])}}</label> 
                                    <input type="text" class="form-control" {{$item['attribute'] ?? ''}}  name="{{$item['name']}}" id="{{$item['name']}}" value="{{$item['value'] ?? ''}}">
                                </div>
                                @break
                            @case('date')
                                <div class="form-group " id="data_1">
                                    <label class="font-normal">{{Str::upper($item['name'])}}</label>
                                    <div class="input-group date datepicker">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" {{$item['attribute'] ?? ''}} name="{{$item['name']}}"  value="{{$item['value'] ?? ''}}">
                                    </div>
                                </div>
                                @break
                            @case('select')
                                    <x-form.select class="col-4" name="{{$item['name']}}" id="select" :selectData="$item['data']" >
                                        <label class="font-normal">{{Str::upper($item['name'])}}</label>
                                    </x-form.select>
                                @break
                        @endswitch   
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


@push('script')
    <!-- Data picker -->
   <script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
   <script>
        jQuery(function(){
            $('.datepicker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        })
    </script>
@endpush
@push('css')
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endpush
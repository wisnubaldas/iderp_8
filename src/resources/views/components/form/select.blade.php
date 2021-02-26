
<div {{ $attributes->merge(['class' => 'form-group']) }}>
    {{ $slot }}
    <select class="chosen-select" name="{{$name}}" id="{{$id}}">
        <option value="" selected>Select</option>
        @foreach ($selectData as $item)
            <option value="{{$item['value']}}">{{$item['id']}}</option>
        @endforeach
    </select>
</div>
@push('css')
<link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
@endpush
@push('script')
    <!-- Chosen -->
    <script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script>
        jQuery(function(){
            $('.chosen-select').chosen({width: "100%"});
        })
    </script>
@endpush
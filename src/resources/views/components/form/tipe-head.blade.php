    <input type="text"
        autocomplete="off"
        data-provide="typeahead"
        data-source='@json($dataHead)'
         {{$attributes}}/>
@push('script')
    <!-- Typehead -->
    <script src="{{asset('js/plugins/typehead/bootstrap3-typeahead.min.js')}}"></script>
    <script>
        const dtsrc = @json($dataHead);
        $('.typeahead').typeahead({
            source: dtsrc,
            items:20
        })
    </script>
@endpush
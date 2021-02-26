<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tbl-all" >
        {{$cols ?? ''}}
        <thead>
            <tr>
                @foreach ($thead as $item)
                    <td>{{Str::upper($item)}}</td>   
                @endforeach
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>

@push('css')
@endpush

@push('script')
<script>
    const h_tbl = @json($thead);
    const kolom = h_tbl.map(function(a){
        return {data:a,name:a}
    })

     // Upgrade button class name
     let table = $('#tbl-all').DataTable({
                    ajax: "{{$link}}",
                    columns:kolom,
                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    // paging: false,
                    lengthChange: false,
                    searching:true,
                    responsive: true,
            });
    // table.columns( [3,4,7,8,9,10,11,12,13,14] ).visible( false );
</script>
@endpush
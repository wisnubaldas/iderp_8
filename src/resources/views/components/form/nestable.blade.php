<div class="row" {{$attributes}}>
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-content">
                <div class="btn-group" id="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-white">Expand All</button>
                    <button type="button" data-action="collapse-all" class="btn btn-white">Collapse All</button>
                </div>
                <div class="dd" id="nestable2">
                    <ol class="dd-list">
                        @foreach ($tree as $i)
                            @if (isset($i['children']))
                                <li class="dd-item" data-id="{{$i['coa_id']}}">
                                    <div class="dd-handle">
                                        <span class="label label-warning">{{$i['coa_id']}}</span> {{$i['coa_nama']}}
                                    </div>
                                    @include('components.form.nestable-child',['children' => $i['children']])
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
                <textarea id="nestable2-output" class="form-control"></textarea>
            </div>

        </div>
    </div>
</div>

@push('script')
 <!-- Nestable List -->
 <script src="{{asset('js/plugins/nestable/jquery.nestable.js')}}"></script>
 <script>
    $(document).ready(function(){

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                    output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
       

        // activate Nestable for list 2
        $('#nestable2').nestable({
            group: 1
        }).on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable2').data('output', $('#nestable2-output')));

        $('#nestable-menu').on('click', function (e) {
            var target = $(e.target),
                    action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    });
    </script>
@endpush
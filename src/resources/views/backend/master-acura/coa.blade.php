@extends('backend.index')
@section('content')
<div class="container">
    <div class="m-t-md">
        <button class="btn btn-primary btn-sm" id="create-coa">Action</button>    
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Preview COA</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>D/U</th>
                            <th>Posisi</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>COA Tree</h5>
                </div>
                <div class="ibox-content">
                    <div class="scroll_content">
                        <div id="jstree1">
                            @foreach ($tree as $i)
                                @if (isset($i['children']))
                                    <ul>
                                        <li id="{{$i['coa_id']}}">
                                            {{$i['coa_id']}} - <span class="text-success">{{$i['coa_name']}}</span> 
                                            @include('components.coa.tree',['children' => $i['children']])
                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </div>

    {{-- <x-form.nestable :tree="$tree" id="nested-table" /> --}}
    {{-- <x-form.create-coa class="d-none animated fadeIn" id="form-coa" :tree="$tree"/> --}}
    
@endsection
@push('script')
<script src="{{url('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{url('js/plugins/jsTree/jstree.min.js')}}"></script>
    <script>
        let tpl = function(data)
        {
            // console.log(data)
            let xx = data.map(el => {
                // console.log(el.depo)
                let depo = el.depo.map(dep => {
                        return `<span class="col-3 no-margins no-paddings">${dep.nama_depo}</span>`;
                })
                return `<tr>
                            <td>${el.coa_id}</td>
                            <td>${el.coa_name}</td>
                            <td>${el.coa_deum}</td>
                            <td class="text-navy"> ${el.coa_level} </td>
                            <td class="text-navy"> ${el.coa_ket} </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info row">
                                    ${depo.join('')}
                                </div>
                            </td>
                        </tr>`;
            });
           return xx.join('')
        }
        jQuery(function(){
            // Add slimscroll to element
            $('.scroll_content').slimscroll({
                height: '500px'
            })

            $('#jstree1').jstree({
                    'core' : {
                        'check_callback' : true
                    },
                    'plugins' : [ 'types', 'dnd' ],
                    'types' : {
                        'default' : {
                            'icon' : 'fa fa-folder'
                        },
                        'html' : {
                            'icon' : 'fa fa-file-code-o'
                        },
                        'svg' : {
                            'icon' : 'fa fa-file-picture-o'
                        },
                        'css' : {
                            'icon' : 'fa fa-file-code-o'
                        },
                        'img' : {
                            'icon' : 'fa fa-file-image-o'
                        },
                        'js' : {
                            'icon' : 'fa fa-file-text-o'
                        }

                    }
            });

            $('#jstree1').on("changed.jstree", function (e, data) {
                console.log(data.selected.join(''));
                $.ajax({
                        method: "GET",
                        url: '/acura-master/coa/'+data.selected.join(''),
                        }).done(function( msg ) {
                           $('.table-striped').find('tbody').html(tpl(msg))
                        }).fail(function(a){
                                return a;
                        });
            });
        })
    </script>
@endpush
@push('css')
<link href="{{url('css/plugins/jsTree/style.min.css')}}" rel="stylesheet">
<style>
    .jstree-open > .jstree-anchor > .fa-folder:before {
        content: "\f07c";
    }

    .jstree-default .jstree-icon.none {
        width: 0;
    }
</style>

@endpush
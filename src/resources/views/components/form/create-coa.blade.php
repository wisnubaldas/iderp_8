<div {{$attributes}}>
    <form action="#">
        <div class="col-md-12">
            <label><h5>Cari Parrent Coa</h5></label>
            <div class="input-group m-b">
                <x-form.tipe-head :dataHead="$tree"  placeholder="Search COA..." name="typehead" class="form-control typeahead" width='100%'/>
                <span class="input-group-append">
                    <button type="button" class="btn btn-warning" id="edit">Edit</button>
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                    <button type="submit" class="btn btn-primary" id="save" disabled>Save</button>
                </span>
            </div>
            <div id="coa-input" class="row"></div>
        </div>
    </form>
    
</div>
@push('css')
<link href="{{asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@push('script')
    <script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
    
    <script>
        let makeCoa = {
            
            level: function(a)
            {
                // console.log('id coa nya--',a)
                const pjngStr = a.toString()
                if(pjngStr === '0')
                    return 1;
                if(pjngStr !== '0' && pjngStr.length === 1)
                    return 2;
                if(pjngStr.length === 2)
                    return 3;
                return (pjngStr.length);
            },
            tpl:function(data){
                // console.log(data)
                    let x = new Baldas()
                    const idCoa = x.view.input(
                        {
                            addon:data.coa_id,
                            attr:{
                                type:'text',
                                name:'coa_id',
                                placeholder:'Masukan ID COA',
                                id:'coa_id',
                                maxlength:'2',
                            }
                        })
                    const coaDk = x.view.select({
                        K:'Kredit',
                        D:'Debit'
                    },'coa_dk','coa_dk')
                    const coaDeum = x.view.select({
                        D:'Debit',
                        U:'Umum'
                    },'coa_deum','coa_deum')
                    const coaName = x.view.input(
                        {
                            addon:'COA Name',
                            attr:{
                                type:'text',
                                name:'coa_nama',
                            }
                        })
                    const coaNameId = x.view.input(
                        {
                            addon:'COA Mark ',
                            attr:{
                                type:'text',
                                name:'mark',
                            }
                        })
                    const coaKet = x.view.input(
                        {
                            addon:'Keterangan ',
                            attr:{
                                type:'text',
                                name:'coa_ket',
                            }
                        })
                    const coaKelas = x.view.input(
                        {
                            addon:'Kelas ',
                            attr:{
                                type:'text',
                                name:'coa_kelas',
                                value:data.coa_kelas,
                                readonly:'true',
                            }
                        })
                    const coaInduk = x.view.input(
                        {
                            addon:'Induk',
                            attr:{
                                type:'text',
                                name:'coa_induk',
                                value:data.coa_induk,
                                readonly:'true',
                            }
                        })
                    const coaLevel = x.view.input(
                                        {
                                            addon:'Level',
                                            attr:{
                                                type:'text',
                                                name:'coa_level',
                                                value:parseInt(data.coa_level)+1,
                                                readonly:'true',
                                            }
                                        })
                return `
                        <div class="col-md-6">${idCoa}${coaDk}<br>${coaDeum}
                            <div id="error"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-4">${coaKelas}</div>
                                <div class="col-4">${coaInduk}</div>
                                <div class="col-4">${coaLevel}</div>
                            </div>
                        ${coaName}${coaNameId}${coaKet}</div>
                    `;
                
            },
            
            checkId:function(id,val,result){
                if(val){
                    $.ajax({
                        method: "POST",
                        url: "/acura-master/coa/check_id/"+id+val,
                        }).done(function( msg ) {
                            result(msg)
                    }).fail(function(a){
                            console.log(a)
                    });
                }
            },
            edit:function(id){
                console.log(id)
            }
        }
        jQuery(function(){

            $('.typeahead').on('change',function() {
                var current = $('.typeahead').typeahead("getActive");
                // console.log(current)
                // const edit = $('#edit')
                // edit.on('click',function(){
                //     console.log(current.id)
                // })
                if (current) {
                    // Some item from your model is active!
                    if (current.name == $('.typeahead').val()) {
                    // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
                    // console.log(current.id)
                    // console.log(cuk)
                    // this means generate form for input coa
                    const tpl = makeCoa.tpl(current.asset);
                    $('#coa-input').html(tpl);
                    // this check coa id
                    let wto;
                    $('#coa_id').on('input',function(){ 

                        clearTimeout(wto);
                        wto = setTimeout(function() {
                            // do stuff when user has been idle for 1 second
                            // const coa_level = parseInt(current.asset.coa_level)+1;
                            // const coa_id = parseInt(current.id+$('#coa_id').val());
                            // makeCoa.checkCoaLevel(coa_level,coa_id);

                            makeCoa.checkId(current.id,$('#coa_id').val(),function(a){
                                let x = new Baldas()
                                if(a)
                                {
                                    const tpl = `COA ID <strong>${a.coa_id}</strong> sudah digunakan oleh <strong>${a.coa_nama}</strong> silahkan ulangi lagi....`;
                                    $('#error').html(x.view.alert('alert-danger',tpl))
                                    $('#save').attr('disabled');
                                }else{
                                    const tpl = `COA ID Bisa di gunakan`;
                                    $('#error').html(x.view.alert('alert-success',tpl))
                                    $('#save').attr('disabled',false);
                                }
                                
                            })
                        }, 1000);
                    })
                    // makeCoa.checkId(
                    //     $('#coa_id').on('input',function(){ return $(this).val() })
                    // )
                    // this jquery selector for select2 library
                    $(".select2_demo_1").select2({
                        theme: 'bootstrap4',
                    });
                    } else {
                    // This means it is only a partial match, you can either add a new item
                    // or take the active if you don't want new items
                    }
                } else {
                    // Nothing is active so it is a new value (or maybe empty value)
                }
            });
            
        })
    </script>
@endpush
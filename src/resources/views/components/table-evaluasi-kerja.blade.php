{{-- @dump($depo) --}}
{{-- @dump($depo[auth()->user()->permissions->pluck('name')[0]]) --}}
<select name="depo" id="depo" class="form-control select-depo">
    <option value="" selected="selected" >### Select Depo ###</option>
    @foreach ($depo as $item)
         <option value="{{$item}}">{{$item}}</option>
    @endforeach
</select>
<hr />
<form action="#" id="frm-kinerja">
    <table class="table table-bordered animated fadeIn" id="tbl-form-kinerja">
        <thead class="text-center">
            <tr>
                <th rowspan="2" style="width: 20%">Tanggal Pendirian</th>
                <th colspan="2">Masa</th>
                <th colspan="2">Target Lama</th>
                <th colspan="2">Rata2 Pencapaian</th>
                <th colspan="4">% Pencapaian</th>
                <th colspan="2">Target Baru</th>
                <th colspan="2">% Simulasi Pencapaian</th>
                <th rowspan="2">Nilai Tengah</th>
            </tr>
            <tr>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Qty</th>
                <th>Profit</th>
                <th>Qty</th>
                <th>Profit</th>
                <th>Qty</th>
                <th>Rank</th>
                <th>Profit</th>
                <th>Rank</th>
                <th>Qty</th>
                <th>Profit</th>
                <th>Qty</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
                <td colspan="16">
                    <div class="row bg-muted p-xs">
                        <div class="col-md-1 font-bold text-danger">
                            Saran/Solusi
                        </div>
                        <div class="col-md-3">
                            a. Meningkatkan Quantity<br>
                            e. Meningkatkan frekuensi kontak
                        </div>
                        <div class="col-md-2">
                            b. Menaikan Profit<br>
                            f. Menambah Sales
                        </div>
                        <div class="col-md-3">
                            c. Menyesuaikan Harga Jual<br>
                            d. Mengganti Orang
                        </div>
                        <div class="col-md-3">
                            d. Menambah Toko Transaksi<br>
                            h. Lain-lain
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="16">
                    <div class="float-right">
                        <button type="submit" class="btn btn-success">Save Data</button>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
@push('script')
<script src="{{url('js/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script>
        const evaluasi = @json($data_evaluasi);
        const param = @json($param);
        let template = {
            evaluasi : function(a){
                return `
                            <tr class="text-center align-middle animated fadeIn">
                                <td class="text-center">${a[0].tgl_pendirian.tgl}</td>
                                <td>${a[0].tgl_pendirian.tahun}</td>
                                <td>${a[0].tgl_pendirian.bulan}</td>
                                <td>${numeral(a[0].target_lama.qty).format('0,0')}</td>
                                <td>${numeral(a[0].target_lama.profit).format('0,0')}</td>
                                <td>${numeral(a[0].rata_pencapaian.qty).format('0,0')}</td>
                                <td>${numeral(a[0].rata_pencapaian.profit).format('0,0')}</td>
                                <td>${numeral(a[0].pencapaian.qty).format('0,0.00')}</td>
                                <td>${a[0].ranking_qty}</td>
                                <td>${numeral(a[0].pencapaian.profit).format('0,0.00')}</td>
                                <td>${a[0].ranking_profit}</td>
                                <td>${numeral(a[0].target_baru.qty).format('0,0')}</td>
                                <td>${numeral(a[0].target_baru.profit).format('0,0')}</td>
                                <td>${numeral(a[0].sim_pencapaian.qty).format('0,0.00')}</td>
                                <td>${numeral(a[0].sim_pencapaian.profit).format('0,0.00')}</td>
                                <td>${numeral(a[0].nil_tengah).format('0,0.00')}</td>
                            </tr>
                    `;
            },
            form_perbaikan:function(a){
                return `
                    <tr>
                        <td rowspan="2" class="text-center align-middle">1</td>
                        <td colspan="5">Cara perbaikan :</td>
                        <td colspan="10">
                            <ul class="list-inline">
                                @php($abc = ['A','B','C','D','E','F','G','H'])
                                @for ($i = 0; $i < 8; $i++)
                                    <li class="list-inline-item">
                                        <div class="i-checks">
                                            <label> 
                                                <input type="checkbox" name="saran" value="{{$abc[$i]}}"><i></i> 
                                                <span class="font-bold">{{$abc[$i]}}</span>  
                                            </label>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">Penjelasan :</td>
                        <td colspan="10">
                            <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="penjelasan"></textarea>
                            </div>
                        </td>
                    </tr>
                `;
            }
        }

        let post_data = function(data,callback){
                            $.ajax({
                                method: "POST",
                                url: '/report/post-data-evaluasi',
                                data:{
                                    evaluasi:data
                                },
                                }).done(function( msg ) {
                                    callback(msg)
                            }).fail(function(a){
                                swal({
                                        title: a.responseJSON.message,
                                        type: "error"
                                    });
                                    // console.log(a)
                            });
        } // end post data

        jQuery(function(){
            var dataSelect;
            $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
            });
            $(".select-depo").select2();
            $(".select-depo").on('select2:select',function(e){
                var data = e.params.data.id;
                const dataDepo = evaluasi.map(function(a,b){
                    if(a.nama == data)
                    {
                        dataSelect = a;
                        return a;
                    }
                    }).filter(function( element ) {
                        return element !== undefined;
                    });

                $('#tbl-form-kinerja tbody').html(template.evaluasi(dataDepo)+template.form_perbaikan())
                // submit data
                
            });
            $('#frm-kinerja').submit(function(e){
                let frmData = $(this).serializeArray();
                const data = {
                    form:frmData,
                    depo:dataSelect,
                    param:param
                }
                
                post_data(JSON.stringify(data),function(a){
                    // console.log(a)
                    $('#tbl-form-kinerja tbody').html(template.form_perbaikan())
                    swal({
                            title: "Data Save Success....!!!",
                            type: "success"
                        });
                });
                return false;
            });
        }) // end jquery
    </script>
@endpush
@push('css')
<link href="{{url('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endpush
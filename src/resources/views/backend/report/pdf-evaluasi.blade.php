<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">

</head>

<body>
    @foreach ($result as $package)
        @foreach ($package as $item)
            <div class="page-break"></div>
            <h2>Form Evaluasi Kinerja & Solusi Perbaikan</h2>
            <p>Depo : <span class="text-bold">{{ $item['depo'] }}, </span> <span
                    class=" text-space"></span>{{ $item['title'] }}</p>
            <table class="table-bordered">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" style="width:15%">Tanggal Pendirian</th>
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
                    <tr class="text-center align-middle animated fadeIn">
                        <td class="text-center">{{ $item['data']['tgl_pendirian'] }}</td>
                        <td>{{ $item['data']['massa_thn'] }}</td>
                        <td>{{ $item['data']['massa_bln'] }}</td>
                        <td>{{ $item['data']['tl_qty'] }}</td>
                        <td>{{ $item['data']['tl_profit'] }}</td>
                        <td>{{ $item['data']['rrp_qty'] }}</td>
                        <td>{{ $item['data']['rrp_profit'] }}</td>
                        <td>{{ $item['data']['pp_qty'] }}</td>
                        <td>{{ $item['data']['pp_qty_r'] }}</td>
                        <td>{{ $item['data']['pp_profit'] }}</td>
                        <td>{{ $item['data']['pp_profit_r'] }}</td>
                        <td>{{ $item['data']['tb_qty'] }}</td>
                        <td>{{ $item['data']['tb_profit'] }}</td>
                        <td>{{ $item['data']['sp_qty'] }}</td>
                        <td>{{ $item['data']['sp_profit'] }}</td>
                        <td>{{ $item['data']['nt'] }}</td>
                    </tr>
                    @foreach ($item['review'] as $id_user => $review)
                        @if ($id_user == 'kadep')
                            @include('backend.report.pdf-evaluasi-tr',[
                            'number'=>1,
                            'status'=>'Depo'
                            ])
                        @endif
                        @if ($id_user == 'rm')
                            @include('backend.report.pdf-evaluasi-tr',[
                            'number'=>2,
                            'status'=>'Regional Manager'
                            ])
                        @endif
                        @if ($id_user == 'manager')
                            @include('backend.report.pdf-evaluasi-tr',[
                            'number'=>3,
                            'status'=>'Sales Distribution Manager'
                            ])
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="16">
                            <div class="sumary">
                                <table style="width: 100%" class="sumary">
                                    <tr>
                                        <td>Saran/Solusi</td>
                                    </tr>
                                    <tr>
                                        <td>A. Meningkatkan Quantity</td>
                                        <td>C. Menyesuaikan Harga Jual</td>
                                        <td>E. Meningkatkan frekuensi kontak</td>
                                        <td>G. Mengganti Orang</td>
                                    </tr>
                                    <tr>
                                        <td>B. Menaikan Profit</td>
                                        <td>D. Menambah Toko Transaksi</td>
                                        <td>F. Menambah Sales</td>
                                        <td>H. Lain-lain</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <table style="width: 100%" class="sumary">
                <tr>
                    <td colspan="5" class="text-right" style="padding-right:30px;">Jakarta, {{\Carbon\Carbon::now()->format('d F Y')}},</td>
                </tr>
                <tr class="text-center">
                    <td colspan="2">Diketahui,</td>
                    <td colspan="3">Dilaporkan,</td>
                </tr>
                <tr style="padding: 30px;">
                    <td>
                        <br><br><br><br>
                    </td>
                </tr>
                <tr class="text-center text-bold">
                    <td>Lin Chien Ping</td>
                    <td>Sudarsa</td>
                    <td>Harihwa</td>
                    <td>RM</td>
                    <td>Kadep</td>
                </tr>
            </table>
        @endforeach
    @endforeach
</body>

</html>

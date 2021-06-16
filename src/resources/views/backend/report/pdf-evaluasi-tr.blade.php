<tr>
    <td rowspan="2" class="text-center align-middle">{{ $number }}</td>
    <td colspan="5">Cara perbaikan {{ $status }} sendiri:</td>
    <td colspan="10">
        @php($abc = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'])
            <div class="tbl-abc">
                <table style="width: 100%" class="tbl-abc">
                    <tr>
                        @for ($i = 0; $i < 8; $i++)
                                <td>{{ $abc[$i] }}</td> 
                        @endfor
                    </tr>
                    <tr>
                        @for ($i = 0; $i < 8; $i++)
                            @if (in_array($abc[$i], $review['saran'])) 
                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                             @else
                                <td></td> 
                            @endif
                        @endfor
                    </tr>
                    
                </table>
            </div>
    </td>
    </tr>
    <tr>
        <td colspan="15"><span class="text-bold">Penjelasan</span> : <span class="text-italic">{{ $review['penjelasan'] }}</span></td>
    </tr>

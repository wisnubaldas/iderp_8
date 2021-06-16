<?php

namespace App\Imports;

use App\Models\Report\TargetLama as TL;
use App\Models\AcuraMaster\Depo;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use \Carbon\Carbon;
class TargetLama implements ToCollection
{

    private $bulan;
    public function __construct($bulan) 
    {
        $this->bulan = $bulan;
    }
        
    public function collection(Collection $rows)
    {
        foreach ($rows as $idx => $row) 
        {
            if($idx != 0)
            {
                $tl = new TL;
                $tl->depo_id = Depo::where('tree_code',$row[0])->first()->id;
                $tl->qty = $row[1];
                $tl->profit = $row[2];
                $tl->tgl = Carbon::createFromFormat('m-Y',$this->bulan);
                $tl->save();
            }
        }
    }
}

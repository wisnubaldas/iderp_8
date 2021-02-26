<?php

namespace App\Imports;

use App\Models\AcuraMaster\Coa;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
class CoaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $id_depo = 1;
        foreach ($rows as $row) 
        {
            $coa = Coa::where('coa_id',$row[0])->where('coa_name',$row[1])->first();
            if($coa)
            {
                $coa->depo()->attach($id_depo);
            }else{
                $coa = new Coa;
                $coa->coa_id = $row[0];
                $coa->coa_name = $row[1];
                $coa->coa_kelas = $row[2];
                $coa->coa_dk = $row[3];
                $coa->coa_induk = $row[4];
                $coa->coa_level = $row[5];
                $coa->coa_deum = $row[6];
                $coa->coa_pre = $row[7];
                $coa->coa_ket = $row[11];
                $coa->save();
                $coa->depo()->attach($id_depo);
            }
            
            // $coa->depo()->attach([13]);
            // $coa->pivot->coa_id = $coa->id;
            // $coa->pivot->depo_id = 13;
            // $coa->save(); 
            
        }
    }
}

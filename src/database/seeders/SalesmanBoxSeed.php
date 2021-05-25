<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Library\MyHelper;
use App\Models\AcuraMaster\Depo;
use App\Models\AcuraMaster\Salesman;
use App\Models\AcuraMaster\SalesBox;

class SalesmanBoxSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depo = MyHelper::get_dir_name('factories/csv');
        unset($depo[6]); // folder coa
        foreach ($depo as $key => $value) {

            $data = MyHelper::get_csv(database_path('factories/csv/'.$value.'/Salesman_BOX.csv'));
            unset($data[0]); // head data csv

            $depoId = Depo::where('nama_depo',ucwords($value))->first();
            foreach ($data as $x) {
                $salesman_id = Salesman::where('depo_id',$depoId->id)->where('id_sales',$x[0])->first();
                if($salesman_id)
                {
                    $sal_box = new SalesBox;
                    $sal_box->salesman_id = $salesman_id->id;
                    $sal_box->tgl_1 = date('Y-m-d',strtotime($x[1]));
                    $sal_box->tgl_2 = date('Y-m-d',strtotime($x[2]));
                    $sal_box->jml = $x[3];
                    $sal_box->save();
                }else{
                    dump($value,$x[0]);
                }
                dump($sal_box->id);
            }
        }

    }
}

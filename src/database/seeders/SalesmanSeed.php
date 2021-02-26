<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Library\MyHelper;
use App\Models\AcuraMaster\Depo;
use App\Models\AcuraMaster\Salesman;
class SalesmanSeed extends Seeder
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

            $data = MyHelper::get_csv(database_path('factories/csv/'.$value.'/SalesmanDb.csv'));
            unset($data[0]); // head data csv

            $depoId = Depo::where('nama_depo',ucwords($value))->first();
            foreach ($data as $x) {
                $salesman = new Salesman;
                $salesman->m_depo_id = $depoId->id;
                $salesman->id_sales = $x[0];
                $salesman->name = $x[1];
                $salesman->tgl_masuk = date('Y-m-d',strtotime($x[2]));
                $salesman->status = $x[3];
                $salesman->save();
                dump($salesman->id);
            }
        }
    }
}

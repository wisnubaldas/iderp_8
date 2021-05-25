<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Library\MyHelper;
use App\Models\AcuraMaster\Depo;
use App\Models\AcuraMaster\AreaJual;

class AreaJualSeed extends Seeder
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

            $data = MyHelper::get_csv(database_path('factories/csv/'.$value.'/Area_Jual.csv'));
            unset($data[0]); // head data csv

            $depoId = Depo::where('nama_depo',ucwords($value))->first();
            foreach ($data as $x) {
                $cur = new AreaJual;
                $cur->m_depo_id = $depoId->id;
                $cur->kode = $x[0];
                $cur->area = $x[1];
                $cur->created_at = date('Y-m-d',strtotime('now'));
                $cur->status = $x[4];
                $cur->price_group = $x[5];
                $cur->save();
                dump($cur->id);
            }
        }
    }
}

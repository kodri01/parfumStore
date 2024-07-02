<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::query()->truncate();
        Setting::create([
            'name' => 'Parfum Store',
            'company_name' => 'Siipaling Parfum',
            'alamat' => 'Lrg. Perdamaian PAL 2',
            'pimpinan' => 'Sila Kodri',
        ]);
    }
}
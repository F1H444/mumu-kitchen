<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kota;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ["id" => "133", "nama_kota" => "Kabupaten Gresik", "provinsi_id" => "11"],
            ["id" => "409", "nama_kota" => "Kabupaten Sidoarjo", "provinsi_id" => "11"],
            ["id" => "444", "nama_kota" => "Kota Surabaya", "provinsi_id" => "11"],
        ];

        foreach ($datas as $data) {
            Kota::create($data);
        }
    }
}

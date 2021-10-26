<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            'Rekayasa Perangkat Lunak',
            'Teknik Komputer & Jaringan',
            'Multimedia',
            'Otomatisasi & Tata Kelola Perkantoran',
            'Akuntansi & Keuangan Lembaga',
            'Bisnis Daring & Pemasaran',
            'Akomodasi Perhotelan',
            'Desain Komunikasi Visual',
            'Seni Tari',
            'Tata Boga'
        ] as $key => $value) {
            Department::create(['name' => $value]);
        }
    }
}

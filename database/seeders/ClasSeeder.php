<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ClasSeeder extends Seeder
{
    
    public function run()
    {
        $grades = [
            'الروضة',
            'الصف الأول',
            'الصف الثاني',
            'الصف الثالث',
            'الصف الرابع',
            'الصف الخامس',
            'الصف السادس',
            'الصف السابع',
            'الصف الثامن',
            'الصف التاسع',
            'الصف العاشر',
        ];

        $sections = ['أ', 'ب'];

        foreach ($grades as $grade) {
            foreach ($sections as $section) {
                DB::table('clas')->insert([
                    'name' => $grade . ' شعبة ' . $section,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

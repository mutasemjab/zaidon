<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeExpensesSeeder extends Seeder
{
    public function run()
    {
        $expenses = [
            'مصروف ديزل',
            'مصروف تغيير بريكات',
            'مصروف صيانة عامة',
            'مصروف دهان',
            'مصروف كهرباء',
            'مصروف ألواح',
            'مصروف قرطاسية',
            'مصروف طباعة',
            'مصروف ماء',
            'مصروف كهرباء المدرسة',
            'مصروف شراء كتب',
            'مصروف نظافة',
            'مصروف انترنت',
            'مصروف رواتب مؤقتة',
            'مصروف أدوات رياضية',
            'مصروف أدوات موسيقية',
            'مصروف برامج تعليمية',
            'مصروف نشاطات طلابية',
            'مصروف صيانة حواسيب',
            'مصروف معدات معمل علوم',
        ];

        foreach ($expenses as $expense) {
            DB::table('type_expenses')->insert([
                'name' => $expense,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

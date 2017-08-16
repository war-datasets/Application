<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HelpdeskCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'        => 'Foutmelding',
                'module'      => 'helpdesk',
                'description' => 'Gebruikt voor tickets die gaan over een foutmelding.'
            ],
        ];

        $table = DB::table('categories');
        $table->delete();
        $table->insert($categories);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/modems.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('transactions')->truncate();
        Transaction::create(['date' => '2021-02-17', 'description' => "Credited to Office Account", 'credit' => 5000, 'debit' => null, 'runningBalance' => "5000"]);
        Transaction::create(['date' => '2021-02-18', 'description' => "Snacks Party", 'credit' => null, 'debit' => 500, 'runningBalance' => 4500]);
        Transaction::create(['date' => '2021-02-18', 'description' => "Printing sheets for office documents", 'credit' => null, 'debit' => 285, 'runningBalance' => "4215"]);
        Transaction::create(['date' => '2021-02-20', 'description' => "Misc Expenses", 'credit' => null, 'debit' => 3000, 'runningBalance' => 1215]);
    }
}

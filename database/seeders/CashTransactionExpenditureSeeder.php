<?php

namespace Database\Seeders;

use App\Models\CashTransactionExpenditure;
use Illuminate\Database\Seeder;

class CashTransactionExpenditureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashTransactionExpenditure::factory(3)->create();
    }
}

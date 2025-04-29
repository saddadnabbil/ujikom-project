<?php

namespace Database\Factories;

use Carbon\Carbon;

use App\Models\CashTransactionExpenditure;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashTransactionExpenditureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashTransactionExpenditure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'expenditure' => 5000,
            'amount' => 5000,
            'date' => now(),
            'note' => mt_rand(0, 1) ? $this->faker->text(20) : ''
        ];
    }
}

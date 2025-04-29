<?php

namespace App\Contracts;

interface ChartExpendituresInterface
{
    public function sumCashTransactionExpenditurePerMonths(): array;
}

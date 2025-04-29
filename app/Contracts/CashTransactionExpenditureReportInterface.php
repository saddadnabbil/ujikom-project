<?php

namespace App\Contracts;

interface CashTransactionExpenditureReportInterface
{
    public function filterByDateStartAndEnd(string $start, string $end): array;
    public function sum(string $column, string $type): Int;
}

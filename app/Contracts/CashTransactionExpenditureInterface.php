<?php

namespace App\Contracts;

interface CashTransactionExpenditureInterface
{
    // public function cashTransactionExpenditureLatest(array $columns, ?int $limit): Object;
    public function sumExpenditureBy(string $status, string $year = null, string $month = null): Int;
    // public function countStudentWhoPaidThisWeek(): Int;
    // public function countStudentWhoNotPaidThisWeek(): Int;
    // public function getStudentWhoNotPaidThisWeek(?int $limit, string $order): Object;
    public function results(): array;
}

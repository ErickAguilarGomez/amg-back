<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class TransactionRepository
{
    public function createTransactions($transactions)
    {
        return DB::select('CALL insert_transactions(?)',[json_encode($transactions)]);
    }
};


<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class TransactionRepository
{
    public function createTransactions($transactions)
    {
        return DB::select('CALL insert_transactions(?)', [json_encode($transactions)]);
    }
    public function upateTransactions($transaction)
    {
        return DB::select('CALL sp_update_transaction(?)', [json_encode($transaction)]);
    }


    public function deleteTransaction($id)
    {
        return DB::select('CALL delete_transaction(?)', [$id]);
    }

    public function findTransaction($id)
    {
        return DB::select('CALL find_transaction(?)', [$id]);
    }


}
;


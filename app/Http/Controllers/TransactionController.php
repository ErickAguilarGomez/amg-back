<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;  
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)  
    {
        $this->transactionService = $transactionService;
    }

    public function insert(Request $request)
    {
        $request->validate([
            'transactions' => 'required|array',
            'transactions.*.clientID' => 'required|integer',
            'transactions.*.amount' => 'required|numeric',
            'transactions.*.date' => 'required|date',
        ]);

        $transactions = $request->transactions;
        return $this->transactionService->inserTransaction($transactions); 
    }

    public function updateInser(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'clientID' => 'required|integer',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
    
        return $this->transactionService->updateTransactionByid($validatedData);
    }

    public function delete($id)
    {
        return $this->transactionService->deleteTransaction($id); 
    }
}


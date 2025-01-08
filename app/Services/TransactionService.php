<?php
namespace App\Services;

use App\Repositories\TransactionRepository;
use Exception;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function inserTransaction($data)
    {
        try {
            $transaction = $this->transactionRepository->createTransactions($data);

            if (empty($transaction)) { 
                return response()->json(['message' => "Debes ingresar al menos 1 registro"], 404);
            }

            return response()->json(['response' => $transaction], 200);

        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    
}

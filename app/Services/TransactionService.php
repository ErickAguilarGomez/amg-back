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

    public function deleteTransaction($id)
    {
        try {
            $transaction = $this->findTransactionById($id);  // Asegurarte de encontrar la transacción por ID
            if (empty($transaction)) {
                return response()->json(["message" => "Transaction does not exist"], 404);
            }

            $transactionDeleted = $this->transactionRepository->deleteTransaction($id);  // Pasar el ID al repositorio

            if ($transactionDeleted) {
                return response()->json(["message" => "Transaction deleted successfully"], 200);
            }

            return response()->json(["message" => "Failed to delete transaction"], 500);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }


    public function findTransactionById($data)
    {
        try {
            $transaction = $this->transactionRepository->findTransaction($data);

            return $transaction;
        } catch (Exception $e) {
            throw new Exception("Error finding transaction: " . $e->getMessage());
        }
    }



    public function updateTransactionByid($data)
    {
        try {
            $transaction = $this->transactionRepository->upateTransactions($data);

            return response()->json(['response' => "transaccion EXitosa"], 200);

        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}

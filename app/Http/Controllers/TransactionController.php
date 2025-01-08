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
    public function insert( Request $request){
        return $this->transactionService->inserTransaction($request);
    }
}

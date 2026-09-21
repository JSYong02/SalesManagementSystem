<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();

        $data = ['transactions' => $transactionModel ->getTransactions()];

        return view('dashboard', $data);
    }
}
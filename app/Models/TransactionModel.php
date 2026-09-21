<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'record_id',
        'transaction_type',
        'employee_id',
        'item_id',
        'description',
        'quantity',
        'unit_price',
        'total_amount',
        'transaction_date'
    ];

    protected $useTimestamps = false;

    public function getTransactions()
    {
        return $this ->select('
            transactions.*,
            employees.employee_id,
            employees.employee_name,
            items.item_code,
            items.item_name,
            items.category,
            items.type
        ')
        ->join(
            'employees',
            'employees.id = transactions.employee_id'
        )
        ->join(
            'items',
            'items.id = transactions.item_id'
        )
        ->orderBy('transactions.transaction_date', 'DESC')
        ->orderBy('transactions.id', 'DESC')
        ->FindAll();
        sdsadasd
    }
}
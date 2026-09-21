<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class TransactionSearch extends BaseController
{
    public function search()
    {
        $request = $this->request;

        $json = $request -> getJSON(true);

        if(!$json) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON request.'
                ]);
        }

        $transaction = $json['transaction'] ?? 'both';
        $searchBy = $json['search_by'] ?? '';
        $keyword =$json['keyword'] ?? '';
        $type = $json['type'] ?? '';
        $dateFrom = $json['date_from'] ?? '';
        $dateTo = $json['date_to'] ?? '';

        $transactionModel = new TransactionModel();

        $query = $transactionModel
            ->select('
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
            );

        if ($transaction === 'sale') {
            $query->where('transactions.transaction_type', 'sale');
        } elseif ($transaction === 'purchase') {
            $query->where('transactions.transaction_type', 'purchase');
        }

        if (!empty($keyword) && !empty($searchBy)) {
            switch ($searchBy) {

                case 'employee_id':
                    $query->like('employees.employee_id', $keyword);
                    break;

                case 'employee_name':
                    $query->like('employees.employee_name', $keyword);
                    break;

                case 'record_id':
                    $query->like('transactions.record_id', $keyword);
                    break;

                case 'description':
                    $query->like('transactions.description', $keyword);
                    break;
            }

        }

        if (!empty($type)) {
            $query->where('items.type', $type);
        }

        if (!empty($dateFrom)) {
            $query->where('transactions.transaction_date >=', $dateFrom);
        }

        if (!empty($dateTo)) {
            $query->where('transactions.transaction_date <=', $dateTo);
        }

        $query
            ->orderBy('transactions.transaction_date', 'DESC')
            ->orderBy('transactions.id', 'DESC');
        
        $results = $query->findALL();

        return $this->response->setJSON([
            'status' => 'success',
            'count' => count($results),
            'data' => $results
        ]);
    }
}
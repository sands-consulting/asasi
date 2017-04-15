<?php

namespace App\DataTables;

use App\Transaction;

class TransactionsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('transaction_number', function($transaction) {
                return link_to_route('admin.transactions.show', $transaction->transaction_number, $transaction->id);
            })
            ->addColumn('action', function($transaction) {
                return view('admin.transactions.index.actions', compact('transaction'));
            })
            ->editColumn('status', function($transaction) {
                return view('admin.transactions.index.status', compact('transaction'));
            })
            ->make(true);
    }

    public function query()
    {
        $query = Transaction::leftJoin('users', 'users.id', '=', 'transactions.user_id')
            ->select(
                'transactions.id',
                'transactions.transaction_number',
                'transactions.invoice_number',
                'transactions.total',
                'users.name as user_name',
                'transactions.status'
            );

        if($this->datatables->request->input('q', null))
        {
            $query->search($this->datatables->request->input('q', []));
        }

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80', 'class' => 'text-center'])
                    ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'transaction_number',
                'name' => 'transaction_number',
                'title' => trans('transactions.attributes.transaction_number')
            ],
            [
                'data' => 'invoice_number',
                'name' => 'invoice_number',
                'title' => trans('transactions.attributes.invoice_number')
            ],
            [
                'data' => 'total',
                'name' => 'total',
                'title' => trans('transactions.attributes.total')
            ],
            [
                'data' => 'user_name',
                'name' => 'users.id',
                'title' => trans('transactions.attributes.user')
            ],
            [
                'data' => 'status',
                'name' => 'transactions.status',
                'title' => trans('transactions.attributes.status')
            ],
        ];
    }

    protected function filename()
    {
        return 'transactions_dt_' . time();
    }

    protected function getBuilderParameters()
    {
        $data = parent::getBuilderParameters();
        $data['dom'] = '<"datatable-header"l><"datatable-scroll"t><"datatable-footer"ip>';
        return $data;
    }
}

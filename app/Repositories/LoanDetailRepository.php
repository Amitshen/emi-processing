<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class LoanDetailRepository implements LoanDetailRepositoryInterface
{
    protected $table = 'loan_details';

    public function getAll()
    {
        return DB::select('SELECT * FROM ' . $this->table);
    }

    public function getAllLoanDetails()
    {
        return $this->getAll();
    }
}

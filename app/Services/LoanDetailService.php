<?php

namespace App\Services;

use App\Repositories\LoanDetailRepositoryInterface;

// not using this service

class LoanDetailService
{
    protected $loanDetailRepository;

    public function __construct(LoanDetailRepositoryInterface $loanDetailRepository)
    {
        $this->loanDetailRepository = $loanDetailRepository;
    }

    public function getAllLoanDetails()
    {
        return $this->loanDetailRepository->getAll();
    }
}

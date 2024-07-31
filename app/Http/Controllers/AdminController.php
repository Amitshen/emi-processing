<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LoanDetailRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    protected $loanDetailRepository;

    public function __construct(LoanDetailRepositoryInterface $loanDetailRepository)
    {
        $this->loanDetailRepository = $loanDetailRepository;
    }

    //I am working on this task based on my understanding of the provided PDF.
    public function index()
    {
        return view('admin.index');
    }

    public function loanDetails()
    {
        $loanDetails = $this->loanDetailRepository->getAllLoanDetails();
        return view('admin.loan-details', compact('loanDetails'));
    }

    public function processData()
    {
        if (!Schema::hasTable('emi_details')) {
            $columns = [];
            $data = [];
        } else {
            $columns = DB::getSchemaBuilder()->getColumnListing('emi_details');
            $data = DB::table('emi_details')->get();
        }

        return view('admin.process-data', compact('columns', 'data'));
    }

    public function processDataPost()
    {
        DB::statement('DROP TABLE IF EXISTS emi_details');

        $loanDetails = $this->loanDetailRepository->getAllLoanDetails();
        $loanDetails = collect($loanDetails);
        if ($loanDetails->isEmpty()) return redirect()->back();

        $minDate = $loanDetails->min('first_payment_date');
        $maxDate = $loanDetails->max('last_payment_date');
        $period = \Carbon\CarbonPeriod::create($minDate, '1 month', $maxDate);
        $columns = 'clientid INT';
        $columnDefinitions = [];
        foreach ($period as $date) {
            $columnDefinitions[] = $date->format('Y_M') . ' DECIMAL(10, 2)';
        }
        $columns .= ', ' . implode(', ', $columnDefinitions);

        DB::statement('CREATE TABLE emi_details (' . $columns . ')');

        $insertData = [];
        foreach ($loanDetails as $loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);
            $remainingAmount = $loan->loan_amount;
            $data = ['clientid' => $loan->clientid];

            foreach ($period as $date) {
                $columnName = $date->format('Y_M');
                if (
                    $date->between($loan->first_payment_date, $loan->last_payment_date) ||
                    $date->isSameMonth($loan->first_payment_date) ||
                    $date->isSameMonth($loan->last_payment_date)
                ) {
                    $data[$columnName] = min($emiAmount, $remainingAmount);
                    $remainingAmount -= $emiAmount;
                } else {
                    $data[$columnName] = 0.00;
                }
            }

            $insertData[] = $data;
        }

        DB::table('emi_details')->insert($insertData);

        return redirect()->back();
    }
}

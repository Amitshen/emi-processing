<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Loan Details</h1>
    <table border="1">
        <tr>
            <th>Client ID</th>
            <th>Number of Payments</th>
            <th>First Payment Date</th>
            <th>Last Payment Date</th>
            <th>Loan Amount</th>
        </tr>
        @forelse ($loanDetails as $loan)
            <tr>
                <td>{{ $loan->clientid }}</td>
                <td>{{ $loan->num_of_payment }}</td>
                <td>{{ $loan->first_payment_date }}</td>
                <td>{{ $loan->last_payment_date }}</td>
                <td>{{ $loan->loan_amount }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center">No Data</td>
            </tr>
        @endforelse
    </table>

</body>

</html>

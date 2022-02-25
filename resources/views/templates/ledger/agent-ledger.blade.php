<table class="table table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <th>{{ $transaction->created_at }}</th>
                <th>
                    @foreach ($transaction->debits as $debit)
                        <p>{{ $debit->account->account }}</p>
                    @endforeach
                </th>
                <th>
                    @foreach ($transaction->credits as $credit)
                        <p>{{ $credit->account->account }}</p>
                    @endforeach
                </th>
                <th> {{ $transaction->unit_price }} </th>
            </tr>
        @endforeach
    </tbody>
    
</table>
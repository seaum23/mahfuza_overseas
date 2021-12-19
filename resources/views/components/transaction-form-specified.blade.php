<div class="modal-body">
    <div class="card">
        <div class="card-body">
            <div class="form-row mt-3 transaction_inputs justify-content-between">
                <div class="col-md-6 left_input_div">
                    <label id="{{ $name }}_label" for="{{ $name }}">Amount </label>
                    <input class="form-control amount-input" type="number" name="{{ $name }}" id="{{ $name }}" placeholder="Enter Amount" step="any">
                </div>
                <div class="col-md-6">
                    <label for="">Payment A/C </label>
                    <select class="form-control ms select2" name="{{ $name }}_payment_account" id="{{ $name }}_payment_account" data-placeholder="Payment Account" >
                        <option value=""></option>
                        @foreach ($payment_accounts as $payment_account)
                            <option data-account_type="{{ $payment_account->account_type }}" value="{{ $payment_account->id }}">{{ $payment_account->account }}</option>
                        @endforeach                        
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
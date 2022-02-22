<div class="modal-body">
    <div class="card">
        <div class="card-body"><h5>{{ ($credit_type == 'Comission') ? 'Comission' : 'VISA Fee' }}</h5>
            <div class="form-row mt-3 transaction_inputs justify-content-between">
                <div class="col-md-6 left_input_div">
                    <input type="hidden" name="payment_type" value="{{ $credit_type }}">
                    <label id="amount_label" for="amount">Amount </label>
                    <input class="form-control amount-input" type="number" name="amount" id="amount" placeholder="Enter Amount" step="any">
                </div>
            </div>
        </div>
    </div>
</div>
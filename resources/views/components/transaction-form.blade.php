<form action="#" id="transaction_form">
    <div class="modal-body">
        <div class="card">
            <div class="card-body"><h5 class="card-title"></h5>
                    <input class="form-control mb-2" type="text" id="transaction_title" readonly>
                    <input type="hidden" id="transaction_candidate_id" name="transaction_candidate_id" readonly>
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="">Account <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <select onchange="get_account_input_field(this)" class="form-control ms select2" name="account" id="account" data-placeholder="Select Account" >
                                <option value=""></option>
                                @foreach ($accounts as $account)
                                    <option data-account_type="{{ $account->account_type }}" value="{{ $account->id }}">{{ $account->account }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Particular Type <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <select onchange="get_particular(this.value)" class="form-control ms select2" name="particular_type" id="particular_type" data-placeholder="Select Particular Type" >
                                <option value=""></option>
                                <option value="agent">Agent</option>
                                <option value="delegate">Delegate</option>
                                <option value="manpower">Manpower</option>
                                <option value="office">Office</option>
                                <option value="self">Self</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Particular <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <select class="form-control ms select2" name="particular" id="particular" data-placeholder="Select Particular" >
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mt-3 transaction_inputs justify-content-between" style="display: none">
                        <div class="col-md-4 left_input_div">
                            <label id="left_input_label" for="left_input"> <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <input class="form-control amount-input" type="number" name="left_input" id="left_input" placeholder="Enter Amount" step="any">
                        </div>
                        <div class="col-md-4 right_input_div">
                            <label id="right_input_label" for="right_input"> <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <input class="form-control amount-input" type="number" name="right_input" id="right_input" placeholder="Enter Amount" step="any">
                        </div>
                        <div class="col-md-4">
                            <label for="">Payment A/C <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
                            <select class="form-control ms select2" name="payment_account" id="payment_account" data-placeholder="Payment Account" >
                                <option value=""></option>
                                @foreach ($payment_accounts as $payment_account)
                                    <option data-account_type="{{ $payment_account->account_type }}" value="{{ $payment_account->id }}">{{ $payment_account->account }}</option>
                                @endforeach                        
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Purpose </label>
                            <select class="form-control ms select2" name="purpose" id="purpose" data-placeholder="Payment Account">
                                <option value=""></option>
                                <option>Okala</option>
                                <option>MUFA</option>
                                <option>Figner</option>
                                <option>Manpower Card</option>
                                <option>Training Card</option>
                                <option>Test Medical</option>
                                <option>Final Medical</option>
                                <option>Police Clearance</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Note </label>
                            <textarea class="form-control" name="note" id="note" cols="30" rows="2" placeholder="Note"></textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="form-row mt-3 transaction_inputs justify-content-end" style="display: none">
            <button id="transaction_form_submit" type="submit" class="btn btn-primary">Submit</button>
            <button id="transaction_modal_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
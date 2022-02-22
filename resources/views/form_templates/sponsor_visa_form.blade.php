<div class="form-row justify-content-between form-body">
    <div class="form-group col-md-6" >
        <label>VISA No.</label>
        <input class="form-control @error('visaNo.{{ $idx }}') is-invalid @enderror" type="text" name="visaNo[]" placeholder="Enter VISA No." required>
    </div>
    <div class="form-group col-md-6" >
        <label>Issue Date</label>
        <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate[]" placeholder="Enter Issue Date" required>
    </div>
    <div class="form-group col-md-6" >
        <label>VISA Amount</label>
        <input class="form-control @error('visaAmount.{{ $idx }}') is-invalid @enderror" type="number" name="visaAmount[]" placeholder="Enter Amount" required>
    </div>
    <div class="form-group col-md-6" >                    
        <label>Visa Gender Type</label>
        <select class="form-control  @error('gender.{{ $idx }}') is-invalid @enderror" name="gender[]" required>
            <option value=""> Select Gender </option>
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>
    <div class="form-group col-md-6" >                    
        <label>Country</label>
        <select class="form-control select2 @error('country.{{ $idx }}') is-invalid @enderror" name="country[]" data-placeholder="Select Country" required>
            <x-select-countries/>
        </select>
    </div>
</div>
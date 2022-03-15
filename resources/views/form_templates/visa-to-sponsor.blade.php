<hr>
<div class="form-group">
    <div class="form-row justify-content-between">
        <div class="form-group col-md-6" >
            <label>Job</label>
            <select class="form-control select2-ajax @error('job_name') is-invalid @enderror" name="job_name" id="job_name" required>
                <option value=""> Select Job </option>
                @foreach ($jobs as $job)
                    <option value="{{ $job->id }}" {{ (old("job_name") == $job->id ? "selected":"") }} > {{ $job->name }} </option>
                @endforeach
            </select>
            <div class="invalid-feedback"> @error('job_name') {{ $message }} @enderror </div>
        </div>
    </div>
    <div class="form-row justify-content-between form-body">
        <div class="form-group col-md-6" >
            <label>VISA No.</label>
            <input class="form-control @error('visaNo.0') is-invalid @enderror" type="text" name="visaNo" id="visaNo" placeholder="Enter VISA No." required>
        </div>
        <div class="form-group col-md-6" >
            <label>Issue Date</label>
            <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate" id="issueDate" placeholder="Enter Issue Date" required>
        </div>
        <div class="form-group col-md-6" >                    
            <label>Visa Gender Type</label>
            <select class="form-control  @error('gender.0') is-invalid @enderror" name="gender" id="gender" required>
                <option value=""> Select Gender </option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <div class="form-group col-md-6" >                    
            <label>Country</label>
            <select class="form-control select2-ajax @error('country.0') is-invalid @enderror" name="country" id="country" data-placeholder="Select Country" required>
                <x-select-countries/>
            </select>
        </div>
        <div class="form-group col-md-6" >
            <label>VISA Amount</label>
            <input onkeyup="add_candidate(this.value)" class="form-control @error('visaAmount.0') is-invalid @enderror" type="number" name="visaAmount" id="visaAmount" placeholder="Enter Amount" required>
        </div>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="comment" id="comment" cols="30" rows="3" placeholder="Any Remark"></textarea>
    </div>
</div>
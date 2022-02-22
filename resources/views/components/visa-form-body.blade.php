@props(['index' => $index])

<div>
    <div class="form-row justify-content-between form-body">
        <div class="form-group col-md-6" >
            <label>VISA No.</label>
            <input class="form-control @error('visaNo' . $index) is-invalid @enderror" type="text" name="visaNo[]" placeholder="Enter VISA No.">
        </div>
        <div class="form-group col-md-6" >
            <label>Issue Date</label>
            <input class="form-control hijri-date-input @error('issueDate' . $index) is-invalid @enderror" autocomplete="off" type="text" name="issueDate[]" placeholder="Enter Issue Date">
        </div>
        <div class="form-group col-md-6" >
            <label>VISA Amount</label>
            <input class="form-control @error('visaAmount' . $index) is-invalid @enderror" type="number" name="visaAmount[]" placeholder="Enter Amount">
        </div>
        <div class="form-group col-md-6" >                    
            <label>Visa Gender Type</label>
            <select class="form-control  @error('gender' . $index) is-invalid @enderror" name="gender[]">
                <option value=""> Select Gender </option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
    </div>
</div>
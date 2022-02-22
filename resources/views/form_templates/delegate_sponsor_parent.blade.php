<div class="row">
    <div class="form-group col-md-6" >
        <label>Delegate</label>
        <select class="form-control select2-ajax @error('delegateId') is-invalid @enderror" name="delegateId" id="delegateId" onchange="selectDelegateOffice(this.value)">
            <option value=""> Select Delegate </option>
            @foreach ($delegates as $delegate)
                <option value="{{ $delegate->id }}" {{ (old("delegateId") == $delegate->id ? "selected":"") }} >{{ $delegate->name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback"> @error('delegateId') {{ $message }} @enderror </div>
    </div>
    <div class="form-group col-md-6" >
        <label>Delegate Office</label>
        <select data-selected_office="{{ old('delegateOfficeId') }}" class="form-control select2-ajax @error('delegateOfficeId') is-invalid @enderror" name="delegateOfficeId" id="delegateOfficeId" >
            <option value=""> Select Delegate First </option>                    
        </select>
        <div class="invalid-feedback"> @error('delegateOfficeId') {{ $message }} @enderror </div>
    </div>
</div>
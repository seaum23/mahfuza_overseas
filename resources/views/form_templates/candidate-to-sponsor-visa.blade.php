<div class="form-row justify-content-center">
    <div class="form-group col-md-6" >
        <label>Assign Candidate</label>
        <select class="form-control select2-ajax @error('assigned_candidate') is-invalid @enderror" name="assigned_candidate" id="assigned_candidate" required>
            @if ($candidates->isEmpty())                
                <option value=""> No Candidate For This Job! </option>
            @else
                <option value=""> Select Candidate </option>
                @foreach ($candidates as $candidate)
                    <option value="{{ $candidate->id }}" > {{ $candidate->fName . ' ' . $candidate->lName }} </option>
                @endforeach                
            @endif
        </select>
    </div>
</div>
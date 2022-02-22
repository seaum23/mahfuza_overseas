<div class="row">
    <div class="form-group col-md-8" >
        <label>Agent</label>
        <select class="form-control select2-ajax @error('agent_id') is-invalid @enderror" name="agent_id" id="agent_id">
            <option value=""> Select Agent </option>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}" {{ (old("agent_id") == $agent->id ? "selected":"") }} >{{ $agent->full_name }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback"> @error('agent_id') {{ $message }} @enderror </div>
    </div>
</div>
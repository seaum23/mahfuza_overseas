<label>Offices</label>
<select class="form-control select2-ajax" name="agent_id" id="agent_id">
    <option value=""> Select Office </option>
    @foreach ($offices as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>
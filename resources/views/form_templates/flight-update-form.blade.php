<select class="form-control select2-ajax @error('flight_accounts') is-invalid @enderror" name="flight_accounts" id="flight_accounts">
    <option value=""> Select Account </option>
    @foreach ($accounts as $item)
        <option value="{{$item->id}}">{{$item->account}}</option>
    @endforeach
</select>
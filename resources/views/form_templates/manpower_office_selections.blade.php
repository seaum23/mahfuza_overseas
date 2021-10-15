<option value="">Select Manpowe Office</option>
@foreach ($manpowers as $manpower)
    <option value="{{ $manpower->id }}">{{ $manpower->name }}</option>
@endforeach
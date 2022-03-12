<div class="table-responsive">
    <table class="mb-0 table table-hover text-center" id="jobs_datatable">
        <thead>
            <tr>
                <th>Permission Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>
                    <div class="form-check">
                        <input onclick="permission_to_role({{$role}}, {{$item->id}})" class="form-check-input" type="checkbox" value="" id="role-{{$item->id}}" {{ (is_null($item->has_permission)) ? '' : 'checked'}}>
                        <label class="form-check-label" for="role-{{$item->id}}">
                        Has Permission
                        </label>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> 
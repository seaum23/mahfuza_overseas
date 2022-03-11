@extends('layouts.app')
@section('title')
Outside Office
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 mt-1">
        <div class="main-card mt-3 card">
            <div class="card-body"><h5 class="card-title">Outside Office</h5>
                {{-- @php
                if ($errors->any()) {
                    dd($errors);
                }
                @endphp --}}
                <form action="{{ route('outside-office.store') }}" method="post" class=" @if ($errors->any()) needs-validation @endif ">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label for="office_name">Office Name</label>
                            <input type="text" name="office_name" id="office_name" class="form-control @error('office_name') is-invalid @enderror" placeholder="Office Name" value="{{ old('office_name') }}">
                            <div class="invalid-feedback"> @error('office_name') {{ $message }} @enderror </div>
                        </div>
                        <div class="col-md-5">
                            <label for="office_name">Comment</label>
                            <input type="text" name="comment" id="comment" class="form-control" placeholder="Comment">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button class="btn btn-primary btn-sm">Add Office</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="mb-0 table table-hover">
                    <thead>
                        <tr>
                            <th>Office Name</th>
                            <th>Comment</th>
                            <th>Added At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->comment }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td><button data-toggle="modal" data-target="#edit_office_modal" class="btn btn-sm btn-info" onclick="edit_item('{{ $item->name }}', '{{ $item->id }}', '{{ $item->comment }}')"><i class="fas fa-edit"></i> Edit</button></td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
                {{ $offices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
{{-- Edit Office --}}
<div class="modal fade" id="edit_office_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="update_office">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="update_office_id" id="update_office_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="office_name">Office Name</label>
                            <input type="text" name="update_office_name" id="update_office_name" class="form-control @error('office_name') is-invalid @enderror" placeholder="Office Name" value="{{ old('office_name') }}">
                            <div id="update_office_name_invalid" class="invalid-feedback">  </div>
                        </div>
                        <div class="col-md-12">
                            <label for="office_name">Comment</label>
                            <input type="text" name="update_comment" id="update_comment" class="form-control" placeholder="Comment">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_button">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="update_close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $('#update_office').on('submit', (e) => {
        $('#update_office').removeClass('needs-validation');
        $('.invalid-feedback').removeClass('is-invalid');

        let id = $('#update_office_id').val();

        e.preventDefault();
        var form = $('#update_office')[0];
        var data = new FormData(form);
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '{{ url('/') }}' + '/outside-office/' + id ,
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("#update_button").html('<i class="fas fa-spinner fa-pulse"></i>');
                $("#update_button").prop('disabled', true);
            },
            success: function (response){
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false);
                location.reload();
            },
            error: function (xhr, status, error){
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false);
                $('#update_office').addClass('needs-validation');
                let errors = $.parseJSON(xhr.responseText);
                for (const [key, value] of Object.entries(errors.errors)) {
                    $(`#${key}`).addClass('is-invalid');
                    $(`#${key}_invalid`).html(value);
                }
            }
        });
    });

    let edit_item = (name, id, comment) => {

        $('#update_office').removeClass('needs-validation');
        $('#update_office_name').removeClass('is-invalid');
        $('#update_office_name').val(name);
        $('#update_comment').val(comment);
        $('#update_office_id').val(id);
    }
</script>
@endsection

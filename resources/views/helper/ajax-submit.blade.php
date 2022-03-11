<script>
    e.preventDefault();
    let id = $('#agent_id').val();
    $('#update_agent').removeClass('needs-validation');
    $('.invalid-feedback').removeClass('is-invalid');
    
    var form = $('#update_agent')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '{{ url('/') }}' + '/agent/' + id ,
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_agent").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_agent").prop('disabled', true);
        },
        success: function (response){
            location.reload();
        },
        error: function (xhr, status, error){
            $("#update_button_agent").html('Update');
            $("#update_button_agent").prop('disabled', false);
            $('#update_agent').addClass('needs-validation');
            let errors = $.parseJSON(xhr.responseText);
            for (const [key, value] of Object.entries(errors.errors)) {
                $(`#${key}`).addClass('is-invalid');
                $(`#${key}_invalid`).html(value);
            }
        }
    });
</script>
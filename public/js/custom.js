let random_password = () => {
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var randomPassword = '';
    for (i = 0; i < 6; i++) {
        randomPassword = randomPassword + chars.charAt(
            Math.floor(Math.random() * chars.length)
        );
    }
    return randomPassword;
}
$(document).ready(function(){
    $('#password_text').val(random_password());
    $('.select2').select2({
        width: '100%'
    });
})

let change_pass_modal = (id) => {
    $('#employeeId').val(id);
}

$('#restPassForm').on('submit', function(){
    $('#restPassForm').removeClass('needs-validation');
    $('#password_confirmation_message').html('');
    $('#password_mismatch_message').html('');
    $('#old_password').removeClass('is-invalid');
    $('#password').removeClass('is-invalid'); 
                   
    event.preventDefault();
    var form = $('#restPassForm')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: 'change-password',
        data: data,
        processData: false,
        contentType: false,
        success: function (response){
            if(response.error != ''){
                $('#password_confirmation_message').html(response.error);
                $('#restPassForm').addClass('needs-validation');
                $('#password').addClass('is-invalid');                
            }else if(response.mismatch != ''){
                $('#password_mismatch_message').html(response.mismatch);
                $('#restPassForm').addClass('needs-validation');
                $('#old_password').addClass('is-invalid');
            }else{
                $('#change_password_modal_close').click();
                success_alert('Success', 'Successfully Changed Password!')
            }
        }
    });
})

let edit_employee = (id) => {
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/employee-update-fetch/' + id,
        success: function (response){
            let info = JSON.parse(response);
            $('#name').val(info.name);
            $('#officeId').val(info.employee_id);
            $('#phoneNumber').val(info.phone);
            $('#address').val(info.address);
            $('#designation').html(info.designation);            
            $('#edit_employee_form').attr('action', '/employee-update/' + info.id);
        }
    });
}

$('#add_office').click(function(){
    // create row
    var div = document.createElement("DIV");
    div.setAttribute('class', 'form-group row');
    // create first col-sm
    var div_col_1 = document.createElement("DIV");
    div_col_1.setAttribute('class', 'col-sm');
    var label = document.createElement("LABEL");
    var text = document.createTextNode("Office: ");
    label.appendChild(text);
    div_col_1.appendChild(label);
    var input = document.createElement("INPUT");
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'delegateOffice[]');
    input.setAttribute('class', 'form-control');
    input.setAttribute('placeholder', 'Office Name');
    input.setAttribute('required','');
    div_col_1.appendChild(input);
    div.appendChild(div_col_1);
    // second input
    var div_col_1 = document.createElement("DIV");
    div_col_1.setAttribute('class', 'col-sm');
    var label = document.createElement("LABEL");
    var text = document.createTextNode("License Number: ");
    label.appendChild(text);
    div_col_1.appendChild(label);
    var input = document.createElement("INPUT");
    input.setAttribute('type', 'text');
    input.setAttribute('name', 'licenseNumber[]');
    input.setAttribute('class', 'form-control');
    input.setAttribute('placeholder', 'License Number');
    input.setAttribute('required','');
    div_col_1.appendChild(input);
    div.appendChild(div_col_1);
    $('#officeDiv').append(div);
});
$('#remove_office').click(function(){
    $('#officeDiv').children().last().remove();
});


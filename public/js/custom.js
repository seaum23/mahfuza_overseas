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

/**
 * Delegate & Delegate office CRUD
 */

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


$('#delete_delegate_office').on('submit', function(){
    event.preventDefault();
    let delegateOfficeId = $('#delegateOfficeIdModal').val();
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/delegate/office/destroy/' + delegateOfficeId,
		beforeSend:function(){
            $("#update_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button").prop('disabled', true);
            $("#delete_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#delete_button").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                danger_alert('Error', 'Something went wrong!');
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false); 
                $("#delete_button").html('Delete');
                $("#delete_button").prop('disabled', false);
            }else{
                location.reload();
            }
        }
    });
})

$('#update_delegate_office').on('submit', function(){
    event.preventDefault();
    let delegateOfficeId = $('#delegateOfficeIdModal').val();
    let office_name = $('#officeNameModal').val();
    let license_number = $('#licenseNumModal').val();
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/delegate/office/update/' + delegateOfficeId,
        data: {office_name, license_number},
		beforeSend:function(){
            $("#update_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button").prop('disabled', true);
            $("#delete_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#delete_button").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                danger_alert('Error', 'Something went wrong!');
                $("#update_button").html('Update');
                $("#update_button").prop('disabled', false);                
                $("#delete_button").html('Delete');
                $("#delete_button").prop('disabled', false);
            }else{
                location.reload();
            }
        }
    });
})

$('#add_delegate_office_form').on('submit', function(){
    event.preventDefault();
    let id = $('#delegate_id_modal').val();
    $('#add_delegate_office_form').removeClass('needs-validation');
    $('#error_message').hide();
    $('#error_message').html('');
    
    var form = $('#add_delegate_office_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/delegate/office/add/' + id,        
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#add_office_button").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#add_office_button").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                $('#add_delegate_office_form').addClass('needs-validation');
                $('#error_message').show();
                $('#error_message').html(info.message);
                $("#add_office_button").html('Submit');
                $("#add_office_button").prop('disabled', false);
            }else{
                location.reload();
            }
        }
    });
});

let add_office_delegatge = (id) => {    
    $('#delegate_id_modal').val(id);
}

function change_delegate_office(id, name, license){
    $('#delegateOfficeIdModal').val(id);
    $('#officeNameModal').val(name);
    $('#licenseNumModal').val(license);
}

function update_delegate(id, name, country, state, comment){
    $('#delegate_id_update').val(id);
    $('#delegateName').val(name);
    $('#delegateCountry').val(country);
    $('#delegateState').val(state);
    $('#comment').val(comment);    
}

$('#update_delegate').on('submit', function(){
    event.preventDefault();
    let id = $('#delegate_id_update').val();
    $('#update_delegate').removeClass('needs-validation');
    console.log('test');
    
    var form = $('#update_delegate')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/delegate/' + id + '/update',        
        data: data,
        processData: false,
        contentType: false,
		beforeSend:function(){
            $("#update_button_delegate").html('<i class="fas fa-spinner fa-pulse"></i>');
            $("#update_button_delegate").prop('disabled', true);
        },
        success: function (response){
            let info = JSON.parse(response);
            if(info.error){
                $('#update_delegate').addClass('needs-validation');
                $("#update_button_delegate").html('Update');
                $("#update_button_delegate").prop('disabled', false);
            }else{
                location.reload();
            }
        }
    });
});

/**
 * End Delegate & Delegate Office CRUD
*/

/**
 * Start Sponsor & Sponsor VISA CRUD
 */

function selectDelegateOffice(delegate_id){
    let selected_office = $('#delegateOfficeId').data('selected_office');
    $.ajax({
        type: 'post',
        enctype: 'multipart/form-data',
        url: '/sponsor/' + delegate_id + '/fetch_delegate_office',
        data: {delegate_id},
        success: function (response){
            $('#delegateOfficeId').find('option').remove();
            let info = JSON.parse(response);
            $('#delegateOfficeId').append(`<option value="">Select Delegate Office</option>`);
            info.forEach(element => {
                if(selected_office == element.id){
                    $('#delegateOfficeId').append(`<option value="${element.id}" selected>${element.name}</option>`);
                }else{
                    $('#delegateOfficeId').append(`<option value="${element.id}">${element.name}</option>`);
                }
            });
        }
    });
}

var sponsor_list_datatable = $('#sponsor_list_datatable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "order": [[0, "desc"]],
    "info": true,
    "ScrollX": true,
    "processing": true,
    "serverSide": true,
    "lengthMenu": [
        [10, 25, 50, 100, 500],
        [10, 25, 50, 100, 500]
    ],
    ajax: {
        url: "/sponsor/list/datatable",
        data: {test: 'yes'}
    },                        
});

/**
 * End Sponsor & Sponsor VISA CRUD
 */


/**
 * Trigger change of selet 2
 */

 $('.select2').trigger('change');

 /**
  * Trigger alert for those that are coming from Controller
  */

let trigget_alert = () => {
    if ( typeof document.body.dataset.alert === undefined){
        return false;
    }

    if(document.body.dataset.alertType == 'success'){
        success_alert('Success', document.body.dataset.alertMessage);
    }
}

window.onload = trigget_alert();
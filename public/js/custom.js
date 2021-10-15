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


// $(".timePicker").timepicker();

// $('.datepicker').datepicker({
//     format: 'yyyy/mm/dd',
//     todayHighlight:'TRUE',
//     autoclose: true,
// });

$(function () {

    initHijrDatePicker();

    initHijrDatePickerDefault();

    $('.disable-date').hijriDatePicker({

        minDate:"2020-01-01",
        maxDate:"2021-01-01",
        viewMode:"years",
        hijri:true,
        debug:true
    });

});

function initHijrDatePicker() {

    $(".hijri-date-input").hijriDatePicker({
        locale: "ar-sa",
        format: "DD-MM-YYYY",
        hijriFormat:"iYYYY-iMM-iDD",
        dayViewHeaderFormat: "MMMM YYYY",
        hijriDayViewHeaderFormat: "iMMMM iYYYY",
        showSwitcher: true,
        allowInputToggle: true,
        showTodayButton: false,
        useCurrent: true,
        isRTL: false,
        viewMode:'months',
        keepOpen: false,
        hijri: false,
        debug: true,
        showClear: true,
        showTodayButton: true,
        showClose: true
    });
}

function initHijrDatePickerDefault() {
    $(".hijri-date-default").hijriDatePicker();
}



/**
 * Trigger change of selet 2
 */
 $(document).ready(function() {
    $('.select2').select2();
 })
 
 $('.select2').trigger('change');


 
/**
  * Trigger alert when redirecting from Controller
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

/**
 * 
 * Filepond configuration!
 * 
 */

// First register any plugins
$.fn.filepond.registerPlugin(FilePondPluginImagePreview);        
    
// Generic file-pond
$('.my-pond').filepond({
    credits: false,
    'allowMultiple': false
});

// Generic file-pond multiple
$('.my-pond-multiple').filepond({
    credits: false,
    'allowMultiple': true
});


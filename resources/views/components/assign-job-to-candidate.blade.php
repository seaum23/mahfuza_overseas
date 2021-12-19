<div class="row">
    <div class="form-group col-md-6">
        <label>Job Type. <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i> </label>
        <select class="form-control ms select2" name="job_type" id="job_type" onchange="get_manpower_office(this.value)"  data-placeholder="Select Job" >
            <option value=""></option>
            @foreach ($jobs as $job)
                <option value="{{ $job->id }}">{{ $job->name . ' - ' . $job->credit_type }}</option>
            @endforeach
        </select>
        <div id="job_type_invalid" class="invalid-feedback"> </div>
    </div>
    <div class="col-md-6">
        <label for="manpower"> Manpower Office <i class="fa fa-asterisk fa-xs fa-xxs text-danger" ></i></label>
        <select class="form-control select2" id="manpower" name="manpower" style="width: 100%" >
            <option value=""> Select Job Type First </option>                                            
        </select>
        <div id="manpower_invalid" class="invalid-feedback"> </div>
    </div>
</div>
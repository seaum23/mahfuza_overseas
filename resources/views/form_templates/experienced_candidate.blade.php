<div class="col-md-4">
    <label>Departure Seal <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
    <input class="my-pond-ajax form-control-file" type="file" name="departureSealFile" id="departureSealFile">
</div>
<div class="col-md-4">
    <label>Arrival Seal <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
    <input class="my-pond-ajax form-control-file" type="file" name="arrivalSealFile" id="arrivalSealFile">
</div>
<div class="col-md-6">
    <label>Departure Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
    <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="departureDate" id="departureDate" placeholder="yyyy/mm/dd"/>
    <div id="departureDate_invalid" class="invalid-feedback"> </div>
</div>
<div class="col-md-6">
    <label>Arrival Date <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
    <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="arrivalDate" placeholder="yyyy/mm/dd"/>
</div>               
<div class="col-md-6 mt-3">
    <label for="">Travelled Country <small>Seperate with Comma (,)</small> <i class="fa fa-asterisk fa-xs fa-xxs text-danger" aria-hidden="true"></i></label>
    <select class="form-control select2-ajax" name="expCountry[]" id="expCountry" multiple>
        <x-select-countries/>
    </select>
</div>
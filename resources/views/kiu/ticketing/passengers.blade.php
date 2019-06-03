
 <div class="row">
    <p style="font-size:250%; color:#87bc24; margin-bottom: 20px;" align="center">
        <img src="{{ asset('img/bolet-2.png') }}"> {{ trans('kiu.passengers.pax') }} {{ $passenger->RPH }}
    </p>          
    <div class="col-lg-12">
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('general.pax_type.title')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="@lang('general.pax_type.' . $passenger->Customer->Type)" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('register.first_name')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $passenger->Customer->PersonName->GivenName }}" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('register.last_name')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $passenger->Customer->PersonName->Surname }}" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        @if(($passenger->Customer->Document->Type) == 'PP')
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('register.passport')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $passenger->Customer->Document->ID }}" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        @else
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('register.dni')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="{{ $passenger->Customer->Document->ID }}" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        @endif
        @if(!is_null($ticketing->timelimit))
        <div class="form-group row">
            <label for="name" class="col-xs-1 col-sm-4 col-md-4 regispasenger1" style="text-align: left;">@lang('kiu.itineraries.timelimit')</label>
                <div class="col-xs-8 col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <input id="type" type="text" class="form-control" name="type" value="{{ \Carbon\Carbon::parse(str_replace('T', ' ', $ticketing->timelimit))->format('d/m/Y H:i a') }}" autocomplete="off" disabled="true" required>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
</div>
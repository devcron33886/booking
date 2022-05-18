
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"/>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet"/>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
          rel="stylesheet"/>
    <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Arvo', serif;
            background-color: #f8fafc;
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }
    </style>
</head>
<body>
<main class="py-5 bg-white">
    <h1 class="visually-hidden">BIKO & ASSOCIATES</h1>

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('images/Biko logo.png')}}" alt=" BIKO ASSOCIATES" width="250"
             height="100">
        <h1 class="display-5 fw-bold">BIKO & ASSOCIATES</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Welcome to BIKO & ASSOCIATES BOOKING APP</p>

        </div>
    </div>
    <div class="container col-lg-11 col-md-6 col-sm-4 py-4">
        <div class="row justify-content-between">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
            @endif
                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
        </div>
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card card-info card-outline">
                        <div class="card-header"><h5
                                class="text-black text-capitalize">{{ $service->service_name ?? ''}}</h5>

                        </div>
                        <div class="card-body">
                            <p class="text-sm"
                               style="text-transform: lowercase;"> {{ Str::limit($service->service_description ?? '', 40) }}
                            </p>
                            <div class="row">
                                <div class="col-8">
                                    <p class="text-sm text-black-500">
                                        <strong>
                                            Price: {{ App\Models\Service::CURRENCY_SELECT[$service->currency] ?? '' }} {{ number_format($service->price) }}
                                            / 1 Hour
                                            @if($service->status == 1)
                                                <span class="fa fa-globe" data-toggle="tooltip" data-placement="top"
                                                      title="This is an online meeting">
                                                </span>
                                            @else
                                                <span class="fa fa-users" data-toggle="tooltip" data-placement="top"
                                                      title="You can come to our office and have a meeting">
                                                </span>
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-4">

                                    <p class="text-sm"><span class="fa fa-clock" data-toggle="tooltip"
                                                             data-placement="top"
                                                             title="This meeting can take {{ $service->duration }}"></span> {{ $service->duration }}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary"
                               onclick="$('#service').val({{ $service->id }}); $('form').show()">
                                Book now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="col-md-8">
            <form class="card" method="POST" action="{{ route('pay') }}" style="{{ $errors->isEmpty() ? 'display:none;' : '' }}">
                @csrf
                <div class="card-header"><h4 class="text-center">Book your date to meet.</h4></div>
                <div class="card-body">
                    <input type="hidden" id="service" name="service_id" value="{{ old('service_id') }}">

                    @error('alert')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="row">
                        <div class="form-group col-6">

                            <label for="staff_id">{{ trans('cruds.booking.fields.staff') }} (Optional)</label>
                            <select class="form-select {{ $errors->has('staff') ? 'is-invalid' : '' }}" name="staff_id"
                                    id="staff_id">
                                @foreach($staff as $id => $entry)
                                    <option
                                        value="{{ $id }}" {{ old('staff_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('staff'))
                                <span class="text-danger">{{ $errors->first('staff') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.staff_helper') }}</span>
                        </div>
                        <div class="form-group col-6">
                            <label class="required"
                                   for="meeting_time">{{ trans('cruds.booking.fields.meeting_time') }}</label>
                            <input class="form-control datetime {{ $errors->has('meeting_time') ? 'is-invalid' : '' }}"
                                   type="text" name="meeting_time" id="meeting_time" value="{{ old('meeting_time') }}"
                                   required>
                            @if($errors->has('meeting_time'))
                                <span class="text-danger">{{ $errors->first('meeting_time') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.meeting_time_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="required" for="email">{{ trans('cruds.booking.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                   name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group col-6">
                            <label class="required" for="address">{{ trans('cruds.booking.fields.address') }}</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                                   name="address" id="address" value="{{ old('address', '') }}" required>
                            @if($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.address_helper') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="required" for="name">{{ trans('cruds.booking.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                   name="name"
                                   id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.name_helper') }}</span>
                        </div>

                        <div class="form-group col-6">
                            <label class="required"
                                   for="phone_number">{{ trans('cruds.booking.fields.phone_number') }}</label>
                            <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                   type="tel"
                                   name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                            @if($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.booking.fields.phone_number_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">{{ trans('cruds.booking.fields.notes') }}</label>
                        <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes"
                                  id="notes">{{ old('notes') }}</textarea>
                        @if($errors->has('notes'))
                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.booking.fields.notes_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('privacy') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="checkbox" name="privacy" id="privacy" value="1"
                                   required {{ old('privacy', 0) == 1 ? 'checked' : '' }}>
                            <label class="required form-check-label"
                                   for="privacy">We value your privacy
                                We and our partners store and/or access information on a device, such as cookies and
                                process personal data, such as unique identifiers and standard information sent by a
                                device for personalized ads and content, ad and content measurement, and audience
                                insights, as well as to develop and improve products.
                                With your permission we and our partners may use precise geolocation data and
                                identification through device scanning. You may click to consent to our and our
                                partners’ processing as described above. Alternatively you may access more detailed
                                information and change your preferences before consenting or to refuse consenting.
                                Please note that some processing of your personal data may not require your consent, but
                                you have a right to object to such processing. Your preferences will apply to this
                                website only. You can change your preferences at any time by returning to this site or
                                visit our privacy policy
                            </label>
                        </div>
                        @if($errors->has('privacy'))
                            <span class="text-danger">{{ $errors->first('privacy') }}</span>
                        @endif

                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">
                        Save your Booking and Pay
                    </button>
                </div>
            </form>
        </div>

    </div>
    <div class="container col-md-11">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-3 mb-0 text-muted">&copy; {{ date('Y') }} {{ trans('global.allRightsReserved') }}</p>

            <ul class="nav col-md-9 justify-content-end text-sm">
                <li class="nav-item">Makuza Peace Plaza , Tower B, 9th Floor, KN 4 Ave, Kigali, Rwanda | +250738828020</li>

                <li class="nav-item"><a href="https://www.bikoassociates.net/" class="nav-link px-2 text-muted">Biko & Associates</a></li>
                <li class="nav-item"><a href="https://www.bikoassociates.net/terms-and-conditions/" class="nav-link px-2 text-muted">Terms and Conditions</a></li>
                <li class="nav-item"><a href="https://www.bikoassociates.net/privacy-policy/" class="nav-link px-2 text-muted">Privacy Policy</a></li>
            </ul>
        </footer>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

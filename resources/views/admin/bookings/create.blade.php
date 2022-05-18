@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.booking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="service_id">{{ trans('cruds.booking.fields.service') }}</label>
                <select class="form-control select2 {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service_id" id="service_id" required>
                    @foreach($services as $id => $entry)
                        <option value="{{ $id }}" {{ old('service_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('service'))
                    <span class="text-danger">{{ $errors->first('service') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="staff_id">{{ trans('cruds.booking.fields.staff') }}</label>
                <select class="form-control select2 {{ $errors->has('staff') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @foreach($staff as $id => $entry)
                        <option value="{{ $id }}" {{ old('staff_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('staff'))
                    <span class="text-danger">{{ $errors->first('staff') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.staff_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meeting_time">{{ trans('cruds.booking.fields.meeting_time') }}</label>
                <input class="form-control datetime {{ $errors->has('meeting_time') ? 'is-invalid' : '' }}" type="text" name="meeting_time" id="meeting_time" value="{{ old('meeting_time') }}" required>
                @if($errors->has('meeting_time'))
                    <span class="text-danger">{{ $errors->first('meeting_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.meeting_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.booking.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.booking.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.booking.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.booking.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.booking.fields.notes') }}</label>
                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">{{ old('notes') }}</textarea>
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.booking.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Booking::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('privacy') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="privacy" id="privacy" value="1" required {{ old('privacy', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="privacy">{{ trans('cruds.booking.fields.privacy') }}</label>
                </div>
                @if($errors->has('privacy'))
                    <span class="text-danger">{{ $errors->first('privacy') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.booking.fields.privacy_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
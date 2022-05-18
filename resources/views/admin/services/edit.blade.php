@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.service.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.services.update", [$service->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="service_name">{{ trans('cruds.service.fields.service_name') }}</label>
                <input class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}" type="text" name="service_name" id="service_name" value="{{ old('service_name', $service->service_name) }}" required>
                @if($errors->has('service_name'))
                    <span class="text-danger">{{ $errors->first('service_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.service.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="text" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" required>
                @if($errors->has('duration'))
                    <span class="text-danger">{{ $errors->first('duration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.service.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $service->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.service.fields.currency') }}</label>
                <select class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" name="currency" id="currency">
                    <option value disabled {{ old('currency', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Service::CURRENCY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('currency', $service->currency) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('currency'))
                    <span class="text-danger">{{ $errors->first('currency') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.currency_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.service.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Service::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $service->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="service_description">{{ trans('cruds.service.fields.service_description') }}</label>
                <textarea class="form-control {{ $errors->has('service_description') ? 'is-invalid' : '' }}" name="service_description" id="service_description" required>{{ old('service_description', $service->service_description) }}</textarea>
                @if($errors->has('service_description'))
                    <span class="text-danger">{{ $errors->first('service_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_description_helper') }}</span>
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
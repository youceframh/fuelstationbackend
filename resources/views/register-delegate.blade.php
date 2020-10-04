@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('ارسال تقرير') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/delegate','method' => 'post')) }}
                        @csrf
                    @if(isset($success))
                    <div class="alert alert-success" role="alert">
  {{$success}}
</div>
@endif
@if(isset($failed))
                    <div class="alert alert-danger" role="alert">
  {{$failed}}
</div>
                    @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="typeofjob" class="col-md-4 col-form-label text-md-right">{{ __('نوع العمل') }}</label>

                            <div class="col-md-6">
                                <input id="typeofjob" type="text" class="form-control @error('typeofjob') is-invalid @enderror" name="typeofjob" value="{{ old('typeofjob') }}" required autocomplete="typeofjob">

                                @error('typeofjob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="phonenbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الهاتف') }}</label>

                            <div class="col-md-6">
                                <input id="phonenbr" type="text" class="form-control @error('phonenbr') is-invalid @enderror" name="phonenbr" required autocomplete="phonenbr">

                                @error('phonenbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('الشركة') }}</label>

                            <div class="col-md-6">

                            <select id="company" type="date" class="form-control @error('company') is-invalid @enderror" name="company" required autocomplete="company">
                                    @foreach ($companies as $company)
                                    <option value="{{$company['idcompanies']}}">{{$company['commercial name']}}</option>
                                    @endforeach
                                </select>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('سجل') }}
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

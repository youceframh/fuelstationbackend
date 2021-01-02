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
                {{ Form::open( array('url' => '/report/company','method' => 'post')) }}
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
                            <label for="reporttype" class="col-md-4 col-form-label text-md-right">{{ __('نوع التقرير') }}</label>

                            <div class="col-md-6">
                                <input id="reporttype" type="text" class="form-control @error('reporttype') is-invalid @enderror" name="reporttype" value="{{ old('reporttype') }}" required autocomplete="reporttype" autofocus>

                                @error('reporttype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="report" class="col-md-4 col-form-label text-md-right">{{ __('التقرير') }}</label>

                            <div class="col-md-6">
                                <input id="report" type="text" class="form-control @error('report') is-invalid @enderror" name="report" value="{{ old('report') }}" required autocomplete="report">

                                @error('report')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="datePicker" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ اليوم') }}</label>

                            <div class="col-md-6">
                                <input id="datePicker" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control @error('datePicker') is-invalid @enderror" name="datePicker" required autocomplete="datePicker" disabled>

                                @error('datePicker')
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

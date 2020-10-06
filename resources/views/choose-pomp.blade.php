@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('سجل دورية') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/patrol','method' => 'get')) }}
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
                            <label for="pompserial" class="col-md-4 col-form-label text-md-right">{{ __('المضخة') }}</label>

                            <div class="col-md-6">

                            <select id="pompserial" type="text" class="form-control @error('pompserial') is-invalid @enderror" name="pompserial" required autocomplete="pompserial">
                            <option value=""></option>
                                    @foreach ($pomps as $pomp)
                                    <option value="{{$pomp['serial']}}">{{$pomp['serial']}}</option>
                                    @endforeach
                                </select>

                                @error('pompserial')
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

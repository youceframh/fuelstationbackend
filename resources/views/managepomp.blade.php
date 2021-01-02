@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('سجل وردية') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/managepomps','method' => 'post')) }}
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
                            <label for="pomp" class="col-md-4 col-form-label text-md-right">{{ __('المضخة') }}</label>

                            <div class="col-md-6">

                            <select id="pomp" type="text" class="form-control @error('pomp') is-invalid @enderror" name="pompserial" required autocomplete="pomp" readonly>
                            <option value="{{$pompserial}}&{{$pomp_fuelType}}">{{$pompserial}}</option>
                                </select>

                                @error('pomp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('الحال') }}</label>

                            <div class="col-md-6">

                            <select id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" required autocomplete="status">
                            <option value="true">فعالة</option>
                            <option value="false">غير فعالة</option>
                                </select>

                                @error('pomp')
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

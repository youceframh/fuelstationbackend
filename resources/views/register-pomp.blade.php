@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل مضخة') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/pomp','method' => 'post')) }}
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
                            <label for="pompserial" class="col-md-4 col-form-label text-md-right">{{ __('رقم المضخة التسلسي') }}</label>

                            <div class="col-md-6">
                                <input id="pompserial" type="text" class="form-control @error('pompserial') is-invalid @enderror" name="pompserial" value="{{ old('pompserial') }}" required autocomplete="pompserial" autofocus>

                                @error('pompserial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="pomplastrecord" class="col-md-4 col-form-label text-md-right">{{ __('اخر تسجيل للمضحة') }}</label>

                            <div class="col-md-6">
                                <input id="pomplastrecord" type="text" class="form-control @error('pomplastrecord') is-invalid @enderror" name="pomplastrecord" value="{{ old('pomplastrecord') }}" required autocomplete="pomplastrecord">

                                @error('pomplastrecord')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="tanknbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الخزان التابعة له') }}</label>

                            <div class="col-md-6">
                            @foreach ($tanks as $tank)
                            <div style="    display: flex;
    flex-direction: row-revers">
                            <span style="align-self: center;">{{$tank->tank_number}}</span>
                            <input type="checkbox" style="width: 15%;" id="tanknbr" value="{{$tank->tank_number}}" type="date" class="form-control @error('tanknbr') is-invalid @enderror" name="tanknbr[]" autocomplete="tanknbr">
                            </div>
                            @endforeach

                                @error('tanknbr')
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

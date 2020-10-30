@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل خزان') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/tank','method' => 'post')) }}
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
                            <label for="tanknbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الخزان') }}</label>

                            <div class="col-md-6">
                                <input id="tanknbr" type="text" class="form-control @error('tanknbr') is-invalid @enderror" name="tanknbr" value="{{ old('tanknbr') }}" required autocomplete="tanknbr" autofocus>

                                @error('tanknbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="volumeoftank" class="col-md-4 col-form-label text-md-right">{{ __('حجم الخزان') }}</label>

                            <div class="col-md-6">
                                <input id="volumeoftank" type="text" class="form-control @error('volumeoftank') is-invalid @enderror" name="volumeoftank" value="{{ old('volumeoftank') }}" required autocomplete="volumeoftank">

                                @error('volumeoftank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="fueltype" class="col-md-4 col-form-label text-md-right">{{ __('نوع البترول') }}</label>

                            <div class="col-md-6">

                                <select id="fueltype" type="text" class="form-control @error('fueltype') is-invalid @enderror" name="fueltype" required autocomplete="fueltype">
                                <option value="essence91">بنزين 91</option>
                                <option value="essence95">بنزين 95</option>
                                <option value="diesel">ديزل</option>
                                <option value="gasoline">غاز</option>
                                </select>

                                @error('fueltype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="reliedtoannex" class="col-md-4 col-form-label text-md-right">{{ __('تابع الى الفرع') }}</label>

                            <div class="col-md-6">
                                <select id="reliedtoannex" type="date" class="form-control @error('reliedtoannex') is-invalid @enderror" name="reliedtoannex" required autocomplete="reliedtoannex">
                                    @foreach ($annexes as $annex)
                                    <option value="{{$annex->idannexes}}">{{$annex->name}}</option>
                                    @endforeach
                                </select>

                                @error('reliedtoannex')
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

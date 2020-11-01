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
                {{ Form::open( array('url' => '/fuelprices','method' => 'post')) }}
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
                            <label for="fueltype" class="col-md-4 col-form-label text-md-right">{{ __('نوع البترول') }}</label>

                            <div class="col-md-6">

                            <select id="fueltype" class="form-control @error('fueltype') is-invalid @enderror" name="fueltype" required autocomplete="fueltype">
                                    <option value="gasoline">غاز</option>
                                    <option value="diesel">ديزل</option>
                                    <option value="essence91">بنزين 91</option>
                                    <option value="essence95">بنزين 95</option>
                                </select>

                                @error('fueltype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newprice" class="col-md-4 col-form-label text-md-right">{{ __('السعر الجديد') }}</label>

                            <div class="col-md-6">
                                <input id="newprice" type="text" class="form-control @error('newprice') is-invalid @enderror" name="newprice" value="{{ old('newprice') }}" required autocomplete="newprice" autofocus>

                                @error('newprice')
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

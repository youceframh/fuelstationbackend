@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل  المحلات') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/shop', 'files' => false,'method' => 'post')) }}
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
                            <label for="shopnbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم المحل') }}</label>

                            <div class="col-md-6">
                                <input id="shopnbr" type="text" class="form-control @error('shopnbr') is-invalid @enderror" name="shopnbr" value="{{ old('shopnbr') }}" required autocomplete="shopnbr" autofocus>

                                @error('shopnbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="shopsurface" class="col-md-4 col-form-label text-md-right">{{ __('مساحة المحل') }}</label>

                            <div class="col-md-6">
                                <input id="shopsurface" type="text" class="form-control @error('shopsurface') is-invalid @enderror" name="shopsurface" value="{{ old('shopsurface') }}" required autocomplete="shopsurface">

                                @error('shopsurface')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shoptype" class="col-md-4 col-form-label text-md-right">{{ __('نوع المحل') }}</label>

                            <div class="col-md-6">
                                <input id="shoptype" type="text" class="form-control @error('shoptype') is-invalid @enderror" name="shoptype" value="{{ old('shoptype') }}" required autocomplete="shoptype">

                                @error('shoptype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shopprice" class="col-md-4 col-form-label text-md-right">{{ __('ثمن المحل') }}</label>

                            <div class="col-md-6">
                                <input id="shopprice" type="text" class="form-control @error('shopprice') is-invalid @enderror" name="shopprice" value="{{ old('shopprice') }}" required autocomplete="shopprice">

                                @error('shopprice')
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

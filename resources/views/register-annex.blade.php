@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل الموردين') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/annex','method' => 'post')) }}
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الكامل') }}</label>

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
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('عنوان المنزل') }}</label>

                            <div class="col-md-6">
                                <input id="adress" type="text" class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}" required autocomplete="adress">

                                @error('adress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('البلد') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" required autocomplete="country">

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('المدينة') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('رقم الجوال') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('الايمايل') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row" style="display:flex;text-align:right;">
                            <label for="renttype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الايجار') }}</label>

                            <div class="col-md-6">

                            <select id="renttype" class="form-control @error('renttype') is-invalid @enderror" name="renttype" id="renttype" required autocomplete="renttype">
                                <option value="BUY">شراء</option>
                                <option value="RENT">كراء</option>
                            </select>

                                @error('renttype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    <!--RENT SECTION-->
    <div id="rentsection">
                        <div class="form-group row">
                            <label for="rentdatestart" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ الكراء') }}</label>

                            <div class="col-md-6">
                                <input id="rentdatestart" type="date" class="form-control @error('rentdatestart') is-invalid @enderror" name="rentdatestart" autocomplete="rentdatestart">

                                @error('rentdatestart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentdateend" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ انتهاء الكراء') }}</label>

                            <div class="col-md-6">
                                <input id="rentdateend" type="date" class="form-control @error('rentdateend') is-invalid @enderror" name="rentdateend" autocomplete="rentdateend">

                                @error('rentdateend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentprice" class="col-md-4 col-form-label text-md-right">{{ __('السعر') }}</label>

                            <div class="col-md-6">
                                <input id="rentprice" type="text" class="form-control @error('rentprice') is-invalid @enderror" name="rentprice" autocomplete="rentprice">

                                @error('rentprice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentorname" class="col-md-4 col-form-label text-md-right">{{ __('الاسم') }}</label>

                            <div class="col-md-6">
                                <input id="rentorname" type="text" class="form-control @error('rentorname') is-invalid @enderror" name="rentorname" autocomplete="rentorname">

                                @error('rentorname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentorphone" class="col-md-4 col-form-label text-md-right">{{ __('رقم جوال الكاري') }}</label>

                            <div class="col-md-6">
                                <input id="rentorphone" type="text" class="form-control @error('rentorphone') is-invalid @enderror" name="rentorphone" autocomplete="rentorphone">

                                @error('rentorphone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rentinovicenbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الفاتورة') }}</label>

                            <div class="col-md-6">
                                <input id="rentinovicenbr" type="text" class="form-control @error('rentinovicenbr') is-invalid @enderror" name="rentinovicenbr" autocomplete="rentinovicenbr">

                                @error('rentinovicenbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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

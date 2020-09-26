@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل  الموظفين') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/employee', 'files' => false,'method' => 'post')) }}
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
                            <label for="full name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الكامل') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="full name" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="national id card number" class="col-md-4 col-form-label text-md-right">{{ __('رقم بطاقة التعريف الوطنية') }}</label>

                            <div class="col-md-6">
                                <input id="nationalidcardnumber" type="number" class="form-control @error('nationalidcardnumber') is-invalid @enderror" name="nationalidcardnumber" value="{{ old('nationalidcardnumber') }}" required autocomplete="national id card number" autofocus>

                                @error('nationalidcardnumber')
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
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('عنوان المنزل ') }}</label>

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
                            <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('الراتب') }}</label>

                            <div class="col-md-6">
                                <input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required autocomplete="salary">

                                @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobstartdate" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ بدء العمل') }}</label>

                            <div class="col-md-6">
                                <input id="jobstartdate" type="date" class="form-control @error('jobstartdate') is-invalid @enderror" name="jobstartdate" value="{{ old('jobstartdate') }}" required autocomplete="jobstartdate">

                                @error('jobstartdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patroltype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الدورية') }}</label>

                            <div class="col-md-6">
                                <input id="patroltype" type="text" class="form-control @error('patroltype') is-invalid @enderror" name="patroltype" value="{{ old('patroltype') }}" required autocomplete="patroltype">

                                @error('patroltype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="closepersoname" class="col-md-4 col-form-label text-md-right">{{ __('اسم شخص قريب من الموظف') }}</label>

                            <div class="col-md-6">
                                <input id="closepersoname" type="text" class="form-control @error('closepersoname') is-invalid @enderror" name="closepersoname" value="{{ old('closepersoname') }}" required autocomplete="closepersoname">

                                @error('closepersoname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="closepersonumber" class="col-md-4 col-form-label text-md-right">{{ __('رقم شخص قريب من الموظف') }}</label>

                            <div class="col-md-6">
                                <input id="closepersonumber" type="text" class="form-control @error('closepersonumber') is-invalid @enderror" name="closepersonumber" value="{{ old('closepersonumber') }}" required autocomplete="closepersonumber">

                                @error('closepersonumber')
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

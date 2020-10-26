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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('الايمايل') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    @php
    function randomPassword() {
    $alphabet = 'abc_-defghijklmnopqrstuv/.wxyzABCDEF$$GHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i <= 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
    @endphp
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" value="<?php echo randomPassword() ?>" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
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
                            <label for="patrolstarttime" class="col-md-4 col-form-label text-md-right">{{ __('وقت بديء العمل') }}</label>

                            <div class="col-md-6">
                                <input id="patrolstarttime" type="time" class="form-control @error('patrolstarttime') is-invalid @enderror" name="patrolstarttime" value="{{ old('patrolstarttime') }}" required autocomplete="patrolstarttime">

                                @error('patrolstarttime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patrolendtime" class="col-md-4 col-form-label text-md-right">{{ __('وقت انتهاء العمل') }}</label>

                            <div class="col-md-6">
                                <input id="patrolendtime" type="time" class="form-control @error('patrolendtime') is-invalid @enderror" name="patrolendtime" value="{{ old('patrolendtime') }}" required autocomplete="patrolendtime">

                                @error('patrolendtime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patroltype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الدورية') }}</label>

                            <div class="col-md-6">

                                <select id="patroltype" type="text" class="form-control @error('patroltype') is-invalid @enderror" name="patroltype" value="{{ old('patroltype') }}" required autocomplete="patroltype">
                                    <option value="morning">نهارية</option>
                                     <option value="night">ليلية</option>
                                </select>

                                @error('patroltype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="possitioninannex" class="col-md-4 col-form-label text-md-right">{{ __('المكانة في الشركة') }}</label>

                            <div class="col-md-6">

                                <select id="possitioninannex" type="text" class="form-control @error('possitioninannex') is-invalid @enderror" name="possitioninannex" value="{{ old('possitioninannex') }}" required autocomplete="possitioninannex">
                                    <option value="TL">رئيس الفريق</option>
                                     <option value="E">موظف عادي</option>
                                </select>

                                @error('patroltype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="annex" class="col-md-4 col-form-label text-md-right">{{ __('تابع للفرع') }}</label>

                            <div class="col-md-6">
                    
                    
                                <select id="annex" type="text" class="form-control @error('annex') is-invalid @enderror" name="annex" value="{{ old('annex') }}" required autocomplete="annex">
                                @if(isset($annexes))
                                @foreach($annexes as $annex)
                                    <option value="{{$annex['idannexes']}}">{{$annex['name']}}</option>
                                 @endforeach
                                 @endif
                                </select>
                    
                  
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

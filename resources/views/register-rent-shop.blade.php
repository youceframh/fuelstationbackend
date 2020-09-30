@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل المحلات') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/rent/shops','method' => 'post')) }}
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
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('عنوان المنزل') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="nationality" class="col-md-4 col-form-label text-md-right">{{ __('الجنسية') }}</label>

                            <div class="col-md-6">
                                <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" required autocomplete="nationality">

                                @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        
                        <div class="form-group row" style="display:flex;text-align:right;">
                            <label for="rentshoptype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الايجار') }}</label>

                            <div class="col-md-6">

                            <select id="rentshoptype" name="rentshoptype" id="rentshoptype" required autocomplete="rentshoptype" class="form-control @error('rentshoptype') is-invalid @enderror">
                            <option value="EMPTY" id="emptyoption"></option>
                                <option value="COMPANY">شركة</option>
                                <option value="INDIVIDUAL">شخص</option>
                            </select>

                                @error('rentshoptype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="display:flex;text-align:right;" id="idcardtypeform">

                            <label for="idcardtype" class="col-md-4 col-form-label text-md-right">{{ __('نوع بطاقة التعريف') }}</label>

                            <div class="col-md-6">

                            <select id="idcardtype" class="form-control @error('idcardtype') is-invalid @enderror" name="idcardtype" id="idcardtype" required autocomplete="idcardtype" >
                            <option value="EMPTY" id="emptyoption"></option>
                                <option value="COMMERCIAL">تجارية</option>
                                <option value="NATIONAL">وطنية</option>
                            </select>

                                @error('idcardtype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idcardnbr" class="col-md-4 col-form-label text-md-right"><span id='dynamicnameofidcard'>رقم ...</span></label>

                            <div class="col-md-6">
                                <input id="idcardnbr" type="text" class="form-control @error('idcardnbr') is-invalid @enderror" name="idcardnbr" required autocomplete="idcardnbr">

                                @error('idcardnbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    <!--COMPANY RENT SECTION-->
    <div id="companyrentsection">
                      
                        <div class="form-group row">
                            <label for="commercialnbr" class="col-md-4 col-form-label text-md-right">{{ __('الرقم التجاري') }}</label>

                            <div class="col-md-6">
                                <input id="commercialnbr" type="text" class="form-control @error('commercialnbr') is-invalid @enderror" name="commercialnbr" autocomplete="commercialnbr">

                                @error('commercialnbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="representativename" class="col-md-4 col-form-label text-md-right">{{ __('اسم الوكيل التجاري') }}</label>

                            <div class="col-md-6">
                                <input id="representativename" type="text" class="form-control @error('v') is-invalid @enderror" name="representativename" autocomplete="representativename">

                                @error('v')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="representativetype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الوكيل التجاري') }}</label>

                            <div class="col-md-6">
                                <input id="representativetype" type="text" class="form-control @error('representativetype') is-invalid @enderror" name="representativetype" autocomplete="representativetype">

                                @error('representativetype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="representativeidcardnumber" class="col-md-4 col-form-label text-md-right">{{ __('رقم بطاقة تعريف الوكيل') }}</label>

                            <div class="col-md-6">
                                <input id="representativeidcardnumber" type="text" class="form-control @error('representativeidcardnumber') is-invalid @enderror" name="representativeidcardnumber" autocomplete="representativeidcardnumber">

                                @error('representativeidcardnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="authorityofidcard" class="col-md-4 col-form-label text-md-right">{{ __('السلطة المصدرة لبطاقة التعريف') }}</label>

                            <div class="col-md-6">
                                <input id="authorityofidcard" type="text" class="form-control @error('authorityofidcard') is-invalid @enderror" name="authorityofidcard" autocomplete="authorityofidcard">

                                @error('authorityofidcard')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idcardexpiredate" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ انتهاء صلاحية البطاقة') }}</label>

                            <div class="col-md-6">
                                <input id="idcardexpiredate" type="date" class="form-control @error('idcardexpiredate') is-invalid @enderror" name="idcardexpiredate" autocomplete="idcardexpiredate">

                                @error('idcardexpiredate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        </div>



 <!-- / COMPANY RENT SECTION-->

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
                            <label for="electricitynbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الكهرباء') }}</label>

                            <div class="col-md-6">
                                <input id="electricitynbr" type="text" class="form-control @error('electricitynbr') is-invalid @enderror" name="electricitynbr" autocomplete="electricitynbr">

                                @error('electricitynbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="waternbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الماء') }}</label>

                            <div class="col-md-6">
                                <input id="waternbr" type="text" class="form-control @error('waternbr') is-invalid @enderror" name="waternbr" autocomplete="waternbr">

                                @error('waternbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="activitytype" class="col-md-4 col-form-label text-md-right">{{ __('نوع النشاط') }}</label>

                            <div class="col-md-6">
                                <input id="activitytype" type="text" class="form-control @error('activitytype') is-invalid @enderror" name="activitytype" autocomplete="activitytype">

                                @error('activitytype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymenttype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الدفع') }}</label>

                            <div class="col-md-6">
                                <select id="paymenttype" type="text" class="form-control @error('paymenttype') is-invalid @enderror" name="paymenttype" autocomplete="paymenttype" class="form-control @error('paymenttype') is-invalid @enderror">
                                    <option value="MONTHLY">شهري</option>
                                    <option value="3 MONTHS">3 اشهر</option>
                                    <option value="6 MONTHS">6 اشهر</option>
                                    <option value="YEARLY">سنوي</option>
                                </select>

                                @error('paymenttype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shoptype" class="col-md-4 col-form-label text-md-right">{{ __('نوع المحل') }}</label>

                            <div class="col-md-6">
                                <input id="shoptype" type="text" class="form-control @error('shoptype') is-invalid @enderror" name="shoptype" autocomplete="shoptype">

                                @error('shoptype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('ملاحظات') }}</label>

                            <div class="col-md-6">
                                <textarea id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" required autocomplete="notes"></textarea>

                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="rentconditions" class="col-md-4 col-form-label text-md-right">{{ __('شروط الايجار') }}</label>

                            <div class="col-md-6">
                                <textarea id="rentconditions" type="text" class="form-control @error('rentconditions') is-invalid @enderror" name="rentconditions" value="{{ old('rentconditions') }}" required autocomplete="rentconditions"></textarea>

                                @error('rentconditions')
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

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
                {{ Form::open( array('url' => '/register/suppliers', 'files' => true,'method' => 'post')) }}
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
                            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('الرقم (الاسم التجاري)') }}</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autocomplete="number" autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="last name" class="col-md-4 col-form-label text-md-right">{{ __('اسم المدير العام') }}</label>

                            <div class="col-md-6">
                                <input id="dgname" type="text" class="form-control @error('dgname') is-invalid @enderror" name="dgname" value="{{ old('dgname') }}" required autocomplete="dgname" autofocus>

                                @error('dgname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dgphone" class="col-md-4 col-form-label text-md-right">{{ __('رقم جوال المدير العام') }}</label>

                            <div class="col-md-6">
                                <input id="dgphone" type="dgphone" class="form-control @error('dgphone') is-invalid @enderror" name="dgphone" required autocomplete="dgphone">

                                @error('dgphone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="Language" class="col-md-4 col-form-label text-md-right">{{ __('عنوان المنزل') }}</label>

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
                            <label for="taxnumber" class="col-md-4 col-form-label text-md-right">{{ __('الرقم الضريبي (FAT Nbr) ') }}</label>

                            <div class="col-md-6">
                                <input id="taxnumber" type="text" class="form-control @error('taxnumber') is-invalid @enderror" name="taxnumber" required autocomplete="taxnumber">

                                @error('taxnumber')
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
                            <label for="openingcredit" class="col-md-4 col-form-label text-md-right">{{ __('الرصيد الافتتاحي') }}</label>

                            <div class="col-md-6">
                                <input id="openingcredit" type="text" class="form-control @error('openingcredit') is-invalid @enderror" name="openingcredit" required autocomplete="openingcredit">

                                @error('openingcredit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

  

                        <div class="form-group row">
                            <label for="addtime" class="col-md-4 col-form-label text-md-right">{{ __('تاريخ الضخ') }}</label>

                            <div class="col-md-6">
                                <input id="addtime" type="date" class="form-control @error('addtime') is-invalid @enderror" name="addtime" value="{{ old('addtime') }}" required autocomplete="addtime">

                                @error('addtime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serialid" class="col-md-4 col-form-label text-md-right">{{ __('الرقم التسلسلي') }}</label>

                            <div class="col-md-6">
                                <input id="serialid" type="number" class="form-control @error('serialid') is-invalid @enderror" name="serialid" required autocomplete="serialid">

                                @error('serialid')
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
                            <label for="producttype" class="col-md-4 col-form-label text-md-right">{{ __('نوع المنتوج') }}</label>

                            <div class="col-md-6">
                                <input id="producttype" type="text" class="form-control @error('producttype') is-invalid @enderror" name="producttype" value="{{ old('producttype') }}" required autocomplete="producttype">

                                @error('producttype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="volume" class="col-md-4 col-form-label text-md-right">{{ __('الحجم') }}</label>

                            <div class="col-md-6">
                                <input id="volume" type="text" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{ old('volume') }}" required autocomplete="volume">

                                @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aramcoinovicenbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم فاتورة ارامكو Aramco') }}</label>

                            <div class="col-md-6">
                                <input id="aramcoinovicenbr" type="text" class="form-control @error('aramcoinovicenbr') is-invalid @enderror" name="aramcoinovicenbr" value="{{ old('aramcoinovicenbr') }}" required autocomplete="aramcoinovicenbr">

                                @error('aramcoinovicenbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="trucknbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الشاحنة') }}</label>

                            <div class="col-md-6">
                                <input id="trucknbr" type="text" class="form-control @error('trucknbr') is-invalid @enderror" name="trucknbr" value="{{ old('trucknbr') }}" required autocomplete="trucknbr">

                                @error('trucknbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="personname" class="col-md-4 col-form-label text-md-right">{{ __('اسم الشخص') }}</label>

                            <div class="col-md-6">
                                <input id="personname" type="text" class="form-control @error('personname') is-invalid @enderror" name="personname" value="{{ old('personname') }}" required autocomplete="personname">

                                @error('personname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('ألوقت') }}</label>

                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required autocomplete="time">

                                @error('time')
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

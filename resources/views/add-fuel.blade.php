@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تسجيل ادخال للبنزين') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/addfuel', 'files' => true,'method' => 'post')) }}
                        @csrf
                    @if(isset($success))
                    <div class="alert alert-success" role="alert">
  {{$success}}
</div>
@endif
@if(isset($tank_id))
                    <div class="alert alert-success" role="alert">
    <a href="/print/addfuel/{{$tank_id}}">اطبع الفاتورة</a>
</div>
@endif

@if(isset($failed))
                    <div class="alert alert-danger" role="alert">
  {{$failed}}
</div>
                    @endif
                    <div class="form-group row">
                            <label for="tanknbr" class="col-md-4 col-form-label text-md-right">{{ __('حدد الخزان') }}</label>

                            <div class="col-md-6">
                                <select id="tanknbr" type="text" class="form-control @error('tanknbr') is-invalid @enderror" name="tanknbr" value="{{ old('tanknbr') }}" required autocomplete="tanknbr" autofocus>
                                @foreach($tanks as $tank)
                                <option value="{{$tank->id_tank}}" style="direction:rtl;">{{$tank->tank_number}} / {{$tank->fuel_type}}</option>
                                @endforeach
                                </select>
                                @error('tanknbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aramconbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم ارامكو') }}</label>

                            <div class="col-md-6">
                                <input id="aramconbr" type="text" class="form-control @error('aramconbr') is-invalid @enderror" name="aramconbr" value="{{ old('aramconbr') }}" required autocomplete="aramconbr" autofocus>

                                @error('aramconbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inovicenbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم الفاتورة') }}</label>

                            <div class="col-md-6">
                                <input id="inovicenbr" type="text" class="form-control @error('inovicenbr') is-invalid @enderror" name="inovicenbr" value="{{ old('inovicenbr') }}" required autocomplete="inovicenbr" autofocus>

                                @error('inovicenbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="trucknbr" class="col-md-4 col-form-label text-md-right">{{ __('رقم تسجيل الشاحنة') }}</label>

                            <div class="col-md-6">
                                <input id="trucknbr" type="text" class="form-control @error('trucknbr') is-invalid @enderror" name="trucknbr" value="{{ old('trucknbr') }}" required autocomplete="trucknbr" autofocus>

                                @error('trucknbr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="amountpayed" class="col-md-4 col-form-label text-md-right">{{ __('قيمة الاموال المدفوعة') }}</label>

                            <div class="col-md-6">
                                <input id="amountpayed" type="text" class="form-control @error('amountpayed') is-invalid @enderror" name="amountpayed" required autocomplete="amountpayed">

                                @error('amountpayed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    
                        <div class="form-group row">
                            <label for="facturepic" class="col-md-4 col-form-label text-md-right">{{ __('صورة الفاتورة (png,jpg,jpeg)') }}</label>

                            <div class="col-md-6">
                                <input id="facturepic" type="file" class="form-control @error('facturepic') is-invalid @enderror" name="facturepic" value="{{ old('facturepic') }}" required autocomplete="facturepic">

                                @error('facturepic')
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

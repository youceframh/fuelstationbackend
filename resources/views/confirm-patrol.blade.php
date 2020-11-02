@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('تاكيد الدوريات') }} </span>
            </div>
            @php
                    $get_patrol_code = DB::table('daily')->where('iddaily',$_GET['patrol'])->first()->code;
                    $get_patrol_id = DB::table('daily')->where('iddaily',$_GET['patrol'])->first()->iddaily;
                    @endphp
                <div class="card-body">
                {{ Form::open( array('url' => "/patrol/confirm?patrol=$get_patrol_id",'method' => 'post')) }}
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
                            <label for="patrol" class="col-md-4 col-form-label text-md-right">{{ __('الدورية') }}</label>

                            <div class="col-md-6">
                                <input id="patrol" value="{{$get_patrol_code}}" disabled type="text" class="form-control @error('patrol') is-invalid @enderror" name="patrol" value="{{ old('patrol') }}" required autocomplete="patrol" autofocus>

                                @error('patrol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="moneyplace" class="col-md-4 col-form-label text-md-right">{{ __('نقلت الاموال الى') }}</label>

                            <div class="col-md-6">
                                <select id="moneyplace" type="text" class="form-control @error('moneyplace') is-invalid @enderror" name="moneyplace" value="{{ old('moneyplace') }}" required autocomplete="moneyplace">
                                <option value=""></option>
                                <option value="company">الشركة</option>
                                    <option value="bank">البنك</option>
                                    <option value="supplier">المورد</option>
                                </select>

                                @error('moneyplace')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="totalofmoney" class="col-md-4 col-form-label text-md-right">{{ __('قيمة الاموال المنقولة') }}</label>

                            <div class="col-md-6">
                                <input id="totalofmoney"  type="text" class="form-control @error('totalofmoney') is-invalid @enderror" name="totalofmoney" value="{{ old('totalofmoney') }}" required autocomplete="totalofmoney" autofocus>

                                @error('totalofmoney')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="restofmoney" class="col-md-4 col-form-label text-md-right">{{ __('قيمة الاموال المتبقية') }}</label>

                            <div class="col-md-6">
                                <input id="restofmoney"   type="text" class="form-control @error('restofmoney') is-invalid @enderror" name="restofmoney" value="{{ old('restofmoney') }}" autocomplete="restofmoney" autofocus>

                                @error('restofmoney')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="receiptnumber">
                            <label for="receiptnumber" class="col-md-4 col-form-label text-md-right">{{ __('رقم قاتورة القبض') }}</label>

                            <div class="col-md-6">
                                <input id="receiptnumber"   type="text" class="form-control @error('receiptnumber') is-invalid @enderror" name="receiptnumber" value="{{ old('receiptnumber') }}"  autocomplete="receiptnumber" autofocus>

                                @error('receiptnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" id="receiptnumberofbank">
                            <label for="receiptnumber" class="col-md-4 col-form-label text-md-right">{{ __('رقم قاتورة البنك') }}</label>

                            <div class="col-md-6">
                                <input id="receiptnumber"   type="text" class="form-control @error('receiptnumber') is-invalid @enderror" name="receiptnumber" value="{{ old('receiptnumber') }}" autocomplete="receiptnumber" autofocus>

                                @error('receiptnumber')
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

@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('سجل دورية') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/register/patrol','method' => 'post')) }}
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
                            <label for="pomp" class="col-md-4 col-form-label text-md-right">{{ __('المضخة') }}</label>

                            <div class="col-md-6">

                            <select id="pomp" type="text" class="form-control @error('pomp') is-invalid @enderror" name="pomp" required autocomplete="pomp">
                            @foreach ($pomp_serial as $pomp)
                                    <option name="pomp" value="<?php echo $pomp['serial'] ?>"><?php echo $pomp['serial'] ?></option>

                                    @php 
                                    $pompi = $pomp;
                                    @endphp

                                    @endforeach
                                </select>

                                @error('pomp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="lastrecord" class="col-md-4 col-form-label text-md-right">{{ __('اخر تسجيل') }}</label>

                            <div class="col-md-6">
                                <input id="lastrecord" type="text" value="<?php echo $pompi['last record'] ?>" class="form-control @error('lastrecord') is-invalid @enderror" name="lastrecord"  required autocomplete="lastrecord" autofocus>

                                @error('lastrecord')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newrecord" class="col-md-4 col-form-label text-md-right">{{ __('التسجيل الجديد') }}</label>

                            <div class="col-md-6">
                                <input id="newrecord"  type="text" class="form-control @error('newrecord') is-invalid @enderror" name="newrecord" value="{{ old('newrecord') }}" required autocomplete="newrecord" autofocus>

                                @error('newrecord')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paymenttype" class="col-md-4 col-form-label text-md-right">{{ __('نوع الدفع') }}</label>

                            <div class="col-md-6">
                                <input id="paymenttype"  type="text" class="form-control @error('paymenttype') is-invalid @enderror" name="paymenttype" value="{{ old('paymenttype') }}" required autocomplete="paymenttype" autofocus>

                                @error('paymenttype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('المجموع') }}</label>

                            <div class="col-md-6">
                                <input id="total"  type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}" required autocomplete="total" autofocus>

                                @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="canberegistredby" class="col-md-4 col-form-label text-md-right">{{ __('يمكن ان يسجل من طرف الفريق') }}</label>

                            <div class="col-md-6">
                                <input id="canberegistredby"  type="text" class="form-control @error('newrecanberegistredbycord') is-invalid @enderror" name="canberegistredby" value="{{ old('canberegistredby') }}" required autocomplete="canberegistredby" autofocus>

                                @error('canberegistredby')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    
                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('رمز qr لاخر تسجيل') }}</label>

                            <div class="col-md-6" style="display:flex;justify-content:right;">
                                {!! QrCode::size(250)->generate($pompi['last record']) !!}
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

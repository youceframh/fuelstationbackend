@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('صيانة') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => '/maintenance','method' => 'post')) }}
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
                                    @foreach ($pomps as $company)
                                    <option value="{{$company['id']}}">{{$company['serial']}}</option>
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
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('التاريخ') }}</label>

                            <div class="col-md-6">
                                <input id="date" value="<?php echo date('Y-m-d'); ?>" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

                                @error('date')
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

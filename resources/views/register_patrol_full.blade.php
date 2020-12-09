@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('التسجيلات الجديدة للطرمبات') }} </span>
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
                    <div class="alert alert-success" role="alert">
                        <span style="direction:rtl;display: flex;">اذا قمت بتسجيل جميع الخزانات اكد التسجيلات من <a href="/patrol/add">هنا</a></span>
                        </div>
   
                    @foreach ($pomps as $pomp)
                    <div class="form-group row">
                            <label for="pomp" class="col-md-4 col-form-label text-md-right">{{$pomp->pomp_serial}} ( {{$pomp->tank_fuel_type}} )</label>
    @php 
    $fuel_type;
    switch($pomp->tank_fuel_type){
        case 'diesel':
            $fuel_type = 'd';
        break;
        case 'gasoline':
            $fuel_type = 'g';
        break;
        case 'essence91':
            $fuel_type = 'es91';
        break;
        case 'essence95':
            $fuel_type = 'es95';
        break;
    }
    @endphp
                            <div class="col-md-6">
                                <input id="newrecord"  type="text" class="form-control @error('newrecord') is-invalid @enderror" name="{{$fuel_type.$pomp->pomp_serial}}" value="{{ old('newrecord') }}" required autocomplete="newrecord" autofocus>

                                @error('newrecord')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            @endforeach

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

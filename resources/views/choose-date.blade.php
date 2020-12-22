@extends('layouts.app')

@section('content')
<div class="container" style="direction:rtl;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex;">
                <span>{{ __('اختيار وقت') }} </span>
            </div>

                <div class="card-body">
                {{ Form::open( array('url' => "/dashboard/companies/$comp_id/annexes/$an_id/patrols",'method' => 'get')) }}
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

                    <div class="alert alert-success" role="alert" style="display:flex;">
                        يمكنك تفحص كل الدوريات من  <a href="/dashboard/companies/{{$comp_id}}/annexes/{{$an_id}}/patrols/all">&nbsp;هنا</a>
                    </div>
                      
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('التاريخ') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('reliedtoannex') is-invalid @enderror" name="date" required autocomplete="date" />

                                @error('date')
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

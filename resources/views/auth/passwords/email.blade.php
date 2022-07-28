@extends('layouts.auth.index')
@section('page_title')
    {{__('app.auth.ResetPassword')}}
@endsection
@section('content')
    <div class="card card-authentication1 mx-auto my-5">
        <div class="text-center" style="width:400px; margin:0 auto;">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4>{{$errors->first()}}</h4>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {!! session('success') !!}
                </div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger" role="alert">
                    {!! session('danger') !!}
                </div>
            @endif

        </div>
        <div class="card-body">
            <div class="card-content p-2">
                <div class="card-title text-uppercase pb-2">{{__('app.auth.ResetPassword')}}</div>
                <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
                @if (session('status'))
                    <img src="{{url('/assets')}}/images/login/mail.png" width="80"  alt="email has been send">
                    <h1 class="mt-3 mb-0">{{ __('Success') }}</h1>
                    <p>{{ __('app.auth.emailhasbeensend') }}</p>
                    <div class="d-inline-block w-100">

                        <a href="{{Url('/')}}" class="btn btn-primary mt-3">{{ __('app.auth.BacktoHome') }}</a>
                    </div>
            @else
                <!-- Form -->

                    <form method="POST" id="submited_form"  class="text-center" style="color: #757575;" action="{{ route('password.email') }}">
                        @csrf
                    <div class="form-group">
                        <label for="email" class="">Email Address</label>
                        <div class="position-relative has-icon-right">
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('app.auth.email')}}"  name="email" value="{{ old('email') }}">
                            <div class="form-control-position">
                                <i class="icon-envelope-open"></i>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                               </span>
                            @enderror
                        </div>
                    </div>


                    <button type="submit" class="btn btn-warning btn-block mt-3">{{__('app.auth.ResetPassword')}}</button>
                </form>
                @endif
            </div>
        </div>
        <div class="card-footer text-center py-3">
            <p class="mb-0">Return to the <a  href="{{ route('login') }}">{{__('app.auth.login')}}</a></p>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{url('/validator')}}/email.js"></script>
@endpush

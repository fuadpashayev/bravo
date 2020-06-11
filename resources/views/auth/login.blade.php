@extends('admin.layouts.layout')

@section('styles')
    <style>
        body{
            background:#2a3140;
        }
        .navbar{
            display: none;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card card-shadow mt-1">
                <div class="card-header bg-white">
                    <h3 class="text-center special-header"><span class="border-bottom-special border-bottom-1 pb-1 px-1 text-special">Admin Panel</span></h3>
                    <div class="image-area">
                        <img src="{{asset('panel/images/login/login1.png')}}">
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row px-1 px-sm-2 px-md-3 float-group">
                            <div class="col-12">
                                <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                <label class="float-text animate"><span>{{translate('auth.username')}}</span></label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row px-1 px-sm-2 px-md-3 float-group">
                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <label class="float-text animate"><span>{{translate('auth.password')}}</span></label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-special col-6 m-auto">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <span class="">&copy; 2019 - {{date('Y')}}. All rights reserved! <a href="{{route('home')}}">Pashayev.info</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        let preUrl = window.location.origin+'/panel/images/login/login';
        for(let num = 2;num<=16;num++){
            setTimeout(function(){
                let image = $('.image-area img');
                let imageUrl = num+'.png';
                image.fadeOut('fast', function () {
                    image.attr('src',preUrl+imageUrl);
                    image.fadeIn('fast');
                });
            },num*2500);
        }
    </script>
@endsection

	@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		
        <div class="col-12 col-md-8">
		    @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
			<div class="w-100 d-flex justify-content-between shadow-sm p-3 bg-white rounded">
				<h2>{{ __('main.titleNews')}}</h2>
				@auth
					<a class="btn btn-link" href="{{ route('news.create') }}">{{ __('main.addNews') }}</a>
				@endauth
			</div>
			@if($allNews->isEmpty())
				{{ __('main.no_data')}}
			@else
				@foreach($allNews as $k=>$oneNews)
					<div class="w-100 mt-4">
						<h4><a href="{{ url('news/'.$oneNews->url) }}"><span class="font-weight-bold border-bottom border-success"><?= $oneNews->title?></span></a></h4>
						<p><?= $oneNews->description?></p>
						<div><span class="mr-3">Date: {{ ($oneNews->created_at)->format('d.m.Y H:i') }}</span><span>Author: <a href="{{ url('profile/'.$oneNews->user->name)}}">{{ $oneNews->user->name}}</a></span></div>
					</div>
				@endforeach
			@endif
			<hr>
			
			<x-popular/>
			
        </div>
        @guest
		<div class="col-12 col-md-4">
			<div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <input id="password" type="password"  placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
        @endguest
    </div>
</div>
@endsection

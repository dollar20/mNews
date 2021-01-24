	@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ $dataNews->title }}</div>

                <div class="card-body">
                    {{ $dataNews->description }}
                    <p class="mt-3"><span class="mr-3">Date: {{ ($dataNews->created_at)->format('d.m.Y H:i') }}</span><span>Author: <a href="{{ url('profile/'.$user->name)}}">{{ $user->name}}</a></span></p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="w-100 d-flex justify-content-between shadow-sm p-3 bg-white rounded">{{ __('Comments')}}
            @auth
            <a class="btn btn-link" href="{{ route('news.create') }}">{{ __('Add Comment') }}</a>
            @endauth
            </div>
            @if($dataNews->comments->isEmpty())
				<p class="bg-white p-3">{{ __('main.no_data')}}</p>
			@else
				@foreach($dataNews->comments as $k=>$oneNews)
					<div class="w-100 mt-4">
						<h4><a href="{{ url('news/'.$oneNews->url) }}"><span class="font-weight-bold border-bottom border-success"><?= $oneNews->title?></span></a></h4>
						<p><?= $oneNews->description?></p>
						<div><span class="mr-3">Date: {{ ($oneNews->created_at)->format('d.m.Y H:i') }}</span><span>Author: <a href="{{ url('profile/'.$oneNews->user->name)}}">{{ $oneNews->user->name}}</a></span></div>
					</div>
				@endforeach
			@endif
        
        </div>
    </div>
</div>
@endsection

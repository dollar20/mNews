<div class="mt-5">
    <h5 class="shadow-sm p-3 bg-white rounded">{{ __('main.titlePopular')}}</h5>
	@if($popularNews->isEmpty())
		{{ __('main.no_data')}}
	@else
		@foreach($popularNews as $k=>$oneNews)
			<div class="w-100 mt-3">
				<h4><span class="font-weight-bold border-bottom border-success"><?= $oneNews->title?></span></h4>
				<p><?= $oneNews->description?></p>
				<div>
					<span class="mr-3">Date: {{ ($oneNews->created_at)->format('d.m.Y H:i') }}</span>
					<span class="mr-3">Author: {{ $oneNews->user->name}}</span>
					<span>Count comments: {{ $oneNews->comments->count()}}</span>
				</div>
			</div>
		@endforeach
	@endif
</div>
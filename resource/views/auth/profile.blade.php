@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
						<li class="list-group-item">Name: <span class="text-success font-weight-bold">{{ $selectUser[0]['name'] }}</span></li>
						<li class="list-group-item">Email: <span class="text-success font-weight-bold">{{ $selectUser[0]['email'] }}</span></li>
						<li class="list-group-item">Count news: <span class="text-success font-weight-bold">{{ $countNews }}</span></li>
                        <li class="list-group-item">Count subscribers: <span class="text-success font-weight-bold"  id="countNews">{{ $countSubscriber }}</span></li>
                        @if($selectUser[0]['id'] != Auth::user()->id)
                            <li class="list-group-item">
                            <span id="issubscribe"></span>
                            <button class="full-btn subscribe" id="subscribe">{{ __('Subscribe User News')}}</button>
                            </li>
						@endif
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('.subscribe').on('click', function(e){
    $.ajax({
        url: "{{url('subscribe')}}",
        data: {
            onwhon : <?=$selectUser[0]['id']?>,
            who : <?=Auth::user()->id?>,
        },
        dataType: "json",
        success: function(result){
            var desc;
            desc = parseInt($('#countNews').html()) + 1;
            $('#countNews').html(desc);
            $('#subscribe').hide();
            $('#issubscribe').html('You are subscribed to users news');
        }
    }) 
});
</script>
@endsection
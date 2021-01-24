@extends('layouts.app')
@section('content')
<script src="{{ asset('tinymce/tinymce.js') }}" referrerpolicy="origin"></script>
<script>
        tinymce.init({
        selector: 'textarea',
            plugins: 'autolink link image print lists advlist table lists media code preview',
            menubar: 'file edit insert view format table help view',
			toolbar: [{name: 'history', items: [ 'undo', 'redo' ]},
                  {name: 'styles', items: [ 'styleselect' ]},
                  {name: 'formatting', items: [ 'bold', 'italic']},
                  {name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ]},
                  {name: 'indentation', items: [ 'outdent', 'indent' ]},
                  {name: 'listdata', items: [ 'numlist', 'bullist' ]},
                  {name: 'preview', items: [ 'preview']}],
            draggable_modal: true,
            convert_urls: false,
            height: 400,
            forced_root_block : '',
            remove_trailing_brs : true,
            default_link_target: "_blank",
            branding: false,
        });
</script>
<div class="container">
<div class="row justify-content-center">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-10">
                <h2>{{ __('admin.form_create_news') }}</h2>
            </div>
            <div class="col-md-2" style="text-align: right;">
                <button type="submit" class="btn btn-primary" form="create-news">Create</button>
            </div>
        </div>  
        <form action="{{ route('news.store') }}" method="POST" name="create_news" id="create-news"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Title</strong>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="{{ old('title', '') }}" required>
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                </div>
               <div class="col-md-12">
                    <div class="form-group">
                        <strong>Url</strong>
                        <input type="text" name="url" class="form-control" placeholder="Enter Url" value="{{ old('url', '') }}" required>
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    </div>
                </div>
				<div class="col-md-12">
					<div class="form-group">
                        <strong>Description</strong>
                        <textarea id="mytextarea" class="form-control" col="4" name="description" placeholder="Enter Description"></textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
					</div>
				</div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
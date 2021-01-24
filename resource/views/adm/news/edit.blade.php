@extends('admin.base')
@section('main')
    
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12" style="text-align: right;">
                <button type="submit" class="btn btn-primary" form="edit-menu">{{ __('admin.form_submit') }}</button>
                <a href="{{ route('menus.index')}}" class="btn btn-danger">Cancel</a>
                <a href="{{ route('menuHistory.show',$menus[0]->id)}}" class="btn btn-secondary">{{ __('admin.history_edit') }}</a>
            </div>
            <div class="col-md-12">
                <h3>{{ __('admin.form_edit_menu') }}: {{ $menus[0]->title }}</h3>
            </div>
            
        </div>
        <form action="{{ route('menus.update', $menus[0]->id) }}" method="POST" name="edit_menu" id="edit-menu" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $menus[0]->id }}">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="languageTab" role="tablist">
                        @foreach (Config::get('app.languages') as $language)
                        @php 
                            $active = $language==Config::get('app.locale')?" active":"";
                        @endphp
                            <li class="nav-item">
                                <a class="nav-link{{ $active }}" id="language-tab" data-toggle="tab" href="#language{{ $language }}" role="tab" aria-controls="home" aria-selected="true">{{ Config::get('app.locales')[$language] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="languageTabContent">
                        @foreach (Config::get('app.languages') as $language)
                        @php 
                            $active = $language==Config::get('app.locale')?" active":"";
                        @endphp
                        <div class="tab-pane fade show{{ $active }}" id="language{{ $language }}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-group">
                                <strong>Title</strong>
                                <input type="text" name="menu_description[{{ $language }}][title]" class="form-control" placeholder="Enter Title" 
                                value="{{ old('menu_description.'.$language.'.title', isset($menus['menu_description'][$language])?$menus['menu_description'][$language]['title']:'') }}" {{ $active?'required':''}}>
                                <span class="text-danger">{{ $errors->first('menu_description.'.$language.'.title') }}</span>
                            </div>
                            <div class="form-group">
                                <strong>Keywords</strong>
                                <input type="text" name="menu_description[{{ $language }}][keywords]" class="form-control" placeholder="Enter keywords" 
                                value="{{ isset($menus['menu_description'][$language])?$menus['menu_description'][$language]['keywords']:'' }}">
                                <span class="text-danger">{{ $errors->first('keywords') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Url</strong>
                        <input type="text" name="url" class="form-control" placeholder="Enter Url" value="{{ old('url', $menus[0]->url) }}" required>
                            <span class="text-danger">{{ $errors->first('url') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Image</strong>
                        @if(!empty($menus[0]->imageName))
                         <img src="{{ asset( 'upload/menus/'.$menus[0]->imageName) }}" class="imageTrumb" style="max-width:150px" /><span id="imageSpan">{{ $menus[0]->imageName }}</span>
                        <input type="hidden" name="old_image" id="old_image" value="{{ $menus[0]->imageName }}"/>
                        <input type="hidden" name="del_image" id="del_image" value="0"/>
                        <input type="file" name="image" id="image" hidden class="form-control"/>
                        <input type="button" class="btn btn-danger" value="Delete Image" id="deleteImage"/>
                        
                        @else
                         <input type="file" name="image" class="form-control">
                        @endif
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Parent</strong>
                        <select class="form-control" name="parent_id">
                            <option value="0">Select Parent</option>
                            @foreach ($parents as $key => $value)
                                <option value="{{ $value->id }}" {{ ( $value->id == $menus[0]->parent_id) ? 'selected' : '' }}>{{ $value->title }}</option>
                            @endforeach    
                        </select>
                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <strong>Order</strong>
                        <input type="text" name="order" class="form-control" placeholder="Enter Order" value="{{ old('order', $menus[0]->order) }}">
                            <span class="text-danger">{{ $errors->first('order') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Order top menu</strong>
                        <input type="text" name="order_top" class="form-control" placeholder="Enter Order Top Menu" value="{{ old('order_top', $menus[0]->order_top) }}">
                            <span class="text-danger">{{ $errors->first('order_top') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" {{ $menus[0]->status == 1 ? 'checked' : '' }} name="status" id="statusMenu">
                                <label class="custom-control-label" for="statusMenu">Status</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

$( document ).ready( function( $ ) {
    $( '#deleteImage' ).on( 'click', function(e) {
        e.preventDefault();
        $('#imageSpan').html('');
        $('#del_image').val(1);
        
        $('#image').removeAttr('hidden');
        $('.imageTrumb').attr('hidden','');
        $('#deleteImage').attr('hidden','');
    });
});
</script>
@endsection

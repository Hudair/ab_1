@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('New Service')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Service')}}</h4>
                        <form action="{{route('admin.services.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Content')}}</label>
                                        <input type="hidden" name="service_content" >
                                        <div class="summernote"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{__('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="title">{{__('Slug')}}</label>
                                        <input type="text" class="form-control"  id="slug"  name="slug" placeholder="{{__('Slug')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_icon_type">{{__('Icon Type')}}</label>
                                        <select name="icon_type" class="form-control" id="edit_icon_type">
                                            <option value="icon">{{__("Font Icon")}}</option>
                                            <option value="image">{{__("Image Icon")}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group icon">
                                        <label for="edit_icon" class="d-block">{{__('Icon')}}</label>
                                        <div class="btn-group ">
                                            <button type="button" class="btn btn-primary iconpicker-component">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </button>
                                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                    data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu"></div>
                                        </div>
                                        <input type="hidden" class="form-control"  id="edit_icon" value="fas fa-exclamation-triangle" name="icon">
                                    </div>
                                    <div class="form-group">
                                        <label for="img_icon">{{__('Icon Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" id="img_icon" name="img_icon">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Image" data-modaltitle="Upload Image" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 64x64')}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Excerpt')}}</label>
                                        <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="categories_id" class="form-control" id="categories_id">
                                            <option value="">{{__("Select Category")}}</option>
                                            @foreach($service_category as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="publish">{{__('Publish')}}</option>
                                            <option value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" name="image">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Blog Image" data-modaltitle="Upload Blog Image" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 1920x1280')}}</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Service')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script>
        $(document).ready(function () {


            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if($('.summernote').length > 1){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.service.category.by.slug')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.name+'</option>')
                        });
                    }
                });
            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().parent().show();
                }
            }
        });
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection

@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="card card-table">
    <div class="card-header card-header-divider">Tạo dự án mới</div>
    <div class="card-body" style="padding:10px;">    
        @if ($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach ($errors->all() as $error)
                <div role="alert" class="alert alert-warning alert-icon alert-icon-border alert-dismissible">
                    <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                    <div class="message">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                            <span aria-hidden="true" class="mdi mdi-close"></span>
                        </button>{{ $error }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        @endif
        <form action="/admin/projects/save_edit" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Tên dự án</label>
                <div class="col-12 col-sm-8 col-lg-6">
                <input id="inputText3" class="form-control" type="text" name="name" value="{{ $project->name }}">
                <input name="id" type="hidden" value="{{ $project->id }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-12 col-sm-3 col-form-label text-sm-right">Mục tiêu</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="aim_money" value="{{ $project->aim_money }}">
                        <div class="input-group-append"><span class="input-group-text">VND</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPlaceholder3" class="col-12 col-sm-3 col-form-label text-sm-right">Mô tả về dự án</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <textarea name="summary" class="form-control">{{ $project->summary }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPlaceholder3" class="col-12 col-sm-3 col-form-label text-sm-right">Chi tiết về dự án</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <textarea name="content" class="form-control">{{ $project->content }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDisabled3" class="col-12 col-sm-3 col-form-label text-sm-right">Ảnh</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <p>
                      <img id="holder" class="img-thumbnail" name="thumbnail" style="max-width:100px;" src="{{ $project->thumbnail }}">
                    </p>
                    <p>
                      <input id="thumbnail" class="form-control" type="hidden" name="thumbnail">
                      <button class="btn btn-primary" data-input="thumbnail" id="lfm" data-preview="holder"><i class="mdi mdi-upload"></i><span> Browse files...</span></button>
                    </p>
                </div>
            </div>
            <div class="form-group row">
              <label class="col-12 col-sm-3 col-form-label text-sm-right">Ngày kết thúc</label>
              <div class='col-12 col-sm-6 col-lg-4 input-group date' id='datetimepicker1'>
                  <input type='text' class="form-control" name="end_at" value="{{ $project->end_at }}"/>
                  <span class="input-group-addon" style="font-size:35px; position: absolute; right: 20px;">
                      <span class="mdi mdi-calendar-alt"></span>
                  </span>
              </div>         
            </div>
            
            <div class="form-group row">
                <div class="col-sm-8 offset-sm-3 col-lg-6 text-sm-right">
                    <button class="btn btn-space btn-primary"><i class="icon icon-left mdi mdi-cloud-done"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
   var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
    $('textarea').ckeditor(options);
    $('#lfm').filemanager('image');

    var dateNow = new Date();
    $(function () {
        $('#datetimepicker1').datetimepicker({
          format: 'Y/m/D H:mm:ss'
        });
    });
</script>
@endsection
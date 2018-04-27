@extends('layouts.app')

@section('content')
<div class="card card-table">
    <div class="card-header card-header-divider">Chỉnh sửa dự án</div>
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
        <form action="/admin/packages/save_edit" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
            <input type="hidden" name="id" value="{{ $package->id }}" />
            <div class="form-group row">
              <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Tiêu đề gói</label>
              <div class="col-12 col-sm-8 col-lg-6">
              <input id="inputText3" class="form-control" type="text" name="title" value="{{ $package->title }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Giá tiền</label>
              <div class="col-12 col-sm-8 col-lg-6">
              <input id="inputText3" class="form-control" type="text" name="price" value="{{ $package->price }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Số lượng</label>
              <div class="col-12 col-sm-8 col-lg-6">
              <input id="inputText3" class="form-control" type="text" name="quantity" value="{{ $package->quantity }}">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right"></label>
              <div class="col-12 col-sm-8 col-lg-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="type" {{ $package->type == 1 ? "checked=checked" : ""}} name="type">
                  <label class="form-check-label" for="type">
                    Không có sản phẩm
                  </label>
                </div>
              </div>
            </div>
            <p style="text-align: center">.....................</p>
        <div class="form-group row">
            <div class="col-sm-8 offset-sm-3 col-lg-6 text-sm-right">
                <button class="btn btn-space btn-primary"><i class="icon icon-left mdi mdi-cloud-done"></i> Save</button>
            </div>
        </div>
      </form>
    </div>
</div>
@endsection
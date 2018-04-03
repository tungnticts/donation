@extends('layouts.app')

@section('content')
<style>
    .select2 {
        width: 100% !important;
    }
</style>
<div class="card card-table">
    <div class="card-header card-header-divider">Tạo sản phẩm mới</div>
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
        <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Tên sản phẩm</label>
                <div class="col-12 col-sm-8 col-lg-6">
                <input id="inputText3" class="form-control" type="text" name="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Mã sản phẩm</label>
                <div class="col-12 col-sm-8 col-lg-6">
                <input id="inputText3" class="form-control" type="text" name="code">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-12 col-sm-3 col-form-label text-sm-right">Giá</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="price">
                        <div class="input-group-append"><span class="input-group-text">VND</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Màu</label>
                <div class="col-12 col-sm-8 col-lg-6">
                <input class="form-control" type="text" name="color" id="color_picker">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputText3" class="col-12 col-sm-3 col-form-label text-sm-right">Chất liệu</label>
                <div class="col-12 col-sm-8 col-lg-6">
                <input id="inputText3" class="form-control" type="text" name="material">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPlaceholder3" class="col-12 col-sm-3 col-form-label text-sm-right">Mô tả</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <textarea name="summary" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDisabled3" class="col-12 col-sm-3 col-form-label text-sm-right">Ảnh</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <input id="file-1" name="file"  class="inputfile" type="file">
                    <label for="file-1" class="btn-primary"> <i class="mdi mdi-upload"></i><span>Browse files...</span></label>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputReadonly3" class="col-12 col-sm-3 col-form-label text-sm-right">Danh mục</label>
                <div class="col-12 col-sm-8 col-lg-6">
                    <select class="form-control categories" name="categories[]" multiple="multiple">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
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
@endsection
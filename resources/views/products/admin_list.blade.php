@extends('layouts.app')

@section('content')
<div class="card card-table">
    <div class="card-body" style="padding:10px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('success'))
                <div role="alert" class="alert alert-success alert-icon alert-dismissible">
                    <div class="icon"><span class="mdi mdi-check"></span></div>
                    <div class="message">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
                @endif
                @if (session('fail'))
                <div role="alert" class="alert alert-danger alert-icon alert-dismissible">
                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Fail!</strong> {{ session('fail') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="row" style="align-items: center; padding-left: 30px; margin-top:30px;">
            <form>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control-sm" placeholder="Tên sản phẩm" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control-sm" placeholder="Mã sản phẩm" name="code" value="{{ old('code') }}">
                    </div>
                    <div class="col">
                        <select class="form-control form-control-sm" style="height: 37px; width: 250px;" name="category">
                            <option value="0">Lựa chọn chuyên mục</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary btn-sm" type="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12">
            <table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                <thead>
                    <tr role="row">
                        <th class="center">No.</th>
                        <th class="sorting" style="width:150px">Ảnh</th>
                        <th class="sorting_asc" style="width:35%">Tiêu đề</th>
                        <th class="number" style="width:8%">Giá</th>
                        <th class="number">Số lượng</th>
                        <th>Danh mục</th>
                        {{--  <th>Gói</th>  --}}
                        <th class="sorting">Ngày tạo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr class="gradeA odd" role="row">
                        <td class="center">{{ $key + 1 }}</td>
                        <td><img class="img-thumbnail" style="width: 130px" src="{{ $product->thumbnail }}"/></td>
                        <td class="sorting_1">
                            <p style="font-weight:500; font-size: 18px;">{{ $product->title }}</p>
                            <p style="font-weight:500;">
                                <span class="badge badge-success">Code</span>
                                <span class="badge badge-warning">{{ $product->code }}</span>
                            </p>
                            <p style="font-weight:500;">
                                <span class="badge badge-info">Product Id</span> </span> <span class="badge badge-warning">{{ $product->product_id }}</span></p>
                            <p>{{ $product->summary }}</p>
                        </td>
                        <td class="number">{{ number_format($product->price) }} VND</td>
                        <td class="number">{{ $product->items()->count() }}</td>
                        <td>
                            @foreach($product->categories as $category)
                            <?php $href = route('product.product_list', array('category' => $category->id)); ?>
                            {!! '[ <a href="'.$href.'">'.$category->title.'</a> ] ' !!}
                            @endforeach
                        </td>
                        <td class="center">{{ $product->created_at }}</td>
                        <td class="action">
                            <a href="{{ route('product.edit', [ $product->product_id ]) }}" style="margin-right: 10px"><i class="mdi mdi-settings" style="font-size: 20px;"></i></a>
                            <a href="{{ route('product.delete', [ $product->product_id ]) }}" style="margin-right: 10px"><i class="mdi mdi-delete" style="font-size: 20px;"></i></a>
                            <a href="{{ route('product.items', [ $product->product_id ]) }}"><i class="mdi mdi-collection-item-1" style="font-size: 20px;"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin: 10px 0;">
                {{ $products->appends($_GET)->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection
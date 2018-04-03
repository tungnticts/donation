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
        <div class="col-sm-12">
            <table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting" style="width:150px">Ảnh</th>
                        <th class="sorting_asc" style="width:35%">Tiêu đề</th>
                        <th class="number">Số lượng sản phẩm</th>
                        <th class="sorting">Ngày tạo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr class="gradeA odd" role="row">
                        <td><img class="img-thumbnail" style="width: 130px" src="{{ $category->thumbnail }}"/></td>
                        <td class="sorting_1">
                            <p style="font-weight:500;">{{ $category->title }}</p>
                            <p>{{ $category->summary }}</p>
                        </td>
                        <td class="number">{{ $category->totalProduct }}</td>
                        <td class="center">{{ $category->created_at }}</td>
                        <td class="action">
                            {{-- <a href="{{ route('product.edit', [ $product->id ]) }}" style="margin-right: 10px"><i class="mdi mdi-settings"></i></a>
                            <a href="{{ route('product.delete', [ $product->id ]) }}"><i class="mdi mdi-delete"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin: 10px 0;">
                {{ $categories->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection
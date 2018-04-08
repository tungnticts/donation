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
					@if ($errors->all())
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
						@endif
			</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-sm-4">
			<span class="badge badge-secondary">Còn: {{ $array_total[0] }} chiếc</span>
			<span class="badge badge-success">Đã bán: {{ $array_total[1] }} chiếc</span>
			<span class="badge badge-warning">Đặt: {{ $array_total[2] }} chiếc</span>
		</div>
		<div class="col-sm-4" style="text-align: right;">
			<form action="/admin/items/store" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
				<input id="file-1" name="file"  class="inputfile" type="file">
				<label for="file-1" class="btn-primary"> <i class="mdi mdi-upload"></i><span>Browse files...</span></label>
				<button class="btn btn-warning" type="submit">Upload</button>
			</form>
		</div>
	</div>
	<div class="row justify-content-center">
			<div class="col-sm-8">
				<table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
						<thead>
								<tr role="row">
									<th>no.</th>
									<th class="sorting_asc" style="width:25%">Tên sản phẩm</th>
									<th class="sorting_asc" style="width:20%">Mã sản phẩm</th>
									<th class="number">Size</th>
									<th class="number">Trạng thái</th>
									<th class="sorting">Ngày nhập</th>
									<th></th>
									<th></th>
								</tr>
						</thead>
						<tbody>
								<?php
										$arr_status = array(
												'<span class="badge badge-secondary">Stock</span>',
												'<span class="badge badge-success">Sold</span>',
												'<span class="badge badge-warning">Booked</span>'
										);
								?>
								@foreach($items as $key => $item)
								<tr class="gradeA odd" role="row">
									<td>{{ $key+1 }}</td>
									<td class="sorting_1">
											<p style="font-weight:500;">{{ $item->product->title }}</p>
									</td>
									<td class="sorting_1">
											<p style="font-weight:500;">{{ $item->product->code }}</p>
									</td>
									<td class="number"><span class="badge badge-danger">{{ $item->size }}</span></td>
									<td class="number">{!!$arr_status[$item->status] !!}</td>
									<td class="center">{{ $item->created_at }}</td>
									<td class="action">
											<a href="{{ route('product.edit', [ $item->id ]) }}" style="margin-right: 10px"><i class="mdi mdi-settings"></i></a>
											<a href="{{ route('product.delete', [ $item->id ]) }}"><i class="mdi mdi-delete"></i></a>
									</td>
									<td>
										<p style="margin:0 0 5px"><a href="{{ route('product.change_status_item', [ 'id' => $item->id, 'status' => 0 ]) }}" style="margin-right: 10px" class="btn btn-secondary btn-xs">Set Stock</a></p>
										<p style="margin:0 0 5px"><a href="{{ route('product.change_status_item', [ 'id' => $item->id, 'status' => 1 ]) }}" style="margin-right: 10px" class="btn btn-success btn-xs">Set Sold</a></p>
										<p style="margin:0 0 5px"><a href="{{ route('product.change_status_item', [ 'id' => $item->id, 'status' => 2 ]) }}" style="margin-right: 10px" class="btn btn-warning btn-xs">Set Booked</a></p>
									</td>
								</tr>
								@endforeach
						</tbody>
				</table>
				<div style="margin: 10px 0;">
						{{ $items->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
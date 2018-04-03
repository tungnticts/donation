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
	<div class="row justify-content-center">
		<div class="col-sm-8">
			<span class="badge badge-secondary">Còn: {{ $array_total[0] }} chiếc</span>
			<span class="badge badge-success">Đã bán: {{ $array_total[1] }} chiếc</span>
			<span class="badge badge-warning">Đặt: {{ $array_total[2] }} chiếc</span>
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
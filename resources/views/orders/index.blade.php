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
                        <th class="center">No.</th>
                        <th class="sorting" style="width:150px">Tên sản phẩm</th>
                        <th class="sorting_asc" >Tổng tiền</th>
                        <th class="" >Trạng thái <br /> thanh toán</th>
                        <th class="" >Trạng thái <br /> đơn hàng</th>
                        <th class="">Hình thức <br /> thanh toán</th>
                        <th class="">Transaction Refer No<br />VTC</th>
                        <th class="">Tên khách hàng</th>
                        <th class="">Số điện thoại</th>
                        <th class="">Địa chỉ</th>
                        <th class="sorting">Ngày tạo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $payment_type = array(
                        0 => '<span class="badge badge-primary">VTCpay</span>',
                        1 => '<span class="badge badge-warning">NH nội địa</span>',
                        2 => '<span class="badge badge-secondary">Visa/Master</span>',
                      );
                      $status = array(
                        0 => 'Chưa đóng gói',
                        1 => 'Đóng gói',
                        2 => 'Chuyển ship',
                        3 => 'Ship thành công',
                        4 => 'Bị trả hàng'
                      );
                    ?>
                    @foreach($orders as $key => $order)
                    <tr class="gradeA odd" role="row">
                        <td class="center">{{ $key + 1 }}</td>
                        <td>{{ $order->package()->first()->title }}</td>
                        <td class="sorting_1">{{ number_format($order->total_price) }} VND</td>
                        <td class="number">
                          <?php
                             switch($order->payment_status)
                             {
                              case 0:
                                echo '<span class="badge badge-dark">Khởi tạo</span>';
                                break;
                              case 1:
                                echo '<span class="badge badge-success">Success</span>';
                                break;
                              case 7:
                                echo '<span class="badge badge-warning">Review</span>';
                                break;
                              case -1:
                                echo '<span class="badge badge-info">GD fail</span>';
                                break;
                              case -9:
                                echo '<span class="badge badge-danger">Khách hủy GD</span>';
                                break;
                              default:
                                echo '<span class="badge badge-secondary">Fail</span>';
                                break;
                             }
                          ?>
                        </td>
                        <td class="center">{{ $status[$order->status] }}</td>
                        <td class="center">{!! $payment_type[$order->payment_type] !!}</td>
                        <td class="center">{{ $order->trans_ref_no }}</td>
                        <td class="action">{{ $order->last_name.' '.$order->first_name }}</td>
                        <td class="center">{{ $order->phone_number }}</td>
                        <td class="center">{{ $order->address.', '.$order->city }}</td>
                        <td class="center">{{ $order->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin: 10px 0;">
                {{ $orders->appends($_GET)->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection
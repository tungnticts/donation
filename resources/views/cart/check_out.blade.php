@extends('layouts.home')

@section('content')
<style>
    .form-row {
        margin-bottom: 10px;
    }
</style>
<form method="POST" action="/pay_to_vtc">
    {{csrf_field()}}
<div class="row">
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
    <div class="col-md-6">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Họ" name="last_name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Tên" name="first_name">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Số điện thoại" name="phone_number">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <select class="form-control" name="city">
                        <option>Hà nội</option>
                        <option>Hồ Chí Minh</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <input type="hidden" name="package_id" value="{{ $package->id }}" />
            <input type="hidden" name="total_price" value="{{ $package->price + 30000 }}" />
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Tổng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $package->title }}</th>
                    <td>{{ number_format($package->price) }} VND</td>
                </tr>
                <tr>
                    <th scope="row">Vận chuyển</th>
                    <td>Giao hàng nhanh  30.000 VND</td>
                </tr>
                <tr>
                    <th scope="row">Tổng</th>
                    <td colspan="2">{{ number_format($package->price + 30000) }} VND</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" data-toggle="collapse" href="#vtc_pay" aria-expanded="false" aria-controls="vtc_pay" value="0">
                <label class="form-check-label" for="exampleRadios1">
                    Thanh toán bằng ví điện tử VTCpay
                </label>
            </div>
        </p>
        <div class="collapse" id="vtc_pay">
            <div class="card card-body">
                Phương thức thanh toán “Trả tiền mặt khi nhận hàng” – COD (Cash on delivery) sẽ gửi hàng trực tiếp tới tận nhà bạn, và bạn thanh toán tiền với nhân viên bưu điện. Đây là phương thức tiện lợi dành cho các bạn không có tài khoản ngân hàng.
            </div>
        </div>
        <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" data-toggle="collapse" href="#domestic" aria-expanded="false" aria-controls="domestic" value="1" >
                <label class="form-check-label" for="exampleRadios1">
                    Thanh toán bằng thẻ nội địa
                </label>
            </div>
        </p>
        <div id="domestic" class="collapse">
            <div  class="card card-body">
                <p>Nếu bạn có tài khoản ngân hàng, có thẻ ATM, thẻ tín dụng (Visa, Master Card) và đang ngồi trước máy tính nối mạng, bạn có thể thanh toán bằng phương thức này.</p>
                <p>Bạn có thể có 2 lựa chọn.</p>
                <p>[1] Nếu bạn muốn dùng thẻ ATM hoặc thẻ tín dụng (chỉ chấp nhận thẻ Visa, Master Card ngân hàng Việt Nam) để thanh toán, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng thẻ ATM”</p>
                <p>[2] Nếu bạn muốn chuyển khoản online bằng Internet Banking, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng Internet Banking”</p>
                <p>Bạn chọn ngân hàng bằng cách click vào logo ngân hàng để chọn. Sau đó nhấn nút “Thanh toán”.
                Chức năng này được hỗ trợ bởi cổng thanh toán trực tuyến <b>VTCPay</b>.</p>
            </div>
        </div>
        <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" data-toggle="collapse" href="#international_card" aria-expanded="false" aria-controls="international_card" value="2" >
                <label class="form-check-label" for="exampleRadios1">
                    Thanh toán bằng thẻ quốc tế (VISA/Master)
                </label>
            </div>
        </p>
        <div id="international_card" class="collapse">
            <div  class="card card-body">
                <p>Nếu bạn có tài khoản ngân hàng, có thẻ ATM, thẻ tín dụng (Visa, Master Card) và đang ngồi trước máy tính nối mạng, bạn có thể thanh toán bằng phương thức này.</p>
                <p>Bạn có thể có 2 lựa chọn.</p>
                <p>[1] Nếu bạn muốn dùng thẻ ATM hoặc thẻ tín dụng (chỉ chấp nhận thẻ Visa, Master Card ngân hàng Việt Nam) để thanh toán, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng thẻ ATM”</p>
                <p>[2] Nếu bạn muốn chuyển khoản online bằng Internet Banking, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng Internet Banking”</p>
                <p>Bạn chọn ngân hàng bằng cách click vào logo ngân hàng để chọn. Sau đó nhấn nút “Thanh toán”.
                Chức năng này được hỗ trợ bởi cổng thanh toán trực tuyến <b>VTCPay</b>.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" type="submit">Thanh Tóan</button>
        </div>
    </div>
</div>
</form>
@endsection
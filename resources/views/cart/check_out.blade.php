@extends('layouts.home')

@section('content')
<style>
    .form-row {
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <form>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Họ">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Tên">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Số điện thoại">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Địa chỉ">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <select class="form-control" id="exampleFormControlSelect1">
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
        </form>
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
                    <td>Hoa văn đại Việt</th>
                    <td>100.000 VND</td>
                </tr>
                <tr>
                    <th scope="row">Vận chuyển</th>
                    <td>Giao hàng nhanh  30.000 VND</td>
                </tr>
                <tr>
                    <th scope="row">Tổng</th>
                    <td colspan="2">130.000 VND</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" data-toggle="collapse" href="#cod" aria-expanded="false" aria-controls="cod" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                    Trả tiền mặt khi nhận hàng
                </label>
            </div>
        </p>
        <div class="collapse" id="cod">
            <div class="card card-body">
                Phương thức thanh toán “Trả tiền mặt khi nhận hàng” – COD (Cash on delivery) sẽ gửi hàng trực tiếp tới tận nhà bạn, và bạn thanh toán tiền với nhân viên bưu điện. Đây là phương thức tiện lợi dành cho các bạn không có tài khoản ngân hàng.
            </div>
        </div>
        <p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="option1">
                <label class="form-check-label" for="exampleRadios1">
                    Chuyển khoản ngân hàng hoặc thanh toán bằng thẻ ATM, thẻ Visa, Internet Banking
                </label>
            </div>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <p>Nếu bạn có tài khoản ngân hàng, có thẻ ATM, thẻ tín dụng (Visa, Master Card) và đang ngồi trước máy tính nối mạng, bạn có thể thanh toán bằng phương thức này.</p>
                <p>Bạn có thể có 2 lựa chọn.</p>
                <p>[1] Nếu bạn muốn dùng thẻ ATM hoặc thẻ tín dụng (chỉ chấp nhận thẻ Visa, Master Card ngân hàng Việt Nam) để thanh toán, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng thẻ ATM”</p>
                <p>[2] Nếu bạn muốn chuyển khoản online bằng Internet Banking, xin vui lòng chọn ngân hàng ở trong danh sách “Thanh toán bằng Internet Banking”</p>
                <p>Bạn chọn ngân hàng bằng cách click vào logo ngân hàng để chọn. Sau đó nhấn nút “Thanh toán”.
                Chức năng này được hỗ trợ bởi cổng thanh toán trực tuyến <b>VTCPay</b>.</p>
            </div>
        </div>
    </div>
</div>
@endsection
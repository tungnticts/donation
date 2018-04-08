<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Package;
use App\Cart;
use App\Order;
use Validator;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Request $request) {
     
        return View('cart.index');
    }
    public function check_out(Request $request) {
        if (!$request->input('package_id'))
        {
            return back();
        }
        $package = Package::find($request->input('package_id'));
        if (!$package) {
            return back()->with('error', 'Package không tồn tại');
        }
        $total = Order::where('package_id', '=', $package->id)->count();
        if ($total >= $package->quantity) {
            return back()->with('error', 'Package đã hết');
        }
        return View('cart.check_out', ['package' => $package]);
    }
    public function pay_to_vtc(Request $request) {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'city' => 'required',
            // 'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'package_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $order = new Order();
        $order->package_id = $request->input('package_id');
        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->phone_number = $request->input('phone_number');
        $order->payment_type = $request->input('payment_method'); // 0: vtcPay, 1: thẻ nội địa, 2: thẻ quốc tế visa - master
        $order->payment_status = 0;
        $order->total_price = $request->input('total_price');
        $order->status = 0; // 0: mặc định tạo đơn hàng, sẽ thay đổi khi vtc pay trả về trạng thái. Dựa theo trạng thái được vtc pay định nghĩa trong document http://sandbox3.vtcebank.vn/VTCDocuments/TaiLieuTichHopWebSite_V2.html
        $order->quantity = 1;
        $order->is_ship = 0; // 0: chưa đóng hàng, 1: đóng hàng, 2: đã gửi ship
        $order->save();

        $method_payment = array(
            0 => 'VTCPay',
            1 => 'DomesticBank',
            2 => 'InternationalCard',
        );
        $amount = $request->input('total_price');
        $bill_to_address = $request->input('address');
        $bill_to_address_city = $request->input('city');
        $bill_to_email = $request->input('email');
        $bill_to_forename = $request->input('first_name');
        $bill_to_phone = $request->input('phone_number');
        $bill_to_surname = $request->input('last_name');
        $currency = 'VND'; // VND, USA
        $language = 'vi'; // vi, en
        $payment_type = $method_payment[$request->input('payment_method')]; // VTCpay, DomesticBank, InternationalCard,
        $receiver_account = '0963465816';
        $reference_number = $order->id;
        $transaction_type = 'sale';
        $url_return = 'http://localhost/callback';
        $website_id = '36085';
        $security_code = 'Asdfghjkl*123456789';
        $signature_no_hash = $amount.'|'.$currency.'|'.$payment_type.'|'.$receiver_account.'|'.$reference_number.'|'.$url_return.'|'.$website_id.'|'.$security_code;

        $signature = strtoupper(hash('sha256', $signature_no_hash));

        $redirect_url = 'http://alpha1.vtcpay.vn/portalgateway/checkout.html?amount='.$amount.'&currency='.$currency.'&payment_type='.$payment_type.'&receiver_account='.$receiver_account.'&reference_number='.$reference_number.'&url_return='.urlencode($url_return).'&website_id='.$website_id.'&signature='.$signature;
        return redirect($redirect_url);
    }
    public function call_back(Request $request) {

        Log::debug('amount='.$request->input('amount').'|message='.$request->input('message').'|payment_type='.$request->input('payment_type').'|reference_number='.$request->input('reference_number').'|status='.$request->input('status').'|trans_ref_no='.$request->input('trans_ref_no').'|website_id='.$request->input('website_id').'|signature='.$request->input('signature'));

        $order = Order::find($request->input('reference_number'));
        if (!$order) {
            return redirect('/projects')->with('fail', 'Đơn hàng không tồn tại');
        }
        $amount = $order->total_price;
        $message = $request->input('message');
        $currency = 'VND';
        $payment_type = $request->input('payment_type');
        $receiver_account = '0963465816';
        $reference_number = $order->id;
        $status = $request->input('status');
        $trans_ref_no = $request->input('trans_ref_no');
        $url_return = 'http://localhost/callback';
        $website_id = '36085';
        $security_code = 'Asdfghjkl*123456789';
        // http://localhost/callback?amount=50000&message=&payment_type=VTCPAY&reference_number=1&status=1&trans_ref_no=274731&website_id=36085&signature=583866DF1CAE6C89A02D5CAABA9ED2939E1F6B0D193337A79EF669D1924DDAB3

        // Amount|message|paymentType|reference_number| status|trans_ref_no|website_id|secret_key

        $signature_no_hash = $amount.'|'.$message.'|'.$payment_type.'|'.$reference_number.'|'.$status.'|'.$trans_ref_no.'|'.$website_id.'|'.$security_code;
        
        $signature = strtoupper(hash('sha256', $signature_no_hash));
        // dd($signature);
        if ($signature !== $request->input('signature')) {
            return redirect('/projects')->with('fail', 'Sai chữ kí thanh toán');
        }

        $order->message = $request->input('message');
        $order->trans_ref_no = $request->input('trans_ref_no');
        $order->payment_status = $request->input('status');
        $order->save();

        return redirect('/projects')->with('success', 'Thanh toán thành công');
    }
}

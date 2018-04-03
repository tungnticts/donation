<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CartController extends Controller
{
    public function index($id, $type) {
        return View('cart.index');
    }
    public function check_out() {
        return View('cart.check_out');
    }
    public function pay_to_vtc() {
        // amount|bill_to_address|bill_to_address_city|bill_to_email|bill_to_forename|bill_to_phone|bill_to_surname|currency|language|payment_type|receiver_account|reference_number|transaction_type|url_return|website_id|SecurityCode
        $amount = 100000;
        $bill_to_address = '296 Minh Khai, Ha Noi';
        $bill_to_address_city = 'Ha Noi';
        $bill_to_email = 'tung.nguyen205@gmail.com';
        $bill_to_forename = 'Tung';
        $bill_to_phone = '0912333999';
        $bill_to_surname = 'Nguyen';
        $currency = 'VND'; // VND, USA
        $language = 'vi'; // vi, en
        $payment_type = 'VTCpay'; // VTCpay, DomesticBank, InternationalCard,
        $receiver_account = '0963465816';
        $reference_number = '2051992';
        $transaction_type = 'sale';
        $url_return = 'http://locahost/callback';
        $website_id = '36085';
        $security_code = 'Asdfghjkl*123456789';
        $signature_no_hash = $amount.'|'.$currency.'|'.$payment_type.'|'.$receiver_account.'|'.$reference_number.'|'.$url_return.'|'.$website_id.'|'.$security_code;

        $signature = strtoupper(hash('sha256', $signature_no_hash));

        $redirect_url = 'http://alpha1.vtcpay.vn/portalgateway/checkout.html?amount='.$amount.'&currency='.$currency.'&payment_type='.$payment_type.'&receiver_account='.$receiver_account.'&reference_number='.$reference_number.'&url_return='.urlencode($url_return).'&website_id='.$website_id.'&signature='.$signature;
        return redirect($redirect_url);
    }
}

<?php

namespace App\Services\Order;

use LaravelEasyRepository\Service;
use App\Repositories\Order\OrderRepository;

class OrderServiceImplement extends Service implements OrderService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(OrderRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)

    public function createOrder(array $payload)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $orderId = 'INV-' . time();
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $payload['total_price'],
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            // 'enabled_payments' => ['gopay', 'bank_transfer'],
            // 'vtweb' => []
        ];
        $snapMidtrans = \Midtrans\Snap::createTransaction($params);
        $this->mainRepository->create([
            'user_id' => auth()->user()->id,
            'number' => $orderId,
            'total_price' => $payload['total_price'],
            'status' => '1',
            'snap_token' => $snapMidtrans->token,
            'redirect_url' => $snapMidtrans->redirect_url,
        ]);
        return $snapMidtrans;
    }

    public function finishedTransaction($number)
    {
        $order = $this->mainRepository->findBy('number', $number);
        $order->status = '2';
        $order->save();
        $items = auth()->user()->cart;
        foreach ($items as $item) {
            $item->cart()->detach(auth()->user()->id);
        }
        return $order;
    }
}

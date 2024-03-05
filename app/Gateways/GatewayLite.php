<?php

declare(strict_types=1);

namespace BeycanPress\CryptoPay\EDD\Gateways;

use EDD\Orders\Order;
use BeycanPress\CryptoPayLite\Payment;
use BeycanPress\CryptoPayLite\Types\Order\OrderType;

final class GatewayLite extends AbstractGateway
{
    /**
     * GatewayLite constructor.
     */
    public function __construct()
    {
        parent::__construct('cryptopay_lite', 'CryptoPay Lite');
    }

    /**
     * @param Order $order
     * @return void
     */
    public function receipt(Order $order): void
    {
        if ($order->is_complete()) {
            return;
        }

        echo (new Payment('edd'))
        ->setOrder(
            OrderType::fromArray([
                'id' => $order->get_number(),
                'amount' => $order->total,
                'currency' => edd_get_currency(),
            ])
        )->html(loading:true);
    }
}

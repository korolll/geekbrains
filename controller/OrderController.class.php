<?php

class OrderController extends Controller
{
    public $view = 'order';
    public $title = 'order';

    public function create()
    {
        if (!empty($_POST) && !empty($_SESSION['user'])) {
            $order = new Order([
                'user_id' => $_SESSION['user']['id']
            ]);
            $orderId = $order->create();
            if (!$orderId) {
                //...
            }
            foreach ($_POST as $id => $number) {
                $orderGood = new OrderGood([
                    'order_id' => $orderId,
                    'good_id' => $id,
                    'good_number' => $number
                ]);
                $orderGood->create();
            }
        }

        unset($_SESSION['basket']);
        $this->goToMain();
    }
}
<?php
    namespace App\Http\Controllers;

    use App\Services\StripePaymentService;
    use App\Services\CartService;

    class PaymentController{
        private StripePaymentService $stripePayment;

        public function __construct(StripePaymentService $stripePayment){
            $this->stripePayment = $stripePayment;
        }

        public function index():void{
            view('pages/payment');
        }

        public function pay():void{
            $this->stripePayment->startPayment(CartService::get());
        }

        public function success():void{
            $paymentSuccess = $this->stripePayment->success();
            if($paymentSuccess){
                CartService::clear();
                view('pages/success');
            }else{
                $this->cancel();
            }
        }

        public function cancel():void{
            view('pages/cancel');
        }
    }
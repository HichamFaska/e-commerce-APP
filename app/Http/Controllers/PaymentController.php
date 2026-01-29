<?php
    namespace App\Http\Controllers;

    use App\Models\Commande;
    use App\Services\StripePaymentService;
    use App\Services\CartService;

    class PaymentController{
        private StripePaymentService $stripePayment;
        private Commande $commande;

        public function __construct(StripePaymentService $stripePayment, Commande $commande){
            $this->stripePayment = $stripePayment;
            $this->commande = $commande;
        }

        public function index():void{
            view('pages/payment');
        }

        public function pay():void{
            $this->commande->update($_SESSION['id_commande'], 'en_cours');
            $this->stripePayment->startPayment(CartService::get());
        }

        public function success():void{
            $paymentSuccess = $this->stripePayment->success();
            if($paymentSuccess){
                $this->commande->update($_SESSION['id_commande'], 'payé');
                CartService::clear();
                view('pages/success');
            }else{
                $this->commande->update($_SESSION['id_commande'], 'annulée');
                $this->cancel();
            }
        }

        public function cancel():void{
            view('pages/cancel');
        }
    }
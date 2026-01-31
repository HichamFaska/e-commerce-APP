<?php
    namespace App\Http\Controllers;

    use App\Models\Commande;
use App\Models\Produit;
use App\Services\StripePaymentService;
    use App\Services\CartService;

    class PaymentController{
        private StripePaymentService $stripePayment;
        private Commande $commande;
        private Produit $produit;

        public function __construct(StripePaymentService $stripePayment, Commande $commande, Produit $produit){
            $this->stripePayment = $stripePayment;
            $this->commande = $commande;
            $this->produit = $produit;
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
                foreach(CartService::get() as $key => $produit){
                    $this->produit->updateStock($key, $produit['quantite']);
                }
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
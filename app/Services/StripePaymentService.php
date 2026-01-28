<?php
    namespace App\Services;

    use App\Core\Env;
    use App\Http\Request;
    use Stripe\Checkout\Session;
    use Stripe\Stripe;
    use Exception;

    class StripePaymentService{

        private Request $request;

        public function __construct(Request $request){
            $this->request = $request;
            Stripe::setApiKey(Env::get('SECRET_KEY'));
        }

        public function startPayment(array $cart):void{
            if (empty($cart)) {
                throw new Exception('Le panier est vide.');
            }
            $lineItems = [];
                    
            foreach($cart as $item){
                $prix = ( $item['price'] - $item['discount']) * 100;
                $lineItems[] = [
                    'quantity' => (int) $item['quantite'],
                    'price_data' => [
                        'currency' => 'MAD',
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                        'unit_amount' => (int)$prix,
                    ],
                ];
            }
            $session = Session::create([
                'mode' => 'payment',
                'line_items' => $lineItems,
                'success_url' => 'http://127.0.0.1:8001/payment/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => 'http://127.0.0.1:8001/payment/cancel',
            ]);

            header('HTTP/1.1 303 See Other');
            header('Location:'.$session->url);
            exit;
        }

        public function success():bool{
            if (!$this->request->has('session_id')) {
                http_response_code(400);
                return false;
            }
            try {
                $session = Session::retrieve($this->request->input('session_id'));
                if ($session->payment_status !== 'paid') {
                    return false;
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }
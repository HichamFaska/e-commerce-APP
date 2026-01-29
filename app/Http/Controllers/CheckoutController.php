<?php
    namespace App\Http\Controllers;

    use App\Auth\Auth;
    use App\Http\Request;
    use App\Models\Adresse;
    use App\Services\CartService;
    use App\Models\Commande;
use App\Services\OrderService;

    class CheckoutController{
        private Request $request;
        private Adresse $adresse;
        private Commande $commande;
        private OrderService $orderService;

        public function __construct(Request $request, Adresse $adresse, Commande $commande, OrderService $orderService){
            $this->adresse = $adresse;
            $this->request = $request;
            $this->commande = $commande;
            $this->orderService = $orderService;
        }

        public function index():void{
            $id_utilisateur = Auth::getId();
            $cart = CartService::get();
            $total = CartService::total();
            $adresses = $this->adresse->getAll($id_utilisateur);
            view('pages/checkout', [
                'adresses' => $adresses,
                'cart' => $cart,
                'total' => $total
            ]);
        }

        public function store(){
            $id_utilisateur = Auth::getId();
            $address = $this->request->input('address');
            if($address == "custom"){
                $pays = $this->request->input('pays');
                $nomContact = $this->request->input('nomContact');
                $ville = $this->request->input('ville');
                $tel = $this->request->input('tel');
                $code_postal = $this->request->input('code_postal');
                $data = compact('pays', 'nomContact', 'ville', 'tel', 'code_postal');
                $id_adresse = $this->adresse->create($data, $id_utilisateur);
            }
            else{
                $id_adresse = $this->adresse->find($address);
            }
            $items = CartService::get();
            $numCommande = $this->orderService->getNewNumCommande();
            $id_commande = $this->commande->create($items, $numCommande, $id_adresse ,$id_utilisateur);

            $_SESSION['id_commande'] = $id_commande;
            
            header('Location: /payment');
            exit;
        }

    }
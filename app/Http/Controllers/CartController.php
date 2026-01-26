<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\Produit;
    use App\Services\CartService;

    class CartController{
        private Request $request;
        private Produit $produit;

        public function __construct(Request $request, Produit $produit){
            $this->produit = $produit;
            $this->request = $request;
        }

        public function index():void{
            $cartContent = CartService::get();
            $totalCart = CartService::total();
            $nbProduct = CartService::count();
            $redirection = $this->request->path();
            view("pages/cart", compact('cartContent', 'totalCart', 'nbProduct', 'redirection'));
        }

        public function addToCart():void{
            $id_produit = $this->request->input('id_produit');
            $quantite = $this->request->input('quantite', 1);
            $redirect = $this->request->input('redirect');

            $produit = $this->produit->find($id_produit);
            CartService::add($produit, $quantite);

            header('Location: '.$redirect);
            exit;
        }

        public function remove():void{
            $id_produit = $this->request->input('id_produit');
            $redirect = $this->request->input('redirect', '/cart');

            CartService::remove($id_produit);

            header('Location: '.$redirect);
            exit;
        }

        public function update(){
            $id_produit = $this->request->input('id_produit');
            $quantite = $this->request->input('quantite', 1);
            $redirect = $this->request->input('redirect', '/cart');

            CartService::update($id_produit, $quantite);

            header('Location: '.$redirect);
            exit;
        }
    }
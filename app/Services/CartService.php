<?php
    namespace App\Services;

    class CartService{
        public static function get():array{
            return $_SESSION['cart'] ?? [];
        }

        public static function add(Object $produit, int $quantite = 1):void{
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = [];
            }

            $id_produit = $produit->id_produit;
            if(isset($_SESSION['cart'][$id_produit])){
                $_SESSION['cart'][$id_produit]['quantite'] += $quantite;
            }
            else{
                $discount = ($produit->valeur_discount ?? 0) > 0 ? ($produit->prixVente * $produit->valeur_discount / 100) : 0;
                $_SESSION['cart'][$id_produit] = [
                    'id' => $produit->id_produit,
                    'name' => $produit->designation,
                    'price' => $produit->prixVente,
                    'discount' => $discount,
                    'image' => $produit->url,
                    'quantite' => $quantite,
                    "quantiteStock" => $produit->quantiteStock
                ];
            }
        } 

        public static function remove(int $id_produit):void{
            if(isset($_SESSION['cart'][$id_produit])){
                unset($_SESSION['cart'][$id_produit]);
            }
        }

        public static function update(int $id_produit, int $quantite):void{
            if(isset($_SESSION['cart'][$id_produit])){
                $_SESSION['cart'][$id_produit]['quantite'] = $quantite;
            }
        }

        public static function clear(){
            $_SESSION['cart'] = array();
        } 

        public static function total():float{
            return array_reduce(self::get(), function ($total, $item) {
                return $total + (($item['price'] - $item['discount']) * $item['quantite']);
            }, 0.0);
        }

        public static function count():int{
            return array_sum(array_column(self::get(), 'quantite'));
        }
    }
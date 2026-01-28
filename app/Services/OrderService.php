<?php
    namespace App\Services;
    use App\Models\Commande;

    class OrderService{
        private Commande $commande;

        public function __construct(Commande $commande){
            $this->commande = $commande;
        }

        public function getNewNumCommande():string{
            $lastNumCommande = $this->commande->getLastNumCommande();
            $annee = date('Y');
            if(!$lastNumCommande){
                return "CMD-".$annee."-0001";
            }

            $parts = explode("-", $lastNumCommande);
            $lastYear = $parts[1];
            $lastNum = intval($parts[2]);

            if($lastYear != $annee){
                return "CMD-".$annee."-0001";
            }

            return "CMD-".$annee."-".str_pad(++$lastNum, 4, "0", STR_PAD_LEFT);
        }
    }
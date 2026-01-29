<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use PDOException;
    use Exception;

    class Commande{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function getLastNumCommande():?string{
            try{
                $stmt = $this->conn->prepare("SELECT NumCommande FROM commandes ORDER BY id_commande DESC LIMIT 1");
                $stmt->execute();
                $result = $stmt->fetch();
                return $result ? $result->NumCommande : null;
            }
            catch(PDOException $e){
                throw new PDOException("erreur lors de la récuperation des informations");
            }
        }

        public function create(array $items, string $numCommande, int $id_adresse, int $id_utilisateur):int{
            try{
                $this->conn->beginTransaction();

                $stmt = $this->conn->prepare("INSERT INTO commandes (NumCommande, date_commande, id_adresse, id_utilisateur) VALUES( ? , NOW(), ? , ?)");
                $stmt->execute([$numCommande, $id_adresse, $id_utilisateur]);
                $id_commande = $this->conn->lastInsertId();

                $stmt = $this->conn->prepare("INSERT INTO lignesCommande (id_Produit, id_commande, quantité, prixUnitaire) VALUES ( ? , ? , ? , ?)");
                foreach($items as $item){
                    $stmt->execute([$item['id'], $id_commande , $item['quantite'], $item['price']]);
                }

                $this->conn->commit();
                return $id_commande;
            }
            catch(PDOException $e){
                $this->conn->rollBack();
                throw new Exception("Erreur lors de la creation de la commande!!!");
            }
        }

        public function update(int $id_commande, string $statut):void{
            try{
                $stmt = $this->conn->prepare("UPDATE commandes SET statut = ? WHERE id_commande = ?");
                $stmt->execute([$statut, $id_commande]);
            }
            catch(PDOException $e){
                throw new Exception("Erreur lors de la modification");
            }
        }
    }
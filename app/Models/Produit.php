<?php
    namespace App\Models;
    use App\Database\Database;
    use Exception;
    use PDOException;
    use PDO;

    class Produit{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function getPromotedProducts():array{
            try{
                $stmt = $this->conn->prepare("SELECT p.designation, p.prixVente, p.quantiteStock, p.slug, i.url, m.nomMarque, pr.valeur_discount
                    FROM marques AS m
                    INNER JOIN produits AS p
                        ON m.id_marque = p.id_marque
                    INNER JOIN images_produit AS i
                        ON i.id_produit = p.id_produit
                    INNER JOIN promotions AS pr
                        ON pr.id_produit = p.id_produit
                        AND NOW() BETWEEN pr.date_debut AND DATE_ADD(pr.date_debut, INTERVAL pr.dure DAY)
                    WHERE i.est_principal = 1
                    ORDER BY pr.valeur_discount DESC
                    LIMIT 6
                ");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite.");
            }
        }
    }
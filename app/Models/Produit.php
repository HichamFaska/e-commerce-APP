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
                    LIMIT 5
                ");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite.");
            }
        }

        public function getPopularProducts():array{
            try{
                $stmt = $this->conn->prepare("SELECT p.id_produit, p.designation, p.prixVente, p.quantiteStock, m.nomMarque, i.url AS imagePrincipale, pr.valeur_discount, pv.Total
                    FROM marques AS m
                    INNER JOIN produits AS p
                        ON p.id_marque = m.id_marque 
                    INNER JOIN images_produit as i
                        ON i.id_Produit = p.id_Produit AND i.est_principal = 1
                    LEFT JOIN promotions as pr
                        ON pr.id_Produit = p.id_produit AND NOW() BETWEEN pr.date_debut AND DATE_ADD(pr.date_debut, INTERVAL pr.dure DAY)
                    INNER JOIN (SELECT COUNT(l.quantité) AS Total, p.id_produit
                        FROM produits AS p
                        INNER JOIN lignescommande AS l
                            ON l.id_produit = p.id_produit
                        GROUP BY p.id_produit
                    ) AS pv
                        ON pv.id_produit = p.id_Produit
                    ORDER BY pv.Total
                    LIMIT 5"
                );
                $stmt->execute();
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite.");
            }
        }

        public function getResentProduits():array{
            try{
                $stmt = $this->conn->prepare("SELECT p.designation, p.prixVente, p.quantiteStock, p.slug, i.url, m.nomMarque, pr.valeur_discount
                    FROM marques AS m
                    INNER JOIN produits AS p
                        ON m.id_marque = p.id_marque
                    INNER JOIN images_produit AS i
                        ON i.id_produit = p.id_produit
                    LEFT JOIN promotions AS pr
                        ON pr.id_produit = p.id_produit
                        AND NOW() BETWEEN pr.date_debut AND DATE_ADD(pr.date_debut, INTERVAL pr.dure DAY)
                    WHERE i.est_principal = 1
                    ORDER BY p.date_mise_en_vente DESC
                    LIMIT 5"
                );
                $stmt->execute();
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite.");
            }
        }

        public function getProductinfo(int $id):object{
            try{
                $stmt = $this->conn->prepare("SELECT p.id_Produit, p.designation, p.prixVente, p.quantiteStock, p.stock_critique, p.description, m.nomMarque, c.nomCategorie
                    FROM produits AS p
                    INNER JOIN categories AS c
                        ON p.id_categorie = c.id_categorie
                    INNER JOIN marques AS m
                        ON m.id_marque = p.id_marque
                    WHERE p.id_Produit = ?"
                );
                $stmt->execute([$id]);
                return $stmt->fetch();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite.");
            }
        }

        public function getImagesProduit(int $id):array{
            $stmt = $this->conn->prepare("SELECT i.url, i.est_principal
                FROM images_produit AS i
                WHERE i.id_Produit = ?"
            );
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }

        public function getCaracteristiquesProduit(int $id):array{
            $stmt = $this->conn->prepare("SELECT car.caracteristique, car.value_caracteristique
                FROM caracteristiques AS car
                WHERE car.id_Produit = ?"
            );
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }

        public function getPromotionProduit(int $id):array{
            $stmt = $this->conn->prepare("SELECT  promo.valeur_discount, promo.date_debut, promo.dure
                FROM promotions AS promo
                WHERE promo.id_Produit = ? AND NOW() BETWEEN promo.date_debut AND DATE_ADD(promo.date_debut, INTERVAL promo.dure DAY);
            ");
            $stmt->execute([$id]);
            return $stmt->fetchAll();
        }

        public function getDetailsOfProduct(int $id):array{
            try{
                $productInfo = $this->getProductinfo($id);
                $images = $this->getImagesProduit($id);
                $caracteristiques = $this->getCaracteristiquesProduit($id);
                $promotion = $this->getPromotionProduit($id);

                return [
                    "infoProduit" => $productInfo,
                    "images" => $images,
                    "caracteristiques" => $caracteristiques,
                    "promotion" => $promotion
                ];
            }
            catch(PDOException $e){
                throw new PDOException("une Erreur lors de la selection des détails d'un produit");
            }
        }
        
    }
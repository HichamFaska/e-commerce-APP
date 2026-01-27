<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use PDOException;

    class Caracteristique{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function create(string $caracteristique, string $value_caracteristique, int $id_produit):void{
            $stmt = $this->conn->prepare("INSERT INTO caracteristiques (caracteristique, value_caracteristique, id_Produit) VALUES
                (:caracteristique, :value_caracteristique, :id_Produit)");
            $stmt->execute([
                ':caracteristique' => $caracteristique,
                ':value_caracteristique' => $value_caracteristique,
                ':id_Produit' => $id_produit
            ]);
        }
    }
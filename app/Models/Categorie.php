<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use PDOException;

    class Categorie{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function getCategories():array{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM categories");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new PDOException("erreur lors de la récuperation des categorie");
            }
        }
    }
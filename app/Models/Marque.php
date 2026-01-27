<?php
    namespace App\Models;
    use App\Database\Database;
    use PDO;
    use PDOException;
    use Exception;

    class Marque{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function getAll():array{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM marques");
                $stmt->execute();
                return $stmt->fetchAll();
            }catch(PDOException $e){
                throw new PDOException("Erreur est survenue!");
            }
        }
    }
<?php
    namespace App\Models;
    use PDO;
    use App\Database\Database;
    use Exception;
    use PDOException;

    class User{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }
        
        public function findByEmail(string $email):?object{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
                $stmt->execute([$email]);
                return $stmt->fetch() ?: null;
            }
            catch(PDOException $e){
                throw new Exception("Erreur de vérification");
            }
        }

        public function create(array $data):int{
            try{
                $stmt = $this->conn->prepare("INSERT INTO utilisateurs (username, email, motDePasse)VALUES (?, ?, ?)");
                $stmt->execute([
                    $data['username'],
                    $data['email'],
                    $data['password']
                ]);
                return $this->conn->lastInsertId();
            }
            catch(PDOException $e){
                throw new Exception("erreur lors d'inscription.");
            }
        }

        public function updatePassword(string $email,string $newPassword){
            try{
                $stmt = $this->conn->prepare("UPDATE utilisateurs SET motDePasse = ? WHERE email = ?");
                $stmt->execute([$newPassword, $email]);
            }catch(PDOException $e){
                throw new Exception("erreur lors de modification du mot de passe!!");
            }
        }
    }
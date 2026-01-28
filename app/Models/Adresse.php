<?php
    namespace App\Models;

    use App\Database\Database;
    use Exception;
    use PDO;
    use PDOException;

    class Adresse{
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function create(array $data, int $id_utilisateur):int{
            try{
                $stmt = $this->conn->prepare("INSERT INTO adresses (pays, ville, nom_de_contact, tel, code_Postal, id_utilisateur) VALUES
                    (:pays, :ville, :nom_de_contact, :tel, :code_Postal, :id_utilisateur);");
                $stmt->execute([
                    ":pays" => $data['pays'],
                    ":ville" => $data['ville'],
                    ":nom_de_contact" => $data['nomContact'],
                    ":tel" => $data['tel'],
                    ":code_Postal" => $data['code_postal'],
                    ":id_utilisateur" => $id_utilisateur
                ]);
                return (int)$this->conn->lastInsertId();
            }
            catch(PDOException $e){
                throw new Exception("Erreur est survenue!");
            }
        }

        public function getAll(int $id_utilisateur):array{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM adresses WHERE id_utilisateur = :id_utilisateur");
                $stmt->execute([
                    ":id_utilisateur" => $id_utilisateur
                ]);
                return $stmt->fetchAll();
            }
            catch(PDOException $e){
                throw new Exception("Erreur est survenue!");
            }
        }

        public function find(int $id_address):int{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM adresses WHERE id_adresse = :id_adresse");
                $stmt->execute([
                    ":id_adresse" => $id_address
                ]);
                return $stmt->fetch()->id_adresse;
            }
            catch(PDOException $e){
                throw new Exception("Erreur est survenue!");
            }
        }
    }
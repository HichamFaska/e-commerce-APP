<?php
    namespace App\Models;

    use App\Database\Database;
    use PDO;
    use PDOException;
    use Exception;

    class PasswordReset {
        private PDO $conn;

        public function __construct(){
            $this->conn = Database::getConnection();
        }

        public function create(array $data):void{
            try{
                $this->delete($data['email']);
                $stmt = $this->conn->prepare("INSERT INTO password_resets (email, otp, token, expires_at)
                    VALUES (?, ?, ?, ?)"
                );
                $stmt->execute([$data['email'], $data['otp'], $data['token'], $data['expires']]);
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }

        private function delete(string $email):void{
            try{
                $stmt = $this->conn->prepare("DELETE FROM password_resets WHERE email = ?");
                $stmt->execute([$email]);
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }

        public function existsByToken(string $token):bool{
            try{
                $stmt = $this->conn->prepare("SELECT id FROM password_resets WHERE token = ?");
                $stmt->execute([$token]);
                return (bool) $stmt->fetch();
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }

        public function verifyOtp(string $token, int $otp):?object{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE token = ? AND otp = ? AND expires_at > NOW()");
                $stmt->execute([$token, $otp]);
                return $stmt->fetch() ?: null;
            }
            catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }

        public function findByToken($token):?object{
            try{
                $stmt = $this->conn->prepare("SELECT * FROM password_resets WHERE token = ?");
                $stmt->execute([$token]);
                return $stmt->fetch() ?: null;
            }catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }

        public function deleteByToken($token):void{
            try{
                $stmt = $this->conn->prepare("DELETE FROM password_resets WHERE token = ?");
                $stmt->execute([$token]);
            }catch(PDOException $e){
                throw new Exception("Une erreur s'est produite !");
            }
        }
    }
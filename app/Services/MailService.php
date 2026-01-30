<?php

namespace App\Services;

use App\Core\Env;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public static function sendOtp(string $email, string $otp): void
    {
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = Env::get('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = Env::get('MAIL_USERNAME');
            $mail->Password = Env::get('MAIL_PASSWORD');
            $mail->SMTPSecure = Env::get('MAIL_ENCRYPTION'); // tls
            $mail->Port = (int) Env::get('MAIL_PORT');

            $mail->setFrom(
                Env::get('MAIL_FROM_ADDRESS'),
                Env::get('MAIL_FROM_NAME')
            );

            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Code OTP de réinitialisation';
            $mail->Body = "
                <h2>Réinitialisation du mot de passe</h2>
                <p>Votre code OTP est :</p>
                <h1 style='letter-spacing:4px;'>$otp</h1>
                <p><strong>Valable 3 minutes</strong></p>
                <p>Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.</p>
            ";

            $mail->AltBody = "Votre code OTP est : $otp (valable 3 minutes)";

            $mail->send();

        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo);
        }
    }
}

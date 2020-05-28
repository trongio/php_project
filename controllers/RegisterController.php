<?php


namespace app\controllers;


use app\db\Database;
use app\IRequest;
use app\Router;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterController
{
    public function register(IRequest $request, Router $router)
    {
        $config = require __DIR__ . '/../config.php';
        $data = $request->getBody();
        $errors=[];
        $input=new database();
        $email_used=$input->get_email($data['email']);
        $name_used=$input->get_full_name($data['full_name']);

        if(!$data['full_name']) {
            $errors['full_name'] = "required field";
        }
        if($name_used){
            $errors['full_name'] = "name already in use";
        }
        if(!$data['email']) {
            $errors['email'] = "required field";
        }
        if($email_used){
            $errors['email'] = "email already in use";
        }
        if(!$data['password'])
            $errors['password'] = "required field";

        $params = [
                    'errors' => $errors,
                    'data' => $data
                ];

        copy('../views/PersonalPageTemplate.php','../views/'.$data['full_name'].'.php');

        $filepath = "../public/images/user_images/" . $data['full_name'] .".png";
        if(move_uploaded_file($_FILES["user_image"]["tmp_name"], $filepath)){
            $temp  = true;
        };

        if(empty($errors)){
            $input->register($data['full_name'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT), date("Y-m-d h:i:sa"));

            $mail = new PHPMailer(false);
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $config['mail_host'];                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $config['mail_username'];                     // SMTP username
            $mail->Password   = $config['mail_password'];                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            $mail->setFrom('AzaelBlog@gmail.com', 'New Account Creation');
            $mail->addAddress($data['email']);
            $mail->isHTML(true);
            $mail->Subject = 'You have been registered to Azael-s Blog website';
            $mail->AltBody = "Here are your credentials <br> User :" . $data["email"] . "<br>" . "Password : " . $data['password'] . "<br> Thank You!";
            $mail->Body = "Here are your credentials <br> User :" . $data["email"] . "<br>" . "Password : " . $data['password'] . "<br> Thank You!";

            $mail->send();

            return $router->renderView('login', $params);

        } else return $router->renderView('register', $params);
    }

}
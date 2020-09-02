<?php
/*
Autor: Alessandro Pinho 
Data: 22/07/2020

Meu canal do YouTube 
Falo sobre diversos assuntos relacionados tecnologia

https://www.youtube.com/channel/UCNEZXz8YNibbAG45imenfWA?sub_confirmation=1


Enviando Email usando biblioteca  PHPMailer  localmente usando servidor xampp windows 10 
PHPMailer verção 6.1.7


https://github.com/PHPMailer/PHPMailer/releases/tag/v6.1.7


Portifólio

https://alessandropinho.netlify.app/


*/ 




require_once ('src/PHPMailer.php');  // inportação de classes necesarias
require_once ('src/SMTP.php');
require_once ('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['nome']) && !empty($_POST['nome'])){

    $nome = $_POST["nome"];
    $email = $_POST["email"];
	$assunto = $_POST["assunto"];
    $msg = $_POST["msg"];

    $para = $email;
    $corpo = "Nome: ".$nome."<br>Email: ".$email."<br>Mensagem: ".$msg."Assunto: ".$assunto;




    $mail = new PHPMailer(true);
try {

       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //debugação de codigo util para achar erros
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'seuemail@gmail.com';                     
        $mail->Password   = '';                                    
        $mail->Port       = 587;
        
        
        $mail->setFrom('seuemail@gmail.com', 'Contato Eletrica Pinho');  // de onde é enviado 
        $mail->addAddress($para); // para onde é enviado administrador do sistema

        $mail->isHTML(true);  // abilita  o uso do HTML;
        $mail->Subject = utf8_decode($assunto) ; //Assunto
        $mail->Body = $corpo;  // corpo da mensagem
        $mail->AltBody = "teste sem html";  //para clientes sem suporte html

        if($mail->send()){
            echo "Enviado";
        }else{
            echo "Erro";
        }

    } catch (Exception  $e) {
        echo "ERRO: {$mail->ErrorInfo}";
    }

}

?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envia E-mail</title>
</head>
<body>

<form method="POST">
<label for="">Nome</label>
<input type="text" name="nome" id=""><br><br>

<label for="">E-mail</label>
<input type="email" name="email" id=""><br><br>

<label for="">Assunto</label>
<select name="assunto">
    <option value="Compra">Compra</option>
    <option value="duvida">duvida</option>
    <option value="indicacao">indicacao</option>

    
</select>

<label for="">Msg</label> <br>
<textarea name="msg"></textarea><br>

<input type="submit"  value="Enviar">

</form>

    
</body>
</html>
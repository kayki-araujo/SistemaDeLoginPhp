<?php session_start();?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
        $userEmail = $_SESSION['email'] = $_POST['email'];
        $userPassword = $_SESSION['password'] = md5($_POST['password']);
        $usersCredentials = fopen("usersCredentials.txt","r");
        $isUserCredentialsValid = false;
        while(!feof($usersCredentials) && !$isUserCredentialsValid) {
            $userCredentials = explode("|",trim(fgets($usersCredentials)));
            if($userEmail == $userCredentials[0] && $userPassword == $userCredentials[1]) {
                $isUserCredentialsValid=true;
            }
        }
        if(!isset($_POST['submit'])) {
            $formAttribute = "standart";
        } elseif($isUserCredentialsValid) {
            $formAttribute = "valid";
            $formBtnLabel = " Correto";
        } else {
            $formAttribute = "invalid";
            $formBtnLabel = " Incorreto";
        }
        fclose($usersCredentials);
    ?>
    <main> 
        <form method="POST" class="<?php echo $formAttribute;?>">
            <input type="email" name="email" placeholder="Insira um email...">
            <input type="password" name="password" placeholder="Insira uma senha...">
            <input type="submit" name="submit" value="Login<?php echo $formBtnLabel;?>">
        </form>
    </main>
</body>
</html>
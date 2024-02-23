<?php 
session_start();
$style = $_COOKIE['style'];
error_reporting(E_ALL);
ini_set('display_errors', 1);

function alert(string $message){
    echo "<script type='text/javascript'>alert('$message');</script>";
}

$db = dba_open("data.db", 'c');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['register'])){
        $user = $_POST['new_user'];
        $password = $_POST['new_pass'];
        if(dba_exists($user, $db)){
            echo "Taki użytkownik już istnieje.";
        }
        else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if(dba_insert($user, $hashedPassword, $db)){
                alert("Rejestracja przebiegła pomyślnie."); 
                $_SESSION['auth'] = 'OK';
                $_SESSION['user'] = $user;
                header('Location: index.php');
            }
            else{
                alert("Coś poszło nie tak...");
            }
        }
    }
    else {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        if (dba_exists($user, $db)) {
            $hashedPassword = dba_fetch($user, $db);
            if (password_verify($pass, $hashedPassword)) {
                $_SESSION['auth'] = 'OK';
                $_SESSION['user'] = $user;
                alert("Logowanie przebiegło pomyślnie.");
                header('Location: index.php');
                exit();
            }
        }
        alert("Niepoprawna nazwa użytkownika lub hasło!");
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Zaloguj lub zarejestruj się!</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="wrapper">
    <div class="login">
    <h2>Logowanie</h2>
    <p>Witaj ponownie! Zaloguj się.</p>
<form action="login.php" method="post">
        <label for="username">Nazwa użytkownika:</label><br>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Hasło:</label><br>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Zaloguj się</button>
    </form>

    <hr>
    <h2>Rejestracja</h2>
    <p>Jeśli jeszcze nie masz konta - zarejestruj się za darmo!</p>
    <form action="login.php" method="post">
        <label for="new_user">Nazwa użytkownika:</label><br>
        <input type="text" id="new_user" name="new_user" required>
        <br>
        <label for="new_pass">Hasło:</label><br>
        <input type="password" id="new_pass" name="new_pass" required>
        <br>
        <button type="submit" name="register">Zarejestruj się</button>
    </form>
    <hr>
    </div>
</div>
<footer>
        <a href="index.php">Powrót do strony głównej</a>
</footer>
</body>

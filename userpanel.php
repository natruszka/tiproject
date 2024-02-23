<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: index.php");
}
function alert(string $message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}

$db = dba_open("savedparameters.db", 'c');
$user = $_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mass = $_POST['mass'];
    $len = $_POST['len'];
    $gravity = $_POST['gravity'];
    $data = serialize(array($mass, $len, $gravity));
    if (dba_exists($user, $db)) {
        dba_replace($user, $data, $db);
    } else {
        if (!dba_insert($user, $data, $db)) {
            alert("Coś poszło nie tak.");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Panel użytkownika</title>
</head>

<body>
    <header>
        <h1>Panel użytkownika</h1>
        <nav>
            <a href="index.php">Powrót do strony głównej</a> |
            <a href="logout.php">Wyloguj się</a> |
        </nav>
    </header>
    <div class="wrapper">
        <div id="paramInfo">
            <h2>
                Twoje zapisane parametry:
            </h2>
            <?php
            if (dba_exists($user, $db)) {
                $serialized_data = dba_fetch($user, $db);
                $unserialized = unserialize($serialized_data);
                echo "Masa: " . $unserialized[0] . "<br>";
                echo "Długość: " . $unserialized[1] . "<br>";
                echo "Grawitacja: " . $unserialized[2] . "<br>";
            } else {
                echo "<p>Nie masz zapisanych parametrów.</p>";
            }
            ?>
        </div>
        <br>
        <button id="showEditPanel" onclick="showEditPanel()">Edytuj lub dodaj dane</button>
        <div id="paramEdit" style="display: none;">
            <h2>Dodaj nowe parametry lub edytuj obecne</h2>
            <form action="userpanel.php" method="post">
                <label for="mass">Masa (wartość od 1 do 100):</label><br>
                <input type="number" id="mass" name="mass" min="1" max="100" required>
                <br>
                <label for="mass">Długość (wartość od 50 do 250):</label><br>
                <input type="number" id="len" name="len" min="50" max="250" required>
                <br>
                <label for="mass">Stała grawitacji (wartość od 5 do 15):</label><br>
                <input type="number" id="gravity" name="gravity" step="0.01" min="5" max="15" required>
                <br>
                <button type="submit">Dodaj/Edytuj wartości</button>
            </form>
        </div>
    </div>
    <footer>
        <a href="index.php">Powrót do strony głównej</a>
</footer>
    <script>
        function showEditPanel() {
            if (document.getElementById("paramEdit").style.display == "none") {
                document.getElementById("paramEdit").style.display = "block";
            }
            else {
                document.getElementById("paramEdit").style.display = "none";
            }
        }
    </script>
</body>
<?php
// Povezivanje sa bazom podataka (izmenite sa odgovarajućim podacima)
$servername = "localhost";
$username = "username";
$password = "password";
$database = "meni";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pretpostavljamo da možete doći do informacije o stolu putem POST zahteva
if (isset($_POST["broj-stola"])) {
    $brojStola1 = $_POST["broj-stola"];
    // Dodavanje notifikacije sa informacijom o stolu u tabelu "korpa" sa redom "Plati"
    $sql = "INSERT INTO korpa (Plati, BrojStola1) VALUES ('Plati', '$brojStola1')";

    if ($conn->query($sql) === TRUE) {
        echo "Konobar ce ubrzo doneti racun ";
    } else {
        echo "Greška prilikom plaćanja računa: " . $conn->error;
    }
} else {
    echo "Nedostaje informacija o stolu.";
}

$conn->close();
?>

<?php
// Provera da li je zahtev tipa POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Dohvatanje broja stola iz tela POST zahteva
    $brojStola1 = $_POST["brojStola1"];

    // Povežite se sa svojom bazom podataka
    $servername = "localhost";
    $username = "username"; // Postavite svoje korisničko ime
    $password = "password"; // Postavite svoju lozinku
    $database = "meni";
    var_dump($_POST);
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kreirajte SQL upit za dodavanje broja stola u tabelu
    $sql = "INSERT INTO korpa (brojStola1) VALUES ('$brojStola1')";

    if ($conn->query($sql) === TRUE) {
        echo "Uspešno poslat broj stola na server.";
    } else {
        echo "Greška prilikom slanja broja stola: " . $conn->error;
    }

    $conn->close();
}
?>

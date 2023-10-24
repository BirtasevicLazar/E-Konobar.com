<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Povežite se na bazu podataka (koristite svoje podatke)
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $database = "Meni";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Primi ID porudžbine koja treba da se obriše
    $id = $_POST["id"];

    // Priprema izjave
    $stmt = $conn->prepare("DELETE FROM korpa WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Porudžbina je uspešno obrisana.";
    } else {
        echo "Greška prilikom brisanja porudžbine: " . $stmt->error;
    }

    // Zatvorite konekciju
    $stmt->close();
    $conn->close();

    // Redirect nazad na stranicu za konobara
    header("Location: konobar.php");
    exit;
}

?>

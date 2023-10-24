<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Porudžbine za konobara</title>

    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 400px;
        }

        h2 {
            color: #007bff;
            font-size: 24px;
        }

        .confirmation-icon {
            font-size: 48px;
            color: #00c853; /* Zelena boja */
            margin-bottom: 10px;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Dohvatanje informacija iz HTTP POST zahteva
    $brojStola = isset($_POST["broj-stola"]) ? $_POST["broj-stola"] : 1; // Ako broj stola nije postavljen, postavite ga na 1
    $napomene = $_POST["napomene"];
    $proizvodi = json_decode($_POST["proizvodi"], true);

    // Povežite se sa svojom bazom podataka
    $servername = "localhost";
    $username = "username"; // Postavite svoje korisničko ime
    $password = "password"; // Postavite svoju lozinku
    $database = "Meni";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kreiranje narudžbine u tabeli "korpa"
    $sql = "INSERT INTO korpa (brojStola, napomene) VALUES ('$brojStola', '$napomene')";

    if ($conn->query($sql) === TRUE) {
        // Nakon što se sačuva narudžbina, dobijamo njen ID
        $porudzbinaId = $conn->insert_id;

        // Prođemo kroz proizvode i upišemo ih u tabelu "korpa" sa vezom na porudžbinu
        foreach ($proizvodi as $proizvod) {
            $Naziv = $proizvod["Naziv"];

            // Dodaj proizvod u tabelu "korpa" sa ID narudžbine
            $sql = "INSERT INTO korpa (porudzbina) VALUES ('$Naziv')";

            if ($conn->query($sql) !== TRUE) {
                echo "Greška prilikom dodavanja proizvoda: " . $conn->error;
            }
        }

        echo "<h2 style='color: black;'>Porudžbina je uspešno primljena!</h2>";
    } else {
        echo "Greška prilikom čuvanja porudžbine: " . $conn->error;
    }

    $conn->close();
}
?>

<script>
setTimeout(function() {
    window.history.go(-2); // Vraćanje na prethodnu stranicu
}, 3000); // 5000 milisekundi (5 sekundi)
</script>

</body>
</html>

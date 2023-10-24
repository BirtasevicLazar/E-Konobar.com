<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Porudžbine za konobara</title>
    <link rel="stylesheet" href="konobar.css">
</head>
<body>
    <h1>Porudžbine za konobara</h1>

    <table>
        <tr>
            <th>Broj stola</th>
            <th>Porudzbina</th>
            <th>Napomene</th>
            <th>-----------</th>
            <th>Broj stola</th>
            <th>Pozovi konobara</th>
            <th>Racun</th>
            <th>
        <form method="POST" action="obrisi_porudzbinu.php">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <button type="submit">Obriši</button>
        </form>
    </th>
        </tr>

        <?php
        // Spojite se na bazu podataka (koristite svoje podatke)
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $database = "Meni";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Izvršite upit za dohvatanje porudžbina
        $sql = "SELECT * FROM korpa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["brojStola"] . "</td>";
                echo "<td>" . $row["porudzbina"] . "</td>";
                echo "<td>" . $row["napomene"] . "</td>";
                echo "<td>" . $row["prazno"] . "</td>";
                echo "<td>" . $row["brojStola1"] . "</td>";
                echo "<td>" . $row["PozoviKonobara"] . "</td>";
                echo "<td>" . $row["Plati"] . "</td>";
                
                echo "</tr>";
            }
        } else {
            echo "Nema porudžbina.";
        }

        // Zatvorite konekciju
        $conn->close();
        ?>
    </table>

    <script>
        function refreshPage() {
        location.reload(); // Osveži stranicu
    }
    // Osvežite stranicu nakon određenog vremena
    setTimeout(refreshPage, 2000); // Osveži stranicu nakon 5 sekundi
    </script>
    

    <footer>
    <br><br><br><br>
        <div class="footer-content">
            <p>&copy; 2023 Moja Web Stranica</p>
        </div>
        <br><br><br>
    </footer>
    </div>
</body>
</html>

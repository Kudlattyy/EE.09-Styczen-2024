<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<?php
    $servername = "localhost";
    $username = "root";
    $passworld = "";
    $dbname = "ee.09styczen2024";

    $conn = mysqli_connect($servername, $username, $passworld, $dbname);

    if(!$conn){
        die("Nie działa zjebie pozdrawiam ez. " . mysqli_connect_error());
    }

    function zapytanie1($conn){
    $sql = "SELECT zespol1,zespol2,wynik,data_rozgrywki FROM `rozgrywka` WHERE zespol1 = 'EVG'";
    $wynik = mysqli_query($conn, $sql);
    $wyniksprawdz = mysqli_num_rows($wynik); 

    if ($wyniksprawdz > 0) {
    while ($row = mysqli_fetch_assoc($wynik)) {
        echo "<section class = 'test'>";
        echo "<h3>" . $row['zespol1'] . " - " . $row['zespol2'] . "</h3>";
        echo "<h4>" . $row['wynik'] . "</h4>";
        echo "<p>w dniu: " . $row['data_rozgrywki'] . "</p>";
        echo "</section>";
    }
} else {
    echo "<p>Brak wyników</p>";
}   
    }

   function zapytanie2($conn) {
    $id = $_POST['id'] ?? '';

    // Sprawdzanie, czy pole edycyjne nie jest puste
    if (!empty($id)) {
        $sql2 = $conn->prepare("SELECT imie, nazwisko FROM `zawodnik` WHERE pozycja_id = ?");
        $sql2->bind_param("i", $id);
        $sql2->execute();
        $wynik2 = $sql2->get_result();

        if ($wynik2->num_rows > 0) {
            echo "<ul>";
            while ($row = $wynik2->fetch_assoc()) {
                echo "<li><p>" . $row['imie'] . " " . $row['nazwisko'] . "</p></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Brak wyników dla podanego ID.</p>";
        }
    } 
}
?>
    <header>
        <div class="baner">
            <h2>Światowe rozgrywki piłkarskie<h2>
            <img src="obraz1.jpg" alt="boisko">
        </div>
    <header>
    <content>
        <div class="mecze">
           <?php
           zapytanie1($conn)
           ?>
        </div>
        
    </content>

    <main>
        <div class="główny">
            <h2>Reprezentacja Polski”</h2>
        </div>
    </main>

    <section>
        <div class="lewy">
            <p> Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy) </p>
            <form action="futbol.php" method="post">
                <input type="text" id="id" name="id">
                <input type="submit" value="Sprawdź">
                <?php
                zapytanie2($conn)
                ?>
            </form>
            
        </div>
        <div class="prawy">
            <img src="zad1.png" alt="piłkarz">
            <p>Autor:00000000000</p>
        </div>
    </section>



</body>

 


</html>
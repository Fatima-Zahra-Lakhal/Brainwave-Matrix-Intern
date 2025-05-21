<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables de multiplication</title>
</head>
<body>
    <h2>Tables de multiplication</h2>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <?php
                // En-têtes de colonnes (Table de 1 à 10)
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th>Table de $i</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Contenu du tableau (Résultats des multiplications)
            for ($j = 1; $j <= 10; $j++) {
                echo "<tr>";
                echo "<td><b>Table de $j</b></td>";
                for ($k = 1; $k <= 10; $k++) {
                    echo "<td>" ."$j * $k=". $j * $k . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
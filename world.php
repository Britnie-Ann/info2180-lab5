<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

//Added GET request for country  
$country = isset($_GET['country']) ? $_GET['country'] : '';
//Added GET request for lookup
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : 'countries';
//appended 'WHERE name..." to query
//$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");

if ($lookup == "countries") {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");
} elseif ($lookup == "cities") {
    // SQL JOIN between countries and cities table
    $stmt = $conn->prepare("SELECT c.id, c.name c.district, c.population
        FROM cities c
        JOIN countries co ON c.country_code = co.code
        WHERE co.name LIKE :country");
    $stmt->bindValue(':country', "%$country%");
} else {
    echo "Invalid lookup type";
    exit;
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table border="1">
    <tr>
        <?php if ($lookup == "countries"): ?>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence </th>
            <th>Head of State</th>
        <?php elseif ($lookup == "cities"): ?>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        <?php endif; ?>
    </tr>
<?php foreach ($results as $row): ?>
    <tr>
        <?php if ($lookup == "countries"): ?>
            <td><?= $row['name'] ?></td>
            <td><?= $row['continent'] ?></td>
            <td><?= $row['independence_year'] ?? 'N' ?></td>
            <td><?= $row['head_of_state'] ?></td>
        <?php elseif ($lookup == "cities"): ?>
            <td><?= $row['name'] ?></td>
            <td><?= $row['district'] ?></td>
            <td><?= $row['population'] ?? 'N' ?></td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>

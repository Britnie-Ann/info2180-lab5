<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

//Added GET request and append to query
$country = isset($_GET['country']) ? $_GET['country'] : '';
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Continent</th>
        <th>Independence</th>
        <th>Head of State</th>
    </tr>
<?php foreach ($results as $row): ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['continent'] ?></td>
        <td><?= $row['independence_year'] ?? 'N' ?></td>
        <td><?= $row['head_of_state'] ?></td>
    </tr>
<?php endforeach; ?>
</table>

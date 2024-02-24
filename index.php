<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Now you can access the variables using getenv() or $_ENV
$dbHost = $_ENV['DB_HOST'];
$dbUsername = $_ENV['DB_USERNAME'];
$dbPassword = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];
$tableName = $_ENV['TABLE_NAME'];

// Database connection code goes here
$connect = mysqli_connect(
    $dbHost,
    $dbUsername,
    $dbPassword,
    $dbName
);

if (!$connect) {
    die('Connection failed: ' . mysqli_connect_error());
}

$query = "SELECT * FROM $tableName";
$response = mysqli_query($connect, $query);

echo "<strong>$tableName: </strong>";
while($i = mysqli_fetch_assoc($response)) {
    echo "<p>".$i['title']."</p>";
    echo "<p>".$i['body']."</p>";
    echo "<p>".$i['date_created']."</p>";
    echo "<hr>";
}

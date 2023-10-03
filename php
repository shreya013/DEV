<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "table_tennis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvFile"])) {
    $csvFile = $_FILES["csvFile"]["tmp_name"];
    $file = fopen($csvFile, "r");

    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        $name = $data[0];
        $gender = $data[1];
        $age = $data[2];
        $country = $data[3];

        // Insert player data into the database
        $sql = "INSERT INTO players (name, gender, age, country) VALUES ('$name', '$gender', '$age', '$country')";
        $conn->query($sql);
    }

    fclose($file);
}

$conn->close();
?>

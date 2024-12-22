<?php
include 'db.php';

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['plate_id']);
    $name = $conn->real_escape_string($_POST['model']);

    // Check if the car already exists
    $checkQuery = "SELECT * FROM cars WHERE id = '$id'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "Error: A car with this Plate ID already exists!";
    } else {
        // Insert the new car into the database
        $insertQuery = "INSERT INTO cars (plate_id, `model`, `status`) VALUES ('$id', '$name', 'active')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Car added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

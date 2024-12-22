<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $car_id = $_GET['car_id'];
    $customer_id = $_GET['customer_id'];
    $email = $_GET['email'];
    $start_date = $_GET['rent_start_date'];
    $end_date = $_GET['rent_end_date'];

    // Calculate rental days
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $days = $start->diff($end)->days;
    
    // Calculate total price (500 EGP per day)
    $price_per_day = 500;
    $total_price = $days * $price_per_day;

    // Get car details
    $car_query = "SELECT * FROM cars WHERE id = '$car_id'";
    $car_result = mysqli_query($conn, $car_query);
    $car = mysqli_fetch_assoc($car_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Reservation - <?php echo $car['name']; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .reservation-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .car-details {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .car-image {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .car-info {
            flex: 1;
        }
        .rental-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .total-price {
            font-size: 24px;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
            color: #007bff;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .btn-back {
            background: #6c757d;
        }
        .btn-confirm {
            background: #28a745;
        }
    </style>
</head>
<body>
    <div class="reservation-container">
        <h2>Review Your Reservation</h2>
        
        <div class="car-details">
            <img src="<?php echo $car['image_url'] ?? 'placeholder.jpg'; ?>" alt="<?php echo $car['name']; ?>" class="car-image">
            <div class="car-info">
                <h3><?php echo $car['name']; ?></h3>
                <p>Status: <?php echo $car['status']; ?></p>
                <p>Daily Rate: <?php echo $price_per_day; ?> EGP</p>
            </div>
        </div>

        <div class="rental-details">
            <h3>Rental Information</h3>
            <p>Start Date: <?php echo $start_date; ?></p>
            <p>End Date: <?php echo $end_date; ?></p>
            <p>Number of Days: <?php echo $days; ?></p>
            <p>Customer ID: <?php echo $customer_id; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <div class="total-price">
                Total Price: <?php echo $total_price; ?> EGP
            </div>
        </div>

        <div class="button-group">
            <a href="index.php" class="btn btn-back">Back</a>
            <form action="confirm_reservation.php" method="POST" style="margin: 0;">
                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="rent_start_date" value="<?php echo $start_date; ?>">
                <input type="hidden" name="rent_end_date" value="<?php echo $end_date; ?>">
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <button type="submit" class="btn btn-confirm">Confirm Reservation</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
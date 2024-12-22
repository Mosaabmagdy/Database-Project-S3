<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $customer_id = $_POST['customer_id'];
    $email = $_POST['email'];
    $start_date = $_POST['rent_start_date'];
    $end_date = $_POST['rent_end_date'];
    $total_price = $_POST['total_price'];

    // حفظ الحجز في قاعدة البيانات
    $query = "INSERT INTO reservations (car_id, customer_id, rent_start_date, rent_end_date, total_amount) 
              VALUES ('$car_id', '$customer_id', '$start_date', '$end_date', '$total_price')";

    if ($conn->query($query)) {
        // تحديث حالة السيارة
        $conn->query("UPDATE cars SET status = 'rented' WHERE id = '$car_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmed</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .confirmation-details {
            margin: 20px 0;
            text-align: left;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>تم تأكيد الحجز!</h2>
        <div class="confirmation-details">
            <h3>تفاصيل الحجز:</h3>
            <p>تاريخ البداية: <?php echo $start_date; ?></p>
            <p>تاريخ النهاية: <?php echo $end_date; ?></p>
            <p>السعر الإجمالي: <?php echo $total_price; ?> جنيه</p>
            <p>البريد الإلكتروني: <?php echo $email; ?></p>
        </div>
        <a href="index.php" class="btn">العودة للصفحة الرئيسية</a>
    </div>
</body>
</html>
<?php
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Premium Car Rental</title>
  <script src="script.js" defer></script>
</head>
<body>
  <header>
    <h1>Premium Car Rental</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="admin.php">Admin Dashboard</a></li>
      </ul>
    </nav>
  </header>

<section id="register">
    <h2>Become a Customer</h2>
    <p>Register now to reserve cars easily.</p>
    <a href="registration.html" class="btn">Register</a>
    <button onclick="window.location.href='register.html'">
</section>

  <!-- Home Section -->
  <section id="home">
    <h2>Available Cars</h2>
    <div class="car-gallery">
      <?php   
        $cars = mysqli_query($conn, "SELECT * FROM cars");
        while ($car = mysqli_fetch_assoc($cars)) {
          echo "
          <div class='car-card'>
            <img src='placeholder.jpg' alt='{$car['model']}'>
            <h3>{$car['model']}</h3>
            <p>Status: {$car['status']}</p>
            <form action='reservation.php' method='POST'>
              <input type='hidden' name='car_id' value='{$car['id']}'>
              <input type='text' name='customer_id' placeholder='Your ID' required>
              <input type='email' name='email' placeholder='Your Email' required>
              <input type='date' name='rent_start_date' required>
              <input type='date' name='rent_end_date' required>
              <button type='submit' >Reserve</button>
            </form>
          </div>";
        }
      ?>
    </div>
  </section>

  <!-- Admin Dashboard Section -->

  <footer>
    <p>&copy; 2024 Premium Car Rental. All Rights Reserved.</p>
  </footer>
</body>
</html>

<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Admin Dashboard - Premium Car Rental</title>
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

  <!-- Admin Dashboard Section -->
  <section id="dashboard">
    <h2>Admin Dashboard</h2>

    <!-- Reservations Table -->
    <h3>Manage Reservations</h3>
    <table>
      <thead>
        <tr>
          <th>Car</th>
          <th>Customer ID</th>
          <th>Rent Start Date</th>
          <th>Rent End Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $reservations = mysqli_query($conn, "SELECT reservations.reservation_id, reservations.customer_id, reservations.rent_start_date, reservations.rent_end_date, cars.model
                                             FROM reservations INNER JOIN cars ON reservations.car_id = cars.id");
          while ($row = mysqli_fetch_assoc($reservations)) {
            echo "<tr>
              <td>{$row['model']}</td>
              <td>{$row['customer_id']}</td>
              <td>{$row['rent_start_date']}</td>
              <td>{$row['rent_end_date']}</td>
              <td>
                <a href='edit_reservation.php?id={$row['reservation_id']}'>Edit</a> | 
                <a href='delete_reservation.php?id={$row['reservation_id']}'>Delete</a>
              </td>
            </tr>";
          }
        ?>
      </tbody>
    </table>

    <!-- Add Car Section -->
    <section id="addcar">
      <div class="container">
        <h2>Add a New Car</h2>
        <form method="POST" action="addcar.php">
          <label for="plate_id">Plate ID:</label>
          <input type="text" id="plate_id" name="plate_id" required>
          
          <label for="model">Model:</label>
          <input type="text" id="model" name="model" required>
          
          <button type="submit">Add Car</button>
        </form>
      </div>
    </section>

    <table>
      <thead>
        <tr>
          <th>Car</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $cars = mysqli_query($conn, "SELECT * FROM cars");
          while ($car = mysqli_fetch_assoc($cars)) {
            echo "<tr>
              <td>{$car['model']}</td>
              <td>{$car['status']}</td>
              <td>
                <a href='edit_car.php?id={$car['id']}'>Edit</a> | 
                <a href='delete_car.php?id={$car['id']}'>Delete</a>
              </td>
            </tr>";
          }
        ?>
      </tbody>
    </table>
  </section>

  <footer>
    <p>&copy; 2024 Premium Car Rental. All Rights Reserved.</p>
  </footer>
</body>
</html>
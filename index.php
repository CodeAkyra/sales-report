<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inkote Sales Report Prototype</title>
</head>

<body>

    <?php
    include 'conn.php';
    ?>

    <form action="" method="GET">
        <input type="date" name="sale_date">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Search</button>
        </div>
    </form>

    <?php
    $found = false;
    $total_price = 0;
    if (isset($_GET['sale_date'])) {
        echo "<table class='table table-striped' style='text-align: center;'>";
        echo "<tr>
        <th>Sale ID</th>
        <th>Sale Date</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Payment Method</th>
        
      </tr>";

        if (isset($_GET['sale_date'])) {
            $sale_date = mysqli_real_escape_string($conn, $_GET['sale_date']);
            $formatted_date = date('Y,m,d', strtotime($sale_date));
            $sql = "SELECT * FROM sales_report WHERE sale_date = '$formatted_date'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $found = true;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>{$row['sale_id']}</td>
                    <td>{$row['sale_date']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['total_price']}</td>
                    <td>{$row['payment_method']}</td>
                  </tr>";

                    $total_price += $row['total_price'];
                }
            }
        }
        echo "</table>";
        if ($found) {
            echo "<h3>Total Sales for $formatted_date: <strong>₱" . number_format($total_price, 2) . "</strong></h3>";
        }
    }
    ?>




</body>

</html>
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Available Products</h2>
    <div class="text-right mb-4">
        <a href="/electrowave/products/createproduct.php" class="btn btn-primary btn-lg" style="border-radius: 25px;"> <i class="fas fa-plus"></i> Add New Product</a>
    </div>
    <div class="row mt-4">
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card h-100'>";
                echo "<img src='/electrowave/assets/" . $row["product_image"] . "' class='card-img-top' alt='" . $row["product_name"] . "'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row["product_name"] . "</h5>";
                echo "<p class='card-text'>" . $row["product_description"] . "</p>";
                echo "<p class='card-text'><strong>Price: $" . $row["product_price"] . "</strong></p>";
                echo "</div>";
                echo "<div class='card-footer text-center'>";
                echo "<a href='/electrowave/products/editproduct.php?id=" . $row["product_id"] . "' class='btn btn-primary' style='border-radius: 20px; width: 120px;'>Edit</a> ";
                echo "<a href='/electrowave/products/deleteproduct.php?id=" . $row["product_id"] . "' class='btn btn-danger' style='border-radius: 20px; width: 120px;'>Delete</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>No products available.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>


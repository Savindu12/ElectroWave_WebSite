<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="container mt-5">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM products WHERE product_id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success text-center' role='alert'>
                    Product deleted successfully!
                  </div>";
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>
                    Error deleting product: " . $conn->error . "
                  </div>";
        }

        $conn->close();
    } else {
        echo "<div class='alert alert-warning text-center' role='alert'>
                No product ID provided. Unable to delete the product.
              </div>";
    }
    ?>

    <div class="text-center mt-4">
        <a href="/electrowave/index.php" class="btn btn-primary btn-lg" style="border-radius: 25px;">Go Back to Homepage</a>
    </div>
    
</div>

<?php include '../includes/footer.php'; ?>

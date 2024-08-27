<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Product</h2>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE product_id=$id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $sub_category_id = $_POST['sub_category'];

            if ($_FILES['image']['name']) {
                $image = basename($_FILES["image"]["name"]); 
                
            } else {
                $image = $product['product_image']; 
            }

            $sql = "UPDATE products SET 
                        product_name='$name', 
                        product_description='$description', 
                        product_price='$price', 
                        product_image='$image', 
                        product_sub_category_id='$sub_category_id' 
                    WHERE product_id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Product updated successfully!</div>";
                // Refresh the product details
                $sql = "SELECT * FROM products WHERE product_id=$id";
                $result = $conn->query($sql);
                $product = $result->fetch_assoc();
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
            
            $conn->close();
        }
    } else {
        echo "<div class='alert alert-danger'>No product ID provided.</div>";
    }
    ?>

    <?php if ($product): ?>
    <form action="editproduct.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $product['product_name']; ?>" required>
            <div class="invalid-feedback">Please enter the product name.</div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required><?php echo $product['product_description']; ?></textarea>
            <div class="invalid-feedback">Please enter the product description.</div>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" step="0.01" name="price" id="price" value="<?php echo $product['product_price']; ?>" required>
            <div class="invalid-feedback">Please enter the product price.</div>
        </div>

        <div class="form-group text-center">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage(event)">
            <div class="invalid-feedback">Please upload a product image.</div>
            <br>
            <img id="imagePreview" src="/electrowave/assets/<?php echo $product['product_image']; ?>" alt="Image Preview" class="rounded-circle mt-3" style="width: 100px; height: 100px; object-fit: cover;">
        </div>

        <div class="form-group">
            <label for="main_category">Main Category:</label>
            <select class="form-control" name="main_category" id="main_category" required>
                <?php
                $sql = "SELECT * FROM main_categories";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['category_id'] . "' " . ($row['category_id'] == $product['product_main_category_id'] ? 'selected' : '') . ">" . $row['category_name'] . "</option>";
                }
                ?>
            </select>
            <div class="invalid-feedback">Please select a main category.</div>
        </div>

        <div class="form-group">
            <label for="sub_category">Sub Category:</label>
            <select class="form-control" name="sub_category" id="sub_category" required>
                <?php
                $sql = "SELECT * FROM sub_categories";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['sub_category_id'] . "' " . ($row['sub_category_id'] == $product['product_sub_category_id'] ? 'selected' : '') . ">" . $row['sub_category_name'] . "</option>";
                }
                ?>
            </select>
            <div class="invalid-feedback">Please select a sub category.</div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 25px;">Update Product</button>
            <a href="/electrowave/products/view.php" class="btn btn-secondary btn-lg" style="border-radius: 25px;">Cancel</a>
        </div>
    </form>
    <?php endif; ?>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?php include '../includes/footer.php'; ?>

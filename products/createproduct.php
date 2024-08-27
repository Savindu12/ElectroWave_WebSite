<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Add a New Product</h2>

    <div class="text-right mb-4">
        <a href="/electrowave/category/createmaincategory.php" class="btn btn-primary btn-lg" style="border-radius: 25px;"> <i class="fas fa-plus"></i> Add New Category</a>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $sub_category_id = $_POST['sub_category'];

        if ($_FILES['image']['name']) {
                $image = basename($_FILES["image"]["name"]);
        }
     
        $sql = "INSERT INTO products (product_name, product_description, product_price, product_image, product_sub_category_id) 
                VALUES ('$name', '$description', '$price', '$image', '$sub_category_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>New product added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
        
        $conn->close();
    }
    ?>

    <form action="createproduct.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <div class="invalid-feedback">Please enter the product name.</div>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            <div class="invalid-feedback">Please enter the product description.</div>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" step="0.01" name="price" id="price" required>
            <div class="invalid-feedback">Please enter the product price.</div>
        </div>

        <div class="form-group ">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" name="image" id="image" required onchange="previewImage(event)">
            <div class="invalid-feedback">Please upload a product image.</div>
            <br>
            <img id="imagePreview" src="#" alt="Image Preview" class="rounded-circle mt-3" style="display: none; width: 100px; height: 100px; object-fit: cover;">
        </div>

        <div class="form-group">
            <label for="main_category">Main Category:</label>
            <select class="form-control" name="main_category" id="main_category" required>
                <?php
                $sql = "SELECT * FROM main_categories";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
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
                    echo "<option value='" . $row['sub_category_id'] . "'>" . $row['sub_category_name'] . "</option>";
                }
                ?>
            </select>
            <div class="invalid-feedback">Please select a sub category.</div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 25px;">Add Product</button>
            <a href="/electrowave/index.php" class="btn btn-secondary btn-lg" style="border-radius: 25px;">Cancel</a>
        </div>
    </form>
</div>
<div></div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?php include '../includes/footer.php'; ?>

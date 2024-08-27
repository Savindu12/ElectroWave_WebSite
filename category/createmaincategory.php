<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Add a New Main Category</h2>

    <div class="text-right mb-4">
        <a href="/electrowave/category/createsubcategory.php" class="btn btn-primary btn-lg" style="border-radius: 25px;"> <i class="fas fa-plus"></i> Add New Sub Category</a>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category_name = $_POST['category_name'];
        $category_description = $_POST['description'];


        $sql = "INSERT INTO main_categories (category_name, category_description) VALUES ('$category_name', '$category_description')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>New main category added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
        
        $conn->close();
    }
    ?>

    <form action="createmaincategory.php" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="category_name">Main Category Name:</label>
            <input type="text" class="form-control" name="category_name" id="category_name" required>
            <div class="invalid-feedback">Please enter the main category name.</div>
        </div>

        <div class="form-group">
            <label for="description">Category Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            <div class="invalid-feedback">Please enter the main category description.</div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 25px;">Add Main Category</button>
            <a href="/electrowave/products/createproduct.php" class="btn btn-secondary btn-lg" style="border-radius: 25px;">Cancel</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Add a New Sub Category</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sub_category_name = $_POST['sub_category_name'];
        $main_category_id = $_POST['main_category_id'];
        $sub_category_decription = $_POST['description'];

        $sql = "INSERT INTO sub_categories (sub_category_name, sub_category_description, main_category_id) VALUES ('$sub_category_name', '$sub_category_decription ', '$main_category_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>New sub category added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
        
        $conn->close();
    }
    ?>

    <form action="createsubcategory.php" method="POST" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="sub_category_name">Sub Category Name:</label>
            <input type="text" class="form-control" name="sub_category_name" id="sub_category_name" required>
            <div class="invalid-feedback">Please enter the sub category name.</div>
        </div>

        <div class="form-group">
            <label for="description">Category Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            <div class="invalid-feedback">Please enter the sub category description.</div>
        </div>

        <div class="form-group">
            <label for="main_category_id">Main Category:</label>
            <select class="form-control" name="main_category_id" id="main_category_id" required>
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

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 25px;">Add Sub Category</button>
            <a href="/electrowave/category/createmaincategory.php" class="btn btn-secondary btn-lg" style="border-radius: 25px;">Cancel</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>

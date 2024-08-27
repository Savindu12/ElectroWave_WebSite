# ElectroWave_WebSite

ElectroWave is an online marketplace designed to create and maintain categories and electrical items for users.

## Features

- **Product Management**: Easily add, edit, and delete products.
- **Category Management**: Create and manage main categories and subcategories.
- **Image Upload**: Attach images to products with a preview feature.
- **Responsive Design**: Built with Bootstrap for a seamless experience on any device.

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server (e.g., Apache, Nginx)

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/ElectroWave_WebSite.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd ElectroWave_WebSite
    ```

3. **Set up the database:**

    - Create a new MySQL database.
    - Import the provided `electrowave.sql` file into your database to set up the necessary tables.

4. **Update database configuration:**

    - Edit the `includes/db.php` file to include your database credentials.

    ```php
    $servername = "localhost";
    $username = "your-username";
    $password = "your-password";
    $dbname = "your-database-name";
    ```

5. **Run the project:**

    - Deploy the project on your local server or web hosting environment.
    - Access the application via your web browser at `http://localhost/ElectroWave_WebSite/`.

## Usage

1. **Home Page:**
   - Browse the list of available products.
   - Navigate using the header menu.

2. **Add Product:**
   - Click on the "Add Product" button to create a new product.
   - Fill out the product details and upload an image.

3. **Edit Product:**
   - Use the "Edit" button next to a product to update its details.

4. **Delete Product:**
   - Use the "Delete" button next to a product to remove it from the marketplace.

5. **Manage Categories:**
   - Use `maincategory.php` and `subcategory.php` to add main categories and subcategories, respectively.

## File Structure

```bash
.
├── includes/
│   ├── db.php           # Database connection file
│   ├── header.php       # Header file included in all pages
│   ├── footer.php       # Footer file included in all pages
├── products/
│   ├── createproduct.php # Page to add a new product
│   ├── editproduct.php   # Page to edit an existing product
│   ├── deleteproduct.php # Page to delete a product
├── uploads/             # Directory to store uploaded images
├── css/
│   ├── footer.css       # Custom styles for the footer
├── index.php            # Main page displaying products
├── maincategory.php     # Page to create a main category
├── subcategory.php      # Page to create a subcategory
├── README.md            # Project README file

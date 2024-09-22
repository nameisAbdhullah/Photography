<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'photography_website');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch images
$sql = "SELECT * FROM gallery_images";
$result = $conn->query($sql);

$images = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Malcolm Lismore Photography</title>
    <style>
        body {
            background-color: #e0f7fa;
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #004d40;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }
        nav button {
            background-color: #00796b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav button:hover {
            background-color: #004d40;
        }
        .gallery-section {
            padding: 50px 20px;
            text-align: center;
        }
        .gallery-section h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .gallery-item {
            background-color: #fff;
            border: 1px solid #00796b;
            border-radius: 8px;
            overflow: hidden;
            width: calc(33.333% - 40px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .gallery-item img {
            width: 100%;
            height: auto;
        }
        .coming-soon-section {
            margin-top: 50px;
        }
        .coming-soon-section h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .coming-soon-section p {
            font-size: 1.2em;
            color: #555;
        }
        footer {
            background-color: #004d40;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
    </style>
    <script>
        function navigateTo(page) {
            window.location.href = page;
        }
    </script>
</head>
<body>
    <header>
        <img src="images/logo.png" alt="Malcolm Lismore Photography Logo">
        <h1>GALLERY - MALCOLM LISMORE PHOTOGRAPHY</h1>
        <nav>
            <button onclick="navigateTo('Home page.html')">Home</button>
            <button onclick="navigateTo('About page.html')">About</button>
            <button onclick="navigateTo('Pricing page.html')">Pricing</button>
            <button onclick="navigateTo('Gallery page.html')">Gallery</button>
            <button onclick="navigateTo('Contact page.html')">Contact</button>
        </nav>
    </header>
    <div class="gallery-section">
        <h1>Photography Showcase</h1>
        <div class="gallery-container">
            <?php foreach ($images as $image): ?>
                <div class="gallery-item">
                    <img src="<?php echo $image['image_path']; ?>" alt="<?php echo $image['description']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="coming-soon-section">
        <h2>More Photos Coming Soon!</h2>
        <p>Stay tuned for more stunning photographs as I continue to capture the beauty of the world through my lens.</p>
    </div>
    <footer>
        &copy; 2024 Malcolm Lismore Photography
    </footer>
</body>
</html>

<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database configuration file
include 'config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        // Redirect back with error
        header("Location: Contact page.html?status=error");
        exit();
    }

    // Prepare and bind (to prevent SQL injection)
    $stmt = $conn->prepare("INSERT INTO contact_form_entries (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back with success
        header("Location: Contact page.html?status=success");
    } else {
        // Redirect back with error
        header("Location: Contac page.html?status=error");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If accessed without POST data, redirect to contact form
    header("Location: Contact page.html");
    exit();
}
?>

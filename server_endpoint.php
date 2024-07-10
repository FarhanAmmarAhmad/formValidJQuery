<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Here you can perform further validation, save data to a database, etc.

    // Simulate a successful response
    echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

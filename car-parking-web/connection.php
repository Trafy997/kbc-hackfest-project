<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'parking_db';
$username = 'riwaz';
$password = 'riwaz123';

$conn = null;

try {
    // Create database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Handle errors gracefully
    $error = $e->getMessage();
    $carCount = 0;
    $lastUpdated = date('Y-m-d H:i:s');
    $gateStatus = 'unknown';
    $isFull = false;

    die(json_encode([
        'success' => false,
        'message' => 'DB Error',
    ]));
}
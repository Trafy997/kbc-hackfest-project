<?php

require_once('connection.php');

if (!isset($_POST) || !isset($_POST['data'])) {
    die(json_encode([
        'success' => false,
        'message' => "No data available"
    ]));
}

$updatedAt = date("Y-m-d H:i:s");

try {
    $data = intval($_POST['data']); // Sanitize input as integer

    // Corrected SQL query using single quotes for values
    $sql = "INSERT INTO `parking_status` (`car_count`, `updated_at`) VALUES ('$data', '$updatedAt')";
    
    // Execute query
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Data added successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to add data: ' . $conn->error
        ]);
    }

} catch (\Throwable $th) {
    echo json_encode([
        'success' => false,
        'message' => 'Exception: ' . $th->getMessage()
    ]);
}
?>

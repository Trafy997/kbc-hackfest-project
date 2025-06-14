<?php
include 'connection.php';

// Get the latest parking status
$dataquery = "SELECT * FROM parking_status ORDER BY id DESC LIMIT 1";
$data = mysqli_query($conn, $dataquery);
$result = mysqli_fetch_assoc($data); // single latest row

// Handle when there's no data yet
$carCount = isset($result['car_count']) ? intval($result['car_count']) : 0;
$lastUpdated = isset($result['updated_at']) ? $result['updated_at'] : 'N/A';

// Parking lot has 10 spaces
$totalSpaces = 10;
$space_remaning = $totalSpaces - $carCount;
$isFull = ($carCount >= $totalSpaces);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart IoT Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-card {
            transition: all 0.3s ease;
        }
        .status-card.full {
            background-color: #ffebee;
        }
        .status-card.open {
            background-color: #e8f5e9;
        }
        .gate-status {
            font-size: 1.2em;
            font-weight: bold;
        }
        .gate-status.open {
            color: #2e7d32;
        }
        .gate-status.closed {
            color: #c62828;
        }
        .error-message {
            color: #c62828;
            margin-bottom: 1rem;
        }

        /* Footer styles */
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            font-weight: 500;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Smart IoT Parking System</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card status-card <?php echo $isFull ? 'full' : 'open'; ?>">
                    <div class="card-body text-center">
                        <h2 class="card-title">Current Status</h2>
                        <div class="display-1 mb-3"><?php echo htmlspecialchars($carCount); ?></div>
                        <p class="gate-status">
                            Gate Status: <?php echo $isFull ? 'Closed' : 'Open'; ?>
                        </p>
                        <?php if($isFull): ?>
                            <h2>Parking space is full.</h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>   
        </div>
    </div>

    <footer style="background-color: #f8f9fa; padding: 10px; text-align: center;">
        Powered by:<br> Suman and Dhurba
    </footer>

    <script>
        // Auto-refresh the page every 5 seconds
        setTimeout(function() {
            window.location.reload();
        }, 5000);
    </script>
</body>
</html>

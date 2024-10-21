<?php
// Database credentials
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST request
    $medicalRecords = $_POST['medicalRecords'] ?? '';
    $action = $_POST['action'];

    // Handle different actions
    switch ($action) {
        case 'newChat':
            // Handle new chat action
            echo "New chat initiated.";
            break;
        case 'addFile':
            // Handle add file action
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $filePath = 'uploads/' . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    echo "File uploaded successfully.";
                } else {
                    echo "File upload failed.";
                }
            }
            break;
        case 'recordAudio':
            // Handle record audio action
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $filePath = 'uploads/' . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    echo "Audio recorded successfully.";
                } else {
                    echo "Audio recording failed.";
                }
            }
            break;
        case 'takePicture':
            // Handle take picture action
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $filePath = 'uploads/' . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    echo "Picture taken successfully.";
                } else {
                    echo "Picture capture failed.";
                }
            }
            break;
        case 'send':
            // Handle send action
            $stmt = $conn->prepare("INSERT INTO medical_records (record) VALUES (?)");
            $stmt->bind_param("s", $medicalRecords);
            if ($stmt->execute()) {
                echo "Medical record saved successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            break;
        default:
            echo "Unknown action.";
            break;
    }
}

// Close the connection
$conn->close();
?>
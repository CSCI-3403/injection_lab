<?php
$file_dir = "./files/";

$host = "localhost";
$db_name = "mysql";
$db_username = "root";
$db_password = "";

$conn = new mysqli($host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = $_POST["message"];
if (!file_exists($_FILES['attachment']['tmp_name']) || !is_uploaded_file($_FILES['attachment']['tmp_name'])) {
    $attachment = "NULL";
}
else {
    $name = $_FILES["attachment"]["tmp_name"];
    $attachment = "'$name'";
}

$sql = "INSERT INTO chats (message, attachment) VALUES ('$message', $attachment);";
echo $sql;
if ($conn->multi_query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// if ($_FILES["file"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
// } else {
//     $file_name = basename($_FILES["file"]["name"]);
//     $file_path = $file_dir . $file_name;
//     if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
//         $sql = "INSERT INTO chats (filename, filepath) VALUES ('$file_name', '$file_path')";
//         if ($conn->query($sql) === TRUE) {
//             echo "
//                 <h1>File successfully uploaded!</h1>
//                 <p><a href='/www/html'>Back</a></p>
//                 ";
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
$conn->close();

header('Location: /');
?>

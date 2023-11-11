<?php
require("./db_connection.php");
$arr = array();
$arr["om"] = ['welcome', 'hello', 'yash'];
$arr["yash"] = ['welcome', 'hello'];
$arr["om"][2] = 'hello';
print_r($arr);
$jsonData = '{"name": "John Doe", "age": 25, "city": "New York"}';

// Insert data into the table
$sql = "INSERT INTO json_data_table (json_data) VALUES ('$jsonData')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

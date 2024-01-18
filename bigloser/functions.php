<?php

function findname($userId) {
    global $conn;
    // SQL query to retrieve username based on user ID
    $query = "SELECT username FROM users WHERE id = '$userId'";
    
    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful and if a row was returned
    if ($result && $result->num_rows > 0) {
        // Fetch the username from the result
        $row = $result->fetch_assoc();
        $username = $row['username'];

        // Return the username
        return $username;
    } else {
        // Return null or any other indicator if the user is not found
        return null;
    }
}
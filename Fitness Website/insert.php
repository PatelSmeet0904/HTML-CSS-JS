<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['email']) &&
        isset($_POST['phone']) && isset($_POST['gender']) &&
        isset($_POST['date']) && isset($_POST['selectbranch'])) {
        
        
        $host = "localhost:3307";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "gym data";
        
        $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);
        
        if (!$conn){
            die("Sorry we failed to connect: ". mysqli_connect_error());
        }
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $date = $_POST['date'];
        $branch = $_POST['selectbranch'];

        // Sql query to be executed
        $sql = "INSERT INTO `trial registration` (`name`, `email`, `phone`, `gender`, `date`, `branch`) VALUES ('$username', '$email', '$phone', '$gender', ' $date', '$branch')";

        $sql = "INSERT INTO `trial registration` (`name`, `email`, `phone`, `gender`, `date`, `branch`)
        SELECT * FROM (SELECT '$username', '$email', '$phone', '$gender', ' $date', '$branch') AS tmp
        WHERE NOT EXISTS (
            SELECT email FROM trial registration WHERE email = '$email'
        ) LIMIT 1";
        $result = mysqli_query($conn, $sql);

        // Add a new trip to the Trip table in the database
        if($result){
            header("Location:index.html");
            // echo "The record was inserted successfully";
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            // echo "The record was already inserted";
            // header("Location:index.html");
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>
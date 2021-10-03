<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['email']) &&
        isset($_POST['address']) && isset($_POST['phone']) &&
        isset($_POST['age']) && isset($_POST['gender']) &&
        isset($_POST['plan']) && isset($_POST['payment']) &&
        isset($_POST['membershipinfo']) && isset($_POST['branch'])) {
        
        
        $host = "localhost:3307";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "gym data";
        
        $connect = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);
        
        if (!$connect){
            die("Sorry we failed to connect: ". mysqli_connect_error());
        }
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $plan = $_POST['plan'];
        $payment = $_POST['payment'];
        $membership = $_POST['membershipinfo'];
        $branch = $_POST['branch'];


        // Sql query to be executed
        // $sql = "INSERT INTO `gym member` (`name`, `email`, `address`, `phone`, `age`, `gender`, `plan`, `payment method`, `membership info`, `branch`) VALUES ('$username', `$email`, `$address`, `$phone`, `$age`, `$gender`, `$plan`, `$payment`, `$membership`, `$branch`)";

        $sql = "INSERT INTO `gym member` (`name`, `email`, `address`, `phone`, `age`, `gender`, `plan`, `payment method`, `membership info`, `branch`)
        SELECT * FROM (SELECT '$username', `$email`, `$address`, `$phone`, `$age`, `$gender`, `$plan`, `$payment`, `$membership`, `$branch`) AS tmp
        WHERE NOT EXISTS (
            SELECT email FROM gym member WHERE email = '$email'
        ) LIMIT 1";
        $result = mysqli_query($connect, $sql);

        // Add a new trip to the Trip table in the database
        if($result){
            // header("Location:index.html");
            echo "The record was inserted successfully";
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($connect);
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
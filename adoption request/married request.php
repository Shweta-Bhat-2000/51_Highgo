<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['p1 fname']) && isset($_POST['p1 lname']) &&
        isset($_POST['p1 email']) && isset($_POST['p1 dob']) &&
        isset($_POST['p1 Adhar no']) && isset($_POST['p1 profession']) &&
        isset($_POST['p1 income']) && isset($_POST['p2 fname']) && isset($_POST['p2 lname']) &&
            isset($_POST['p2 email']) && isset($_POST['p2 dob']) &&
            isset($_POST['p2 Adhar no']) && isset($_POST['p2 profession']) &&
            isset($_POST['p2 income']) && isset($_POST['reason']) && isset($_POST['preferences'])) {

        $p1fname = $_POST['p1 fname'];
        $p1lname = $_POST['p1 lname'];
        $p1email = $_POST['p1 email'];
        $p1dob = $_POST['p1 dob'];
        $p1Adharno = $_POST['p1 Adhar no'];
        $p1profession = $_POST['p1 profession'];
        $p1income = $_POST['p1 income'];
        $p2fname = $_POST['p2 fname'];
        $p2lname = $_POST['p2 lname'];
        $p2email = $_POST['p2 email'];
        $p2dob = $_POST['p2 dob'];
        $p2Adharno = $_POST['p2 Adhar no'];
        $p2profession = $_POST['p2 profession'];
        $p2income = $_POST['p2 income'];
        $reason = $_POST['reason'];
        $preferences = $_POST['preferences'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "adoption";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM married request WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO married request(p1 first name, p1 last name, p1 email, p1 dob, p1 adhar no, p1 profession, p1 income, p2 first name, p2 last name, p2 email, p2 dob, p2 adhar no, p2 profession, p2 income, reason, preferences) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $p1email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssisissssisiss",$p1fname, $p1lname, $p1dob, $p1Adharno, $p1profession, $p1income, $p2fname, $p2lname, $p2email, $p2dob, $p2Adharno, $p2profession, $p2income, $reason, $preferences);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
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

<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['fname']) && isset($_POST['lname']) &&
        isset($_POST['email']) && isset($_POST['dob']) &&
        isset($_POST['Adhar no']) && isset($_POST['profession']) &&
        isset($_POST['income']) && isset($_POST['reason']) && isset($_POST['preferences'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $Adharno = $_POST['Adhar no'];
        $profession = $_POST['profession'];
        $income = $_POST['income'];
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
            $Select = "SELECT email FROM single request WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO single request(first name, last name, email, dob, adhar no, profession, income, reason, preference) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssisiss",$fname, $lname, $dob, $Adharno, $profession, $income, $reason, $preferences);
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

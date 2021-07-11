<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['name']) &&
        isset($_POST['age']) && isset($_POST['gender']) &&
        isset($_POST['No.']) && isset($_POST['Country']) &&
        isset($_POST['Address']) && isset($_POST['Adhar no']) && isset($_POST['password'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $number = $_POST['No.'];
        $Country = $_POST['Country'];
        $Address = $_POST['Address'];
        $Adharno = $_POST['Adhar no'];
        $password = $_POST['password'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "adoption";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM registration WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO registration(email, name, age, gender, No., Country, Address, Adhar no, password) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                $stmt->bind_param("sisissis",$name, $age, $gender, $number, $Country, $Address, $Adharno, $password);
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

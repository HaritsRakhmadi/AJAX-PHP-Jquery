<?php
// Declaring database connection details

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "fsp_1_0_db";

// Create the connections
$conn = new mysqli($serverName, $userName, $password, $dbName);


// Checking the connection
if($conn->connect_error){
    
    die("Connection Failed: " ).$conn->connect_error;
}



// form submission (form yang ada submit button pake isset)
// pake if($_SERVER['REQUEST_METHOD'] === "POST") 


if(basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])){

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $email = $_POST["email"];

        //prepare and bind
        $statement = $conn -> prepare("INSERT INTO users (email) VALUES (?)");

        $statement -> bind_param("s", $email);


        //execute the query

        if ($statement -> execute()){
            echo "New record created successfully";
        } else{
            echo "Error: " . $statement -> error;
        }

        //close the connection
        $statement -> close();
        $conn -> close();

    }

    





    ////////////////////////////////////////////

    //Pake if($_SERVER['REQUEST_METHOD'] === "GET") 


    if($_SERVER['REQUEST_METHOD'] === "GET") {
        $result = $conn->query("SELECT * FROM users");

        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        

        $JSONData = json_encode($data);

        echo $JSONData;

        $conn -> close();
        exit;

    }

}




?>
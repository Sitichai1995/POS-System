<?php
    session_start();

    require 'dbConnect.php';

    //input field validation 
    function validate ($inputData){
        global $conn;
        $validateData = mysqli_real_escape_string($conn, $inputData); //เปลี่ยนแปลงตัวอักษรพิเศษให้เป็นรหัสที่ปลอดภัย กัน SQL Injection
        return trim($validateData);
    } 

    //Redirect from 1 page to another page with the message (status)
    function redirect ($url, $status) {

        $_SESSION['status'] = $status;
        header('location: '.$url);
        exit();
    }

    //Display message
    function alertMessage (){
        if(isset($_SESSION['status'])){
            echo'<div class="alert alert-warning" role="alert"> <h6>'.$_SESSION['status'].'</h6></div>';
            unset($_SESSION['status']);
        }
    }

    //insert record
    function insert ($tableName, $data){
        global $conn;

        $table = validate($tableName);

        // break keys and values from asscoiative array
        $columns = array_keys($data);
        $values = array_values($data);

        // 3. สร้างสตริงของคีย์และค่าเพื่อนำไปใช้ในคำสั่ง SQL
        $finalColumn = implode(',', $columns);
        $finalValue = "'".implode("', '", $values). "'";

        $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValue)";
        $result = mysqli_query($conn, $query);
        return $result;
    }


    function update ($tableName, $id, $data){
        global $conn;

        $table = validate($tableName);
        $id = validate($id);

        $updateDataString= "";

        foreach($data as $column => $value){
            $updateDataString .= $column.'='."'$value',";

        }

        $finalUpdateData = substr(trim($updateDataString),0,-1);

        $query = "UPDATE $table SET $finalUpdateData WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getAll($tableName, $status= NULL){

        global $conn;

        $table = validate($tableName);
        $status = validate($status);

        if ($status == 'status') {
            $query = "SELECT * FROM $table WHERE status = '0'";
        }
        else{
            $query = "SELECT * FROM $table";
        }

        return mysqli_query($conn, $query);
    }

    function getById ($tableName, $id){
        global $conn;

        $table = validate($tableName);
        $id = validate($id);

        $query = "SELECT * FROM $table  WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            
            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_assoc($result);
                $response = [
                    'status' => 200,
                    'data' => $row,
                    'message' => 'Record found'
                ];
                return $response;

            }else{

                $response = [
                    'status' => 404,
                    'message' => 'No Data found'
                ];
                return $response;
            }
        }
    }

    //Delete data from database using id
    function delete ($tableName, $id){
        global $conn;

        $table = validate($tableName);
        $id = validate($id);

        $query = "DELETE FROM $table WHERE id = '$id' LIMIT 1";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function checkParamId($type){

        if(isset($_GET[$type])){
            if($_GET[$type] != ''){

                return $_GET[$type];

            }else{

                return '<h5> No Id found </h5>';
            }
        }else{
            return'<h5> No id Given </h5>';
        }
    }

    //logout function
    function logoutSession (){

        unset($_SESSION['loggedIn']);
        unset($_SESSION['loggedInUser']);
    };
    
    function jsonResponse ($status, $status_type, $message){

        $response = [
            'status' => $status,
            'status_type' => $status_type,
            'message' => $message,
        ];
        echo json_encode($response);
        return;
    }
?>
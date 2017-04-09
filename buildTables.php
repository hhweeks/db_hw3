<?php
$servername = "chester.cs.unm.edu";
$username = "hhweeks";
$password = "tFL0ruzf";
$db = $username;
//$data_file = '/Users/hhweeks/Documents/University/Databases564/bills/hconres/hconres1/data.json';
$dir = '/Users/hhweeks/Documents/University/Databases564/bills';

$conn =  mysql_connect($servername, $username,$password,"> /Users/hhweeks/Documents/University/Databases564/hw3/hw3.log") or die('Could not connect: ' . mysql_error());
mysql_select_db($username, $conn);

echo "Connected successfully\n";

/*
if(!mysql_query("tee /Users/hhweeks/Documents/University/Databases564/hw3/hw3.log", $conn)){
    echo('Error : ' . mysql_error()) . "\n";
}
*/

cleanStart($conn);
importToTable($conn);

echo "Complete\n";

function cleanStart($conn){
    $sql = "drop table Product";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "drop table PC";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "drop table Laptop";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "drop table Printer";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }

    //CREATE
    $sql = "create table Product( maker char, model int, type varchar(20));";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "create table PC( model int, speed float, ram int, hd int, price int);";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "create table Laptop(model int, speed float, ram int, hd int, screen float, price int);";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
    $sql = "create table Printer(model int, color varchar(20), type varchar(20), price int);";
    if(!mysql_query($sql, $conn)){
        echo('Error : ' . mysql_error()) . "\n";
    }
    
}

function importToTable($conn){

    //Product//
    $csvFile = fopen('product', 'r');

    while(($line = fgetcsv($csvFile)) !== FALSE){
        //print($line[0]." ".$line[1]." ".$line[2]);
        $sql = "insert into  Product(maker, model, type) values('$line[0]', '$line[1]', '$line[2]')";

        if(!mysql_query($sql, $conn)){
             echo('Error : ' . mysql_error()) . "\n";
        }
    }

    //PC//
    $csvFile = fopen('PC.csv', 'r');
    while(($line = fgetcsv($csvFile)) !== FALSE){
        //print($line[0]." ".$line[1]." ".$line[2]." ".$line[3]." ".$line[4]);
        $sql = "insert into PC(model, speed, ram, hd, price) values('$line[0]', '$line[1]', '$line[2]', '$line[3]', '$line[4]')";
        
        if(!mysql_query($sql, $conn)){
            echo('Error : ' . mysql_error()) . "\n";
        }
    }

    //Laptop//
    $csvFile = fopen('Laptop.csv', 'r');
    while(($line = fgetcsv($csvFile)) !== FALSE){

        $sql = "insert into Laptop(model, speed, ram, hd, screen, price) values('$line[0]', '$line[1]', '$line[2]', '$line[3]', '$line[4]', '$line[5]')";
        
        if(!mysql_query($sql, $conn)){
            echo('Error : ' . mysql_error()) . "\n";
        }
    }

    //Printer
    $csvFile = fopen('Printer.csv', 'r');
    while(($line = fgetcsv($csvFile)) !== FALSE){

        $sql = "insert into Printer(model, color, type, price) values('$line[0]', '$line[1]', '$line[2]', '$line[3]')";
        
        if(!mysql_query($sql, $conn)){
            echo('Error : ' . mysql_error()) . "\n";
        }
    }    
 
}

?>
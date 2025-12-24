<?php
class config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "php_03";

    private $conn;

    public function connectDB()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connectDB();
        $query = "INSERT INTO students(name, age, course) VALUES ('$name',$age,'$course')";
        return mysqli_query($this->conn, $query); //boolean insert(true/false)
    }
}
?>
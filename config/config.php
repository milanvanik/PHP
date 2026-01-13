<?php
class config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "php_03";

    private $conn;

    private $STUDENT_TABLE = "students";
    private $USER_TABLE = "users";
    private $DEPARTMENT_TABLE = "departments";
    private $MEMBER_TABLE = "members";

    public function connectDB()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insertStudent($name, $age, $course)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->STUDENT_TABLE(name, age, course) VALUES ('$name',$age,'$course')";
        return mysqli_query($this->conn, $query); //boolean insert(true/false)
    }

    public function fetchAllStudents()
    {
        $this->connectDB();
        $query = "SELECT * FROM $this->STUDENT_TABLE";
        return mysqli_query($this->conn, $query); //object of mysqli_result class
    }

    public function deleteStud($id)
    {
        $this->connectDB();
        $result = $this->fetchSingleStudent($id);
        $single_student = mysqli_fetch_array($result);
        if ($single_student) {
            $query = "DELETE FROM $this->STUDENT_TABLE WHERE id=$id";
            return mysqli_query($this->conn, $query); //boolean delete(true/false)
        } else {
            return false;
        }

    }

    public function fetchSingleStudent($id)
    {
        $this->connectDB();
        $query = "SELECT * FROM $this->STUDENT_TABLE WHERE id=$id";
        return mysqli_query($this->conn, $query); //object of mysqli_result class
    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connectDB();

        $result = $this->fetchSingleStudent($id);

        $single_student = mysqli_fetch_assoc($result);

        if ($single_student) {
            $query = "UPDATE $this->STUDENT_TABLE SET name='$name', age=$age, course='$course' WHERE id=$id";
            return mysqli_query($this->conn, $query);
        } else {
            return false;
        }
    }

    public function loginUser($email, $password)
    {
        $this->connectDB();
        $query = "SELECT * FROM $this->USER_TABLE WHERE email = '$email'";
        $res = mysqli_query($this->conn, $query);

        $user = mysqli_fetch_assoc($res);

        if ($user) {
            return password_verify($password, $user['password']);
        } else {
            return false;
        }
    }

    public function registerUser($name, $email, $password)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->USER_TABLE (name, email, password) VALUES ('$name', '$email', '$password')";
        return mysqli_query($this->conn, $query);
    }

    public function insertDepartment($name)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->DEPARTMENT_TABLE (name) VALUES ('$name')";
        return mysqli_query($this->conn, $query);
    }

    public function insertMember($name, $id)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->MEMBER_TABLE(name, department_id) VALUES ('$name', $id)";
        return mysqli_query($this->conn, $query);
    }

}
?>
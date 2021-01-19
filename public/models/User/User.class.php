<?php

class User {

    private $conn;
    private $fullname;
    private $email;
    private $password;

    /**
     * Independience injection from Connection
     * Every instance from User needs an object Connection
     */
    public function __construct(Connection $con) {
        $this->conn = $con;
    }

    /** 
     *Getters and Setters
     * **/
    public function setFullname(string $fullname){
        $this->fullname = $fullname;
    }

    public function getFullname(){
        return $this->fullname;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function cryptPass(string $password)
    {
        #Crypting  the password by using password_hash() method
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public  function setPassword(string $password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function signUp()
    {
        try{
        /**
         * Preparing the sql statement 
         *@Password must be crypt
         *@getConnection() method returns the connection with the db
         *@prepare() method is just from PDO whit our sql statement within
         */
            $stmt = $this->conn->getConnection()->prepare("INSERT INTO USERS (USER_FULLNAME, USER_EMAIL, USER_PASSWORD) VALUES(:fullname, :email, :password)");

            /*Bind parameters*/
            $stmt->bindParam(':fullname', $this->fullname);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);

            /*Execute the statement*/
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }


    public function signIn()
    {
        try{
            $stmt = $this->conn->getConnection()->prepare("SELECT * FROM USERS WHERE USER_EMAIL = '$this->email' ");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if ($result) {
                foreach ($stmt as $data) {
                    echo $data["USER_EMAIL"];
                    echo $data["USER_PASSWORD"];
                    if (password_verify($this->password, $data["USER_PASSWORD"])) {
                        return $data;
                    }
                }
            }
            echo "Done";
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $this->conn = null;
        return false;
    }    
}

?>
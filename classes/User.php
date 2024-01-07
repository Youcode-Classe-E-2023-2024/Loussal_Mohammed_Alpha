<?php

namespace _classes;

class User extends Database
{
    private $password;

    private $verificationCode;
    private $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        parent::__construct();
    }

    public function __getVerificationCode() {
        return $this->verificationCode;
    }
    public function getPassword() {
        return $this->password;
    }
    public function register($firstName, $lastName, $email, $password){
            $this->query("INSERT INTO $this->tableName (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
            $this->bind(':firstName', $firstName);
            $this->bind(':lastName', $lastName);
            $this->bind(':email', $email);
            $this->bind(':password', $password);
            $this->execute();
    }

    public function login($email, $password){
        $this->query('SELECT * FROM users WHERE email = :email');
        $this->bind(':email', $email);
        $row = $this->single();

        if(!empty($row) && !is_null($row)){
            $hashedPassword = $row['password'];
            if (password_verify($password, $hashedPassword)){
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['email'] = $row['email'];
                $this->password = $row['password'];
                return $row;
            }else{
                throw new Exception('Password incorrect !');
            }
        }else {
            throw new Exception('Account not exist !');
        }
    }

    public function isEmailUnique($email){
        $this->query('SELECT email FROM users WHERE email = :email');
        $this->bind(':email', $email);
        $row = $this->single();
        if(empty($row)){
            return true;
        } else {
            return false;
        }
    }

    public function getUsers(){
        $this->query("SELECT * FROM $this->tableName");
        return $this->multiple();
    }
    public function getUserByColumn($column, $param){
        $this->allowedColumns = ['email', 'id', 'password'];
        // Check Param Validation:
        $paramValid = $this->checkParam($column);
        if($paramValid) {
            $this->query("SELECT * FROM $this->tableName WHERE $column = :param");
            $this->bind(':param', $param);

                return $this->single();
        }
    }

    public function edit($pictureCol, $firstNameCol, $lastNameCol, $emailCol, $passwordCol, $picture, $firstName , $lastName, $email, $password, $user_id){
        $users = $this->getUsers();
        foreach ($users as $user) {
            if($user['user_id'] === $_SESSION['user_id']){
                $picture = $user['picture'];
                $username = $user['username'];
                $email = $user['email'];
                $password = $user['password'];
            }
        }
        $this->allowedColumns = ['picture', 'firstName', 'lastName', 'email', 'password'];
        $paramValid = $this->checkParam($pictureCol, $firstNameCol, $lastNameCol, $emailCol, $passwordCol);
        if($paramValid) {
            $this->query("UPDATE $this->tableName
                            SET $pictureCol = :picture, 
                                $firstNameCol = :firstName,
                                $lastNameCol = :lastName,
                                $emailCol = :email,
                                $passwordCol = :passowrd
                            WHERE user_id = :user_id");
            $this->bind(':firstName', $firstName);
            $this->bind(':lastName', $lastName);
            $this->bind(':picture', $picture);
            $this->bind(':email', $email);
            $this->bind(':password', $password);
            $this->bind(':user_id', $user_id);

            $this->execute();
        }
    }
    public function delete($user_id){
        $this->query("UPDATE $this->tableName SET supprimer = 1
                            WHERE user_id = :user_id");
        $this->bind(':user_id', $user_id);
        $this->execute();
    }

}
$db = new Database();
$user = new User('users');
$hashedPasswor = password_hash('password', PASSWORD_DEFAULT);
$users = $user->getUsers();

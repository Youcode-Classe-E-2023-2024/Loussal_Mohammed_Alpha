<?php 
class Dashboard {
    private $db; 

    public function __construct() {
        $this->db = new Database();
    }

    // register user
    public function insertAdderName($adder_name) {
        // query
        $this->db->query('INSERT INTO notifications(adder_name) VALUES(:adder_name)');
        // bind values
        $this->db->bind(':adder_name', $adder_name);
        // execute 
        $this->db->execute();
    }

    // get all users 
    public function getAllAdders($adder_name) {
        // $adder_name = 'jack';
        $this->db->query("SELECT * FROM notifications WHERE adder_name != :adder_name");
        $this->db->bind(':adder_name', $adder_name);
        $userNames = $this->db->resultSet();

        return $userNames;
    }
}
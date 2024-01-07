<?php
class ManageUsers extends Controller {
    public function index(){
        $this->view('manageUsers/index');
    }

    public function addUser(){
        if($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => '',
                'email' => '',
                'phone' => '',
                'user_id' => $_SESSION['user_id'], 
            ];

            $this->view('manageUsers/addUser', $data);
        }
    }

    public function editUser($userId){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $data = [
                'userId' => $userId,
                'username' => trim($username), 
                'email' => trim($email),
                'phone' => trim($phone),
                'user_id' => $_SESSION['user_id'], 
                'username_err' => '', 
                'email_err' => '', 
                'phone_err' => ''
            ];

            // validate username 
            if(empty($data['username'])) {
                $data['username_err'] = 'Please enter username';
            }

            // validate email 
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // validate phone 
            if(empty($data['phone'])) {
                $data['phone_err'] = 'Please enter phone';
            }

            // make sure no errors 
            if(empty($data['usename_err']) && empty($data['email_err']) && empty($data['phone_err'])) {
                // validated
                redirect('manageUsers/index');
            }else {
                // load view with errors 
                $this->view('manageUsers/editUser', $data);
            }

        }else {
            $data = [
                'userId' => $userId,
                'username' => '',
                'email' =>  '',
                'phone' => '', 
                'username_err' => '', 
                'email_err' => '',
                'phone_err' => '',
            ];
    
            $this->view('manageUsers/editUser', $data);
        }
    }
}
?>
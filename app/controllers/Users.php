<?php 
class Users extends Controller {
    
    public $userModel;
    public  function __construct() {
        $this->userModel = $this->model('User');
    }
    

    public function register() {
        // check for POST 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            /* process form */

            // sanitize POST data 
            $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Init data 
            $data = [
                'name' => trim($name),
                'email' => trim($email),
                'password' => trim($password),
                'confirm_password' => trim($confirm_password),
                'name_err' => '', 
                'email_err' => '', 
                'password_err' => '', 
                'confirm_password_err' => ''
            ];

            // validate name 
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter your name';
            }

            // validate email 
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }else {
                // check email 
                if($this->userModel->findUserByEmail($data['email']) == true) {
                    $data['email_err'] = 'Email already exists';
                }
            }

            // validate password 
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // validate confirm password 
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'confirm password';
            }else {
                if($data['confirm_password'] != $data['password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // make sure errors are empty 
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // validated 
                
                // hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register user 
                if($this->userModel->register($data)) {
                    redirect('users/login');
                }else {
                    die('something went wrong');
                }

            }else {
                // load views with errors
                $this->view('users/register', $data); 
            }

        }else {
            // Init data 
            $data = [
                'name' => '',
                'email' => '',
                'password' => '', 
                'confirm_password' => '', 
                'name_err' => '', 
                'email_err' => '', 
                'password_err' => '', 
                'confirm_password_err' => ''
            ];

            // load view 
            $this->view('users/register', $data);
        }
    }


    public function login() {
        // check for POST 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            /* process form */

            // sanitize POST data 
            $email = filter_var($_POST['email'], FILTER_SANITIZE_URL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_URL);

            // Init data 
            $data = [
                'email' => trim($email),
                'password' => trim($password),
                'email_err' => '', 
                'password_err' => ''
            ];

            // validate email 
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // validate password 
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {
                // user found 
            }else {
                // user not found
                $data['email_err'] = 'No user found';
            }

            // make sure errors are empty 
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // validated 
                // check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    // create session
                    $this->createUserSession($loggedInUser);
                    // die('SUCCESS');

                }else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            }else {
                // load views with errors
                $this->view('users/login', $data); 
            }

        }else {
            // Init data 
            $data = [
                'email' => '',
                'password' => '', 
                'email_err' => '', 
                'password_err' => ''
            ];

            // load view 
            $this->view('users/login', $data);
        }
    }


    public function  createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('home/index');
    }

    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('posts/index');
    }

}
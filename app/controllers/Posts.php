<?php 
class Posts extends Controller {
    public $postModel;
    public $userModel;

    public function __construct() {
        if(!isLoggedIn()){
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index(){
        // get posts 
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ]; 

        $this->view('posts/index', $data);
    }

    public function add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $data = [
                'title' => trim($title), 
                'body' => trim($body),
                'user_id' => $_SESSION['user_id'], 
                'title_err' => '', 
                'body_err' => ''
            ];

            // validate title 
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            // validate body 
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            // make sure no errors 
            if(empty($data['title_err']) && empty($data['body_err'])) {
                // validated 
                if($this->postModel->addPost($data)) {
                    redirect('posts/index');
                }else {
                    die('something went wrong!');
                }
            }else {
                // load view with errors 
                $this->view('posts/add', $data);
            }

        }else {
            $data = [
                'title' => '',
                'body' =>  '',
                'user_id' => '', 
                'title_err' => '', 
                'body_err' => ''
            ];
    
            $this->view('posts/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $data = [
                'id' => $id,
                'title' => trim($title), 
                'body' => trim($body),
                'user_id' => $_SESSION['user_id'], 
                'title_err' => '', 
                'body_err' => ''
            ];

            // validate title 
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            // validate body 
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            // make sure no errors 
            if(empty($data['title_err']) && empty($data['body_err'])) {
                // validated 
                if($this->postModel->updatePost($data)) {
                    redirect('posts/index');
                }else {
                    die('something went wrong!');
                }
            }else {
                // load view with errors 
                $this->view('posts/edit', $data);
            }

        }else {
            // get existing post from model
            $post = $this->postModel->getPostById($id);

            // check for owner
            if($post->user_id != $_SESSION['user_id']) {
                redirect('posts/index');
            }

            $data = [
                'id' => $id,
                'title' =>  $post->title,
                'body' => $post->body, 
                'title_err' => '', 
                'body_err' => '', 
            ];
    
            $this->view('posts/edit', $data);
        }
    }

    public function show($id) {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post, 
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // get existing post from model 
            $post = $this->postModel->getPostById($id);
            // check for owner 
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            
            if($this->postModel->deletePost($id)){
                redirect('posts/index');
            }else{
                die('something wrong');
            }
        }else{
            redirect('posts/index');
        }
    }
}
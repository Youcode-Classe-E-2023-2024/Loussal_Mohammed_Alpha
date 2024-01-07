<?php
class Pages extends Controller {

    public function __construct() {
    }

    public function index() {
        if(isLoggedIn()) {
            redirect('home/index');
        }

        $data = [
            'title' => 'Share Posts', 
            'description' => 'Simple social network built on the TraversyMVC PHP framework'
        ];

        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'Welcome about', 
            'description' => 'App to share Posts with other users'
        ];
        $this->view('pages/about', $data);
    }
}
?>

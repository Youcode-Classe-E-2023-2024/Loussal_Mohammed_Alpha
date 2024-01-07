<?php 
/* 
 * Base Controller
 * Loads the models and views
*/

class Controller {
    // load model 
    public function model($model) {
        // require model file 
        if(file_exists('../app/models/' .$model. '.php')) {
            require_once '../app/models/' .$model. '.php'; 
        }else {
            die('model does not exist');
        }

        // instatiate model 
        return new $model();
    }

    // load view 
    public function view($view, $data = []) {
        // check for view file 
        if(file_exists('../app/views/' .$view. '.php')) {
            require_once '../app/views/' .$view. '.php'; 
        }else {
            // view does not exist 
            die('View does not exist');
        }
    }
}
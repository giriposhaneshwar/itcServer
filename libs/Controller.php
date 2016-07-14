<?php

/**
 * Main Controller
 */
class Controller {

    private $model;
    private $modelMethod = null;
    private $mainModel;

    function __construct() {
        // echo "this is the main controller";
    }

    public function loadModel($name, $modelPath = 'models/') {

        $path = $modelPath . $name . '_model.php';
        // echo $path."\n";


        if (file_exists($path)) {
            require $modelPath . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }


        $this->mainModel = new Model();
    }

    public function loadModelMethod($mth, $data) {
        // calling the method to run
        return $this->model->{$mth}($data);
    }

    public function getIdByName($name) {
        $getUser = $this->mainModel->getIdByName($name);
        return $getUser;
    }

}

?>
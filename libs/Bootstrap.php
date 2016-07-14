<?php

/**
 * Bootstrap Starter page
 */
class Bootstrap {

    private $_url = null;
    private $_data = null;
    private $_controller = null;
    private $Controller = "controllers/";
    private $Model = "model/";

    function init() {
        $this->getUrl();


        if (!empty($this->_url[0])) {
            $this->_loadController($this->_url[0], $this->_url[1], $this->_data);
        }
    }

    function getUrl() {
//        mysqli_set_charset($con, "utf8");
        $jsonData = file_get_contents("php://input");

        if (get_magic_quotes_gpc()) {
            $d = stripslashes($jsonData);
        } else {
            $d = $jsonData;
        }

        $d = json_decode($d, true);






        // $k=preg_replace('/\s+/', '',$d);
        // $k = str_replace('&quot;', '"', $d);
        // $de = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $k), true );

        /* switch (json_last_error()) {
          case JSON_ERROR_NONE:
          echo ' - No errors';
          break;
          case JSON_ERROR_DEPTH:
          echo ' - Maximum stack depth exceeded';
          break;
          case JSON_ERROR_STATE_MISMATCH:
          echo ' - Underflow or the modes mismatch';
          break;
          case JSON_ERROR_CTRL_CHAR:
          echo ' - Unexpected control character found';
          break;
          case JSON_ERROR_SYNTAX:
          echo ' - Syntax error, malformed JSON';
          break;
          case JSON_ERROR_UTF8:
          echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
          break;
          default:
          echo ' - Unknown error';
          break;
          } */







        $url = $d['method'];
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        // echo "URL : ". $d['method'];
//         var_dump($url);
        $this->_url = $url;

        $this->_data = $d['data'];
    }

    // loading the controllers
    function _loadController($url, $method, $data) {
        $file = $this->Controller . $url . ".php";

        // echo $file. " | ".$method." | ".json_encode($data);
        // echo $file." | ".file_exists($file)." lll";

        if (file_exists($file)) {
            // getting controller
            require $file;
            // calling the controller
            $this->_controller = new $url();
            $this->_controller->loadModel($url, $this->Model);
            $this->_controller->{$method}($method, $data);
        } else {
            // handeling the error controller here
        }
    }

}

?>
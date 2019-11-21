<?php
use Restserver \Libraries\REST_Controller ; 
Class User extends REST_Controller{
    public function __construct(){ 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content- Length, Accept-Encoding");
        parent::__construct(); 
        $this->load->model('UserModel'); 
        $this->load->library('form_validation');
    }

    public function index_get($username = null){
        $response = $this->UserModel->getInfo($username);
    }

    public function index_post($id = null){
        //
    }

    public function index_delete($id = null){ 
        //tidak ada delete
    }


    public function returnData($msg,$error){
        $response['error']=$error; 
        $response['message']=$msg;
        return $this->response($response);
    } 
}

Class UserData{
    public $name;
    public $password;
    public $email;
}
<?php
use Restserver \Libraries\REST_Controller; 
require(APPPATH . 'libraries/REST_Controller.php');

Class Edit extends REST_Controller {
    
    public function __construct(){ 
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content- Length, Accept-Encoding");
        parent::__construct(); 
        $this->load->model('UserModel'); 
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index_post($username = null){
        $validation = $this->form_validation; 
        $rule = $this->UserModel->rules(); 
            array_push($rule,
                    [ 
                        'field' => 'username',  
                        'label' => 'username',
                        'rules' => 'required'
                    ],
                    [
                        'field' => 'email',  
                        'label' => 'email',
                        'rules' => 'required'
                    ],
                    [ 
                        'field' => 'password',  
                        'label' => 'password',
                        'rules' => 'required'
                    ],
                    [
                        'field' => 'noTelp',  
                        'label' => 'noTelp',
                        'rules' => 'required'
                    ]
                );
            
            $validation->set_rules($rule); 
            if (!$validation->run()) {
                return $this->returnData($this->form_validation->error_array(), true);
            }
            $user = new UserData();
            $user->username = $this->post('username'); 
            $user->email = $this->post('email'); 
            $user->password = $this->post('password'); 
            $user->noTelp = $this->post('noTelp');
            $response = $this->UserModel->update($user,$username);
            
            return $this->returnData($response['msg'],$response['error']); 
    
    }

    public function returnData($msg,$error){
        $response['error']=$error; 
        $response['message']=$msg;
        return $this->response($response);
    } 
    
}

Class UserData{
    public $id;
    public $email;
    public $username;
    public $password;
    public $noTelp;
}

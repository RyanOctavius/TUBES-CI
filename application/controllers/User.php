<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    require APPPATH . '/libraries/REST_Controller.php';


    class User extends \Restserver\Libraries\REST_Controller 
    {
        public function __construct() 
        {
         header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

            parent::__construct();
            $this->load->model('UserModel','User');
            $this->load->helper('string');
        }


        public function index_get($id = null)
        {
            if ($id == null)
                $data = $this->User->getAll();
            else
                $data = $this->User->getAll('id_user', $id);
            
            $this->response([
                'status' => TRUE,
                'message' => 'Success',
                'data' => $data
            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
        }


        public function index_post() 
        {
            $id =  random_string('sha1');
            $username = $this->post('username');
            $email = $this->post('email');
            $password = password_hash($this->post('password'), PASSWORD_DEFAULT);
            $noTelp = $this->post('noTelp');
            $role = $this->post('role');

            $temp = $this->User->getAll('email', $email);

            if ($temp != null) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Email Sudah Terdaftar!',
                    'data' => $temp
                ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            } else if ($username != null && $password != null &&$email != null && $noTelp != null &&
                $role != null) {
                    $data = [
                        'id' =>  $id,
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,                        
                        'noTelp' => $noTelp,
                        'role' => $role,
                        'status' => 0
                    ];

                    $config = [
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8',
                        'protocol'  => 'smtp',
                        'smtp_host' => 'ssl://smtp.gmail.com',
                        'smtp_user' => 'tumbalios1@gmail.com', 
                        'smtp_pass' => 'terserah123',     
                        'smtp_port' => 465,
                        'crlf'      => "\r\n",
                        'newline'   => "\r\n"
                    ];

                    $this->load->library('email', $config);
                    $this->email->from('tumbalios1@gmail.com', 'PAW CLUB');
                    $this->email->to($email);
                    $this->email->subject('Verifikasi Email PAW CLUB');
                    $this->email->message("<p>Setelah melakukan pendaftaran akun user <strong>PAW CLUB</strong>, lakukan <b>AKTIVASI</b> akun Anda dengan mengklik tautan berikut : </p><br>".base_url()."User/verifikasi/?email=$email&kode=$password"); 
                    
                    if ($this->email->send()) {
                        if ($this->User->createUser($data) > 0) {
                            $this->response([
                                'status' => TRUE,
                                'message' => 'Berhasil',
                                'data' => $data
                            ], \Restserver\Libraries\REST_Controller::HTTP_OK);
                        } else {
                            $this->response([
                                'status' => FALSE,
                                'message' => 'Gagal!'
                            ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                        }
                    } else {
                        $this->response([
                            'status' => FALSE,
                            'message' => 'Koneksi Error!'
                        ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                    }
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Inputan Tidak Ditemukan!'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }


        public function index_delete() 
        {
            $id = $this->delete('id');

            if ($id != null) {
                $data = $this->User->getAll('id_user', $id);

                if ($this->User->deleteUser($id) > 0) {
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Berhasil',
                        'data' => $data
                    ], \Restserver\Libraries\REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'ID Tidak Ditemukan!'
                    ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Inputan Tidak Ditemukan!'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }


        public function edit_post()
        {
            $id =  $this->post('id');
            $username = $this->post('username');
            $email = $this->post('email');
            $noTelp = $this->post('noTelp');
            $role = $this->post('role');

            if ($nama != null && $email != null && $nohp != null &&
                $gender != null && $id != null) {
                    $data = [
                        'username' => $username,
                        'email' => $email,
                        'noTelp' => $noTelp,
                        'role' => $role,
                    ];

                    if ($this->User->updateUser($data, $id) > 0) {
                        $this->response([
                            'status' => TRUE,
                            'message' => 'Berhasil',
                            'data' => $data
                        ], \Restserver\Libraries\REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => FALSE,
                            'message' => 'ID Tidak Ditemukan!'
                        ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
                    }
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Inputan Tidak Ditemukan!'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }


        public function login_post() {
            $email = $this->post('email');
            $password = $this->post('password');

            if ($this->User->loginUser($email, $password) > 0) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Berhasil',
                    'data' => $this->User->getAll('email', $email)
                ], \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else if ($this->User->loginUser($email, $password) == -1) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Email Tidak Terdaftar!'
                ], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Email / Kata Sandi Salah!'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }


        public function verifikasi_get() {
            $email = $this->get('email');
            $kode = $this->get('kode');

            if ($this->User->verifikasiEmail($email, $kode) > 0) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Berhasil'
                ], \Restserver\Libraries\REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Gagal!'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }


?>
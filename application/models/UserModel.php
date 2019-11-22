<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    private $table = 'user';
    public $id; 
    public $username; 
    public $email; 
    public $password;
    public $noTelp; 
    public $role;
    public $rule = [
        [ 
            'field' => 'username',  
            'label' => 'username',
            'rules' => 'required'
        ]
    ];
    public function Rules() { return $this->rule; }
    public function getAll() { 
        return $this->db->get('data_user')->result();
    }

    public function store($request) {
        $this->username = $request->username;
        $this->email = $request->email;
        $this->password = password_hash($request->password, PASSWORD_BCRYPT); 
        $this->noTelp = $request->noTelp;
        $this->role = $request->role;
        $query =  "SELECT * FROM user WHERE username = ?" ;
        $result = $this->db->query($query, $this->username);
        if($result->num_rows() == 0){
            if($this->db->insert($this->table, $this)){
                return ['msg'=>'Berhasil','error'=>false];
            }
            return ['msg'=>'Gagal','error'=>true]; 
        }
        else{
            return ['msg'=>'Sudah ada','error'=>true];
        }
    }

    public function check_login($request) {
        $this->username = $request->username;
        $this->password =$request->password;
        $query = "SELECT * FROM user WHERE username = ? LIMIT 1" ;
        $result = $this->db->query($query, $this->username);
        if($result->num_rows() != 0)
        {
            $hash = $result->row()->password;
            if(password_verify($this->password, $hash)){
                
                return ['msg'=>'Berhasil','error'=>false]; 
            }
            else{
                return ['msg'=>'Password salah','error'=>true];
            }
        }
        else{
            return ['msg'=>'Username tidak ada','error'=>true];
        }
    }
       
    
    public function update($request,$username) {
        $updateData = [
        'email' => $request->email, 
        'username' =>$request->username,
        'password' => password_hash($request->password, PASSWORD_BCRYPT),
        'noTelp' =>$request->noTelp,
        'role' => $request->role,
        ]; 

        $query = "SELECT * FROM user WHERE username = ? LIMIT 1" ;
        $result = $this->db->query($query, $username);
        if($result->num_rows() == 0)
        {
            $query = "SELECT * FROM user WHERE email = ? LIMIT 1" ;
            $result = $this->db->query($query, $request->email);
            if($result->num_rows()==0)
            {
                $this->db->where('username',$username)->update($this->table, $updateData);
                return ['msg'=>'Berhasil','error'=>false];
            }
            else{
                return ['msg'=>'Email sudah ada','error'=>true];
            }
        }
        else{
            return ['msg'=>'Username sudah ada','error'=>true];
        }
        
    }

    public function destroy($id){
    if (empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row())) 
        return ['msg'=>'Id tidak ditemukan','error'=>true];
    if($this->db->delete($this->table, array('id' => $id))){ 
        return ['msg'=>'Berhasil','error'=>false];
    }
    return ['msg'=>'Gagal','error'=>true]; 
    }
}
?>

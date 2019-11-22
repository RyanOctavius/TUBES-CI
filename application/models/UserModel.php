<?php

    class UserModel extends CI_Model {

        public function getAll($key = null, $value = null) {
            if ($value == null || $key == null)
                return $this->db->get('user')->result_array();
            else
                return $this->db->get_where('user', [$key => $value])->result_array();
        }


        public function createUser($data) {
            $this->db->insert('user', $data);
            return $this->db->affected_rows();
        }


        public function deleteUser($id) {
            $this->db->delete('user', ['id_user' => $id]);
            return $this->db->affected_rows();
        }


        public function updateUser($data, $id) {
            $user = array(
                'nama' => $data['nama'],
                'email' => $data['email'],
                'noTelp' => $data['noTelp'],
                'role' => $data['role'],
            );

            $this->db->where('id_user', $id);
            $this->db->update('user', $user);
            return $this->db->affected_rows();
        }


        public function loginUser($email, $password) {
            $data = $this->db->get_where('user', ['email' => $email])->result_array();

            if ($data == null) 
                return -1;
            else {
                if ($data[0]['status'] == 0)
                    return -1;
                else {
                    if (password_verify($password, $data[0]['password']))
                        return 1;
                    else
                        return 0;
                }
            }
        }


        public function verifikasiEmail($email, $kode) {
            $data = $this->db->get_where('user', ['email' => $email])->result_array();

            if ($data == null) 
                return 0;
            else {
                if ($kode === $data[0]['password']) {
                    $this->db->set('status', 1, FALSE);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    return $this->db->affected_rows();
                }
                else
                    return 0;
            }
        }

    }

?>
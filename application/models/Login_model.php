<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function validate(){
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query
        $this->db->where('email', $email);
        $this->db->from('Users');
        // Run the query
        $query = $this->db->get();
        // Let's check if there are any results
        if($query->num_rows() == 1)
        {
            // If there is a user, check password
            $row = $query->row();
            
            if (!password_verify($password, $row->password))
                return FALSE;
            else
            {
                $data = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'email' => $row->email,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
            }
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>
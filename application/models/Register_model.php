<?php

class Register_model extends CI_Model
{
    public function create($data = NULL)
	{
		// check si l'utilisateur existe déjà
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('Users');

		$this->db->where('email', $this->input->post('email'));
		$query2 = $this->db->get('Users');

		if ($query->num_rows > 0 || $query2->num_rows > 0)
		{
			echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			echo "Username already taken";  
			echo '</strong></div>';
			return FALSE;
		}

		// S"il n'existe pas, on l'insère dans la table
		$data = array(
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		);

		if (!empty($data))
		{
			$this->db->insert('Users', $data);
			return (TRUE);
		}
	}
}
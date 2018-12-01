<?php

class User_model extends CI_Model
{
	public function __construct()
    {
		$this->load->database();
	}

	public function read($id = FALSE)
	{
		if ($id === FALSE)
        {
            $query = $this->db->get('Users');
            return $query->result_array();
        }

        $query = $this->db->get_where('Users', array('id' => $id));
        return $query->row_array();
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('Users', $data);
	}

	public function fetch_single_data($id)
	{
		$this->db->where('id', $id);
		
		return $this->db->get('Users');
	}
}

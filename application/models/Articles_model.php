<?php

class Articles_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_articles($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('Articles');
            return $query->result_array();
        }

        $query = $this->db->where('id', $id)
                            ->get('Articles');

        if ($query->num_rows() == 1) // Retourne l'article s'il existe
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function create()
    {
        $this->load->helper('url');

        $data = array(
            'user_id' => $this->session->id,
            'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'date' => date("Y-m-d H:i:s")
        );

		return $this->db->insert('Articles', $data);
	}

	public function update($id)
	{
		$data = array(
			'title' =>$this->input->post('title'),
			'content' => $this->input->post('content'),
			'date' => date("Y-m-d H:i:s")
		);

		return $this->db->where('id', $id)
							->update('Articles', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('Articles');
	}

	public function delete_all()
	{
		$this->db->query('DELETE * FROM Articles');
	}

	public function get_user_articles($user_id = FALSE)
    {
        if ($user_id === FALSE)
        {
            $query = $this->db->get('Articles');
            return $query->result_array();
        }

        $query = $this->db->where('user_id', $user_id)
                            ->get('Articles');

        if ($query->num_rows() > 0) // Retourne les articles s'ils existent
        {
            return $query->result_array();
        }
        else
        {
            return FALSE;
        }
    }
}
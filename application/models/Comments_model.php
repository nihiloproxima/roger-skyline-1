<?php

class Comments_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_comments($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('Comments');
            return $query->result_array();
        }

        $query = $this->db->get_where('Comments', array('id' => $id));
        
        return $query->row_array();
	}
	
	public function get_article_comments($article_id)
    {
		$query = $this->db->where('article_id', $article_id)
									->from('Comments')
									->get();

        if ($query->num_rows() > 0)
			   return $query->row_array();
		else
			return '';
    }

    public function set_comments($article_data)
    {
        $this->load->helper('url');

        $data = array(
			'article_id' => $article_data['article_id'],
			'user_id' => $this->session->id,
			'related_article_author_id' => $this->article_data['user_id'],
            'username' => $this->session->username,
			'content' => $this->input->post('content'),
			'date' => date("Y-m-d H:i:s")
        );

        return $this->db->insert('Comments', $data);
	}

	public function update($id)
	{
		$data = array(
			'pseudo' =>$this->input->post('pseudo'),
			'message' => $this->input->post('message'),
			'date' => date("Y-m-d H:i:s")
		);

		return $this->db->where('id', $id)
							->update('Comments', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('Comments');
	}
}
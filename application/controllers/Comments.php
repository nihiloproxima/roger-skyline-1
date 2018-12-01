<?php

class Comments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comments_model');
		$this->load->helper('url_helper');
		if($this->session->userdata('validated') == FALSE)
		{
            redirect(base_url('login'));
        }
	}

    public function index()
    {
        $data['comments'] = $this->comments_model->get_comments();
        $data['title'] = 'Tous les commentaires';

        $this->load->view('templates/header.php', $data);
        $this->load->view('comments/index.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function view($id = NULL)
    {
		$data['comments_item'] = $this->comments_model->get_comments($id);
		
		if (empty($data['comments_item']))
		{
			show_404();
		}

		$data['title'] = $data['comments_item']['pseudo'];

		$this->load->view('templates/header', $data);
		$this->load->view('comments/view', $data);
		$this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Envoyer un commentaire';

        $this->form_validation->set_rules('username', 'Pseudo', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('comments/create');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->comments_model->set_comments();
            $this->load->view('templates/header');
            $this->load->view('comments/success');
            $this->load->view('templates/footer');
		}
	}
    
    public function update($id)
    {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Modifier un commentaire';
		$data['id'] = $id;

        $this->form_validation->set_rules('pseudo', 'Pseudo', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('comments/update', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->comments_model->update($id);
			$this->load->view('templates/header');
			$this->load->view('comments/success');
			$this->load->view('templates/footer');
		}
	}
	
	public function delete($id)
	{
		$this->comments_model->delete($id);
		redirect(base_url());
	}
}
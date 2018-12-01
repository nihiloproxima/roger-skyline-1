<?php

class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('articles_model');
        $this->load->helper('url_helper');
        if($this->session->userdata('validated') == FALSE)
		{
            redirect(base_url('login'));
        }
	}

    public function index()
    {
        $data['articles'] = $this->articles_model->get_articles();

        $data['title'] = 'Roger Skyline - Articles';

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Content', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header.php', $data);
            $this->load->view('articles/index.php', $data);
            $this->load->view('templates/footer.php');
        }
        else
        {
			$this->articles_model->create();
			redirect('articles');
        }
    }

    public function view($id = NULL)
    {
		$this->load->model('user_model');
		$this->load->model('comments_model');
        
        $data['articles_item'] = $this->articles_model->get_articles($id);
        $data['author'] = $this->user_model->read($data['articles_item']['user_id']);

		if (empty($data['articles_item']))
		{
			show_404();
		}

        $data['title'] = $data['articles_item']['title'];

        // On récupère les commentaires de l'article
        $data['comments'] = $this->comments_model->get_article_comments($id);

		$this->load->view('articles/view', $data);
    }
    
    public function update($id)
    {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Modifier un commentaire';
		$data['id'] = $id;

        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('articles/update', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->articles_model->update($id);
            redirect(base_url());
		}
	}
	
	public function delete($id)
	{
		$this->articles_model->delete($id);
		redirect(base_url());
	}
	
	public function delete_all()
	{
		$this->articles_model->delete_all();
		redirect('articles');
	}
    
    public function groups()
    {
        $this->load->model('user_model');

        $data['points'] = $this->user_model->get_score($this->session->id);
    }
}
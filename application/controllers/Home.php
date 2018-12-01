<?php

class Home extends CI_Controller
{
	function __construct(){
        parent::__construct();
		if($this->session->userdata('validated') == FALSE)
		{
            redirect(base_url('login'));
        }
    }
	public function index()
	{
		$this->load->model('articles_model');

		$data['title'] = 'Accueil';
		$data['articles'] = $this->articles_model->get_articles();

		$this->load->view('templates/header', $data);
		$this->load->view('home/index.php', $data);
		$this->load->view('templates/footer');
	}
	
	public function view($id = NULL)
    {
		$data['comments_item'] = $this->article_model->get_article($id);
		
		if (empty($data['comments_item']))
		{
			show_404();
		}

		$data['title'] = $data['article_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('article/view', $data);
		$this->load->view('templates/footer');
    }
}
<?php

class User extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('user_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{

		$data['title'] = 'Mon profil';

		$this->load->view('templates/header', $data);
		$this->load->view('user/index.php', $data);
		$this->load->view('templates/footer');
	}

	public function account()
	{
		$data['title'] = 'Mon compte';

		$this->load->view('templates/header', $data);
		$this->load->view('user/account', $data);
		$this->load->view('templates/footer');
	}

	public function login()
	{
		$data['title'] = "Connexion";

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run()) //TRUE
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ($this->user_model->can_login($email, $password))
			{
				$session_data = array(
					'$email' => $email
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'user/enter');
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid Email and password');
				$this->load->view('templates/header', $data);
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}
		}
		else // FALSE
		{
			$this->load->view('templates/header', $data);
			$this->load->view('user/login');
			$this->load->view('templates/footer');
		}
	}

	public function enter()
	{
		if ($this->session->userdata('email') != '')
		{
			echo '<h2>Welcome - ' .$this->session->userdata('email').'</h2>';
			echo '<label><a href="'.base_url().'user/logout">Logout</a></label>';
		}
		else
		{
			redirect(base_url() . 'user/login');
		}
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity')
				{
					$this->session->unset_userdata($key);
				}
			}
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
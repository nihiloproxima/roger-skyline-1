<?php

class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index($msg = NULL)
    {
        // check if user is logged in
        $sess_user = $this->session->email;

        if(!empty($sess_user))
        {
            redirect(base_url());
        }
        // Load our view to be displayed
        // to the user
        $data['msg'] = $msg;
        $data['title'] = 'Inscription';

        $this->load->view('templates/header_offline', $data);
        $this->load->view('register/index.php', $data);
        $this->load->view('templates/footer');
    }

    public function process()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Inscription';

		$this->form_validation->set_rules('email', 'Email', 'strtolower|trim|required|valid_email',
										array('required' => 'L\'adresse email saisie n\'est pas valide.',
										'valid_email' => 'L\'adresse email saisie n\'est pas valide.'));
		$this->form_validation->set_rules('username', 'Username', 'trim|required',
										array('required' => 'Le nom d\'utilisateur saisi n\'est pas valide.'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
										array('required' => 'Le mot de passe saisi n\'est pas valide.'));
		$this->form_validation->set_rules('password-confirm', 'Password Confirmation', 'trim|required|matches[password]',
										array('required' => 'Les deux mots de passe ne correspondent pas.'));

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('register/index.php', $data);
            $this->load->view('templates/footer');
        }
        else
        {
			$query = $this->register_model->create();
			if ($query != FALSE)
			{
				$this->load->view('templates/header_offline', $data);
				$this->load->view('register/success');
				$this->load->view('templates/footer');
			}
		}
	}
}
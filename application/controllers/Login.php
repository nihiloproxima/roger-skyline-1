<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
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
        $data['title'] = 'Connexion';

        $this->load->view('templates/header_offline', $data);
        $this->load->view('login/index.php', $data);
        $this->load->view('templates/footer');
    }
    
    public function process()
    {
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if (! $result)
        {
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Adresse email ou mot de passe incorect.</font><br />';
            $this->index($msg);
        }
        else 
        {
            // If user did validate, 
            // Send them to members area
            if ($this->session->email == 'nathanplouvier60@gmail.com')
            {
                redirect('admin');
            }
            else
            {
                redirect('home');
            }
        }        
    }
}
?>
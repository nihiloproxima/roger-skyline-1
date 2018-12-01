<?php

class Admin extends CI_Controller
{
    public function index()
    {
        if ($this->session->email != 'nathanplouvier60@gmail.com')
        {
            redirect(base_url());
        }

        $data['title'] = 'Dashboard admin';

        $this->load->view('templates/header', $data);
        $this->load->view('admin/index.php', $data);
        $this->load->view('templates/footer');
    }
}
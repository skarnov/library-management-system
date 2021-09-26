<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Evis_login extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $admin_id = $this->session->userdata('admin_id');
        if ($admin_id != NULL)
        {
            redirect('evis_app', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('app_login');
    }

    public function check_admin_login()
    {
        $data = array();
        $data['admin_email'] = $this->input->post('admin_email', true);
        $data['admin_password'] = $this->input->post('admin_password', true);
        $data['type'] = $this->input->post('type', true);
        $this->form_validation->set_rules('admin_email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('admin_password', 'Password', 'trim|required|min_length[6]|max_length[250]|xss_clean');
        if($this->form_validation->run() == False)
        {
            $this->load->view('app_login');
        }
        else
        {
            $result = $this->admin_model->admin_login_check($data);
            $sdata = array();
            if ($result)
            {
                $sdata['admin_id'] = $result->admin_id;
                $sdata['admin_name'] = $result->admin_name;
                $sdata['admin_level'] = $result->admin_level;
                $this->session->set_userdata($sdata);
                redirect('evis_app');
            } 
            else
            {
                $sdata['exception'] = 'Your Email / Password Invalide !';
                $this->session->set_userdata($sdata);
                redirect('evis_login');
            }
        }
    }
     
    public function forgot_password()
    {
        $data = array();
        $data['title'] = 'Forgot Password';
        $this->load->view('forgot_password', $data);
    }
    
    public function reset_password()
    {
        $data = $this->input->post('admin_email', true);
        $result = $this->admin_model->check_password($data);
        $password = $result->admin_password;
        if ($password)
        {
            $mdata = array();
            $mdata['from_address'] = 'sk.modhu@gmail.com';
            $mdata['admin_full_name'] = 'Library Manager';
            $mdata['to_address'] = $data;
            $mdata['subject'] = 'Forget Password';
            $mdata['admin_password'] = $password;
            $this->mailer_model->forget_password($mdata,'forget_password_email');
            redirect('evis_login/forgot_password_success');
        }
        else{
            redirect('evis_login/forgot_password_failed');
        }
    }
    
    public function forgot_password_success()
    {
        $data = array();
        $data['title'] = 'Success';
        $data['homepage'] = $this->load->view('admin/forgot_password_success', '', true);
        $this->load->view('master', $data);
    }
    
    public function forgot_password_failed()
    {
        $data = array();
        $data['title'] = 'Failed';
        $data['homepage'] = $this->load->view('admin/forgot_password_failed', '', true);
        $this->load->view('master', $data);
    }
}
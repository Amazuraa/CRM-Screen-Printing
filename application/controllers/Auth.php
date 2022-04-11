<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  

	public function index()
	{      
        $this->load->library('user_agent');
        $akses = $this->session->userdata('masuk');
		if($akses){ 		
			redirect($_SERVER['HTTP_REFERER']);
		}
        $this->load->view('v_login');
    }
    
    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password'); 
        // $password = hash("sha512", md5(strip_tags($this->input->post('password'))));
        $cek = $this->db->query("SELECT * FROM tbl_user where username='".$this->db->escape_like_str($email)."' AND password='".$this->db->escape_like_str($password)."'");
        $userData = $cek->row_array();  
        if ($userData){
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('ses_id', $userData['id']);
            $this->session->set_userdata('ses_nama', $userData['name_user']);
            $this->session->set_userdata('ses_telp', $userData['telp_user']);
            $this->session->set_userdata('ses_email', $userData['username']);
            $this->session->set_userdata('ses_password', $userData['password']);
            $this->session->set_userdata('ses_akses', $userData['akses_user']);
            $this->session->set_userdata('ses_status', $userData['status']);
            redirect('Welcome');
        }else{
            redirect('Auth');
        }
        

        
    }
    
    public function ResetPassword()
    {
       
        $this->load->view('VResetPass');
    }
    
    public function sendNewPassword()
    {
        $email = $this->input->post('email');
        if($this->db->query("SELECT * FROM tbl_user where username='".$email."'")->row_array()){
            $randomPass = uniqid(rand(), true);
            $newPassword = hash("sha512", md5(strip_tags($randomPass)));
            $updatePassword = $this->model_app->update('tbl_user',array('password'=>$newPassword),array('username'=>$email));
            //send smtp
            $config = Array(        
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => '',
                'smtp_pass' => '',
                'smtp_timeout' => '4',
                'mailtype'  => 'html', 
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n"); 
            $from_email = ""; 
            $this->email->from($from_email, 'System Notification'); 
            $this->email->to($email);
            $this->email->subject('Lupa Password');
            $message = "
                <html>
                    <body>
                        <p style='color:black;'>Hallo admin, jangan khawatir</p>
                        <p style='color:black;'>Sekarang anda dapat masuk ke sistem menggunakan email dan password berikut: </p>
                        <p style='color:black; font-weight:550; text-decoration:none;'>Email : $email</p>
                        <p style='color:black; font-weight:550'>Password : $randomPass</p>
                    </body>
                </html>";              
            $this->email->message($message);
            $send = $this->email->send();
            if($send){
                redirect(site_url('Auth'));
            }
        }else{
            redirect(site_url('Auth/ResetPassword'));
        }
    }

    public function logout(){
        $this->session->sess_destroy();

        // Get & Reset session
        $this->load->library('session');
        $this->session->unset_userdata('Login');

        redirect(site_url('Login'));
    }
}

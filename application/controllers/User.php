<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
		
		// Load 'MSudi' script
		$this->load->model('model_app'); 
	}

	public function index()
	{}

    public function DataUser()
    {
        if ($this->uri->segment(3)=='Edit') {
            $data = [
                'menu'      => 'Co-Main/VTemplate_Menu',
                'content'   => 'content/v_add_user'
            ];
        }elseif ($this->uri->segment(3)=='Delete') {
            # code...
        }else{
            $data = [
                'menu'      => 'Co-Main/VTemplate_Menu',
                'content'   => 'Co-Primary/VUser',
                'title'     => 'Table User',
                'users'     => $this->model_app->get('tbl_user')->result()
            ];

            $data['Sub_Spinner']        = 'Co-Sub/VSpinner';
            $data['Sub_FAQ']            = 'Co-FAQ/VFAQ_Modal';

            $data['Sub_Daftar_User']    = 'Co-Sub/VUser_Daftar';
        }
		$this->load->view('Co-Main/VTemplate',$data);
    }
}

<?php
ini_set('max_execution_time', -1);
ini_set("memory_limit", "-1");
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPanel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebRegistrationModel');
		date_default_timezone_set('Asia/Dhaka');
		session_start(); 
	}
	
	public function index()
	{
		 $data = array();
         $data['header']='Krishibid';      
         $data['title']='Krishibid';
         $data['target']='index.php/AdminPanel/signin';
		 $this->load->view('Admin/Signin', $data);
	}
	
	public function dashboard()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        
        $id = $this->session->userdata('id');
        $data['id']= $this->session->userdata('id');
        $data['user_name']= $this->session->userdata('user_name');
        $data['user_password']= $this->session->userdata('user_password');
        $data['user_catagory']= $this->session->userdata('user_catagory');
        
        if(!empty($id))
        {
            $this->load->view('Admin/Dashboard',$data);
        }
        else
        {
            redirect('', 'refresh');
        }
	}
	
	public function sign_out()
	{
	    $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        
        if(empty($id))
        {
           $this->session->sess_destroy(); 
        }
        redirect('', 'refresh');
        
	}
	
	public function signin()
	{
		$data['header']='Krishibid';
		$data['title']='Krishibid';
		
		$sess_id = $this->session->userdata('id');

        if(empty($sess_id))
		{
		   // $this->session->sess_destroy();
    		$user_name = $this->input->post('user_name');
    		$user_password = $this->input->post('user_password');
    		if(isset($user_name) && isset($user_password))
    		{
    		    $table ='user_details';
        		$where = array('user_name' => $user_name ,'user_password' => $user_password , 'active_status' => '1');
        		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
        		
        		if(sizeof($result) > 0)
        		{
        		    $newdata = array(
                            'id'  => $result->id,
                            'user_name'  => $result->user_name,
                            'user_password'     => $result->user_password,
                            'user_catagory'     => $result->user_catagory
                        );
                    $this->session->set_userdata($newdata);
                    redirect('dashboard', 'refresh');
        		}
        		else
        		{
                    $data = array();
                    $data['header']='Krishibid';      
                    $data['title']='Krishibid';
                    $data['msg'] = 'User not Found';
                    $data['target']='signin';
                    $data['user_name'] = $user_name;
                    $this->load->view('Admin/Signin', $data);
        		}   
    		}
		}
		else
		{
		   redirect('dashboard', 'refresh');
		}
	}
}
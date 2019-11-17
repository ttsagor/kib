<?php
ini_set('max_execution_time', -1);
ini_set("memory_limit", "-1");
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebRegistrationModel');
	}
	public function index()
	{
		 $data = array();
         $data['header']='Krishibid';      
         $data['title']='Krishibid';
		 $this->load->view('web-registration/index', $data);
	}
	
    public function payment_instruction()
	{
		 $data = array();
         $data['header']='Krishibid';      
         $data['title']='Krishibid';
		 $this->load->view('web-registration/payment_instruction_home', $data);
	}	
	
	public function member_search()
	{
		 $data = array();
        	 $data['header']='Krishibid';      
        	 $data['title']='Krishibid';
		 $this->load->view('web-registration/member_search', $data);
	}
	
	public function member_query()
	{
		 $data = array();
    	 $data['header']='Krishibid';      
    	 $data['title']='Krishibid';
		 $this->load->view('web-registration/member_query', $data);
	}
	public function member_query_submit()
	{
        $member_id = $this->input->post('member_id');
        $member_type = $this->input->post('member_type');
        $data['member_id']=$member_id;
        $data['member_type']=$member_type;
        $msg="";
        if(isset($member_id) && $member_id!="")
        {
            $member_id = substr($member_id,0,2)."-".substr($member_id,2,2)."-".substr($member_id,4);
            $where = array('member_id' => $member_id , 'member_type' => $member_type);
            $table ='member_info';
            $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
            
            if(isset($result->application_status))
            {
                if($result->application_status=='0')
                {
                    $msg="<p>Member Id Card Registration Pending</p>"; 
                }
                else if($result->application_status=='1')
                {
                    $msg="<p>Photo Upload Pending</p>"; 
                }
                else if($result->application_status=='2')
                {
                    $msg="<p>Member ID Card payment Pending</p>"; 
                }
                else if($result->application_status=='3')
                {
                    $msg="<p>Member ID Card Registration Completed</p>"; 
                }
                
            }
            else
            {
               $msg="<p> Member Id not Found</p>"; 
            }
        }
        $data['msg']=$msg;
        $this->load->view('web-registration/member_query', $data);
	}
	
	
	public function member_search_submit()
	{
	    $data = array();
		$number = $this->input->post('number');
		$msg="";
		$data['number'] = $number;	
		if(isset($number) && $number!="")
		{
			$where = array('per_phone' => $number , 'per_mobile' => $number,'pre_phone_off' => $number , 'pre_phone_res' => $number , 'pre_mobile' => $number, 'father_name' => $number, 'mem_name' => $number);
			$table ='tbl_member';
			$result = $this->WebRegistrationModel->getdataOr('*',$where,$table);
			if(sizeof($result)>0)
			{
			    $data['data'] = $result;
			}
			/*if(isset($result->mem_no))
			{
    			
    			$data['number'] = $number;	
    			$data['member_id'] = str_replace("-","",$result->mem_no);
    			$data['mem_name'] = $result->mem_name;
    			
    			if($result->memtype_id=='1')
    			{
    				$data['member_type'] = 'General';
    			}
    			else
    			{
    				$data['member_type'] = 'Life';
    			}
			}*/
			else
			{
			    $msg = "<p style='color:red;'>Member Id not found</p>";
			}
		}
		$data['header']='Krishibid';      
		$data['title']='Krishibid';
		$data['msg']=$msg;
		
		//print_r($data['data']);
		$this->load->view('web-registration/member_search', $data);
	}
	
	public function email()
	{
	    $this->load->library("email");
          $configEmail = array(
            'useragent' => "CodeIgniter",
            'mailpath'  => "/usr/bin/sendmail", // or "/usr/sbin/sendmail"
            'protocol'  => 'smtp',
            'smtp_host' => 'URL',// URL check: http://www.yetesoft.com/free-email-marketing-resources/godaddy-pop-smtp-server-settings/,
            'smtp_port' => 465, // Usually 465
            'smtp_crypto' => 'ssl', // or tls
            'smtp_user' => 'info@kibidcard.com',
            'smtp_pass' => 'f9$-ts%~62{t',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
           );    
        
          //Load config
          $this->email->initialize($configEmail);
          $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
          $this->email->to('ttsagor@gmail.com');
          $this->email->subject("test");
          $this->email->message("test");
          $this->email->send();
        
          // See result
          echo $this->email->print_debugger();
          
	}
    
}

?>

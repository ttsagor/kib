<?php
ini_set('max_execution_time', -1);
ini_set("memory_limit", "-1");
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Dhaka');
class transactionVerify extends CI_Controller {

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
	
	public function member_txn_search()
	{
		 $data = array();
        	 $data['header']='Krishibid';      
        	 $data['title']='Krishibid';
		 $this->load->view('web-registration/transaction_verification', $data);
	}
	
	public function member_txn_submit()
	{
	    $txn = $this->input->post('txn');
	    $msg="";
	    if(isset($txn))
	    {
    	    $member_id = str_replace("-","",$this->input->post('member_id'));
    	    $member_id = substr($member_id,0,2)."-".substr($member_id,2,2)."-".substr($member_id,4);
    	    $where = array('member_id' => $member_id , 'trxId' => $txn);
    		$table ='payment_history';
    		$result = $this->WebRegistrationModel->getSingleDataOr('*',$where,$table);
    		
    		if(isset($result->member_id))
    		{
    		   $msg="Transaction No/Member Already present in Database"; 
    		}
    		else
    		{
                $where = array('member_id' => $member_id,'application_status'=>'2');
                $table ='member_info';
                $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
                
                if(isset($result->member_id))
                {
    				$new_member_id = str_replace("-","",$member_id);
    				echo $url ="https://www.bkashcluster.com:9081/dreamwave/merchant/trxcheck/sendmsg?user=KRISHIBIDINSTITUTIONBD&pass=kR!sh!@bid247&msisdn=01741112061&trxId=$txn";
    	 			$data = simplexml_load_string(file_get_contents($url));
    				if($data->transaction->trxStatus=='0000')
    				{
    					if(intval($data->transaction->amount) >= 100)	
    					{
    						$table ='member_info';
    						$where = array('member_id' => $member_id);
    						$resultMember = $this->WebRegistrationModel->getSingleData('*',$where,$table);
    $msgTexDB = "Valued Member, your Member ID Card registration (Member ID: $member_id) has been completed successfully. You will be duly informed when membership card is ready. -KIB";
    				
    						$msgTex = urlencode($msgTexDB);		
    						$targetPhone = $resultMember->mobile;		
    						$url ="http://api.infobip.com/api/sendsms/plain?user=aamkadir&password=iPhone5s@123&sender=reza&SMSText=$msgTex&GSM=88$targetPhone&datacoding=8&type=longSMS";	
    						file_get_contents($url);
    						$insertData['member_id']=$member_id;
    						$insertData['trxId']=$data->transaction->trxId;
    						$insertData['trxStatus']=$data->transaction->trxStatus;
    						$insertData['trxTimestamp']=$data->transaction->trxTimestamp;
    						$insertData['amount']=$data->transaction->amount;
    						$insertData['sender']=$data->transaction->sender;
    						$insertData['reference']=$data->transaction->reference;
    						$insertData['counter']=$data->transaction->counter;
    						$insertData['reversed']=$data->transaction->reversed;
    						$insertData['sms_text']=$msgTexDB;
    						$insertData['sms_time']= date('Y-m-d H:i:s');	
    						
    						
    						$data = array();
    						$data['application_status'] = '3';
    						$data['submission_date'] = date('Y-m-d H:i:s');
    						$where = array('member_id' => $member_id);
    						$this->WebRegistrationModel->updateDb('member_info',$where,$data);
    						$this->WebRegistrationModel->insertDb('payment_history',$insertData);
    						$msg= "<p style='color:green;'>Payment Successful and SMS has been Sent</p>";	
    						
    						
    						
    					}
    					else
    					{
    						$msg= "Paid Amount is not Sufficient";		
    					}
    				}
    				else
    				{
    					$msg="Payment Pending";
    				}	 			
    			}
                else
                {
                    $msg="Member not Registrated"; 
                }
    		}
	    }		
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['msg']=$msg;
        $data['txn']=$this->input->post('txn');
        $data['member_id']=$this->input->post('member_id');
        $this->load->view('web-registration/transaction_verification', $data);
	}
	
	public function member_search_submit()
	{
		$number = $this->input->post('number');
		if(isset($number))
		{
			$where = array('per_phone' => $number , 'per_mobile' => $number,'pre_phone_off' => $number , 'pre_phone_res' => $number , 'pre_mobile' => $number);
			$table ='tbl_member';
			$result = $this->WebRegistrationModel->getSingleDataOr('*',$where,$table);
			
			$data = array();
			$data['number'] = $number;	
			$data['member_id'] = $result->mem_no;
			
			if($result->memtype_id=='1')
			{
				$data['member_type'] = 'General';
			}
			else
			{
				$data['member_type'] = 'Life';
			}
		}
		$data['header']='Krishibid';      
		$data['title']='Krishibid';
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

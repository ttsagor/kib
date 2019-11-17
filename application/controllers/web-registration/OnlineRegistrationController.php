<?php
ini_set('max_execution_time', -1);
ini_set("memory_limit", "-1");
//error_reporting(0); 
defined('BASEPATH') OR exit('No direct script access allowed');

class OnlineRegistrationController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebRegistrationModel');
		date_default_timezone_set('Asia/Dhaka');
	}	
	public function search()
	{
		$data['header']='Krishibid';      
		$data['title']='Krishibid';
		$this->load->view('web-registration/search', $data);
	}
	public function search_view()
	{		
		
		$data = array();
		$data['header']='Krishibid';
		$data['title']='Krishibid';
		$member_type = $this->input->post('member_type');
		$member_id = $this->input->post('member_id');
		
		if (!(strpos($member_id, '-') !== false))
		{
			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
		}
		
		if(isset($member_type) && isset($member_id))
		{
			$where = array('member_id' => $member_id , 'member_type' => $member_type);
			$table ='member_info';
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			if(isset($result->member_id))
			{
				$data = array();
				$data['header']='Krishibid';      
				$data['title']='Krishibid';
				
				$table ='member_info';
				$where = array('member_id' => $member_id , 'member_type' => $member_type);
				$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
				
				
				$data['zone'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->zone,'districts')->district_en;
		
				$data['applicant_name'] = $result->applicant_name;
				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
				$data['applicant_dob']=  $result->applicant_dob;	
				$data['applicant_nid'] = $result->applicant_nid;
				$data['applicant_gender'] = $result->applicant_gender;
				$data['applicant_religion'] = $result->applicant_religion;
				$data['applicant_marital_status'] = $result->applicant_marital_status;
				$data['applicant_blood_group'] = $result->applicant_blood_group;
				$data['applicant_impairment'] = $result->applicant_impairment;
				if($data['applicant_impairment']=='yes')
				{
					$data['applicant_disabilities'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name;
				}
				$data['degree_name'] = $this->WebRegistrationModel->getSingleData('*','fact_id='.$result->degree_name,'faculty')->fact_name;
				$data['degree_subject'] = $result->degree_subject;
				$data['degree_institute'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->degree_institute,'institute')->institute_name;
				$data['degree_passing_year'] = $result->degree_passing_year;
		
		
				$data['education_level1'] = $result->education_level1;
				$data['additional_degree_name1'] = $result->additional_degree_name1;
				$data['additional_paasing_year1'] = $result->additional_paasing_year1;
				$data['additional_intitute_name1'] = $result->additional_intitute_name1;
		
				$data['education_level2'] = $result->education_level2;
				$data['additional_degree_name2'] = $result->additional_degree_name2;
				$data['additional_paasing_year2'] = $result->additional_paasing_year2;
				$data['additional_intitute_name2'] = $result->additional_intitute_name2;
		
		
		
		
				$data['applicant_profession'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_profession,'profession')->profession_name;
				$data['present_district'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->present_district,'districts')->district_en;
				$data['present_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->present_upazilla,'upazillas')->upazilla_en;
				$data['present_village'] = $result->present_village;
				$data['present_road'] = $result->present_road;
				$data['present_post_office'] = $result->present_post_office;
				$data['present_post_code'] = $result->present_post_code;
				$data['present_permanent_same'] = $result->present_permanent_same;
		
				$data['permanent_village'] = $result->permanent_village;
				$data['permanent_road'] = $result->permanent_road;
				$data['permanent_post_office'] = $result->permanent_post_office;
				$data['permanent_post_code'] = $result->permanent_post_code;
				$data['permanent_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->permanent_upazilla,'upazillas')->upazilla_en;
				$data['permanent_district'] =  $this->WebRegistrationModel->getSingleData('*','district_id='.$result->permanent_district,'districts')->district_en;
				$data['mobile'] = $result->mobile;
				$data['email'] = $result->email;
				$data['mothers_name'] = $result->mothers_name;
				$data['fathers_name'] = $result->fathers_name;
				$data['spouse_name'] = $result->spouse_name;
				$data['number_of_children'] = $result->number_of_children;
				$data['applicant_photo_path'] = $result->applicant_photo_path;
				$data['target'] = base_url().'final-submit';				
				////////////////////////////////////
		
				$this->load->view('web-registration/data-preview', $data);
			}
			else
			{
				redirect('web-registration/OnlineRegistrationController/search', 'refresh');
			}	
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/search', 'refresh');
			
		}
	}
	public function data_submit()
	{
		$data = array();
		$id = $this->session->userdata('id'); 
		$member_id= $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		$a = $this->input->post('applicant_name');
		if(isset($a))
		{
			$data['member_since']= $this->input->post('member_since_year').'-'.$this->input->post('member_since_month').'-'.$this->input->post('member_since_day');

			$data['zone'] = $this->input->post('zone');

			$data['applicant_name'] = $this->input->post('applicant_name');
			
			

			$this->WebRegistrationModel->deleteDb('childrens','member_id='.$id);
			
			$data['applicant_dob']= $this->input->post('applicant_dob_year').'-'.$this->input->post('applicant_dob_month').'-'.$this->input->post('applicant_dob_day');

			$children_names = $this->input->post('child_name');
			$child_genders = $this->input->post('child_gender');
			
			$count=0;
			if(sizeof($children_names)>0)
			{
				foreach ($children_names as $children_name)
				{
					if($children_name!='')
					{
						$child['member_id'] = $id;
						$child['name'] = $children_name;
						$child['gender'] = $child_genders[$count];			
						$this->WebRegistrationModel->insertDb('childrens',$child);
						$count++;
					}
				}
			}		
			



			$data['applicant_nid'] = $this->input->post('applicant_nid');
			$data['applicant_gender'] = $this->input->post('applicant_gender');
			$data['applicant_religion'] = $this->input->post('applicant_religion');
			$data['applicant_marital_status'] = $this->input->post('applicant_marital_status');
			$data['applicant_blood_group'] = $this->input->post('applicant_blood_group');
			$data['applicant_impairment'] = $this->input->post('applicant_impairment');
			$data['applicant_disabilities'] = $this->input->post('applicant_disabilities');
			$data['degree_name'] = $this->input->post('degree_name');
			$data['degree_subject'] = $this->input->post('degree_subject');
			$data['degree_institute'] = $this->input->post('degree_institute');
			$data['degree_passing_year'] = $this->input->post('degree_passing_year');


			$data['education_level1'] = $this->input->post('education_level1');
			$data['additional_degree_name1'] = $this->input->post('additional_degree_name1');
			$data['additional_paasing_year1'] = $this->input->post('additional_paasing_year1');
			$data['additional_intitute_name1'] = $this->input->post('additional_intitute_name1');

			$data['education_level2'] = $this->input->post('education_level2');
			$data['additional_degree_name2'] = $this->input->post('additional_degree_name2');
			$data['additional_paasing_year2'] = $this->input->post('additional_paasing_year2');
			$data['additional_intitute_name2'] = $this->input->post('additional_intitute_name2');




			$data['applicant_profession'] = $this->input->post('applicant_profession');

			$data['present_district'] = $this->input->post('present_district');
			$data['present_upazilla'] = $this->input->post('present_upazilla');
			$data['present_village'] = $this->input->post('present_village');
			$data['present_road'] = $this->input->post('present_road');
			$data['present_post_office'] = $this->input->post('present_post_office');
			$data['present_post_code'] = $this->input->post('present_post_code');
			$data['present_permanent_same'] = $this->input->post('present_permanent_same');

			if(isset($_POST['present_permanent_same']))
			{
				$data['present_permanent_same'] = '1';
				$data['permanent_village'] = $this->input->post('present_village');
				$data['permanent_road'] = $this->input->post('present_road');
				$data['permanent_post_office'] = $this->input->post('present_post_office');
				$data['permanent_post_code'] = $this->input->post('present_post_code');
				$data['permanent_upazilla'] = $this->input->post('present_upazilla');
				$data['permanent_district'] = $this->input->post('present_district');
			}
			else
			{
				$data['present_permanent_same'] = '0';
				$data['permanent_village'] = $this->input->post('permanent_village');
				$data['permanent_road'] = $this->input->post('permanent_road');
				$data['permanent_post_office'] = $this->input->post('permanent_post_office');
				$data['permanent_post_code'] = $this->input->post('permanent_post_code');
				$data['permanent_upazilla'] = $this->input->post('permanent_upazilla');
				$data['permanent_district'] = $this->input->post('permanent_district');
			}
			$data['mobile'] = $this->input->post('mobile');
			$data['email'] = $this->input->post('email');
			$data['mothers_name'] = $this->input->post('mothers_name');
			$data['fathers_name'] = $this->input->post('fathers_name');
			$data['spouse_name'] = $this->input->post('spouse_name');
			$data['number_of_children'] = $this->input->post('number_of_children');
			
			
			$tableTemplate ='member_info';
			$whereTemplate = array('member_id' => $member_id , 'member_type' => $member_type);
			$resultTemplate = $this->WebRegistrationModel->getSingleData('*',$whereTemplate,$tableTemplate);
				
			if(isset($resultTemplate->application_status) && $resultTemplate->application_status=='0')
			{
			    $data['application_status'] = '1';
			}	
			
			$where = array('member_id' => $member_id , 'member_type' => $member_type);
			$result = $this->WebRegistrationModel->updateDb('member_info',$where,$data);
			
			
			$table ='member_info';
			$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);	
			$data['applicant_photo_path'] = $result->applicant_photo_path;
			
			
			
			$data['target'] = base_url().'data-preview';
			$this->load->view('web-registration/photo-upload', $data);
		}
		else
		{
			$data = array();
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$this->load->view('web-registration/index', $data);
		}

		
	}
	
	
	
	public function upload_photo()
	{		
		$id = $this->session->userdata('id'); 
		$member_id= $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');		
		
		if(isset($id))
		{
			$upPath='member_photo/';
			
			$config = array(
			'upload_path' => $upPath,
			'allowed_types' => "*",
			'overwrite' => TRUE,
			'max_size' => "2048000", 
			'max_height' => "7680",
			'max_width' => "10240",
			'file_name' => $id.".png"
			);
			
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('member_pic'))
			{ 
				$data['imageError'] =  $this->upload->display_errors();
				print_r($data);

			}
			else
			{
				$imageDetailArray = $this->upload->data();
				$image =  $imageDetailArray['file_name'];
				$data = array();
				$data['application_status'] = '2';
				$data['applicant_photo_path'] = 'member_photo/'.$id.".png";
				$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
				$result = $this->WebRegistrationModel->updateDb('member_info',$where,$data);	
				redirect('preview-info', 'refresh');	
				
			}
			
			
		}
		else
		{
			$data = array();
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$this->load->view('web-registration/index', $data);
		}
	}
	
	public function preview_page()
	{
		$id = $this->session->userdata('id'); 
		$member_id= $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		
		$data = array();
		$data['header']='Krishibid';      
		$data['title']='Krishibid';
		
		$table ='member_info';
		$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);


		$data['member_id']= $this->session->userdata('member_id');
		$data['member_type']= $this->session->userdata('member_type');
		$data['member_since']=  $result->member_since;		
		
		$data['zone'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->zone,'districts')->district_en;

		$data['applicant_name'] = $result->applicant_name;
		$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
		$data['applicant_dob']=  $result->applicant_dob;	
		$data['applicant_nid'] = $result->applicant_nid;
		$data['applicant_gender'] = $result->applicant_gender;
		$data['applicant_religion'] = $result->applicant_religion;
		$data['applicant_marital_status'] = $result->applicant_marital_status;
		$data['applicant_blood_group'] = $result->applicant_blood_group;
		$data['applicant_impairment'] = $result->applicant_impairment;
		if($data['applicant_impairment']=='yes')
		{
			$data['applicant_disabilities'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name;
		}
		$data['degree_name'] = $this->WebRegistrationModel->getSingleData('*','fact_id='.$result->degree_name,'faculty')->fact_name;
		$data['degree_subject'] = $result->degree_subject;
		$data['degree_institute'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->degree_institute,'institute')->institute_name;
		$data['degree_passing_year'] = $result->degree_passing_year;


		$data['education_level1'] = $result->education_level1;
		$data['additional_degree_name1'] = $result->additional_degree_name1;
		$data['additional_paasing_year1'] = $result->additional_paasing_year1;
		$data['additional_intitute_name1'] = $result->additional_intitute_name1;

		$data['education_level2'] = $result->education_level2;
		$data['additional_degree_name2'] = $result->additional_degree_name2;
		$data['additional_paasing_year2'] = $result->additional_paasing_year2;
		$data['additional_intitute_name2'] = $result->additional_intitute_name2;




		$data['applicant_profession'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_profession,'profession')->profession_name;
		$data['present_district'] = $this->WebRegistrationModel->getSingleData('*','district_id='.$result->present_district,'districts')->district_en;
		$data['present_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->present_upazilla,'upazillas')->upazilla_en;
		$data['present_village'] = $result->present_village;
		$data['present_road'] = $result->present_road;
		$data['present_post_office'] = $result->present_post_office;
		$data['present_post_code'] = $result->present_post_code;
		$data['present_permanent_same'] = $result->present_permanent_same;

		$data['permanent_village'] = $result->permanent_village;
		$data['permanent_road'] = $result->permanent_road;
		$data['permanent_post_office'] = $result->permanent_post_office;
		$data['permanent_post_code'] = $result->permanent_post_code;
		$data['permanent_upazilla'] = $this->WebRegistrationModel->getSingleData('*','upazilla_id='.$result->permanent_upazilla,'upazillas')->upazilla_en;
		$data['permanent_district'] =  $this->WebRegistrationModel->getSingleData('*','district_id='.$result->permanent_district,'districts')->district_en;
		$data['mobile'] = $result->mobile;
		$data['email'] = $result->email;
		$data['mothers_name'] = $result->mothers_name;
		$data['fathers_name'] = $result->fathers_name;
		$data['spouse_name'] = $result->spouse_name;
		$data['number_of_children'] = $result->number_of_children;
		$data['applicant_photo_path'] = $result->applicant_photo_path;
		$data['target'] = base_url().'final-submit';				
		////////////////////////////////////

		$this->load->view('web-registration/data-preview', $data);
	}
	
	
	public function final_submit()
	{
		$id = $this->session->userdata('id'); 
		$member_id = $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		if(isset($id))
		{
			$data = array();		
			$table ='payment_history';
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			if(isset($result->id))
			{	
			    if($result->trxId=='manual')
			    {
			        $data = array();
					$data['application_status'] = '3';
					$data['submission_date'] = date('Y-m-d H:i:s');
					$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
					$this->WebRegistrationModel->updateDb('member_info',$where,$data);
					redirect('web-registration/OnlineRegistrationController/sucess_page', 'refresh');
			    }
			    else
			    {
				    redirect('web-registration/OnlineRegistrationController/already_paid', 'refresh');
			    }
			}
			else
			{
				$new_member_id = str_replace("-","",$member_id);
				$url ="https://www.bkashcluster.com:9081/dreamwave/merchant/trxcheck/refmsg?user=KRISHIBIDINSTITUTIONBD&pass=kR!sh!@bid247&msisdn=01741112061&reference=$new_member_id";
	 			$data = simplexml_load_string(file_get_contents($url));
				if($data->transaction->trxStatus=='0000')
				{
					if(intval($data->transaction->amount) >= 100)	
					{
						$table ='member_info';
						$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
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
						$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
						$this->WebRegistrationModel->updateDb('member_info',$where,$data);
						$this->WebRegistrationModel->insertDb('payment_history',$insertData);
						redirect('web-registration/OnlineRegistrationController/sucess_page', 'refresh');
						
						
						
					}
					else
					{
						echo "Paid Amount is not Sufficient";		
					}
				}
				else
				{
					redirect('web-registration/OnlineRegistrationController/pending_payment', 'refresh');
				}	 			
			}
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}
		
	}
	
	public function pending_payment()
	{
		$id = $this->session->userdata('id'); 
		$member_id = $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		
		
		if(isset($id))
		{
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$data['member_id'] = str_replace("-","",$member_id);
			$this->load->view('web-registration/payment_instruction', $data);
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}
	}
	
	public function already_paid()
	{
		$id = $this->session->userdata('id'); 
		$member_id = $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		if(isset($id))
		{
			$this->session->sess_destroy();	
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$this->load->view('web-registration/already_paid', $data);
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}
	}
	
	public function sucess_page()
	{
		$id = $this->session->userdata('id'); 
		$member_id = $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		if(isset($id))
		{
			$this->session->sess_destroy();	
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$this->load->view('web-registration/signup_sucess', $data);
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}
	}
	
	public function index()
	{
		$data = array();
		$data['header']='Krishibid';      
		$data['title']='Krishibid';
		$this->load->view('web-registration/index', $data);
	}
	
	public function preview_completed()
	{
		$id = $this->session->userdata('id'); 
		$member_id = $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		if(isset($id))
		{
			$this->session->sess_destroy();	
			$data['header']='Krishibid';      
			$data['title']='Krishibid';
			$this->load->view('web-registration/already_confirmed', $data);
		}
		else
		{
			redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}
	}
	
	public function memberInfo()
	{
        $data = array();
        $data['header']='Krishibid';
        $data['title']='Krishibid';
        $member_type = $this->input->post('member_type');
        $member_id = $this->input->post('member_id');
		
		if (!(strpos($member_id, '-') !== false))
		{
			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
		}

        if(isset($member_type) && isset($member_id))
		{
            $where = array('member_id' => $member_id , 'member_type' => $member_type);
            $table ='member_info';
            $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
            if(isset($result->member_id))
			{
                $newdata = array(
                    'id'  => $result->id,
                    'member_id'  => $result->member_id,
                    'member_type'     => $result->member_type
                );
                $this->session->set_userdata($newdata);
                $data['member_id']= $this->session->userdata('member_id');
                $data['member_type']= $this->session->userdata('member_type');
                
                if($result->application_status=='3')
                {
					$data = array();
	                $data['header']='Krishibid';
	                $data['title']='Krishibid';
	                $data['member_id']=$member_id;
	                $data['member_type']=$member_type;
	                $data['msg']='Member Already Registrated';
	                $this->load->view('web-registration/index', $data);
	                
                }
				else 
				{
                    $member_since = explode("-",$result->member_since);				
    				if($member_since[2]=='00')
    				{
    					$data['member_since_day']= '';
    				}
    				else
    				{
    					$data['member_since_day']= $member_since[2];
    				}
    				
    				if($member_since[0]=='0000')
    				{
    					$data['member_since_year']= '';
    				}
    				else
    				{
    					$data['member_since_year']= $member_since[0];
    				}
                    $data['member_since_month']= $member_since[1];
                    $data['zone'] = $result->zone;
                    $data['applicant_name'] = $result->applicant_name;
                    $data['zones'] = $this->WebRegistrationModel->getdataOderBy('*','1=1','districts','district_en');
                    $data['upazillas'] = $this->WebRegistrationModel->getdata('*','1=1','upazillas');
                    $data['faculties'] = $this->WebRegistrationModel->getdata('*','1=1','faculty');
                    $data['institutes'] = $this->WebRegistrationModel->getdata('*','1=1','institute');
                    $data['professions'] = $this->WebRegistrationModel->getdata('*','1=1','profession');
    				$data['physical_disabilities'] = $this->WebRegistrationModel->getdata('*','1=1','physical_disabilities');
    				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
                    $applicant_dob = explode("-",$result->applicant_dob);
    				$data['applicant_dob_month']= $applicant_dob[1];
    				if($applicant_dob[2]=='00')
    				{
    					$data['applicant_dob_day']= '';
    				}
    				else
    				{
    					$data['applicant_dob_day']= $applicant_dob[2];
    				}
    				
    				if($applicant_dob[0]=='0000')
    				{
    					$data['applicant_dob_year']= '';
    				}
    				else
    				{
    					$data['applicant_dob_year']= $applicant_dob[0];
    				}
    
                    $data['applicant_nid'] = $result->applicant_nid;
                    $data['applicant_gender'] = $result->applicant_gender;
                    $data['applicant_religion'] = $result->applicant_religion;
                    $data['applicant_marital_status'] = $result->applicant_marital_status;
                    $data['applicant_blood_group'] = $result->applicant_blood_group;
                    $data['applicant_impairment'] = $result->applicant_impairment;
                    $data['applicant_disabilities'] = $result->applicant_disabilities;
                    $data['degree_name'] = $result->degree_name;
                    $data['degree_subject'] = $result->degree_subject;
                    $data['degree_institute'] = $result->degree_institute;
                    $data['degree_passing_year'] = $result->degree_passing_year;
                    
                    
                    $data['education_level1'] = $result->education_level1;
                    $data['additional_degree_name1'] = $result->additional_degree_name1;
                    $data['additional_paasing_year1'] = $result->additional_paasing_year1;
                    $data['additional_intitute_name1'] = $result->additional_intitute_name1;
                    
                    $data['education_level2'] = $result->education_level2;
                    $data['additional_degree_name2'] = $result->additional_degree_name2;
                    $data['additional_paasing_year2'] = $result->additional_paasing_year2;
                    $data['additional_intitute_name2'] = $result->additional_intitute_name2;
                    
                    
                    
                    
                    $data['applicant_profession'] = $result->applicant_profession;
                    $data['present_district'] = $result->present_district;
                    $data['present_upazilla'] = $result->present_upazilla;
                    $data['present_village'] = $result->present_village;
                    $data['present_road'] = $result->present_road;
                    $data['present_post_office'] = $result->present_post_office;
                    $data['present_post_code'] = $result->present_post_code;
                    $data['present_permanent_same'] = $result->present_permanent_same;
    
                    $data['permanent_village'] = $result->permanent_village;
                    $data['permanent_road'] = $result->permanent_road;
                    $data['permanent_post_office'] = $result->permanent_post_office;
                    $data['permanent_post_code'] = $result->permanent_post_code;
                    $data['permanent_upazilla'] = $result->permanent_upazilla;
                    $data['permanent_district'] = $result->permanent_district;
                    $data['mobile'] = $result->mobile;
                    $data['email'] = $result->email;
                    $data['mothers_name'] = $result->mothers_name;
                    $data['fathers_name'] = $result->fathers_name;
                    $data['spouse_name'] = $result->spouse_name;
                    $data['number_of_children'] = $result->number_of_children;
    				$data['target'] = base_url().'data-submit';
                    $this->load->view('web-registration/registration', $data);
				}
			}
			else
			{
			    $where = array('member_id' => $member_id);
                $table ='member_info';
                $result1 = $this->WebRegistrationModel->getSingleData('*',$where,$table);
                if(sizeof($result1)==0)
                {
    			    $member_type_new = '1';
    			    if($member_type=='life')
    			    {
    			        $member_type_new = '2';
    			    }
    			    $where = array('mem_id' => $member_id , 'memtype_id' => $member_type_new);
                    $table ='tbl_member';
                    $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
                    if(isset($result->mem_id))
        			{
        			    $insertData['member_id'] = $member_id;
                        $insertData['member_type'] = $member_type;		
                        $this->WebRegistrationModel->insertDb('member_info',$insertData);
                        
                        $where = array('member_id' => $member_id , 'member_type' => $member_type);
                        $table ='member_info';
                        $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
                        if(isset($result->member_id))
            			{
                            $newdata = array(
                                'id'  => $result->id,
                                'member_id'  => $result->member_id,
                                'member_type'     => $result->member_type
                            );
                            $this->session->set_userdata($newdata);
                            $data['member_id']= $this->session->userdata('member_id');
                            $data['member_type']= $this->session->userdata('member_type');
                            
                            if($result->application_status=='3')
                            {
            					$data = array();
            	                $data['header']='Krishibid';
            	                $data['title']='Krishibid';
            	                $data['member_id']=$member_id;
            	                $data['member_type']=$member_type;
            	                $data['msg']='Member Already Registrated';
            	                $this->load->view('web-registration/index', $data);
            	                
                            }
            				else 
            				{
                                $member_since = explode("-",$result->member_since);				
                				if($member_since[2]=='00')
                				{
                					$data['member_since_day']= '';
                				}
                				else
                				{
                					$data['member_since_day']= $member_since[2];
                				}
                				
                				if($member_since[0]=='0000')
                				{
                					$data['member_since_year']= '';
                				}
                				else
                				{
                					$data['member_since_year']= $member_since[0];
                				}
                                $data['member_since_month']= $member_since[1];
                                $data['zone'] = $result->zone;
                                $data['applicant_name'] = $result->applicant_name;
                                $data['zones'] = $this->WebRegistrationModel->getdataOderBy('*','1=1','districts','district_en');
                                $data['upazillas'] = $this->WebRegistrationModel->getdata('*','1=1','upazillas');
                                $data['faculties'] = $this->WebRegistrationModel->getdata('*','1=1','faculty');
                                $data['institutes'] = $this->WebRegistrationModel->getdata('*','1=1','institute');
                                $data['professions'] = $this->WebRegistrationModel->getdata('*','1=1','profession');
                				$data['physical_disabilities'] = $this->WebRegistrationModel->getdata('*','1=1','physical_disabilities');
                				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');
                                $applicant_dob = explode("-",$result->applicant_dob);
                				$data['applicant_dob_month']= $applicant_dob[1];
                				if($applicant_dob[2]=='00')
                				{
                					$data['applicant_dob_day']= '';
                				}
                				else
                				{
                					$data['applicant_dob_day']= $applicant_dob[2];
                				}
                				
                				if($applicant_dob[0]=='0000')
                				{
                					$data['applicant_dob_year']= '';
                				}
                				else
                				{
                					$data['applicant_dob_year']= $applicant_dob[0];
                				}
                
                                $data['applicant_nid'] = $result->applicant_nid;
                                $data['applicant_gender'] = $result->applicant_gender;
                                $data['applicant_religion'] = $result->applicant_religion;
                                $data['applicant_marital_status'] = $result->applicant_marital_status;
                                $data['applicant_blood_group'] = $result->applicant_blood_group;
                                $data['applicant_impairment'] = $result->applicant_impairment;
                                $data['applicant_disabilities'] = $result->applicant_disabilities;
                                $data['degree_name'] = $result->degree_name;
                                $data['degree_subject'] = $result->degree_subject;
                                $data['degree_institute'] = $result->degree_institute;
                                $data['degree_passing_year'] = $result->degree_passing_year;
                                
                                
                                $data['education_level1'] = $result->education_level1;
                                $data['additional_degree_name1'] = $result->additional_degree_name1;
                                $data['additional_paasing_year1'] = $result->additional_paasing_year1;
                                $data['additional_intitute_name1'] = $result->additional_intitute_name1;
                                
                                $data['education_level2'] = $result->education_level2;
                                $data['additional_degree_name2'] = $result->additional_degree_name2;
                                $data['additional_paasing_year2'] = $result->additional_paasing_year2;
                                $data['additional_intitute_name2'] = $result->additional_intitute_name2;
                                
                                
                                
                                
                                $data['applicant_profession'] = $result->applicant_profession;
                                $data['present_district'] = $result->present_district;
                                $data['present_upazilla'] = $result->present_upazilla;
                                $data['present_village'] = $result->present_village;
                                $data['present_road'] = $result->present_road;
                                $data['present_post_office'] = $result->present_post_office;
                                $data['present_post_code'] = $result->present_post_code;
                                $data['present_permanent_same'] = $result->present_permanent_same;
                
                                $data['permanent_village'] = $result->permanent_village;
                                $data['permanent_road'] = $result->permanent_road;
                                $data['permanent_post_office'] = $result->permanent_post_office;
                                $data['permanent_post_code'] = $result->permanent_post_code;
                                $data['permanent_upazilla'] = $result->permanent_upazilla;
                                $data['permanent_district'] = $result->permanent_district;
                                $data['mobile'] = $result->mobile;
                                $data['email'] = $result->email;
                                $data['mothers_name'] = $result->mothers_name;
                                $data['fathers_name'] = $result->fathers_name;
                                $data['spouse_name'] = $result->spouse_name;
                                $data['number_of_children'] = $result->number_of_children;
                				$data['target'] = base_url().'data-submit';
                                $this->load->view('web-registration/registration', $data);
            				}
            			}
            			else
            			{
            			    $data = array();
                            $data['header']='Krishibid';
                            $data['title']='Krishibid';
                            $data['member_id']=$member_id;
                            $data['member_type']=$member_type;
                            $data['msg']='No Member Found';
                            $this->load->view('web-registration/index', $data);
            			}
        			}
        			else
        			{
                        $data = array();
                        $data['header']='Krishibid';
                        $data['title']='Krishibid';
                        $data['member_id']=$member_id;
                        $data['member_type']=$member_type;
                        $data['msg']='No Member Found';
                        $this->load->view('web-registration/index', $data);
        			}
                }
                else
    			{
                    $data = array();
                    $data['header']='Krishibid';
                    $data['title']='Krishibid';
                    $data['member_id']=$member_id;
                    $data['member_type']=$member_type;
                    $data['msg']='No Member Found';
                    $this->load->view('web-registration/index', $data);
    			}
			}
		}
		else
		{
            redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}

	}
	
	public function memberInfoBackImg()
	{
		$data['header']='Krishibid';
		$data['title']='Krishibid';
		
		$id = $this->session->userdata('id'); 
		$member_id= $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');	
		
		$table ='member_info';
		$where = array('id' => $id ,'member_id' => $member_id , 'member_type' => $member_type);
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);	
		$data['applicant_photo_path'] = $result->applicant_photo_path;
		
		$data['target'] = base_url().'data-preview';
		$this->load->view('web-registration/photo-upload', $data);
	}
	
	public function memberInfoBack()
	{
        $data = array();
        $data['header']='Krishibid';
        $data['title']='Krishibid';
		
		$member_id= $this->session->userdata('member_id');
		$member_type= $this->session->userdata('member_type');
		
		if (!(strpos($member_id, '-') !== false))
		{
			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
		}

        if(isset($member_type) && isset($member_id))
		{
            $where = array('member_id' => $member_id , 'member_type' => $member_type);
            $table ='member_info';
            $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
            if(isset($result->member_id))
			{
                $newdata = array(
                    'id'  => $result->id,
                    'member_id'  => $result->member_id,
                    'member_type'     => $result->member_type
                );
                $this->session->set_userdata($newdata);
                $data['member_id']= $this->session->userdata('member_id');
                $data['member_type']= $this->session->userdata('member_type');

                $member_since = explode("-",$result->member_since);
				
				if($member_since[2]=='00')
				{
					$data['member_since_day']= '';
				}
				else
				{
					$data['member_since_day']= $member_since[2];
				}
				
				if($member_since[0]=='0000')
				{
					$data['member_since_year']= '';
				}
				else
				{
					$data['member_since_year']= $member_since[0];
				}
				
                
                $data['member_since_month']= $member_since[1];
                

                $data['zone'] = $result->zone;

                $data['applicant_name'] = $result->applicant_name;
                $data['zones'] = $this->WebRegistrationModel->getdata('*','1=1','districts');
                $data['upazillas'] = $this->WebRegistrationModel->getdata('*','1=1','upazillas');
                $data['faculties'] = $this->WebRegistrationModel->getdata('*','1=1','faculty');
                $data['institutes'] = $this->WebRegistrationModel->getdata('*','1=1','institute');
                $data['professions'] = $this->WebRegistrationModel->getdata('*','1=1','profession');
				$data['physical_disabilities'] = $this->WebRegistrationModel->getdata('*','1=1','physical_disabilities');
				$data['childrens'] = $this->WebRegistrationModel->getdata('*','member_id='.$result->id,'childrens');


                $applicant_dob = explode("-",$result->applicant_dob);
				$data['applicant_dob_month']= $applicant_dob[1];
				if($applicant_dob[2]=='00')
				{
					$data['applicant_dob_day']= '';
				}
				else
				{
					$data['applicant_dob_day']= $applicant_dob[2];
				}
				
				if($applicant_dob[0]=='0000')
				{
					$data['applicant_dob_year']= '';
				}
				else
				{
					$data['applicant_dob_year']= $applicant_dob[0];
				}

                $data['applicant_nid'] = $result->applicant_nid;
                $data['applicant_gender'] = $result->applicant_gender;
                $data['applicant_religion'] = $result->applicant_religion;
                $data['applicant_marital_status'] = $result->applicant_marital_status;
                $data['applicant_blood_group'] = $result->applicant_blood_group;
                $data['applicant_impairment'] = $result->applicant_impairment;
                $data['applicant_disabilities'] = $result->applicant_disabilities;
                $data['degree_name'] = $result->degree_name;
                $data['degree_subject'] = $result->degree_subject;
                $data['degree_institute'] = $result->degree_institute;
                $data['degree_passing_year'] = $result->degree_passing_year;
                
                
                $data['education_level1'] = $result->education_level1;
                $data['additional_degree_name1'] = $result->additional_degree_name1;
                $data['additional_paasing_year1'] = $result->additional_paasing_year1;
                $data['additional_intitute_name1'] = $result->additional_intitute_name1;
                
                $data['education_level2'] = $result->education_level2;
                $data['additional_degree_name2'] = $result->additional_degree_name2;
                $data['additional_paasing_year2'] = $result->additional_paasing_year2;
                $data['additional_intitute_name2'] = $result->additional_intitute_name2;
                
                
                
                
                $data['applicant_profession'] = $result->applicant_profession;
                $data['present_district'] = $result->present_district;
                $data['present_upazilla'] = $result->present_upazilla;
                $data['present_village'] = $result->present_village;
                $data['present_road'] = $result->present_road;
                $data['present_post_office'] = $result->present_post_office;
                $data['present_post_code'] = $result->present_post_code;
                $data['present_permanent_same'] = $result->present_permanent_same;

                $data['permanent_village'] = $result->permanent_village;
                $data['permanent_road'] = $result->permanent_road;
                $data['permanent_post_office'] = $result->permanent_post_office;
                $data['permanent_post_code'] = $result->permanent_post_code;
                $data['permanent_upazilla'] = $result->permanent_upazilla;
                $data['permanent_district'] = $result->permanent_district;
                $data['mobile'] = $result->mobile;
                $data['email'] = $result->email;
                $data['mothers_name'] = $result->mothers_name;
                $data['fathers_name'] = $result->fathers_name;
                $data['spouse_name'] = $result->spouse_name;
                $data['number_of_children'] = $result->number_of_children;
				$data['target'] = base_url().'data-submit';
                $this->load->view('web-registration/registration', $data);
			}
			else
			{
                $data = array();
                $data['header']='Krishibid';
                $data['title']='Krishibid';
                $data['member_id']=$member_id;
                $data['member_type']=$member_type;
                $data['msg']='No Member Found';
                $this->load->view('web-registration/index', $data);
			}
		}
		else
		{
            redirect('web-registration/OnlineRegistrationController/index', 'refresh');
		}

	}
}

?>

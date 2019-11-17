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
		 $this->load->view('Signin', $data);
	}
	
	
	public function admin_search()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['target']='index.php/admin_search';
        $member_id = $this->input->post('member_id');
        
        if(isset($member_id))
        {
            if (!(strpos($member_id, '-') !== false))
    		{
    			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
    		}
        }
		
		$data['member_id']=$member_id;
		
        $where = array('member_id' => $member_id);
		$table ='member_info';
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
		
		if(isset($result->member_id) && $result->application_status > 0)
		{
		    if($result->application_status=='1')
		    {
		        $data['form_status'] = 'Only form filled up';
		    }
		    else if($result->application_status=='2')
		    {
		        $data['form_status'] = 'Form filled up & Photo uploaded';
		    }
		    else if($result->application_status=='3')
		    {
		        $data['form_status'] = 'Registration complete';
		    }
		    else
		    {
		        $data['form_status'] = 'Not Registration';
		    }
		    
		    
		    if($result->approve_status=='1')
		    {
		        $data['approve_status'] ='Approved';
		    }
		    else
		    {
		        $data['approve_status'] ='Rejected';
		    }
		    
		    
		    
		    
		    $data['member_type'] =  $result->member_type;
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
		}
        
        
        //print_r($data);
        $this->load->view('SearchMember', $data);
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
            $this->load->view('Dashboard',$data);
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
                    $this->load->view('Signin', $data);
        		}   
    		}
		}
		else
		{
		   redirect('dashboard', 'refresh');
		}
	}
	
	public function member_details()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $member_id = $this->input->get('id');
        
        
        if(isset($member_id))
		{
			$where = array('member_id' => $member_id);
			$table ='member_info';
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			if(isset($result->member_id))
			{
				$data = array();
				$data['header']='Krishibid';      
				$data['title']='Krishibid';
				
				$table ='member_info';
				$where = array('member_id' => $member_id);
				$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
				
				$data['member_id'] =  $result->member_id;
				$data['member_type'] =  $result->member_type;
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
		
				$this->load->view('data-preview', $data);
			}
			else
			{
				redirect('dashboard', 'refresh');
			}	
		}
		else
		{
			redirect('dashboard', 'refresh');
			
		}
        
       // $this->load->view('data-preview', $data);
	}
	
	public function member_edit()
	{
	    $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $member_id = $this->input->get('id');
		
		if (!(strpos($member_id, '-') !== false))
		{
			$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
		}

        if(isset($member_id))
		{
            $where = array('member_id' => $member_id);
            $table ='member_info';
            $result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
            if(isset($result->member_id))
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
				$data['member_id']=  $result->member_id;
                $data['member_type']=  $result->member_type;
                
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
				$data['target'] = base_url().'index.php/submit';
                $this->load->view('registration', $data);
			
			}
		}
		else
		{
            redirect('', 'refresh');
		}
	}
	

	public function data_submit()
	{
	    $data = array();
		$member_id= $this->input->post('member_id');
		$member_type= $this->input->post('member_type');
		$a = $this->input->post('applicant_name');
		
		$table ='member_info';
		$where = array('member_id' => $member_id);
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
		$id = $result->id;
		
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
			


            $data['member_type'] = $this->input->post('member_type');
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
			$whereTemplate = array('member_id' => $member_id);
			$resultTemplate = $this->WebRegistrationModel->getSingleData('*',$whereTemplate,$tableTemplate);
			
			
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->updateDb('member_info',$where,$data);
			
			
			$table ='member_info';
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);	
			
			echo "<script>window.close();</script>";
			
			
		}
		else
		{
			redirect('', 'refresh');
		}
	}
	
	public function approve_member()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['page']='approve';
        $member_id = $this->input->get('member_id');
        if(isset($member_id))
        {
            $data['page']= $this->input->get('page');
        }
        else
        {
            $member_id = $this->input->post('member_id');
        }
		
		if(isset($member_id))
		{
		    if (!(strpos($member_id, '-') !== false))
            {
            	$member_id = substr($member_id ,0,2).'-'.substr($member_id ,2,2).'-'.substr($member_id ,4);
            }  
            $where = array('member_id' => $member_id,'application_status' => '3');
		}
		else
		{
		   $where = array('application_status' => '3','approve_status' => '0'); 
		}
		
		$table ='member_info';
		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
		
		if(isset($result->member_id))
		{
			//$data = array();
			//$data['header']='Krishibid';      
			//$data['title']='Krishibid';
			
			$table ='member_info';
			$member_id =  $result->member_id;
			$where = array('member_id' => $member_id);
			$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
			
			$data['id'] = $result->id;
			$data['member_id'] =  $result->member_id;
			$data['member_type'] =  $result->member_type;
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
			    if(isset($this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name))
				{
				    $data['applicant_disabilities'] = $this->WebRegistrationModel->getSingleData('*','id='.$result->applicant_disabilities,'physical_disabilities')->disabilities_name;
				}
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
			$data['submission_date'] = $result->submission_date;				
			////////////////////////////////////
			
			$where = array('mem_no' => $member_id);
    		$table ='tbl_member';
    		$result = $this->WebRegistrationModel->getSingleData('*',$where,$table);
    		
    		if(isset($result->mem_no))
    		{
                $data['old_mem_no'] = $result->mem_no;
                $data['old_mem_name'] = $result->mem_name;
                $data['old_father_name'] = $result->father_name;
                $data['old_mother_name'] = $result->mother_name;
                $data['old_hus_name'] = $result->hus_name;
                $data['old_dob'] = $result->dob;
                $data['old_mem_graduate'] = $result->mem_graduate;
                $data['old_gr_unv'] = $result->gr_unv;
                $data['old_gr_year'] = $result->gr_year;
                
                $data['old_per_dist_id'] = $result->per_dist_id;
                $dis = $this->WebRegistrationModel->getSingleData('*','dist_id='.$result->per_dist_id,'tbl_district');
                
                if(isset($dis->dist_name))
				{
				    $data['old_per_dist_id'] = $dis->dist_name;
				}
				
				$data['old_per_upz_id'] = $result->per_upz_id;
				$dis = $this->WebRegistrationModel->getSingleData('*','dist_id='.$result->per_dist_id." AND upz_id=".$result->per_upz_id,'tbl_upazilla');
                if(isset($dis->upz_name))
				{
				    $data['old_per_upz_id'] = $dis->upz_name;
				}
				
				if($data['old_per_upz_id']=='0'){$data['old_per_upz_id']='N/A';}
				if($data['old_per_dist_id']=='0'){$data['old_per_dist_id']='N/A';}
                
                $data['old_per_post_off'] = $result->per_post_off;
                $data['old_per_addr'] = $result->per_addr;
                
    		}
	        ////////////////
	        
            $where = array('application_status' => '3','approve_status' => '0'); 
            $table ='member_info';
            $result1 = $this->WebRegistrationModel->getdata('*',$where,$table);
            $data['pending_data'] = sizeof($result1);
                
            $this->load->view('Approval', $data);
		}
		else
		{
		    $data['member_id']=$member_id;
		    $data['msg'] = 'Member not Registrated';
		    $this->load->view('Approval', $data);
		}
       
	}
	
	public function approve_member_individual()
	{
	    $id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');
        $user_password = $this->session->userdata('user_password');
        $user_catagory = $this->session->userdata('user_catagory');
        
        $data = array();
		$data['approve_status'] = '1';
		$data['approve_by'] = $id;
		$data['approve_date'] = date('Y-m-d H:i:s');
		
		$mid = $this->input->get('id');
		$member_id = $this->input->get('member_id');
		$page = $this->input->get('page');
		
        $where = array('id' => $mid ,'member_id' => $member_id);
		$this->WebRegistrationModel->updateDb('member_info',$where,$data);
		
		if($page==''){
		    echo "<script>window.close();</script>";
		}
	    else{
	        redirect($page, 'refresh');
	    }
	}
	public function reject_member_individual()
	{
	    $id = $this->session->userdata('id');
        $user_name = $this->session->userdata('user_name');
        $user_password = $this->session->userdata('user_password');
        $user_catagory = $this->session->userdata('user_catagory');
        
        $data = array();
		$data['approve_status'] = '2';
		$data['approve_by'] = $id;
		$data['approve_date'] = date('Y-m-d H:i:s');
		
		$mid = $this->input->get('id');
		$member_id = $this->input->get('member_id');
		$page = $this->input->get('page');
		
        $where = array('id' => $mid ,'member_id' => $member_id);
		$this->WebRegistrationModel->updateDb('member_info',$where,$data);
		
	    if($page==''){
		    echo "<script>window.close();</script>";
		}
	    else{
	        redirect($page, 'refresh');
	    }
	}
	
	public function reject_list()
	{
        $data = array();
        $data['header']='Krishibid';      
        $data['title']='Krishibid';
        $data['target']='index.php/AdminPanel/signin';
        
        $where = array('approve_status' => '2'); 
        $table ='member_info';
        $result = $this->WebRegistrationModel->getdata('*',$where,$table);
        $data['members'] = $result;
        $data['members_size'] = sizeof($result);
            
		$this->load->view('RejectList', $data);
	}
	
}
<?php
include_once 'auto_sms.php';
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class User_Management extends auto_sms {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
public function change_password(){
	$this -> load -> view("ajax_view/change_password");
}
////////////////////////////
	public function index() {
		
 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
 $this->output->set_header("Pragma: no-cache");
		$data = array();
		$data['title'] = "Login";
		$this -> load -> view("login_v", $data);
	}



	public function login() {
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
 $this->output->set_header("Pragma: no-cache");
		$data = array(	);
		$data['title'] = "Login";
		$this -> load -> view("login_v", $data);
	}
	public function logout(){
		
 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
 $this->output->set_header("Pragma: no-cache");
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$data = array();
		
		Log::update_log_out_action($this -> session -> userdata('identity'));
		
		$this->session->sess_destroy();
		//$this->cache->clean();
		$this->db->cache_delete_all();
		
		$data['title'] = "Login";		
		$this -> load -> view("login_v", $data);
	}
/////////////////// edit user details

public function edit_user_profile(){
	
	    $f_name= $this->input->post('f_name');
		$other_name=$this->input->post('o_name');
		$phone=$this->input->post('phone_no');
		$phone=preg_replace('(^0+)', "254", $phone);
		$email=$this->input->post('email');
		$user_id=$this->input->post('user_id');
			
	    $u= Doctrine::getTable('User')->find($user_id);

		$u->fname=$f_name;
		$u->lname=$other_name;
		$u->email = $email;
		$u->username = $email;
		$u->telephone =$phone;
		$u->save();


		
		$user_id_session=$this -> session -> userdata('user_id');
		
		($user_id==$user_id_session)?				
		$this -> session -> set_userdata(array('phone_no'=>$phone,
		'user_email'=>$email,'names'=>$f_name,'inames'=>$other_name))
		: $blank=null;
		
        $this->session->set_flashdata('system_success_message', "$f_name,$other_name details have been updated");
		$access_level=$this -> session -> userdata('user_indicator');
		$redirect_to=null;
		
		switch ($access_level):
			case 'moh':
				$redirect_to='user_management/moh_manage';
				break;
			case 'district':
				$redirect_to="user_management/dist_manage";
				break;
			case 'facility' || 'fac_user':
			$redirect_to="report_management/facility_settings";
				break;
				endswitch;
	
	    redirect($redirect_to);
}

public function submit() {
	if($this->input->post('username')){
	   $username=$_POST['username'];
		$password=$_POST['password'];	
	}
	
		
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$reply=User::login($username, $password);
		$n=$reply->toArray();
		//echo($n['username']);

		$myvalue=$n['usertype_id'];
		$namer=$n['fname'];
		$id_d=$n['id'];
		$inames=$n['lname'];		
		$disto=$n['district'];
		$faci=$n['facility'];
		$partner=$n['partner'];
		$phone=$n['telephone'];
	    $user_id=$n['id'];
		$user_email=$n['email'];
		$county_id=$n['county_id'];
        $county_name="";
		if($faci>0){
		$myobj = Doctrine::getTable('facilities')->findOneByfacility_code($faci);
        $facility_name=$myobj->facility_name ;	
		$drawing_rights=$myobj->drawing_rights;
		}
        
		if($disto>0){
		$myobj = Doctrine::getTable('districts')->find($disto);
        $dist=$myobj->district;	
		}
		if($partner>0){
		$myobj = Doctrine::getTable('partners')->find($partner);
        $part=$myobj->partner;	
		}
		if($county_id>0){
		$myobj = Doctrine::getTable('counties')->find($county_id);
        $county_name=$myobj->county;	
		}
		$moh="MOH Official";
		$moh_user="MOH User";
		$kemsa="KEMSA Representative";
		$rtk="RTK Program Manager";
		$super_admin="Super Admin";
		$county=   $county_name." County Facilitator";
		$allocation="Allocation committee";
		$dpp="District Lab Technologist";
		$partner_name="RTK Partner";
		
       if ($myvalue ==1) {
       		$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
       		'user_email'=>$user_email,'full_name' =>$moh ,'user_id'=>$user_id,
       		'user_indicator'=>"moh",'names'=>$namer,'inames'=>$inames,'identity'=>$id_d,
       		'news'=>$faci,'district1'=>$disto,'county_name'=>$county_name);	
		} else if($myvalue==4){
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'full_name' =>$moh_user ,'user_id'=>$user_id,
			'user_indicator'=>"moh_user",'names'=>$namer,'inames'=>$inames,
			'identity'=>$id_d,' '=>$faci,'district1'=>$disto,'county_name'=>$county_name);
		}else if($myvalue==5){
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'full_name' =>$facility_name ,'user_id'=>$user_id,
			'user_indicator'=>"fac_user",'names'=>$namer,'inames'=>$inames,'identity'=>$id_d,
			'news'=>$faci,'district1'=>$disto, 
			'drawing_rights'=>$drawing_rights, 'county_name'=>$county_name);
		}else if($myvalue ==3){
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$dist
			 ,'user_id'=>$user_id,'user_indicator'=>"district",'names'=>$namer,
			 'inames'=>$inames,'identity'=>$id_d,'news'=>$faci,
			  'district'=>$n['district'],'district1'=>$disto, 
			  'county_name'=>$county_name);
		}else if($myvalue ==6){
			$session_data = array('county_id'=>$county_id,
			'phone_no'=>$phone,'user_email'=>$user_email,'full_name' =>$kemsa,
			'user_id'=>$user_id,'user_indicator'=>"kemsa",'names'=>$namer,
			'inames'=>$inames,'identity'=>$id_d,'news'=>$faci,
			'district1'=>$disto, 'county_name'=>$county_name);
		}	
		else if($myvalue ==2)  {
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$facility_name,
			'user_id'=>$user_id,'user_indicator'=>"facility",'names'=>$namer,
			'inames'=>$inames,'identity'=>$id_d,'news'=>$faci,'district1'=>$disto,
			'drawing_rights'=>$drawing_rights, 
			'county_name'=>$county_name);
		}
		else if($myvalue ==9)  {
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$super_admin,
			'user_id'=>$user_id,'user_indicator'=>"super_admin",'names'=>$namer,
			'inames'=>$inames,'identity'=>$id_d,'news'=>$faci,
			'district1'=>$disto,'drawing_rights'=>0, 
			'county_name'=>$county_name);
		}
		else if($myvalue ==8)  {
			$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
			'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$rtk,
			'user_id'=>$user_id,'user_indicator'=>"rtk_manager",'names'=>$namer,
			'inames'=>$inames,'identity'=>$id_d,'news'=>$faci,'district1'=>$disto,
			'drawing_rights'=>0, 'county_name'=>$county_name);
		}	
		else if($myvalue ==10)  {
		$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
		'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$county,
		'user_id'=>$user_id,'user_indicator'=>"county_facilitator",
		'names'=>$namer,'inames'=>$inames,'identity'=>$id_d,
		'news'=>0,'district'=>'6','drawing_rights'=>0, 
		'county_name'=>$county_name);

		}
		else if($myvalue ==11)  {
		$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
		'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$allocation,
		'user_id'=>$user_id,'user_indicator'=>"allocation_committee",
		'names'=>$namer,'inames'=>$inames,'identity'=>$id_d,
		'news'=>0,'district'=>'6','drawing_rights'=>0, 
		'county_name'=>$county_name);
		}
		else if($myvalue ==12)  {
		$session_data = array('county_id'=>$county_id,'phone_no'=>$phone,
		'user_email'=>$user_email,'user_db_id'=>$user_id,'full_name' =>$dpp,
		'user_id'=>$user_id,'user_indicator'=>"dpp",'names'=>$namer,'inames'=>$inames,
		'identity'=>$id_d,'news'=>$county,'district1'=>$disto,'drawing_rights'=>0,
		'county_name'=>$county_name);			
		
		}else if($myvalue==14){
			$session_data = array('county_id'=>$county_id,'partner'=>$part,'phone_no'=>$phone,
			'user_email'=>$user_email,'full_name' =>$partner_name ,'user_id'=>$user_id,
			'user_indicator'=>"rtk_partner_admin",'names'=>$namer,'inames'=>$inames,
			'identity'=>$id_d,'news'=>$faci,'district1'=>$disto,'county_name'=>$county_name);
		}
		else if($myvalue==15){
			$session_data = array('county_id'=>$county_id,'partner'=>$part,'phone_no'=>$phone,
			'user_email'=>$user_email,'full_name' =>$partner_name ,'user_id'=>$user_id,
			'user_indicator'=>"rtk_partner_super",'names'=>$namer,'inames'=>$inames,
			'identity'=>$id_d,'news'=>$faci,'district1'=>$disto,'county_name'=>$county_name);
		}
						
		$this -> session -> set_userdata($session_data);
		$this -> session -> set_userdata(array("user_type_id"=>$myvalue));
		Log::update_log_out_action($this -> session -> userdata('user_id'));
		
		$u1=new Log();
		$action='Logged In';
		$u1->user_id=$this -> session -> userdata('identity');
		$u1->action=$action;
		$u1->save();
		
		redirect("home_controller");
	
        
   
}


	private function _submit_validate() {

		$this->form_validation->set_rules('username', 'Username',
			'trim|required|callback_authenticate');

		$this->form_validation->set_rules('password', 'Password',
			'trim|required');

		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');

		return $this->form_validation->run();

	}

	public function authenticate() {

		// get User object by username
		if ($u = Doctrine::getTable('User')->findOneByUsername($this->input->post('username'))) {

			// this mutates (encrypts) the input password
			$u_input = new User();
			$u_input->password = $this->input->post('password');

			// password match (comparing encrypted passwords)
			if ($u->password == $u_input->password) {
				unset($u_input);
				return TRUE;
			}
			unset($u_input);
		}

		return FALSE;
	}
	
	
public function forgotpassword() {
		$data['title'] = "Register Users";
		$data['content_view'] = "moh/signup_v";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
	}
	
	public function sign_up() {
		$data['title'] = "Register Users";
		$data['content_view'] = "moh/registeruser_moh";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
	}
	public function district_signup(){
		$data['title'] = "Register Users";
		$data['content_view'] = "register_v";
		$data['banner_text'] = "Add Users";
		$data['level_l'] = Access_level::getAll2();
		$data['counties'] = Counties::getAll();
		
		//$data['r_name']='';
		
		
		$this -> load -> view("template", $data);
	}
	//district_signup
	public function dist_signup(){
		//get current district from session
		$district=$this -> session -> userdata('district1');
		
		$data['title'] = "Register Users";
		$data['content_view'] = "district_add_user";
		$data['banner_text'] = "Register Users";
		$data['quick_link'] = "signup_v";
		$data['level_l'] = Access_level::getAll1();
		$data['facility'] = Facilities::getFacilities($district);
		$this -> load -> view("template", $data);
	}
	//users list
	public function users_facility(){
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		
		$data['quick_link'] = "users_facility_v";
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	
	}
	//////// reset password /activate/ deactivate 
	public function reset_user_variable($title,$id){
		
		 $u= Doctrine::getTable('User')->find($id);

		$f_name=$u->fname;
		$l_name=$u->lname;
		
		switch ($title) {
			  case 'deactive':
				$status=  user::activate_deactivate_user($id,0);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been deactivated");
				}
				break;
				case 'active':
				
				$status=  user::activate_deactivate_user($id,1);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been activated");
				}
				break;
				
				case 'reset':
				$status=  user::reset_password($id);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name password has been reset");
				}
				break;	
				
				case 'delete':
				$status=  user::delete_user($id);
				if($status){
					
					$this->session->set_flashdata('system_success_message', "User $f_name, $l_name has been deleted");
				}
				break;	

			  default:
				
				break;
		}
		
		
	}
	//////////////// checking the user email
	public function check_user_email($email=null){
		
		
		if($email !=''){
			$email=urldecode($email);
	$email_count=User::check_user_email($email);
	
	if($email_count==0){
		echo "User name is available";
	}
	else{
		echo "User name is already in use";
	}
		}
else{
	echo "Blank email";
}	
		
	}
	/// register facility users{}
	public function create_new_facility_user(){
		
		$password='123456';
		$redirect=false;
		$district_redirect=false;
		$county_redirect=false;
		$user_level="";
		$access_level="";
		$user_delegation="";
		$county_id="";
		$facility_code=$this -> session -> userdata('news');
		
		
		$access_level=access_level::get_access_level_name($this->input->post('user_type'));
		
		$access_level=$access_level['level'];
		
		if($facility_code!=null){
		$county_id=$this->input->post('county_id');
		$facility_code=$facility_code;
		$redirect=TRUE;	
		
		$facility_name=facilities::get_facility_name_($facility_code);
		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";
		
		}
		
		if($this->input->post('facility_code')){
			$county_id=$this->input->post('county_id');
			$facility_code=$this->input->post('facility_code');
			$district_redirect=true;
			$facility_name=facilities::get_facility_name_($facility_code);
		
		    $user_delegation="Facility: $facility_name[facility_name]";
		    $user_level="Facility Level";
		}
		
       
		
		
		
        if($this->input->post('user_name')){
            $user_name=$this->input->post('email');
                  }		
             else{
            $user_name=$this->input->post('user_name');
          }
		
		$f_name= $this->input->post('f_name');
		$other_name=$this->input->post('o_name');
		$phone=$this->input->post('phone_no');
		$phone=preg_replace('(^0+)', "254", $phone);
		$email=$this->input->post('email');
		
		$u = new User();
		if($this->input->post('district')){
$u->district =$this->input->post('district');
$u->county_id =$this->input->post('county');
$county_redirect=true;
$district_name=districts::get_district_name_($this->input->post('district'));
$user_level="District Level";		
$user_delegation="District: $district_name[district]";
}		
else{
    $u->district =$this -> session -> userdata('district1');
	$u->county_id =$county_id;
}
        
		$u->fname=$f_name;
		$u->lname=$other_name;
		$u->email = $email;
		$u->username = $email;
		$u->password = $password;
		$u->usertype_id =$this->input->post('user_type') ;
		$u->telephone =$phone;
		
		$u->facility = $facility_code;
		
		$u->save();
		
		 if($facility_code!=null && $facility_code!=0){
        	
 $q = Doctrine_Manager::getInstance()->getCurrentConnection()
 ->execute('update facilities f, (select  facility, min(`created_at`) 
 as date from user u where facility='.$facility_code.' group by facility) as temp set `using_hcmp`=1,
 `date_of_activation`=temp.date where unix_timestamp(`date_of_activation`)=0 
 and facility_code=temp.facility');
 
		}
		
		$message='Hello '.$f_name.',You have been registered. Check your email for login details. HCMP';
		$message_1='Hello '.$f_name.', <br> <br> Thank you for registering on the Health Commodities Management Platform (HCMP).
		<br>
		<br>
		Web link: http://health-cmp.or.ke/
		<br>
		<br>
		Please find your log in credentials below:
		<br>
		<br>
		'.$user_delegation.'
		<br> 
		User Level: '.$user_level.'
		<br>
		User Type: '.$access_level.'
		<br>
		User Name: '.$email.' 
		<br>
		Password: '.$password.'
		<br>
		<br>
		Kindly reset your password after logging in onto the system';
		
	    $subject="User Registration :".$f_name." ".$other_name;
	
	
		$this->send_sms($phone,$message);
		$this->send_email($email,$message_1,$subject);



  if($redirect){
  	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/users_manage");
  	
  }

  
  elseif($district_redirect){
  	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/dist_manage");
  
  }
   elseif($county_redirect){
   	$this->session->set_flashdata('system_success_message', "$f_name,$other_name has been registerd");
	redirect("User_Management/moh_manage");
  	
  }
  else{
  	echo "$f_name $other_name has been registerd, your password is $password";
  }
 
	}


	
	/// register facility users{}
	public function edit_facility_user(){
		
		if($this->input->post('facility_code')){
			$facility_code=$this->input->post('facility_code');
		}
		else{
		$facility_code=$this -> session -> userdata('news');	
		}
		$district=$this -> session -> userdata('district1');
		$f_name= $this->input->post('f_name');
		$other_name=$this->input->post('o_name');
		$id= $this->input->post('id');
		
		
		$u = Doctrine::getTable('user')->findOneById($id);
		$u->fname=$f_name;
		$u->lname=$other_name;
		$u->email = $this->input->post('email');
		$u->username = $this->input->post('user_name');
		
		$u->usertype_id = $this->input->post('user_type');
		$u->telephone = $this->input->post('phone_no');
		$u->district = $district;
		$u->facility = $facility_code;
		$u->save();
		
		

 echo "$f_name $other_name details have been edited";
	}
	
//super admin

 public function create_user_super_admin(){
       $data['title'] = "Register Users";
		$data['content_view'] = "super_admin/create_user_v";
		$data['banner_text'] = "Register";
		//$data['r_name']='';
		$data['level_l'] = Access_level::get_all_users();
		$data['counties'] = Counties::getAll();
		
		$this -> load -> view("template", $data);
}

	
	public function users_district(){
		$district=$this -> session -> userdata('district1');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district, $id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function users_moh(){
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	// facility users manage
	public function users_manage($pop_up_msg=NULL){
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['result'] = User::getAll2($facility,$id);
		$data['user_type']= Access_level::getAll1();
		$data['title'] = "User Management";
		$data['content_view'] = "facility/user_management/users_facility_v";
		$data['banner_text'] = "User Management";
		$data['pop_up_msg']=$pop_up_msg;
		$this -> load -> view("template", $data);
	}
	// district users manage
	public function dist_manage($pop_up_msg=NULL){
		$district=$this -> session -> userdata('district1');
		$id=$this -> session -> userdata('user_db_id');
		$data['user_type']= Access_level::getAll1();
		$data['facilities']= Facilities::getFacilities($district);
		$data['title'] = "User Management";
		$data['content_view'] = "district/user_management/users_district_v";
		$data['banner_text'] = "User Management";
		$data['pop_up_msg']=$pop_up_msg;
		$data['result'] = User::getAll5($district, $id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}

	public function moh_manage(){
		
		$data['title'] = "Manage Users";
		$data['moh_users']=user::get_all_moh_users();
		$data['user_type'] = Access_level::getAll();
		$data['counties'] = Counties::getAll();
		$data['content_view'] = "moh/user_management/moh_hcmp_users";
		$data['banner_text'] = "Manage System Users";
		$this -> load -> view("template", $data);
	}
	
	public function user_details(){
		$use_id=$this->uri->segment(3);
		$data['title'] = "View Users";
		$data['content_view'] = "user_details_v";
		$data['banner_text'] = "Reset Password";
		$data['level_l'] = Access_level::getAll1();
		$data['detail_list']=User::getAll3($use_id);
		$data['detail_list1']=User::getAll4($use_id);
		$this -> load -> view("template", $data);
	}
	public function reset_pass(){
		$data['title'] = "View Users";
		$data['content_view'] = "reset_pass_v";
		$data['banner_text'] = "Reset Password";
		$this -> load -> view("template", $data);
	}

		public function forget_pass(){
		$this -> load -> view("forgotpassword_v");
	}
	public function password_recovery(){
		
		$email=$_POST['username'];
		
		
		if($email!=NULL):
		
		$password='123456';
		
		$mycount= User::check_user_exist($email);
		

		if ($mycount>0 ):
		$account_details=User::get_user_details($email)->toArray();
		
		
		$access_level=access_level::get_access_level_name($account_details[0]['usertype_id']);
		$access_level=$access_level['level'];
		
		switch ($account_details[0]['usertype_id']) {
			case 2:
		$facility_name=facilities::get_facility_name_($account_details[0]['facility']);		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";	
				break;
			case 5:
		$facility_name=facilities::get_facility_name_($account_details[0]['facility']);		
		$user_delegation="Facility: $facility_name[facility_name]";
		$user_level="Facility Level";	
				break;		
			case 3:
		$district_name=districts::get_district_name_($account_details[0]['district']);
        $user_level="District Level";		
        $user_delegation="District: $district_name[district]";		
				break;	
			
			default:
				
				break;
		}
		
		
		$subject="Password reset";
		$message='Hello '.$account_details[0]['fname'].'you requested for a password reset check you email address for more details (HCMP)';
		
		$message_1='Hello '.$account_details[0]['fname'].', <br> <br> You requested for a password reset on the Health Commodities Management Platform (HCMP).
		<br>
		<br>
		Web link: http://health-cmp.or.ke/
		<br>
		<br>
		Please find your log in credentials below:
		<br>
		<br>
		'.$user_delegation.'
		<br> 
		User Level: '.$user_level.'
		<br>
		User Type: '.$access_level.'
		<br>
		User Name: '.$email.' 
		<br>
		Password: '.$password.'
		<br>
		<br>';
			//hash then reset password
			$salt = '#*seCrEt!@-*%';
			$value=( md5($salt . $password));
			
			$updatep = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$updatep->execute("UPDATE user SET password='$value'  WHERE username='$email' or email='$email'; ");
			
			//send mail

			$response=$this->send_email($email,$message_1,$subject);
			$this->send_sms($account_details[0]['telephone'],$message);
			
			 $data['email']=$email;
			 $data['popup'] = "Successpopup";
	         $this -> load -> view("login_v",$data);
			
			
			
			
		    else: 
			$data['popup'] = "errorpopup";
			$this -> load -> view("forgotpassword_v",$data);
			endif;
else: 
	        $data['popup'] = "errorpopup";
			$this -> load -> view("forgotpassword_v",$data);
endif;

	
			
	}
	public function base_params($data) {
		$this -> load -> view("template", $data);
	}
	//facility activate/deactivate
	public function deactive(){
		$status=0;		
		$id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($id);
		$state->status=$status;
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function active(){
		$status=1;		
		$id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($id);
		$state->status=$status;
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//district activate/deactivate
	public function dist_deactive(){
		$status=0;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$district=$this -> session -> userdata('district1');
		//echo $district;
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district,$use_id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	public function dist_active(){
		$status=1;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$district=$this -> session -> userdata('district1');
		//echo $district;
		$data['title'] = "View Users";
		$data['content_view'] = "district/users_district_v";
		$data['banner_text'] = "District Users";
		$data['result'] = User::getAll5($district,$use_id);
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//moh activate/deactivate
	public function moh_deactive(){
		$status=0;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	public function get_user_profile($user_id=null){
		
		$user_id_input=isset($user_id)? $user_id:$this -> session -> userdata('identity');
		
	
		
		$data['user_data']=user::getAllUser($user_id_input)->toArray();
		
		$this->load->view('facility/user_management/user_profile_v',$data);
		
	}
	public function moh_active(){
		$status=1;		
		$use_id=$this->uri->segment(3);
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->status=$status;
		$state->save();
		
		$data['banner_text'] = "All Users";
		$data['title'] = "View Users";
		$data['content_view'] = "users_moh_v";
		$data['result'] = User::getAll();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
	}
	
	//validates usernames
	public function username(){
		//$username=$_POST['username'];
		//for ajax
		$desc=$_POST['username'];
		$describe=user::getUsername($desc);
		$list="";
		foreach ($describe as $describe) {
			$list.=$describe->username;
		}
		echo $list;
	}
	public function user_reset(){
		$id=$this->uri->segment(3);
		$password='hcmp2012';
		
		$pass1=Doctrine::getTable('user')->findOneById($id);
		$name=$pass1->fname;
		$lname=$pass1->lname;
		$email=$pass1->email;
		$pass=Doctrine::getTable('user')->findOneById($id);
		//echo $pass->password
		$pass->password=$password;
		$pass->save();
		
		$fromm='hcmpkenya@gmail.com';
		$messages='Hallo '.$name .', Your password has been reset Please use '.$password.'. Please login and change. 
		
		Thank you';
	
  		$config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'hcmpkenya@gmail.com', // change it to yours
  'smtp_pass' => 'healthkenya', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
); 
		
        //$this->email->initialize($config);
		$this->load->library('email', $config);
 
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email); // change it to yours
  		
  		$this->email->subject('Password Reset:'.$name.' '.$lname);
 		$this->email->message($messages);
 
  if($this->email->send())
 {

 }
 else
{
 show_error($this->email->print_debugger());
}
		$this->session->sess_destroy();
		$data = array();
		$data['title'] = "System Login";
		
		$this -> load -> view("login_v", $data);
	}
	public function edit_user(){
		$use_id=$this->uri->segment(3);
		//echo $use_id;
		
		$data['title'] = "Reset Details";
		$data['content_view'] = "detail_reset_v";
		$data['banner_text'] = "Reset Details";
		$data['users_det']=User::getAllUser($use_id);
		$data['level_l'] = Access_level::getAll1();
		$data['counties'] = Counties::getAll();
		$data['link'] = "details_reset_v";
		$this -> load -> view("template", $data);
	}
	public function edit_facility(){
		$use_id=$_POST['user_id'];
		//echo $use_id;
		/*$myobj = Doctrine::getTable('user')->findOneById($use_id);
    	$disto=$myobj->district;
		$faci=$myobj->facility;
		$type=$myobj->usertype_id;
		$data['counties'] = Counties::getAll3($type);
		echo $faci;*/
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$tell=$_POST['tell'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$type=$_POST['type'];

		//$use_id=$_POST['user_id'];
		$state=Doctrine::getTable('user')->findOneById($use_id);
		$state->fname=$fname;
		$state->lname=$lname;
		$state->telephone=$tell;
		$state->email=$email;
		$state->username=$username;
		$state->usertype_id=$type;
		
		$state->save();
		
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('user_db_id');
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2($facility,$id);
		$data['quick_link'] = "users_facility_v";
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template" , $data);
			}

			public function password_change(){
			echo json_encode('test');	
			exit;
		$initialpassword=$_POST['inputPasswordinitial'];
		$use_id=$this -> session -> userdata('user_id');
		$newpassword=$_POST['inputPasswordnew2'];
		
		//retrieve password and compare
		
		$getdata=User::getAllUser($use_id);
		$initpassword=$getdata[0]['password'];
		$salt = '#*seCrEt!@-*%';
		$value=( md5($salt . $newpassword));
		 
		//echo $value.'</br>';
		//echo $initpassword;
		if ($initpassword != $value) {
			echo $initpassword;
		} else {
			
		}
		

			}
			
			public function save_new_password() {
			$old_password=$_POST['old_password'];
			$new_password=$_POST['new_password'];		
			$user_id = $this -> session -> userdata('user_id');
			$valid_old_password = $this -> correct_current_password($old_password);

		//Check if old password is correct
		if ($valid_old_password == FALSE) {
			$response = array('msg' => 'You have entered a wrong password.','response'=> 'false');
			echo json_encode($response);
		}  else {
			$salt = '#*seCrEt!@-*%';
			$value=( md5($salt . $new_password));
			
			$updatep = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$updatep->execute("UPDATE user SET password='$value'  WHERE id='$user_id'; ");
			$response = array('msg' => 'Success!!! Your password has been changed.','response'=> 'true');
			$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			echo json_encode($response);
			//$this->session->set_flashdata('system_success_message', 'Success!!! Your password has been changed.');
			//redirect('Home_Controller');
		}

		

	}

	private function _submit_validate_password() {
		// validation rules
		$this -> form_validation -> set_rules('old_password', 'Current Password', 'trim|required|min_length[6]|max_length[30]');
		$this -> form_validation -> set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[30]|matches[new_password_confirm]');
		$this -> form_validation -> set_rules('new_password_confirm', 'New Password Confirmation', 'trim|required|min_length[6]|max_length[30]');
		$temp_validation = $this -> form_validation -> run();
		if ($temp_validation) {
			$this -> form_validation -> set_rules('old_password', 'Current Password', 'trim|required|callback_correct_current_password');
			return $this -> form_validation -> run();
		} else {
			return $temp_validation;
		}

	}

	public function correct_current_password($pass) {
		$salt = '#*seCrEt!@-*%';
		$pass=( md5($salt . $pass));
		$user_id = $this -> session -> userdata('user_id');
		$getdata=User::getAllUser($user_id);
		$currentpassword=$getdata[0]['password'];
		
		if ($currentpassword != $pass) {
			$this -> form_validation -> set_message('correct_current_password', 'The current password you provided is not correct.');
			return FALSE;
			//echo "Dont match";
		} else {
			return TRUE;
			//echo "Yes match";
			
		}
		

	}
			}


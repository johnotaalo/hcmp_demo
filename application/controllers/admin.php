<?php
/**
 * @author Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}


	public function index() {
		$data['title'] = "Commodities";
		$this -> load -> view("", $data);
	}
	
	public function manage_commodities() {
		$data['title'] = "Commodities";
		$data['content_view'] = "Admin/commodities_v";
		$data['commodity_list'] = commodity_sub_category::get_all();
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
	public function commodities_upload() {
		
	}
	
	public function manage_users() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/users_v";
		$data['listing']= Users::get_user_list_all();
		$data['counts']=Users::get_users_count();
		$data['counties']=Counties::getAll();
		$data['facilities']=Facilities::getAll();
		$data['sub_counties']=Districts::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}
//manage facilities
	public function manage_facilities() {
		$permissions='super_permissions';
		$data['title'] = "Users";
		$data['content_view'] = "Admin/facilities_v";
		$data['facilities_listing']= Users::get_facilities_list_all();
		$data['facilities_listing_active']= Users::get_facilities_list_all_active(1);
		$data['facilities_listing_inactive']= Users::get_facilities_list_all_active(0);
		$data['active_count']= Facilities::get_all_facilities_active_no();
		$data['facility_count']=Facilities::get_all_facilities_no();
		$data['counties']=Counties::getAll();
		$data['facilities']=Facilities::getAll();
		$data['sub_counties']=Districts::getAll();
		$data['user_types']=Access_level::get_access_levels($permissions);
		$this -> load -> view("shared_files/template/dashboard_v", $data);
	}

	public function deactivate_facility(){
		$le_facility = $_POST['ndata'];
		$le_status = $_POST['status'];
		//echo "This  ".$le_status;exit;
		//something
		$double_tap = Users::deactivate_facility($le_facility,$le_status);
		//echo "Success";
	}

	public function edit_user(){
		
		$identifier = $this -> session -> userdata('user_indicator');

		$fname = $_POST['fname_edit'];
		$lname = $_POST['lname_edit'];
		$status = $_POST['status'];
		$telephone_edit= $_POST['telephone_edit'];
		$email_edit = $_POST['email_edit'];
		$username_edit = $_POST['username_edit'];
		$facility_id_edit_district = $_POST['facility_id_edit_district'];
		$user_type_edit_district = $_POST['user_type_edit_district'];
		$district_name_edit = $_POST['district_name_edit'];
		$facility_id_edit= $_POST['facility_id_edit'];
		$user_id= $_POST['user_id'];
		$county = $_POST['county_edit'];
		
		if ($status=="true") {
			
			$status=1;
			
		} elseif($status=="false") {
			
			$status=0;
		}
		
		
		//update user
			$update_user = Doctrine_Manager::getInstance()->getCurrentConnection();
			$update_user->execute("UPDATE `user` SET fname ='$fname' ,lname ='$lname',email ='$email_edit',usertype_id =$user_type_edit_district,telephone ='$telephone_edit',
									district ='$district_name_edit',facility ='$facility_id_edit',status ='$status',county_id ='$county'
                                  	WHERE `id`= '$user_id'");
		
	}
	
}
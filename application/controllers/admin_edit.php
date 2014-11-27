<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Admin_edit extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));

		// $this->index();
	}

	 public function index(){
     	// $data['district_data'] = districts::getDistrict(1);
		$data['banner_text'] = "Facility Training Evaluation Results";
		$data['title'] = "Facility Training Evaluation Results";
		$data['report_view']  = "subcounty/reports/analysis_home";
		$data['sidebar'] = "shared_files/report_templates/side_bar_sub_county_v";
		$data['content_view'] = "facility/facility_reports/reports_v";
		// $data['report_view'] = "subcounty/reports/analysis_home";
		$this -> load -> view('shared_files/template/template', $data);
     	
     }
 }

	?>
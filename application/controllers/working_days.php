<?php 

class Working_days extends MY_Controller {
	function __construct() {
		parent::__construct();
	}
public function index(){
	$data = array();
		$data['title'] = "Facility Mapping";
     	
     	$data['scripts'] = array("FusionCharts/FusionCharts.js"); 
		$data['banner_text'] = "Facility Mapping";

	   // $data['content_view'] = "rtk_view/facility_mapping_v";
	    $this -> load -> view("rtk_view/facility_mapping_v");
}

}
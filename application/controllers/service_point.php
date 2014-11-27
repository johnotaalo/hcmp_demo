<?php
class Service_Point extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	}
	
	public function index() {
		  $data['title'] = "Service Points";
    	$data['content_view'] = "facility_service";
    	 $data['banner_text'] = "Service Points";
		$data['quick_link'] = "facility_service";
		$this -> load -> view("template", $data);
	}
	public function submit(){
		
		$facility1=$this->input->post('spoint');
		$service=$this->input->post('facility');
		
		$u=new Service();
		$u->facility_id=$service;
		$u->service_point=$facility1;
		$u->save();
		
		 $data['title'] = "Service Points";
    	$data['content_view'] = "facility_service";
    	 $data['banner_text'] = "Service Points";
		$data['quick_link'] = "facility_service";
		$this -> load -> view("template", $data);
		
	}
}
<?php
class Expire extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	}
	
	public function index() {
		$date= date('Y-m-d');
		$facility=$this -> session -> userdata('news');
		//echo $date;
		$data['title'] = "Expired Products";
		$data['content_view'] = "expire_v";
		$data['banner_text'] = "Expired Products";
		$data['exp']=Facility_Stock::getexp($date,$facility);
		
		$data['link'] = "expire_v";
		$data['quick_link'] = "expire_v";
		$this -> load -> view("template", $data);
	}
	public function kemsa(){

     $data['title'] = "Stock";
    $data['content_view'] = "potentialExp_v";
     $data['banner_text'] = "Potential Expiries";
     $data['link'] = "potentialExp_v";
$data['stocks']=Facility_Stock::Allexpiries();
//echo count($stocks);
//$data['tester']=Drug::getSome();
$data['quick_link'] = "potentialExp_v";
$this -> load -> view("template", $data);
	}
}
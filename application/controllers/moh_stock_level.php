<?php
class Moh_stock_level extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function index() {
		
	}
	function stock_level(){
     	$data['title'] = "Stock level";
     	$data['content_view'] = "stock";
     	$data['scripts'] = array("FusionCharts/FusionCharts.js"); 
		$data['banner_text'] = "Stock Level";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['categories'] = Drug_category::getAll();
		$data['quick_link'] = "load_stock";
		$this -> load -> view("template", $data);
	}
	function stock_level_ajax(){
		 $facilities=urldecode($this->uri->segment(3));
		 $category=urldecode($this->uri->segment(4)); 
		 $data["facilities"]=$facilities;
 	$data['posts']=$this->db->query(
"SELECT dr.drug_name AS name, fs.quantity AS quantity
FROM facilitystock fs, drug dr, drug_category drc, facilities f
WHERE drc.category_name = '$category'
AND fs.kemsa_code = dr.kemsa_code
AND drc.id = dr.drug_category
AND f.`facility_name` = '$facilities'");
  
		$this->load->view("ajax_view/stock_level",$data);
		
	}
	

}
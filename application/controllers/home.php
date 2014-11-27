<?php
/*
 * @author Kariuki & Mureithi
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Home extends MY_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));
		$this -> load -> library(array('hcmp_functions', 'form_validation'));
	}

  public function reset_(){
  	   $facility_code=$this -> session -> userdata('facility_id');
		
		$reset_facility_transaction_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_transaction_table->execute("DELETE FROM `facility_transaction_table` WHERE  facility_code=$facility_code; ");
	    
		$reset_facility_stock_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_stock_table->execute("DELETE FROM `facility_stocks` WHERE  facility_code=$facility_code");
	    
		$reset_facility_issues_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_issues_table->execute("DELETE FROM `facility_issues` WHERE  facility_code=$facility_code;");
		
		$reset_facility_issues_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_issues_table->execute("DELETE FROM `redistribution_data` WHERE  source_facility_code=$facility_code or receive_facility_code=$facility_code;");

		$facility_order_details_table = Doctrine_Manager::getInstance()->getCurrentConnection()
        ->fetchAll("select id from `facility_orders` WHERE  facility_code=$facility_code;");

		foreach ( $facility_order_details_table as $key => $value) {
		$reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `facility_order_details` WHERE  order_number_id=$value[id]; ");	
        }
	    $reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `facility_orders` WHERE  facility_code=$facility_code; ");
		
		$reset_facility_historical_stock_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_historical_stock_table->execute("DELETE FROM `facility_monthly_stock` WHERE  facility_code=$facility_code; ");
		
		$reset_facility_update_stock_first_temp = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_update_stock_first_temp->execute("DELETE FROM `facility_stocks_temp` WHERE  facility_code=$facility_code; ");
		
		
		$this->session->set_flashdata('system_success_message', 'Facility Stock Details Have Been Reset');
		redirect('Home');
  }
	public function index() {	
		(!$this -> session -> userdata('user_id')) ? redirect('user'): null ;	

		$identifier = $this -> session -> userdata('user_indicator');
		
        switch ($identifier):
			case 'moh':
			$view = 'shared_files/template/dashboard_template_v';	
			break;
			case 'facility_admin':
			case 'facility':
			$view = 'shared_files/template/template';
		    $data['content_view'] = "facility/facility_home_v";	
			$data['facility_dashboard_notifications']=$this->get_facility_dashboard_notifications_graph_data();
			break;
			case 'district':
			$data['content_view'] = "subcounty/subcounty_home_v";	
			$view = 'shared_files/template/template';
			break;
			case 'moh_user':
			$view = '';
			break;
			case 'scmlt':
			case 'rtk_county_admin':
			case 'allocation_committee':
			case 'rtk_partner_admin':
			case 'rtk_manager':
			case 'rtk_partner_admin':
			case 'rtk_partner_super':
			redirect('home_controller');
			break;
			case 'super_admin':
			$view = 'shared_files/template/dashboard_v';
			$data['content_view'] = "shared_files/template/super_admin_template";
			break;
			// case 'allocation_committee':
			// $view = '';
			break;	
			case 'county':
			$view = 'shared_files/template/template';
			$data['content_view'] = "subcounty/subcounty_home_v";
			break;

        endswitch;

		$data['title'] = "System Home";
		$data['banner_text'] = "Home";
		$this -> load -> view($view, $data);
	}

    public function get_facility_dashboard_notifications_graph_data()
    {
    //format the graph here
    $facility_code=$this -> session -> userdata('facility_id'); 
    $facility_stock_=facility_stocks::get_facility_stock_amc($facility_code);

	$facility_stock_count=count($facility_stock_);
    $graph_data=array();
	$graph_data=array_merge($graph_data,array("graph_id"=>'container'));
	$graph_data=array_merge($graph_data,array("graph_title"=>'Facility stock level'));
	$graph_data=array_merge($graph_data,array("graph_type"=>'bar'));
	$graph_data=array_merge($graph_data,array("graph_yaxis_title"=>'Total stock level  (values in packs)'));
	$graph_data=array_merge($graph_data,array("graph_categories"=>array()));
	$graph_data=array_merge($graph_data,array("series_data"=>array("Current Balance"=>array(),"AMC"=>array())));
	$graph_data['stacking']='normal';
	foreach($facility_stock_ as $facility_stock_):
		$graph_data['graph_categories']=array_merge($graph_data['graph_categories'],array($facility_stock_['commodity_name']));	
		$graph_data['series_data']['Current Balance']=array_merge($graph_data['series_data']['Current Balance'],array((float) $facility_stock_['pack_balance']));
        $graph_data['series_data']['AMC']=array_merge($graph_data['series_data']['AMC'],array((float) $facility_stock_['amc']));	

	endforeach;
	//echo "<pre>";print_r($facility_stock_);echo "</pre>";exit;
	//create the graph here
	$faciliy_stock_data=$this->hcmp_functions->create_high_chart_graph($graph_data);
	$loading_icon=base_url('assets/img/no-record-found.png'); 
	$faciliy_stock_data=($facility_stock_count>0)? $faciliy_stock_data : "$('#container').html('<img src=$loading_icon>');" ;
    //compute stocked out items
    $items_stocked_out_in_facility=count(facility_stocks::get_items_that_have_stock_out_in_facility($facility_code));
	//get order information from the db
	$facility_order_count_=facility_orders::get_facility_order_summary_count($facility_code);
	$facility_order_count=array();
     foreach($facility_order_count_ as $facility_order_count_){
     	$facility_order_count[$facility_order_count_['status']]=$facility_order_count_['total'];
     }
    //get potential expiries infor here
    $potential_expiries=Facility_stocks::potential_expiries($facility_code)->count();
	
    //get actual Expiries infor here
    $actual_expiries=count(Facility_stocks::All_expiries($facility_code));
	//get items they have been donated for
	$facility_donations=redistribution_data::get_all_active($facility_code,"to-me")->count();
	//get items they have been donated and are pending
	$facility_donations_pending=redistribution_data::get_all_active($facility_code)->count();
	//get stocks from v1
	$stocks_from_v1=0;
	if($facility_stock_count==0 && $facility_donations==0 && $facility_donations_pending==0 ){
	$stocks_from_v1=count(facility_stocks::import_stock_from_v1($facility_code));	
	}
	return array('facility_stock_count'=>$facility_stock_count,
	'faciliy_stock_graph'=>$faciliy_stock_data,
	'items_stocked_out_in_facility'=>$items_stocked_out_in_facility,
	'facility_order_count'=>$facility_order_count,
	'potential_expiries'=>$potential_expiries,
	'actual_expiries'=>$actual_expiries,
	'facility_donations'=>$facility_donations,
	'facility_donations_pending'=>$facility_donations_pending,
	'stocks_from_v1'=>$stocks_from_v1
	);	
    }
	
}

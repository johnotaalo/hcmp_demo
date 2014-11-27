<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
include_once ('auto_sms.php');
class Report_Management extends auto_sms {
	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');

	}

	public function get_order_details_report() {
		$order_id = 0;
		$kemsa_id = NULL;
		$order_id = $this -> uri -> segment(3);
		$kemsa_id = $this -> uri -> segment(4);
		$detail_list = Orderdetails::get_order($order_id);
		$table_body = "";
		$total_fill_rate = 0;
		$order_value = 0;
		$tester = count($detail_list);
		if ($tester == 0) {

		} else {

			foreach ($detail_list as $rows) {
				//setting the values to display
				$received = $rows -> quantityRecieved;
				$price = $rows -> price;
				$ordered = $rows -> quantityOrdered;
				$code = $rows -> kemsa_code;

				$total = $price * $ordered;

				if ($ordered == 0) {
					$ordered = 1;
				}
				$fill_rate = round(($received / $ordered) * 100, 0, PHP_ROUND_HALF_UP);
				$total_fill_rate = $total_fill_rate + $fill_rate;

				foreach ($rows->Code as $drug) {

					$drug_name = $drug -> Drug_Name;
					$kemsa_code = $drug -> Kemsa_Code;
					$unit_size = $drug -> Unit_Size;

					foreach ($drug->Category as $cat) {

						$cat_name = $cat;
					}
				}
				switch ($fill_rate) {
					case $fill_rate==0 :
						$table_body .= "<tr style=' background-color: #FBBBB9;'>";
						$table_body .= "<td>$cat_name</td>";
						$table_body .= '<td>' . $drug_name . '</td><td>' . $kemsa_code . '</td>' . '<td>' . $unit_size . '</td>';
						$table_body .= '<td>' . $price . '</td>';
						$table_body .= '<td>' . $ordered . '</td>';
						$table_body .= '<td>' . number_format($total, 2, '.', ',') . '</td>';
						$table_body .= '<td>' . $received . '</td>';
						$table_body .= '<td>' . $fill_rate . '% ' . '</td>';
						$table_body .= '</tr>';
						break;

					case $fill_rate<=60 :
						$table_body .= "<tr style=' background-color: #FAF8CC;'>";
						$table_body .= "<td>$cat_name</td>";
						$table_body .= '<td>' . $drug_name . '</td><td>' . $kemsa_code . '</td>' . '<td>' . $unit_size . '</td>';
						$table_body .= '<td>' . $price . '</td>';
						$table_body .= '<td>' . $ordered . '</td>';
						$table_body .= '<td>' . number_format($total, 2, '.', ',') . '</td>';
						$table_body .= '<td>' . $received . '</td>';
						$table_body .= '<td>' . $fill_rate . '% ' . '</td>';
						$table_body .= '</tr>';
						break;

					case $fill_rate==100.01 || $fill_rate>100.01 :
						$table_body .= "<tr style=' background-color: #FBBBB9;'>";
						$table_body .= "<td>$cat_name</td>";
						$table_body .= '<td>' . $drug_name . '</td><td>' . $kemsa_code . '</td>' . '<td>' . $unit_size . '</td>';
						$table_body .= '<td>' . $price . '</td>';
						$table_body .= '<td>' . $ordered . '</td>';
						$table_body .= '<td>' . number_format($total, 2, '.', ',') . '</td>';
						$table_body .= '<td>' . $received . '</td>';
						$table_body .= '<td>' . $fill_rate . '% ' . '</td>';
						$table_body .= '</tr>';
						break;

					case $fill_rate==100 :
						$table_body .= "<tr style=' background-color: #C3FDB8;'>";
						$table_body .= "<td>$cat_name</td>";
						$table_body .= '<td>' . $drug_name . '</td><td>' . $kemsa_code . '</td>' . '<td>' . $unit_size . '</td>';
						$table_body .= '<td>' . $price . '</td>';
						$table_body .= '<td>' . $ordered . '</td>';
						$table_body .= '<td>' . number_format($total, 2, '.', ',') . '</td>';
						$table_body .= '<td>' . $received . '</td>';
						$table_body .= '<td>' . $fill_rate . '% ' . '</td>';
						$table_body .= '</tr>';
						break;

					default :
						$table_body .= "<tr>";
						$table_body .= "<td>$cat_name</td>";
						$table_body .= '<td>' . $drug_name . '</td><td>' . $kemsa_code . '</td>' . '<td>' . $unit_size . '</td>';
						$table_body .= '<td>' . $price . '</td>';
						$table_body .= '<td>' . $ordered . '</td>';
						$table_body .= '<td>' . number_format($total, 2, '.', ',') . '</td>';
						$table_body .= '<td>' . $received . '</td>';
						$table_body .= '<td>' . $fill_rate . '% ' . '</td>';
						$table_body .= '</tr>';
						break;
				}

			}

			$order_value = round(($total_fill_rate / count($detail_list)), 0, PHP_ROUND_HALF_UP);
		}

		$table_head = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style><div > Fill Rate = (Quantity Received / Quantity Ordered ) * 100</div>
<caption ><p style="letter-spacing: 1px;font-weight: bold;text-shadow: 0 1px rgba(0, 0, 0, 0.1);font-size: 14px; " >Facility Order No ' . $order_id . ' | KEMSA Order No ' . $kemsa_id . '  |Order Fill Rate ' . $order_value . '%</p></caption><table class="data-table" style="margin-left: 0px">
<tr>
<td width="50px" style="background-color: #C3FDB8; "></td><td>Full Delivery 100%</td><td width="50px" style="background-color:#FFFFFF"></td><td>Ok Delivery 60%-less than 100%</td><td width="50px" style="background-color:#FAF8CC;"></td><td>Partial Delivery less than 60% </td><td width="50px" style="background-color:#FBBBB9;"></td><td>Problematic Delivery 0% or over 100%</td>
</tr></table>
<table class="data-table" width="100%">
<thead>
<tr>
<th><strong>Category</strong></th>
<th><strong>Description</strong></th>
<th><strong>KEMSA&nbsp;Code</strong></th>
<th><strong>Unit Size</strong></th>
<th><strong>Unit Cost Ksh</strong></th>
<th><strong>Quantity Ordered</strong></th>
<th><strong>Total Cost</strong></th>
<th><strong>Quantity Received</strong></th>
<th><strong>Fill rate</strong></th>
</tr>
</thead>
<tbody>';

		//echo $table_body;

		$table_foot = '</tbody></table>';
		$report_name = "Order-$order_id-detail-fill-rate";
		$title = "Order number $order_id fill rate";
		$html_data = $table_head . $table_body . $table_foot;
		$report_type = 'Download PDF';

		$this -> generate_pdf($report_name, $title, $html_data, $report_type);
	}

	public function commodity_excel() {
		$drug_categories = Drug_Category::getAll();
		;
		$data = '<table style="margin-left: 0;" width="80%">';

		foreach ($drug_categories as $category) :
			$data .= '<tr><td style="font-weight: bold; text-align:left;">' . $category -> Category_Name . '</td></tr>';
			$data .= '<td><table style="margin-left: 0;" width="80%">
					<thead>
					<tr>
						<th style="text-align:left;"><b>KEMSA Code</b></th>
						<th style="text-align:left;"><b>Description</b></th>
						<th style="text-align:left;"><b>Order Unit Size</b></th>
						<th><b>Order Unit Cost (KSH)</b></th>				    
					</tr>
					</thead>';
			foreach ($category->Category as $drug) :
				$data .= '
						<tr>
							<td style="text-align:left;">' . $drug -> Kemsa_Code . '</td>
							<td style="text-align:left;">' . $drug -> Drug_Name . '</td>
							<td style="text-align:left;"> ' . $drug -> Unit_Size . '</td>
							<td style="text-align:left;"> ' . $drug -> Unit_Cost . ' </td>
						</tr>';

			endforeach;
			$data .= '</tbody></table></td>';
		endforeach;
		$data .= '</table>';
		$filename = "commodity_list_2012_2013";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo "$data";
	}

	public function index() {
		$data['title'] = "System Reports";
		$data['content_view'] = "reports_v";
		$data['banner_text'] = "System Reports";
		$data['link'] = "reports_management";
		$this -> load -> view("template", $data);
	}

	public function tem() {
		$facility_code = $this -> session -> userdata('news');
		$data['title'] = "Stock Report";
		$data['category'] = Drug_Category::getAll();
		$data['service_p'] = Service::getall($facility_code);
		$data['content_view'] = "test";
		$data['banner_text'] = "Stock Report";
		$data['link'] = "reports_management";
		$this -> load -> view("template", $data);
	}

	public function get_drug_names() {
		//for ajax
		$district = $_POST['category_id'];
		$facilities = Drug::get_drug_name_by_category($district);
		$list = "";
		foreach ($facilities as $facilities) {
			$list .= $facilities -> Kemsa_Code;
			$list .= "*";
			$list .= $facilities -> Drug_Name;
			$list .= "_";
		}
		echo $list;
	}

	public function commodity_search() {
		$data['title'] = "Commodity List";
		$data['content_view'] = "new_order_v2";
		$data['banner_text'] = "Commodity List";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "commodity_list";
		$this -> load -> view("template", $data);
	}

	public function commodity_list() {

		$data['title'] = "Commodity Search";
		$data['content_view'] = "shared_files/commodity_list";
		$data['banner_text'] = "Commodity List";
		$data['drug_categories'] = Drug::getAll();
		$this -> load -> view("template", $data);
	}

	public function reports_Home() {

		$data['title'] = "Reports Home";
		$data['quick_link'] = "Reports";
		$data['content_view'] = "reportsmain";
		$data['drugs'] = Drug::getAll();
		$data['link'] = "raw_data";
		$data['banner_text'] = "Reports";
		$data['link'] = "Reports";
		$this -> load -> view("template", $data);
	}

	public function division_reports() {
		$data['title'] = "Division Reports";
		$data['quick_link'] = "Reports";
		$data['content_view'] = "district/district_report/divisionreports_v";
		$data['banner_text'] = "Division Reports";
		$data['link'] = "Reports";
		$this -> load -> view("template", $data);
	}

	public function consum_v() {//New
		$data['title'] = "Stock Control Card";
		$data['drugs'] = Drug::getAll();
		$data['content_view'] = "stockcontrolC";
		$data['banner_text'] = "Stock Control Card";
		$data['link'] = "order_management";
		$data['quick_link'] = "facility_consumption";
		$this -> load -> view("template", $data);
	}

	public function malaria_report() {
		$facilityCode = $this -> session -> userdata('news');
		//New
		$current_year = date('Y');
		$current_month = date('F');
		$id = $this -> session -> userdata('identity');
		$data['title'] = "Monthly Summary Report for the Division of Malaria Control";
		$data['content_view'] = "facility/malaria_report_v";
		$data['banner_text'] = "Division of Malaria Control Report";
		$data['link'] = "order_management";
		$data['quick_link'] = "facility_consumption";
		$this -> load -> view("template", $data);
	}

	public function dist_malaria_report() {
		$this -> load -> view("district/district_report/malaria_report_v");
	}

	public function dist_contraceptives_consumption_report() {
		$this -> load -> view("district/district_report/facility_contraceptives_v");
	}

	public function get_malaria_report_pdf($reportType) {
		$facilityCode = $this -> session -> userdata('news');
		$current_year = date('Y');
		$current_month = date('F');
		$current_monthdigit = date('m');
		$id = $this -> session -> userdata('identity');
		$report_name = 'Division of Malaria Control Report for ' . $current_month . ' ' . $current_year;
		$title = 'Monthly Summary Report for the Division of Malaria Control';

		$html_data = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';

		$html_data1 = '';
		/*****************************setting up the report*******************************************/
		$html_data1 .= '<table class="data-table" border=1><thead>
			<tr>		
				<th style = "font-size: 12px"><strong>Data Element</strong></th>
				<th style = "font-size: 12px"><strong>Beginning Balance</strong></th>
				<th style = "font-size: 12px"><strong>Quantity Received this Period</strong></th>
				<th style = "font-size: 12px"><strong>Total Quantity Dispensed</strong></th>
				<th style = "font-size: 12px"><strong>Losses (Excluding Expiries)</strong></th>
				<th style = "font-size: 12px"><strong>Positive Adjustments</strong></th>				
				<th style = "font-size: 12px"><strong>Negative Adjustments</strong></th>
				<th style = "font-size: 12px"><strong>Physical Count</strong></th>
				<th style = "font-size: 12px"><strong>Quantity of Expired Drugs</strong></th>
				<th style = "font-size: 12px"><strong>Medicines with 6 Months to Expiry</strong></th>
				<th style = "font-size: 12px"><strong>Days Out of Stock</strong></th>
				<th style = "font-size: 12px"><strong>Total</strong></th>			

</tr></thead><tbody>';

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT f.facility_code,  f.kemsa_code,  d.id,  d.drug_name, d.unit_cost, f.cycle_date, f.opening_balance, f.total_receipts, f.total_issues, f.closing_stock, f.days_out_of_stock, f.adj, f.losses
FROM  facility_transaction_table f
INNER JOIN  drug d ON  d.id =  f.kemsa_code
WHERE d.drug_name LIKE  '%Artemether%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR d.drug_name LIKE  '%Quinine%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR d.drug_name LIKE  '%Artesunate%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR  d.drug_name LIKE  '%Sulfadoxine%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
ORDER BY  d.drug_name ASC ");
		$results = count($query);
		if ($results > 0) {

			for ($got = 0; $got < $results; $got++) {
				$unitCost = 0.00;
				$drugID = $query[$got]['kemsa_code'];
				switch($drugID) {
					case '41' :
						$unitCost = 575.00;
						break;
					case '58' :
						$unitCost = 1534.5;
						break;
					case '25' :
						$unitCost = 4444.00;
						break;
					case '1' :
					case '2' :
					case '3' :
					case '4' :
						$unitCost = 0.01;
						break;
				}
				$dataElement = $query[$got]['drug_name'];
				$bBalance = $query[$got]['opening_balance'] * $unitCost;
				$qReceived = $query[$got]['total_receipts'] * $unitCost;
				$qDispensed = $query[$got]['total_issues'] * $unitCost;
				$losses = $query[$got]['losses'] * $unitCost;
				$posAdjustments = $query[$got]['adj'] * $unitCost;
				$negAdjustments = 0 * $unitCost;
				$physicalCount = $query[$got]['closing_stock'] * $unitCost;
				$quantityOfExp = 0 * $unitCost;
				$medsAboutToExp = 0 * $unitCost;
				$daysOutOfStock = 0;
				$total = 0;

				$html_data1 .= '<tr><td>' . $dataElement . '</td>
				<td>' . $bBalance . '</td>
				<td>' . $qReceived . '</td>
				<td>' . $qDispensed . '</td>
				<td>' . $losses . '</td>
				<td >' . $posAdjustments . '</td>
				<td >' . $negAdjustments . '</td>
				<td>' . $physicalCount . '</td>
				<td >' . $medsAboutToExp . '</td>
				<td >' . $quantityOfExp . '</td>
				<td >' . $daysOutOfStock . '</td>
				<td >' . $total . '</td>
				</tr>';
			}
		}

		$html_data1 .= '</tbody></table>';
		$html_data .= $html_data1;

		$report_type = $reportType;
		switch ($report_type) {
			case 'excel' :
				$this -> generate_malaria_excel($report_name, $title, $html_data);
				break;
			case 'pdf' :
				$this -> generate_malaria_pdf($report_name, $title, $html_data, $report_type, $current_month, $current_year);
				break;
		}
	}

	public function generate_malaria_excel($r_name, $title, $data) {

		$filename = $r_name;
		header("Content-type: application/excel");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo "$data";
	}

	public function generate_malaria_pdf($r_name, $title, $data, $display_type, $current_month, $current_year) {
		$current_year = date('Y');
		$current_month = date('F');
		$facility_code = $this -> session -> userdata('news');
		$facility_name_array = Facilities::get_facility_name($facility_code) -> toArray();
		$facility_name = $facility_name_array['facility_name'];
		$districtName = $this -> session -> userdata('full_name');

		/********************************************setting the report title*********************/

		$html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold;'>Monthly Summary Report for the Division of Malaria Control</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $districtName . " District</h2>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $current_month . " " . $current_year . "</h2>
       <hr />   ";

		$css_path = base_url() . 'CSS/style.css';

		/**********************************initializing the report **********************/
		$this -> load -> library('mpdf');
		$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
		$this -> mpdf -> SetTitle($title);
		$this -> mpdf -> WriteHTML($html_title);
		$this -> mpdf -> simpleTables = true;
		$this -> mpdf -> WriteHTML('<br/>');
		$this -> mpdf -> WriteHTML($data);
		$report_name = $r_name . ".pdf";
		$this -> mpdf -> Output($report_name, 'D');
	}

	public function Contraceptives_Report() {//New
		$data['title'] = "Contraceptives Consumption";
		//$data['drugs'] = Drug::getAll();
		$data['content_view'] = "facility/contraceptives_consumption_v";
		$data['banner_text'] = "Division of Reproductive Health - Contraceptives Consumption Report";
		$data['link'] = "order_management";
		$data['quick_link'] = "facility_consumption";
		$this -> load -> view("template", $data);
	}

	public function Contraceptives_Report_pdf($reportType) {
		$report_name = "Division of Reproductive Health - Division of Reproductive Health Report";
		$title = "Division of Reproductive Health Report";
		$html_data1 = '';

		$html_data1 = "<table border=1><tbody>
					<tr>
						<th><b>Contraceptive</b></th>
						<th><b>Beginning Balance</b></th>
						<th><b>Received This Month</b></th>
						<th><b>Dispensed</b></th>
						<th><b>Losses</b></th>
						<th><b>Adjustments</b></th>
						<th><b>Ending Balance</b></th>	
						<th><b>Quantity Requested</b></th>
								    
					</tr>
					<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
											    
					</tr>
					
					<tr>
						<th><b>Progestin Only Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
													    
					</tr>
					<tr>
						<th><b>Injectables</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Implants(1-rod)</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Implants(2-rod)</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					
					<tr>
						<th><b>Emergency Contraceptive Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
												    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Male Condoms</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Female Condoms</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
												    
					</tr>
					
					<tr>
						<th><b>Standard Days Method (SDM) Cycle Beads</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
													    
					</tr>
					<tr>
						<th><b>Others</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
													    
					</tr>
					
					";
		$html_data1 .= '</tbody></table>';
		$html_data = $html_data1;
		$report_type = $reportType;
		switch ($report_type) {
			case 'excel' :
				$this -> generate_contraceptives_report_excel($report_name, $title, $html_data);
				break;
			case 'pdf' :
				$this -> generate_contraceptive_report_pdf($report_name, $title, $html_data);
				break;
		}

	}

	public function generate_contraceptive_report_pdf($report_name, $title, $html_data) {
		$current_year = date('Y');
		$current_month = date('F');
		$facility_code = $this -> session -> userdata('news');
		$facility_name_array = Facilities::get_facility_name($facility_code) -> toArray();
		$facility_name = $facility_name_array['facility_name'];
		//if ($display_type == "Download PDF") {

		/********************************************setting the report title*********************/

		$html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold;'>Division of Reproductive Health Report</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $current_month . " " . $current_year . "</h2>
       <hr />   ";

		$css_path = base_url() . 'CSS/style.css';

		/**********************************initializing the report **********************/
		$this -> load -> library('mpdf');
		$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
		//$stylesheet = file_get_contents("$css_path");
		//$this->mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$this -> mpdf -> SetTitle($title);
		$this -> mpdf -> WriteHTML($html_title);
		$this -> mpdf -> simpleTables = true;
		$this -> mpdf -> WriteHTML('<br/>');
		$this -> mpdf -> WriteHTML($html_data);
		$reportname = $report_name . ".pdf";
		$this -> mpdf -> Output($reportname, 'D');

	}

	public function generate_contraceptives_report_excel($report_name, $title, $html_data) {
		$data = $html_data;
		$filename = $report_name;
		header("Content-type: application/excel");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo "$data";

	}

	public function Contraceptives_Consumption() {//New
		$data['title'] = "Contraceptives Consumption";
		//$data['drugs'] = Drug::getAll();
		$data['content_view'] = "facility/facility_contraceptives_v";
		$data['banner_text'] = "Division of Reproductive Health - D-CDRR";
		$data['link'] = "order_management";
		$data['quick_link'] = "facility_consumption";
		$this -> load -> view("template", $data);
	}

	public function Contraceptives_Consumption_pdf($reportType) {
		$report_name = "Division of Reproductive Health - D-CDRR";
		$title = "Contraceptives Consumption Data Report and Request Form(D-CDRR)";
		$html_data = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';

		$html_data1 = '';

		/*****************************setting up the report*******************************************/
		$html_data1 .= '<table class="data-table" border=1><tbody>
			<tr > 		
						<th><b>Programme</b></th>
						<th colspan = "3"><b>Family Planning</b></th>			
						<th colspan = "9"></th>
										    
					</tr>
<tr > 		
						<th><b>Name of District Store:</b></th>
						<th colspan = "4"><b></b></th>					
						
						<th><b>District:</b></th>
						<th colspan = "2"><b></b></th>
							
						<th><b>Province:</b></th>
						<th colspan = "4"><b></b></th>
							
										    
					</tr>
<tr > 		
						<th><b>Period of Reporting:</b></th>
						<th><b> Beginning:</b></th>
						<th colspan = "3"><b></b></th>					
						
						<th><b>Ending:</b></th>
						<th colspan = "7"><b></b></th>							
						
						</tr>
<tr > 		
						<th colspan="2"><b></b></th>
						<th colspan = "2"><b>(Day/Month/Year)</b></th>					
						<th colspan="2"></th>
						<th colspan = "2"><b>(Day/Month/Year)</b></th>						
						<th colspan="5"><b></b></th>
						</tr>
	<tr > 		
						<th><b>Contraceptive Name</b></th>
						<th><b>Unit of Issue</b></th>
						<th><b>Beginning Balance</b></th>
						<th><b>Quantity Received This Month</b></th>
						<th><b>Quantity Issued to facilities</b></th>
						<th><b>Losses</b></th>
						<th><b>Adjustments</b></th>
						<th><b>Ending Balance</b></th>	
						<th><b>Aggregated SDPs Quantity Dispensed</b></th>
						<th><b>Aggregated SDPs Ending Balance</b></th>
						<th><b>Quantity Requested for District Store</b></th>	
						<th><b>Quantity Requested (Aggregate SDP Qty Requested)</b></th>
						<th><i>Average MOS</i></th>				    
					</tr>
					<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th>Cycles</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					
					<tr>
						<th><b>Progestin Only Pills</b></th>
						<th>Cycles</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>Injectables</b></th>
						<th>Vials</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Implants(1-rod)</b></th>
						<th>Sets</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Implants(2-rod)</b></th>
						<th>Sets</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					
					<tr>
						<th><b>Emergency Contraceptive Pills</b></th>
						<th>Doses</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>	
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th>Sets</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Male Condoms</b></th>
						<th>Pieces</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Female Condoms</b></th>
						<th>Pieces</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>	
						<th>0</th>				    
					</tr>
					
					<tr>
						<th><b>Standard Days Method (SDM) Cycle Beads</b></th>
						<th>Cycles</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>Others</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						
						<th>0</th>				    
					</tr>
<tr>
						<th colspan = "10"><b>SERVICE STATISTICS</b></th>
								<th></th>
								<th></th>
						<th></th>		    
					</tr>
<tr>
						<th><b></b></th>
						<th colspan = "2"><b>Aggregate Clients	</b></th>
						<th colspan = "2"><b>Aggregate Change of Method</b></th>
						<th colspan="4"></th>
						<th><b>Natural FP Counseling</b></th>
						<th></th>
						<th colspan="2"></th>									    
					</tr>
<tr>
						<th></th>
						<th ><b>New	</b></th>
						<th><b>Revisits</b></th>
						<th ><b>From</b></th>
						<th><b>To</b></th>
						<th colspan="4"></th>						
						<th><b>Natural FP Referrals</b></th>
						<th></th>	
						<th colspan="2"></th>		    
					</tr>
<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>								    
					</tr>
					<tr>
						<th><b>Progestin only pills</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>HIV Counselling & Testing</b></th>
						<th colspan="2">Known HIV status</th>
						<th colspan="3"></th>	
					</tr>
	<tr>
						<th><b>Injectables</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><b>Counseled & Tested</b></th>
						<th><b>Referred for Counseling & Testing</b></th>	
						<th><b>1</b></th>
						<th><b>2</b></th>
						<th colspan="3"></th>	
															    
					</tr>
					<tr>
						<th><b>Implants</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th colspan="3"></th>	
						
										    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Sterilisation</b></th>	
						<th colspan="4"></th>  
					</tr>
<tr>
						<th><b>Male Condoms</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Males</b></th>	
						<th></th>
						<th colspan="3"></th>	
							    
					</tr>
	<tr>
						<th><b>Female Condoms</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Females</b></th>	
						<th></th>
						<th colspan="3"></th>
										    
					</tr>
					<tr>
						<th><b>Standard Days Method (SDM)</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Referrals</b></th>	
						<th></th>
						<th colspan="3"></th>
										    
					</tr>
					<tr>
						<th colspan = "13"></th>
								    
					</tr>
					<tr>
						<th colspan="3"><b>SDP Reporting Rates</b></th>
						<th colspan="4"></th>
						<th colspan="2"><b>Cases for Emergency Pills</b></th>	
						<th></th>
						<th colspan="3"></th>										    
					</tr>
<tr>
						<th><b>Total Expected</b></th>
						<th ><b>Total Reported</b></th>
						<th><b>Reporting Rate</b></th>
						<th colspan="10"></th>						    
					</tr>
<tr>
						<th></th>
						<th ></th>
						<th><b>0%</b></th>
						<th colspan="10"></th>	
										    
					</tr>
					<tr><th colspan = "13"><b></b></th></tr>
			<tr>
						<th><b>Orders for Data</b></th>
						<th >DAR</th>
						<th></th>
						<th>SDP-CDRR</th>
						<th>DS-CDRR</th>
						<th colspan="8"></th>
						
										    
					</tr>
<tr>
						<th><b>Collection or</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>
										    
					</tr>
	<tr>
						<th><b>Reporting tool</b></th>
						<th ><b>100 page</b></th>
						<th ><b>300 page</b></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>
										    
					</tr>
<tr>
						<th><b>Quantity requested</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					<th colspan="8"></th>
						</tr>
		    <tr><th colspan = "13"></th></tr>
		    <tr>
						<th colspan="13"><b>Comments (On Commodity logistics and clinical issues, including explanation of Losses & Adjustments):</b></th>
						</tr>
						<tr>
						<th height="100px" colspan="13"></th>
						</tr>
					 <tr><th colspan = "13"></th></tr>
					 <tr>
						<th><b>Report submitted by: </b></th>
						<th colspan="3"></th>
						<th></th>
						<th colspan="2"></th>
						<th></th>
						<th colspan="2"></th>
						<th colspan="3"></th>
						
						</tr>
		<tr>
						<th></th>
						<th colspan="3">Head of the Health facility / SDP / Institution</th>
						<th></th>
						<th colspan="2">Designation</th>
						<th></th>
						<th colspan="2">Date</th>
						<th colspan="3"></th>
						</tr>
		<tr>
						<th><b>Report reviewed by:</b></th>
						<th colspan="3"></th>
						<th></th>
						<th colspan="2"></th>
						<th></th>
						<th colspan="2"></th>
						<th colspan="3"></th>
						</tr>
<tr>
						<th></th>
						<th colspan="3">Name of Reporting officer</th>
						<th></th>
						<th colspan="2">Designation</th>
						<th></th>
						<th colspan="2">Date</th>
						<th colspan="3"></th>
						</tr>
		';
		$html_data1 .= '</tbody></table>';
		$html_data .= $html_data1;
		$report_type = $reportType;
		switch ($report_type) {
			case 'excel' :
				$this -> generate_contraceptives_consumption_excel($report_name, $title, $html_data);
				break;
			case 'pdf' :
				$this -> generate_contraceptives_consumption_pdf($report_name, $title, $html_data);
				break;
		}

	}

	public function generate_contraceptives_consumption_pdf($report_name, $title, $html_data) {
		$current_year = date('Y');
		$current_month = date('F');
		$facility_code = $this -> session -> userdata('news');
		$facility_name_array = Facilities::get_facility_name($facility_code) -> toArray();
		$facility_name = $facility_name_array['facility_name'];
		$districtName = $this -> session -> userdata('full_name');
		//if ($display_type == "Download PDF") {

		/********************************************setting the report title*********************/

		$html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold;'>Contraceptives Consumption Data Report and Request Form(D-CDRR)</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $districtName . " District</h2>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $current_month . " " . $current_year . "</h2>
       <hr />   ";

		$css_path = base_url() . 'CSS/style.css';

		/**********************************initializing the report **********************/
		$this -> load -> library('mpdf');
		$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
		//$stylesheet = file_get_contents("$css_path");
		//$this->mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$this -> mpdf -> SetTitle($title);
		$this -> mpdf -> WriteHTML($html_title);
		$this -> mpdf -> simpleTables = true;
		$this -> mpdf -> WriteHTML('<br/>');
		$this -> mpdf -> WriteHTML($html_data);
		$reportname = $report_name . ".pdf";
		$this -> mpdf -> Output($reportname, 'D');
	}

	public function generate_contraceptives_consumption_excel($report_name, $title, $html_data) {
		$data = $html_data;
		$filename = $report_name;
		header("Content-type: application/excel");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo "$data";

	}

	//all the order reports to be generated
	public function order_report() {
		/****************************8get the facility code***************************************************/
		$facility_code = $this -> session -> userdata('news');
		$from_ordertbl = Ordertbl::get_facilitiy_orders($facility_code);
		//setting up the variables
		$total_item_received = 0;
		$total_item_ordered = 0;
		$order_fill_rate = 0;
		/****************************create a loop to fetch a facilities order details ***************/
		foreach ($from_ordertbl as $infor_array) {

			foreach ($infor_array->Ord as $Ord_array) {
				//giving the variables data
				$o_q = $Ord_array -> quantityOrdered;
				$total_item_ordered = $total_item_ordered + $o_q;
				$o_qr = $Ord_array -> quantityRecieved;
				$total_item_received = $total_item_received + $o_qr;

			}
			if ($total_item_ordered == 0) {$total_item_ordered = 1;
			}
			$order_fill_rate = ($total_item_received / $total_item_ordered) * 100;
		}
		//Create an XML data document in a string variable
		$strXML = "";
		$strXML1 = "";
		$strXML .= "<chart bgAlpha='0' lowerLimit='0' upperLimit='100' numberSuffix='%25' showBorder='0' basefontColor='#8B8989' chartTopMargin='25' chartBottomMargin='25' chartLeftMargin='25' chartRightMargin='25' toolTipBgColor='80A905'  gaugeFillRatio='3'>";
		$strXML .= "<colorRange><color minValue='0' maxValue='45' code='FF654F'/><color minValue='45' maxValue='80' code='F6BD0F'/><color minValue='80' maxValue='100' code='8BBA00'/></colorRange>";
		$strXML .= "<dials><dial value='" . $order_fill_rate . "' rearExtension='10'/></dials>";
		$strXML .= "<trendpoints><point value='50' displayValue='Order Fill Rate' fontcolor='FF4400' useMarker='1' dashed='1' dashLen='2' dashGap='2' valueInside='1' /></trendpoints>";
		$strXML .= "<annotations><annotationGroup id='Grp1' showBelow='1' ><annotation type='rectangle' x='5' y='5' toX='345' toY='195' radius='10' color='#F0ECEC' showBorder='1' /></annotationGroup></annotations>";
		$strXML .= "<styles><definition><style name='RectShadow' type='shadow' strength='3'/></definition><application><apply toObject='Grp1' styles='RectShadow' /></application></styles>";
		$strXML .= "</chart>";

		/**********************************************/
		$strXML1 .= "<chart lowerLimit='0' upperLimit='100' lowerLimitDisplay='Good' upperLimitDisplay='Bad' palette='1' chartRightMargin='20'>";
		$strXML1 .= "<colorRange><color minValue='0' maxValue='15'  code='8BBA00' label='Good'/><color minValue='16' maxValue='44' code='F6BD0F' label='Moderate'/><color code='FF654F'minValue='45' maxValue='100'  label='BAD'/></colorRange>";
		$strXML1 .= "<pointers><pointer value='92' /></pointers>";
		$strXML1 .= '</chart>';

		$data['strXML'] = $strXML;
		$data['strXML1'] = $strXML1;
		$data['title'] = "Order Report";
		$data['content_view'] = "facility/order_report";
		$data['banner_text'] = "Orders Report";
		$data['link'] = "order_management";
		$data['quick_link'] = "stock_level";
		$this -> load -> view("template", $data);
	}

	//generate order report
	public function generate_order_report() {
		$data_type = $_POST['type_of_data'];
		$duration = $_POST['duration'];
		$year = $_POST['year_from'];
		$report_type = $_POST['type_of_report'];
		$title = 'test';
		$report_name = "Order Report For" . $year;
		$facility_code = $this -> session -> userdata('news');
		$from_ordertbl = Ordertbl::get_facilitiy_orders($facility_code);
		$facility_name = Facilities::get_facility_name($facility_code);

		/**************************************set the style for the table****************************************/

		$html_data = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>';

		//create the report based on the request of the user
		/**********bug detected mpdf cannot print a report that has nesteded loops the solution is to create the html body before creating the mpdf object****/
		$html_data1 = '';
		// order analysis
		$html_data2 = '';
		// raw order details

		foreach ($from_ordertbl as $infor_array) {
			//setting up the variables
			$total_item_received = 0;
			$total_item_ordered = 0;
			$date = $infor_array -> orderDate;
			$draw = $infor_array -> drawing_rights;
			$total = $infor_array -> orderTotal;
			$bal = number_format($draw - $total, 2, '.', ',');

			/*****************************setting up the report*******************************************/

			$html_data1 .= '<table class="data-table"><thead>
<tr><td colspan="16"><p style="font-weight: bold;">Facility Order No: ' . $infor_array -> id . ' | KEMSA Order No: ' . $infor_array -> kemsaOrderid . ' | Order Date:' . $date . ' | Order Total: ' . number_format($total, 2, '.', ',') . ' | Drawing rights: ' . number_format($draw, 2, '.', ',') . ' | 
Balance(Drawing rights - Order Total):' . $bal . ' </p></span></td></tr>
<tr> <th><strong>KEMSA Code</strong></th><th><strong>Description</strong></th><th><strong>Quantity Ordered</strong></th><th><strong>Unit Cost</strong></th><th class="col5" ><strong><b>Total Cost</b></strong></th>
<th><strong>Quantity Ordered</strong></th><th><strong>Quantity Received</strong></th><th class="col5" ><strong><b>Fill rate</b></strong></th>
<th><strong><b>Opening Balance</b></strong></th>
<th><strong><b>Total Receipts</b></strong></th>
<th><strong><b>Total Issues</b></strong></th>
<th><strong><b>ADJ</b></strong></th>
<th><strong><b>Losses</b></strong></th>
<th><strong><b>Closing Stock</b></strong></th>
<th><strong><b>Days Out Of stock</b></strong></th>
<th><strong><b>Comment</b></strong></th>
</tr> </thead><tbody>';

			/***********************************************************************************************/
			$html_data2 .= '<table class="data-table"><thead>
<tr><td colspan="16"><p style="font-weight: bold;">Facility Order No: ' . $infor_array -> id . ' | KEMSA Order No: ' . $infor_array -> kemsaOrderid . ' | Order Date:' . $date . ' | Order Total: ' . number_format($total, 2, '.', ',') . ' | Drawing rights: ' . number_format($draw, 2, '.', ',') . ' | 
Balance(Drawing rights - Order Total):' . $bal . ' </p></span></td></tr>
<tr> <th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Order Unit Size</b></th>
						<th><b>Order Unit Cost</b></th>
						<th ><b>Opening Balance</b></th>
						<th ><b>Total Receipts</b></th>
					    <th><b>Total issues</b></th>
					    <th><b>Adjustments</b></th>
					    <th><b>Losses</b></th>
					    <th><b>Closing Stock</b></th>
					    <th><b>No days out of stock</b></th>
					    <th><b>Order Quantity</b></th>
					    <th><b>Order cost(Ksh)</b></th>	
					   <th><b>Comment(if any)</b></th>	
</tr> </thead><tbody>';

			/*****************************creating the rows **************************************/

			foreach ($infor_array->Ord as $Ord_array) {
				//setting the variables
				$o_q = $Ord_array -> quantityOrdered;
				$total_item_ordered = $total_item_ordered + $o_q;
				$o_p = $Ord_array -> price;
				$o_t = number_format($o_p * $o_q, 2, '.', ',');
				$o_qr = $Ord_array -> quantityRecieved;
				$total_item_received = $total_item_received + $o_qr;
				$fill = ($o_qr / $o_q) * 100;

				/*******************************begin adding data to the report*****************************************/
				$html_data1 .= '<tr><td>' . $Ord_array -> kemsa_code . '</td>';
				$html_data2 .= '<tr><td>' . $Ord_array -> kemsa_code . '</td>';
				foreach ($Ord_array->Code as $d) {
					$name = $d -> Drug_Name;
					$html_data1 .= '<td>' . $name . '</td>';
					/*********************************************************************************************/
					$html_data2 .= '<td>' . $name . '</td><td>' . $d -> Unit_Size . '</td><td>' . $o_p . '</td>';
				}
				$html_data1 .= '<td>' . $o_q . '</td>
							<td>' . $o_p . '</td>
							<td class="col5">' . $o_t . '</td>
							<td>' . $o_q . '</td>
							<td>' . $o_qr . '</td>
							<td class="col5">' . $fill . '%' . '</td>
							<td>' . $Ord_array -> o_balance . '</td>
							<td >' . $Ord_array -> t_receipts . '</td>
							<td >' . $Ord_array -> t_issues . '</td>
							<td >' . $Ord_array -> adjust . '</td>
							<td >' . $Ord_array -> losses . '</td>
							<td >' . $Ord_array -> c_stock . '</td>
							<td >' . $Ord_array -> days . '</td>
							<td >' . $Ord_array -> comment . '</td>
							</tr>';
				/****************************************************************************************************************/
				$html_data2 .= '<td>' . $Ord_array -> o_balance . '</td>
							<td>' . $Ord_array -> t_receipts . '</td>
							<td >' . $Ord_array -> t_issues . '</td>
							<td>' . $Ord_array -> adjust . '</td>
							<td>' . $Ord_array -> losses . '</td>
							<td >' . $Ord_array -> c_stock . '</td>
							<td>' . $Ord_array -> days . '</td>
							<td >' . $o_q . '</td>
							<td class="col5">' . $o_t . '</td>
							<td >' . $Ord_array -> comment . '</td>
							</tr>';
			}
			if ($total_item_ordered == 0) {$total_item_ordered = 1;
			}
			$order_fill_rate = ($total_item_received / $total_item_ordered) * 100;

			//close the table
			$html_data1 .= '<tr><td colspan="16"> <b>Total Items Received: ' . $total_item_received . ' | Total Items Ordered : ' . $total_item_ordered . '|    Order Fill Rate(Total items received/Total Items Ordered)*100 :' . $order_fill_rate . ' %</td></tr></tbody></table></b><hr /></br></br>';
			$html_data2 .= '</tbody></table></b><hr /></br></br>';
		}

		if ($data_type == 'Order Analysis') {
			$html_data .= $html_data1;
		} else if ($data_type == 'Raw Order Data') {
			$html_data .= $html_data2;
		}

		/**************************finally generate the report***********************/

		$this -> generate_pdf($report_name, $title, $html_data, $report_type);

	}

	//generate pdf
	public function generate_pdf($r_name, $title, $data, $display_type) {

		$facility_code = $this -> session -> userdata('news');
		$facility_name_array = Facilities::get_facility_name($facility_code) -> toArray();
		$facility_name = $facility_name_array['facility_name'];

		if ($display_type == "Download PDF") {

			/********************************************setting the report title*********************/

			$html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>$title</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr /> 
        <span><p style='font-weight: bold;'>MFL CODE: " . $facility_code . "</p><p style='font-weight: bold;'> FACILITY NAME: " . $facility_name . "</p>
          ";

			/**********************************initializing the report **********************/
			$this -> load -> library('mpdf');
			$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
			$this -> mpdf -> SetTitle($title);
			$this -> mpdf -> WriteHTML($html_title);
			$this -> mpdf -> simpleTables = true;
			$this -> mpdf -> WriteHTML('<br/>');
			$this -> mpdf -> WriteHTML($data);
			$report_name = $r_name . ".pdf";
			$this -> mpdf -> Output($report_name, 'D');

		} else if ($display_type == "View Report") {

			$html_title = '<link href="' . base_url() . 'CSS/style.css" type="text/css" rel="stylesheet"/> 
		<div class="logo"><a class="logo" ></a> </div>
		 <div id="system_title">
		<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Public Health and Sanitation/Ministry of Medical Services</span>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span>
		</div>
		</div>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span><span style="text-align:center;" ><hr /> 
        <span><p style="font-weight: bold;">MFL CODE: ' . $facility_code . '</p><p style="font-weight: bold;"> FACILITY NAME: ' . $facility_name . '</p>';

			echo $html_title . $data;
		}

	}

	/***************************MOH DASHBORD ************************/
	function moh_consumption_report() {
		if ($this -> input -> post('id')) {
			$data['name'] = $this -> input -> post('ajax');
			$year = date("Y");
			$drug_id = $this -> input -> post('id');
			$data['detail'] = Facility_Issues::get_consumption_per_drug($drug_id, $year);
			$district = $this -> session -> userdata('district1');
			$data['facilities'] = Facilities::getFacilities($district);

			$this -> load -> view("moh/ajax_reports/test", $data);
		}

	}

	function moh_category_consumption_report() {

		if ($this -> input -> post('id')) {
			$data['name'] = $this -> input -> post('ajax');
			$this -> load -> view("moh/ajax_reports/consumption_category", $data);
		}

	}

	public function generate_costofexpiries_chart($option = NULL, $location_id = NULL, $year = NULL) {
		$district = $this -> session -> userdata('district');
		$county_id = $this -> session -> userdata('county_id');

		switch ($option) {
			case 'county' :
				$commodity_array = Facility_Stock::get_county_cost_of_exipries($county_id, $year);

				$county_name = counties::get_county_name($county_id);
				$title = $county_name[0]["county"] . " County";

				$detail = $commodity_array;
				// print_r($detail);
				break;

			default :
				$commodity_array = Facility_Stock::get_district_cost_of_exipries($district);
				$detail = $commodity_array;
				break;
		}

		//exit;

		$strXML = "<chart formatNumberScale='0'
	    lineColor='000000' lineAlpha='40' showValues='1' rotateValues='1' valuePosition='auto'
	     palette='1' xAxisName='Months' yAxisName='Cost of Commodities (KES)' yAxisMinValue='15000' showValues='0'  useRoundEdges='1' alternateHGridAlpha='20' divLineAlpha='50' canvasBorderColor='666666' canvasBorderAlpha='40' baseFontColor='666666' lineColor='AFD8F8' chartRightMargin = '0' showBorder='0' bgColor='FFFFFF'>";

		$temp_array = array();
		foreach ($detail as $data) :
			$temp_array = array_merge($temp_array, array($data["cal_month"] => $data['total']));

		endforeach;

		for ($i = 1; $i < 13; $i++) {

			switch ($i) {
				case 1 :
					if (array_key_exists('Jan', $temp_array)) {
						$val = $temp_array['Jan'];
						$strXML .= "<set label='Jan' value='$val' />";

					} else {
						$val = 0;
						$strXML .= "<set label='Jan' value='$val' />";
					}

					break;
				case 2 :
					if (array_key_exists('Feb', $temp_array)) {
						$val = $temp_array['Feb'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Feb' value='$val' />";
					break;
				case 3 :
					if (array_key_exists('Mar', $temp_array)) {
						$val = $temp_array['Mar'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Mar' value='$val' />";
					break;
				case 4 :
					if (array_key_exists('Apr', $temp_array)) {
						$val = $temp_array['Apr'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Apr' value='$val' />";
					break;
				case 5 :
					if (array_key_exists('May', $temp_array)) {
						$val = $temp_array['May'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='May' value='$val' />";
					break;
				case 6 :
					if (array_key_exists('Jun', $temp_array)) {
						$val = $temp_array['Jun'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Jun' value='$val' />";
					break;
				case 7 :
					if (array_key_exists('Jul', $temp_array)) {
						$val = $temp_array['Jul'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Jul' value='$val' />";
					break;
				case 8 :
					if (array_key_exists('Aug', $temp_array)) {
						$val = $temp_array['Aug'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Aug' value='$val' />";
					break;
				case 9 :
					if (array_key_exists('Sep', $temp_array)) {
						$val = $temp_array['Sep'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Sep' value='$val' />";
					break;
				case 10 :
					if (array_key_exists('Oct', $temp_array)) {
						$val = $temp_array['Oct'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Oct' value='$val' />";
					break;
				case 11 :
					if (array_key_exists('Nov', $temp_array)) {
						$val = $temp_array['Nov'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Nov' value='$val' />";
					break;
				case 12 :
					if (array_key_exists('Dec', $temp_array)) {
						$val = $temp_array['Dec'];

					} else {
						$val = 0;
					}
					$strXML .= "<set label='Dec' value='$val' />";
					break;
			}
		}

		$strXML .= "<styles>
<definition>
<style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/>
<style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/>
<style name='DataShadow' type='Shadow' alpha='40'/>
</definition>
<application>
<apply toObject='DIVLINES' styles='Anim1'/>
<apply toObject='HGRID' styles='Anim2'/>
<apply toObject='DATALABELS' styles='Anim2'/>
</application>
</styles>
</chart>";
		echo $strXML;

	}

	public function generate_costofordered_chart() {
		$district = $this -> session -> userdata('district1');
		$year = date("Y");

		$orderDetails = Ordertbl::get_district_ordertotal($district);
		$rowcountname = count($orderDetails);
		$arrayQ1 = array();
		$arrayQ2 = array();
		$arrayQ3 = array();
		$arrayQ4 = array();
		for ($i = 0; $i < $rowcountname; $i++) {

			if ($orderDetails[$i]["month"] >= 1 && $orderDetails[$i]["month"] <= 3) {
				$arrayQ2[] = (int)$orderDetails[$i]["OrderTotal"];

			} elseif ($orderDetails[$i]["month"] >= 4 && $orderDetails[$i]["month"] <= 6) {
				$arrayQ3[] = (int)$orderDetails[$i]["OrderTotal"];

			} elseif ($orderDetails[$i]["month"] >= 7 && $orderDetails[$i]["month"] <= 9) {
				$arrayQ4[] = (int)$orderDetails[$i]["OrderTotal"];
			} else
				$arrayQ1[] = (int)$orderDetails[$i]["OrderTotal"];
		}
		$Q1 = array_sum($arrayQ1);
		$Q2 = array_sum($arrayQ2);
		$Q3 = array_sum($arrayQ3);
		$Q4 = array_sum($arrayQ4);
		//exit;

		$strXML = "<chart palette='1' lineColor='FF5904' lineAlpha='85' showValues='1' rotateValues='1' valuePosition='auto' xAxisName='Months' yAxisName='Cost of Orders (KES)' yAxisMinValue='15000' showValues='0' useRoundEdges='1' alternateHGridAlpha='20' divLineAlpha='50' canvasBorderColor='666666' canvasBorderAlpha='40' baseFontColor='666666' lineColor='AFD8F8' chartRightMargin = '60' showBorder='0' bgColor='FFFFFF'>
<set label='Oct-Dec (" . ($year - 1) . ")' value='" . $Q1 . "'/>
<set label='Jan-Mar (" . $year . ")' value='" . $Q2 . "'/>
<set label='Apr-Jun (" . $year . ")' value='" . $Q3 . "'/>
<set label='Jul-Sep (" . $year . ")' value='" . $Q4 . "'/>
<styles>
<definition>
<style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/>
<style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/>
<style name='DataShadow' type='Shadow' alpha='40'/>
</definition>
<application>
<apply toObject='DIVLINES' styles='Anim1'/>
<apply toObject='HGRID' styles='Anim2'/>
<apply toObject='DATALABELS' styles='Anim2'/>
</application>
</styles>
</chart>";
		echo $strXML;

	}

	public function generate_costofordered_County_chart() {
		$district = $this -> session -> userdata('district1');
		// $county_id=districts::get_county_id($district);
		$county_id = 14;
		//exit;
		$year = date("Y");

		$orderDetails = Ordertbl::get_county_ordertotal($county_id);
		$rowcountname = count($orderDetails);
		$arrayQ1 = array();
		$arrayQ2 = array();
		$arrayQ3 = array();
		$arrayQ4 = array();
		for ($i = 0; $i < $rowcountname; $i++) {

			if ($orderDetails[$i]["month"] >= 1 && $orderDetails[$i]["month"] <= 3) {
				$arrayQ2[] = (int)$orderDetails[$i]["OrderTotal"];

			} elseif ($orderDetails[$i]["month"] >= 4 && $orderDetails[$i]["month"] <= 6) {
				$arrayQ3[] = (int)$orderDetails[$i]["OrderTotal"];

			} elseif ($orderDetails[$i]["month"] >= 7 && $orderDetails[$i]["month"] <= 9) {
				$arrayQ4[] = (int)$orderDetails[$i]["OrderTotal"];
			} else
				$arrayQ1[] = (int)$orderDetails[$i]["OrderTotal"];
		}
		$Q1 = array_sum($arrayQ1);
		$Q2 = array_sum($arrayQ2);
		$Q3 = array_sum($arrayQ3);
		$Q4 = array_sum($arrayQ4);
		//exit;

		$strXML = "<chart palette='1' lineColor='FF5904' lineAlpha='85' showValues='1' rotateValues='1' valuePosition='auto' xAxisName='Months' yAxisName='Cost of Orders (KES)' yAxisMinValue='15000' showValues='0' useRoundEdges='1' alternateHGridAlpha='20' divLineAlpha='50' canvasBorderColor='666666' canvasBorderAlpha='40' baseFontColor='666666' lineColor='AFD8F8' chartRightMargin = '60' showBorder='0' bgColor='FFFFFF'>
<set label='Oct-Dec (" . ($year - 1) . ")' value='" . $Q1 . "'/>
<set label='Jan-Mar (" . $year . ")' value='" . $Q2 . "'/>
<set label='Apr-Jun (" . $year . ")' value='" . $Q3 . "'/>
<set label='Jul-Sep (" . $year . ")' value='" . $Q4 . "'/>
<styles>
<definition>
<style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/>
<style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/>
<style name='DataShadow' type='Shadow' alpha='40'/>
</definition>
<application>
<apply toObject='DIVLINES' styles='Anim1'/>
<apply toObject='HGRID' styles='Anim2'/>
<apply toObject='DATALABELS' styles='Anim2'/>
</application>
</styles>
</chart>";
		echo $strXML;

	}

	public function generate_leadtime_chart() {

		include_once ("Scripts/FusionCharts/Code/PHP/Includes/FusionCharts.php");
		$currentDistrict = $this -> session -> userdata('district1');
		$facilityDetails = Facilities::getFacilities($currentDistrict);

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("SELECT facilities.facility_code, facilities.facility_name FROM  facilities WHERE facilities.district = '$currentDistrict' ORDER BY facility_name ASC");
		$number = count($query);

		$strXMLlead_time = "<chart palette='1'  caption='Average Lead Time per Facility' shownames='1' showvalues='0'  xAxisName='Name of Commodity' yAxisName='Time in Days' numberSuffix=' Days' showSum='1' decimals='0' useRoundEdges='1' legendBorderAlpha='0'  showBorder='0' bgColor='FFFFFF'>
<categories>";
		for ($counterforthis = 0; $counterforthis < $number; $counterforthis++) {
			$strXMLlead_time .= "<category label='" . preg_replace("/[^A-Za-z0-9 ]/", "", $query[$counterforthis]['facility_name']) . "' />";
		}

		$strXMLlead_time .= "</categories><dataset seriesName='Days Pending Approval' color='AFD8F8' showValues='0'>";
		$theBarPlotter = "10";
		for ($counterforthisother = 0; $counterforthisother < $number; $counterforthisother++) {
			$strXMLlead_time .= "<set value='" . $theBarPlotter . "'  />";

		}

		$strXMLlead_time .= "</dataset><dataset seriesName='Days Pending Delivery' color='F6BD0F' showValues='0'>";
		for ($counterforthisother1 = 0; $counterforthisother1 < $number; $counterforthisother1++) {
			$strXMLlead_time .= "<set value='" . $theBarPlotter . "'  />";
		}
		$strXMLlead_time .= "</dataset><dataset seriesName='Days Pending Dispatch' color='8BBA00' showValues='0'>";
		for ($counterforthisother2 = 0; $counterforthisother2 < $number; $counterforthisother2++) {
			$strXMLlead_time .= "<set value='" . $theBarPlotter . "'  />";
		}
		$strXMLlead_time .= "</dataset></chart>";
		$data['strXML_leadtime'] = $strXMLlead_time;
		echo $strXMLlead_time;
	}

	//view affected is district dash
	public function get_stock_status($option = NULL, $facility_code = NULL, $year = NULL) {

		$chart = NULL;
		$title = NULL;
		$district = $this -> session -> userdata('district');
		$county_id = $this -> session -> userdata('county_id');
		$district_name = districts::get_district_name($district) -> toArray();

		if ($option == NULL) {

			$title = $district_name[0]["district"] . " District";
			$commodity_array = facility_stock::get_district_stock_level($district);

		} elseif ($option == "ajax-request_facility") {

			$district_name = facilities::get_facility_name_($facility_code);
			$title = $district_name["facility_name"];

			$commodity_array = facility_stock::get_facility_stock_level($facility_code);

		} elseif ($option == "ajax-request_drug") {
			$title = "" . $district_name[0]["district"] . " District";
			$commodity_array = facility_stock::get_district_drug_stock_level($district, $facility_code);

		} elseif ($option == "ajax-request_county") {

			$county_name = counties::get_county_name($county_id);
			$title = $county_name[0]["county"] . " County";

			$commodity_array = isset($facility_code) ? facility_stock::get_county_drug_stock_level($county_id, $facility_code) : facility_stock::get_county_drug_stock_level($county_id);

		} elseif ($option == "consumption") {

			$commodity_array = facility_stock::get_county_drug_consumption_level($county_id, $facility_code, $year);

		}

		$chart .= "<chart palette='2' chartLeftMargin='0' useEllipsesWhenOverflow='1' plotSpacePercent='100' yAxisNamePadding='0'yAxisValuesPadding='0' bgColor='FFFFFF' showBorder='0' shownames='1' showvalues='1'   showSum='1' decimals='0' useRoundEdges='1'" . 'exportEnabled="1" exportHandler="' . base_url() . 'scripts/FusionCharts/ExportHandlers/PHP/FCExporter.php" exportAtClient="0" exportAction="download"' . " >";
		foreach ($commodity_array as $commodity_detail) {
			$chart .= "<set label='" . preg_replace("/[^A-Za-z0-9 ]/", "", $commodity_detail['drug_name']) . "' value='$commodity_detail[total]' />";
		}
		$chart .= "<styles>
      <definition>
            <style name='myToolTipFont' type='font' font='Arial' size='18' color='FF5904'/>
      </definition>
      <application>
            <apply toObject='ToolTip' styles='myToolTipFont' />
      </application>
  </styles>";

		$chart .= "</chart>";
		echo $chart;
	}

	//////
	public function get_stock_status_ajax($option = NULL, $facility_code = NULL, $year = NULL) {
		$facility_code = $facility_code;
		$district = $this -> session -> userdata('district1');
		$county_id = $this -> session -> userdata('county_id');

		$width = "100%";
		$height = "100%";

		if ($option == NULL) {

			$commodity_array = facility_stock::get_district_stock_level($district);

		} elseif ($option == "ajax-request_facility") {

			$district_name = facilities::get_facility_name_($facility_code);
			$title = $district_name["facility_name"];
			$commodity_array = facility_stock::get_facility_stock_level($facility_code);

			if (count($commodity_array) < 20) {
				$width = "100%";
				$height = "50%";
			}

			if (count($commodity_array) > 20 && count($commodity_array) < 40) {
				$width = "100%";
				$height = "100%";
			}
			if (count($commodity_array) > 50) {
				$width = "100%";
				$height = "400%";
			}

			$commodity_name = array();
			$current_values = array();
			$monthly_values = array();

			foreach ($commodity_array as $data) :

				array_push($commodity_name, $data['drug_name']);
				array_push($current_values, isset($data['total']) ? (int)$data['total'] : (int)0);
				array_push($monthly_values, isset($data['consumption_level']) ? (int)$data['consumption_level'] : (int)0);

			endforeach;
			$data['width'] = $width;
			$data['height'] = $height;

			$data['title_1'] = "Current Balance";
			$data['title_2'] = "Average Monthly Consumption";
			$data['commodity_name'] = stripslashes(json_encode($commodity_name));
			$data['current_values'] = json_encode($current_values);
			$data['monthly_values'] = json_encode($monthly_values);

			return $this -> load -> view("facility/facility_reports/facility_commodity_stock_level_v", $data);

		} elseif ($option == "ajax-request_county") {

			$commodity_array = isset($facility_code) ? facility_stock::get_county_drug_stock_level($county_id, $facility_code) : facility_stock::get_county_drug_stock_level($county_id);

		} elseif ($option == "ajax-request_drug") {

			$commodity_array = facility_stock::get_district_drug_stock_level($district, $facility_code);

		} elseif ($option == "consumption") {

			$commodity_array = facility_stock::get_county_drug_consumption_level($county_id, $facility_code, $year);
		}

		if (count($commodity_array) < 20) {
			$width = "100%";
			$height = "50%";
		}

		if (count($commodity_array) > 20 && count($commodity_array) < 50) {
			$width = "100%";
			$height = "100%";
		}
		if (count($commodity_array) > 50) {
			$width = "100%";
			$height = "300%";
		}

		$data['width'] = $width;
		$data['height'] = $height;

		$data['facilities'] = Facilities::getFacilities($district);
		$data['option'] = $option;
		$data['facility_code'] = $facility_code;
		$data['year_selection'] = $year;

		$this -> load -> view("district/ajax_view/stock_status_v", $data);
	}

	public function consumption_trends() {

		$chart = "<chart bgColor='FFFFFF' showBorder='0' caption=' Trends'lineThickness='1' xAxisName='Months Quarterly' yAxisName='Quantity Consumed' showValues='0' formatNumberScale='0' anchorRadius='2'   divLineAlpha='10' divLineColor='CC3300' divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridAlpha='5' alternateHGridColor='CC3300' shadowAlpha='40' labelStep='2' numvdivlines='5' chartRightMargin='35' bgColor='FFFFFF,CC3300' bgAngle='270' bgAlpha='10,10'>
<categories >
<category label='Oct-Dec' />
<category label='Jan-March' />
<category label='April-June' />
<category label='July-Sept' />

</categories>
<dataset seriesName='' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>
	<set value='1327' />
	<set value='1826' />
	<set value='1699' />
	<set value='1511' />
<set value='1511' />
	</dataset>

	<styles>                
		<definition>
                         
			<style name='CaptionFont' type='font' size='12'/>
		</definition>
		<application>
			<apply toObject='CAPTION' styles='CaptionFont' />
			<apply toObject='SUBCAPTION' styles='CaptionFont' />
		</application>
	</styles>

</chart>";
		echo $chart;
	}

	public function get_consumption_trends_ajax() {
		$district = $this -> session -> userdata('district1');
		$data['facilities'] = Facilities::getFacilities($district);
		$this -> load -> view("district/ajax_view/consumption_trends_v", $data);
	}

	public function get_stock_out_trends_ajax($year = null) {
		$county_id = $this -> session -> userdata('county_id');
		$data['county'] = $county_id;
		$data['year'] = $year;
		$this -> load -> view("county/ajax_view/county_stock_out_data_v", $data);
	}

	public function get_stock_out_trends($county_id, $year = NULL) {

		$facility_data = Facility_Stock::get_county_stock_out_trend($county_id, $year);

		$strXML = "<chart formatNumberScale='0'
	    lineColor='000000' lineAlpha='40' showValues='1' rotateValues='1' valuePosition='auto'
	     palette='1' xAxisName='Months' yAxisName='# of facilities' yAxisMinValue='15000' showValues='0'  useRoundEdges='1' alternateHGridAlpha='20' divLineAlpha='50' canvasBorderColor='666666' canvasBorderAlpha='40' baseFontColor='666666' lineColor='AFD8F8' chartRightMargin = '0' showBorder='0' bgColor='FFFFFF'>";

		foreach ($facility_data as $data) :

			$strXML .= "<set label='" . $data['month'] . "' value='" . $data['total'] . "' />";

		endforeach;

		$strXML .= "<styles>
<definition>
<style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/>
<style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/>
<style name='DataShadow' type='Shadow' alpha='40'/>
</definition>
<application>
<apply toObject='DIVLINES' styles='Anim1'/>
<apply toObject='HGRID' styles='Anim2'/>
<apply toObject='DATALABELS' styles='Anim2'/>
</application>
</styles>
</chart>";
		echo $strXML;
	}

	public function get_costofexpiries_chart_ajax($option = NULL, $location_id = NULL, $year = null) {

		switch ($option) {
			case 'county' :
				$county = "true";

				$data['county'] = 'county';

				break;

			default :
				$data['county'] = '_';

				$district = $this -> session -> userdata('district1');
				$data['facilities'] = Facilities::getFacilities($district);
				break;
		}

		$data['year'] = $year;

		$this -> load -> view("district/ajax_view/costofexpiries_v", $data);
	}

	public function get_costoforders_chart_ajax() {
		$district = $this -> session -> userdata('district1');
		$data['facilities'] = Facilities::getFacilities($district);
		$this -> load -> view("district/ajax_view/costoforders_v", $data);
	}

	public function get_costofordersCounty_chart_ajax() {
		$district = $this -> session -> userdata('district1');
		$county_id = districts::get_county_id($district);
		//$county_id=14;
		$data['facilities'] = Facilities::getFacilities($district);
		$this -> load -> view("county/ajax_view/costoforders_v", $data);
	}

	public function get_leadtime_chart_ajax() {
		$district = $this -> session -> userdata('district1');
		$data['facilities'] = Facilities::getFacilities($district);
		$this -> load -> view("district/ajax_view/leadtime_v", $data);
		$data['drugs'] = Drug::getAll();
	}

	// the facility settings user settings
	public function facility_settings() {
		$data['title'] = "Facility Settings";
		$data['content_view'] = "facility/facility_settings_v";
		$data['banner_text'] = "Facility Settings";
		$data['link'] = "reports_management";
		$this -> load -> view("template", $data);
	}

	public function get_district_facility_stock_($graph_type, $facility_code = NULL) {

		switch ($graph_type) {
			case 'bar2d_facility' :
				$this -> get_stock_status_ajax($option = "ajax-request_facility", $facility_code);
				break;
			case 'bar2d_drug' :
				$this -> get_stock_status_ajax($option = "ajax-request_drug", $facility_code);
				break;
			case 'bar2d_county' :
				$this -> get_stock_status_ajax($option = "ajax-request_county");
				break;

			default :
				break;
		}
	}

	public function get_county_facility_mapping_ajax_request($option = null) {

		$county_id = $this -> session -> userdata('county_id');
		$district_data = districts::getDistrict($county_id);

		$table_data = "<tbody>";
		$table_data_summary = "<tbody>";

		$district_names = "<thead><tr><th>Monthly Activities</th>";
		$district_total = array();
		$district_total_facilities = array();
		$table_district_totals = "";
		$all_facilities = 0;
		$total_facility_list = '';
		$total_facilities_in_county = 0;
		$percentage_coverage = "";
		$percentage_coverage_total = 0;

		$get_dates_facility_went_online = facilities::get_dates_facility_went_online($county_id);

		foreach ($get_dates_facility_went_online as $facility_dates) :

			$monthly_total = 0;
			$date = $facility_dates['date_when_facility_went_online'];

			$table_data .= "<tr>
	    <td>" . $date . "</td>";

			foreach ($district_data as $district_detail) :

				$district_id = $district_detail -> id;
				$district_name = $district_detail -> district;
				$get_facilities_which_went_online_ = facilities::get_facilities_which_went_online_($district_id, $facility_dates['date_when_facility_went_online']);
				$total = $get_facilities_which_went_online_[0]['total'];
				$total_facilities = $get_facilities_which_went_online_[0]['total_facilities'];

				$monthly_total = $monthly_total + $total;
				$all_facilities = $all_facilities + $total;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = $district_total[$district_name] + $total : $district_total = array_merge($district_total, array($district_name => ($total)));

				(array_key_exists($district_name, $district_total_facilities)) ? $district_total_facilities[$district_name] = $total_facilities : $district_total_facilities = array_merge($district_total_facilities, array($district_name => $total_facilities));

				$table_data .= ($total > 0) ? "<td><a href='#' id='$district_id' class='ajax_call_1 link' option='monthly' date='$date'> $total</a></td>" : "<td>$total</td>";

			endforeach;

			$table_data .= "<td>$monthly_total</td></tr>";

		endforeach;
		$table_data .= "<tr>";
		$table_data_summary .= "<tr>";

		$checker = 1;

		foreach ($district_total as $key => $value) :

			$coverage = 0;

			@$coverage = round((($value / $district_total_facilities[$key])) * 100, 1);

			$percentage_coverage_total = $percentage_coverage_total + $coverage;

			$district_names .= "<th>$key</th>";

			$table_data .= ($checker == 1) ? "<td><b>TOTAL: Facilities using HCMP</b></td><td>$value</td>" : "<td>$value</td>";
			$table_data_summary .= ($checker == 1) ? "<td><b>TOTAL: Facilities using HCMP</b></td><td>$value</td>" : "<td>$value</td>";

			$total_facility_list .= ($checker == 1) ? "<tr><td><b>TOTAL: Facilities in District</b></td><td>$district_total_facilities[$key]</td>" : "<td>$district_total_facilities[$key]</td>";

			$total_facilities_in_county = $total_facilities_in_county + $district_total_facilities[$key];

			$percentage_coverage .= ($checker == 1) ? "<tr><td><b>% Coverage</b></td><td>$coverage %</td>" : "<td>$coverage %</td>";

			$checker++;

		endforeach;

		$table_data .= "<td><a href='#' id='total' class='ajax_call_1 link' option='total' date='total'>$all_facilities</a></td></tr></tbody>";
		$table_data_summary .= "<td><a href='#' id='total' class='ajax_call_1 link' option='total' date='total'>$all_facilities</a></td></tr></tbody>";
		$district_names .= "<th>TOTAL</th></tr></thead>";

		$final_coverage_total = 0;

		@$final_coverage_total = round((($all_facilities / $total_facilities_in_county)) * 100, 1);

		$data_ = "
		<div class='tabbable tabs-left'>
		<div class='tab-content'>
        <ul class='nav nav-tabs'>
        <li class=''><a href='#A' data-toggle='tab'><h3>Monthly Break Down</h3></a></li>
        <li class='active'><a href='#B' data-toggle='tab'><h3>Roll out Summary</h3></a></li>
        </ul>
         <div class='tab-pane' id='A'>
		<table class='data-table' width='100%'>" . $district_names . $table_data . $total_facility_list . "<td>$total_facilities_in_county</td></tr>" . $percentage_coverage . "<td>$final_coverage_total %</td></tr></table>
		 </div>
		 <div class='tab-pane active' id='B'>
		 <table class='data-table' width='100%'>" . $district_names . $table_data_summary . $total_facility_list . "<td>$total_facilities_in_county</td></tr>" . $percentage_coverage . "<td>$final_coverage_total %</td></tr></table>
		 </div></div>";

		if (isset($option)) :
			return $data_;
		else : echo $data_;
		endif;
	}

	public function get_county_facility_mapping($year = null, $month = NULL) {

		$year = isset($year) ? $year : date("Y");
		$month = isset($month) ? $month : date("m");

		$county_id = $this -> session -> userdata('county_id');

		$district_data = districts::getDistrict($county_id);

		$data['year'] = $year;
		$data['month'] = $month;
		$data['title'] = "Facility Mapping";
		$data['banner_text'] = "Facility Mapping";
		$data['content_view'] = "county/facility_mapping_v";
		$data['district_data'] = $district_data;

		$this -> load -> view("template", $data);
	}

	public function get_county_facility_mapping_data($year = null, $month = NULL) {

		$year = isset($year) ? $year : date("Y");
		$month = isset($month) ? $month : date("m");

		$county_id = $this -> session -> userdata('county_id');

		$first_day_of_the_month = date("Y-m-1", strtotime(date($year . "-" . $month)));
		$last_day_of_the_month = date("Y-m-t", strtotime(date($year . "-" . $month)));

		$date_1 = new DateTime($first_day_of_the_month);
		$date_2 = new DateTime($last_day_of_the_month);

		$district_data = districts::getDistrict($county_id);

		$series_data = array();
		$category_data = array();
		$series_data_monthly = array();
		$category_data_monthly = array();

		$seconds_diff = strtotime($last_day_of_the_month) - strtotime($first_day_of_the_month);
		$date_diff = floor($seconds_diff / 3600 / 24);

		for ($i = 0; $i <= $date_diff; $i++) :

			$day = 1 + $i;

			$new_date = "$year-$month-" . $day;
			$new_date = date('Y-m-d', strtotime($new_date));

			if (date('N', strtotime($new_date)) < 6) {

				$date_ = date('D d', strtotime($new_date));
				$category_data = array_merge($category_data, array($date_));

				$temp_1 = array();

				foreach ($district_data as $district_) :

					$district_id = $district_ -> id;
					$district_name = $district_ -> district;
					$county_data = Log::get_county_login_count($county_id, $district_id, $new_date);

					(array_key_exists($district_name, $series_data)) ? $series_data[$district_name] = array_merge($series_data[$district_name], array((int)$county_data[0]['total'])) : $series_data = array_merge($series_data, array($district_name => array((int)$county_data[0]['total'])));

				endforeach;

			} else {
				// do nothing
			}
		endfor;

		for ($i = 0; $i < 12; $i++) :

			$day = 1 + $i;
			//changed it to be a month

			$new_date = "$year-$day";

			$new_date = date('Y-m', strtotime($new_date));

			$date_ = date('M', strtotime($new_date));
			$category_data_monthly = array_merge($category_data_monthly, array($date_));

			foreach ($district_data as $district_) :

				$district_id = $district_ -> id;
				$district_name = $district_ -> district;
				$county_data = Log::get_county_login_monthly_count($county_id, $district_id, $new_date);

				(array_key_exists($district_name, $series_data_monthly)) ? $series_data_monthly[$district_name] = array_merge($series_data_monthly[$district_name], array((int)$county_data[0]['total'])) : $series_data_monthly = array_merge($series_data_monthly, array($district_name => array((int)$county_data[0]['total'])));

			endforeach;

		endfor;
		$data['year'] = $year;
		$data['month'] = date("F", strtotime(date($year . "-" . $month)));
		$data['series_data_monthly'] = $series_data_monthly;
		$data['category_data_monthly'] = stripslashes(json_encode($category_data_monthly));
		$data['series_data'] = $series_data;
		$data['category_data'] = stripslashes(json_encode($category_data));
		$data['data'] = $this -> get_county_facility_mapping_ajax_request("on_load");
		$this -> load -> view("county/ajax_view/facility_roll_out_at_a_glance_v", $data);
	}

	public function get_facility_json_data($district_id) {
		echo json_encode(facilities::get_facilities_which_are_online($district_id));
	}

	public function load_county_consumption_graph_view() {
		$county_id = $this -> session -> userdata('county_id');
		$data['c_data'] = drug::getAll_2();
		$data['district_data'] = districts::getDistrict($county_id);
		$this -> load -> view("county/ajax_view/county_stock_level_filter_v", $data);
	}

	public function get_county_consumption_level_new($year = null, $month = null, $commodity_id = null, $category_id = null, $district_id = null, $option = null) {

		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$category_data = array();
		$series_data = array();
		$year = isset($year) ? $year : date("Y");
		$month = isset($month) ? $month : date("m");
		$option_new = (isset($option)) ? $option : "packs";
		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		$district_name = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;

		//get the data from the db
		$consumption_data = facility_stock::get_county_drug_consumption_level($county_id, $category_id, $year, $month, $commodity_id, $district_id, $option);

		foreach ($consumption_data as $commodity_detail) :

			$category_data = array_merge($category_data, array(preg_replace("/[^A-Za-z0-9 ]/", "", $commodity_detail['drug_name'])));
			$series_data = array_merge($series_data, array((int)$commodity_detail['total']));
		endforeach;

		$data['category_data'] = stripslashes(json_encode($category_data));
		$data['series_data'] = stripslashes(json_encode($series_data));
		$data['year'] = $year;
		$data['month'] = date("F", strtotime(date($year . "-" . $month)));
		$data['county'] = $county_name[0]['county'] . $district_name;
		$data['consumption_option'] = $option_new;

		$this -> load -> view("county/ajax_view/county_consumption_graphical_data_v", $data);
	}

	public function consumption_data() {
		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$data['c_data'] = drug::getAll_2();
		$data['district_data'] = districts::getDistrict($county_id);
		$this -> load -> view("county/ajax_view/consumption_stats_v", $data);
	}

	public function facility_data_stats() {

		$district = $this -> session -> userdata('district');
		$data['facility_names'] = Facilities::getFacilities($district);
		$this -> load -> view("district/ajax_view/facility_data_v", $data);
	}

	public function consumption_stats_graph() {
		$county_id = $this -> session -> userdata('county_id');
		$district_filter = $_POST['district_filter'];
		$facilityname = $_POST['facilityname'];
		$commodity_filter = $_POST['commodity_filter'];
		$year_filter = $_POST['year_filter'];
		$facilities_filter = $_POST['facilities'];
		$plot_value_filter = $_POST['plot_value_filter'];

		$montharray = array('1' => 'January', '2' => 'Febuary', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
		$consumption_data = Facility_stock::get_county_drug_consumption_level2($facilities_filter, $county_id, $district_filter, $commodity_filter, $year_filter, $plot_value_filter);
		$monthnos = array();
		$totals = array();

		foreach ($consumption_data as $value) {

			$monthnos[] = $value['monthno'];
			$totals[] = (double)$value['total'];

		}
		$combined = array_combine($monthnos, $totals);

		$basket = array_replace($montharray, $combined);
		foreach ($basket as $key => $val) {
			if (is_string($val)) {
				$basket[$key] = 0;
			}
		}
		$arrayfinal = array_combine($montharray, $basket);

		$arrayto_graph = array();

		foreach ($arrayfinal as $key => $value) {

			$arrayto_graph[] = $arrayfinal[$key];

		}

		$mymontharray = array();
		foreach ($montharray as $key => $value) {
			$mymontharray[] = $montharray[$key];
		}

		$data['facilityname'] = $facilityname;
		$data['plot_value_filter'] = json_encode($plot_value_filter);
		$data['arrayto_graph'] = json_encode($arrayto_graph);
		$data['montharray'] = json_encode($mymontharray);
		$this -> load -> view("county/ajax_view/consumption_v", $data);

	}

	public function get_county_stock_level_new($commodity_id = null, $category_id = null, $district_id = null, $option = null) {

		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);

		$year = date("Y");
		$month = date("m");

		$category_data = array();
		$series_data = array();

		$option_new = isset($option) ? $option : "packs";
		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;
		$district_name = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;
		$facility_code = (isset($facility_code) && ($facility_code > 0)) ? facilities::get_facility_name($facility_code) -> toArray() : facilities::get_facilities_which_are_online($district_id);

		$district_id = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : districts::getDistrict($county_id) -> toArray();

		foreach ($district_id as $district_) :

			if (count($district_id) > 1) {
				$category_data = array_merge($category_data, array($district_["district"]));
				$stock_data = facility_stock::get_county_drug_stock_level_new($county_id, $category_id, $commodity_id, $district_["id"], $option, '');

				//foreach($stock_data as $stock_data_):
				$series_data = array_merge($series_data, array( array((int)$stock_data[0]['total'])));

				//endforeach;

			} else {

				foreach ($facility_code as $facility_) :

					$category_data = array_merge($category_data, array($facility_['facility_name']));
					$stock_data = facility_stock::get_county_drug_stock_level_new($county_id, $category_id, $commodity_id, $district_["id"], $option, $facility_['facility_code']);

					$series_data = array_merge($series_data, array( array((int)$stock_data[0]['total'])));

				endforeach;

			}
		endforeach;

		$data['category_data'] = stripslashes(json_encode($category_data));
		$data['series_data'] = (json_encode($series_data));
		;
		$data['year'] = $year;
		$data['month'] = date("F", strtotime(date($year . "-" . $month)));
		$data['county'] = $county_name[0]['county'] . $district_name;
		$data['consumption_option'] = $option_new;

		$this -> load -> view("county/ajax_view/county_stock_level_graphical_data_v", $data);
	}

	public function load_county_cost_of_expiries_graph_view() {
		$county_id = $this -> session -> userdata('county_id');
		$data['district_data'] = districts::getDistrict($county_id);
		$this -> load -> view("county/ajax_view/county_expiry_filter_v", $data);
	}

	public function get_county_cost_of_expiries_new($year = null, $month = null, $district_id = null, $option = null, $facility_code = null) {

		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);

		$category_data = array();
		$series_data = array();
		$temp_array = array();

		$months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

		$district_data = (isset($district_id) && ($district_id > 0)) ? districts::get_district_name($district_id) -> toArray() : null;

		$district_name_ = (isset($district_data)) ? " :" . $district_data[0]['district'] . " subcounty" : null;

		$year = ($year != "null") ? $year : date("Y");
		$month = isset($month) ? $month : date("m");
		$option_new = (isset($option) && $option != 'null') ? $option : "ksh";
		$facility_code = ((int)$facility_code > 0) ? facilities::get_facility_name($facility_code) -> toArray() : facilities::get_facilities_which_are_online($district_id);

		$district_id = (isset($district_id) && ($district_id > 0)) ? array('id' => $district_id) : districts::getDistrict($county_id) -> toArray();

		if (count($district_id) > 1 && $month == "null") {

			$category_data = array_merge($category_data, $months);

			$commodity_array = Facility_Stock::get_county_cost_of_exipries_new($county_id, $year, $month, "all", $option_new, null);

			foreach ($commodity_array as $data) :

				$temp_array = array_merge($temp_array, array($data["cal_month"] => $data['total']));

			endforeach;

			foreach ($months as $key => $data) :

				$val = (array_key_exists($data, $temp_array)) ? (int)$temp_array[$data] : (int)0;

				$series_data = array_merge($series_data, array($val));

			endforeach;

		}

		if (count($facility_code) == 1 && count($district_id) == 1) {

			$commodity_array = Facility_Stock::get_county_cost_of_exipries_new($county_id, $year, $month, 'facility', $option_new, $facility_code[0]['facility_code']);

			foreach ($commodity_array as $facility_data) :

				$category_data = array_merge($category_data, array($facility_data['drug_name']));

				$series_data = array_merge($series_data, array( array((int)$facility_data['total'])));

			endforeach;

		}

		if (count($district_id) == 1 && count($facility_code) >= 1 && count($category_data) == 0) {

			foreach ($facility_code as $facility_) :

				$category_data = array_merge($category_data, array($facility_['facility_name']));

				$commodity_array = Facility_Stock::get_county_cost_of_exipries_new($county_id, $year, $month, $facility_['district'], $option_new, $facility_['facility_code']);

				$series_data = array_merge($series_data, array( array((int)$commodity_array[0]['total'])));

			endforeach;

		}

		if (count($district_id) > 1 && $month != "null") {

			$district_ = districts::getDistrict($county_id) -> toArray();

			foreach ($district_ as $data) :
				$category_data = array_merge($category_data, array($data['district']));
				$commodity_array = Facility_Stock::get_county_cost_of_exipries_new($county_id, $year, $month, $data['id'], $option_new, "null");

				$series_data = array_merge($series_data, array( array((int)$commodity_array[0]['total'])));
			endforeach;

		}

		$data = array();
		$data['category_data'] = stripslashes(json_encode($category_data));
		$data['series_data'] = (json_encode($series_data));
		;
		$data['year'] = $year;

		$data['month'] = date("F", strtotime(date($year . "-" . $month)));
		$data['total'] = 2;
		$data['expiry_option'] = $option_new;
		$data['county'] = $county_name[0]['county'];
		$data['consumption_option'] = $option_new;
		$this -> load -> view("county/ajax_view/county_expiries_graphical_data_v", $data);

	}

	public function get_district_drill_down_detail($district_id, $option, $date_of_activation) {

		$district_data = "";
		$county_id = $this -> session -> userdata('county_id');

		if ($option == 'monthly') :

			$get_facility_data = facilities::get_facilities_reg_on_($district_id, urldecode($date_of_activation));

			foreach ($get_facility_data as $facility_data) :

				$facility_code = $facility_data -> facility_code;
				$facility_user_data = user::get_user_info($facility_code);
				$facility_name = $facility_data -> facility_name;

				$district_data .= '<span class="label label-info" width="100%">' . $facility_name . '</span>
	
	<table class="data-table" width="100%">
	<thead>
	<tr>
	<th>First Name</th><th>Last Name</th><th>Email </th><th>Phone No.</th>
	</tr>
	</thead>
	<tbody>';

				foreach ($facility_user_data as $user_data_) :

					$district_data .= "<tr>
	<td>$user_data_->fname</td><td>$user_data_->lname</td><td>$user_data_->email</td><td>$user_data_->telephone</td>
	<tr>";

				endforeach;

				$district_data .= "</tbody></table>";

			endforeach;
		elseif ($option = "total") :

			$get_facility_data = facilities::get_facilities_online_per_district($county_id);

			$district_data .= '
	<table class="data-table" width="100%">
	<thead>
	<tr>
	<th>District Name</th><th>MFL No</th><th>Facility Name</th><th>Date Activated</th>
	</tr>
	</thead>
	<tbody>';
			foreach ($get_facility_data as $facility_data) :

				$facility_code = $facility_data['facility_code'];
				$facility_name = $facility_data['facility_name'];
				$district_name = $facility_data['district'];
				$date = $facility_data['date'];

				$district_data .= "<tr>
	<td>$district_name</td><td>$facility_code</td><td>$facility_name</td><td>$date</td>
	<tr>";

			endforeach;
			$district_data .= "</tbody></table>";

		endif;
		echo $district_data;

	}

	public function get_district_facility_mapping_($district_id) {
		$facility_data = facilities::getFacilities($district_id);
		$table_body = "";

		$dpp_details = user::get_dpp_details($district_id) -> toArray();
		$district_name = districts::get_district_name($district_id) -> toArray();

		$dpp_fname = '';
		$dpp_lname = '';
		$dpp_phone = '';
		$dpp_email = '';

		if (count($dpp_details) > 0) {

			$dpp_fname = $dpp_details[0]['fname'];
			$dpp_lname = $dpp_details[0]['lname'];
			$dpp_phone = $dpp_details[0]['telephone'];
			$dpp_email = $dpp_details[0]['email'];

		}

		$indicator = "District";
		$no_of_facility_users = 0;
		$no_of_facility_users_online = 0;
		$no_of_facilities = 0;
		$no_of_facilities_using = 0;

		foreach ($facility_data as $facility_detail) {
			$facility_code = $facility_detail -> facility_code;
			$facility_extra_data = facilities::get_facility_status_no_users_status($facility_code);
			$no_of_facility_users = $no_of_facility_users + $facility_extra_data[0]['number_of_users'];
			$no_of_facility_users_online = $no_of_facility_users_online + $facility_extra_data[0]['number_of_users_online'];

			$no_of_facilities = $no_of_facilities + 1;

			if ($facility_extra_data[0]['number_of_users'] > 0) {
				$no_of_facilities_using = $no_of_facilities_using + 1;
			}

			$table_body .= "<tr>";
			$status = null;
			$temp = $facility_extra_data[0]['status'];
			($temp == "Active") ? $status = "<span class='label label-success'>$temp</span>" : $status = "<span class='label label-important'>$temp</span>";

			$table_body .= "<td>$facility_code</td>
	              <td>$facility_detail->facility_name</td>
	              <td>$facility_detail->owner</td>
	              <td>$status</td>
	              <td>" . $facility_extra_data[0]['number_of_users'] . "</td>
	              <td>" . $facility_extra_data[0]['number_of_users_online'] . "</td>";

			$table_body .= "</tr>";

		}

		$stats_data = '
		<table style="float:left">
		<tr>
		<td><label style=" font-weight: ">' . $district_name[0]['district'] . ' ' . $indicator . ' Pharmacist :</label></td>
		<td><a class="badge">' . $dpp_fname . ' ' . $dpp_lname . '</a></td>
		</tr>
		<tr>
		<td><label style="font-weight: ">Phone No.</label></td>
		<td><a class="badge">' . $dpp_phone . '</a></td>
		</tr>
		<tr>
		<td><label style="font-weight: ">Email Address</label></td>
		<td><a class="badge">' . $dpp_email . '</a></td>
		</tr>
		</table>
		<table style="float:left">
		<tr>
		<td><label style=" font-weight: ">Total No of Facilities in The ' . $indicator . ' </label></td>
		<td><a class="badge" >' . $no_of_facilities . '</a></td>
		</tr>
		<tr>
		<td><label style="font-weight: ">Total No of Facilities in The ' . $indicator . '  Using HCMP </label></td>
		<td>	<a class="badge">' . $no_of_facilities_using . '</a></td>
		</tr>
		</table>
		<table style="float:left">
		<tr>
		<td><label style="font-weight: ">Total No of Users in The ' . $indicator . ' </label></td>
		<td><a class="badge" >' . $no_of_facility_users . '</a></td>
		</tr>
		<tr>
		<td><label style="font-weight: ">Users online in The ' . $indicator . '</label></td>
		<td><a class="badge" >' . $no_of_facility_users_online . '</a></td>
		</tr>
		</table>
';

		$data['stats_data'] = $stats_data;
		$data['table_body'] = $table_body;
		$this -> load -> view("county/ajax_view/facility_mapping_v", $data);

	}

	/////////county
	public function county_orders() {
		$data['title'] = "County Orders";
		$data['content_view'] = "county/county_orders";
		$data['banner_text'] = "County Orders";
		$data['link'] = "reports_management";
		$counties = districts::getDistrict(1);
		$table_body = '';

		foreach ($counties as $county_detail) {
			$id = $county_detail -> id;
			$table_body .= "<tr><td><a class='ajax_call_1' id='county_facility' name='get_rtk_county_detail/$id' href='#'> $county_detail->district</a></td>";

			$county_detail = facilities::get_no_of_facilities($id);
			$test = $county_detail[0]['total_facilities'];
			$link = "<a href=" . site_url('report_management/county_view_orders/' . $id) . " class='link'>View</a>";
			$table_body .= "<td>$test</td>
			<td>$test</td>
			<td>$test</td>
			<td>$test</td>
			<td>$test</td>
			<td>$link</td></tr>";

		}

		$data['table_body'] = $table_body;

		$this -> load -> view("template", $data);
	}

	public function county_view_orders($id) {
		$data['title'] = "County Orders";
		$data['content_view'] = "county/county_orders_v";
		$data['banner_text'] = "District Orders";
		$id = $this -> session -> userdata('district');
		$data['order_list'] = Ordertbl::get_county_view_orders($id);
		$this -> load -> view("template", $data);

	}

	//county charts  1
	public function expired_commodities_chart() {
		$strXML = "<chart caption='Expired Commodities'yAxisName='No. of batch units' xAxisName='Commodities' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>
        <set label='Dagoretti' value='23'/> 
        <set label='Embakasi' value='12'/> 
        <set label='Kamukunji' value='17'/> 
        <set label='Kasarani' value='14' /> 
        <set label='Langata' value='12' />
        <set label='Makadara' value='12'/> 
        <set label='Njiru' value='17'/> 
        <set label='Starehe' value='14' /> 
        <set label='Westlands' value='12' />
</chart>";
		echo $strXML;
	}

	//county charts  2
	public function cost_of_expired_commodities_chart() {
		$strXML = "<chart canvasPadding='10' caption='Cost of Expired Commodities' xAxisName='Month' yAxisName='ksh' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>
<set label='Jan' value='17400' />
<set label='Feb' value='19800' />
<set label='Mar' value='21800' />
<set label='Apr' value='23800' />
<set label='May' value='29600' />
<set label='Jun' value='27600' />
<set label='Jul' value='31800' />
<set label='Aug' value='39700' />
<set label='Sep' value='37800' />
<set label='Oct' value='21900' />
<set label='Nov' value='32900' />
<set label='Dec' value='39800' />
</chart>";
		echo $strXML;
	}

	//county charts  3
	public function stock_status_chart() {
		$strXML = "<chart caption='Stock Status'yAxisName='No. of batch units' xAxisName='Commodities' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>
        <set label='Dagoretti' value='23'/> 
        <set label='Embakasi' value='12'/> 
        <set label='Kamukunji' value='17'/> 
        <set label='Kasarani' value='14' /> 
        <set label='Langata' value='12' />
        <set label='Makadara' value='12'/> 
        <set label='Njiru' value='17'/> 
        <set label='Starehe' value='14' /> 
        <set label='Westlands' value='12' />
</chart>";
		echo $strXML;
	}

	//county charts  4
	public function orders_chart() {
		$strXML = "<chart canvasPadding='10' caption='Orders in the county' xAxisName='Month' yAxisName='No of Orders' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>
<set label='Jan' value='17400' />
<set label='Feb' value='19800' />
<set label='Mar' value='21800' />
<set label='Apr' value='23800' />
<set label='May' value='29600' />
<set label='Jun' value='27600' />
<set label='Jul' value='31800' />
<set label='Aug' value='39700' />
<set label='Sep' value='37800' />
<set label='Oct' value='21900' />
<set label='Nov' value='32900' />
<set label='Dec' value='39800' />
</chart>";
		echo $strXML;
	}

	//county charts  5
	public function cost_of_ordered_commodities_chart() {
		$strXML = "<chart formatNumberScale='0'  lineColor='000000' lineAlpha='40' caption='cost of ordered commodities' xAxisName='Month' yAxisName='Ksh' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>
<set label='Jan' value='17400' />
<set label='Feb' value='19800' />
<set label='Mar' value='21800' />
<set label='Apr' value='23800' />
<set label='May' value='29600' />
<set label='Jun' value='27600' />
<set label='Jul' value='31800' />
<set label='Aug' value='39700' />
<set label='Sep' value='37800' />
<set label='Oct' value='21900' />
<set label='Nov' value='32900' />
<set label='Dec' value='39800' />
</chart>";
		echo $strXML;
	}

	//county charts  6
	public function cummulative_fill_rate_chart() {
		$county_id = $this -> session -> userdata('county_id');
		$county_name = counties::get_county_name($county_id);
		$chart_raw_data = ordertbl::get_county_fill_rate($county_id);

		$strXML = "<chart bgAlpha='0' bgColor='FFFFFF' lowerLimit='0' upperLimit='100' numberSuffix='%25' showBorder='0' basefontColor='#000000' chartTopMargin='25' chartBottomMargin='25' chartLeftMargin='25' chartRightMargin='25' toolTipBgColor='80A905' gaugeFillMix='{dark-10},FFFFFF,{dark-10}' gaugeFillRatio='3'>
<colorRange>
<color minValue='0' maxValue='45' code='FF654F'/>
<color minValue='45' maxValue='80' code='F6BD0F'/>
<color minValue='80' maxValue='100' code='8BBA00'/>
</colorRange>
<dials>
<dial value='" . $chart_raw_data[0]['fill_rate'] . "' rearExtension='10' baseWidth='2'/>
</dials>

</chart>";

		echo $strXML;
	}

	//county charts  7

	//county charts  8
	public function orders_placed_chart() {
		$strXML = "<chart caption=' Orders Placed By Districts' formatNumberScale='0' formatNumberScale='0' showBorder='0' bgcolor='FFFFF' color='FF4400'>
<set label='Dagoretti' value='51852' />
<set label='Embakasi' value='88168' />
<set label='Kamukunji' value='73897' />
<set label='Kasarani' value='93933' />
<set label='Langata' value='19289' />
<set label='Makadara' value='79623' />
<set label='Njiru' value='48262' />
<set label='Starehe' value='29162' />
<set label='Westlands' value='96878' />
</chart>";
		echo $strXML;
	}

	//county charts  9
	public function lead_time_chart() {
		$title = 'Lead Time';
		$str_xml_body = "<value>1</value>";

		$strXML = "<Chart bgColor='FFFFFF' bgAlpha='0' numberSuffix='%' caption='$title' showBorder='0' upperLimit='100' lowerLimit='0' gaugeRoundRadius='5' chartBottomMargin='5' ticksBelowGauge='0' 
showGaugeLabels='0' valueAbovePointer='0' pointerOnTop='1' pointerRadius='5'>
    <colorRange> 
       
        <color minValue='0' maxValue='33' name='Orders Placed' code='FF0000' />       
        <color minValue='34' maxValue='67' name='Orders Approved' code='FFFF00' /> 
         <color minValue='68' maxValue='100' name='Orders Delivered' code='00FF00' />
    </colorRange>";
		$strXML .= "$str_xml_body
<styles>
        <definition>
            <style name='ValueFont' type='Font' bgColor='333333' size='10' color='FFFFFF'/>
        </definition>
        <application>
            <apply toObject='VALUE' styles='valueFont'/>
        </application>	
    </styles>
</Chart>";

		echo $strXML;
	}

	//county charts  9
	public function lead_time_chart_county() {
		$district = $this -> session -> userdata('district');
		$chart_raw_data[0]['t_a_t'] = 0;
		$chart_raw_data[0]['delivery_update'] = 0;
		$county_id = districts::get_county_id($district);
		$county_name = counties::get_county_name($county_id[0]['county']);
		$chart_raw_data = ordertbl::get_county_order_turn_around_time($county_name[0]['id']);

		$step_data = 0;

		$title = 'Lead Time';
		$str_xml_body = "<value>1</value>";

		$strXML = '<Chart bgColor="FFFFFF" bgAlpha="0" showBorder="0" upperLimit="15" lowerLimit="0" gaugeRoundRadius="5" chartBottomMargin="10" ticksBelowGauge="1" showGaugeLabels="1" valueAbovePointer="1" pointerOnTop="1" pointerRadius="9" >
<colorRange>';

		$strXML .= "<color minValue='$step_data' maxValue='" . $chart_raw_data[0]['order_approval'] . "' label='" . $chart_raw_data[0]['order_approval'] . " days'  />";
		$step_data = $step_data + $chart_raw_data[0]['order_approval'] + $chart_raw_data[0]['approval_delivery'];
		$strXML .= "<color minValue='" . $chart_raw_data[0]['order_approval'] . "' maxValue='$step_data' label='" . $chart_raw_data[0]['approval_delivery'] . " days'  />";
		$step_data = $step_data + $chart_raw_data[0]['delivery_update'];
		$step_data_ = $step_data - $chart_raw_data[0]['delivery_update'];
		$strXML .= "<color minValue='$step_data_' maxValue='$step_data' label='" . $chart_raw_data[0]['delivery_update'] . " days'  />";

		$strXML .= '
</colorRange>
<pointers>
   <pointer value="' . $chart_raw_data[0]['t_a_t'] . '" toolText="Total Turn Around Time" link="P-detailsWin,width=450,height=150,toolbar=no,scrollbars=no, resizable=no-provincialtatbreakdown.php?province=5%26mwaka=2012%26mwezi=07%26dcode=%26fcode=0" />
 
</pointers>


<styles>

<definition>
<style name="ValueFont" type="Font" bgColor="333333" size="10" color="FFFFFF"/>
</definition>
<application>
<apply toObject="VALUE" styles="valueFont"/>
</application>
</styles>
</Chart>';

		echo $strXML;
	}

	////////////////////////////////////////////////////////////////////////////////////////////

	public function get_county_drawing_rights_data() {

		$district = $this -> session -> userdata('district');

		$county_id = districts::get_county_id($district);
		$county_name = counties::get_county_name($county_id[0]['county']);
		$chart_raw_data = facilities::get_county_drawing_rights($county_name[0]['id']);

		$category_data = '<categories>';
		$allocated_data = "";
		$balance_data = "";
		$chart_data = '';

		$strXML = "<chart palette='3' bgColor='FFFFFF' formatNumberScale='0' showBorder='0' caption='' yAxisName='Units' showValues='0' numVDivLines='10' divLineAlpha='30' useRoundEdges='1' legendBorderAlpha='0'>";

		foreach ($chart_raw_data as $chart_data) {
			$category_data .= "<category label='$chart_data[district]' />";

			$allocated_data .= "<set value='$chart_data[initial_drawing_rights]' />";
			$balance_data .= "<set value='$chart_data[drawing_rights_balance]' />";
		}

		$strXML .= $category_data . "</categories><dataset seriesName='Allocated Drawing ' color='A66EDD' >$allocated_data</dataset> <dataset seriesName='Drawing right Bal' color='F6BD0F'>$balance_data</dataset>

</chart>";

		echo $strXML;

	}

	public function get_county_ordering_rate_chart() {
		$district = $this -> session -> userdata('district');

		$county_id = districts::get_county_id($district);
		$county_name = counties::get_county_name($county_id[0]['county']);

		$districts_in_this_county = districts::getDistrict($county_name[0]['id']);

		$category_data = '<categories>';

		$orders_made_data = "";
		$total_no_of_facilities = "";

		$strXML = "<chart stack100Percent='1' showPercentValues='1' palette='2' bgColor='FFFFFF' formatNumberScale='0' showBorder='0' showLabels='1' showvalues='0'  numberPrefix=''  showSum='1' decimals='0' useRoundEdges='1' legendBorderAlpha='0'>";

		foreach ($districts_in_this_county as $chart_data) {
			$category_data .= "<category label='$chart_data->district' />";

			$district_data = facilities::get_orders_made_in_district($chart_data -> id);

			$orders_made_data .= "<set value='$district_data[orders_made_data]' />";

			$bal = $district_data['total_no_of_facilities'] - $district_data['orders_made_data'];

			$total_no_of_facilities .= "<set value='$bal'/>";

		}

		$strXML .= $category_data . "</categories><dataset seriesName='Orders Made' color='659EC7' showValues='0'>$orders_made_data</dataset><dataset seriesName='Orders not made' color='E8E8E8' showValues='0'>$total_no_of_facilities</dataset></chart>";
		echo $strXML;
	}

	public function get_county_stock_status_view() {
		$this -> load -> view("county/ajax_view/county_stock_status_v");
	}

	public function get_lead_time() {

	}

	public function district_drawing_rights_chart() {
		$drawing_rights = Facilities::get_drawingR_county_by_district();
		$strXML = "";
		$strXML = "<chart palette='3' caption='Districts Drawing Rights'  bgColor='FFFFFF' numberprefix='$' xaxisName='Districts'yaxisName='Amount' useRoundEdges='1' showValues='0' legendBorderAlpha='0'>  

<categories showValues='1'>";

		$rowcountname = count($drawing_rights);
		for ($i = 0; $i < $rowcountname; $i++) {
			foreach ($drawing_rights as $value) {

			}
			$name = $drawing_rights[$i]["districtName"];

			$strXML .= "<category label='" . $name . "' />";

		}
		$strXML .= "</categories>";
		$strXML .= "<dataset>";
		$rowcountname = count($drawing_rights);
		for ($i = 0; $i < $rowcountname; $i++) {
			foreach ($drawing_rights as $value) {

			}
			$rights = $drawing_rights[$i]["drawingR"];

			$strXML .= "<set value='" . $rights . "' />";
		}
		$strXML .= "</dataset></chart>";
		echo $strXML;

	}

	public function facility_evaluation($facility_code = null, $user_id = null) {

		if (!isset($facility_code) && !isset($user_id)) {
			$facility_code = $this -> session -> userdata('news');
			$user_id = $this -> session -> userdata('identity');
		}

		//New

		$evaluation = facility_evaluation::getAll($facility_code, $user_id) -> toArray();

		$data = (count($evaluation) == 0) ? array(0 => array('fhead_no' => null, 'fdep_no' => null, 'nurse_no' => null, 'sman_no' => null, 'ptech_no' => null, 'trainer' => null, 'comp_avail' => null, 'modem_avail' => null, 'bundles_avail' => null, 'manuals_avail' => null, 'satisfaction_lvl' => null, 'agreed_time' => null, 'feedback' => null, 'pharm_supervision' => null, 'coord_supervision' => null, 'req_id' => null, 'req_spec' => null, 'req_addr' => null, 'train_remarks' => null, 'train_recommend' => null, 'train_useful' => null, 'comf_issue' => null, 'comf_order' => null, 'comf_update' => null, 'comf_gen' => null, 'use_freq' => null, 'freq_spec' => null, 'improvement' => null, 'ease_of_use' => null, 'meet_expect' => null, 'expect_suggest' => null, 'retrain' => null)) : $evaluation;

		$data['title'] = "Facility Training Evaluation";
		$data['content_view'] = "facility/facility_reports/facility_evaluation";
		$data['banner_text'] = "Facility Training Evaluation";
		$data['facilities'] = Facilities::get_one_facility_details($facility_code, $user_id);
		$data['facility_code'] = $facility_code;
		$data['user_id'] = $user_id;
		$data['evaluation_data'] = $data;

		$this -> load -> view("template", $data);
	}

	public function facility_evaluation_($message = NULL) {

		$this -> session -> set_flashdata('system_success_message', "Facility Training Evaluation Has been " . $message);
		redirect('report_management/facility_evaluation');
	}

	public function save_facility_eval() {
		$facility_code = $this -> session -> userdata('news');
		$current_user = $this -> session -> userdata('identity');
		$date = date('y-m-d');
		$data_array = $_POST['data_array'];
		$dataarray = explode("|", $data_array);
		$f_headno = $dataarray[0];
		$f_depheadno = $dataarray[1];
		$nurse_no = $dataarray[2];
		$store_mgrno = $dataarray[3];
		$p_techno = $dataarray[4];
		$trainer = $dataarray[5];
		$comp_avail = $dataarray[6];
		$modem_avail = $dataarray[7];
		$bundles_avail = $dataarray[8];
		$manuals_avail = $dataarray[9];
		$satisfaction_lvl = $dataarray[10];
		$agreed_time = $dataarray[11];
		$feedback = $dataarray[12];
		$pharm_supervision = $dataarray[13];
		$coord_supervision = $dataarray[14];
		$req_id = $dataarray[15];
		$req_spec = $dataarray[16];
		$req_addr = $dataarray[17];
		$train_remarks = $dataarray[18];
		$train_recommend = $dataarray[19];
		$train_useful = $dataarray[20];
		$comf_issue = $dataarray[21];
		$comf_order = $dataarray[22];
		$comf_update = $dataarray[23];
		$comf_gen = $dataarray[24];
		$use_freq = $dataarray[25];
		$freq_spec = $dataarray[26];
		$improvement = $dataarray[27];
		$ease_of_use = $dataarray[28];
		$meet_expect = $dataarray[29];
		$expect_suggest = $dataarray[30];
		$retrain = $dataarray[31];

		$mydata = array('facility_code' => $facility_code, 'assessor' => $current_user, 'date' => $date, 'fhead_no' => $f_headno, 'fdep_no' => $f_depheadno, 'nurse_no' => $nurse_no, 'sman_no' => $store_mgrno, 'ptech_no' => $p_techno, 'trainer' => $trainer, 'comp_avail' => $comp_avail, 'modem_avail' => $modem_avail, 'bundles_avail' => $bundles_avail, 'manuals_avail' => $manuals_avail, 'satisfaction_lvl' => $satisfaction_lvl, 'agreed_time' => $agreed_time, 'feedback' => $feedback, 'pharm_supervision' => $pharm_supervision, 'coord_supervision' => $coord_supervision, 'req_id' => $req_id, 'req_spec' => $req_spec, 'req_addr' => $req_addr, 'train_remarks' => $train_remarks, 'train_recommend' => $train_recommend, 'train_useful' => $train_useful, 'comf_issue' => $comf_issue, 'comf_order' => $comf_order, 'comf_update' => $comf_update, 'comf_gen' => $comf_gen, 'use_freq' => $use_freq, 'freq_spec' => $freq_spec, 'improvement' => $improvement, 'ease_of_use' => $ease_of_use, 'meet_expect' => $meet_expect, 'expect_suggest' => $expect_suggest, 'retrain' => $retrain);

		echo Facility_Evaluation::save_facility_evaluation($mydata);

	}

	public function create_pie_chart($chart_data, $title, $option = null) {
		$chart = '<chart caption="' . $title . '" pieRadius="50" showPercentageValues="1" showPercentInToolTip="0" decimals="0"  bgColor="FFFFFF" showBorder="0" bgAlpha="100" exportEnabled="1" exportHandler="' . base_url() . 'scripts/FusionCharts/ExportHandlers/PHP/FCExporter.php" exportAtClient="0" exportAction="download">
' . $chart_data . '
</chart>';

		if ($option == "xml") :
			return $chart;
		else :
			echo $chart;
		endif;

	}

	public function create_multistacked_bar_graph($chart_data, $title, $option = null) {
		$chart = '<chart decimals="0" sDecimals="1" baseFontSize="10" stack100Percent="1" caption="' . $title . '" showPercentValues="0"  showLegend="1" caption=""  palette="3"numdivlines="3" useRoundEdges="1" showsum="0" bgColor="FFFFFF" showBorder="0" exportEnabled="1" exportHandler="' . base_url() . 'scripts/FusionCharts/ExportHandlers/PHP/FCExporter.php" exportAtClient="0" exportAction="download">
	' . $chart_data . '
</chart>';

		if ($option == "xml") :
			return $chart;
		else :
			echo $chart;
		endif;

	}

	public function facility_type($county_id) {

		$facility_type = historical_stock::get_facility_type($county_id);
		$facility_type_xml = '';

		foreach ($facility_type as $facility_data) :
			$facility_type_xml .= "<set label='$facility_data[owner]' value='$facility_data[total]'/>";
		endforeach;

		$this -> create_pie_chart($facility_type_xml, '');
	}

	public function personel_trained($county_id) {
		$personel_trained = historical_stock::get_personel_trained($county_id);

		$personel_trained_xml = '';

		//foreach($personel_trained as $personel_trained_data):

		$personel_trained_xml .= "<set label='Facility Head' value='" . $personel_trained[0]['fhead'] . "'/>";
		$personel_trained_xml .= "<set label='Facility Deputy Head' value='" . $personel_trained[0]['fdep'] . "'/>";
		$personel_trained_xml .= "<set label='Nurse' value='" . $personel_trained[0]['nurse'] . "'/>";
		$personel_trained_xml .= "<set label='Store Manager' value='" . $personel_trained[0]['sman'] . "'/>";
		$personel_trained_xml .= "<set label='Pharmacy Technologist' value='" . $personel_trained[0]['ptech'] . "'/>";

		$this -> create_pie_chart($personel_trained_xml, '');

	}

	public function training_satisfaction($county_id) {
		$training_satisfaction = historical_stock::get_training_satisfaction($county_id);
		$training_satisfaction_xml = '';

		foreach ($training_satisfaction as $training_satisfaction_data) :

			switch($training_satisfaction_data['satisfaction_lvl']) :
				case 1 :
					$training_satisfaction_xml .= "<set label='Very satisfied' value='$training_satisfaction_data[level]'/>";
					break;
				case 2 :
					$training_satisfaction_xml .= "<set label='Indifferent' value='$training_satisfaction_data[level]'/>";
					break;
				case 3 :
					$training_satisfaction_xml .= "<set label='Unsatisfied' value='$training_satisfaction_data[level]'/>";
					break;
				case 4 :
					$training_satisfaction_xml .= "<set label='I did not understand' value='$training_satisfaction_data[level]'/>";

					break;
			endswitch;

		endforeach;

		$this -> create_pie_chart($training_satisfaction_xml, '');

	}

	public function get_use_freq($county_id) {
		$training_resource = historical_stock::get_use_freq($county_id);

		$training_satisfaction_xml = '<dataset  showValues="1" color="">';
		$training_resource_xml_balance = '<dataset seriesName="Total"   showValues="1" color="">';

		$chart = "<categories>
    <category label='Daily' />
    <category label='Once a week' />
    <category label='Once every 2 weeks' />
    <category label='Never' />
    </categories>";

		foreach ($training_resource as $training_satisfaction_data) :
			switch($training_satisfaction_data['use_freq']) :
				case 1 :
					$training_satisfaction_xml .= "<set value='$training_satisfaction_data[level]'/>";
					break;
				case 2 :
					$training_satisfaction_xml .= "<set value='$training_satisfaction_data[level]'/>";
					break;
				case 3 :
					$training_satisfaction_xml .= "<set value='$training_satisfaction_data[level]'/>";
					break;
				case 4 :
					$training_satisfaction_xml .= "<set value='$training_satisfaction_data[level]'/>";

					break;
			endswitch;
		endforeach;

		$training_satisfaction_xml .= "</dataset>";
		$bal_1 = $training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_2=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_3=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		//$bal_4=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' /></dataset>";

		$this -> create_multistacked_bar_graph($chart . $training_satisfaction_xml . $training_resource_xml_balance, '');

	}

	public function get_training_resource($county_id) {
		$training_resource = historical_stock::get_training_resource($county_id);
		$training_resource_xml = '<dataset  showValues="1" color="">';
		$training_resource_xml_balance = '<dataset seriesName="Total"   showValues="1" color="">';

		$chart = "<categories>
    <category label='Computers' />
    <category label='Modems' />
    <category label='Bundles' />
    <category label='Manuals' />
    </categories>";

		$training_resource_xml .= "<set value='" . $training_resource[0]['comp'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['modem'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['bundles'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['manual'] . "' /></dataset>";
		$bal_1 = $training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_2=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_3=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_4=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' /></dataset>";

		$this -> create_multistacked_bar_graph($chart . $training_resource_xml . $training_resource_xml_balance, '');

	}

	public function get_county_evaluation_form_results() {
		$county_id = $this -> session -> userdata('county_id');
		$data['county_id'] = $county_id;
		$data['content_view'] = "county/county_report/facility_evaluation_report_v";
		$data['banner_text'] = "Facility Training Evaluation Results";
		$data['title'] = "Facility Training Evaluation Results";

		$data['sheduled_training'] = historical_stock::get_sheduled_training($county_id);
		$data['feedback_training'] = historical_stock::get_feedback_training($county_id);
		$data['pharm_supervision'] = historical_stock::get_pharm_supervision($county_id);
		$data['coord_supervision'] = historical_stock::get_coord_supervision($county_id);

		$data['req_id'] = historical_stock::get_req_id($county_id);
		$data['req_addr'] = historical_stock::get_req_addr($county_id);
		$data['retrain'] = historical_stock::get_retrain($county_id);

		$data['improvement'] = historical_stock::get_improvement($county_id);
		$data['ease_of_use'] = historical_stock::get_ease_of_use($county_id);
		$data['meet_expect'] = historical_stock::get_meet_expect($county_id);
		$data['train_useful'] = historical_stock::get_train_useful($county_id);
		$data['coverage_data'] = historical_stock::get_county_coverage_data($county_id);

		$this -> load -> view("template", $data);

	}

	public function get_level_of_comfort($county_id) {
		$training_resource = historical_stock::level_of_comfort($county_id);
		$training_resource_xml = '<dataset  showValues="1" color="">';
		$training_resource_xml_balance = '<dataset seriesName="Total"   showValues="1" color="">';

		$chart = "<categories>
    <category label='Issue Commodities' />
    <category label='Order Commodities' />
    <category label='Update Order' />
    <category label='Generate Reports' />
    </categories>";

		$training_resource_xml .= "<set value='" . $training_resource[0]['comp'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['modem'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['bundles'] . "' />";
		$training_resource_xml .= "<set value='" . $training_resource[0]['manual'] . "' /></dataset>";
		$bal_1 = $training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_2=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_3=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' />";
		// $bal_4=$training_resource[0]['total'];
		$training_resource_xml_balance .= "<set value='" . $bal_1 . "' /></dataset>";

		$this -> create_multistacked_bar_graph($chart . $training_resource_xml . $training_resource_xml_balance, '');

	}

	public function get_facility_evaluation_form_results() {

		//$district_id=null;
		//	$county_id=null;
		$access_level = $this -> session -> userdata('user_type_id');

		$district_id = ($access_level == 3) ? $this -> session -> userdata('district') : null;

		$county_id = ($access_level == 10) ? $this -> session -> userdata('county_id') : null;

		if (isset($county_id)) :
			$this -> get_county_evaluation_form_results();
		endif;

		$facility_raw_data = Facility_Evaluation::get_facility_evaluation_form_results($district_id, $county_id);

		$table_data = null;

		foreach ($facility_raw_data as $key => $data) {
			$table_data .= "<tr>
		<td class='center'>$data[facility_code]</td>
		<td class='center'>$data[facility_name]</td>
		<td class='center'>$data[total_users]</td>
		<td class='center'>$data[responses]</td>		
		</tr>";
		}

		$data['facility_response'] = $table_data;
		$data['title'] = "Facility Training Evaluation Results";
		$data['content_view'] = "district/district_report/facility_evaluation_report_v";
		$data['banner_text'] = "Facility Training Evaluation Results";

		$this -> load -> view("template", $data);

	}

	public function get_facility_evaluation_data($facility_code) {

		$data = Facility_Evaluation::get_people_who_have_responded($facility_code);

		$table_data = '<table  cellspacing="0" border="0" width="100%"><tr><th>Responednt</th><th>Trainer</th><th>Date</th><th>view</th></tr>';

		foreach ($data as $key => $facility_data) :

			$date = date('d M Y', strtotime($facility_data['date_created']));

			$table_data .= "<tr><td>$facility_data[fname] $facility_data[lname] </td><td>$facility_data[trainer] </td><td>$date</td>
	<td><a href='" . base_url() . "report_management/facility_evaluation/$facility_data[facility_code]/$facility_data[assessor]' class='link'>view response</a></td></tr>";

		endforeach;

		echo $table_data . "</table>";

	}

	public function get_county_district_access_list() {

		$first_day_of_the_month = date("Y-m-1", strtotime("this month"));
		$last_day_of_the_month = date("Y-m-t", strtotime("this month"));

		$date_1 = new DateTime($first_day_of_the_month);
		$date_2 = new DateTime($last_day_of_the_month);

		$county_id = $this -> session -> userdata('county_id');
		$district_data = districts::getDistrict($county_id);

		$series_data = array();
		$category_data = array();

		$interval = $date_1 -> diff($date_2);

		for ($i = 0; $i < $interval -> d; $i++) :

			$day = 1 + $i;

			$new_date = date("Y") . "-" . date("m") . "-" . $day;

			$new_date = date('Y-m-d', strtotime($new_date));

			if (date('N', strtotime($new_date)) < 6) {
				//echo $new_date."<BR>";
				$date_ = date('D d', strtotime($new_date));
				$category_data = array_merge($category_data, array($date_));

				$temp_1 = array();

				foreach ($district_data as $district_) :

					$district_id = $district_ -> id;
					$district_name = $district_ -> district;
					$county_data = Log::get_county_login_count($county_id, $district_id, $new_date);

					(array_key_exists($district_name, $series_data)) ? $series_data[$district_name] = array_merge($series_data[$district_name], array((int)$county_data[0]['total'])) : $series_data = array_merge($series_data, array($district_name => array((int)$county_data[0]['total'])));

				endforeach;

			} else {
				// do nothing
			}

		endfor;
		$string = null;

		print_r($series_data);
		exit ;
		foreach ($series_data as $key => $raw_data) :

			/*$string .="{
			 name: '$key',
			 data:[
			 ";*/

			print_r($raw_data);
			exit ;

			/* foreach ($raw_data as $key_data):

			 $string .="$key_data,";

			 endforeach;
			 $string .="]},";*/
		endforeach;

		echo $string;

	}

}

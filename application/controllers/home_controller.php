<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->home();
    }

    public function home($pop_up = NULL) {
        (!$this->session->userdata('user_id')) ? redirect('user') : null;

        $data['title'] = "Home";
        $access_level = $this->session->userdata('user_indicator');
        $facility_c = $this->session->userdata('news');


        /* go to application/controllers/home_controller.php and check for this if statement */
        if ($access_level == "scmlt") {
//            print_r($this->session->userdata());die; 
           /* $district = $this->session->userdata('district_id');
            $data['facilities'] = Facilities::get_total_facilities_rtk_in_district($district);
            $facilities = Facilities::get_total_facilities_rtk_in_district($district);
            $district_name = districts::get_district_name_($district);

            // $facilities=Facilities::get_facility_details(6);
            $table_body = '';
            $reported = 0;
            $nonreported = 0;

            foreach ($facilities as $facility_detail) {

                date_default_timezone_set("EUROPE/Moscow");
                $lastmonth = date('F', strtotime("last day of previous month"));
                $table_body .="<tr><td><a class='ajax_call_1' id='county_facility' name='" . base_url() . "rtk_management/get_rtk_facility_detail/$facility_detail[facility_code]' href='#'>" . $facility_detail["facility_code"] . "</td>";
                $table_body .="<td>" . $facility_detail['facility_name'] . "</td><td>" . $district_name['district'] . "</td>";
                $table_body .="<td>";

                $lab_count = lab_commodity_orders::get_recent_lab_orders($facility_detail['facility_code']);
//           echo "<pre>";print_r($lab_count);echo "</pre>";
                if ($lab_count > 0) {
                    $reported = $reported + 1;
                    //".site_url('rtk_management/get_report/'.$facility_detail['facility_code'])."
                    $table_body .="<span class='label label-success'>Submitted  for    $lastmonth </span><a href=" . site_url('rtk_management/rtk_orders') . " class='link'> View</a></td>";
                } else {
                    $nonreported = $nonreported + 1;
                    $table_body .="<span class='label label-danger'>  Pending for $lastmonth </span> <a href=" . site_url('rtk_management/get_report/' . $facility_detail['facility_code']) . " class='link'> Report</a></td>";
                }

                $table_body .="</td>";
            }
            $county = $this->session->userdata('county_name');
            $countyid = $this->session->userdata('county_id');
            $data['countyid'] = $countyid;
            $data['county'] = $county;
            $data['table_body'] = $table_body;
            $data['content_view'] = "rtk/rtk/dpp/dpp_home_with_table";
            $data['banner_text'] = "Home";
            $data['link'] = "home";
            $total = $reported + $nonreported;
            $percentage_complete = $reported / $total * 100;
            $percentage_complete = number_format($percentage_complete, 0);
            $data['percentage_complete'] = $percentage_complete;
            $data['reported'] = $reported;
            $data['nonreported'] = $nonreported;*/
            redirect('rtk_management/scmlt_home');

        } else if ($access_level == "rtk_manager") {

            redirect('rtk_management/rtk_manager_home');
        } else if ($access_level == "rtk_county_admin") {
            redirect('rtk_management/county_home');
        } else if ($access_level == "rtk_partner_admin") {
            redirect('rtk_management/partner_home');
        }else if ($access_level == "rtk_partner_super") {
            redirect('rtk_management/partner_home');
		}
		else if ($access_level == "allocation_committee") {
            redirect('rtk_management/allocation_dashboard');
        }
//             $counties = Counties::getAll();
//             $table_data = "";
//             $allocation_rate = 0;
//             $total_facilities_in_county = 0;
//             $total_facilities_allocated_in_county = 1;
//             $total_facilities = 0;
//             $total_allocated = 0;

//             foreach ($counties as $county_detail) {
//                 $countyid = $county_detail->id;

//                 $this->load->database();
//                 $facilities_in_county = $this->db->query('SELECT * 
//     FROM facilities, districts, counties
//     WHERE facilities.district = districts.id
//     AND districts.county = counties.id
//     AND counties.id =' . $countyid . '
//     AND facilities.rtk_enabled =1');
//                 $facilities_num = $facilities_in_county->num_rows();
//                 $q = 'SELECT DISTINCT lab_commodity_orders.id, lab_commodity_orders.facility_code
// FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders
// WHERE lab_commodity_details.facility_code = facilities.facility_code
// AND counties.id = districts.county
// AND counties.id =' . $countyid . '
// AND facilities.district = districts.id
// AND lab_commodity_details.order_id = lab_commodity_orders.id
// AND lab_commodity_details.allocated >0';

//                 $allocated_facilities = $this->db->query($q);

//                 $allocated_facilities_num = $allocated_facilities->num_rows();

//                 // $county_map_id=$county_detail->kenya_map_id;
//                 $countyname = trim($county_detail->county);
//                 $county_detail = rtk_stock_status::get_allocation_rate_county($countyid);
// //                var_dump($county_detail);
//                 //               die;
// //     $total_facilities_in_county=$county_detail['total_facilities_in_county'];
//                 $total_facilities_in_county = $total_facilities_in_county + $facilities_num;

//                 $total_facilities_allocated_in_county = $county_detail['total_facilities_allocated_in_county'];

//                 $total_facilities = $total_facilities + $facilities_num;
//                 $total_allocated = $total_allocated + $allocated_facilities_num;

//                 $table_data .="<tr><td><a href=" . site_url() . "rtk_management/allocation_county_detail_zoom/$countyid> $countyname</a> </td><td>$allocated_facilities_num / $facilities_num</td></tr>";
//             }
//             $table_data .="<tr><td>TOTAL </td><td>  $total_allocated |  $total_facilities_in_county  </td><tr>";




//             $data['table_data'] = $table_data;
//             $data['pop_up'] = $pop_up;
//             $data['counties'] = $counties = Counties::getAll();
//             $data['content_view'] = "allocation_committee/home_v";
//         }

//         $data['banner_text'] = "Home";
//         $data['link'] = "home";
//         $this->load->view("rtk/template", $data);
    }

}

<?php
/*

*/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once ('home_controller.php');

class Rtk_Management extends Home_controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        ini_set('memory_limit', '-1');
        ini_set('max_input_vars', 3000);
    }

    public function index() {
        echo "|";
    }

    public function national_rtk_allocation() {
        $data['title'] = "National RTK Allocations";
        $data['banner_text'] = "National RTK Allocations";
        $data['title'] = " National RTK Allocations";
        $data['content_view'] = "rtk/allocation_committee/national_rtk_allocations";
        $data['allocations'] = $this->allocation();
        $this->load->view("rtk/template", $data);
    }

    public function allocations_county_view() {
        $data['title'] = '';
        $data['banner_text'] = 'Allocations by County';
        $data['content_view'] = 'allocation_committee/county_allocation';
        $tdata = '';
        $allocated_facilities = array();
        $allcounties = $this->db->query('SELECT county,id FROM  `counties` ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
                FROM lab_commodity_details, counties, facilities, districts
                WHERE lab_commodity_details.facility_code = facilities.facility_code
                AND counties.id = districts.county
                AND counties.id =' . $id . '
                AND facilities.district = districts.id
                AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                array_push($allocated_facilities, $allocations_arr['facility_code']);
            }
            $allocated_facilities = array_unique($allocated_facilities);
            $no_of_allocated_facilities = count($allocated_facilities);
            $num = $allocations->num_rows();
            if ($num > 1) {
                $tdata .= '<tr><td>' . $County . '</td><td>July</td><td>' . $no_of_allocated_facilities . '/413</td><td>' . $num . '</td><td><a href="allocations_county/' . $id . '">View</a> <!--<a onClick="downloadcounty(' . $id . ')">Download</a> --></td></tr>';
            }
        }
        $sql = "select * from counties";
        $res = $this->db->query($sql);
        $counties = $res->result_array();
        $counties = str_replace('\\\'()-/', '', json_encode($counties));
        $counties = addslashes($counties);

        $sql1 = "select * from districts";
        $res1 = $this->db->query($sql1);
        $districts = $res1->result_array();
        $districts = str_replace('\\\'()-/', '', json_encode($districts));
        $districts = addslashes($districts);

        $sql2 = "select * from facilities where rtk_enabled='1'";
        $res2 = $this->db->query($sql2);
        $facilities = $res2->result_array();
        $facilities = str_replace('\\/()', '', json_encode($facilities));
        $facilities = addslashes($facilities);

        $data['counties'] = $counties;
        $data['districts'] = $districts;
        $data['facilities'] = $facilities;

        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function getallocations() {
        $allocations_form = $_POST['allocations_form'];
        $switch_category = $_POST['switch_category'];
        $zone = $_POST['switch_zones'];
        $facility = $_POST['switch_facilities'];
        $district = $_POST['switch_districts'];
        $county = $_POST['switch_counties'];
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];

//    $this->allocation($zone, $county , $district,$facility , $sincedate,$enddate);
    }

    function country_progress(){
        rtk_summary_county();
    }

    public function rtk_manager($Countyid = null) {
        $res = $this->db->query('select count(id) as total_facilities from facilities where rtk_enabled=1');
        $result = $res->result_array();
        $data['total_facilities'] = $result[0]['total_facilities'];


        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', time());
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $monthyear = $year . '-' . $month . '-1';
        $englishdate = date('F, Y', strtotime($monthyear));
        $reporting_rates = $this->reporting_rates();
        $xArr = array();
        $yArr = array();
        $xArr1 = array();
        $cumulative_result = 0;

        foreach ($reporting_rates as $value) {
            $count = $value['count'];
            $order_date = substr($value['order_date'], -2);
            $order_date = date('jS', strtotime($value['order_date']));

            $cumulative_result +=$count;
            array_push($xArr1, $cumulative_result);

            array_push($yArr, $order_date);
            array_push($xArr, $count);
        }

        $data['stock_status'] = $this->_national_reports_sum($year, $month);
        $data['cumulative_result'] = $cumulative_result;
        $data['jsony'] = json_encode($yArr);
        $data['jsonx'] = str_replace('"', "", json_encode($xArr));
        $data['jsonx1'] = str_replace('"', "", json_encode($xArr1));
        $data['englishdate'] = $englishdate;
        $County = $this->session->userdata('county_name');
        $data['county'] = $County;
        $Countyid = $this->session->userdata('county_id');
        $data['user_logs'] = $this->rtk_logs();
        $data['content_view'] = "rtk/rtk/dashboard_view";
        $data['banner_text'] = "RTK Manager";
        $data['title'] = "RTK Manager";
        $this->load->view('rtk/template', $data);
    }

    public function rtk_manager_home() {
        $data = array();
        $data['title'] = 'RTK Manager';
        $data['banner_text'] = 'RTK Manager';
        $data['content_view'] = "rtk/rtk/home_v";
        $counties = $this->_all_counties();
        $county_arr = array();
        foreach ($counties as $county) {
            array_push($county_arr, $county['county']);
        }
        $counties_json = json_encode($county_arr);
        $counties_json = str_replace('"', "'", $counties_json);
        $data['counties_json'] = $counties_json;

        $thismonth = date('m', time());
        $thismonth_year = date('Y', time());
        $thismonth_arr = $this->rtk_summary_country_wide($thismonth_year, $thismonth);
        $thismonthjson = json_encode($thismonth_arr);
        $thismonthjson = str_replace('"', "", $thismonthjson);
        $data['thismonthjson'] = $thismonthjson;


        $previous_month = date('m', strtotime("-1 month", time()));
        $previous_month_year = date('Y', strtotime("-1 month", time()));
        $previous_month_arr = $this->rtk_summary_country_wide($previous_month_year, $previous_month);
        $previous_monthjson = json_encode($previous_month_arr);
        $previous_monthjson = str_replace('"', "", $previous_monthjson);
        $data['previous_monthjson'] = $previous_monthjson;


        $prev_prev = date('m', strtotime("-2 month", time()));
        $prev_prev_year = date('Y', strtotime("-2 month", time()));

        $prev_prev_month_arr = $this->rtk_summary_country_wide($prev_prev_year, $prev_prev);
        $prev_prev_monthjson = json_encode($prev_prev_month_arr);
        $prev_prev_monthjson = str_replace('"', "", $prev_prev_monthjson);
        $data['prev_prev_monthjson'] = $prev_prev_monthjson;

        $this->load->view('rtk/template', $data);
    }

    public function rtk_manager_admin() {
        $data['title'] = 'RTK Manager';
        $data['banner_text'] = 'RTK Manager';
        $data['content_view'] = "rtk/rtk/admin/admin_home_view";

        $users = $this->_get_rtk_users();        
        $data['users'] = $users;
        $this->load->view('rtk/template', $data);
    }

    function _get_rtk_users() {
        //get county_admins
        $q = 'SELECT access_level.level,
        user.email, user.id AS user_id,user.fname,user.lname,user.email,user.county_id,
        user.district,counties.county,user.usertype_id FROM access_level,
        user,counties 
        WHERE user.county_id = counties.id AND user.usertype_id = access_level.id
        AND user.usertype_id = 13 ORDER BY `user`.`district` ASC';
       
        $res = $this->db->query($q);
        $arr = $res->result_array();
        $q2 = 'SELECT access_level.level,user.email,user.id AS user_id,user.fname,user.lname,user.email,user.county_id,districts.district as district,counties.county,user.usertype_id
        FROM access_level,user,counties,districts 
        WHERE user.district = districts.id
        AND districts.county = counties.id
        AND user.county_id = counties.id
        AND user.usertype_id = access_level.id
        AND user.usertype_id = 7';
        $res2 = $this->db->query($q2);
        $arr2 = $res2->result_array();
        $returnable = array_merge($arr, $arr2);
        return $returnable;
    }

    public function county_home() {
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($countyid);
        $county_name = counties::get_county_name($countyid);
        $County = $county_name[0]['county'];

        $reports = array();
        $tdata = ' ';
        foreach ($districts as $value) {
            $q = $this->db->query('SELECT lab_commodity_orders.id, lab_commodity_orders.facility_code, lab_commodity_orders.compiled_by, lab_commodity_orders.order_date, lab_commodity_orders.district_id, districts.id as distid, districts.district, facilities.facility_name, facilities.facility_code FROM districts, lab_commodity_orders, facilities WHERE lab_commodity_orders.district_id = districts.id AND facilities.facility_code = lab_commodity_orders.facility_code AND districts.id = ' . $value['id'] . '');
            $res = $q->result_array();
            foreach ($res as $values) {
                date_default_timezone_set('EUROPE/Moscow');
                $order_date = date('F', strtotime($values['order_date']));
                $tdata .= '<tr>
                <td>' . $order_date . '</td>
                <td>' . $values['facility_code'] . '</td>
                <td>' . $values['facility_name'] . '</td>
                <td>' . $values['district'] . '</td>
                <td>' . $values['order_date'] . '</td>
                <td>' . $values['compiled_by'] . '</td>
                <td><a href="' . base_url() . 'rtk_management/lab_order_details/' . $values['id'] . '">View</a></td>
                <tr>';
            }
            if (count($res) > 0) {
                array_push($reports, $res);
            }
        }
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', strtotime('-1 month'));
        }

        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);


        $monthyear = $year . '-' . $month . '-1';
        $englishdate = date('F, Y', strtotime($monthyear));
        $data['graphdata'] = $this->county_reporting_percentages($countyid, $year, $month);
        $data['county_summary'] = $this->_requested_vs_allocated($year, $month, $countyid);
        $data['tdata'] = $tdata;

        $data['county'] = $County;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = 'RTK County Admin';
        $data['content_view'] = "rtk/rtk/rca/home";
        $this->load->view("rtk/template", $data);
    }

    public function rca_pending_facilities() {
        $countyid = $this->session->userdata('county_id');        
        $districts = districts::getDistrict($countyid);
        $county_name = counties::get_county_name($countyid);

        $County = $county_name['county'];
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', strtotime('-1 month'));
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $date = date('F-Y', mktime(0, 0, 0, $month, 1, $year));       
        $pending_facilities = $this->rtk_facilities_not_reported(NULL, $countyid,NULL,NULL, $year,$month);
        $new_pending_facilities = array();                
        $data['county'] = $County;
        $data['pending_facility'] = $pending_facilities;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = 'RTK County Admin: Pending Facilities';
        $data['content_view'] = "rtk/rtk/rca/pending_facilities_v";
        $this->load->view("rtk/template", $data);
    }

    public function rtk_non_reporting_by_district_allocation($district, $year, $month) {
        // shows unreported facilities in a district
        date_default_timezone_set('EUROPE/moscow');

        $month = $month + 1;
        $prev_month = $month - 1;
        $last_day_current_month = date('Y-m-d', mktime(0, 0, 0, $month, 0, $year));
        $last_day_previous_month = date('Y-m-d', mktime(0, 0, 0, $prev_month, 0, $year));
        $lastday_thismonth = date('Y-m-d', strtotime("last day of this month"));

        $reporting = array();
        $reported = array();
        $facil = 'SELECT facilities.facility_code, facility_name FROM  `facilities` WHERE  `district` =' . $district . ' AND  `rtk_enabled` =1';
        $facil_q = $this->db->query($facil);
        $facil_res = $facil_q->result_array();
        foreach ($facil_res as $facil_vals) {
            $facil_vals['facility_code'] = $facil_vals['facility_code'] = $facil_vals['facility_code'] . ' - ' . $facil_vals['facility_name'];
            array_push($reporting, $facil_vals['facility_code']);
        }

        $query = "SELECT DISTINCT lab_commodity_orders.facility_code, facilities.facility_code, facilities.facility_name, lab_commodity_orders.id, lab_commodity_orders.district_id, lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties, facilities
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN  '$last_day_previous_month'
        AND  '$last_day_current_month'";

        $q = $this->db->query($query);
        $res = $q->result_array();
        foreach ($res as $val) {
            $val['facility_code'] = $val['facility_code'] . ' - ' . $val['facility_name'];
            array_push($reported, $val['facility_code']);
        }
        $my_unreported_facilities = array();
        $unreported = array_diff($reporting, $reported);
        foreach ($unreported as $key => $unreported_data) {
            array_push($my_unreported_facilities, $unreported_data);
        }
        return $my_unreported_facilities;
    }

    public function rca_districts_home() {
        date_default_timezone_set('EUROPE/moscow');
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($countyid);
        $county_name = counties::get_county_name($countyid);
        $County = $county_name[0]['county'];
        $reports = array();
        $tdata = ' ';
        foreach ($districts as $value) {
            $q = $this->db->query('SELECT lab_commodity_orders.id, lab_commodity_orders.facility_code, lab_commodity_orders.compiled_by, lab_commodity_orders.order_date, lab_commodity_orders.district_id, districts.id as distid, districts.district, facilities.facility_name, facilities.facility_code FROM districts, lab_commodity_orders, facilities WHERE lab_commodity_orders.district_id = districts.id AND facilities.facility_code = lab_commodity_orders.facility_code AND districts.id = ' . $value['id'] . '');
            $res = $q->result_array();
            foreach ($res as $values) {
                date_default_timezone_set('EUROPE/Moscow');
                $order_date = date('F', strtotime($values['order_date']));
                $tdata .= '<tr>
                <td>' . $order_date . '</td>
                <td>' . $values['facility_code'] . '</td>
                <td>' . $values['facility_name'] . '</td>
                <td>' . $values['district'] . '</td>
                <td>' . $values['order_date'] . '</td>
                <td>' . $values['compiled_by'] . '</td>
                <td><a href="' . base_url() . 'rtk_management/lab_order_details/' . $values['id'] . '">View</a></td>
                <tr>';
            }
            if (count($res) > 0) {
                array_push($reports, $res);
            }
        }
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', time());
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $monthyear = $year . '-' . $month . '-1';
        $englishdate = date('F, Y', strtotime($monthyear));
        $data['graphdata'] = $this->county_reporting_percentages($countyid, $year, $month);
        $data['county_summary'] = $this->_requested_vs_allocated($year, $month, $countyid);
        $data['tdata'] = $tdata;

        $data['county'] = $County;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = 'RTK County Admin';
        $data['content_view'] = "rtk/rtk/rca/districts_v";
        $this->load->view("rtk/template", $data);
    }

//Function to get all the facilities and the districts
    public function rca_districts() {
        $county = $this->session->userdata('county_id');
        date_default_timezone_set('EUROPE/moscow');
        $districts = districts::getDistrict($county);
        $county_name = counties::get_county_name($county);
        $County = $county_name[0]['county'];
        $table_data_facilities = array();
        $res_district = $this->_districts_from_county($county);
        $data['districts_list'] = $res_district;

        $count_districts = count($res_district);
        $data['count_districts'] = $count_districts;
        for ($i = 0; $i < $count_districts; $i++) {
            $district_id = $res_district[$i]['id'];
            $sql1 = "SELECT * FROM facilities WHERE facilities.district = '$district_id' and facilities.rtk_enabled = '1'";
            $q = $this->db->query($sql1);
            $res = $q->result_array();
            $count = count($res);
            array_push($table_data_facilities, $count);
        }
        $data['facilities_count'] = $table_data_facilities;
        $data['county'] = $County;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = "RTK County Admin: Sub-Counties in $County County";
        $data['content_view'] = "rtk/rtk/rca/districts_v";
        $this->load->view("rtk/template", $data);
    }

    public function rca_facilities_reports() {


        $county = $this->session->userdata('county_id');

        date_default_timezone_set('EUROPE/moscow');
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $districts = districts::getDistrict($county);
        $county_name = counties::get_county_name($county);         
        $County = $county_name['county'];        
        $sql = "SELECT lab_commodity_orders.id, lab_commodity_orders.facility_code, lab_commodity_orders.compiled_by, lab_commodity_orders.order_date, lab_commodity_orders.district_id, districts.district, facilities.facility_name, facilities.facility_code
        FROM lab_commodity_orders,  facilities, districts, counties
        WHERE districts.county = counties.id
        AND facilities.district = districts.id
        AND lab_commodity_orders.facility_code = facilities.facility_code
        AND counties.id = $county 
        ORDER BY   `lab_commodity_orders`.`order_date` DESC ,`lab_commodity_orders`.`district_id` ASC";

        $res = $this->db->query($sql);
        $res = $res->result_array();

        $data['reports'] = $res;

        $data['county'] = $County;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = "RTK County Admin: Available Reports for $County County";
        $data['content_view'] = "rtk/rtk/rca/facilities_reports_v";
        $this->load->view("rtk/template", $data);
    }

    public function county_admin($sk = null) {
        $data = array();
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $County = $this->session->userdata('county_name');
        $Countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($Countyid);

        $facilities = $this->_facilities_in_county($Countyid);
        $users = $this->_users_in_county($Countyid, 7);        
        $data['facilities'] = $facilities;
        $data['users'] = $users;
        $data['districts'] = $this->_districts_in_county($Countyid);

        $data['sk'] = $sk;
        $data['county'] = $County;
        $data['countyid'] = $Countyid;
        $data['title'] = 'RTK County Admin';
        $data['banner_text'] = 'RTK County Admin';
        $data['content_view'] = "rtk/rtk/rca/admin_dashboard_view";
        $this->load->view("rtk/template", $data);
    }

    public function facility_profile($mfl) {
        $data = array();
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $County = $this->session->userdata('county_name');
        $Countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($Countyid);         
        $sql = "select * from facilities where facility_code=$mfl";        
        $facility = $this->db->query($sql)->result_array();
        //$facility = facilities::get_facility_name($mfl);        
        $mfl =  $facility[0]['facility_code'];       
        $data['reports'] = $this->_monthly_facility_reports($mfl);
        
        $data['facility_county'] = $data['reports'][0]['county'];
        $data['facility_district'] = $data['reports'][0]['district'];
        $data['district_id'] = $data['reports'][0]['district_id'];
        $data['facilities_in_district'] = json_encode($this->_facilities_in_district($data['district_id']));
        $data['facilities_in_district'] = str_replace('"', "'", $data['facilities_in_district']);

        $data['county_id'] = $data['reports'][0]['county_id'];
        $data['districts'] = $districts;
        $data['county'] = $County;
        $data['mfl'] = $mfl;
        $data['countyid'] = $Countyid;
        $data['title'] = $facility[0]['facility_name'] . '-' . $mfl;
        $data['facility_name'] = $facility['facility_name'];
        $data['banner_text'] = 'Facility Profile: ' . $facility[0]['facility_name'] . '-' . $mfl;
        $data['content_view'] = "rtk/rtk/facility_profile_view";

        $this->load->view("rtk/template", $data);
    }

    public function district_profile($district) {
        $data = array();
        $lastday = date('Y-m-d', strtotime("last day of previous month"));

        $current_month = $this->session->userdata('Month');
        if ($current_month == '') {
            $current_month = date('mY', time());
        }

        $previous_month = date('m', strtotime("last day of previous month"));
        $previous_month_1 = date('mY', strtotime('-2 month'));
        $previous_month_2 = date('mY', strtotime('-3 month'));


        $year_current = substr($current_month, -4);
        $year_previous = date('Y', strtotime("last day of previous month"));
        $year_previous_1 = substr($previous_month_1, -4);
        $year_previous_2 = substr($previous_month_2, -4);

        $current_month = substr_replace($current_month, "", -4);        
        $previous_month_1 = substr_replace($previous_month_1, "", -4);
        $previous_month_2 = substr_replace($previous_month_2, "", -4);

        $monthyear_current = $year_current . '-' . $current_month . '-1';
        $monthyear_previous = $year_previous . '-' . $previous_month . '-1';
        $monthyear_previous_1 = $year_previous_1 . '-' . $previous_month_1 . '-1';
        $monthyear_previous_2 = $year_previous_2 . '-' . $previous_month_2 . '-1';

        $englishdate = date('F, Y', strtotime($monthyear_current));

        $m_c = date("F", strtotime($monthyear_current));
        //first month               
        $m0 = date("F", strtotime($monthyear_previous));
        $m1 = date("F", strtotime($monthyear_previous_1));
        $m2 = date("F", strtotime($monthyear_previous_2));

        $month_text = array($m2, $m1, $m0);

        $district_summary = $this->rtk_summary_district($district, $year_current, $current_month);
        $district_summary_prev = $this->rtk_summary_district($district, $year_previous, $previous_month);
        $district_summary1 = $this->rtk_summary_district($district, $year_previous_1, $previous_month_1);
        $district_summary2 = $this->rtk_summary_district($district, $year_previous_2, $previous_month_2);


        $county_id = districts::get_county_id($district_summary['district_id']);
        $county_name = counties::get_county_name($county_id['county']);
       

        $data['district_balances_current'] = $this->district_totals($year_current, $previous_month, $district);
        $data['district_balances_previous'] = $this->district_totals($year_previous, $previous_month, $district);
        $data['district_balances_previous_1'] = $this->district_totals($year_previous_1, $previous_month_1, $district);
        $data['district_balances_previous_2'] = $this->district_totals($year_previous_2, $previous_month_2, $district);


        $data['district_summary'] = $district_summary;
        
        $data['districts'] = $this->_districts_from_county($county_id['county']);

        $data['facilities'] = $this->_facilities_in_district($district);

        $data['district_name'] = $district_summary['district'];
        $data['county_id'] = $county_name['id'];
        $data['county_name'] = $county_name['county'];     

        $data['title'] = 'RTK County Admin - Sub-County Profile: ' . $district_summary['district'];
        $data['banner_text'] = 'Sub-County Profile: ' . $district_summary['district'];
        $data['content_view'] = "rtk/rtk/district_profile_view";
        $data['months'] = $month_text;

        $this->load->view("rtk/template", $data);
    }

    public function county_profile($county) {
        $data = array();
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $County = $this->session->userdata('county_name');
        $Countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($Countyid);
        $facility = facilities::get_facility_name_($mfl);

        $data['county'] = $County;
        $data['countyid'] = $Countyid;
        $data['title'] = 'Facility Profile: ' . $facility['facility_name'];
        $data['banner_text'] = 'Facility Profile: ' . $facility['facility_name'];
        $data['content_view'] = "rtk/rtk/county_profile_view";

        $this->load->view("rtk/template", $data);
    }

    public function national_profile() {
        $data = array();
        $month = $this->session->userdata('Month');
        if ($month == '') {
            $month = date('mY', strtotime('-1 month'));
        }
        $year = substr($month, -4);
        $month = substr_replace($month, "", -4);
        $monthyear = $year . '-' . $month . '-1';
        $englishdate = date('F, Y', strtotime($monthyear));

        $County = $this->session->userdata('county_name');
        $Countyid = $this->session->userdata('county_id');
        $districts = districts::getDistrict($Countyid);
        $data['englishdate'] = $englishdate;
        $data['national'] = $this->_requested_vs_allocated($year, $month);
        $data['county'] = $County;
        $data['countyid'] = $Countyid;
        $data['title'] = 'National Summary: ' . $englishdate;
        $data['banner_text'] = 'National Summary: ' . $englishdate;
        $data['content_view'] = "rtk/national_profile_view";

        $this->load->view("rtk/template", $data);
    }

    public function allocation_home() {

        $data['zone_a_stats'] = $this->zone_allocation_stats('a');
        $data['zone_b_stats'] = $this->zone_allocation_stats('b');
        $data['zone_c_stats'] = $this->zone_allocation_stats('c');
        $data['zone_d_stats'] = $this->zone_allocation_stats('d');

        $data['banner_text'] = 'National';
        $data['content_view'] = 'rtk/rtk/allocation/allocation_home_view';
        $data['title'] = 'National Summary: ';
        $this->load->view("rtk/template", $data);
    }

    function zone_allocation_stats($zone) {

        $last_allocation_sql = "SELECT lab_commodity_details.allocated_date 
        FROM facilities, lab_commodity_details
        WHERE facilities.facility_code = lab_commodity_details.facility_code
        AND lab_commodity_details.commodity_id
        BETWEEN 1 
        AND 3 
        AND facilities.Zone =  'Zone $zone'
        AND lab_commodity_details.allocated >0
        ORDER BY  `lab_commodity_details`.`allocated_date` DESC 
        LIMIT 0,1";

        $last_allocation_res = $this->db->query($last_allocation_sql);
        $last_allocation = $last_allocation_res->result_array();

        $last_allocation_date = $last_allocation[0]['allocated_date'];

        $three_months_ago = date("Y-m-", strtotime("-3 Month "));
        $three_months_ago .='1';

        $total_facilities_sql = "SELECT count(*) as total_facilities
        FROM facilities, districts, counties
        WHERE facilities.district = districts.id
        AND districts.county = counties.id
        AND facilities.zone = 'Zone $zone' 
        AND facilities.rtk_enabled =1";

        $res = $this->db->query($total_facilities_sql);
        $total_facilities_res = $res->result_array();
        $total_facilities = $total_facilities_res[0]['total_facilities'];

        $sql1 = "SELECT count(DISTINCT facilities.facility_code) as facilities_allocated
        FROM lab_commodity_orders, lab_commodity_details, facilities, counties, districts
        WHERE lab_commodity_orders.id = lab_commodity_details.order_id
        AND districts.county = counties.id
        AND lab_commodity_details.allocated > 0
        AND facilities.zone = 'Zone $zone'
        AND districts.id = facilities.district
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND facilities.rtk_enabled = 1
        AND lab_commodity_orders.order_date BETWEEN  '$three_months_ago'AND  NOW()";

        $res = $this->db->query($sql1);
        $facilities_allocated = $res->result_array();

        $facilities_allocated = $facilities_allocated[0]['facilities_allocated'];
        $allocation_percentage = $facilities_allocated / $total_facilities * 100;
        $allocation_percentage = number_format($allocation_percentage, $decimals = 0);

        $facilities_allocated;
        $zone_stats = array(
            'total_facilities' => $total_facilities,
            'facilities_allocated' => $facilities_allocated,
            'allocation_percentage' => $allocation_percentage,
            'last_allocation' => $last_allocation_date
        );
        return $zone_stats;
    }

    public function allocation_zone($zone = null) {
        if (!isset($zone)) {
            redirect('rtk_management/allocation_home');
        }
        $data['counties_in_zone'] = $this->_zone_counties($zone);
        $data['banner_text'] = 'National';
        $data['content_view'] = 'rtk/rtk/allocation/allocation_zone_view';
        $data['title'] = 'National Summary: ';
        $this->load->view("rtk/template", $data);
    }

    function _zone_counties($zone) {
        $returnable = array();
        $sql = "select Distinct counties.county, counties.id
        FROM  facilities,counties,districts
        WHERE  facilities.Zone = 'Zone $zone'
        AND facilities.district = districts.id
        AND districts.county = counties.id
        order by counties.county";

        $res = $this->db->query($sql);
        foreach ($res->result_array() as $value) {
            $allocation_stats = $this->_county_allocation_stats($value['id']);

            array_push($allocation_stats, $value['county']);
            array_push($allocation_stats, $value['id']);
            array_push($returnable, $allocation_stats);
        }

        return $returnable;
    }

    private function _county_allocation_stats($county) {
        /*
         * We'd like to know the county allocation status for the month
         */

        // Total Facilities in the county

        $three_months_ago = date("Y-m-", strtotime("-3 Month "));
        $three_months_ago .='1';
        $sql = "SELECT count(*) as total_facilities
        FROM facilities, districts, counties
        WHERE facilities.district = districts.id
        AND districts.county = counties.id
        AND counties.id = $county
        AND facilities.rtk_enabled =1";

        $sql1 = "SELECT count(DISTINCT facilities.facility_code) as facilities_allocated,
        lab_commodity_details.allocated_date as last_allocation
        FROM lab_commodity_orders, lab_commodity_details, facilities, counties, districts
        WHERE lab_commodity_orders.id = lab_commodity_details.order_id
        AND districts.county = counties.id
        AND counties.id = $county
        AND lab_commodity_details.allocated > 0
        AND districts.id = facilities.district
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND facilities.rtk_enabled = 1
        AND lab_commodity_orders.order_date BETWEEN  '$three_months_ago'AND  NOW()
        ORDER BY lab_commodity_details.allocated_date DESC";

        $res = $this->db->query($sql1);
        $facilities_allocated = $res->result_array();
        $last_allocation = $facilities_allocated[0]['last_allocation'];
        $facilities_allocated = $facilities_allocated[0]['facilities_allocated'];

        $res1 = $this->db->query($sql);
        $total_facilities = $res1->result_array();
        $total_facilities = $total_facilities[0]['total_facilities'];
        $allocation_percentage = $facilities_allocated / $total_facilities * 100;
        $allocation_percentage = number_format($allocation_percentage, 0);

        $returnable = array('facilities' => $total_facilities,
            'allocated_facilities' => $facilities_allocated,
            'allocation_percentage' => $allocation_percentage,
            'last_allocation' => $last_allocation);
        return $returnable;
    }

    function _users_in_county($county, $type = null) {
        $q = 'SELECT user.fname, user.lname, user.email, user.id AS id, user.telephone, districts.id AS district_id, districts.district 
        FROM user, districts
        WHERE user.district = districts.id
        AND county_id =' . $county;

        if ($type) {
            $q .= ' AND usertype_id =' . $type;
        }
        $res = $this->db->query($q);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function dmlt_district_action() {
        $action = $_POST['action'];
        $dmlt = $_POST['dmlt_id'];
        $district = $_POST['dmlt_district'];

        if ($action == 'add') {
            $this->_add_dmlt_to_district($dmlt, $district);
        } elseif ($action == 'remove') {
            $this->_remove_dmlt_from_district($dmlt, $district);
        }
        echo "Sub-County Added Successfully";
        //redirect('rtk_management/county_admin/users');
    }

    function _get_rca_counties($rca) {
        $sql = 'SELECT rca_county.rca AS user_id, counties.county, counties.id AS county_id
        FROM rca_county, counties
        WHERE rca_county.county = counties.id
        AND rca_county.rca =' . $rca;
        $res = $this->db->query($sql);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function remove_rca_from_county($rca, $county) {
        $this->_remove_rca_from_county($rca, $county);
        redirect('rtk_management/rtk_manager_admin');
    }

    function _remove_rca_from_county($rca, $county, $redirect_url) {
        $sql = "DELETE FROM `rca_county` WHERE  rca=$rca AND county = $county";
        $object_id = $rca;
        $this->logData('2', $object_id);
        $this->db->query($sql);
    }

    public function add_rca_to_county() {

        $rca = $_POST['rca_id'];
        $county = $_POST['county'];
        $this->_add_rca_to_county($rca, $county);
        redirect('rtk_management/rtk_manager_admin');
    }

    function _add_rca_to_county($rca, $county, $redirect_url) {
        $sql = "INSERT INTO `rca_county` (`id`, `rca`, `county`) VALUES (NULL, '$rca', '$county')";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('1', $object_id);
    }

    public function show_rca_counties($rca, $mode = NULL) {

        $counties = $this->_get_rca_counties($rca);
        if ($mode == '') {
            
        }
        foreach ($counties as $value) {
            echo '<a href="' . base_url() . 'rtk_management/remove_rca_from_county/' . $rca . '/' . $value['county_id'] . '" style="color: #DD6A6A;">' . $value['county'] . '</a>, ';
        }
    }

    function _add_dmlt_to_district($dmlt, $district) {
        $sql = "INSERT INTO `dmlt_districts` (`id`, `dmlt`, `district`) VALUES (NULL, $dmlt, $district);";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('1', $object_id);
    }

    public function remove_dmlt_from_district($dmlt, $district) {
        $this->_remove_dmlt_from_district($dmlt, $district);
        redirect('rtk_management/county_admin/users');
    }

    function _remove_dmlt_from_district($dmlt, $district, $redirect_url) {
        $sql = "DELETE FROM `dmlt_districts` WHERE  dmlt=$dmlt AND district = $district";

        $object_id = $dmlt;
        $this->logData('2', $object_id);
        $this->db->query($sql);
    }

    public function delete_user($user, $district, $redirect_url = null) {
        $sql = 'DELETE FROM `user` WHERE `id` =' . $user
                . ' AND  `usertype_id` =7'
                . ' AND  `district` =' . $district;

        $object_id = $user;
        $this->logData('2', $object_id);
        $this->db->query($sql);


        if ($redirect_url == 'county_user') {
            redirect('rtk_management/county_admin/users');
        }
        if ($redirect_url == 'rtk_manager') {
            redirect('rtk_management/rtk_manager_admin');
        } else {
            redirect('home_controller');
        }
    }

    public function delete_user_gen($user, $redirect_url = null) {
        $sql = 'DELETE FROM `user` WHERE `id` =' . $user;

        $object_id = $user;
        $this->logData('2', $object_id);
        $this->db->query($sql);

        if ($redirect_url == 'county_user') {
            redirect('rtk_management/county_admin/users');
        }
        if ($redirect_url == 'rtk_manager') {
            redirect('rtk_management/rtk_manager_admin');
        } else {
            redirect('home_controller');
        }
    }

    function _get_dmlt_districts($dmlt) {
        $sql = 'SELECT DISTINCT districts.district, districts.id
        FROM dmlt_districts, districts
        WHERE districts.id = dmlt_districts.district
        AND dmlt_districts.dmlt =' . $dmlt;
        $res = $this->db->query($sql);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function show_dmlt_districts($dmlt, $mode = NULL) {
        $districts = $this->_get_dmlt_districts($dmlt);
        if ($mode == '') {
            
        }
        foreach ($districts as $value) {
            echo '<a href="' . base_url() . 'rtk_management/remove_dmlt_from_district/' . $dmlt . '/' . $value['id'] . '" style="color: #DD6A6A;">' . $value['district'] . '</a>, ';
        }
    }

    function _facilities_in_county($county, $type = null) {
        $q = 'SELECT 
        facilities.id as facil_id,facilities.facility_name,facilities.owner,facilities.facility_code, facilities.rtk_enabled,
        districts.district as districtname, districts.id as district_id,
        counties.county, counties.id 
        from districts,counties,facilities 
        where facilities.district = districts.id
        AND districts.county = counties.id
        AND counties.id =' . $county . '
        ORDER BY  `districts`.`district` ASC ';
        $res = $this->db->query($q);
        $returnable = $res->result_array();
        return $returnable;
    }

    function _districts_in_county($county) {
        $q = 'SELECT id,district FROM  `districts` WHERE  `county` =' . $county;
        $this->db->query($q);
        $res = $this->db->query($q);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function rtk_non_reporting_by_district($district, $year, $month) {
        // shows unreported facilities in a district

        date_default_timezone_set('EUROPE/moscow');

        $month = $month + 1;
        $prev_month = $month - 1;
        $last_day_current_month = date('Y-m-d', mktime(0, 0, 0, $month, 0, $year));
        $last_day_previous_month = date('Y-m-d', mktime(0, 0, 0, $prev_month, 0, $year));
        $lastday_thismonth = date('Y-m-d', strtotime("last day of this month"));

        $reporting = array();
        $reported = array();
        $facil = 'SELECT facilities.facility_code, facility_name FROM  `facilities` WHERE  `district` =' . $district . ' AND  `rtk_enabled` =1';
        $facil_q = $this->db->query($facil);
        $facil_res = $facil_q->result_array();
        foreach ($facil_res as $facil_vals) {
            $facil_vals['facility_code'] = $facil_vals['facility_code'] = $facil_vals['facility_code'] . ' - ' . $facil_vals['facility_name'];
            array_push($reporting, $facil_vals['facility_code']);
            //       array_push($reporting, $facil_vals['facility_name']);
        }

        $query = "SELECT DISTINCT lab_commodity_orders.facility_code, facilities.facility_code, facilities.facility_name, lab_commodity_orders.id, lab_commodity_orders.district_id, lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties, facilities
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN  '$last_day_previous_month'
        AND  '$last_day_current_month'";

        $q = $this->db->query($query);
        $res = $q->result_array();
        foreach ($res as $val) {
            $val['facility_code'] = $val['facility_code'] . ' - ' . $val['facility_name'];
            array_push($reported, $val['facility_code']);
        }
        $unreported = array_diff($reporting, $reported);
        foreach ($unreported as $key => $unreported_data) {
            echo '<tr><td>' . $unreported_data . '</td></tr>';
        }
    }

    function district_reporting_percentages($district, $year, $month) {


        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));
        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;

        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $q = 'SELECT * FROM  `facilities` WHERE  `district` =' . $district . ' AND  `rtk_enabled` =1';
        $q2 = "SELECT DISTINCT lab_commodity_orders.facility_code, facilities.facility_code, facilities.facility_name, lab_commodity_orders.id, lab_commodity_orders.district_id, lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties, facilities
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN  '$firstday'
        AND  '$lastdate'";
        $query = $this->db->query($q);
        $query2 = $this->db->query($q2);
        $percentage = $query2->num_rows() / $query->num_rows() * 100;
        $percentage = number_format($percentage, $decimals = 0);
        return $percentage;
    }

    function county_reporting_percentages($county, $year, $month) {
        $q = 'SELECT counties.id as county_id,counties.county as countyname,districts.district,districts.county,districts.id as district_id
        FROM  `districts`,`counties` 
        WHERE districts.county = counties.id 
        AND  counties.`id` =' . $county . '';
        $districts = array();
        $reported = array();
        $nonreported = array();
        $query = $this->db->query($q);
        foreach ($query->result_array() as $val) {
            array_push($districts, $val['district']);
            $percentage_reported = $this->district_reporting_percentages($val['district_id'], $year, $month);
            $percentage_reported = $percentage_reported + 0;
            if ($percentage_reported > 100) {
                $percentage_reported = 100;
            }
            array_push($reported, $percentage_reported);
            $percentage_non_reported = 100 - $percentage_reported;
            array_push($nonreported, $percentage_non_reported);
        }

        $districts = json_encode($districts);
        $reported = json_encode($reported);
        $nonreported = json_encode($nonreported);

        $data['districts'] = $districts;
        $data['reported'] = $reported;
        $data['nonreported'] = $nonreported;
        //        $this->load->view('rtk/rtk/rca/county_reporting_view', $data);
        return $data;
    }

    public function rtk_summary_district($district, $year, $month) {
        $distname = districts::get_district_name($district);
        $districtname = $distname[0]['district'];
        $district_id = $district;
        $returnable = array();
        $nonreported;
        $reported_percentage;
        $late_percentage;

        // Sets the timezone and date variables for last day of previous month and this month
        date_default_timezone_set('EUROPE/moscow');
        $month = $month + 1;
        $prev_month = $month - 1;
        $last_day_current_month = date('Y-m-d', mktime(0, 0, 0, $month, 0, $year));
        $first_day_current_month = date('Y-m-', mktime(0, 0, 0, $month, 0, $year));
        $first_day_current_month .= '1';
        $lastday_thismonth = date('Y-m-d', strtotime("last day of this month"));
        $month -= 1;
        $day10 = $year . '-' . $month . '-10';
        $day11 = $year . '-' . $month . '-11';
        $day12 = $year . '-' . $month . '-12';
        $late_reporting = 0;
        $text_month = date('F', strtotime($day10));

        $q = 'SELECT * 
        FROM facilities, districts, counties
        WHERE facilities.district = districts.id
        AND districts.county = counties.id
        AND districts.id = '.$district.' 
        AND facilities.rtk_enabled =1
        ORDER BY  `facilities`.`facility_name` ASC ';
        $q_res = $this->db->query($q);
        $total_reporting_facilities = $q_res->num_rows();
        $q = "SELECT DISTINCT lab_commodity_orders.facility_code, lab_commodity_orders.id,lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN '$first_day_current_month'
        AND '$last_day_current_month'";
        $q_res1 = $this->db->query($q);
        $total_reported_facilities = $q_res1->num_rows();

        foreach ($q_res1->result_array() as $vals) {
            //            echo "<pre>";var_dump($vals);echo "</pre>";
            if ($vals['order_date'] == $day10 || $vals['order_date'] == $day11 || $vals['order_date'] == $day12) {
                $late_reporting += 1;
                //                echo "<pre>";var_dump($vals);echo "</pre>";
            }
        }

        $nonreported = $total_reporting_facilities - $total_reported_facilities;

        if ($total_reporting_facilities == 0) {
            $non_reported_percentage = 0;
        } else {
            $non_reported_percentage = $nonreported / $total_reporting_facilities * 100;
        }

        $non_reported_percentage = number_format($non_reported_percentage, 0);

        if ($total_reporting_facilities == 0) {
            $reported_percentage = 0;
        } else {
            $reported_percentage = $total_reported_facilities / $total_reporting_facilities * 100;
        }

        $reported_percentage = number_format($reported_percentage, 0);

        if ($total_reporting_facilities == 0) {
            $late_percentage = 0;
        } else {
            $late_percentage = $late_reporting / $total_reporting_facilities * 100;
        }


        $late_percentage = number_format($late_percentage, 0);
        if ($total_reported_facilities > $total_reporting_facilities) {
            $reported_percentage = 100;
            $nonreported = 0;
            $total_reported_facilities = $total_reporting_facilities;
        }
        if ($late_reporting > $total_reporting_facilities) {
            $late_reporting = $total_reporting_facilities;
            $late_percentage = $reported_percentage;
        }
        $returnable = array('Month' => $text_month, 'Year' => $year, 'district' => $districtname, 'district_id' => $district_id, 'total_facilities' => $total_reporting_facilities, 'reported' => $total_reported_facilities, 'reported_percentage' => $reported_percentage, 'nonreported' => $nonreported, 'nonreported_percentage' => $non_reported_percentage, 'late_reports' => $late_reporting, 'late_reports_percentage' => $late_percentage);
        return $returnable;
    }

    public function fcdrr_values($order_id, $commodity = null) {
        $q = 'SELECT * 
        FROM lab_commodities, lab_commodity_details, facility_amc
        WHERE lab_commodity_details.order_id =' . $order_id . '
        AND facility_amc.facility_code = lab_commodity_details.facility_code
        AND facility_amc.commodity_id = lab_commodity_details.commodity_id
        AND lab_commodity_details.commodity_id = lab_commodities.id ';


        if (isset($commodity)) {
            $q = 'SELECT * 
                FROM lab_commodities, lab_commodity_details
                WHERE lab_commodity_details.order_id =' . $order_id . '
                AND lab_commodity_details.commodity_id = lab_commodities.id
                AND commodity_id=' . $commodity;
        }

        $q_res = $this->db->query($q);
        $returnable = $q_res->result_array();
        return $returnable;
    }

    public function countrywide_commodities_over($year, $month, $value, $commodity_id = null) {
        $q = 'select * from counties';
        $res = $this->db->query($q);
        foreach ($res->result_array() as $key => $arr) {
//            echo '<h3>' . $arr['county'] . '</h3><hr />';
            $county = $arr['id'];
            $this->_commodities_over($year, $month, $county, $value, $commodity_id);
        }
    }
    function get_national_allocation(){
       $sql= "select facilities.*, districts.district, counties.county from facilities, districts, counties where facilities.rtk_enabled = 0 and facilities.zone = 'Zone A' and facilities.district = districts.id and districts.county = counties.id ";
       $res = $this->db->query($sql);
       $facilities = $res->result_array();
       $amcs = array();
       foreach ($facilities as $key => $value) {
           $fcode = $value['facility_code'];
           $sql_amc = "SELECT lab_commodities.*, facility_amc.* from lab_commodities, facility_amc WHERE lab_commodities.id= facility_amc.commodity_id and facility_amc.facility_code = $fcode ";
           $res_amc = $this->db->query($sql_amc);
           $amcs_details = $res_amc->result_array(); 
           $amcs[$fcode]  = $amcs_details;
       }
       echo "<pre>";
       print_r($amcs);
       die;
    }

    private function _commodities_over($year, $month, $county, $value, $commodity_id = null) {
        // Function to compute commodities who's closing stock is above a certain value commodities_over/2014/02/31/200/1
        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));
        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));

        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;


        $q = "SELECT *  
        FROM lab_commodities, lab_commodity_details, lab_commodity_orders, facilities, districts, counties 
        WHERE lab_commodity_details.commodity_id = lab_commodities.id 
        AND lab_commodity_orders.id = lab_commodity_details.order_id 
        AND facilities.facility_code = lab_commodity_details.facility_code 
        AND facilities.district = districts.id 
        AND districts.county = counties.id 
        AND counties.id = $county 
        AND commodity_id  = 1
        AND lab_commodity_orders.order_date BETWEEN '$firstday' AND '$lastdate'";
        if (isset($value)) {
            $q .=' AND lab_commodity_details.closing_stock>' . $value;
        }
        $res = $this->db->query($q);
        echo "<table border='1'>
        <th>County</th>
        <th>District</th>
        <th>Facility Code</th>
        <th>Facility Name</th>
        <th>Commodity Name</th>
        <th>Facility Closing stock</th>";
        foreach ($res->result_array() as $arr) {
            echo '<tr>';
            echo '<td>' . $arr['county'] . ' </td><td>' . $arr['district'] . ' </td><td>' . $arr['facility_code'] . ' </td><td> ' . $arr['facility_name'] . ' </td><td> ' . $arr['commodity_name'] . ' </td><td> ' . $arr['closing_stock'] . '<br />';
            echo '</tr>';
        }
        echo "</table>";
    }

    public function district_fcdrr($district, $year, $month, $commodity_id = null) {
        // looking for orders that are in a district within a particular month of a particular year

        $distname = districts::get_district_name($district);
        $districtname = $distname[0]['district'];
        $district_id = $district;
        $returnable = array();
        $returnable['district_name'] = $districtname;
        $returnable['district_id'] = $district;

        $returnable['commodity_issued_total'] = 0;
        $returnable['commodity_name'] = 0;
        $returnable['beginning_bal'] = 0;
        $returnable['q_received'] = 0;
        $returnable['q_used'] = 0;
        $returnable['no_of_tests_done'] = 0;
        $returnable['losses'] = 0;
        $returnable['positive_adj'] = 0;
        $returnable['negative_adj'] = 0;
        $returnable['closing_stock'] = 0;
        $returnable['q_expiring'] = 0;
        $returnable['days_out_of_stock'] = 0;
        $returnable['q_requested'] = 0;
        $returnable['allocated'] = 0;

        $returnable['district_orders'] = array();

        // Sets the timezone and date variables for last day of previous month and this month
        date_default_timezone_set('EUROPE/moscow');
        $month = $month + 1;
        $prev_month = $month - 1;
        $last_day_current_month = date('Y-m-d', mktime(0, 0, 0, $month, 0, $year));
        $last_day_previous_month = date('Y-m-d', mktime(0, 0, 0, $prev_month, 0, $year));
        $lastday_thismonth = date('Y-m-d', strtotime("last day of this month"));
        $month -= 1;

        $q = "SELECT DISTINCT lab_commodity_orders.facility_code, lab_commodity_orders.id as order_id,lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN '$last_day_previous_month'
        AND '$last_day_current_month'";
        $q_res1 = $this->db->query($q);
        $total_reported_facilities = $q_res1->num_rows();

        foreach ($q_res1->result_array() as $vals) {
            $order_id = $vals['order_id'];
            $order_vals = $this->fcdrr_values($order_id, $commodity_id);
            $vals['order_details'] = $order_vals;

            $returnable['commodity_name'] = $vals['order_details'][0]['commodity_name'];
            $returnable['beginning_bal'] += $vals['order_details'][0]['beginning_bal'];
            $returnable['q_received'] += $vals['order_details'][0]['q_received'];
            $returnable['q_used'] += $vals['order_details'][0]['q_used'];
            $returnable['no_of_tests_done'] += $vals['order_details'][0]['no_of_tests_done'];
            $returnable['losses'] += $vals['order_details'][0]['losses'];
            $returnable['positive_adj'] += $vals['order_details'][0]['positive_adj'];
            $returnable['negative_adj'] += $vals['order_details'][0]['negative_adj'];
            $returnable['closing_stock'] += $vals['order_details'][0]['closing_stock'];
            $returnable['q_expiring'] += $vals['order_details'][0]['q_expiring'];
            $returnable['days_out_of_stock'] += $vals['order_details'][0]['days_out_of_stock'];
            $returnable['q_requested'] += $vals['order_details'][0]['q_requested'];
            $returnable['allocated'] += $vals['order_details'][0]['allocated'];

            array_push($returnable['district_orders'], $vals);
        }
        return $returnable;
    }

//// lots of work in progress
    public function county_fcdrr_values($year, $month, $county) {
        $q = 'SELECT counties.id as county_id, counties.county, districts.id as district_id, districts.district as district_name
        FROM counties,districts 
        WHERE districts.county = counties.id
        AND counties.id =' . $county;
        $res = $this->db->query($q);
        /*        echo "<pre>";
          var_dump($res->result_array());
          echo "</pre>";
         */
        foreach ($res->result_array() as $value) {
            $district = $value['district_id'];
            $district_arr = $this->district_fcdrr($district, $year, $month);
            /*            echo "<pre>";
              print_r($district_arr);
              echo "</pre>";
              die;
             */
        }
    }

    function district_totals($year, $month, $district = NULL) {

        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));

        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;

        $returnable = array();

        $common_q = "SELECT
        sum(lab_commodity_details.beginning_bal) as sum_opening, 
        sum(lab_commodity_details.q_received) as sum_received, 
        sum(lab_commodity_details.q_used) as sum_used, 
        sum(lab_commodity_details.no_of_tests_done) as sum_tests, 
        sum(lab_commodity_details.positive_adj) as sum_positive, 
        sum(lab_commodity_details.negative_adj) as sum_negative,
        sum(lab_commodity_details.losses) as sum_losses,
        sum(lab_commodity_details.closing_stock) as sum_closing_bal,
        sum(lab_commodity_details.q_requested) as sum_requested, 
        sum(lab_commodity_details.allocated) as sum_allocated,
        sum(lab_commodity_details.allocated) as sum_days,
        sum(lab_commodity_details.q_expiring) as sum_expiring
        FROM lab_commodities, lab_commodity_details, lab_commodity_orders, facilities, districts, counties 
        WHERE lab_commodity_details.commodity_id = lab_commodities.id 
        AND lab_commodity_orders.id = lab_commodity_details.order_id 
        AND facilities.facility_code = lab_commodity_details.facility_code AND facilities.district = districts.id 
        AND districts.county = counties.id 
        AND lab_commodity_orders.order_date BETWEEN  '$firstday' AND  '$lastdate'";
        if (isset($district)) {
            $common_q.= ' AND districts.id =' . $district;
        }

        $q = $common_q . " AND lab_commodities.id = 1";
        $res = $this->db->query($q);
        $result = $res->result_array();
        array_push($returnable, $result[0]);

        $q2 = $common_q . " AND lab_commodities.id = 2";
        $res2 = $this->db->query($q2);
        $result2 = $res2->result_array();
        array_push($returnable, $result2[0]);

        $q3 = $common_q . " AND lab_commodities.id = 3";
        $res3 = $this->db->query($q3);
        $result3 = $res3->result_array();
        array_push($returnable, $result3[0]);

        return $returnable;
    }

    function _requested_vs_allocated($year, $month, $county = null) {

        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));

        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;

        $returnable = array();

        $common_q = "SELECT
        lab_commodities.commodity_name,
        sum(lab_commodity_details.beginning_bal) as sum_opening, 
        sum(lab_commodity_details.q_received) as sum_received, 
        sum(lab_commodity_details.q_used) as sum_used, 
        sum(lab_commodity_details.no_of_tests_done) as sum_tests, 
        sum(lab_commodity_details.positive_adj) as sum_positive, 
        sum(lab_commodity_details.negative_adj) as sum_negative,
        sum(lab_commodity_details.losses) as sum_losses,
        sum(lab_commodity_details.closing_stock) as sum_closing_bal,
        sum(lab_commodity_details.q_requested) as sum_requested, 
        sum(lab_commodity_details.allocated) as sum_allocated,
        sum(lab_commodity_details.allocated) as sum_days,
        sum(lab_commodity_details.q_expiring) as sum_expiring
        FROM lab_commodities, lab_commodity_details, lab_commodity_orders, facilities, districts, counties 
        WHERE lab_commodity_details.commodity_id = lab_commodities.id 
        AND lab_commodity_orders.id = lab_commodity_details.order_id 
        AND facilities.facility_code = lab_commodity_details.facility_code AND facilities.district = districts.id 
        AND districts.county = counties.id 
        AND lab_commodity_orders.order_date BETWEEN  '$firstday' AND  '$lastdate'";
        if (isset($county)) {
            $common_q.= ' AND counties.id =' . $county;
        }

        $q = $common_q . " AND lab_commodities.id = 1";
        $res = $this->db->query($q);
        $result = $res->result_array();
        array_push($returnable, $result[0]);

        $q2 = $common_q . " AND lab_commodities.id = 2";
        $res2 = $this->db->query($q2);
        $result2 = $res2->result_array();
        array_push($returnable, $result2[0]);

        $q3 = $common_q . " AND lab_commodities.id = 3";
        $res3 = $this->db->query($q3);
        $result3 = $res3->result_array();
        array_push($returnable, $result3[0]);

        $q4 = $common_q . " AND lab_commodities.id = 4";
        $res4 = $this->db->query($q4);
        $result4 = $res3->result_array();
        array_push($returnable, $result4[0]);

        $q5 = $common_q . " AND lab_commodities.id = 5";
        $res5 = $this->db->query($q5);
        $result5 = $res3->result_array();
        array_push($returnable, $result5[0]);

        $q6 = $common_q . " AND lab_commodities.id = 6";
        $res6 = $this->db->query($q6);
        $result6 = $res3->result_array();
        array_push($returnable, $result6[0]);



        return $returnable;
    }

    function _facility_amc($mfl_code, $commodity = null) {
        $three_months_ago = date("Y-m-", strtotime("-3 Month "));
        $three_months_ago .='1';
        $q = "SELECT avg(lab_commodity_details.q_used) as avg_used
        FROM  lab_commodity_details,lab_commodity_orders
        WHERE lab_commodity_orders.id =  lab_commodity_details.order_id
        AND lab_commodity_details.facility_code =  $mfl_code
        AND lab_commodity_orders.order_date BETWEEN '$three_months_ago' AND NOW()";
        
        if (isset($commodity)) {
            $q.=" AND lab_commodity_details.commodity_id = $commodity";
        } else {
            $q.=" AND lab_commodity_details.commodity_id = 1";
        }

        $res = $this->db->query($q);
        $result = $res->result_array();
        $result = $result[0]['avg_used'];
        $result = number_format($result, 0);
        return $result;
    }

    public function district_summary($district, $year, $month, $render = NULL) {

        $district_arr = $this->rtk_summary_district($district, $year, $month);

        // algorithm to establish three months prior to the request date

        $month_prev = $month - 1;
        $month_prev_prev = $month_prev - 1;
        if ($month == 1) {
            $year -= 1;
            $month_prev += 12;
            $month_prev_prev += 12;
        }
        $district_arr_prev = $this->rtk_summary_district($district, $year, $month_prev);
        if ($month == 2) {
            $year -= 1;
            $month_prev_prev += 12;
        }
        $district_arr_prev_prev = $this->rtk_summary_district($district, $year, $month_prev_prev);

        echo "<pre>";
        print_r($district_arr);
        print_r($district_arr_prev);
        print_r($district_arr_prev_prev);
        echo "</pre>";
    }

    public function district_summary_fcdrr($district, $year, $month, $render = NULL) {
        // This function is similar to the above function, but for the different functions

        $district_fcdrr_values = $this->district_fcdrr($district, $year, $month);

        // algorithm to establish three months prior to the request date

        $month_prev = $month - 1;
        $month_prev_prev = $month_prev - 1;
        if ($month == 1) {
            $year -= 1;
            $month_prev += 12;
            $month_prev_prev += 12;
        }
        $district_fcdrr_values_prev = $this->district_fcdrr($district, $year, $month_prev);
        if ($month == 2) {
            $year -= 1;
            $month_prev_prev += 12;
        }
        $district_fcdrr_values_prev_prev = $this->district_fcdrr($district, $year, $month_prev_prev);

        echo "<pre>";
        print_r($district_fcdrr_values);
        print_r($district_fcdrr_values_prev);
        print_r($district_fcdrr_values_prev_prev);
        echo "</pre>";
    }

    public function district_statistics($district) {
        $district_name = districts::get_district_name_($district);
        $data = array();
        $data['title'] = 'District Statistics - ' . $district_name['district'];
        $data['banner_text'] = 'District Statistics - ' . $district_name['district'];
        $data['content_view'] = 'rtk/district_summary_v';
        $this->load->view('rtk/template', $data);
    }

    public function reporting_counties($month, $year) {
        $q = 'SELECT id,county FROM  `counties` ';
        //  echo $q;
        $li_html = '';
        $res_arr = $this->db->query($q);
        foreach ($res_arr->result_array() as $value) {
            $county_id = $value['id'];
            $county_name = $value['county'];
            $reale_check = $this->rtk_summary_county($county_id, $year, $month);
            $active = '';
            //   echo '<pre>';print_r($reale_check);echo '</pre>';
            //  die;
            $reported = $reale_check['reported_percentage'];

            if ($reported == 0) {
                $active = 'active';
                $li_html .= '<li class="' . $active . '">' . $county_name . '<span class="divider">/</span></li>';
            } else {
                $li_html .= '<li><a href="#" class="' . $active . '" onClick="loadcountysummary(' . $county_id . ')">' . $county_name . '</a> <span class="divider">/</span></li>';
            }
        }
        //echo '<li id="selectedcounty" class="active">&nbsp</li><br />'.$li_html;
        echo $li_html;
    }

    public function year_progress($county = null, $year = null) {
        $year = 2013;
        $month = 11;

        $dist = $this->rtk_summary_county(5, $year, $month);
        echo $dist['reported_percentage'] . '<br /><br /><br />';

        echo $dist['district_summary'][0]['district'];
        echo ' - ';
        echo $dist['district_summary'][0]['reported_percentage'];
        echo '<br />';

        echo $dist['district_summary'][1]['district'];
        echo ' - ';
        echo $dist['district_summary'][1]['reported_percentage'];
        echo '<br />';

        echo $dist['district_summary'][3]['district'];
        echo ' - ';
        echo $dist['district_summary'][3]['reported_percentage'];
        echo '<br />';
        echo "<pre>";
        print_r($dist);
        echo "</pre>";
    }

    public function rtk_summary_county($county, $year, $month) {
        date_default_timezone_set('EUROPE/moscow');
        $county_summary = array();
        $county_summary['districts'] = 0;
        $county_summary['facilities'] = 0;
        $county_summary['reported'] = 0;
        $county_summary['reported_percentage'] = 0;
        $county_summary['nonreported'] = 0;
        $county_summary['nonreported_percentage'] = 0;
        $county_summary['late_reports'] = 0;
        $county_summary['late_reports_percentage'] = 0;
        $county_summary['district_summary'] = array();
        /*
         * countyname,numberofdistricts,numberoffacilities,reported,nonreported,late
         */
        $q = 'SELECT * 
        FROM counties, districts
        WHERE counties.id = districts.county
        AND counties.id = ' . $county . '';
        $q_res = $this->db->query($q);
        $districts_num = $q_res->num_rows();
        foreach ($q_res->result_array() as $districts) {
            $dist_id = $districts['id'];
            $dist = $districts['district'];

            //$county_summary['district_summary']['district'] = $dist;
            //$county_summary['district_summary']['district_id'] = $dist_id;

            $district_summary = $this->rtk_summary_district($districts['id'], $year, $month);

            $county_summary['districts'] += 1;
            $county_summary['facilities'] += $district_summary['total_facilities'];
            $county_summary['reported'] += $district_summary['reported'];
            $county_summary['reported_percentage'] += $district_summary['reported_percentage'];
            $county_summary['nonreported'] += $district_summary['nonreported'];
            $county_summary['nonreported_percentage'] += $district_summary['nonreported_percentage'];
            $county_summary['punctual_reports'] = 1;
            $county_summary['late_reports'] += $district_summary['late_reports'];

            $county_summary['late_reports_percentage'] += $district_summary['late_reports_percentage'];
            array_push($county_summary['district_summary'], $district_summary);
        }

        $county_summary['reported_percentage'] = ($county_summary['reported_percentage'] / $county_summary['districts']);
        $county_summary['reported_percentage'] = number_format($county_summary['reported_percentage'], 0);

        $sortArray = array();
        foreach ($county_summary['district_summary'] as $person) {
            foreach ($person as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        $orderby = "reported_percentage";

        array_multisort($sortArray[$orderby], SORT_DESC, $county_summary['district_summary']);
        return $county_summary;
    }

    public function fusion_test($county, $month, $year, $render = NULL) {
        $data['county'] = $county;
        $data['month'] = $month;
        $data['year'] = $year;

        $combined_date = $year . '-' . $month . '-01';

        $date = date('F, Y', strtotime($combined_date));

        $countyname = counties::get_county_name($county);
        $countyname = $countyname[0]['county'];

        $district_summary = $this->rtk_summary_county($county, $year, $month);
        $xml_html = '';

        foreach ($district_summary['district_summary'] as $value) {
            $district = $value['district'];
            $reported_percentage = $value['reported_percentage'];
            $xml_html .= "<set label='$district' value='$reported_percentage' />";
        }
 

        $xml_body = "<chart formatNumberScale='0' lineColor='000000' lineAlpha='40' showValues='1' rotateValues='1' valuePosition='auto'palette='1' subcaption='Reporting in $countyname County $date' xAxisName='Districts' yAxisName='Percentage Reported' yAxisMinValue='0' showValues='0'  useRoundEdges='1' alternateHGridAlpha='20' divLineAlpha='50' canvasBorderColor='666666' canvasBorderAlpha='40' baseFontColor='666666' lineColor='AFD8F8' chartRightMargin = '0' showBorder='0' bgColor='FFFFFF'>
        $xml_html<styles>
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

        if ($render !== NULL) {
            echo $xml_body;

            die;
        }
        $data['xml_body'] = $xml_body;
        $data['district_summary'] = $district_summary;

        $this->load->view('rtk/fusion_view_test', $data);
    }

    public function summary_tab_display($county, $year, $month) {
        // county may be 1 for Nairobi, 5 for busia or 31 for Nakuru
        $htmltable = '';

        $countyname = counties::get_county_name($county);
        $countyname = $countyname[0]['county'];
        $ish = $this->rtk_summary_county($county, $year, $month);
        //      echo $countyname;
        $htmltable .= '<tr>
        <td rowspan ="' . $ish['districts'] . '">' . $countyname . '';
        //   echo '<pre>';
        //        print_r($ish);
        //        var_dump($ish['district_summary']);
        //      echo '</pre>';
        $total_punctual = 0;
        $county_percentage = 0;

        foreach ($ish['district_summary'] as $vals) {
            $early = $vals['reported'] - $vals['late_reports'];
            $total_punctual += $early;
            $htmltable .= ' 
            </td><td>' . $vals['district'].'</td>
            <td>' . $vals['total_facilities'] . '</td>
            <td>' . $early . '</td>
            <td>' . $vals['late_reports'] . '</td>
            <td>' . $vals['nonreported'] . '</td>
            <td>' . $vals['reported_percentage'] . '%</td></tr>';
            /*
              echo '<pre>';
              var_dump($vals);
              echo '</pre>';
             */
        }
        $county_percentage = ($total_punctual + $ish['late_reports']) / $ish['facilities'] * 100;
        $county_percentage = number_format($county_percentage, 0);

        $htmltable .= '<tr style="background: #E9E9E3; border-top: solid 1px #ccc;">
          <td>Totals</td>
          <td>' . $ish['districts'] . ' Sub-Counties</td>
          <td>' . $ish['facilities'] . '</td>
          <td>' . $total_punctual . '</td>
          <td>' . $ish['late_reports'] . '</td>
          <td>' . $ish['nonreported'] . '</td>
          <td>' . $county_percentage . '%</td>

          </tr>';
        echo '
          <table class="data-table">
          <thead><tr>
          <th>County</th>
          <th>Sub-County</th>
          <th>No of facilities</th>
          <th>No reports before 10th</th>
          <th>No of late reports (10th-12th)</th>
          <th>No of non reporting facilities</th>
          <th>Overall reporting rate in % (no of reports submitted/expected no of reports)</th>
          </tr></thead>
          ' . $htmltable . '

          </table>';
    }

    public function rtk_summary_country_wide($year, $month) {
        date_default_timezone_set('EUROPE/moscow');
        $countrywide_summary = array();

        $q = 'SELECT id,county FROM  `counties` ';
        $q_res = $this->db->query($q);
        foreach ($q_res->result_array() as $county) {
            $county_arr = $this->rtk_summary_county($county['id'], $year, $month);

            $county_data['id'] = $county['id'];
            $county_data['countyname'] = $county['county'];
            $county_data['reported_percentage'] = $county_arr['reported_percentage'];

            $county_id = $county['id'];
            $county_name = $county['county'];
            //reported_percentage

            array_push($countrywide_summary, $county_arr['reported_percentage']);
        }
        return $countrywide_summary;
    }

    function reports_in_county($county) {
        /* shows all reports in a county for all districts
         * For instance the link below
         * http://localhost/HCMP/rtk_management/reports_in_county/31
         */

        date_default_timezone_set('EUROPE/moscow');
        $lastday = date('Y-m-d', strtotime("last day of previous month"));
        $districts = districts::getDistrict($county);

        $reports = array();
        $tdata = ' ';
        foreach ($districts as $value) {
            //                $query = 'SELECT facilities.facility_code, facility_name, facilities.district , lab_commodity_orders.compiled_by,lab_commodity_orders.id, lab_commodity_orders.facility_code, lab_commodity_orders.district_id, lab_commodity_orders.order_date FROM  `lab_commodity_orders` ,  `facilities` WHERE order_date BETWEEN ' . $lastday . ' AND NOW( ) AND lab_commodity_orders.district_id = facilities.district AND lab_commodity_orders.facility_code = facilities.facility_code AND  `district_id` =' . $value['id'] . '';
            //                $q = $this->db->query($query);
            $q = $this->db->query('SELECT lab_commodity_orders.id, lab_commodity_orders.facility_code, lab_commodity_orders.compiled_by, lab_commodity_orders.order_date, lab_commodity_orders.district_id, districts.id as distid, districts.district, facilities.facility_name, facilities.facility_code FROM districts, lab_commodity_orders, facilities WHERE lab_commodity_orders.district_id = districts.id AND facilities.facility_code = lab_commodity_orders.facility_code AND districts.id = ' . $value['id'] . '');
            $res = $q->result_array();
            //for ($i = 0; $i<sizeof($res); $i++) {
            foreach ($res as $values) {
                date_default_timezone_set('EUROPE/Moscow');
                ///                    array_push($reports, $values);
                $order_date = date('F', strtotime($values['order_date']));
                $tdata .= '<tr>
                <td>' . $order_date . '</td>
                <td>' . $values['facility_code'] . '</td>
                <td>' . $values['facility_name'] . '</td>
                <td>' . $values['district'] . '</td>
                <td>' . $values['order_date'] . '</td>
                <td>' . $values['compiled_by'] . '</td>
                <td><a href="' . base_url() . 'rtk_management/lab_order_details/' . $values['id'] . '">View</a></td>
                <tr>';
            }
            //                }
            if (count($res) > 0) {
                array_push($reports, $res);
            }
        }

        echo '<script type="text/javascript" charset="utf-8" language="javascript" src="https://datatables.net/release-datatables/media/js/jquery.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="https://datatables.net/release-datatables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" language="javascript" src="https://datatables.net/media/blog/bootstrap_2/DT_bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="https://datatables.net/media/blog/bootstrap_2/DT_bootstrap.css">';

        echo '<table class="table table-condensed" id ="example">  <thead>
        <th>Report for</th>         
        <th>MFL Code</td>
        <th>Facility Name</th>
        <th>District</th>
        <th>Reported on</th>
        <th>Compiled by</th>
        <th> Action</th>
        </thead>
        <tbody>';
        echo $tdata;
        echo '</table>';
    }

    public function rtk_reporting_by_county($county, $year, $month) {
        $counties = 'SELECT * FROM  `districts` WHERE  `county` =' . $county . '';
        $q = $this->db->query($counties);
        $counties_res = $q->result_array();

        $countyname = counties::get_county_name($county);

        $option_htm = '';

        $cq_q = 'SELECT * FROM counties';
        $cq = $this->db->query($cq_q);
        foreach ($cq->result_array() as $value) {

            $option_htm .= '<option value="' . $value['id'] . '">' . $value['county'] . '</option>';
        }

        /*   echo '<link href="' . base_url() . 'CSS/style.css" type="text/css" rel="stylesheet"/>
          <script src="' . base_url() . 'Scripts/jquery.js" type="text/javascript"></script> ';
          echo "<script>
          $(function(){
          $('#countiesselect').change(function(){
          var value = $('#countiesselect').val();
          window.location.href=value;}
          );
          });
          </script>";
          echo '<select id="countiesselect">
          <option> -- Select county -- </option>
          ' . $option_htm . '
          </select>';
         */

        $date = date('F-Y', mktime(0, 0, 0, $month, 1, $year));
        echo '<h1> Facilities which did not report for ' . $date . ' in ' . $countyname[0]['county'] . ' County<h1>';
        foreach ($counties_res as $counties_data) {
            echo '<h2>' . $counties_data['district'] . '</h2>';
            echo('<table>');
            $facilities = $this->rtk_non_reporting_by_district($counties_data['id'], $year, $month);
            echo "</table>";
        }
    }

    function send_pdf_of_nonreporting($county) {

        file_get_contents();
    }

    public function activate_rtk($facility_code) {
        $this->db->query('UPDATE `facilities` SET  `rtk_enabled` = 1 WHERE  `facility_code` =' . $facility_code . '');
        $q = $this->db->query('SELECT * FROM  `facilities` WHERE  `facility_code` =' . $facility_code . '');
        $facil = $q->result_array();
        $object_id = $facil[0]['id'];
        $this->logData('21', $object_id);
        //      echo 'Success '.$facil[0]['facility_name'] .' Is now flagged as a Reporting RTK Facility';
        //        redirect('rtk_management/rtk_mapping/dpp');
        redirect('rtk_management/rtk_mapping/dpp', $msg = "Success '.$facil[0]['facility_name'] .' Is now flagged as a Reporting RTK Facility");
    }

    public function deactivate_rtk($facility_code) {
        $this->db->query('UPDATE `facilities` SET  `rtk_enabled` =  0 WHERE  `facility_code` =' . $facility_code . '');
        $object_id = $this->db->insert_id();
        $q = $this->db->query('SELECT * FROM  `facilities` WHERE  `facility_code` =' . $facility_code . '');
        $facil = $q->result_array();
        $object_id = $facil[0]['id'];
        $this->logData('24', $object_id);
        //        var_dump($facil);
        //        echo 'Success '.$facil[0]['facility_name'] .' Is now flagged as a non-reporting RTK Facility';
        $msg = 'Success ' . $facil[0]['facility_name'] . ' Is now flagged as a non-reporting RTK Facility';
        redirect('rtk_management/rtk_mapping/dpp', $msg);
    }

    public function activate_facility($facility_code) {
        $this->db->query('UPDATE `facilities` SET  `rtk_enabled` = 1 WHERE  `facility_code` =' . $facility_code . '');
        $q = $this->db->query('SELECT * FROM  `facilities` WHERE  `facility_code` =' . $facility_code . '');
        $facil = $q->result_array();
        $object_id = $facil[0]['id'];
        $this->logData('21', $object_id);
        //      echo 'Success '.$facil[0]['facility_name'] .' Is now flagged as a Reporting RTK Facility';
        //        redirect('rtk_management/rtk_mapping/dpp');
        redirect('rtk_management/county_admin/facilities');
    }

    public function deactivate_facility($facility_code) {
        $this->db->query('UPDATE `facilities` SET  `rtk_enabled` =  0 WHERE  `facility_code` =' . $facility_code . '');
        $q = $this->db->query('SELECT * FROM  `facilities` WHERE  `facility_code` =' . $facility_code . '');
        $facil = $q->result_array();
        $object_id = $facil[0]['id'];
        $this->logData('24', $object_id);
        //        var_dump($facil);
        //        echo 'Success '.$facil[0]['facility_name'] .' Is now flagged as a non-reporting RTK Facility';
        redirect('rtk_management/county_admin/facilities');
    }

    public function switch_district($new_dist = null, $switched_as, $month = NULL, $redirect_url = NULL, $newcounty = null, $switched_from = null) {
//      rtk_management/switch_district/district/switched_as/month/redirect_url/county
        if ($new_dist == 0) {
            $new_dist = null;
        }
        if ($month == 0) {
            $month = null;
        }
        if ($redirect_url == 0) {
            $redirect_url = null;
        }
        if ($newcounty == 0) {
            $newcounty = null;
        }
        if ($redirect_url == NULL) {
            $redirect_url = 'home_controller';
        }
        //      $redirect_url = substr_replace($redirect_url,"rtk_management/",0,15);

        if (!isset($newcounty)) {
            $newcounty = $this->session->userdata('county_id');
        }

        $session_data = array("session_id" => $this->session->userdata('session_id'),
         "ip_address" => $this->session->userdata('ip_address'),
         "user_agent" => $this->session->userdata('user_agent'),
         "last_activity" => $this->session->userdata('last_activity'),
         "county_id" => $newcounty,
         "phone_no" => $this->session->userdata('phone_no'),
         "user_email" => $this->session->userdata('user_email'),
         "user_db_id" => $this->session->userdata('user_db_id'),
         "full_name" => $this->session->userdata('full_name'),
         "user_id" => $this->session->userdata('user_id'),
         "user_indicator" => $switched_as,
         "names" => $this->session->userdata('names'),
         "inames" => $this->session->userdata('inames'),
         "identity" => $this->session->userdata('identity'),
         "news" => $this->session->userdata('news'),
         "district_id" => $new_dist,
         "drawing_rights" => $this->session->userdata('drawing_rights'),
         "switched_as" => $switched_as,
         "Month" => $month,
         'switched_from' => $switched_from);


        $this->session->set_userdata($session_data);
        redirect($redirect_url);
    }

    public function rtk_mapping() {
        $district = $this->session->userdata('district_id');
        $data['facilities'] = Facilities::get_total_facilities_rtk_in_district($district);
        $facilities = Facilities::get_total_facilities_rtk_in_district($district);
        $district_name = districts::get_district_name_($district);
        $q = $this->db->query('SELECT * FROM `facilities` WHERE `district` =' . $district . ' ORDER BY `facilities`.`rtk_enabled` ASC');
        // $facilities=Facilities::get_facility_details(6);
        $table_body = '';
        foreach ($q->result_array() as $key => $facilities) {
            //            echo"<pre>";var_dump($facilities);echo"</pre>";
            $reportingstatus = '';
            if ($facilities['rtk_enabled'] == '0') {
                $reportingstatus = 'Not Reporting<a <a href="../activate_rtk/' . $facilities['facility_code'] . '" title="Add ' . $facilities['facility_name'] . '"><i class="icon-plus-sign"> </i></a>';
            } else {
                $reportingstatus = 'Reporting <a href="../deactivate_rtk/' . $facilities['facility_code'] . '" title=" Remove ' . $facilities['facility_name'] . '"><i class="icon-minus-sign"> </i></a>';
            }

            $table_body .= '<tr>
            <td>' . $facilities['facility_code'] . '</td>
            <td>' . $facilities['facility_name'] . '</td>
            <td>' . $facilities['owner'] . '</td>
            <td>' . $reportingstatus . '</td>
            <td>' . $facilities['type'] . '</td>

            </tr>';
        }
        $data = array();
        $data['table_body'] = $table_body;
        $data['title'] = "RTK";
        $data['banner_text'] = "Home";
        $data['link'] = "home";
        $data['district'] = $district;

        $data['title'] = "Facility Mapping";
        $data['banner_text'] = "Facility Mapping";
        //        $data['content_view'] = "rtk/facility_mapping_v";
        $data['content_view'] = "rtk/dpp/facility_mapping_view";
        $this->load->view("rtk/template", $data);
    }

    public function county_rtk_mapping() {
        $data = array();
        $data['title'] = "Facility Mapping";
        $data['banner_text'] = "Facility Mapping";
        $data['content_view'] = "";
        $data['county'] = Counties::getAll();
        $owner_array = array("GOK", "CBO", "FBO", "NGO", "Private", "Other");
        $counties = Counties::getAll();
        $table_body = '';
        foreach ($counties as $county_detail) {
            $id = $county_detail->id;
            $table_body .= "<tr><td><a class='ajax_call_1' id='county_facility' name='get_rtk_county_detail/$id' href='#'> $county_detail->county </a></td>";

            $county_detail = facilities::get_total_facilities_rtk($id);

            $table_body .= "<td>" . $county_detail[0]['total_facilities'] . "</td><td>" . $county_detail[0]['total_rtk'] . "</td>";
            foreach ($owner_array as $key => $value) {

                $owner_count = facilities::get_total_facilities_rtk_ownership($id, $value);

                $table_body .= "<td>" . $owner_count[0]['ownership_count'] . "</td>";
            }
            $table_body .= "</tr>";
        }

        $data['table_body'] = $table_body;

        $this->load->view("rtk/rtk/ajax_view/county_rtk_v", $data);
    }

    public function get_rtk_county_detail($county_id) {
        $data['title'] = "Facilities";
        //  $data['content_view'] = "facilities_rtk_v";
        $data['banner_text'] = "Facility List";
        $data['link'] = "rtk_management";
        $data['doghnut'] = "county";
        $data['bar_chart'] = "county";
        $data['county_id'] = $county_id;
        //////////////////////owners
        $data['facility'] = Facilities::get_total_facilities_rtk_in_county($county_id);
        $data['quick_link'] = "commodity_list";
        $data['content_view'] = "rtk/ajax_view/rtk_facility_list_v";
        $this->load->view("rtk/template", $data);
    }

    public function get_rtk_county_distribution_allocation_detail() {
        $distribution_allocation_data = rtk_stock_status::get_rtk_alloaction_distribution(1);
        $distribution_allocation_data_1 = rtk_stock_status::get_rtk_alloaction_distribution(2);

        $table_body = "";
        $table_body_1 = "";

        foreach ($distribution_allocation_data as $data_1) {
            $table_body .= "<tr><td>$data_1[county]</td><td>$data_1[qty_requested]</td>
            <td>$data_1[distributed]</td><td>$data_1[allocated]</td></tr>";
        }

        foreach ($distribution_allocation_data_1 as $data_2) {
            $table_body_1 .= "<tr><td>$data_2[county]</td><td>$data_2[qty_requested]</td>
            <td>$data_2[distributed]</td><td>$data_2[allocated]</td></tr>";
        }
        $data['table_body'] = $table_body;
        $data['table_body_1'] = $table_body_1;
        $this->load->view("rtk/rtk/ajax_view/rtk_allocation_dist_v", $data);
    }

    public function get_report($facility_code) {

        //Check if report already Exists
        /*
          $check_exists = $this->confirm_lab_report_exists($facility_code);
          if($check_exists==1){
          $this->session->set_flashdata('message', 'That order already Exists. ');

          redirect('home_controller');
          }
          else
         */ {
            //end of modified

            $data['title'] = "Lab Commodities 3 Report";
            $data['content_view'] = "rtk/rtk/lab_commodities_v";
            $data['banner_text'] = "Lab Commodities 3 Report";
            $data['link'] = "rtk_management";
            $data['quick_link'] = "commodity_list";
            $my_arr = $this->get_begining_balance($facility_code);
            $my_count = count($my_arr);
            $data['beginning_bal'] = $my_arr;

            // $data['popout'] = $msg;
            //The district has been set to 1 until this user is given a specific district
            // $data['facilities']=Facilities::get_facility_details(6);
            $data['facilities'] = Facilities::get_one_facility_details($facility_code);
            //$data['lab_categories'] = Lab_Commodity_Categories::get_all();        
            $data['lab_categories'] = Lab_Commodity_Categories::get_active();
            $this->load->view("rtk/template", $data);
        }
    }

    /* ---- Function for Obtaining the begining balance -- */

    public function get_begining_balance($facility_code) {

        $result_bal = array();
        $start_date_bal = date('Y-m-d', strtotime("first day of previous month"));
        $end_date_bal = date('Y-m-d', strtotime("last day of previous month"));
        $sql_bal = "SELECT lab_commodity_details.closing_stock from lab_commodity_orders, lab_commodity_details 
    where lab_commodity_orders.id = lab_commodity_details.order_id 
    and lab_commodity_orders.order_date between '$start_date_bal' and '$end_date_bal' 
    and lab_commodity_orders.facility_code='$facility_code'";

        $res_bal = $this->db->query($sql_bal);

        foreach ($res_bal->result_array() as $row_bal) {
            array_push($result_bal, $row_bal['closing_stock']);
        }
        return $result_bal;
    }

    public function confirm_lab_report_exists($facilitycode) {
        $start_date_bal = date('Y-m-d', time());
        $start_date_bal .= '1';

        $result_count = 0;
        $sql_check = "SELECT * from lab_commodity_orders
    where facility_code='$facilitycode'
    and order_date between '$start_date_bal' and NOW()";
        $res_bal = $this->db->query($sql_check);

        if ($res_bal->num_rows() > 0) {
            $result_count = 1;
        } else {
            $result_count = 0;
        }

        return $result_count;
    }

    public function create_facility_county() {
        $facilityname = $_POST['facilityname'];
        $facilitycode = $_POST['facilitycode'];
        $facilityowner = $_POST['facilityowner'];
        $facilitytype = $_POST['facilitytype'];
        $district = $_POST['district'];

        $time = date('Y-m-d', time());

        $facilityname = addslashes($facilityname);

        $sql = "INSERT INTO `facilities` (`id`, `facility_code`, `facility_name`, `district`, `drawing_rights`, `owner`, `type`, `level`, `rtk_enabled`, `cd4_enabled`, `drawing_rights_balance`, `using_hcmp`, `date_of_activation`) 
    VALUES (NULL, '$facilitycode', '$facilityname', '$district', '0', '$facilityowner', '$facilitytype', '', '1', '0', '0', '0', '$time')";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('20', $object_id);
        redirect('rtk_management/county_admin/facilities');
    }

    public function update_facility_county() {
        $facilityname = $_POST['facilityname'];
        $district = $_POST['district'];
        $mfl = $_POST['facility_code'];
        $time = date('Y-m-d', time());
        $facilityname = addslashes($facilityname);

        $sql = "UPDATE `facilities` SET `facility_name` = '$facilityname',  `district` = '$district' WHERE `facility_code`='$mfl' ";
        $this->db->query($sql);
        $q = $this->db->query("select id from `facilities`WHERE `facility_code`='$mfl' ");
        $facil = $q->result_array();
        $object_id = $facil[0]['id'];
        $this->logData('21', $object_id);

        redirect('rtk_management/facility_profile/' . $mfl);
    }

    public function sendmail($output, $reportname, $email_address) {
        $this->load->helper('file');
        include 'rtk_mailer.php';
        $newmail = new rtk_mailer();
        $this->load->library('mpdf');
        $mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 5, 'L');
        $mpdf->WriteHTML($output);
        $emailAttachment = $mpdf->Output($reportname . '.pdf', 'S');
        $attach_file = './pdf/' . $reportname . '.pdf';
        if (!write_file('./pdf/' . $reportname . '.pdf', $mpdf->Output('report_name.pdf', 'S'))) {
            $this->session->set_flashdata('system_error_message', 'An error occured');
        } else {
            $subject = '' . $reportname;

            $attach_file = './pdf/' . $reportname . '.pdf';
            $bcc_email = 'tngugi@clintonhealthaccess.org';
            $message = $output;
            $response = $newmail->send_email($email_address, $message, $subject, $attach_file, $bcc_email);
            // $response= $newmail->send_email(substr($email_address,0,-1),$message,$subject,$attach_file,$bcc_email);
            if ($response) {
                delete_files('./pdf/' . $reportname . '.pdf');
            }
        }
    }

    function gen_email() {
        $thereport = $this->generate_lastpdf();
        //        echo $thereport;
        $this->sendmail($thereport);
        echo "sent";
    }

    public function district_reports($year, $month, $district) {
        $pdf_htm = '';
        $first_day_current_month = $year . '-' . $month . '-1';
        $firstdate = $year . '-' . $month . '-01';
        $month = date("m", strtotime("$firstdate"));
        $year = date("Y", strtotime("$firstdate"));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;
        $firstdate = $year . '-' . $month . '-01';

        $thismonth = date('Y-m', time());
        $thismonth .="-1";


        $q = "SELECT DISTINCT lab_commodity_orders.facility_code, lab_commodity_orders.id,lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND districts.id = $district
        AND lab_commodity_orders.order_date
        BETWEEN '$firstdate'
        AND NOW()";
//        echo $q;die;
        $res = $this->db->query($q);
        foreach ($res->result_array() as $key => $value) {
            $id = $value['id'];
            $pdf_htm .= $this->generate_lastpdf($id);
            $pdf_htm .= '<br /><br /><br /><hr/><br /><br />';
        }
        return $pdf_htm;
    }

    public function rtk_reports() {
        $time = date('mY', time());
        $districts_in_county = districts::getDistrict($county_id);

        $year = substr($time, -4);
        $month = substr_replace($time, "", -4);
        $this->kemsa_district_reports($year, $month, 207);
    }

    public function kemsa_district_reports($district) {
        $pdf_htm = '';
        $month = date('mY', strtotime('-6 month', time()));
        $year = substr($month, -4);
        $month = date('m', strtotime('-6 month', time()));
        $date = date('F-Y', mktime(0, 0, 0, $month, 1, $year));
        $q = 'SELECT * FROM  `districts` WHERE  `id` =' . $district;
        $res = $this->db->query($q);
        $resval = $res->result_array();
        $reportname = $resval['0']['district'] . ' district FCDRR-RTK Reports for ' . $date;
        $reports_html = "<h2>" . $reportname . "</h2><hr> ";
        echo($year).'<br />';
        echo $month;die;
        $reports_html .= $this->district_reports($year, $month, $district);
        //       echo($reports_html);die;
//      $email_address = "cecilia.wanjala@kemsa.co.ke,jbatuka@usaid.gov";
//        $email_address = "lab@kemsa.co.ke,shamim.kuppuswamy@kemsa.co.ke,onjathi@clintonhealthaccess.org,jbatuka@usaid.gov,williamnguru@gmail.com,ttunduny@gmail.com";
//        $email_address = "lab@kemsa.co.ke,skadima@clintonhealthaccess.org,williamnguru@gmail.com,ttunduny@gmail.com";
        $email_address = "williamnguru@gmail.com,ttunduny@gmail.com";
        $this->sendmail($reports_html, $reportname, $email_address);
    }

    function kemsa_county_reports($county) {
        set_time_limit(2000);
        $firstdate = date('Y-m-d', strtotime('first day of this month', time()));
        $firstdate = date('F-Y', strtotime('first day of previous month', time()));

        $sql = 'select districts.id as id, counties.county from districts,counties where districts.county = counties.id  and  counties.id = ' . $county;
        $res = $this->db->query($sql);
        $result = $res->result_array();
        $pdf_htm = '';

        $q = "SELECT DISTINCT lab_commodity_orders.facility_code, lab_commodity_orders.id,lab_commodity_orders.order_date
        FROM lab_commodity_orders, districts, counties
        WHERE districts.id = lab_commodity_orders.district_id
        AND districts.county = counties.id
        AND counties.id = $county
        AND lab_commodity_orders.order_date
        BETWEEN '$firstdate'
        AND NOW()
        ORDER BY districts.id,lab_commodity_orders.facility_code ASC";
        $res = $this->db->query($q);
        foreach ($res->result_array() as $key => $value) {
            $id = $value['id'];
            $pdf_htm .= $this->generate_lastpdf($id);
            $pdf_htm .= '<br /><br /><br /><hr/><br /><br />';
        }
//        echo $pdf_htm;die; 
        $reportname = $result['0']['county'] . ' County FCDRR-RTK Reports for ' . $date;

        $email_address = "williamnguru@gmail.com";
        $this->sendmail($reports_html, $reportname, $email_address);
    }

    function county_memo_to_kemsa() {
        $month_text = date('mY', strtotime('-1 month'));
        $month = date('m', strtotime("-1 month", time()));


        if (!isset($year)) {
            $year = substr($month_text, -4);
        }
    }

    function showpdf() {
        $q = 'SELECT DISTINCT district, district_id
        FROM lab_commodity_orders, districts
        WHERE districts.id = lab_commodity_orders.district_id';
        $res = $this->db->query($q);
        echo "<pre>";
        print_r($res->result_array());
        echo "</pre>";
    }

    function generate_lastpdf($id) {
        $query = $this->db->query('SELECT id
                FROM  `lab_commodity_orders` 
                where `id` = ' . $id . '
                LIMIT 0 , 1');
        foreach ($query->result_array() as $row) {
            $order_no = $row['id'];
        }
        $query1 = $this->db->query('SELECT * 
            FROM lab_commodity_orders, facilities, districts,counties
            WHERE lab_commodity_orders.district_id = districts.id
            AND counties.id = districts.county
            AND facilities.facility_code = lab_commodity_orders.facility_code
            AND lab_commodity_orders.id =' . $order_no . '');
        $lab_order = $query1->result_array();

        date_default_timezone_set("EUROPE/Moscow");
        $firstday = date('D dS M Y', strtotime("first day of previous month"));
        $lastday = date('D dS M Y', strtotime("last day of previous month"));
        $lastmonth = date('F', strtotime("last day of previous month"));
        $end_date = date('dS F Y', strtotime($lab_order[0]['end_date']));
        $beg_date = date('dS F Y', strtotime($lab_order[0]['beg_date']));

        $orderdate = $lab_order[0]['order_date'];
        $month = date('F', strtotime($orderdate));
        $html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>RTK FCDRR Report for " . $lab_order[0]['facility_name'] . "  $month  2014</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Health</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />
        <style>table.data-table {border: 1px solid #DDD;font-size: 13px;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>";
        $table_head = '
        <table border="0" class="data-table" style="width: 100%; margin: 10px auto;">
        <tr>
        <td>Name of Facility:</td>
        <td colspan="2">' . $lab_order[0]['facility_name'] . '</td>
        <td colspan="3">Applicable to HIV Test Kits Only</td>
        <td colspan="4" style="text-align:center">Applicable to Malaria Testing Only</td>                  
        </tr>
        <tr>
        <td colspan="2" style="text-align:left">MFL Code:</td>
        <td>' . $lab_order[0]['facility_code'] . '</td>
        <td colspan="2" style="text-align:center">Type of Service</td>
        <td colspan="1" style="text-align:center">No. of Tests Done</td>
        <td colspan="1">Test</td>
        <td colspan="1">Category</td>
        <td colspan="1">No. of Tests Performed</td>
        <td colspan="1">No. Positive</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align:left">District:</td>
        <td>' . $lab_order[0]['district'] . '</td>
        <td colspan="2">VCT</td>
        <td>' . $lab_order[0]['vct'] . '</td>
        <td rowspan="3">RDT</td>
        <td style="text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
        <td>' . $lab_order[0]['rdt_under_tests'] . '</td>
        <td>' . $lab_order[0]['rdt_under_pos'] . '</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align:left">County:</td>                     
        <td>' . $lab_order[0]['county'] . '</td>
        <td colspan="2">PITC</td>
        <td>' . $lab_order[0]['pitc'] . '</td>
        <td style="text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
        <td>' . $lab_order[0]['rdt_btwn_tests'] . '</td>
        <td>' . $lab_order[0]['rdt_btwn_pos'] . '</td>
        </tr>
        <tr><td colspan="2" style="text-align:right">Beginning:</td> 
        <td>' . $beg_date . '</td>
        <td colspan="2">PMTCT</td>
        <td>' . $lab_order[0]['pmtct'] . '</td>
        <td style="text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
        <td>' . $lab_order[0]['rdt_over_tests'] . '</td>
        <td>' . $lab_order[0]['rdt_over_pos'] . '</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align:right">Ending:</td>
        <td>' . $end_date . '</td>
        <td colspan="2">Blood&nbsp;Screening</td>
        <td>' . $lab_order[0]['b_screening'] . '</td>
        <td rowspan="3">Microscopy</td>
        <td style="text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
        <td>' . $lab_order[0]['micro_under_tests'] . '</td>
        <td>' . $lab_order[0]['micro_under_pos'] . '</td>                          
        </tr>
        <tr>
        <td colspan="3"></td>
        <td colspan="2">Other&nbsp;(Please&nbsp;Specify)</td>
        <td>' . $lab_order[0]['other'] . '</td> 
        <td style="text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
        <td>' . $lab_order[0]['micro_btwn_tests'] . '</td>
        <td>' . $lab_order[0]['micro_btwn_pos'] . '</td>
        </tr>
        <tr>
        <td colspan="3"></td>
        <td colspan="2">Specify&nbsp;Here:</td>
        <td>' . $lab_order[0]['specification'] . '</td>   
        <td style="text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
        <td>' . $lab_order[0]['micro_over_tests'] . '</td>
        <td>' . $lab_order[0]['micro_over_pos'] . '</td>
        </tr></table>';
        $table_head .= '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 20px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style></table>
<table class="data-table" width="100%">
<thead>
<tr>
    <th rowspan="2"><strong>Commodity</strong></th>
    <th rowspan="2"><strong>Unit of Issue</strong></th>
    <th rowspan="2"><strong>Beginning Balance</strong></th>
    <th rowspan="2"><strong>Quantity Received</strong></th>
    <th rowspan="2"><strong>Quantity Used</strong></th>
    <th rowspan="2"><strong>Tests Done</strong></th>
    <th rowspan="2"><strong>Losses</strong></th>
    <th colspan="2"><strong>Adjustments</strong></th>
    <th rowspan="2"><strong>Closing Stock</strong></th>
    <th rowspan="2"><strong>Qty Expiring <br />in 6 Months</strong></th>
    <th rowspan="2"><strong>Days Out of <br />Stock</strong></th>
    <th rowspan="2"><strong>Qty Requested</strong></th>
</tr>
<tr>
<th><strong>Positive</strong></th>
<th><strong>Negative</strong></th>
</tr>
</thead>
<tbody>';
        $detail_list = Lab_Commodity_Details::get_order($order_no);
        $table_body = '';
        foreach ($detail_list as $detail) {
            $table_body .= '<tr><td>' . $detail['commodity_name'] . '</td>';
            $table_body .= '<td>' . $detail['unit_of_issue'] . '</td>';
            $table_body .= '<td>' . $detail['beginning_bal'] . '</td>';
            $table_body .= '<td>' . $detail['q_received'] . '</td>';
            $table_body .= '<td>' . $detail['q_used'] . '</td>';
            $table_body .= '<td>' . $detail['no_of_tests_done'] . '</td>';
            $table_body .= '<td>' . $detail['losses'] . '</td>';
            $table_body .= '<td>' . $detail['positive_adj'] . '</td>';
            $table_body .= '<td>' . $detail['negative_adj'] . '</td>';
            $table_body .= '<td>' . $detail['closing_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_expiring'] . '</td>';
            $table_body .= '<td>' . $detail['days_out_of_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_requested'] . '</td></tr>';
        }
        $table_foot = '</tbody></table>';

        $table_foot .= '
        <table border="0" style="width: 100%;border: 1px solid #DDD;">
        <tr>
        <td style="text-align:left">Explaination of Losses and Adjustments</td><td  style="width: 57%;">' . $lab_order[0]['explanation'] . '</td>
        </tr>
        <tr style="background: #ECE8FD;">
        <td>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</td><td>' . $lab_order[0]['moh_642'] . '</td>
        </tr>
        <tr>
        <td  >(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td><td>' . $lab_order[0]['moh_643'] . '</td>
        </tr>
        <tr style="background: #ECE8FD;">                   
        <td style="text-align:left">Compiled by: </td><td>' . $lab_order[0]['compiled_by'] . '</td>
        </tr> 
        </table>';
        $report_name = "Lab Commodities Order " . $order_no . " Details";
        $title = "Lab Commodities Order " . $order_no . " Details";
        $html_data = $html_title . $table_head . $table_body . $table_foot;

        $filename = "RTK FCDRR Report for " . $lab_order[0]['facility_name'] . "  $lastmonth  2014";
        return $html_data;
    }

    public function SendallocationMemo() {
        //  echo "Find attached the allocations for XXX facilities, for your action";
        $html = '';
        $html .= "<div style='border: solid 1px #DFDADA;'> 
        <div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
        <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>Ministry of Health </div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>Malindi County CD4 Reagents Allocation </div><div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />";
        $html .= "

        <table style='width: 100%;border:'>
        <thead style='background: #D3D8DD;font-size: 16px;'>
        <tr><th>Facility</th>
        <th>MFLCode</th>
        <th>Reagent</th>
        <th>Quantity</th>
        <th>Allocation For</th>
        </tr></thead>
        <tbody>
        <tr>
        <td>Malindi District Hospital</td>
        <td>11555</td>
        <td>Tri-TEST CD3/CD4/CD45 with TruCOUNT Tubes</td>
        <td>91</td>
        <td>July 2013</td>
        </tr><tr></tr></tbody>
        </table>

        </div>";
        return $html;
        //$reportname= 'Malindi County CD4 Reagents Allocation';
        //$this->sendmail($html, $reportname);
    }

    public function reminder_email() {
        //Reminders begin from 5th  to DMLT/facilities only
        //        will start with Nairobi County(Makadara district precisely) since only rolled out within NBO County
        date_default_timezone_set("EUROPE/Moscow");
        $thismonth = date('F', strtotime("this month"));
        $firstday_lastmonth = date('Y-m-d', strtotime("first day of previous month"));
        $lastday_lastmonth = date('Y-m-d', strtotime("first day of previous month"));
        $lastmonth = date('F', strtotime("last day of previous month"));

        $exceptioncond = '';
        $sql = "SELECT lab_commodity_orders.facility_code ,lab_commodity_orders.district_id,lab_commodity_orders.order_date,lab_commodity_orders.report_for,
        districts.district, districts.county,
        counties.county,counties.id,
        facilities.facility_name,facilities.facility_name,facilities.facility_code
        FROM  lab_commodity_orders, counties,districts,facilities
        WHERE  lab_commodity_orders.order_date between '$firstday_lastmonth' AND '$lastday_lastmonth'
        AND facilities.facility_code = lab_commodity_orders.facility_code
        AND  lab_commodity_orders.district_id = districts.id
        AND districts.county = counties.id        
        ORDER BY  lab_commodity_orders.id DESC";
        echo $sql;
        die;
        $q = $this->db->query($sql);
        foreach ($q->result_array() as $key => $value) {
            //    var_dump($value);
            $reported_facility = $value['facility_code'];
            //     echo $reported_facility;

            $exceptioncond .= 'AND `facility_code` !=' . $reported_facility . ' ';
        } $q = $this->db->query('SELECT * FROM facilities, districts
                WHERE facilities.district = districts.id
                AND districts.id =6
                AND facilities.rtk_enabled =1 ' 
                . $exceptioncond 
                . ' ORDER BY  `facilities`.`facility_name` ASC ');

        // the above query can allow us to give reports on who's not reported both on 5th and on 10th of the month
    }

    public function dailyreports() {
        date_default_timezone_set("EUROPE/Moscow");
        $thismonth = date('F', strtotime("this month"));
        $lastmonth = date('F', strtotime("last day of previous month"));
        $tbmsg = '';
        $q = $this->db->query("SELECT 
                lab_commodity_orders.facility_code ,lab_commodity_orders.district_id,lab_commodity_orders.order_date,lab_commodity_orders.report_for,
                districts.district, districts.county,
                counties.county,counties.id,
                facilities.facility_name,facilities.facility_name,facilities.facility_code
                FROM  lab_commodity_orders, counties,districts,facilities
                WHERE  lab_commodity_orders.report_for LIKE  '$lastmonth' 
                AND facilities.facility_code = lab_commodity_orders.facility_code
                AND  lab_commodity_orders.district_id = districts.id
                AND districts.county = counties.id        
                ORDER BY  lab_commodity_orders.id DESC");

        //    echo "<pre>";var_dump($q->result_array());echo "</pre>";

        $message = 'The following facilities have submitted their ';
        echo "<table style='font-size:40%;'>
            <thead  style='background: #F3F3F3;font-size: 16px;'>
            <th> # </th>
            <th>Facility</th>
            <th>District</th>
            <th>County</th>
            <th>Date</th>
            </thead>";
        foreach ($q->result_array() as $key => $reported_arr) {
            $key++;
            echo '<tr>
                <td style="background: #F3F3F3;font-size: 16px;">' . $key . '</td>
                <td style="background: #A3CEA3;font-size: 16px;">' . $reported_arr['facility_name'] . '</td>
                <td style="background: #A3CEA3;font-size: 16px;">' . $reported_arr['district'] . '</td>
                <td style="background: #A3CEA3;font-size: 16px;">' . $reported_arr['county'] . '</td>
                <td style="background: #A3CEA3;font-size: 16px;">' . date('dS F,Y', strtotime($reported_arr['order_date'])) . '</td>
                </tr>';
        }
        echo "</table>";
    }

    public function scmlt_home($msg=null,$popout=null){

        if(isset($msq)){
            $data['notif_message'] = $msg;
        }
        if(isset($popout)){
            $data['popout'] = $popout;
        }
        $district = $this->session->userdata('district_id');        
        $data['facilities'] = Facilities::get_total_facilities_rtk_in_district($district);
        $facilities = Facilities::get_total_facilities_rtk_in_district($district);       
        $district_name = districts::get_district_name_($district);                    
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
            $data['title'] = "Home";
            $data['link'] = "home";
            $total = $reported + $nonreported;
            $percentage_complete = $reported / $total * 100;
            $percentage_complete = number_format($percentage_complete, 0);
            $data['percentage_complete'] = $percentage_complete;
            $data['reported'] = $reported;
            $data['nonreported'] = $nonreported;
            $this->load->view('rtk/template', $data);

    }

    public function save_lab_report_data() {

        date_default_timezone_set("EUROPE/Moscow");
        $firstday = date('D dS M Y', strtotime("first day of previous month"));
        $lastday = date('D dS M Y', strtotime("last day of previous month"));
        $lastmonth = date('F', strtotime("last day of previous month"));

        $month = $lastmonth;
        $district_id = $_POST['district'];
        $facility_code = $_POST['facility_code'];
        $drug_id = $_POST['commodity_id'];
        $unit_of_issue = $_POST['unit_of_issue'];
        $b_balance = $_POST['b_balance'];
        $q_received = $_POST['q_received'];
        $q_used = $_POST['q_used'];
        $tests_done = $_POST['tests_done'];
        $losses = $_POST['losses'];
        $pos_adj = $_POST['pos_adj'];
        $neg_adj = $_POST['neg_adj'];
        $physical_count = $_POST['physical_count'];
        $q_expiring = $_POST['q_expiring'];
        $days_out_of_stock = $_POST['days_out_of_stock'];
        $q_requested = $_POST['q_requested'];
        $commodity_count = count($drug_id);

        $vct = $_POST['vct'];
        $pitc = $_POST['pitc'];
        $pmtct = $_POST['pmtct'];
        $b_screening = $_POST['blood_screening'];
        $other = $_POST['other2'];
        $specification = $_POST['specification'];
        $rdt_under_tests = $_POST['rdt_under_tests'];
        $rdt_under_pos = $_POST['rdt_under_positive'];
        $rdt_btwn_tests = $_POST['rdt_to_tests'];
        $rdt_btwn_pos = $_POST['rdt_to_positive'];
        $rdt_over_tests = $_POST['rdt_over_tests'];
        $rdt_over_pos = $_POST['rdt_over_positive'];
        $micro_under_tests = $_POST['micro_under_tests'];
        $micro_under_pos = $_POST['micro_under_positive'];
        $micro_btwn_tests = $_POST['micro_to_tests'];
        $micro_btwn_pos = $_POST['micro_to_positive'];
        $micro_over_tests = $_POST['micro_over_tests'];
        $micro_over_pos = $_POST['micro_over_positive'];
        $beg_date = $_POST['begin_date'];
        $end_date = $_POST['end_date'];
        $explanation = $_POST['explanation'];
        $compiled_by = $_POST['compiled_by'];
        $moh_642 = $_POST['moh_642'];
        $moh_643 = $_POST['moh_643'];

        date_default_timezone_set('EUROPE/Moscow');
        $beg_date = date('Y-m-d', strtotime("first day of previous month"));
        $end_date = date('Y-m-d', strtotime("last day of previous month"));

        $user_id = $this->session->userdata('user_id');

        //date_default_timezone_set('EUROPE/Moscow');

        $order_date = date('y-m-d');
        $count = 1;

        // if($count==1)
        //  {
        $data = array('facility_code' => $facility_code, 'district_id' => $district_id, 'compiled_by' => $compiled_by, 'order_date' => $order_date, 'vct' => $vct, 'pitc' => $pitc, 'pmtct' => $pmtct, 'b_screening' => $b_screening, 'other' => $other, 'specification' => $specification, 'rdt_under_tests' => $rdt_under_tests, 'rdt_under_pos' => $rdt_under_pos, 'rdt_btwn_tests' => $rdt_btwn_tests, 'rdt_btwn_pos' => $rdt_btwn_pos, 'rdt_over_tests' => $rdt_over_tests, 'rdt_over_pos' => $rdt_over_pos, 'micro_under_tests' => $micro_under_tests, 'micro_under_pos' => $micro_under_pos, 'micro_btwn_tests' => $micro_btwn_tests, 'micro_btwn_pos' => $micro_btwn_pos, 'micro_over_tests' => $micro_over_tests, 'micro_over_pos' => $micro_over_pos, 'beg_date' => $beg_date, 'end_date' => $end_date, 'explanation' => $explanation, 'moh_642' => $moh_642, 'moh_643' => $moh_643, 'report_for' => $lastmonth);
        $u = new Lab_Commodity_Orders();
        $u->fromArray($data);
        $u->save();
        $object_id = $u->get('id');
        $this->logData('13', $object_id);
        $this->update_amc($facility_code);

        $lastId = Lab_Commodity_Orders::get_new_order($facility_code);
        $new_order_id = $lastId->maxId;
        $count++;

        for ($i = 0; $i < $commodity_count; $i++) {

            // if(isset($facility_code[$i])&&$facility_code[$i]!=''){

            $mydata = array('order_id' => $new_order_id, 'facility_code' => $facility_code, 'district_id' => $district_id, 'commodity_id' => $drug_id[$i], 'unit_of_issue' => $unit_of_issue[$i], 'beginning_bal' => $b_balance[$i], 'q_received' => $q_received[$i], 'q_used' => $q_used[$i], 'no_of_tests_done' => $tests_done[$i], 'losses' => $losses[$i], 'positive_adj' => $pos_adj[$i], 'negative_adj' => $neg_adj[$i], 'closing_stock' => $physical_count[$i], 'q_expiring' => $q_expiring[$i], 'days_out_of_stock' => $days_out_of_stock[$i], 'q_requested' => $q_requested[$i]);

            Lab_Commodity_Details::save_lab_commodities($mydata);
            // }
        }
        // }
        //  $report_type='lab';
        //  $data='Your details have been saved.';
        // $this->get_report($report_type, $data);
        $district = $this->session->userdata('district_id');
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
            $table_body .= "<tr><td><a class='ajax_call_1' id='county_facility' name='" . base_url() . "rtk_management/get_rtk_facility_detail/$facility_detail[facility_code]' href='#'>" . $facility_detail["facility_code"] . "</td>";
            $table_body .= "<td>" . $facility_detail['facility_name'] . "</td><td>" . $district_name['district'] . "</td>";
            $table_body .= "<td>";

            $lab_count = lab_commodity_orders::get_recent_lab_orders($facility_detail['facility_code']);
            //            $fcdrr_count = rtk_fcdrr_order_details::get_facility_order_count($facility_detail['facility_code']);
            //          echo "<pre>";print_r($lab_count);echo "</pre>";

            if ($lab_count > 0) {
                $reported = $reported + 1;
                //".site_url('rtk_management/get_report/'.$facility_detail['facility_code'])."
                $table_body .= "<span class='label label-success'>Submitted  for    $lastmonth </span> <!--<img src='" . base_url() . "/Images/check_mark_resize.png'></img>--><a href=" . site_url('rtk_management/rtk_orders') . " class='link'>View</a></td>";
            } else {
                $nonreported = $nonreported + 1;
                $table_body .= "<span class='label label-danger'>  Pending for $lastmonth </span> <a href=" . site_url('rtk_management/get_report/' . $facility_detail['facility_code']) . " class='link'>Report</a></td>";
            }

            $table_body .= "</td>";
        }
        $county = $this->session->userdata('county_name');
        $countyid = $this->session->userdata('county_id');
        $data['countyid'] = $countyid;
        $data['county'] = $county;
        $data['notif_message'] = 'The report has been saved';


        $total = $reported + $nonreported;
        $percentage_complete = $reported / $total * 100;
        $percentage_complete = number_format($percentage_complete, 0);
        $data['percentage_complete'] = $percentage_complete;
        $data['reported'] = $reported;
        $data['nonreported'] = $nonreported;

        $data['table_body'] = $table_body;
        $data['title'] = "Home";
        $data['popout'] = "Your order has been saved.";
        $data['content_view'] = "rtk/rtk/dpp/dpp_home_with_table";
        $data['banner_text'] = "Home";
        $data['link'] = "home";
        $this->load->view('rtk/template', $data);
        //        $this->generate_lastpdf();
        // redirect('home_controller');
    }

    public function edit_lab_order_details($order_id, $msg = NULL) {
        $delivery = $this->uri->segment(3);
        $district = $this->session->userdata('district_id');
        $data['title'] = "Lab Commodity Order Details";
        // $data['content_view'] = "rtk/lab_order_details_v";
        //     ini_set('memory_limit', '-1');

        $data['order_id'] = $order_id;
        $data['content_view'] = "rtk/rtk/dpp/lab_commodities_report_edit_v";
        $data['banner_text'] = "Lab Commodity Order Details";
        $data['lab_categories'] = Lab_Commodity_Categories::get_all();
        $data['detail_list'] = Lab_Commodity_Details::get_order($order_id);
        $result = $this->db->query('SELECT * 
                FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders, lab_commodity_categories, lab_commodities
                WHERE lab_commodity_details.facility_code = facilities.facility_code
                AND counties.id = districts.county
                AND facilities.facility_code = lab_commodity_orders.facility_code
                AND lab_commodity_details.commodity_id = lab_commodities.id
                AND lab_commodity_categories.id = lab_commodities.category
                AND facilities.district = districts.id
                AND lab_commodity_details.order_id = lab_commodity_orders.id
                AND lab_commodity_orders.id = ' . $order_id . '');
        $data['all_details'] = $result->result_array();

        //        $data['all_details'] = Lab_Commodity_Orders::get_single_lab_order($order_id);
        $this->load->view("rtk/template", $data);
    }

    public function get_lab_report($order_no, $report_type) {
        $table_head = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
            table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
            table.data-table td, table th {padding: 4px;}
            table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
            .col5{background:#D8D8D8;}</style></table>
            <table class="data-table" width="100%">
            <thead>
            <tr>
            <th><strong>Category</strong></th>
            <th><strong>Description</strong></th>
            <th><strong>Unit of Issue</strong></th>
            <th><strong>Beginning Balance</strong></th>
            <th><strong>Quantity Received</strong></th>
            <th><strong>Quantity Used</strong></th>
            <th><strong>Number of Tests Done</strong></th>
            <th><strong>Losses</strong></th>
            <th><strong>Positive Adjustments</strong></th>
            <th><strong>Negative Adjustments</strong></th>
            <th><strong>Closing Stock</strong></th>
            <th><strong>Quantity Expiring in 6 Months</strong></th>
            <th><strong>Days Out of Stock</strong></th>
            <th><strong>Quantity Requested</strong></th>
            </tr>
            </thead>
            <tbody>';
        $detail_list = Lab_Commodity_Details::get_order($order_no);
        $table_body = '';
        foreach ($detail_list as $detail) {
            $table_body .= '<tr><td>' . $detail['category_name'] . '</td>';
            $table_body .= '<td>' . $detail['commodity_name'] . '</td>';
            $table_body .= '<td>' . $detail['unit_of_issue'] . '</td>';
            $table_body .= '<td>' . $detail['beginning_bal'] . '</td>';
            $table_body .= '<td>' . $detail['q_received'] . '</td>';
            $table_body .= '<td>' . $detail['q_used'] . '</td>';
            $table_body .= '<td>' . $detail['no_of_tests_done'] . '</td>';
            $table_body .= '<td>' . $detail['losses'] . '</td>';
            $table_body .= '<td>' . $detail['positive_adj'] . '</td>';
            $table_body .= '<td>' . $detail['negative_adj'] . '</td>';
            $table_body .= '<td>' . $detail['closing_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_expiring'] . '</td>';
            $table_body .= '<td>' . $detail['days_out_of_stock'] . '</td>';
            $table_body .= '<td>' . $detail['q_requested'] . '</td></tr>';
        }
        $table_foot = '</tbody></table>';
        $report_name = "Lab Commodities Order " . $order_no . " Details";
        $title = "Lab Commodities Order " . $order_no . " Details";
        $html_data = $table_head . $table_body . $table_foot;

        switch ($report_type) {
            case 'excel' :
                $this->generate_lab_report_excel($report_name, $title, $html_data);
                break;
            case 'pdf' :
                $this->generate_lab_report_pdf($report_name, $title, $html_data);
                break;
        }
    }

    //generate pdf
    public function generate_lab_report_pdf($report_name, $title, $html_data) {

        /*         * ******************************************setting the report title******************** */

        $html_title = "<div ALIGN=CENTER><img src='" . base_url() . "assets/img/coat_of_arms-resized.png' height='70' width='70'style='vertical-align: top;' > </img></div>
            <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>$title</div>
            <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
            Ministry of Health</div>
            <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />";

        /*         * ********************************initializing the report ********************* */
        $this->load->library('mpdf');
        $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
        $this->mpdf->SetTitle($title);
        $this->mpdf->WriteHTML($html_title);
        $this->mpdf->simpleTables = true;
        $this->mpdf->WriteHTML('<br/>');
        $this->mpdf->WriteHTML($html_data);
        $report_name = $report_name . ".pdf";
        $this->mpdf->Output($report_name, 'D');
    }

    public function generate_lab_report_excel($report_name, $title, $html_data) {
        $data = $html_data;
        $filename = $report_name;
        header("Content-type: application/excel");
        header("Content-Disposition: attachment; filename=$filename.xls");
        echo "$data";
    }

    function _all_counties() {
        $q = 'SELECT id,county FROM  `counties` ';
        $q_res = $this->db->query($q);
        $returnable = $q_res->result_array();
        return $returnable;
    }

    public function fcdrr_test($facility_c) {
        $data = array();

        $data['title'] = "FCDRR";
        $data['banner_text'] = "FCDRR";
        $data['content_view'] = "rtk/dpp/fcdrr_test";
        $district = $this->session->userdata('district_id');
        $data['facilities'] = Facilities::get_facility_details($district);
        $data['commodities'] = Rtk_Categories::get_all();
        $data['details'] = Facilities::get_one_facility_details($facility_c);

        $this->facility_code = $facility_c;
        $data['facility_code'] = $this->facility_code;

        $this->load->view("rtk/template", $data);
    }

    public function post_fcdrr() {
        date_default_timezone_set('EUROPE/Moscow');
        $facility_c = $this->session->userdata('news');
        $order_date = date('Y-m-d');
        $facility_code = $_POST['facility_code'];
        $begin_date = $_POST['begin_date'];
        $end_date = $_POST['end_date'];
        $commodity_id = $_POST['commodity_id'];
        $beginning_balance = $_POST['beginning_bal'];
        $warehouse_quantity_received = $_POST['qty_warehouse'];
        $warehouse_lot_no = $_POST['lot_No_warehouse'];
        $other_quantity_received = $_POST['qty_other'];
        $other_lot_no = $_POST['lot_No_other'];
        $quantity_used = $_POST['qty_used'];
        $loss = $_POST['loss'];
        $positive_adj = $_POST['positive_adj'];
        $negative_adj = $_POST['negative_adj'];
        $physical_count = $_POST['ending_bal'];
        $quantity_requested = $_POST['qty_requested'];

        for ($i = 0; $i < count($commodity_id); $i++) {

            $mydata = array('facility_code' => $facility_code, 'order_date' => $order_date, 'begin_date' => $begin_date, 'end_date' => $end_date, 'commodity_id' => $commodity_id[$i], 'beginning_balance' => $beginning_balance[$i], 'warehouse_quantity_received' => $warehouse_quantity_received[$i], 'warehouse_lot_no' => $warehouse_lot_no[$i], 'other_quantity_received' => $other_quantity_received[$i], 'other_lot_no' => $other_lot_no[$i], 'quantity_used' => $quantity_used[$i], 'loss' => $loss[$i], 'positive_adj' => $positive_adj[$i], 'negative_adj' => $negative_adj[$i], 'physical_count' => $physical_count[$i], 'quantity_requested' => $quantity_requested[$i]);
            Rtk_Fcdrr_Order_Details::save_rtk_commodities($mydata);
        }
    }

    public function update_lab_commodity_orders() {
        $rtk = new Rtk_Management();
        $order_id = $_POST['order_id'];
        $detail_id = $_POST['detail_id'];
        $district_id = $_POST['district'];
        $facility_code = $_POST['facility_code'];
        $drug_id = $_POST['commodity_id'];
        $unit_of_issue = $_POST['unit_of_issue'];
        $b_balance = $_POST['b_balance'];
        $q_received = $_POST['q_received'];
        $q_used = $_POST['q_used'];
        $tests_done = $_POST['tests_done'];
        $losses = $_POST['losses'];
        $pos_adj = $_POST['pos_adj'];
        $neg_adj = $_POST['neg_adj'];
        $physical_count = $_POST['physical_count'];
        $q_expiring = $_POST['q_expiring'];
        $days_out_of_stock = $_POST['days_out_of_stock'];
        $q_requested = $_POST['q_requested'];
        $commodity_count = count($drug_id);
        $detail_count = count($detail_id);

        $vct = $_POST['vct'];
        $pitc = $_POST['pitc'];
        $pmtct = $_POST['pmtct'];
        $b_screening = $_POST['blood_screening'];
        $other = $_POST['other2'];
        $specification = $_POST['specification'];
        $rdt_under_tests = $_POST['rdt_under_tests'];
        $rdt_under_pos = $_POST['rdt_under_positive'];
        $rdt_btwn_tests = $_POST['rdt_to_tests'];
        $rdt_btwn_pos = $_POST['rdt_to_positive'];
        $rdt_over_tests = $_POST['rdt_over_tests'];
        $rdt_over_pos = $_POST['rdt_over_positive'];
        $micro_under_tests = $_POST['micro_under_tests'];
        $micro_under_pos = $_POST['micro_under_positive'];
        $micro_btwn_tests = $_POST['micro_to_tests'];
        $micro_btwn_pos = $_POST['micro_to_positive'];
        $micro_over_tests = $_POST['micro_over_tests'];
        $micro_over_pos = $_POST['micro_over_positive'];
        date_default_timezone_set('EUROPE/Moscow');
        $beg_date = date('y-m-d', strtotime($_POST['begin_date']));
        $end_date = date('y-m-d', strtotime($_POST['end_date']));
        $explanation = $_POST['explanation'];
        $compiled_by = $_POST['compiled_by'];

        $moh_642 = $_POST['moh_642'];
        $moh_643 = $_POST['moh_643'];

        $myobj = Doctrine::getTable('Lab_Commodity_Orders')->find($order_id);

        $myobj->vct = $vct;
        $myobj->pitc = $pitc;
        $myobj->pmtct = $pmtct;
        $myobj->b_screening = $b_screening;
        $myobj->other = $other;
        $myobj->specification = $specification;
        $myobj->rdt_under_tests = $rdt_under_tests;
        $myobj->rdt_under_pos = $rdt_under_pos;
        $myobj->rdt_btwn_tests = $rdt_btwn_tests;
        $myobj->rdt_btwn_pos = $rdt_btwn_pos;
        $myobj->rdt_over_tests = $rdt_over_tests;
        $myobj->rdt_over_pos = $rdt_over_pos;
        $myobj->micro_under_tests = $micro_under_tests;
        $myobj->micro_under_pos = $micro_under_pos;
        $myobj->micro_btwn_tests = $micro_btwn_tests;
        $myobj->micro_btwn_pos = $micro_btwn_pos;
        $myobj->micro_over_tests = $micro_over_tests;
        $myobj->micro_over_pos = $micro_over_pos;
        $myobj->beg_date = $beg_date;
        $myobj->end_date = $end_date;
        $myobj->explanation = $explanation;
        $myobj->compiled_by = $compiled_by;
        $myobj->moh_642 = $moh_642;
        $myobj->moh_643 = $moh_643;
        $myobj->save();
        $object_id = $myobj->get('id');
        // echo "$object_id";die();
        $this->logData('14', $object_id);

        for ($i = 0; $i < $detail_count; $i++) {
            $myobj = Doctrine::getTable('Lab_Commodity_Details')->find($detail_id[$i]);
            $myobj->beginning_bal = $b_balance[$i];
            $myobj->q_received = $q_received[$i];
            $myobj->q_used = $q_used[$i];
            $myobj->no_of_tests_done = $tests_done[$i];
            $myobj->losses = $losses[$i];
            $myobj->positive_adj = $pos_adj[$i];
            $myobj->negative_adj = $neg_adj[$i];
            $myobj->closing_stock = $physical_count[$i];
            $myobj->q_expiring = $q_expiring[$i];
            $myobj->days_out_of_stock = $days_out_of_stock[$i];
            $myobj->q_requested = $q_requested[$i];
            $myobj->save();
        }
        //  Need to change
        //      $district=$this->session->userdata('district_id');
        //    $district_name=Districts::get_district_name($district)->toArray();
        //    $d_name=$district_name[0]['district'];
        // $data['title'] = "District Orders";
        // $data['content_view'] = "rtk/dpp/rtk_orders_listing_v";
        // $data['banner_text'] = $d_name." District Orders";
        // $data['fcdrr_order_list']=Lab_Commodity_Orders::get_district_orders($district);
        // $data['lab_order_list']=Lab_Commodity_Orders::get_district_orders($district);
        // // dd($data['lab_order_list']);
        // $data['all_orders']=Lab_Commodity_Orders::get_district_orders($district);
        // $myobj = Doctrine::getTable('districts')->find($district);
        // //$data['district_incharge']=array($id=>$myobj->district);
        // $data['myClass'] = $this;
        // $data['msg']=$msg;
        // $this -> load -> view("rtk/template", $data);
        redirect('rtk_management/rtk_orders');
    }

    public function lab_order_details($order_id, $msg = NULL) {
        $delivery = $this->uri->segment(3);
        $district = $this->session->userdata('district_id');
        $data['title'] = "Lab Commodity Order Details";
        // $data['content_view'] = "rtk/lab_order_details_v";
        $data['order_id'] = $order_id;
        $data['content_view'] = "rtk/rtk/dpp/lab_commodities_report";
        $data['banner_text'] = "Lab Commodity Order Details";

        $data['lab_categories'] = Lab_Commodity_Categories::get_all();
        $data['detail_list'] = Lab_Commodity_Details::get_order($order_id);

        $result = $this->db->query('SELECT * 
                FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders, lab_commodity_categories, lab_commodities
                WHERE lab_commodity_details.facility_code = facilities.facility_code
                AND counties.id = districts.county
                AND facilities.facility_code = lab_commodity_orders.facility_code
                AND lab_commodity_details.commodity_id = lab_commodities.id
                AND lab_commodity_categories.id = lab_commodities.category
                AND facilities.district = districts.id
                AND lab_commodity_details.order_id = lab_commodity_orders.id
                AND lab_commodity_orders.id = ' . $order_id . '');
        $data['all_details'] = $result->result_array();

        //       $data['all_details'] = Lab_Commodity_Orders::get_single_lab_order($order_id);// shida iko hapa

        $this->load->view("rtk/template", $data);
    }

    public static function get_single_lab_order($order_id = 1) {
        $query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT o.id, f.facility_name, o.facility_code, o.district_id, dist.district as district_name, c.county as county_name, f.owner, cat.category_name, com.commodity_name, o.order_date, o.vct, o.pitc, o.pmtct, o.b_screening, o.other, o.specification, o.rdt_under_tests, o.rdt_under_pos, o.rdt_btwn_tests, o.rdt_btwn_pos, o.rdt_over_tests, o.rdt_over_pos, o.micro_under_tests, o.micro_under_pos, o.micro_btwn_tests, o.micro_btwn_pos, o.micro_over_tests, o.micro_over_pos, o.beg_date, o.end_date, o.explanation, o.moh_642, o.moh_643, o.compiled_by, u.fname, u.lname, d.order_id,d.facility_code,d.district_id,d.commodity_id,d.unit_of_issue,d.beginning_bal,d.q_received,d.q_used,d.no_of_tests_done,d.losses,d.positive_adj,d.negative_adj,d.closing_stock,d.q_expiring,d.days_out_of_stock,d.q_requested
              FROM lab_commodity_orders o, lab_commodity_details d,lab_commodity_categories cat, lab_commodities com, user u, facilities f, districts dist, counties c
              WHERE o.id=$order_id
              AND o.id=d.order_id
              AND o.district_id=dist.id
              AND dist.county=c.id
              AND o.facility_code=d.facility_code
              AND f.facility_code=o.facility_code
              AND u.id=o.compiled_by
              AND com.id=d.commodity_id
              AND cat.id=com.category
              ORDER BY d.commodity_id
              ");
        dd($query);
    }

    public function rtk_orders($msg = NULL) {
        $district = $this->session->userdata('district_id');        
        $district_name = Districts::get_district_name($district)->toArray();        
        $d_name = $district_name[0]['district'];
        $countyid = $this->session->userdata('county_id');

        $data['countyid'] = $countyid;

        $data['title'] = "Orders";
        $data['content_view'] = "rtk/rtk/dpp/rtk_orders_listing_v";
        $data['banner_text'] = $d_name . "Orders";
        //        $data['fcdrr_order_list'] = Lab_Commodity_Orders::get_district_orders($district);
        ini_set('memory_limit', '-1');

        date_default_timezone_set('EUROPE/moscow');
        $last_month = date('m');
        //            $month_ago=date('Y-'.$last_month.'-d');
        $month_ago = date('Y-m-d', strtotime("last day of previous month"));
        $sql = 'SELECT  
    facilities.facility_code,facilities.facility_name,lab_commodity_orders.id,lab_commodity_orders.order_date,lab_commodity_orders.district_id,lab_commodity_orders.compiled_by,lab_commodity_orders.facility_code
    FROM lab_commodity_orders, facilities
    WHERE lab_commodity_orders.facility_code = facilities.facility_code 
    AND lab_commodity_orders.order_date between ' . $month_ago . ' AND NOW()
    AND facilities.district =' . $district . '
    ORDER BY  lab_commodity_orders.id DESC ';
           /*$query = $this->db->query("SELECT  
            facilities.facility_code,facilities.facility_name,lab_commodity_orders.id,lab_commodity_orders.order_date,lab_commodity_orders.district_id,lab_commodity_orders.compiled_by,lab_commodity_orders.facility_code
            FROM lab_commodity_orders, facilities
            WHERE lab_commodity_orders.facility_code = facilities.facility_code 
            AND lab_commodity_orders.order_date between '$month_ago ' AND NOW()
            AND lab_commodity_orders.district_id =' . $district . '
            ORDER BY  lab_commodity_orders.id DESC");*/
        $query = $this->db->query($sql);

        $data['lab_order_list'] = $query->result_array();
        $data['all_orders'] = Lab_Commodity_Orders::get_district_orders($district);
        $myobj = Doctrine::getTable('districts')->find($district);
        //$data['district_incharge']=array($id=>$myobj->district);
        $data['myClass'] = $this;
        $data['d_name'] = $d_name;
        $data['msg'] = $msg;

        $this->load->view("rtk/template", $data);
    }

    public function get_reporting_rate_national_bar($option, $county_id = NULL) {
        $str_xml_body = '';
        $title = "";
        if ($option == "county") {
            $county_name = Counties::get_county_name($county_id);
            $county_data = rtk_stock_status::get_reporting_county($county_id);
            $county_name = $county_name[0]['county'];
            $title = "$county_name";
            foreach ($county_data as $county_detail) {
                $str_xml_body .= "<set value='$county_detail[total_facilities]' label='Total Facilities'/>";
                $str_xml_body .= "<set value='$county_detail[reported]' label='Reporting Facilities'/>";
            }
        } else {
            $title = 'Country wide';
            $str_xml_body = '';
            $county_data = rtk_stock_status::get_reporting_rate_national();

            foreach ($county_data as $county_detail) {
                $str_xml_body .= "<set value='$county_detail[total_facilities]' label='Total Facilities' />";
                $str_xml_body .= "<set value='$county_detail[reported]' label='Reporting Facilities' />";
            }
        }

        $strXML = "<chart caption='Facility Reporting Rate : $title' yAxisName='Number of facilities' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>";
        $strXML .= "$str_xml_body</chart>";
        echo $strXML;
    }

    public function facility_reporting_combined_bar_chart() {

        $color_array['baseline'] = array('659EC7', 'E8E8E8');
        $color_array['midterm'] = array('FBB117', 'E8E8E8');
        $color_array['endterm'] = array('59E817', 'E8E8E8');

        $chart = '<chart decimals="0" sDecimals="0" slantLabels="0" baseFontSize="10" stack100Percent="1" showPercentValues="1" caption="RTK Allocation per County"  showLegend="1"palette="3"numdivlines="3" useRoundEdges="1" showsum="0" bgColor="FFFFFF" showBorder="0" exportEnabled="1" exportHandler="' . base_url() . 'scripts/FusionCharts/ExportHandlers/PHP/FCExporter.php" exportAtClient="0" exportAction="download">';
        $chart_categories = "<categories>";
        $chart_xml_body_total_facilities_with_trk = "";
        $chart_xml_body_total_facilities_without_rtk = "";

        $counties = Counties::getAll();

        foreach ($counties as $county_detail) {
            $chart_categories .= "<category label='$county_detail->county'/>";

            $county_data = rtk_stock_status::get_reporting_county($county_detail->id);

            $total_no_facilities = $county_data[0]['total_facilities'];
            $total_no_allocated_rtk = $county_data[0]['reported'];
            $balance = $total_no_facilities - $total_no_allocated_rtk;

            $chart_xml_body_total_facilities_with_trk .= '<set  value="' . $total_no_allocated_rtk . '" />';
            $chart_xml_body_total_facilities_without_rtk .= '<set  value="' . $balance . '" />';
        }
        $chart_categories .= "</categories>";
        $chart .= $chart_categories . '<dataset>
    <dataset seriesName="Reported" color="' . $color_array['baseline'][0] . '"> 
    ' . $chart_xml_body_total_facilities_with_trk . '
    </dataset>
    ' . '<dataset showValues="0" color="' . $color_array['baseline'][1] . '">
    ' . $chart_xml_body_total_facilities_without_rtk . '</dataset>
    </dataset></chart>';

        echo $chart;
    }

    public function kenya_county_map() {

        $colors = array("FFFFCC" => "1", "E2E2C7" => "2", "FFCCFF" => "3", "F7F7F7" => "5", "FFCC99" => "6", "B3D7FF" => "7", "CBCB96" => "8", "FFCCCC" => "9");

        $counties = Counties::get_county_map_data();
        $map = "";
        foreach ($counties as $county_detail) {

            $countyid = $county_detail->id;
            $county_map_id = $county_detail->kenya_map_id;
            $countyname = trim($county_detail->county);

            $county_detail = rtk_stock_status::get_reporting_county($countyid);
            $total_facilities = $county_detail[0]['total_facilities'];
            $reporting_facilities = $county_detail[0]['reported'];

            $reporting_rate = round((($reporting_facilities / $total_facilities) * 100), 1);
            $map .= "<entity  link='rtk_management/county_detail_zoom/$countyid' id='$county_map_id' displayValue ='$countyname' color='" . array_rand($colors, 1) . "'  toolText='County :$countyname&lt;BR&gt; Total Facilities :" . $total_facilities . "&lt;BR&gt; Facilities Reporting  :" . $reporting_facilities . "&lt;BR&gt; Facility Reporting Rate :" . $reporting_rate . " %'/>";
        }
        echo $this->kenyan_map($map);
    }

    public function rtk_allocation_kenyan_map() {
        $colors = array("FFFFCC" => "1", "E2E2C7" => "2", "FFCCFF" => "3", "F7F7F7" => "5", "FFCC99" => "6", "B3D7FF" => "7", "CBCB96" => "8", "FFCCCC" => "9");

        $map = "";

        $counties = Counties::get_county_map_data();
        $table_data = "";
        $allocation_rate = 0;
        $total_facilities_in_county = 1;
        $total_facilities_allocated_in_county = 1;
        foreach ($counties as $county_detail) {

            $countyid = $county_detail->id;
            $county_map_id = $county_detail->kenya_map_id;
            $countyname = trim($county_detail->county);

            $county_detail = rtk_stock_status::get_allocation_rate_county($countyid);
            $total_facilities_in_county = $county_detail['total_facilities_in_county'];
            $total_facilities_allocated_in_county = $county_detail['total_facilities_allocated_in_county'];

            @$allocation_rate = round((($total_facilities_allocated_in_county / $total_facilities_in_county) * 100), 1);
            //     $map .="<entity  link='".base_url()."rtk_management/allocate_rtk/$countyid' id='$county_map_id' displayValue ='$countyname' color='".array_rand($colors,1)."' toolText='County :$countyname&lt;BR&gt; Total Facilities Reporting:".$total_facilities_in_county."&lt;BR&gt; Facilities Allocated  :".$total_facilities_allocated_in_county."&lt;BR&gt; Facility Allocation Rate :".$allocation_rate." %'/>";
            $map .= "<entity  link='" . base_url() . "rtk_management/allocation_county_detail_zoom/$countyid' id='$county_map_id' displayValue ='$countyname' color='" . array_rand($colors, 1) . "' toolText='County :$countyname&lt;BR&gt; Total Facilities Reporting:" . $total_facilities_in_county . "&lt;BR&gt; Facilities Allocated  :" . $total_facilities_allocated_in_county . "&lt;BR&gt; Facility Allocation Rate :" . $allocation_rate . " %'/>";
        }
        echo $this->kenyan_map($map, "RTK County allocation: Click to view facilities in county");
    }

    public function allocate_rtk($county_id) {
        $ish;
        $county = counties::get_county_name($county_id);
        foreach ($county as $cname) {
            $ish = $cname['county'];
        }
        $data['countyname'] = $ish;

        //  $facilities_in_county = facilities::get_total_facilities_rtk_in_county($county_id);
        //  var_dump($facilities_in_county);

        $htm = '';

        $districts_in_county = districts::getDistrict($county_id);
        //  var_dump($district);
        $htm .= '<ul class="facility-list">';
        foreach ($districts_in_county as $key => $district_arr) {
            # code...
            //      echo $district_arr['district'];

            $district = $district_arr['id'];
            $district_name = $district_arr['district'];
            $htm .= '<li>' . $district_name . '</li>';
            $htm .= '<ul class="sub-list">';
            $district_orders = Lab_Commodity_Orders::get_district_orders($district);
            if (count($district_orders) > 0) {
                foreach ($district_orders as $district_orders_arr) {
                    $facility = $district_orders_arr['facility_code'];
                    $facility_name = $district_orders_arr['facility_name'];
                    $htm .= '<li style="border-left: medium solid rgb(233, 105, 88);background: #fff;"><a href="#' . $facility . '" class="allocate" onClick="showpreview(' . $facility . ')" >' . $facility_name . '</a></li>';
                    //          $htm .='<li><a href="#'.$facility.'" class="allocate" onClick="showpreview('rtk/.$facility.')" >'.$facilitiessarr['fname'].'</a></li>';
                }
            } else {
                $htm .= '<li style="border-left: medium solid rgb(88, 233, 106);background: #fff;">No Orders</li>';
            }
            $htm .= '</ul>';
        }
        $htm .= '</ul>';

        $data['htm'] = $htm;
        $data['content_view'] = 'allocation_committee/ajax_view/rtk_county_allocation_v';
        $data['banner_text'] = '';
        $data['title'] = '';
        $this->load->view("rtk/template", $data);
    }

    public function kenyan_map($data, $title = NULL) {
        $map = "";
        $map .= "<map showBevel='0' showMarkerLabels='1' caption='$title'  fillColor='F1f1f1' borderColor='000000' hoverColor='efeaef' canvasBorderColor='FFFFFF' baseFont='Verdana' baseFontSize='10' markerBorderColor='000000' markerBgColor='FF5904' markerRadius='6' legendPosition='bottom' useHoverColor='1' showMarkerToolTip='1'  showExportDataMenuItem='1' >";

        $map .= "<data>";
        $map .= $data;
        $map .= "</data>
    <styles> 
    <definition>
    <style name='TTipFont' type='font' isHTML='1'  color='FFFFFF' bgColor='666666' size='11'/>
    <style name='HTMLFont' type='font' color='333333' borderColor='CCCCCC' bgColor='FFFFFF'/>
    <style name='myShadow' type='Shadow' distance='1'/>
    </definition>
    <application>
    <apply toObject='MARKERS' styles='myShadow' /> 
    <apply toObject='MARKERLABELS' styles='HTMLFont,myShadow' />
    <apply toObject='TOOLTIP' styles='TTipFont' />
    </application>
    </styles>
    </map>";

        return $map;
    }

    public function get_allocation_rate_national_hlineargauge($option = NULL, $county_id = NULL) {
        $str_xml_body = '';
        $title = "RTK Allocation rate:";
        if ($option == "county") {
            $county_name = Counties::get_county_name($county_id);
            $county_data = rtk_stock_status::get_allocation_rate_county($county_id);

            $county_name = $county_name[0]['county'];
            $title = " $county_name County";

            $str_xml_body .= "<value>$county_data[allocation_rate]</value>";
        } else {
            $title = ' Country wide';
            $str_xml_body = '';
            $country_data = rtk_stock_status::get_allocation_rate_national();

            $str_xml_body .= "<value>$country_data</value>";
        }

        $strXML = "<Chart bgColor='FFFFFF' bgAlpha='0' numberSuffix='%' caption='$title' showBorder='0' upperLimit='100' lowerLimit='0' gaugeRoundRadius='5' chartBottomMargin='10' ticksBelowGauge='0' 
    showGaugeLabels='0' valueAbovePointer='0' pointerOnTop='1' pointerRadius='9'>
    <colorRange> 

    <color minValue='0' maxValue='33' name='BAD' code='FF0000' />

    <color minValue='34' maxValue='67' name='WEAK' code='FFFF00' /> 
    <color minValue='68' maxValue='100' name='GOOD' code='00FF00' />
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

    ////////////////////////////////////////end of graphs////////////////////////////////////////
    public function get_facility_ownership_bar_chart_ajax() {

        $this->load->view("rtk/county_rtk_v");
    }

    public function get_facility_ownership_doghnut_ajax() {
        $this->load->view("rtk/county_rtk_v");
    }

    public function get_kenyan_county_map() {
        $this->load->view("rtk/rtk/ajax_view/kenya_county_v");
    }

    public function county_detail_zoom($county_id) {

        $data['facility'] = Facilities::get_total_facilities_rtk_in_county($county_id);
        $data['doghnut'] = "county";
        $data['bar_chart'] = "county";
        $data['county_id'] = $county_id;
        $data['content_view'] = "rtk/ajax_view/county_detail_zoom_v";
        $data['title'] = "County View";
        $data['banner_text'] = "County View";
        $this->load->view("rtk/template", $data);
    }

    public function get_rtk_allocation_kenyan_map() {
        $this->load->view("rtk/allocation_committee/ajax_view/rtk_allocation_county_map");
    }

    public function allocation_county_detail_zoom($county_id) {
        $ish;
        $county = counties::get_county_name($county_id);
        $county_name = Counties::get_county_name($county_id);
        $data['countyname'] =$county_name['county'];

        $htm = '';
        $table_body = '';

        $districts_in_county = districts::getDistrict($county_id);
        $data['districts_in_county'] = $districts_in_county;
        $htm .= '<ul class="facility-list">';
        foreach ($districts_in_county as $key => $district_arr)
            $district = $district_arr['id'];
        $district_name = $district_arr['district'];
        $htm .= '<li>' . $district_name . '</li>';
        $htm .= '<ul class="sub-list">';
        //          $district_orders = Lab_Commodity_Orders::get_district_orders($district);
        //            var_dump($district_orders);
        $three_months_ago = date("Y-m-", strtotime("-1 Month"));
        $three_months_ago .='1';

        //$beg_date = date('Y-m-d', strtotime("first day of this Month"));
        $beg_date = date('Y-m', strtotime("-1 Month"));
        $beg_date.='-01';
        $end_date = date('Y-m-d', strtotime("last day of previous Month"));



        $sql = "SELECT facilities.facility_code,lab_commodity_details.id, lab_commodity_details.q_requested, lab_commodity_details.q_received,lab_commodity_details.commodity_id,lab_commodity_details.closing_stock,lab_commodity_details.beginning_bal,
        facilities.facility_name,lab_commodity_details.allocated,lab_commodity_details.q_used,districts.district,facility_amc.amc,lab_commodities.commodity_name,lab_commodities.unit_of_issue
        FROM facilities, districts, counties,lab_commodity_orders,lab_commodity_details,facility_amc,lab_commodities
        WHERE facilities.district = districts.id
        AND facilities.rtk_enabled = 1
        AND facilities.facility_code = facility_amc.facility_code
        AND facility_amc.commodity_id = lab_commodity_details.commodity_id
        AND counties.id = districts.county
        AND counties.id = $county_id
        AND lab_commodity_orders.facility_code = facilities.facility_code
        AND lab_commodity_orders.id = lab_commodity_details.order_id
        AND lab_commodity_details.commodity_id = lab_commodities.id
        AND lab_commodity_details.commodity_id BETWEEN 0 AND 6
        AND lab_commodity_orders.order_date BETWEEN '$beg_date' AND '$end_date'
        ORDER BY districts.district,facilities.facility_code  ASC,lab_commodity_details.commodity_id ASC ";
        $orders = $this->db->query($sql);
       //echo "<pre>";print_r($orders->result_array());die;
        foreach ($orders->result_array() as $orders_arr) {
            $algorithm = ($orders_arr['commodity_id'] < 4) ? "Old-Algorithm" : 'New-Algorithm';

            $order_detail_id = $orders_arr['id'];
            $q_requested = $orders_arr['q_requested'];
            $q_received = $orders_arr['q_received'];
            $commodity_id = $orders_arr['commodity_id'];
            $closing_stock = $orders_arr['closing_stock'];
            $q_used = $orders_arr['q_used'];
            $beginning_bal = $orders_arr['beginning_bal'];
            $facility_code = $orders_arr['facility_code'];
            $facility_name = $orders_arr['facility_name'];
            $allocated = $orders_arr['allocated'];
            $district_name = $orders_arr['district'];
            $commodity = $orders_arr['commodity_name'];
            $unit_of_issue = $orders_arr['unit_of_issue'];
            //$allocation = '<span class="label label-important">Pending Allocation for  ' . $lastmonth . '</span>';


            $commodity_id = $orders_arr['commodity_id'];
            $amc = $orders_arr['amc'];
            $amc_4month = $amc * 4;
            $firstday = date('D dS M Y', strtotime("first day of previous month"));
            $lastday = date('D dS M Y', strtotime("last day of previous month"));
            $lastmonth = date('F', strtotime("last day of previous month"));
            $allocation = '';
            if ($allocated > 0) {
                $allocation = '<span class=\"label label-success\">Allocated for  ' . $lastmonth . '</span>';
            } else {
                $allocation = '<span class=\"label label-important\">Pending Allocation for  ' . $lastmonth . '</span>';
                $allocated = ($amc_4month / $unit_of_issue);
                $allocated = ceil($allocated);
            }
            $table_body .= "
            <tr id=''>
            <input type='hidden' name='$order_detail_id' value='$order_detail_id' />
            <td>$facility_code</td>
            <td>$facility_name</td>
            <td>$district_name</td>
            <td>$commodity <br/>$algorithm</td>
            <td>$q_received</td>
            <td>$q_used</td>
            <td>$closing_stock</td>
            <td>$q_requested</td>
            <td>$amc</td>
            <td><input type='text' class='user2' name='allocated_$order_detail_id' value='$allocated'/></td>
            <td>$q_received</td>
            <td>$allocation</td>
            </tr>";
        }
//            echo"<table>$table_body</table";die;
        //  $data['content_view'] = 'allocation_committee/ajax_view/rtk_county_allocation_v';
        $data['county_id'] = $county_id;
        $data['table_body'] = $table_body;
        $data['title'] = "County View";
//        $data['table_data'] = $this->rtk_county_sidebar();
        $data['banner_text'] = "Allocate " . $county_name['county'];
        $data['content_view'] = "rtk/allocation_committee/ajax_view/rtk_county_allocation_datatableonly_v";
        $this->load->view("rtk/template", $data);
    }

    function county_allocation($county_id) {
        $county = Counties::get_county_name($county_id);
        $countyname = $county['county'];
        $data['county_name'] = $countyname;
        $data['banner_text'] = "Allocations in " . $countyname;
        $data['title'] = $countyname . " County RTK Allocations";
        $data['content_view'] = "rtk/allocation_committee/ajax_view/county_allocations_v";
        $data['county_allocation'] = $this->_allocation_county($county_id);

        $this->load->view("rtk/template", $data);
    }

    function _allocation_county($county_id) {
        $three_months_ago = date("Y-m-", strtotime("-3 Month"));
        $three_months_ago .='1';

        $beg_date = date('Y-m-d', strtotime("first day of previous month"));
        $end_date = date('Y-m-d', strtotime("last day of previous month"));

        $sql = "SELECT DISTINCT facilities.facility_code,lab_commodity_details.id, lab_commodity_details.q_requested, lab_commodity_details.q_received,lab_commodity_details.commodity_id,lab_commodity_details.closing_stock,lab_commodity_details.beginning_bal,lab_commodity_details.allocated_date,
        facilities.facility_name,lab_commodity_details.allocated,lab_commodity_details.q_used,districts.district,facility_amc.amc,lab_commodities.commodity_name,lab_commodity_orders.order_date
        FROM facilities, districts, counties,lab_commodity_orders,lab_commodity_details,facility_amc,lab_commodities
        WHERE facilities.district = districts.id
        AND facilities.rtk_enabled = 1
        AND facilities.facility_code = facility_amc.facility_code
        AND facility_amc.commodity_id = lab_commodity_details.commodity_id
        AND counties.id = districts.county
        AND counties.id = $county_id
        AND lab_commodity_details.allocated > 1
        AND lab_commodity_orders.facility_code = facilities.facility_code
        AND lab_commodity_orders.id = lab_commodity_details.order_id
        AND lab_commodity_details.commodity_id = lab_commodities.id
        AND lab_commodity_details.commodity_id BETWEEN 0 AND 3
        AND lab_commodity_orders.order_date BETWEEN '$three_months_ago' AND NOW()
        ORDER BY  lab_commodity_orders.order_date, districts.district,facilities.facility_code ASC";

        $res = $this->db->query($sql);

        return $res->result_array();
    }

    public function update_rtk_labs() {
        $q = "SELECT 
    facilities.facility_code,
    facilities.district,
    facilities.Zone
FROM
    facilities
WHERE
    facilities.rtk_enabled = '1'
        and facilities.Zone = 'Zone d'
        and facilities.facility_code not in (select 
            lab_commodity_orders.facility_code
        from
            lab_commodity_orders
        where
            order_date between '2014-06-1' and '2014-06-30')";

        $res = $this->db->query($q);
        foreach ($res->result_array() as $value) {
            $fcode = $value['facility_code'];
            $dist = $value['district'];
            $q1 = "INSERT INTO lab_commodity_orders (`id`, `facility_code`, `district_id`, `order_date`, `vct`, `pitc`, `pmtct`, `b_screening`, `other`, `specification`, `rdt_under_tests`, `rdt_under_pos`, `rdt_btwn_tests`, `rdt_btwn_pos`, `rdt_over_tests`, `rdt_over_pos`, `micro_under_tests`, `micro_under_pos`, `micro_btwn_tests`, `micro_btwn_pos`, `micro_over_tests`, `micro_over_pos`, `beg_date`, `end_date`, `explanation`, `moh_642`, `moh_643`, `compiled_by`, `created_at`, `report_for`) 
            VALUES (NULL, '$fcode', '$dist', '2014-06-20', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '0', '0', '0', '0', '0', '0', 'Unreported', '', 'Unspecified', 'Unspecified', CURRENT_TIMESTAMP, '')";
            $res1 = $this->db->query($q1);
            $order_id = $this->db->insert_id($res1);
            $object_id = $this->db->insert_id();
//            $this->logData('25', $object_id);
            $q3 = "INSERT INTO `lab_commodity_details` (`id`, `order_id`, `facility_code`, `district_id`, `commodity_id`, `unit_of_issue`, `beginning_bal`, `q_received`, `q_used`, `no_of_tests_done`, `losses`, `positive_adj`, `negative_adj`, `closing_stock`, `q_expiring`, `days_out_of_stock`, `q_requested`, `created_at`, `allocated`, `allocated_date`) VALUES
            (NULL, $order_id, '$fcode', $dist, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-06-20 00:00:00', 0, 0),
            (NULL, $order_id, '$fcode', $dist, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-06-20 00:00:00', 0, 0),
            (NULL, $order_id, '$fcode', $dist, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-06-20 00:00:00', 0, 0),
            (NULL, $order_id, '$fcode', $dist, 5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-06-20 00:00:00', 0, 0),
            (NULL, $order_id, '$fcode', $dist, 6, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014-06-20 00:00:00', 0, 0);";
        }
    }

    public function allocation($zone = NULL, $county = NULL, $district = NULL, $facility = NULL, $sincedate = NULL, $enddate = NULL) {
        // function to filter allocation based on multiple parameter
        // zone, county,district, sincedate,
        $conditions = '';
        $conditions = (isset($zone)) ? "AND facilities.Zone = 'Zone $zone'" : '';
        $conditions = (isset($county)) ? $conditions . " AND counties.id = $county" : $conditions . ' ';
        $conditions = (isset($district)) ? $conditions . " AND districts.id = $district" : $conditions . ' ';
        $conditions = (isset($facility)) ? $conditions . " AND facility.facility_code = $facility" : $conditions . ' ';
        $conditions = (isset($sincedate)) ? $conditions . "AND lab_commodity_details.allocated_date > = $sincedate" : $conditions . ' ';
        $conditions = (isset($enddate)) ? $conditions . "AND lab_commodity_details.allocated_date < = $enddate" : $conditions . ' ';

        $sql = "select facilities.facility_name,facilities.facility_code,facilities.Zone, facilities.contactperson,facilities.cellphone, lab_commodity_details.commodity_id,
        lab_commodity_details.allocated,lab_commodity_details.allocated_date,lab_commodity_orders.order_date,lab_commodities.commodity_name,facility_amc.amc,lab_commodity_details.closing_stock,lab_commodity_details.q_requested
        from facilities, lab_commodity_orders,lab_commodity_details, counties,districts,lab_commodities,facility_amc
        WHERE facilities.facility_code = lab_commodity_orders.facility_code
        AND counties.id = districts.county
        AND facilities.district = districts.id
        AND facilities.rtk_enabled = 1
        and lab_commodities.id = lab_commodity_details.commodity_id
        and lab_commodities.id = facility_amc.commodity_id
        and facilities.facility_code = facility_amc.facility_code
        AND lab_commodity_orders.id = lab_commodity_details.order_id
        AND lab_commodity_details.commodity_id between 1 AND 
        $conditions
        GROUP BY facilities.facility_code, lab_commodity_details.commodity_id";
        $res = $this->db->query($sql);
        $returnable = $res->result_array();
        return $returnable;
        #$nonexistent = "AND lab_commodity_orders.order_date BETWEEN '2014-04-01' AND '2014-04-30'";
    }

    //function to allocate
    public function rtk_allocation($msg = NULL) {
        $district = $this->session->userdata('district_id');
        $district_name = Districts::get_district_name($district)->toArray();
        $countyid = $this->session->userdata('county_id');
        $data['countyid'] = $countyid;
        $d_name = $district_name[0]['district'];     
        $data['title'] = "Allocations";
        $data['content_view'] = "rtk/rtk/dpp/rtk_allocation_v";
        $data['banner_text'] = $d_name . "Allocation";
//        $data['lab_order_list'] = Lab_Commodity_Orders::get_district_orders($district);
        ini_set('memory_limit', '-1');

        $start_date = date("Y-m-", strtotime("-3 Month "));
        $start_date .='1';

        $end_date = date('Y-m-d', strtotime("last day of previous month"));      
        $allocations = $this->allocation(NULL, $county = NULL, $district, $facility = NULL, $sincedate = NULL, $enddate = NULL);
        $data['lab_order_list'] = $allocations;
        $data['all_orders'] = Lab_Commodity_Orders::get_district_orders($district);
        $myobj = Doctrine::getTable('districts')->find($district);
        $data['myClass'] = $this;
        $data['msg'] = $msg;        
        $data['d_name'] = $d_name;

        $this->load->view("rtk/template", $data);
    }

    public function rtk_allocation_data() {
        if ($_POST['data'] == '') {
            echo 'No data was found';           
        }
        $data = $_POST['data'];
        $data = str_replace('=', '&', $data);
        $data = explode('&', $data);

        $now = time();
        $count = count($data);
        $i = 0;
        $j = 0;
        $data = array_chunk($data, 4);

        foreach ($data as $value) {
            $id = $value[1];
            $val = $value[3];
            $query = 'UPDATE  `lab_commodity_details` SET  `allocated` =  ' . $val . ',`allocated_date` =  ' . $now . ' WHERE  `lab_commodity_details`.`id` =' . $id . '';
            $this->db->query($query);
        }
        // $object_id = $id;
        //$this->logData('16',$object_id);
        echo("allocations saved");
    }

    public function memo() {
        $arr = '["99","12","100","21","129","12","130","12","131","34","132","43","113","6","114","21","115","43","116","43","65","65","67","5","1","0","2","0","3","0","4","0","49","0","50","0","51","0","52","0","97","0","98","0","66","0","68","4"]';
        $arr = json_decode($arr);
        $this->distribution_memo($arr);
    }

    function country_memotable($year, $month) {
        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));
        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;
        $firstdate = $year . '-' . $month . '-01';
        $tab_arr = array();
        $returnable_arr = array();

        $q = "SELECT DISTINCT lab_commodity_orders.id FROM lab_commodity_orders,lab_commodity_details, facilities
        WHERE lab_commodity_orders.id = lab_commodity_details.order_id 
        AND lab_commodity_details.facility_code = facilities.facility_code 
        AND lab_commodity_details.allocated >0 
        AND lab_commodity_orders.order_date between '$firstdate' and '$lastdate' 
        ORDER BY lab_commodity_orders.facility_code ASC";
        $res = $this->db->query($q);

        echo '<table border="1">';
        echo '<tr><td>County</td>
        <td>MFLCode</td>
        <td>Facility</td>
        <td>Colloidal</td>
        <td>First Response</td>
        <td>Unigold</td>
        </tr>';

        foreach ($res->result_array() as $val) {
            $q2 = 'select counties.county, facilities.facility_name,facilities.facility_code,lab_commodity_details.allocated 
            FROM lab_commodity_details,counties,districts,facilities
            WHERE lab_commodity_details.order_id = ' . $val['id'] . ' 
            AND counties.id = districts.county
            AND facilities.facility_code = lab_commodity_details.facility_code 
            AND facilities.district = districts.id
            limit 0,3';
            $res1 = $this->db->query($q2);
            $result = $res1->result_array();
            $screening = $result[0]['allocated'];
            $confirmatory = $result[1]['allocated'];
            $tiebreaker = $result[2]['allocated'];
            $facility = $result[0]['facility_name'];
            $facilitycode = $result[0]['facility_code'];
            $county = $result[0]['county'];

            $tab_arr['county'] = $county;
            $tab_arr['facility_name'] = $facility;
            $tab_arr['mfl'] = $facilitycode;
            $tab_arr['screening'] = $screening;
            $tab_arr['confirmatory'] = $confirmatory;
            $tab_arr['tiebreaker'] = $tiebreaker;

            echo '<tr>'
            . '<td>' . $county . '</td>'
            . '<td>' . $facilitycode . '</td>'
            . '<td>' . $facility . '</td>'
            . '<td>' . $screening . '</td>'
            . '<td>' . $confirmatory . '</td>'
            . '<td>' . $tiebreaker . '</td>'
            . '</tr>';
        }
        echo '</table>';
    }

    function _memotable($county, $year, $month) {
        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));
        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;
        $firstdate = $year . '-' . $month . '-01';

        $q = "SELECT * 
        FROM lab_commodity_orders,lab_commodity_details,lab_commodities, facilities, districts
        WHERE facilities.district = districts.id
        AND lab_commodities.id = lab_commodity_details.commodity_id
        AND lab_commodity_orders.id = lab_commodity_details.order_id
        AND lab_commodity_details.facility_code = facilities.facility_code
        AND lab_commodity_details.allocated >0
        AND districts.county =$county
        AND lab_commodity_orders.order_date between '$firstdate' and '$lastdate'
        ORDER BY  lab_commodity_orders.facility_code ASC ";

        $res = $this->db->query($q);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function send_allocation_memo($year, $month) {
        $ext_date = $year . '-' . $month . '-1';
        $month_name = date('F', strtotime($ext_date));
        $html_to_pdf = $this->memotable($year, $month);
        $reportname = "Zone A Allocation for RTK Commodities $month_name , $year";
        $email_address = 'williamnguru@gmail.com';
        /*      $email_address = 'omarabdi2@yahoo.com,
          kangethewamuti@yahoo.com,
          bedan.wamuti@kemsa.co.ke,
          jbatuka@usaid.gov,
          jlusike@clintonhealthaccess.org,
          onjathi@clintonhealthaccess.org';
         */
        $this->sendmail($html_to_pdf, $reportname, $email_address);
        //$this->logData('23','SNDEML');
    }

    function memotable($year, $month) {
        $ext_date = $year . '-' . $month . '-1';
        $month_name = date('F', strtotime($ext_date));
        $alloc_htm = "";
        $alloc_htm .= '<link href="' . base_url() . 'CSS/assets/css/style.css" type="text/css" rel="stylesheet"/>';
        $alloc_htm .= '<link href="' . base_url() . 'CSS/assets/css/bootstrap.css" type="text/css" rel="stylesheet"/>';
        $alloc_htm .= "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' />
        <h2>Ministry of Public Health and Sanitation</h2>
        <h2>Zone A Allocation for RTK Commodities $month_name , $year</h2>
        </div>";
        $country_summary = $this->_requested_vs_allocated($year, $month);

        $alloc_htm .= '<table class="table">
        <tr>
        <td rowspan="4"><br />Kenya Summary</td>
        <td>Commodity</td>
        <td>Opening Balance</td>
        <td>Closing Balance</td>
        <td>Used</td>
        <td>Tests</td>
        <td>Losses</td>
        <td>Requested</td>
        <td style="background: #D3F7D1;">Allocated</td>
        </tr>';
        if ($country_summary[0]['sum_opening'] < 1) {
            $alloc_htm .="<tr>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>"
                    . "<td> - </td>
            </tr>";
        } else {
            $alloc_htm .= '<tr>
            <td>Colloidal</td>
            <td>' . $country_summary[0]['sum_opening'] . '</td>
            <td>' . $country_summary[0]['sum_closing_bal'] . '</td>
            <td>' . $country_summary[0]['sum_used'] . '</td>
            <td>' . $country_summary[0]['sum_tests'] . '</td>
            <td>' . $country_summary[0]['sum_losses'] . '</td>
            <td>' . $country_summary[0]['sum_requested'] . '</td>
            <td style="background: #D3F7D1;">' . $country_summary[0]['sum_allocated'] . '</td>
            </tr>
            <tr>
            <td>First Response</td>
            <td>' . $country_summary[1]['sum_opening'] . '</td>
            <td>' . $country_summary[1]['sum_closing_bal'] . '</td>
            <td>' . $country_summary[1]['sum_used'] . '</td>
            <td>' . $country_summary[1]['sum_tests'] . '</td>
            <td>' . $country_summary[1]['sum_losses'] . '</td>
            <td>' . $country_summary[1]['sum_requested'] . '</td>
            <td style="background: #D3F7D1;">' . $country_summary[1]['sum_allocated'] . '</td>
            </tr>
            <tr>
            <td>Unigold</td>
            <td>' . $country_summary[2]['sum_opening'] . '</td>
            <td>' . $country_summary[2]['sum_closing_bal'] . '</td>
            <td>' . $country_summary[2]['sum_used'] . '</td>
            <td>' . $country_summary[2]['sum_tests'] . '</td>
            <td>' . $country_summary[2]['sum_losses'] . '</td>
            <td>' . $country_summary[2]['sum_requested'] . '</td>
            <td style="background: #D3F7D1;">' . $country_summary[2]['sum_allocated'] . '</td>
            </tr>';
        }
        $alloc_htm .= '</table>';
        $q = "select Distinct counties.county, counties.id
        FROM  facilities,counties,districts
        WHERE  facilities.zone = 'Zone A'
        AND facilities.district = districts.id
        AND districts.county = counties.id";

        $res = $this->db->query($q);

        foreach ($res->result_array() as $value) {
            $county_arr = $this->_memotable($value['id'], $year, $month);
            $countyid = $value['id'];
            $alloc_htm .= '<h3>' . $value['county'] . '</h3><br />';

            $county_summary = $this->_requested_vs_allocated($year, $month, $countyid);
            $alloc_htm .= '<table class="table">
            <tr>
            <td rowspan="4"><br />' . $value['county'] . ' County Summary</td>
            <td>Commodity</td>
            <td>Opening Balance</td>
            <td>Closing Balance</td>
            <td>Used</td>
            <td>Tests</td>
            <td>Losses</td>
            <td>Requested</td>
            <td style="background: #D3F7D1;">Allocated</td>
            </tr>';
            if ($county_summary[0]['sum_opening'] < 1) {
                $alloc_htm .="<tr>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>
                </tr>";
            } else {
                $alloc_htm .=
                        '
                <tr>
                <td>Colloidal</td>
                <td>' . $county_summary[0]['sum_opening'] . '</td>
                <td>' . $county_summary[0]['sum_closing_bal'] . '</td>
                <td>' . $county_summary[0]['sum_used'] . '</td>
                <td>' . $county_summary[0]['sum_tests'] . '</td>
                <td>' . $county_summary[0]['sum_losses'] . '</td>
                <td>' . $county_summary[0]['sum_requested'] . '</td>
                <td style="background: #D3F7D1;">' . $county_summary[0]['sum_allocated'] . '</td>
                </tr>
                <tr>
                <td>First Response</td>
                <td>' . $county_summary[1]['sum_opening'] . '</td>
                <td>' . $county_summary[1]['sum_closing_bal'] . '</td>
                <td>' . $county_summary[1]['sum_used'] . '</td>
                <td>' . $county_summary[1]['sum_tests'] . '</td>
                <td>' . $county_summary[1]['sum_losses'] . '</td>
                <td>' . $county_summary[1]['sum_requested'] . '</td>
                <td style="background: #D3F7D1;">' . $county_summary[1]['sum_allocated'] . '</td>
                </tr>
                <tr>
                <td>Unigold</td>
                <td>' . $county_summary[2]['sum_opening'] . '</td>
                <td>' . $county_summary[2]['sum_closing_bal'] . '</td>
                <td>' . $county_summary[2]['sum_used'] . '</td>
                <td>' . $county_summary[2]['sum_tests'] . '</td>
                <td>' . $county_summary[2]['sum_losses'] . '</td>
                <td>' . $county_summary[2]['sum_requested'] . '</td>
                <td style="background: #D3F7D1;">' . $county_summary[2]['sum_allocated'] . '</td>
                </tr>';
            }
            $alloc_htm .= '</table>';
            $alloc_htm .= "<table class='table table-striped'>";
            $alloc_htm .= "<tr>"
                    . "<td>Facility MFL</td>"
                    . "<td>Facility Name</td>"
                    . "<td>Commodity</td>"
                    . "<td>Opening Balance</td>"
                    . "<td>Closing Balance</td>"
                    . "<td>Requested</td>"
                    . "<td style='background: #D3F7D1;'>Allocated</td>"
                    . "</tr>";
            if (count($county_arr) == 0) {
                $alloc_htm .="<tr>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td>"
                        . "<td> - </td></tr>";
            }
            foreach ($county_arr as $key => $county_val) {
                $alloc_htm .= "<tr>" .
                        "<td>" . $county_val['facility_code'] . "</td>"
                        . "<td>" . $county_val['facility_name'] . "</td>"
                        . "<td>" . $county_val['commodity_name'] . "</td>"
                        . "<td>" . $county_val['beginning_bal'] . "</td>"
                        . "<td>" . $county_val['closing_stock'] . "</td>"
                        . "<td>" . $county_val['q_requested'] . "</td>"
                        . "<td style='background: #D3F7D1;'>" . $county_val['allocated'] . "</td></tr>";
            }
            $alloc_htm .="</table>";
            $alloc_htm .="<hr>";
        }
        return $alloc_htm;
    }

    public function distribution_memo($arr) {
        $tdata = '';
        $i = 0;
        $j = 1;
        $count = count($arr);
        while ($i < $count && $j < $count) {
            $id = $arr[$i];
            $val = $arr[$j];
            //echo 'SELECT * FROM lab_commodity_details, facilities WHERE facilities.facility_code = lab_commodity_details.facility_code    AND lab_commodity_details.id =' . $arr[$i]. '<br />';

            $allocations = $this->db->query('SELECT * FROM lab_commodity_details, facilities WHERE facilities.facility_code = lab_commodity_details.facility_code AND lab_commodity_details.id =' . $id . '');
            $allocs_array = $allocations->result_array();

            $commodity_id = $allocs_array[0]['commodity_id'];
            if ($commodity_id == 1) {
                $commodity = "Rapid HIV 1+2 Test 1 - Screening";
            }
            if ($commodity_id == 2) {
                $commodity = "Rapid HIV 1+2 Test 1 - Confirmatory";
            }
            if ($commodity_id == 3) {
                $commodity = "Rapid HIV 1+2 Test 1 - Tiebreaker";
            }
            if ($commodity_id == 4) {
                $commodity = "Rapid Syphillis Test (RPR)";
            }
            if ($allocs_array[0]['allocated'] > 0) {
                $tdata .= '' . $allocs_array[0]['facility_name'] . ' was allocated ' . $allocs_array[0]['allocated'] . ' of ' . $commodity . '<br />';
            }
            /*            foreach ($allocations->result_array() as $allocs_array) {
              $commodity_id = $allocs_array['commodity_id'];
              if ($commodity_id == 1) {$commodity = "Rapid HIV 1+2 Test 1 - Screening";}
              if ($commodity_id == 2) {$commodity = "Rapid HIV 1+2 Test 1 - Confirmatory";}
              if ($commodity_id == 3) {$commodity = "Rapid HIV 1+2 Test 1 - Tiebreaker";}
              if ($commodity_id == 4) {$commodity = "Rapid Syphillis Test (RPR)";}
              } */
            $i += 2;
            $j += 2;
        }
        date_default_timezone_set('EUROPE/Moscow');
        date_default_timezone_set("EUROPE/Moscow");
        $firstday = date('D dS M Y', strtotime("first day of previous month"));
        $lastday = date('D dS M Y', strtotime("last day of previous month"));
        $lastmonth = date('F', strtotime("last day of previous month"));

        $reportname = 'RTK Allocations for ' . $lastmonth;
        echo $tdata;
    }

    public function allocations() {
        $data['title'] = '';
        $data['banner_text'] = 'Allocations countrywide';
        $data['content_view'] = 'allocation_committee/allocations_view';
        $tdata = '';
        $allocated_facilities = array();

        $allcounties = $this->db->query('SELECT county,id FROM  `counties` ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                array_push($allocated_facilities, $allocations_arr['facility_code']);

                # code...
                //                $facilities->num_rows() > 0)
            }
            $allocated_facilities = array_unique($allocated_facilities);
            $no_of_allocated_facilities = count($allocated_facilities);
            //          echo $no_of_allocated_facilities;
            //        echo "<pre>";                var_dump($allocated_facilities);echo "</pre>";
            //      exit;

            $num = $allocations->num_rows();
            if ($num > 1) {
                $tdata .= '<tr><td>' . $County . '</td><td></td><td>' . $no_of_allocated_facilities . '</td><td>' . $num . '</td><td><a href="allocations_county/' . $id . '">View</a> <!--<a onClick="downloadcounty(' . $id . ')">Download</a> --></td></tr>';
            }
        }

        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function allocations_county($county) {
        $data['title'] = '';
        $data['content_view'] = 'allocation_committee/counties_allocated_view';
        $tdata = '';
        $allcounties = $this->db->query('SELECT county,id FROM  `counties` WHERE id =' . $county . ' ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.order_id = lab_commodity_orders.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                //  echo "<pre>";
                //    var_dump($allocations_arr);
                //echo "</pre>";
                $commodity_id = $allocations_arr['commodity_id'];
                $facility_name = $allocations_arr['facility_name'];
                $district = $allocations_arr['district'];
                $facility_code = $allocations_arr['facility_code'];
                $beginning_bal = $allocations_arr['beginning_bal'];
                $closing_stock = $allocations_arr['closing_stock'];
//                $month = $allocations_arr['month'];
                $q_requested = $allocations_arr['q_requested'];
                $allocated = $allocations_arr['allocated'];
                $order_id = $allocations_arr['order_id'];
//                $allocations_arr['month'];

                $commodity = "";

                if ($commodity_id == 1) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Screening";
                }
                if ($commodity_id == 2) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Confirmatory";
                }
                if ($commodity_id == 3) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Tiebreaker";
                }
                if ($commodity_id == 4) {
                    $commodity = "Rapid Syphillis Test (RPR)";
                }

                $allocations_data_commodity_id = $allocations_arr["commodity_id"];

                $tdata .= '<tr><td>' . $facility_name . '</td>
            <td>' . $facility_code . '</td>

            <td>' . $district . '</td>
            <td>' . $commodity . '</td>
            <td>' . $beginning_bal . '</td>
            <td>' . $closing_stock . '</td>
            <td>' . $q_requested . '</td>
            <td>' . $allocated . '</td>
            <td><a href="../lab_order_details/' . $order_id . '" title="View entire order">View</a> <br /><!--<a href="#">download</a>--></td></tr>';

                //                $facilities->num_rows() > 0)
            }
            $countyname = $allocations_arr['county'];
        }

        $county_name = Counties::get_county_name($countyname);
        $data['banner_text'] = 'Allocations for ' . $county_name[0]['county'];
        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function allocations_county_download($county) {
        $html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
    <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>RTK FCDRR Report for    2013</div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
    Ministry of Health</div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />";
        $tdata = '';
        $allcounties = $this->db->query('SELECT county,id FROM  `counties` WHERE id =' . $county . ' ');
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.order_id = lab_commodity_orders.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                $commodity_id = $allocations_arr['commodity_id'];
                $facility_name = $allocations_arr['facility_name'];
                $district = $allocations_arr['district'];
                $facility_code = $allocations_arr['facility_code'];
                $beginning_bal = $allocations_arr['beginning_bal'];
                $closing_stock = $allocations_arr['closing_stock'];
                $month = $allocations_arr['month'];
                $q_requested = $allocations_arr['q_requested'];
                $allocated = $allocations_arr['allocated'];
                $order_id = $allocations_arr['order_id'];
                $allocations_arr['month'];
                $commodity = "";
                if ($commodity_id == 1) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Screening";
                }
                if ($commodity_id == 2) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Confirmatory";
                }
                if ($commodity_id == 3) {
                    $commodity = "Rapid HIV 1+2 Test 1 - Tiebreaker";
                }
                if ($commodity_id == 4) {
                    $commodity = "Rapid Syphillis Test (RPR)";
                }
                $allocations_data_commodity_id = $allocations_arr["commodity_id"];
                $tdata .= '<tr><td>' . $facility_name . '</td>
            <td>' . $facility_code . '</td>        
            <td>' . $district . '</td>
            <td>' . $commodity . '</td>
            <td>' . $beginning_bal . '</td>
            <td>' . $closing_stock . '</td>
            <td>' . $q_requested . '</td>
            <td>' . $allocated . '</td>
            </tr>';
            }
            $countyname = $allocations_arr['county'];
        }
        $county_name = Counties::get_county_name($countyname);
        $data['banner_text'] = 'Allocations for ' . $county_name[0]['county'];
        echo $html_title;
        echo '<table id="allocated" class="data-table">
    <thead>    
    <th>Facility</th>
    <th>MFL</th>
    <th>District</th>
    <th>Commodity</th>
    <th>Begining Balance</th>
    <th>Closing Balance</th>
    <th>Requested</th>
    <th>Allocated</th>
    </thead>
    ' . $tdata . ''
        . '</table>';
        $data['tdata'] = $tdata;
        //    $this->load->view('rtk/template', $data);
    }

    public function rtk_allocation_form_data($county_id) {
        $facility_code = $_POST['facility_code'];
        $allocation_data = $_POST['qty_allocated'];
        $commodity_id = $_POST['commodity_id'];
        $date = date('y-m-d');
        foreach ($allocation_data as $key => $value) {
            if ($value > 0) {
                $q = Doctrine_Manager::getInstance()->getCurrentConnection();
                $q->execute("insert into rtk_allocation set facility_code=$facility_code[$key],qty=$value,`date_allocated`='$date',commodity_id=$commodity_id[$key]");
                //$object_id = $this->db->insert_id();
                //$this->logData('16',$object_id);
            } else {
                //do nothing
            }
        }
        $county_name = Counties::get_county_name($county_id);
        $county_name = $county_name[0]['county'];
        $this->home("Allocation Details for $county_name County has been updated");
    }

    function rtk_county_sidebar() {
        $counties = Counties::getAll();
        $table_data = "";
        $allocation_rate = 0;
        $total_facilities_in_county = 0;
        $total_facilities_allocated_in_county = 1;
        $total_facilities = 0;
        $total_allocated = 0;
        foreach ($counties as $county_detail) {
            $countyid = $county_detail->id;
            $facilities_in_county = $this->db->query('SELECT * 
            FROM facilities, districts, counties
            WHERE facilities.district = districts.id
            AND districts.county = counties.id
            AND counties.id =' . $countyid . '
            AND facilities.rtk_enabled =1');
            $facilities_num = $facilities_in_county->num_rows();

            $sql = "SELECT DISTINCT lab_commodity_orders.id, lab_commodity_orders.facility_code
                        FROM lab_commodity_details, counties, facilities, districts, lab_commodity_orders
                        WHERE lab_commodity_details.facility_code = facilities.facility_code
                        AND counties.id = districts.county
                        AND counties.id =$countyid 
                        AND facilities.district = districts.id
                        AND lab_commodity_details.order_id = lab_commodity_orders.id
                        AND lab_commodity_details.allocated >0";

            $allocated_facilities = $this->db->query($sql);

            $allocated_facilities_num = $allocated_facilities->num_rows();

            // $county_map_id=$county_detail->kenya_map_id;
            $countyname = trim($county_detail->county);

            $county_detail = rtk_stock_status::get_allocation_rate_county($countyid);
            //     $total_facilities_in_county=$county_detail['total_facilities_in_county'];
            $total_facilities_in_county = $total_facilities_in_county + $facilities_num;

            $total_facilities_allocated_in_county = $county_detail['total_facilities_allocated_in_county'];

            $total_facilities = $total_facilities + $facilities_num;
            $total_allocated = $total_allocated + $allocated_facilities_num;

            $table_data .= "<tr><td><a href=" . site_url() . "rtk_management/allocation_county_detail_zoom/$countyid> $countyname</a> </td><td>$allocated_facilities_num / $facilities_num</td></tr>";
        }

        return $table_data .= "<tr><td>TOTAL </td><td>  $total_allocated |  $total_facilities_in_county  </td><tr>";
    }

    ////////////////////////////////////////////////////////////////////////////////////////charts
    public function generate_malaria_test_chart() {
        $strXML = "<chart palette='1' useRoundEdges='1' xaxisname='Type of Test' yaxisname='No of Tests' bgColor='FFFFFF' showBorder='0'  caption='Malaria Tests' >
    <categories font='Arial' >
    <category label='RDT' />
    <category label='Microscopy' />
    </categories>
    <dataset seriesname=' Patients under 5 years' color='8BBA00' >
    <set value='30' />
    <set value='26' />
    <set value='29' />                
    </dataset>
    <dataset seriesname='Patients 5-14 yrs' color='A66EDD' >
    <set value='67' />
    <set value='98' />
    <set value='79' />                
    </dataset>
    <dataset seriesname='Patients over 14 years' color='F6BD0F' >
    <set value='27' />
    <set value='25' />
    <set value='28' />                
    </dataset>
    </chart>";
        echo $strXML;
    }

    public function generate_hiv_test_kits_chart() {
        $strXML = "<chart caption='HIV Tests N=456' bgColor='FFFFFF' useRoundEdges='1'  showBorder='0' showPercentageValues='1' plotBorderColor='FFFFFF' isSmartLineSlanted='0' showValues='1' showLabels='1' showLegend='1'>
    <set value='212' label='VCT' />
    <set value='96' label='PITC' />
    <set value='26' label='PMTCT' />
    <set value='29' label='Blood Screening' />
    <set value='93' label='Other'/></chart>";
        echo $strXML;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    public function fcdrr_Report() {
        $data['title'] = "FCDRR REPORT";
        //$data['drugs'] = Drug::getAll();
        $data['content_view'] = "rtk/fcdrr_Report";
        $data['banner_text'] = "FCDRR REPORT";
        $data['link'] = "rtk_management";
        $data['quick_link'] = "fcdrr_Report";
        $this->load->view("rtk/template", $data);
    }

    public function generate_fcdrr_Report_pdf($report_name, $title, $html_data) {
        $current_year = date('Y');
        $current_month = date('F');
        $facility_code = $this->session->userdata('news');
        $facility_name_array = Facilities::get_facility_name($facility_code)->toArray();
        $facility_name = $facility_name_array['facility_name'];
        //if ($display_type == "Download PDF") {

        /*         * ******************************************setting the report title******************** */

        $html_title = "<div ALIGN=CENTER><img src='" . base_url() . "Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold;'>Division of Reproductive Health Report</div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
    Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
    <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>" . $current_month . " " . $current_year . "</h2>
    <hr />   ";

        $css_path = base_url() . 'CSS/style.css';

        /*         * ********************************initializing the report ********************* */
        $this->load->library('mpdf');
        $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
        //$stylesheet = file_get_contents("$css_path");
        //$this->mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text
        $this->mpdf->SetTitle($title);
        $this->mpdf->WriteHTML($html_title);
        $this->mpdf->simpleTables = true;
        $this->mpdf->WriteHTML('<br/>');
        $this->mpdf->WriteHTML($html_data);
        $reportname = $report_name . ".pdf";
        $this->mpdf->Output($reportname, 'D');
    }

    public function generate_fcdrr_Report_excel($report_name, $title, $html_data) {
        $data = $html_data;
        $filename = $report_name;
        header("Content-type: application/excel");
        header("Content-Disposition: attachment; filename=$filename.xls");
        echo "$data";
    }

    public function new_counties_alloc() {
        $data['title'] = 'National allocations';
        $data['banner_text'] = 'National allocations';
        $data['content_view'] = 'allocation_committee/allocation_v';
        $this->load->view('rtk/template', $data);
    }

    function _get_facility_name($fcode) {
        $q = "SELECT * FROM  facilities,districts WHERE  facility_code like '$fcode'
    AND districts.id = facilities.district";
        $res = $this->db->query($q);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function know_who_reported($county) {
//      ,lab_commodity_orders.id, facilities.facility_code AS fcode, facilities.facility_name, facilities.district, counties.id, counties.county, districts.county, districts.id, districts.district AS districtname
        $q = 'SELECT DISTINCT lab_commodity_orders.facility_code
    FROM lab_commodity_orders, facilities, counties, districts
    WHERE lab_commodity_orders.facility_code = facilities.facility_code
    AND districts.id = facilities.district
    AND districts.county = counties.id
    AND counties.id =' . $county;
        $returnable = array();
//      $returnable = array_unique($returnable);
        $res = $this->db->query($q);
//      $returnable = $res->result_array();

        $tab_htm = '

    <link href="' . base_url() . 'CSS/bootstrap.css" type="text/css" rel="stylesheet"/> 
    <table class="table">';
        $tab_htm .= '<thead>
    <th>Facility MFL</th>
    <th>Facility Name</th>
    <th>District</th>
    <th>Facility type</th>
    </thead>';
        foreach ($res->result_array() as $value) {
            # code...
            $details = $this->_get_facility_name($value['facility_code']);
            array_push($returnable, $details);

            $tab_htm .='<tr>
        <td>' . $details[0]['facility_code'] . '</td>
        <td>' . $details[0]['facility_name'] . '</td>
        <td>' . $details[0]['district'] . '</td>
        <td>' . $details[0]['type'] . '</td>
        <tr>';
        }

        $countyname = counties::get_county_name($county);
        $countyname = $countyname[0]['county'];

        $output = '<h2>' . $countyname . '<span style="font-size:60%;"> RTK FCDRR Reporting Facilities</span></h2><hr>'
                . $tab_htm . '</table>';
        return $output;
    }

    public function counties_combined() {
        $q = 'SELECT DISTINCT lab_commodity_orders.facility_code, lab_commodity_orders.id, facilities.facility_code AS fcode, facilities.facility_name, facilities.district, counties.id as county_id, counties.county, districts.county, districts.id, districts.district AS districtname
        FROM lab_commodity_orders, facilities, counties, districts
        WHERE lab_commodity_orders.facility_code = facilities.facility_code
        AND districts.id = facilities.district
        AND districts.county = counties.id';
        $res = $this->db->query($q);
        $combi = '';
        $result = $res->result_array();
        $counties = array();
        foreach ($result as $value) {
            # code...
            array_push($counties, $value['county_id']);
        }
        $counties = array_unique($counties);

        foreach ($counties as $value) {
            echo $value . '<br />';

            $combi .=$this->know_who_reported($value) . '<br /><br /><br />';
            # code...
        }
//        die;
//      echo $combi;
        $reportname = 'RTK FCDRR Reporting Facilities';
        $email_address = 'williamnguru@gmail.com';
        $this->sendmail($combi, $reportname, $email_address);
    }

    public function national_allocation() {
        $data['banner_text'] = "National Allocation";
        $data['content_view'] = "allocation_committee/national_allocation_v";
        $data['title'] = "National Allocation";
        $this->load->view('rtk/template', $data);
    }

    public function national_allocation_chart() {
        $str_xml_body = '';
        //      $title="";
        $strXML = "<chart caption='National Allocation' yAxisName='Allocation' alternateVGridColor='AFD8F8' baseFontColor='114B78' toolTipBorderColor='114B78' toolTipBgColor='E7EFF6' useRoundEdges='1' showBorder='0' bgColor='FFFFFF,FFFFFF'>";

        $allocations = rtk_stock_status::get_national_allocation();
        $counties = counties::getAllcounties();
        foreach ($counties as $counties_data) {
            $counties_data_id = $counties_data["id"];
        }

        $districts = districts::getDistrict(2);
        // Gets districts within county id 2
        foreach ($districts as $districts_data) {
            $districts_data_id = $districts_data["id"];
            $districts_data_name = $districts_data["district"];
            //      echo $districts_data_id;
            //echo $districts_data_name."<br /><br />";
            $facilities = facilities::getFacilities($districts_data_id);
            foreach ($facilities as $facilities_data) {
                $facilities_data_id = $facilities_data["id"];
                $facilities_data_code = $facilities_data["facility_code"];

                $allocations = rtk_stock_status::get_county_allocation($facilities_data_code);
                $sum_determine = 0;
                $sum_unigold = 0;
                $sum_syphillis = 0;
                $commodity = "";

                foreach ($allocations as $allocations_data) {
                    if ($allocations_data["commodity_id"] == 1) {
                        $commodity = "Colloidal";
                        $sum_unigold += $allocations_data["qty"];
                    }
                    if ($allocations_data["commodity_id"] == 2) {
                        $commodity = "First Response";
                        $sum_determine += $allocations_data["qty"];
                    }
                    if ($allocations_data["commodity_id"] == 3) {
                        $commodity = "Unigold";
                        $sum_syphillis += $allocations_data["qty"];
                    }
                    $allocations_data_commodity_id = $allocations_data["commodity_id"];
                }
            }
            $str_xml_body .= "<set value='$sum_determine' label='Total Determine $districts_data_name'/>";
            $str_xml_body .= "<set value='$sum_unigold' label='Reporting Unigold $districts_data_name'/>";
            $str_xml_body .= "<set value='$sum_syphillis' label='Sum Syphillis $districts_data_name'/>";
        }

        echo $str_xml_body;
        $strXML .= "$str_xml_body</chart>";
        echo $strXML;
    }

    public function create_DMLT() {

        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $district = $_POST['district'];
        $county = $_POST['county'];
        $time = date('Y-m-d', time());

        $fname = addslashes($fname);
        $lname = addslashes($lname);

        $sql = "INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `username`, `password`, `usertype_id`, `telephone`, `district`, `facility`, `created_at`, `updated_at`, `status`, `county_id`)
        VALUES (NULL, '$fname', '$lname', '$email', '$email', 'b56578e2f9d28c7497f42b32cbaf7d68', '7', '$phone', '$district', NULL, '$time', '$time', '1', '$county');";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('1', $object_id);
        echo "User has been created succesfully";
    }

    public function adduser() {

        $fname = $_POST['FirstName'];
        $lname = $_POST['Lastname'];
        $email = $_POST['email'];
        $district = $_POST['district'];
        $county = $_POST['county'];
        $level = $_POST['level'];
        $time = date('Y-m-d', time());

        $fname = addslashes($fname);
        $lname = addslashes($lname);

        $sql = "INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `username`, `password`, `usertype_id`, `telephone`, `district`, `facility`, `created_at`, `updated_at`, `status`, `county_id`)
        VALUES (NULL, '$fname', '$lname', '$email', '$email', 'b56578e2f9d28c7497f42b32cbaf7d68', '$level', '', '$district', NULL, '$time', '$time', '1', '$county');";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('1', $object_id);
        redirect('rtk_management/rtk_manager_admin');
        //       echo 'User: '.$fname." has been created succesfully";
    }

    public function create_facility() {
        $facilityname = $_POST['facilityname'];
        $facilitycode = $_POST['facilitycode'];
        $facilityowner = $_POST['facilityowner'];
        $facilitytype = $_POST['facilitytype'];
        $district = $_POST['district'];

        $time = date('Y-m-d', time());

        $facilityname = addslashes($facilityname);

        $sql = "INSERT INTO `facilities` (`id`, `facility_code`, `facility_name`, `district`, `drawing_rights`, `owner`, `type`, `level`, `rtk_enabled`, `cd4_enabled`, `drawing_rights_balance`, `using_hcmp`, `date_of_activation`) 
        VALUES (NULL, '$facilitycode', '$facilityname', '$district', '0', '$facilityowner', '$facilitytype', '', '1', '0', '0', '0', '$time')";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('20', $object_id);
        redirect('rtk_management/rtk_mapping/dpp');
    }

    private function _monthly_facility_reports($mfl, $monthyear = null) {
        $conditions = '';
        if (isset($monthyear)) {
            $year = substr($monthyear, -4);
            $month = substr_replace($monthyear, "", -4);
            $firstdate = $year . '-' . $month . '-01';
            $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $lastdate = $year . '-' . $month . '-' . $num_days;
            $conditions=" AND lab_commodity_orders.order_date
                                BETWEEN  '$firstdate'
                                AND  '$lastdate'";
        }

        $sql = "select lab_commodity_orders.order_date,lab_commodity_orders.compiled_by,lab_commodity_orders.id,
        facilities.facility_name,districts.district,districts.id as district_id, counties.county,counties.id as county_id
        FROM lab_commodity_orders,facilities,districts,counties
        WHERE lab_commodity_orders.facility_code = facilities.facility_code
        AND facilities.district = districts.id
        AND counties.id = districts.county
        AND facilities.facility_code =$mfl $conditions";        

        
        $sql .=' Order by lab_commodity_orders.order_date desc';

        $res = $this->db->query($sql);
        $sum_facilities = array();
        $facility_arr = array();

        foreach ($res->result_array() as $key => $value) {
            $facility_arr = $value;
            $details = $this->fcdrr_values($value['id']);

            array_push($facility_arr, $details);
            array_push($sum_facilities, $facility_arr);
        }
        return $sum_facilities;
    }

    private function _facilities_in_district($district) {
        $sql = 'select facility_code,facility_name from facilities where district=' . $district;
        $res = $this->db->query($sql);
        /*
          $returnable = array();
          foreach ($res->result_array() as $key => $value) {
          $value['facility_name'] .= ' - '.$value['facility_code'];
          array_push($returnable, $value);
          }
         */
        return $res->result_array();
    }

    private function _districts_from_county($county) {
        $sql = 'SELECT * from districts where county=' . $county;
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function facility_amc_compute() {
        $sql = "select facilities.facility_code from facilities where facilities.rtk_enabled = '1' AND facilities.facility_code not in (select facility_amc.facility_code from facility_amc)";
        $res = $this->db->query($sql);
        $facility = $res->result_array();

        foreach ($facility as $value) {
            $time = time();
            $fcode = $value['facility_code'];
            $amc1 = $this->_facility_amc($value['facility_code'], 1);
            $amc2 = $this->_facility_amc($value['facility_code'], 2);
            $amc3 = $this->_facility_amc($value['facility_code'], 3);
            $amc5 = $this->_facility_amc($value['facility_code'], 5);
            $amc6 = $this->_facility_amc($value['facility_code'], 6);

            $insert1 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`)VALUES (NULL, '$fcode', '1', '$amc1', '$time');";
            $insert2 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`)VALUES (NULL, '$fcode', '2', '$amc2', '$time');";
            $insert3 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`)VALUES (NULL, '$fcode', '3', '$amc3', '$time');";
            $insert5 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`)VALUES (NULL, '$fcode', '5', '$amc5', '$time');";
            $insert6 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`)VALUES (NULL, '$fcode', '6', '$amc6', '$time');";
            
              $this->db->query($insert1);
              $this->db->query($insert2);
              $this->db->query($insert3);
              $this->db->query($insert5);
              $this->db->query($insert6);
            

            echo '<pre>';
            echo $insert1;
            echo $insert2;
            echo $insert3;
            echo $insert5;
            echo $insert6;
            echo '<br/></pre>';
        }
    }

    function set_amcs() {
        $sql = "select facilities.facility_code, facilities.district,facilities.Zone from facilities where facilities.rtk_enabled = '1' and  facilities.Zone = 'Zone c' and facilities.facility_code not in         (select facility_amc.facility_code from facility_amc)";
        $res = $this->db->query($sql);
        foreach ($res->result_array() as $value) {
            $fcode = $value['facility_code'];

            $insert1 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`) 
            VALUES (NULL, '$fcode', '1', 0, 0);";
            $insert2 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`) 
            VALUES (NULL, '$fcode', '2', 0, 0);";
            $insert3 = "INSERT INTO facility_amc (`id`, `facility_code`, `commodity_id`, `amc`, `last_update`) 
            VALUES (NULL, '$fcode', '3', 0, 0);";
            echo $insert1;
            echo $insert2;
            echo $insert3;
        }
    }

    private function update_amc($mfl) {
        $last_update = time();
        $amc = 0;
        for ($commodity_id = 1; $commodity_id <= 6; $commodity_id++) {
            $amc = $this->_facility_amc($mfl, $commodity_id);
            $sql = "update facility_amc set amc = '$amc', last_update = '$last_update' where facility_code = '$mfl' and commodity_id='$commodity_id'";
            $res = $this->db->query($sql);
        }
    }

    public function facility_zone_amc($zone = NULL) {
        $conditions = "";

        $conditions = (isset($zone)) ? $conditions . " AND facilities.zone = 'Zone $zone'" : $conditions . ' ';

        $sql = "SELECT facilities.facility_code,facilities.facility_name, facilities.zone, facility_amc.amc,counties.county, districts.district
            FROM facilities, facility_amc, lab_commodities, counties, districts
            WHERE facilities.rtk_enabled =1 
                $conditions 
                    AND facilities.facility_code = facility_amc.facility_code 
                    AND districts.county = counties.id
                    AND facilities.district = districts.id
                    AND facility_amc.commodity_id = lab_commodities.id 
                    ORDER BY facilities.zone DESC ";

        $res = $this->db->query($sql);
        $result = $res->result_array();
//echo '<pre>';print_r($result);die;
        echo '<table width="98%" border="1" class=""  id="example">
        <thead>
            <tr>
                <th>Zone</th>
                <th>Facility Code</th>
                <th>Facility Name</th>
                <th>District</th>
                <th>County</th>
                <th>Determine</th>
                <th>Unigold</th>
                <th>Tiebreaker</th>
            </tr>
        </thead>
        <tbody>';
        $max = count($result);
        $i = 0;
        while ($i < $max) {
            echo "<tr>"
            . "<td>" . $result[$i]['zone'] . "</td>"
            . "<td>" . $result[$i]['facility_code'] . "</td>"
            . "<td>" . $result[$i]['facility_name'] . "</td>"
            . "<td>" . $result[$i]['district'] . "</td>"
            . "<td>" . $result[$i]['county'] . "</td>";
            echo "<td>" . $result[$i]['amc'] . "</td>";
            $i++;
            echo "<td>" . $result[$i]['amc'] . "</td>";
            $i++;
            echo "<td>" . $result[$i]['amc'] . "</td>"
            . "</tr>";
            $i++;
        }
        echo '</table>';
    }

    public function rtk_manager_admin_settings() {

        $sql = "select rtk_settings.*, user.fname,user.lname from rtk_settings, user where rtk_settings.user_id = user.id ";
        $res = $this->db->query($sql);
        $deadline_data = $res->result_array();

        $sql1 = "select * from rtk_alerts_reference ";
        $res1 = $this->db->query($sql1);
        $alerts_to_data = $res1->result_array();


        $sql3 = "select rtk_alerts.*,rtk_alerts_reference.id as ref_id,rtk_alerts_reference.description as description from rtk_alerts,rtk_alerts_reference where rtk_alerts.reference=rtk_alerts_reference.id order by id ASC,status ASC";
        $res3 = $this->db->query($sql3);
        $alerts_data = $res3->result_array();

        $sql4 = "select lab_commodities.*,lab_commodity_categories.category_name, lab_commodity_categories.id as cat_id from lab_commodities,lab_commodity_categories where lab_commodities.category=lab_commodity_categories.id and lab_commodity_categories.active = '1'";
        $res4 = $this->db->query($sql4);
        $commodities_data = $res4->result_array();

        $sql5 = "select * from lab_commodity_categories";
        $res5 = $this->db->query($sql5);
        $commodity_categories = $res5->result_array();


        $data['deadline_data'] = $deadline_data;
        $data['alerts_to_data'] = $alerts_to_data;
        $data['alerts_data'] = $alerts_data;
        $data['commodities_data'] = $commodities_data;
        $data['commodity_categories'] = $commodity_categories;

        $data['title'] = 'RTK Manager Settings';
        $data['banner_text'] = 'RTK Manager Settings';
        //$data['content_view'] = "rtk/admin/admin_home_view";
        $data['content_view'] = "rtk/rtk/admin/settings";
        $users = $this->_get_rtk_users();
        $data['users'] = $users;
        $this->load->view('rtk/template', $data);
    }

    public function rtk_manager_admin_messages() {
        
        /*$users = array('email' =>'All SCMLTs' , 
                        'email' =>'All CLCs' ,
                        'email' =>'Sub-Counties with Less than 25% Reported' ,
                        'email' =>'Sub-Counties with Less than 50% Reported' ,
                        'email' =>'Sub-Counties with Less than 75% Reported' ,
                        'email' =>'Sub-Counties with Less than 90% Reported' );             
        echo "<pre>";
        print_r($users);die();



        $data['emails'] = json_encode($emails);
        $data['emails'] = str_replace('"', "'", $data['emails']);
        // echo "<pre>";
        //print_r( $data['emails']);*/



        /* $sql1 = "select fname from user";
          $res1 = $this->db->query($sql1);
          $fname = $res1->result_array();
          $data['fname'] = json_encode($fname);
          $data['fname'] = str_replace('"', "'", $data['fname']); */
        //$data['details'] = $details;
        $data['title'] = 'RTK Manager Messages';
        $data['banner_text'] = 'RTK Manager';
        //$data['content_view'] = "rtk/rtk/admin/admin_home_view";
        $data['content_view'] = "rtk/rtk/admin/messages";
        //$users = $this->_get_rtk_users();
       // $data['users'] = $users;
        $this->load->view('rtk/template', $data);
    }

    public function create_Deadline() {
        $zones = json_decode($_POST['add_zones']);
        $user_id = $this->session->userdata('user_id');
        $deadline = $_POST['deadline'];
        $five_day_alert = $_POST['five_day_alert'];
        $report_day_alert = $_POST['report_day_alert'];
        $overdue_alert = $_POST['overdue_alert'];
        foreach ($zones as $value) {
            $sql = "INSERT INTO `rtk_settings`(`id`, `deadline`, `status`, `5_day_alert`, `report_day_alert`, `overdue_alert`, `zone`, `user_id`) 
           VALUES (NULL,'$deadline','0','$five_day_alert','$report_day_alert','$overdue_alert','$value','$user_id')";
            $this->db->query($sql);
            $object_id = $this->db->insert_id();
            $this->logData('7', $object_id);
        }
        echo "Deadline Added succesfully";
    }

    public function update_Deadline() {

        $zones = json_decode($_POST['edit_zones']);
        $edit_id = $_POST['id'];
        $user_id = $this->session->userdata('user_id');
        $deadline = $_POST['deadline'];
        $five_day_alert = $_POST['five_day_alert'];
        $report_day_alert = $_POST['report_day_alert'];
        $overdue_alert = $_POST['overdue_alert'];
        $sql = "update rtk_settings 
    set deadline='$deadline',5_day_alert = '$five_day_alert',report_day_alert='$report_day_alert',overdue_alert='$overdue_alert',user_id='$user_id' where id='$edit_id'";
        $this->db->query($sql);
        $object_id = $edit_id;
        $this->logData('8', $object_id);
        echo "Deadline Updated succesfully";
    }

    public function create_Alert() {
        $message = $_POST['message'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        $reference = $_POST['reference'];
        $sql1 = "INSERT INTO `rtk_alerts`(`id`,`message`, `type`, `status`,`reference`) VALUES (NULL,'$message','$type','$status','$reference')";

        $this->db->query($sql1);
        $object_id = $this->db->insert_id();
        $this->logData('10', $object_id);
        echo "Alert Created Succesfully";
    }

    public function update_Alert() {
        $message = $_POST['message'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        $alert_to = $_POST['alert_to'];
        $id = $_POST['c_id'];
        $sql = "UPDATE `rtk_alerts` SET `message`='$message',`type`='$type',`status`='$status',`reference`='$alert_to' WHERE `id`='$id'";
        $this->db->query($sql);
        $object_id = $id;
        $this->logData('11', $object_id);
        echo "Alert Updated Succesfully";
    }

    public function create_Commodity() {
        $name = $_POST['name'];
        $unit = $_POST['unit'];
        $category = $_POST['category'];
        $sql = "INSERT INTO `lab_commodities`(`id`, `commodity_name`, `category`, `unit_of_issue`) VALUES (NULL,'$name','$category','$unit')";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('4', $object_id);
        echo "Commodity Created Succesfully";
    }

    public function update_Commodity() {
        $name = $_POST['name'];
        $unit = $_POST['unit'];
        $category = $_POST['category'];
        $c_id = $_POST['c_id'];
        $sql = "UPDATE `lab_commodities` SET `commodity_name`='$name',`category`='$category',`unit_of_issue`='$unit' WHERE id='$c_id'";
        $this->db->query($sql);
        $object_id = $c_id;
        $this->logData('5', $object_id);

        echo "Commodity Updated Succesfully";
    }

    public function logData($reference, $object) {
        $timestamp = time();
        $user_id = $this->session->userdata('user_id');
        $sql = "INSERT INTO `rtk_logs`(`id`, `user_id`, `reference`,`reference_object`,`timestamp`) VALUES (NULL,'$user_id','$reference','$object','$timestamp')";
        $this->db->query($sql);
    }

    public function rtk_send_message() {
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $attach_file = null;
        $bcc_email = null;
        $receipient = array();
        parse_str($_POST['receipients'], $receipient);
        $receipient = $receipient['hidden-receipients'];
        include 'rtk_mailer.php';
        $newmail = new rtk_mailer();
        $response = $newmail->send_email($receipient, $message, $subject, $attach_file, $bcc_email);
        $sql = "INSERT INTO `rtk_messages`(`id`, `sender`, `subject`, `message`, `receipient`, `state`) VALUES (NULL,'$sender','$subject','$message','$receipient','0')";
        $this->db->query($sql);
        $object_id = $this->db->insert_id();
        $this->logData('23', $object_id);
        echo "Email Sent";
    }

    public function county_balances($month = null, $year = null) {
        if ($month != null) {
            $firstdate = $year . '-' . $month . '-01';
            $firstday = date("Y-m-d", strtotime("$firstdate"));
            $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $lastdate = $year . '-' . $month . '-' . $num_days;
        } else {
            $year = date('Y', time());
            $month = date('m', time());
            $firstdate = $year . '-' . $month . '-01';
            $firstday = date("Y-m-d", strtotime("$firstdate"));
            $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $lastdate = $year . '-' . $month . '-' . $num_days;
        }

        $sql = "select distinct counties.id as c_id,counties.county,lab_commodity_details.* , lab_commodity_details.created_at,lab_commodity_details.district_id,lab_commodities.*, 
    sum(lab_commodity_details.closing_stock) 
    from lab_commodity_details, lab_commodities , counties,districts
    where districts.id = lab_commodity_details.district_id  and lab_commodity_details.commodity_id = lab_commodities.id 
    and counties.id= districts.county
    and lab_commodity_details.commodity_id in (select id  from lab_commodities where id in ('1','2','3'))and lab_commodity_details.created_at between '$firstday' and '$lastdate' group by counties.id,  lab_commodities.commodity_name";

        $res = $this->db->query($sql);
        return $res->result_array();
    }

    public function compare_facilities($facil1, $facil2, $month = null, $year = null) {
        if ($month == null) {
            $year = date('Y', time());
            $month = date('m', time());
        } else {
            $year = $year;
            $month = $month;
        }
        $current_month_year = $year . '-' . $month . '-01';
        $period = $month . $year;

        $month_prev = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));
        $month_prev = date('m', strtotime("$month_prev"));

        //echo "$month_prev";die();
        $year_prev = date('Y', strtotime("last month", strtotime($current_month_year)));
        $period_prev = $month_prev . $year_prev;
        $previous_month_year = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));

        $month_prev1 = date('m', strtotime("last month", strtotime($previous_month_year)));
        $year_prev1 = date('Y', strtotime("last month", strtotime($previous_month_year)));
        $period_prev1 = $month_prev1 . $year_prev1;

        $facility_one_current = $this->_monthly_facility_reports($facil1, $period);
        $facility_one_previous = $this->_monthly_facility_reports($facil1, $period_prev);
        $facility_one_previous1 = $this->_monthly_facility_reports($facil1, $period_prev1);

        $facility_two_current = $this->_monthly_facility_reports($facil2, $period);
        $facility_two_previous = $this->_monthly_facility_reports($facil2, $period_prev);
        $facility_two_previous1 = $this->_monthly_facility_reports($facil2, $period_prev1);

        $returnable = array('Period' => $period, 'first_facility' => $facility_one_current, 'second_facility' => $facility_two_current);
        $returnable_prev = array('Period' => $period_prev, 'first_facility' => $facility_one_previous, 'second_facility' => $facility_two_previous);
        $returnable_prev1 = array('Period' => $period_prev1, 'first_facility' => $facility_one_previous1, 'second_facility' => $facility_two_previous1);

        $returnable_final = array('Current Month' => $returnable, 'Previous Month' => $returnable_prev, 'Two Months Ago' => $returnable_prev1);
        return $returnable_final;
    }

    public function compare_districts($dist1, $dist2, $month = null, $year = null) {

        if ($month == null) {
            $year = date('Y', time());
            $month = date('m', time());
        } else {
            $year = $year;
            $month = $month;
        }
        $current_month_year = $year . '-' . $month . '-01';
        $period = $month . $year;

        $month_prev = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));
        $month_prev = date('m', strtotime("$month_prev"));

        //echo "$month_prev";die();
        $year_prev = date('Y', strtotime("last month", strtotime($current_month_year)));
        $period_prev = $month_prev . $year_prev;
        $previous_month_year = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));

        $month_prev1 = date('m', strtotime("last month", strtotime($previous_month_year)));
        $year_prev1 = date('Y', strtotime("last month", strtotime($previous_month_year)));
        $period_prev1 = $month_prev1 . $year_prev1;

        $district_one_current = $this->district_totals($year, $month, $dist1);
        $district_one_previous = $this->district_totals($year_prev, $month_prev, $dist1);
        $district_one_previous1 = $this->district_totals($year_prev1, $month_prev1, $dist1);

        $district_two_current = $this->district_totals($year, $month, $dist2);
        $district_two_previous = $this->district_totals($year_prev, $month_prev, $dist2);
        $district_two_previous1 = $this->district_totals($year_prev1, $month_prev1, $dist2);

        $district_one_summary = $this->rtk_summary_district($dist1, $year, $month);
        $district_two_summary = $this->rtk_summary_district($dist2, $year, $month);

        $district_one_total_facilities = $district_one_summary['total_facilities'];
        $district_two_total_facilities = $district_two_summary['total_facilities'];

        $district_totals = array($district_one_total_facilities, $district_two_total_facilities);

        $returnable = array('Period' => $period, 'district_totals' => $district_totals, 'first_district' => $district_one_current, 'second_district' => $district_two_current);
        $returnable_prev = array('Period' => $period_prev, 'district_totals' => $district_totals, 'first_district' => $district_one_previous, 'second_district' => $district_two_previous);
        $returnable_prev1 = array('Period' => $period_prev1, 'district_totals' => $district_totals, 'first_district' => $district_one_previous1, 'second_district' => $district_two_previous1);

        $returnable_final = array('Current Month' => $returnable, 'Previous Month' => $returnable_prev, 'Two Months Ago' => $returnable_prev1);

        return $returnable_final;
    }

    public function compare_counties($county1, $county2, $month = null, $year = null) {
        if ($month == null) {
            $year = date('Y', time());
            $month = date('m', time());
        } else {
            $year = $year;
            $month = $month;
        }
        $current_month_year = $year . '-' . $month . '-01';
        $period = $month . $year;

        $month_prev = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));
        $month_prev = date('m', strtotime("$month_prev"));

        //echo "$month_prev";die();
        $year_prev = date('Y', strtotime("last month", strtotime($current_month_year)));
        $period_prev = $month_prev . $year_prev;
        $previous_month_year = date('Y-m-d', strtotime("last month", strtotime($current_month_year)));

        $month_prev1 = date('m', strtotime("last month", strtotime($previous_month_year)));
        $year_prev1 = date('Y', strtotime("last month", strtotime($previous_month_year)));
        $period_prev1 = $month_prev1 . $year_prev1;
        $period = $month . '' . $year;
        $county_one_current = $this->_requested_vs_allocated($year, $month, $county1);
        $county_one_previous = $this->_requested_vs_allocated($year_prev, $month_prev, $county1);
        $county_one_previous1 = $this->_requested_vs_allocated($year_prev1, $month_prev1, $county1);

        $county_two_current = $this->_requested_vs_allocated($year, $month, $county2);
        $county_two_previous = $this->_requested_vs_allocated($year_prev, $month_prev, $county2);
        $county_two_previous1 = $this->_requested_vs_allocated($year_prev1, $month_prev1, $county2);

        $districts_in_county1 = count(districts::getDistrict($county1));
        $districts_in_county2 = count(districts::getDistrict($county2));

        $county1_facilities = count($this->_facilities_in_county($county1));
        $county2_facilities = count($this->_facilities_in_county($county2));

        $total_districts = array($districts_in_county1, $districts_in_county2);
        $total_facilities = array($county1_facilities, $county2_facilities);


        $returnable = array('Period' => $period, 'district_totals' => $total_districts, 'facility_totals' => $total_facilities, 'first_county' => $county_one_current, 'second_county' => $county_two_current);
        $returnable_prev = array('Period' => $period_prev, 'district_totals' => $total_districts, 'facility_totals' => $total_facilities, 'first_county' => $county_one_previous, 'second_county' => $county_two_previous);
        $returnable_prev1 = array('Period' => $period_prev1, 'district_totals' => $total_districts, 'facility_totals' => $total_facilities, 'first_county' => $county_one_previous1, 'second_county' => $county_two_previous1);
        $returnable_final = array('Current Month' => $returnable, 'Previous Month' => $returnable_prev, 'Two Months Ago' => $returnable_prev1);

        //$stats = $this->_county_allocation_stats($county1);

        return $returnable_final;
    }

    public function allocations_district_view() {
        $data['title'] = '';
        $data['banner_text'] = 'Allocations by District';
        $data['content_view'] = 'allocation_committee/district_allocation';
        $tdata = '';
        $allocated_facilities = array();


        $allcounties = $this->db->query('SELECT county,id FROM  `counties` ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                array_push($allocated_facilities, $allocations_arr['facility_code']);

                # code...
                //                $facilities->num_rows() > 0)
            }
            $allocated_facilities = array_unique($allocated_facilities);
            $no_of_allocated_facilities = count($allocated_facilities);
            //          echo $no_of_allocated_facilities;
            //        echo "<pre>";                var_dump($allocated_facilities);echo "</pre>";
            //      exit;

            $num = $allocations->num_rows();
            if ($num > 1) {

                $tdata .= '<tr><td>' . $County . '</td><td>July</td><td>' . $no_of_allocated_facilities . '/413</td><td>' . $num . '</td><td><a href="allocations_county/' . $id . '">View</a> <!--<a onClick="downloadcounty(' . $id . ')">Download</a> --></td></tr>';
            }
        }

        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function allocations_facility_view() {
        $data['title'] = '';
        $data['banner_text'] = 'Allocations by Facility';
        $data['content_view'] = 'allocation_committee/facility_allocation';
        $tdata = '';
        $allocated_facilities = array();


        $allcounties = $this->db->query('SELECT county,id FROM  `counties` ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                array_push($allocated_facilities, $allocations_arr['facility_code']);

                # code...
                //                $facilities->num_rows() > 0)
            }
            $allocated_facilities = array_unique($allocated_facilities);
            $no_of_allocated_facilities = count($allocated_facilities);
            //          echo $no_of_allocated_facilities;
            //        echo "<pre>";                var_dump($allocated_facilities);echo "</pre>";
            //      exit;

            $num = $allocations->num_rows();
            if ($num > 1) {

                $tdata .= '<tr><td>' . $County . '</td><td>July</td><td>' . $no_of_allocated_facilities . '/413</td><td>' . $num . '</td><td><a href="allocations_county/' . $id . '">View</a> <!--<a onClick="downloadcounty(' . $id . ')">Download</a> --></td></tr>';
            }
        }

        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function allocations_zone_view() {
        $data['title'] = '';
        $data['banner_text'] = 'Allocations by Facility';
        $data['content_view'] = 'allocation_committee/facility_allocation';
        $tdata = '';
        $allocated_facilities = array();


        $allcounties = $this->db->query('SELECT county,id FROM  `counties` ');
        //        $counties_data = $allcounties->result_array();
        foreach ($allcounties->result_array() as $counties_data) {
            # code...
            $id = $counties_data['id'];
            $County = $counties_data['county'];
            $allocations = $this->db->query('SELECT * 
            FROM lab_commodity_details, counties, facilities, districts
            WHERE lab_commodity_details.facility_code = facilities.facility_code
            AND counties.id = districts.county
            AND counties.id =' . $id . '
            AND facilities.district = districts.id
            AND lab_commodity_details.allocated >0');
            foreach ($allocations->result_array() as $allocations_arr) {
                array_push($allocated_facilities, $allocations_arr['facility_code']);

                # code...
                //                $facilities->num_rows() > 0)
            }
            $allocated_facilities = array_unique($allocated_facilities);
            $no_of_allocated_facilities = count($allocated_facilities);
            //          echo $no_of_allocated_facilities;
            //        echo "<pre>";                var_dump($allocated_facilities);echo "</pre>";
            //      exit;

            $num = $allocations->num_rows();
            if ($num > 1) {

                $tdata .= '<tr><td>' . $County . '</td><td>July</td><td>' . $no_of_allocated_facilities . '/413</td><td>' . $num . '</td><td><a href="allocations_county/' . $id . '">View</a> <!--<a onClick="downloadcounty(' . $id . ')">Download</a> --></td></tr>';
            }
        }

        $data['tdata'] = $tdata;
        $this->load->view('rtk/template', $data);
    }

    public function rtk_facilities_not_reported($zone = NULL, $county = NULL, $district = NULL, $facility = NULL, $year = NULL, $month = NULL) {

        if (!isset($month)) {
            $month_text = date('mY', strtotime('-1 month'));
            $month = date('m', strtotime("-1 month", time()));
        }

        if (!isset($year)) {
            $year = substr($month_text, -4);
        }

        $firstdate = $year . '-' . $month . '-01';
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;

        $conditions = '';
        $conditions = (isset($zone)) ? "AND facilities.Zone = 'Zone $zone'" : '';
        $conditions = (isset($county)) ? $conditions . " AND counties.id = $county" : $conditions . ' ';
        $conditions = (isset($district)) ? $conditions . " AND districts.id = $district" : $conditions . ' ';
        $conditions = (isset($facility)) ? $conditions . " AND facilities.facility_code = $facility" : $conditions . ' ';

        $sql = "select distinct lab_commodity_orders.facility_code
    from lab_commodity_orders, facilities, districts, counties 
    where lab_commodity_orders.order_date between '$firstdate' and '$lastdate'
    and facilities.district=districts.id 
    and districts.county = counties.id
    and facilities.rtk_enabled='1'";

    //echo "$sql";die();

        $sql2 = "select facilities.facility_code
    from facilities, districts, counties 
    where facilities.district=districts.id
    $conditions
    and districts.county = counties.id
    and facilities.rtk_enabled='1'
    ";


        $res = $this->db->query($sql);
        $reported = $res->result_array();
        $res2 = $this->db->query($sql2);
        $all = $res2->result_array();


        $unreported = array();


        $new_all = array();
        $new_reported = array();

        foreach ($all AS $key => $value) {
            $new_all[] = $value['facility_code'];
        }
        foreach ($reported AS $key => $value) {
            $new_reported[] = $value['facility_code'];
        }
        sort($new_all);
        sort($new_reported);

        //$returnable = array_diff($new_all, $new_reported);
        $returnable = $this->flip_array_diff_key($new_all, $new_reported);

        foreach ($returnable as $value) {
            $sql3 = "select facilities.facility_code,facilities.facility_name, districts.district, counties.county,facilities.zone
        from facilities, districts, counties 
        where facilities.district=districts.id 
        and districts.county = counties.id
        and rtk_enabled='1'
        and facilities.facility_code = '$value'
        $conditions";
            $res3 = $this->db->query($sql3);
            $my_value = $res3->result_array();
            array_push($unreported, $my_value);
        }
        $report_for = $month . "-" . $year;



        foreach ($unreported AS $key => $value) {
            $new_unreported[] = $value[0];
        }
        foreach ($new_unreported as $key => $value) {
            $new_unreported[$key]['report_for'] = $report_for;
        }
        

        return $new_unreported;
    }

    function flip_array_diff_key($b, $a) {
        $at = array_flip($a);
        $bt = array_flip($b);
        $d = array_diff_key($bt, $at);
        return array_keys($d);
    }

    public function show_allocation_pending($month=null,$year=null) {
        $data['title'] = 'RTK Allocation';
        $data['banner_text'] = 'Pending Facilities for Allocations';
        $data['content_view'] = 'rtk/allocation_committee/allocation_pending_v';

        $pending_facility = $this->rtk_facilities_not_reported(NULL, NULL, NULL, NULL, NULL, NULL);
        $data['pending_facility'] = $pending_facility;
        $this->load->view('rtk/template', $data);
    }

    private function get_logs() {
        $sql = "select user.fname,user.lname,rtk_logs_reference.description,rtk_logs.timestamp from user,rtk_logs,rtk_logs_reference 
    where user.id = rtk_logs.user_id 
    and rtk_logs.reference = rtk_logs_reference.id 
    order by rtk_logs.timestamp desc";
        $res = $this->db->query($sql);
        $returnable = $res->result_array();
        return $returnable;
    }

    public function show_logs() {
        $data['title'] = 'RTK | Activity Logs';
        $data['banner_text'] = 'View Logs';
        $data['content_view'] = 'rtk/admin/logs_v';

        $logs_data = $this->get_logs();
        $data['logs_data'] = $logs_data;
        $this->load->view('rtk/template', $data);
    }

    function rtk_logs($user = NULL, $UserType = NULL, $Action = NULL, $SinceDate = NULL, $FromDate = NULL) {
        $conditions = '';
        $conditions = (isset($user)) ? $conditions . " AND user.id = $user" : $conditions . ' ';
        $conditions = (isset($Action)) ? $conditions . " AND rtk_logs_reference.action = $Action" : $conditions . ' ';
        $conditions = (isset($sincedate)) ? $conditions . "AND rtk_logs.timestamp > = $sincedate" : $conditions . ' ';
        $conditions = (isset($enddate)) ? $conditions . "AND rtk_logs.timestamp < = $enddate" : $conditions . ' ';

        $sql = "SELECT *
            FROM rtk_logs,rtk_logs_reference,user
            WHERE rtk_logs.reference = rtk_logs_reference.id
                AND rtk_logs.user_id = user.id
                $conditions
                ORDER BY `rtk_logs`.`id` DESC";
        $res = $this->db->query($sql);
        return ($res->result_array());
    }

    function reporting_rates($year = NULL, $month = NULL) {
        if ($year == NULL) {
            $year = date('Y', time());
            $month = date('m', time());
        }

        $firstdate = $year . '-' . $month . '-01';
        $month = date("m", strtotime("$firstdate"));
        $year = date("Y", strtotime("$firstdate"));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;
        $firstdate = $year . '-' . $month . '-01';

        $sql = "select 
                lab_commodity_orders.order_date as order_date,
                count(lab_commodity_orders.id) as count
            from
                lab_commodity_orders
            WHERE
                lab_commodity_orders.order_date between '$firstdate' and '$lastdate'
            Group BY lab_commodity_orders.order_date";
        $res = $this->db->query($sql);
//        echo"<pre>";print_r($res->result_array());die;
        return ($res->result_array());
    }

    function _national_reports_sum($year, $month) {

        $returnable = array();

        $firstdate = $year . '-' . $month . '-01';
        $firstday = date("Y-m-d", strtotime("$firstdate +1 Month "));

        $month = date("m", strtotime("$firstdate +1 Month "));
        $year = date("Y", strtotime("$firstdate +1 Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $lastdate = $year . '-' . $month . '-' . $num_days;
        $sql = "SELECT 
            counties.county,
            counties.id,
            lab_commodities.commodity_name,
            sum(lab_commodity_details.beginning_bal) as sum_opening,
            sum(lab_commodity_details.q_received) as sum_received,
            sum(lab_commodity_details.q_used) as sum_used,
            sum(lab_commodity_details.no_of_tests_done) as sum_tests,
            sum(lab_commodity_details.positive_adj) as sum_positive,
            sum(lab_commodity_details.negative_adj) as sum_negative,
            sum(lab_commodity_details.losses) as sum_losses,
            sum(lab_commodity_details.closing_stock) as sum_closing_bal,
            sum(lab_commodity_details.q_requested) as sum_requested,
            sum(lab_commodity_details.allocated) as sum_allocated,
            sum(lab_commodity_details.allocated) as sum_days,
            sum(lab_commodity_details.q_expiring) as sum_expiring
        FROM
            lab_commodities,
            lab_commodity_details,
            lab_commodity_orders,
            facilities,
            districts,
            counties
        WHERE
            lab_commodity_details.commodity_id = lab_commodities.id
                AND lab_commodity_orders.id = lab_commodity_details.order_id
                AND facilities.facility_code = lab_commodity_details.facility_code
                AND facilities.district = districts.id
                AND districts.county = counties.id
                AND lab_commodity_orders.order_date BETWEEN '$firstdate' AND '$lastdate'";

        $sql2 = $sql . " AND lab_commodities.id = 1 Group By counties.county";

        $res = $this->db->query($sql2);
        $result = $res->result_array();

        array_push($returnable, $result);

        $sql3 = $sql . " AND lab_commodities.id = 2 Group By counties.county";
        $res2 = $this->db->query($sql3);
        $result2 = $res2->result_array();
        array_push($returnable, $result2);

        $sql4 = $sql . " AND lab_commodities.id = 3 Group By counties.county";
        $res3 = $this->db->query($sql4);
        $result3 = $res3->result_array();
        array_push($returnable, $result3);
//        echo "<pre>";print_r($returnable);die;
//        echo($sql2);die;
        return $returnable;

        /*
          $res = $this->db->query($sql);
          return ($res->result_array());
         */
    }
   function user_details($user = NULL){
        $conditions = '';
        $conditions = (isset($user)) ? $conditions . " AND user.id = $user" : $conditions . ' ';

        $sql = "select * from user, access_level where user.usertype_id = access_level.id and access_level.id BETWEEN 7 AND  13 $conditions";
        $res = $this->db->query($sql);
        $returnable = $res->result_array();
        if ($res->num_rows()<1){ 
            echo "user does not exist";}
        else {
                $main_county = $this->db->query("select counties.id as county_id, counties.county from  counties, user where   user.county_id = counties.id AND user.id = $user");
                $user_county = $main_county->result_array();
                $rca_res = $this->db->query("select counties.id as county_id, counties.county from counties where counties.id in (select rca_county.county from rca_county where rca_county.rca = $user)");
                $other_counties = $rca_res->result_array();
                $counties = array_merge($user_county,$other_counties);       
                array_push($returnable, $counties);

                $main_dist = $this->db->query("select districts.id as district_id, districts.district  from  districts, user where  user.district = districts.id AND user.id = $user");
                $user_dist = $main_dist->result_array();
                $other_dist = $this->db->query("select districts.id as district_id, districts.district from districts where districts.id in (select dmlt_districts.district from dmlt_districts where dmlt_districts.dmlt = $user)");
                $other_districts = $other_dist->result_array();
                $districts = array_merge($user_dist,$other_districts);
                
                array_push($returnable, $districts);
                return $returnable;}

    }
    function user_profile($user_id){
        $user_details = $this->user_details($user_id);
//        echo "<pre>";print_r($user_details);die;
        $full_name = $arr[0]['fname'].' '.$user_details[0]['lname'];
        $data['all_counties'] = $this->all_counties();

        $data['user_logs'] = $this->rtk_logs($user_id);
        $data['full_name'] = $full_name;
        $data['user_details'] = $user_details;
        $data['title'] = 'User Profile : '.$full_name;
        $data['banner_text'] = 'User Profile : '.$full_name;
        $data['content_view'] = 'rtk/rtk/user_profile_view';

        $this->load->view('rtk/template',$data);

    }
    function all_counties(){
        $counties = $this->db ->query("select * from counties");
        return ($counties->result_array());
    }

public function allstats(){
    for ($i=1; $i <48 ; $i++) { 
 $this->summary_tab_display($i,2014,7);
}

}
}

?>
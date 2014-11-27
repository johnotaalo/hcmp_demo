<?php
class Users extends Doctrine_Record {
	/////
	public function setTableDefinition() {
		$this -> hasColumn('fname', 'varchar', 255);
		$this -> hasColumn('lname', 'varchar', 255);
		$this -> hasColumn('email', 'string', 255, array('unique' => 'true'));
		$this -> hasColumn('username', 'string', 255, array('unique' => 'true'));
		$this -> hasColumn('password', 'string', 255);
		$this -> hasColumn('activation', 'varchar', 255);
		$this -> hasColumn('usertype_id', 'integer', 11);
		$this -> hasColumn('telephone', 'varchar', 255);
		$this -> hasColumn('district', 'varchar', 255);
		$this -> hasColumn('facility', 'varchar', 255);
		$this -> hasColumn('status', 'int', 11);
		$this -> hasColumn('county_id', 'int', 11);
		$this -> hasColumn('partner', 'int', 11);
		$this -> hasColumn('email_recieve', 'int', 1);
		$this -> hasColumn('sms_recieve', 'int', 1);

	}

	public function setUp() {
		$this -> setTableName('user');
		$this -> actAs('Timestampable');
		$this -> hasMutator('password', '_encrypt_password');
		$this -> hasMany('Facilities as Codes', array('local' => 'facility', 'foreign' => 'facility_code'));
		$this -> hasMany('access_level as u_type', array('local' => 'usertype_id', 'foreign' => 'id'));
		$this -> hasMany('facilities as hosi', array('local' => 'facility', 'foreign' => 'facility_code'));
		$this -> hasOne('Facility_Issues as idid', array('local' => 'id', 'foreign' => 'issued_by'));

	}

	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this -> _set('password', md5($salt . $value));

	}

	public static function getUsers($facility_c){
		$query = Doctrine_Query::create() -> select("*") -> from("Users")->where("facility=$facility_c");
		$level = $query -> execute();
		return $level;
	}

	public static function login($username, $password) {

		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("username = '" . $username . "' AND status=1");

		$user = $query -> fetchOne();
		if ($user) {

			$user2 = new Users();
			$user2 -> password = $password;

			if ($user -> password == $user2 -> password) {
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	public static function getuserby_id($id) {
		$query = Doctrine_Query::create() -> select("fname") -> from("users") -> where("id='$id' ");
		$level = $query -> execute();
		return $level;
	}


	public static function get_user_names($id) {
		$query = Doctrine_Query::create() -> select("fname, lname") -> from("users") -> where("id='$id'");
		$names = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $names;
	}
	public static function get_user_info($facility_code) 
	{
		$query = Doctrine_Query::create() -> select("DISTINCT usertype_id, telephone,district, facility") -> from("users")->where("status='1' and  facility='$facility_code'");
		$info = $query -> execute();
		
		return $info;
	}
	public static function get_user_emails($facility_code) 
	{
		$query = Doctrine_Query::create() -> select("*") -> from("users")->where("status='1' and  facility='$facility_code' AND email_recieve = 1");
		$info = $query -> execute();
		
		return $info;
	}

	public static function check_user_exist($email) {
		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("email='$email' AND status IN(1,2)");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
	}
	public static function get_facility_admins($facility_code) 
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("facility = $facility_code AND usertype_id IN(2,5) AND status = 1");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
	}


	public static function reset_password($user_id, $new_password_confirm) {

		//$new_password_confirm;
		$salt = '#*seCrEt!@-*%';
		$value = md5($salt . $new_password_confirm);

		$update = Doctrine_Manager::getInstance() -> getCurrentConnection();
		$update -> execute("UPDATE user SET password='$value',status=1  WHERE id='$user_id' ; ");
	}

	public static function set_deactivate_for_recovery($user_id) {

		$update = Doctrine_Manager::getInstance() -> getCurrentConnection();

		$update -> execute("UPDATE user SET status=2  WHERE id='$user_id' ;");
	}
	
	public static function get_user_list_facility($facility) {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			SELECT u.id as user_id,u.fname,u.lname,u.email,u.username,u.telephone,d.id as district_id,d.district,c.id as county_id,c.county,f.facility_code,
				f.facility_name,f.owner,f.type,a.id as level_id,f.level,a.level,u.status FROM user u 
				LEFT JOIN districts d
				ON
				d.id=u.district
				RIGHT JOIN counties c
				ON
				c.id=d.county
				RIGHT JOIN facilities f
				ON
				u.facility=f.facility_code
				RIGHT JOIN access_level a
				ON
				a.id=u.usertype_id
				where f.facility_code=$facility
				and a.id != 3
				")
				;
		return $query;
	}

	public static function get_user_list_district($district) {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			SELECT u.id as user_id,u.fname,u.lname,u.email,u.username,u.telephone,d.id as district_id,d.district,c.id as county_id,c.county,f.facility_code,
				f.facility_name,f.owner,f.type,a.id as level_id,f.level,a.level,u.status FROM user u 
				LEFT JOIN districts d
				ON
				d.id=u.district
				RIGHT JOIN counties c
				ON
				c.id=d.county
				RIGHT JOIN facilities f
				ON
				u.facility=f.facility_code
				RIGHT JOIN access_level a
				ON
				a.id=u.usertype_id
				where u.district=$district
				and a.id != 3
				")
				;
		return $query;
	}

	public static function get_user_list_county($county) {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			SELECT u.id as user_id,u.fname,u.lname,u.email,u.username,u.telephone,d.id as district_id,d.district,c.id as county_id,c.county,f.facility_code,
				f.facility_name,f.owner,f.type,a.id as level_id,f.level,a.level,u.status FROM user u 
				LEFT JOIN districts d
				ON
				d.id=u.district
				RIGHT JOIN counties c
				ON
				c.id=d.county
				LEFT JOIN facilities f
				ON
				u.facility=f.facility_code
				RIGHT JOIN access_level a
				ON
				a.id=u.usertype_id
				where u.county_id=$county
				and a.id != 10
				");
		return $query;
	}
	
	public static function get_user_list_all() {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
				SELECT 
    u.id as user_id,
    u.fname,
    u.lname,
    u.email,
    u.username,
    u.telephone,
    d.id as district_id,
    d.district,
    c.id as county_id,
    c.county,
    f.facility_code,
    f.facility_name,
    f.owner,
    f.type,
    a.id as level_id,
    f.level,
    a.level,
    u.status,
    u.email_recieve,
    u.sms_recieve
FROM
   user u
        LEFT JOIN
    counties c ON c.id = u.county_id
        LEFT JOIN
    districts d ON d.id = u.district
        LEFT JOIN
    facilities f ON u.facility = f.facility_code
        LEFT JOIN
    access_level a ON a.id = u.usertype_id WHERE f.using_hcmp=1
				");
		return $query;
	}
	//////get the dpp details 
public static function get_dpp_details($distirct){
	$query = Doctrine_Query::create() -> select("*") -> from("users")->where("district=$distirct and usertype_id='3' ");
		$level = $query -> execute();
		return $level;
}
public static function get_dpp_emails($distirct){
	$query = Doctrine_Query::create() -> select("*") -> from("users")->where("district = $distirct and usertype_id='3' and email_recieve = 1");
		$level = $query -> execute();
		return $level;
}
public static function get_dpp_emails_county_level($county_id){
	$query = Doctrine_Query::create() -> select("*") -> from("users")->where("county_id = $county_id and usertype_id='3' and email_recieve = 1");
		$level = $query -> execute();
		return $level;
}
public static function get_county_emails($county_id){
	$query = Doctrine_Query::create() -> select("*") -> from("users")->where("county_id = $county_id and usertype_id='10' and email_recieve = 1 ");
		$level = $query -> execute();
		return $level;
}
	public static function get_users_district($district) {
		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			SELECT count(*) as count FROM user u 
				LEFT JOIN districts d
				ON
				d.id=u.district
				RIGHT JOIN counties c
				ON
				c.id=d.county
				RIGHT JOIN facilities f
				ON
				u.facility=f.facility_code
				RIGHT JOIN access_level a
				ON
				a.id=u.usertype_id
				where u.district=$district
				and a.id != 3
				group by status
				")
				;
		return $query;
	}
	public static function get_users_county($county) {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
			SELECT count(*) as count FROM user u 
				LEFT JOIN districts d
				ON
				d.id=u.district
				RIGHT JOIN counties c
				ON
				c.id=d.county
				LEFT JOIN facilities f
				ON
				u.facility=f.facility_code
				RIGHT JOIN access_level a
				ON
				a.id=u.usertype_id
				where u.county_id=$county
				and f.using_hcmp=1
				and a.id != 10
				Group by status
				");
		return $query;
	}
	
	public static function get_users_count() {

		$query = Doctrine_Query::create() -> select("count(*)") -> from("Users")  ->Where("usertype_id NOT IN(1,4,6,7,8,9,11,13,14,15)") -> groupBy("status");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
	}

	public static function get_facilities_list_all() {
		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		SELECT 
    f.id,
    f.facility_code,
    f.facility_name,
    f.district as district_id,
    f.partner,
    f.drawing_rights,
    f.owner,
    f.type,
    f.level,
    f.rtk_enabled,
    f.cd4_enabled,
    f.drawing_rights_balance,
    f.using_hcmp,
    f.date_of_activation,
    f.zone,
    f.contactperson,
    f.cellphone,
    f.targetted,
    d.id,
    d.district as district_name

	FROM
	   facilities f
	        LEFT JOIN
	    districts d ON d.id = f.district
	WHERE 
		f.district = d.id
				");
		return $query;
	}

	public static function get_facilities_list_all_active($status = null) {

		$query = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		SELECT 
    f.id,
    f.facility_code,
    f.facility_name,
    f.district as district_id,
    f.partner,
    f.drawing_rights,
    f.owner,
    f.type,
    f.level,
    f.rtk_enabled,
    f.cd4_enabled,
    f.drawing_rights_balance,
    f.using_hcmp,
    f.date_of_activation,
    f.zone,
    f.contactperson,
    f.cellphone,
    f.targetted,
    d.id,
    d.district as district_name

	FROM
	   facilities f
	        LEFT JOIN
	    districts d ON d.id = f.district
	WHERE 
		f.district = d.id
		AND 
		f.using_hcmp = $status
	ORDER BY
		f.date_of_activation desc
				");
		return $query;
	}

	public static function check_activation($cipher) {

		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("activation='$cipher'")->andWhere("status = 0");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
		
	}
	public static function check_user_exist_activate($email) {
		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("email='$email' AND status=0");
		$result = $query -> execute();
		return $result;
	}

	public static function get_users_active_in_facility($facility_code)
	{
		$query = Doctrine_Query::create() ->select("*") 
											->from("Users")
											->where("facility='$facility_code' and status = 1")
											->OrderBy("id asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	
  //////get the county details 
public static function get_county_details($county_id){
	$query = Doctrine_Query::create() -> select("*") -> from("users")->where("county_id=$county_id and usertype_id='10' ");
		$level = $query -> execute();
		return $level;
}



	
	public static function check_db_activation($phone,$code) {
		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("telephone='$phone' AND activation='$code' AND status=0");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
	}
	
	public static function check_if_email($test_email) {
		$query = Doctrine_Query::create() -> select("*") -> from("Users") -> where("username LIKE '%$test_email%'");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;
	}

	public static function deactivate_facility($facility_code,$status){
		if ($status == 0) {
			$stmt = 'using_hcmp = 1';
		}elseif ($status == 1) {
			$stmt = 'using_hcmp = 0';
		}

		//echo "UPDATE facilities SET $stmt ,date_of_activation = ".date("Y-m-d")." WHERE facility_code = '$facility_code' ";exit;
		$update = Doctrine_Manager::getInstance() -> getCurrentConnection();
		$update -> execute("UPDATE facilities SET $stmt ,date_of_activation = CURDATE() WHERE facility_code = '$facility_code' ");
		
		echo $update;
	}
	
	}

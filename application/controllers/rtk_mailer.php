<?php
ob_start();
class rtk_mailer extends MY_Controller {
 

public function send_email($email_address,$message,$subject,$attach_file=NULL,$bcc_email=NULL){
	
		$fromm='rtk.kenya@gmail.com';
		$messages=$message;

  		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'rtk.kenya@gmail.com';
        $config['smtp_pass']    = 'savelives';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not  
		$this->load->library('email', $config);

        $this->email->initialize($config);
		
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'RTK Kenya'); // change it to yours
  		$this->email->to($email_address); // change it to yours
  		
  		if(isset($bcc_email)){
		$this->email->bcc("billnguts@gmail.com,".$bcc_email);	
  		}else{
		$this->email->bcc('billnguts@gmail.com');	
  		}
		if (isset($attach_file)){
		$this->email->attach($attach_file); 	
		}
		else{
			
		}
  		
  		$this->email->subject($subject);
 		$this->email->message($messages);
 
  if($this->email->send())
 {
return TRUE;
 }
 else
{
 return show_error($this->email->print_debugger());
}



}
	
		

} 
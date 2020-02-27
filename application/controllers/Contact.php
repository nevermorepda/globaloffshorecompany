<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
		// $this->util->block_ip();
		$this->output->cache(CACHE_TIME);
		
		$tmpl_content = array();
		$tmpl_content['meta']['title'] = "Contact Us";
		$tmpl_content['tabindex']  = "contact";
		$tmpl_content['content']   = $this->load->view("contact", NULL, TRUE);
		$this->load->view('layout/main', $tmpl_content);
	}
	
	public function message()
	{
		if (!empty($_POST))
		{
			// Save
			$fullname = $this->util->value($this->input->post("fullname"), "");
			$services_title = $this->util->value($this->input->post("services_title"), "");
			$email = $this->util->value($this->input->post("email"), "");
			$phone = $this->util->value($this->input->post("phone"), "");
			$content = $this->util->value($this->input->post("message"), "");
			// $security_code = $this->util->value($this->input->post("security_code"), "");
			
			// if (strtoupper($security_code) == strtoupper($this->util->getSecurityCode()))
			// {
				// Inform by mail
				$tpl_data = array(
					"FULLNAME"	=> $fullname,
					"EMAIL"		=> $email,
					"PHONE"		=> $phone,
					"TITLE"		=> $services_title,
					"CONTENT"	=> $content,
				);
				
				$message = $this->mail_tpl->contac_apply($tpl_data);
				// $mail = array(
	   //          		"subject"		=> "[Contact] ".$fullname." - ''{$services_title}''",
				// 		"from_sender"	=> $email,
	   //          		"name_sender"	=> $fullname,
				// 		"to_receiver"   => MAIL_INFO, 
				// 		"message"       => $message
				// );
				// $this->mail->config($mail);
				// $this->mail->sendmail();

				$mail = array(
	            		"subject"		=> "[Contact] ".$fullname." - ''{$services_title}''",
						"from_sender"	=> $MAIL_INFO,
	            		"name_sender"	=> $fullname,
						"to_receiver"   => $email, 
						"message"       => $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail();
				
				$this->session->set_flashdata("success", "Your message has been sent successful.");
			// }
		}
		
		redirect("contact", "back");
	}
}

?>
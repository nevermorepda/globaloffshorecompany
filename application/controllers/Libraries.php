<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries extends CI_Controller {

	public function cron_send_mail_30d()
	{
		$info = new stdClass();
		$info->arrival_date = date('Y-m-d',strtotime("-2 days"));
		$info->status = 1;
		$bookings = $this->m_visa_booking->bookings($info);
		foreach ($bookings as $booking) {
			$subject = "Feedback for extra service - Vietnam-Visa.Org.Vn";
			$tpl_data = array(
				"FULLNAME"		=> $booking->contact_fullname,
			);
			if ((!empty($booking->car_pickup) && empty($booking->full_package)) || (!empty($booking->car_pickup) && empty($booking->fast_checkin))) {
				$message = $this->mail_tpl->feedback_car_service($tpl_data);
				$mail = array(
					"subject"		=> $subject,
					"from_sender"	=> MAIL_INFO,
					"name_sender"	=> SITE_NAME,
					"to_receiver"	=> $booking->primary_email,
					"message"		=> $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail('mia@vietnam-visa.org.vn', '2~DBDil9bVTURsrYPb');
			} else if (!empty($booking->full_package) || !empty($booking->fast_checkin)) {
				$message = $this->mail_tpl->feedback_fc_service($tpl_data);
				$mail = array(
					"subject"		=> $subject,
					"from_sender"	=> MAIL_INFO,
					"name_sender"	=> SITE_NAME,
					"to_receiver"	=> $booking->primary_email,
					"message"		=> $message
				);
				$this->mail->config($mail);
				$this->mail->sendmail('mia@vietnam-visa.org.vn', '2~DBDil9bVTURsrYPb');
			}
		}
	}
	public function get_jurisdiction () {
		$alias = $this->input->post('nation');
		$nation = $this->m_nation->load($alias);
		$info = new stdClass();
		$info->service_tab_id = 1;
		$region = $this->m_services_tab_nation->jion_nation($info);
		$tab_nation = $this->m_services_tab_nation->load_item($nation->id,1);
		echo json_encode(array($tab_nation,$nation,$region));
	}
}

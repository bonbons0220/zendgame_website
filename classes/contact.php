<?php
class contact extends page
{
	public $title = 'ZendGame Contact Us';
	public $pagename = 'contact';
	public $errorMessage = Array(
		'blank'=>"We're guessing you don't really want to send a blank message. Want to try again?");
	public $infoMessage = Array(
		'thanks'=>"Thanks for contacting us. We'll be in touch soon!");

	public function doAction() {
		switch ($this->data_action) {
		case "send":
			if ($this->contactZendgame()) {
				header("Location: ".$this->pagename.".html?message=thanks");
			} else {
				header("Location: ".$this->pagename.".html?error=blank");
			}
			break;	
		}
	}

	public function contactZendgame() 
	{
		//if at least one of name, email and text are filled in, send the email.
		if ((isset($this->data_name) && strlen($this->data_name)>0) ||
			(isset($this->data_email) && strlen($this->data_email)>0) ||
			(isset($this->data_comment) && strlen($this->data_comment)>0)) {
			
			$message = "Customer Name: " . $this->data_name . "\r\n" .
						"Customer Email: " . $this->data_email . "\r\n" .
						"Customer Comment: " . $this->data_comment . "\r\n";
			$subject = "Message from Website";
			$headers = "From: " . $this->zendFromEmail . "\r\n" .
						"Reply-To: " . $this->zendFromEmail . "\r\n";
			mail($this->zendToEmail,$subject,$message,$headers);
			$success=true;
		} else {
			//otherwise stay on page and show error
			$success=false;
		}
		return $success;
	}

}
?>
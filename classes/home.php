p<?php
class home extends page
{
	public $title = 'ZendGame Home';
	public $pagename = 'home';

	public function display_content() 
	{
		$this->display_intro();
	}

	public function display_intro() 
	{
		include_once($this->pagename."inc.php");
	}

}
?>
<?php
class home extends page
{
	public $title = 'ZendGame Home';
	public $pagename = 'home';

	public function displayContent() 
	{
		include_once($this->pagename."inc.php");
	}

}
?>
<?php
class home extends page
{
	public $title = 'ZendGame Home';
	public $pagename = 'home';

	public function displayContent() 
	{
		$this->displayWrapper("col3","intro");
		$this->displayWrapper("col4","services");
		$this->displayWrapper("col5","container");
	}
}
?>
<?php
class twocolumn extends page
{
	public $pagename;

	public function displayContent() 
	{
		$this->displayWrapper("col5","container");
	}
}
?>
<?php
class notfound extends page
{
	public $title = 'Zendgame is Confused';
	public $pagename = 'notfound';

	public function displayContent() 
	{
		include_once($this->pagename."inc.php");
	}

}
?>
<?php
class notfound extends page
{
	public $title = 'Page Not Found on zendgame.com';
	
	public function display_header() 
	{
		echo "<h1>lol wut?</h1>";
	}
	
	public function display_content() 
	{
	?>
	<div class="content">
	<img style="-webkit-user-select: none" src="http://media.tumblr.com/tumblr_mef13lLjfj1qjtpoz.gif">
	</div>
	<?php
	}

}
?>
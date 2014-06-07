<div id="topnav">
	<ul>
		<?php
		foreach ($this->topmenu as $key => $value) {
			$thisclass = (strpos($this->pagename,$value)===0) ? " class=\"active\"" : "" ;
			echo "<li $thisclass><a href=\"$value.html\">$key</a></li>\n";
		}
		?>
	</ul>
</div>
<!--div id="search">
  <form action="#" method="post">
	<fieldset>
	  <legend>Site Search</legend>
	  <input type="text" value="Search Zendgame&hellip;"  onfocus="this.value=(this.value=='Search Zendgame&hellip;')? '' : this.value ;" />
	  <input type="submit" name="go" id="go" value="Search" />
	</fieldset>
  </form>
</div-->

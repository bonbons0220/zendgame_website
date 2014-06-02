<?php
/*
PHP File: page.php
Description: Basic page class that other classes build upon.
Author: Bonnie Souter
Author URI: http://www.zendgame.com/
*/
class page
{
	//the basics vars that are only set in class:page
	public $debug=true;
	public $base_url = 'http://www.zendgame.com/';
	public $company = 'zendgame.com';
	public $email = 'bonnie@zendgame.com';
	public $phone = '(410)262-5245';

	//attributes that will probably be overridden in children
	public $title = 'ZendGame: Building Your Online Presence';
	public $content = "page content";
	public $keywords = "zendgame";
	public $topmenu = array('home'=>'home',
//							'blog'=>'blog',
//							'resume'=>'resume',
//							'example sites'=>'examples',
							'contact us'=>'contact');
	public $pagename = 'page';
	
	/****************************************************************/
	/* THE BASICS */
	/****************************************************************/
	public function __construct()
	{
		//$this->session = new session();
		//$this->user = new user();
	}
	
	public function __get($name)
	{
		return $this->$name;
	}

	public function __set($var,$value)
	{
		$this->$var = $value;
	}

	/****************************************************************/
	/* METHODS TO DISPLAY THE HEAD OF THE PAGE */
	/****************************************************************/
	public function display() 
	{
		$this->display_head();
		$this->display_body();
	}

	public function display_head() 
	{
		echo "<html>\n<head>\n";
		$this->display_title();
		$this->display_meta();
		$this->display_links();
		echo "</head>\n";
	}

	public function display_title() 
	{
		echo "<title>$this->title</title>";
	}

	public function display_meta() 
	{
		echo "<meta name=\"keywords\" content=\" ". $this->keywords . "\"/>\n";
		echo "<meta name=\"google-site-verification\" content=\"-aaNdx2nPpDRhp-gm-Jw1PY3wZP5wXCbQrAzugli94U\" />\n";
	}

	public function display_links() 
	{
		echo "<link rel=\"stylesheet\" href=\"/css/layout.css?v=1.3\" media=\"screen\"/>\n";
		echo "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"/js/core.js\" ></script>\n";
		echo "<link rel=\"icon\" href=\"/favicon.ico\" type=\"image/x-icon\"/>\n";
	}

	/****************************************************************/
	/* METHODS TO DISPLAY THE BODY OF THE PAGE */
	/****************************************************************/
	public function display_body() 
	{
		echo "<body id=\"top\">";
		$this->display_header();
		$this->display_topbar();
		$this->display_content();
		$this->display_footer();
		echo "</body></html>";
	}
	
	public function display_header() 
	{
		?>
		<div class="wrapper col1">
		<div id="header">
		<?php	
		$this->display_logo();
		$this->display_newsletter();
		?>
		<br class="clear" />
		</div>
		</div>
		<?php	
	}
	
	public function display_logo() 
	{
		?>
		<div id="logo">
		<h1><a href="#">Zendgame</a></h1>
		<p><strong>Building Your Online Presence</strong></p>	
		</div>
		<?php
	}
	
	public function display_newsletter() 
	{
		?>
		<!--div id="newsletter">
		  <p>Sign up to our newsletter for the latest news, updates and offers.</p>
		  <form action="#" method="post">
			<fieldset>
			  <legend>NewsLetter</legend>
			  <input type="text" value="Name&hellip;"  onfocus="this.value=(this.value=='Name&hellip;')? '' : this.value ;" />
			  <input type="text" value="Email&hellip;"  onfocus="this.value=(this.value=='Email&hellip;')? '' : this.value ;" />
			  <input type="submit" name="news_go" id="news_go" value="Sign Up" />
			</fieldset>
		  </form>
		</div-->
		<?php
	}
	
	public function display_topbar() 
	{
		?>
		<div class="wrapper col2">
		<div id="topbar">
		<?php
		$this->display_topmenu();
		//$this->display_search();
		?>
		</div>
		</div>
		<br class="clear" />
		<?php
	}
	
	public function display_search() 
	{
		?>
		<div id="search">
		  <form action="#" method="post">
			<fieldset>
			  <legend>Site Search</legend>
			  <input type="text" value="Search Zendgame&hellip;"  onfocus="this.value=(this.value=='Search Zendgame&hellip;')? '' : this.value ;" />
			  <input type="submit" name="go" id="go" value="Search" />
			</fieldset>
		  </form>
		</div>
		<?php
	}
	
	public function display_topmenu() 
	{
		?>
		<div id="topnav">
		<ul>
		<?php
		foreach ($this->topmenu as $key => $value) {
			$thisclass = (strpos($this->pagename,$value)===0) ? " class=\"active\"" : "" ;
			if (strpos($value,"contact")===0) {
				echo "<li $thisclass><a href=\"mailto:bonnie@zendgame.com\" target=\"_blank\">$key</a></li>\n";
			} else {
				echo "<li $thisclass><a href=\"$value.html\">$key</a></li>\n";
			}
		}
		?>
		</ul>
		</div>
		<?php
	}
	
	//generally overridden by other pages
	public function display_content() 
	{
		?>
		<div class="wrapper col5">
		  <div id="container">
			<div id="content">
		<?php
			$this->content = "<h2>Content</h2>";
			$this->content .= "<p>Description</p>";
		?>
			<br class="clear" />
			</div>
		  </div>
		</div>
		<?php
	}

	public function display_footer() 
	{
	?>
		<div class="wrapper col7">
		  <div id="copyright">
			<p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">zendgame.com</a></p>
			<p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
			<br class="clear" />
		  </div>
		</div>
		<?php
	}

	/****************************************************************/
	/* STATIC FUNCTIONS */
	/****************************************************************/
	static function getpage() {
		$trypage = isset($_GET['p']) ? $_GET['p'] : 'home';
		$trypage = filter_var(trim($trypage), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$trypage = filter_var($trypage, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		return $trypage;
	}
}
?>
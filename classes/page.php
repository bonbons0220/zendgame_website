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
	public $zendCompany = 'zendgame.com';
	public $zendToEmail = 'bonnie@zendgame.com';
	public $zendFromEmail = 'info@zendgame.com';
	public $zendPhone = '(410)262-5245';

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
	public $errorMessage = '';
	
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
		$this->displayHead();
		$this->displayBody();
	}

	public function displayHead() 
	{
		echo "<html>\n<head>\n";
		$this->displayTitle();
		$this->displayMeta();
		$this->displayLinks();
		echo "</head>\n";
	}

	public function displayTitle() 
	{
		echo "<title>$this->title</title>";
	}

	public function displayMeta() 
	{
		echo "<meta name=\"keywords\" content=\" ". $this->keywords . "\"/>\n";
		echo "<meta name=\"google-site-verification\" content=\"-aaNdx2nPpDRhp-gm-Jw1PY3wZP5wXCbQrAzugli94U\" />\n";
	}

	public function displayLinks() 
	{
		echo "<link rel=\"stylesheet\" href=\"/css/layout.css?v=1.3\" media=\"screen\"/>\n";
		echo "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"/js/core.js\" ></script>\n";
		echo "<link rel=\"icon\" href=\"/favicon.ico\" type=\"image/x-icon\"/>\n";
	}

	/****************************************************************/
	/* METHODS TO DISPLAY THE BODY OF THE PAGE */
	/****************************************************************/
	public function displayBody() 
	{
		echo "<body id=\"top\">";
		$this->displayHeader();
		$this->displayTopbar();
		$this->displayContent();
		$this->displayFooter();
		echo "</body></html>";
	}
	
	public function displayHeader() 
	{
		?>
		<div class="wrapper col1">
		<div id="header">
		<?php	
		$this->displayLogo();
		$this->displayNewsletter();
		?>
		<br class="clear" />
		</div>
		</div>
		<?php	
	}
	
	public function displayLogo() 
	{
		?>
		<div id="logo">
		<h1><a href=".">Zendgame</a></h1>
		<p><strong>Building Your Online Presence</strong></p>	
		</div>
		<?php
	}
	
	public function displayNewsletter() 
	{
		?>
		<div id="newsletter">
		  <p>Sign up to our newsletter for the latest news.</p>
		  <form action="http://zendgame.us8.list-manage.com/subscribe/post?u=c5e8db5cd2314dbcf36b1a7d1&amp;id=f0a1256bc7" 
		  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank"
		  novalidate autocomplete="off">
			<fieldset>
			  <legend>NewsLetter</legend>
			  <input type="text" name="FNAME" id="mce-FNAME" value="Name&hellip;"  onfocus="this.value=(this.value=='Name&hellip;')? '' : this.value ;" />
			  <input type="email" name="EMAIL" id="mce-EMAIL" value="Email&hellip;"  onfocus="this.value=(this.value=='Email&hellip;')? '' : this.value ;" />
				<div id="mce-responses" class="clear">
					<div class="response" id="mce-error-response" style="display:none"></div>
					<div class="response" id="mce-success-response" style="display:none"></div>
				</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
				<div style="position: absolute; left: -5000px;"><input type="text" name="b_c5e8db5cd2314dbcf36b1a7d1_f0a1256bc7" tabindex="-1" value="">
				</div>
				<div class="clear"><input type="submit" value="Sign Up" name="subscribe" id="news_go"></div>
			</fieldset>
			</form>
		</div>
		<?php
	}
	
	public function displayTopbar() 
	{
		?>
		<div class="wrapper col2">
		<div id="topbar">
		<?php
		$this->displayTopmenu();
		//$this->displaySearch();
		?>
		</div>
		</div>
		<br class="clear" />
		<?php
	}
	
	public function displayErrorMessage() 
	{
		if (isset($this->data_error) && strlen($this->data_error)>0) {
		?>
			<div class="error">
			<p><?php echo $this->errorMessage[$this->data_error]; ?></p>
			</div>
		<br class="clear" />
		<?php
		}
		if (isset($this->data_message) && strlen($this->data_message)>0) {
		?>
			<div class="info">
			<p><?php echo $this->infoMessage[$this->data_message]; ?></p>
			</div>
		<br class="clear" />
		<?php
		}
	}
	
	public function displaySearch() 
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
	
	public function displayTopmenu() 
	{
		?>
		<div id="topnav">
		<ul>
		<?php
		foreach ($this->topmenu as $key => $value) {
			$thisclass = (strpos($this->pagename,$value)===0) ? " class=\"active\"" : "" ;
			/*if (strpos($value,"contact")===0) {
				echo "<li $thisclass><a href=\"mailto:bonnie@zendgame.com\" target=\"_blank\">$key</a></li>\n";
			} else {
				echo "<li $thisclass><a href=\"$value.html\">$key</a></li>\n";
			}*/
			echo "<li $thisclass><a href=\"$value.html\">$key</a></li>\n";
		}
		?>
		</ul>
		</div>
		<?php
	}
	
	//generally overridden by other pages
	public function displayContent() 
	{
		?>
		<div class="wrapper col5">
		  <div id="container">
			<div id="content">
		<?php
			$this->displayErrorMessage();
			$this->content = "<h2>Content</h2>";
			$this->content .= "<p>Description</p>";
		?>
			<br class="clear" />
			</div>
		  </div>
		</div>
		<?php
	}

	public function displayFooter() 
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

	public function doAction() {
		echo "<!-- no actions for this page -->";
		return;
	}

	public function getPostVars() {
		foreach ($_POST as $key=>$value) {
			$varname = "data_".$key;
			$this->$varname = $value;
		}
		foreach ($_GET as $key=>$value) {
			$varname = "data_".$key;
			$this->$varname = $value;
		}
	}

	/****************************************************************/
	/* STATIC FUNCTIONS */
	/****************************************************************/
	static function getPage() {
		$trypage = isset($_GET['p']) ? $_GET['p'] : 'home';
		$trypage = filter_var(trim($trypage), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$trypage = filter_var($trypage, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		return $trypage;
	}

}
?>
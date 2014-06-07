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
		?>
		<link rel="stylesheet" href="/css/layout.css?v=1.3" media="screen"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
		<script type="text/javascript" src="/js/core.js" ></script>
		<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-51728750-1', 'zendgame.com');
		  ga('send', 'pageview');
		</script>
		<?php
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
		$this->displayWrapper("col1","header","header.php");
	}
	
	public function displayTopbar() 
	{
		$this->displayWrapper("col2","topbar","topbar.php");
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
	
	//generally overridden by other pages
	public function displayContent() 
	{
		$this->displayWrapper("col5","container");
	}

	public function displayFooter() 
	{
		$this->displayWrapper("col6","footer","footer.php");
		$this->displayWrapper("col7","copyright","copyright.php");
	}

	public function displayWrapper($col,$id,$fname=FALSE) 
	{
		$fname=($fname===FALSE)?'./pages/'.$this->pagename.$col.".php":'./pages/'.$fname;
		if (file_exists($fname)) {
			?>
			<div class="wrapper <?php echo $col; ?>">
				<div id="<?php echo $id; ?>">
				<?php include($fname);?>
				<br class="clear" />
				</div>
			</div>
			<?php
		} else {
			echo "<!-- could not find $fname -->\n";
		}
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
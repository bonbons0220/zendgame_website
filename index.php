<?php 
//Autoload all classes
function MyAutoload($name)
{
  include_once $name.".php";
}
spl_autoload_register('MyAutoload');

//Start or continue session
$session = new session();

//Show appropriate page
$tryPage = page::getPage();

//if page not found, page = notfound
$page = (class_exists($tryPage,TRUE)) ? new $tryPage() : new notfound(); 

$page->getPostVars();	
if (isset($page->data_action)) {
	$page->doAction();
} else {
	$page->display();
}
?>


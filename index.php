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
$trypage = page::getpage();
$page = new $trypage();
$page->display();
?>


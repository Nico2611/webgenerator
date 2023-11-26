<?php 

	shell_exec('zip -r "'.$_GET["web"].'.zip" "./'.$_GET["web"].'"');
	header('location: '.$_GET["web"].'.zip');

 ?>
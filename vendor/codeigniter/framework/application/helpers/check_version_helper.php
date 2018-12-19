<?php 
	
function check_version(){
  $version_path = 'version.txt';		
  return file_exists($version_path) && VERSION == file_get_contents($version_path);	

}
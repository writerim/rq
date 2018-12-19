<?php 
	
function show_version(){
  $version_path = 'version.txt';		
  return file_get_contents($version_path);	

}

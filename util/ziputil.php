<?php 
namespace Util;

class ZipUtil{

	//zipcontentpath
	function unzipContent($zip_path){
		$dest_path = "app/resources/assets";

		$zip = new ZipArchive;
		if ($zip->open($zip_path) === true) 
		{
        	 copy($zip_path,$dest_path);
    	}                   
    $zip->close();    
	}

}
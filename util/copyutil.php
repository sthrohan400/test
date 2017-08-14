<?php
namespace Util;

class CopyUtil {
	

function zipAndCopy($zip_path,$dest){

    $zip = new \ZipArchive;
        if ($zip->open($zip_path) === true) 
        {
            if($this->checkFolderExist($dest))
                $zip->extractTo($dest);
        }                   
    $zip->close();
}

function createLayout($dest,$src){
    if(!$this->checkFolderExist($dest)){
       if($this->createFolder($dest))
                if($this->createFiles($src,$dest))
                        return true;
    }

    
}
public function createDashboard($dest){
    if(!$this->checkFolderExist($dest)){
                if($this->createFolder($dest, 0755)){
                        $dash_file = fopen($dest."/dashboard.blade.php", "w") or die("Unable to open file!");
                        fwrite($dash_file, 'test');
                    }

    }
}
public function createFiles($src,$dest){
       return  $this->XXcopy($src,$dest);
}
public function checkFileExist($fname) {
            if (file_exists($fname)) {
               echo "\"".$fname."\" already existed".PHP_EOL;
               return true;
            }
            return false;
        }
public function checkFolderExist($path) {
            if (file_exists($path)) {
                return true;
            }
            return false;
        }


function createFolder($dest,$permissions = 0755){
    return mkdir($dest, $permissions, true);
}

function XXcopy($source, $dest, $permissions = 0755)
{
   
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions, true);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        $this->XXcopy("$source/$entry", "$dest/$entry", $permissions);
    }

    // Clean up
    $dir->close();
    return true;
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                $this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
}
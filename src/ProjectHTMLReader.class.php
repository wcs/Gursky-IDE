<?php

/**
 * Gurski IDE Directory Reader class
 *
 * @author Doglas A. Dembogurski Feix
 */
 

class ProjectHTMLReader {

    public $path = "";

    function __contruct(){
      // $var = htmlDirList("../projects/");
    }


    /**
    * Return a list of all files within a directory
    *
    * @param string $directory The directory to search
    * @param bool $recursive Go through child directories as well
    * @return array
    */
    function dirList($directory, $recursive = true){
        // create an array to hold directory list
        $results = array();
        
        // create a handler for the directory
        $handler = opendir($directory);
        // keep going until all files in directory have been read
        while (false !== ($file = readdir($handler)))    {
            // if $file isn't this directory or its parent,
            // add it to the results array

            if ($file != '.' && $file != '..' && $file != '.svn'){
                // if the file is a directory
                // add contents of that directory
                 
                if(is_dir($directory.DIRECTORY_SEPARATOR.$file) && $recursive === true) {
                    $results[] = array($file => $this->dirList($directory.DIRECTORY_SEPARATOR.$file));
                    arsort($results);
                } else  {
                    $results[] = $file;  
                }
            }
        }

        // tidy up: close the handler
        closedir($handler);

        // done!
        return $results;

    }
 
     function htmlFolderList($directory, $fileTypes = null, $recursive = true, $listClassName = null, $displayName = null){
        // defaults (if null)
        // restrict by fileTypes
        $fileTypes = (is_null($fileTypes) ? array("*") : $fileTypes);
        // the class name to apply to the <ul>
        $listClassName = (is_null($listClassName) ? "documents" : $listClassName);
        // set a default function for displayName
        $displayName = (is_null($displayName) ? create_function('$fileName,$extension', 'return str_replace("_", " ", $fileName);') : $displayName);

        // get list of files / folders
        $list = $this->dirList($directory, $recursive);

        // use an array for building up the string
        $results = array();
        // create the list
        $results[] = '<ul>';
        foreach ( $list as $value )   {
            // is a folder
            if(is_array($value)){
                $this->path =  $this->path."$value";
                $name = $displayName(key($value),"");
                $results[] = "<li id='$name' > <span class='text'  style='font-size:12px';> ".$displayName(key($value),"")."</span>".$this->htmlFolderList($directory.DIRECTORY_SEPARATOR.key($value), $fileTypes, $recursive, $listClassName, $displayName)." </li>";
            }  else {
                // the extension is after the last "."
                $extension = strtolower(array_pop(explode(".", $value)));
                // the file name is before the last "."
                //$fileName = array_shift(explode(".", $value));
                $fileName =   $value ;
                // continue to next item if not one of the desired file types
                if(!in_array("*", $fileTypes) && !in_array($extension, $fileTypes)) continue;
                // add the list item
                // $name = $displayName(key($value),"");
                $ext = 'doc';
                $replaced = eregi_replace ( "[/,\,.]", "_", $fileName );
                // $results[] = "<li style='background-image:url(../images/php.gif); background-repeat:no-repeat;' id='$fileName.$extension'> <span class='text' style='font-size:12px'; >$fileName.$extension </span></li>";
                $results[] = "<li id='$fileName' name='$replaced' onmouseout=fo('$replaced')  > <span class='text' style='font-size:12px'; >$fileName </span> <span id='$replaced' class='file_context_menu' style='display:none' >&nbsp; &nbsp;&nbsp;</span> </li>";
 
            }
        }
        $results[] = "</ul>";
        //arsort($results);
        // return the results as a string
        return implode("", $results);


    }

}
?>


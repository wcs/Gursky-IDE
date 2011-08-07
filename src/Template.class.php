<?php
require_once("Y_Template.class.php");

/**
 * Description  Template to obtain Templates of diferents file types.
 * Date 12-08-2009
 * @author Doglas A. Dembogurski Feix
 */
class Template {
    public $t = null;

    function __construct(){
        $this->t = new Y_Template("Template.tpl.php");
        $this->t->Show("header");
    }
    function getPHP_file_tpl_converted(){
        $this->t->Show("getPHP_file_tpl_converted");
    }
    function getPHP_class_tpl_converted(){
        $this->t->Show("getPHP_class_tpl_converted");
    }
    function getPHP_web_page_tpl_converted(){
        $this->t->Show("getPHP_web_page_tpl_converted");
    }
    function getJS_tpl_converted(){
        $this->t->Show("getJS_tpl_converted");
    }
    function getHTML_tpl_converted(){
        $this->t->Show("getHTML_tpl_converted");
    }
    function getCSS_tpl_converted(){
        $this->t->Show("getCSS_tpl_converted");
    }
    function getEmptyFile_tpl_converted(){
        $this->t->Show("getEmptyFile_tpl_converted");
    }


    //  here function for real code templates
    function getPHP_file_tpl($username = '', $filename = '' ){
        $date = date("F j, Y, g:i a");
        $code = "<?php
/**
*  File: $filename
*  @autor: $username 
*  Date:  $date
*  Description of $filename
*/
?>


<?php
     // Your php code here...

?>
";
        return $code;
    }

    
    function getPHP_class_tpl($username = '', $filename = ''){
        $date = date("F j, Y, g:i a");
        $short = str_ireplace('.php', '', $filename);

        $code = "<?php
/**
*  File: $filename
*  @autor: $username
*  Date:  $date
*  Description of $filename Class
*/

class  $short  {

     function __construct(){
      // Your php code here...
     }


}

?>
";
        return $code;
    }
    function getPHP_web_page_tpl($username = '', $filename = ''){
       $code = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
</head>
   <body>
    <?php
      // put your code here...
    ?>
   </body>
</html>';
       return $code;
    }
    function getJS_tpl($username = '', $filename = ''){
       return "";
    }
    function getHTML_tpl($username = '', $filename = ''){
       $code = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
</head>
   <body>
      TODO write content 
   </body>
</html>';
       return $code;
    }
    function getCSS_tpl($username = '', $filename = ''){
      $date = date("F j, Y, g:i a");
      $code = "
/**
*  File: $filename
*  @autor: $username 
*  Date:  $date
*  Description of $filename
*/

/*
   TODO customize this generated css
   Syntax recommendation http://www.w3.org/TR/REC-CSS2/
*/

root {
   display: block;
}   ";
       return $code;
    }
    function getEmptyFile_tpl($username = '', $filename = ''){
       return "";
    }


    function getTPL_converted($file_type){ 
        switch($file_type){
            case 'PHPFile.php': $this->getPHP_file_tpl_converted();;
                break;
            case 'PHPFile.class.php': $this->getPHP_class_tpl_converted();;
                break;
            case 'PHP_web_page.php': $this->getPHP_web_page_tpl_converted();;
                break;
            case 'Empty_file.js': $this->getJS_tpl_converted();;
                break;
            case 'Empty_file.html': $this->getHTML_tpl_converted();;
                break;
            case 'Empty_file.css': $this->getCSS_tpl_converted();;
                break;
            case 'empty_file': $this->getEmptyFile_tpl_converted();;
                break;
            default : break;
            }
        }

        function getTPL($file_type,$username = '', $filename = ''){
            switch($file_type){
                case 'PHPFile.php': return $this->getPHP_file_tpl($username , $filename);;
                    break;
                case 'PHPFile.class.php':return $this->getPHP_class_tpl($username, $filename );;
                    break;
                case 'PHP_web_page.php':return $this->getPHP_web_page_tpl($username, $filename);;
                    break;
                case 'Empty_file.js': return $this->getJS_tpl($username  , $filename );;
                    break;
                case 'Empty_file.html': return $this->getHTML_tpl($username, $filename);;
                    break;
                case 'Empty_file.css': return $this->getCSS_tpl($username, $filename);;
                    break;
                case 'empty_file':return $this->getEmptyFile_tpl($username, $filename );;
                    break;
                default : break;
                }
            }
            
           //Functions to get HTML Elements

           function getTableCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getTableCreator");
           }
           function getOrderedListCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getOrderedListCreator");
           }
           function getUnorderedListCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getUnorderedListCreator");
           }
           function getImageCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getImageCreator");
           }   
           function getLinkCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getLinkCreator");
           }
           function getMetaCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getMetaCreator");
           }
           function getFormCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getFormCreator");
           }
           function getTextInputCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getTextInputCreator");
           }
           function getMultilineCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getMultilineCreator");
           }
           function getDropdownCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getDropdownCreator");
           }
           function getCheckCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getCheckCreator");
           }
           function getRadioCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getRadioCreator");
           }
           function getFileCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getFileCreator");
           }
           function getButtonCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getButtonCreator");
           }
           function getCanvasCreator(){
             $this->t->Show("insert_code_function");
             $this->t->Show("getCanvasCreator");
           }
}
?>















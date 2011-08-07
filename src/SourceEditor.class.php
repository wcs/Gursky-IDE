<?php
/*
----------------------------------------------------------
| SourceEditor        Gurski IDE Editor Launcher        	|
|-----------------------------------------------------------|
|															|
| @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
| @date		Aug, 21 of 2009		     						|
| 															|
|															|
 ----------------------------------------------------------

Copyright (c) 2009 Doglas A. Dembogurski <dembogurski@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/
require_once("Y_Template.class.php");
require_once("DB.class.php");

/**
 * Description of SourceEditorclass
 * Date  17-08-2009
 * @author Doglas A. Dembogurski Feix
 */
class SourceEditor {

    public $t = null;

    function __construct(){
        $this->t = new Y_Template("SourceEditor.tpl.php");
    }
    function getIP() {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
                return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
            } else {
                return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
            }
        }
    }

    function show($user_id ,$session_id ,$project,$file){
        // Check if the file is not locked by other User
        // and lock the  file
        $cadena = trim($file);
        $fullpath = "../projects/$project$cadena";
        $minpath = "$project$cadena";

        $hash_code = md5($fullpath);
        // Create Session for this file


        if (!file_exists($fullpath)) {
             $this->t->Set("error","The file $file not exist...");
             $this->t->Show("display_error");
             return;
        }

        if (!file_exists($fullpath)) {
             $this->t->Set("error","The file $file not exist...");
             $this->t->Show("display_error");
             return;
        }
        if (!is_readable($fullpath)) {
            $this->t->Set("error","The file $file is not readable...");
            $this->t->Show("display_error");
            return;
        }


        $content = file_get_contents($fullpath);
        $this->t->Set("src_id",$hash_code);

        $var = explode('/', $cadena);
        $cant =  count($var);
        $last = $var[$cant -1] ;
        $replaced_file = eregi_replace ( "[/,\,.]", "_", $last );
        $this->t->Set("popup",  $replaced_file  );

        // Correction of bugs
        // 0) </textarea> problem
        //$code0 = str_replace("</textarea>", "&lt;/textarea&gt;",  trim($content));
        $code0 = str_replace("</textarea>", "&lt;/textarea&gt;",  $content );
        $code1 = str_replace("<", "&lt;",  $code0);
		
        $this->t->Set("code", $code1 );


        $editor = eregi_replace ( "[/,\,.]", "_", $minpath );

        $config = 'path: "editor/js/",
                           autoMatchParens: true,
                           continuousScanning: 500,
                           saveFunction: save_current_file,
                           cursorActivity :autocompleteManagement,
                           initCallback: initCallback,
						   lineNumbers: true,
						   height: "",
						   textWrapping: false,
						   tabMode: "spaces",';  //indent or , "default", "shift"

        // Check for file types
        $ext = $this->getFileExtension($file);
        if($ext ==='.png' || $ext ==='.jpg' || $ext === '.bmp' ||$ext === '.gif' || $ext ==='.ico' || $ext ==='.tiff'  ){
            $this->t->Set("filename", $file );
            $this->t->Set("image_name", $fullpath );
            $this->t->Show("show_image");
        }else{
            $this->t->Show("create_textarea");
            // Load for distinct file types
            if( ($ext ===  '.sql') || ($ext ===   '.SQL' )  ){        // SQL file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["../contrib/sql/js/parsesql.js" ],
                            stylesheet: ["editor/contrib/sql/css/sqlcolors.css" ],

                             '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.lua') || ($ext ===   '.LUA' )  ){    // Lua file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["../contrib/lua/js/parselua.js" ],
                            stylesheet: ["editor/contrib/lua/css/luacolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.py') || ($ext ===   '.PY' )  ){     // Python file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["../contrib/python/js/parsepython.js" ],
                            stylesheet: ["editor/contrib/python/css/pythoncolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.css') || ($ext ===   '.CSS' )  ){     // css file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["parsecss.js" ],
                            stylesheet: ["editor/css/csscolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.js') || ($ext ===   '.JS' )  ){  // Javascript file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["tokenizejavascript.js", "parsejavascript.js" ],
                            stylesheet: ["editor/css/jscolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.xml') || ($ext ===   '.XML' )  ){  // XML file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["parsexml.js" ],
                            stylesheet: ["editor/css/xmlcolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if( ($ext ===  '.sparql') || ($ext ===   '.SPARQL' ) || ($ext ===  '.rdf') || ($ext ===   '.RDF' ) ){  // SPARQL file or RDF file
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["tokenizejavascript.js", "parsesparql.js" ],
                            stylesheet: ["editor/css/sparqlcolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else if(  $ext ===  '.java'  ){  // Java file
                echo '<script type="text/javascript">  
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["../contrib/java/js/tokenizejava.js",
                                        "../contrib/java/js/parsejava.js"],
                            stylesheet: ["editor/contrib/java/css/javacolors.css" ],
                            '.$config.'
                          });
                        </script>';
            }else{ // Mixed Mode  Javascript php HTML css
                echo '<script type="text/javascript">
                          var '.$editor.' = CodeMirror.fromTextArea("src_code_'.$hash_code.'",   {
                            parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
                                         "../contrib/php/js/tokenizephp.js",
                                         "../contrib/php/js/parsephp.js",
                                         "../contrib/php/js/parsephphtmlmixed.js"],
                            stylesheet: ["editor/css/xmlcolors.css",
                                         "editor/css/jscolors.css",
                                         "editor/css/csscolors.css",
                                         "editor/contrib/php/css/phpcolors.css" ],

                             '.$config.'
                          });
                        </script>';
            }

        }
       //@todo:  Insert into sessiones de archivos
       $db = new Y_DB();
       $db->Query("insert into  sesiones_archivos(id_sesion, id_usuario, hash_code, session_id,fecha)values(default,$user_id, '$hash_code', '$session_id', current_timestamp)");
    }

    function closeFile($user_id,$session_id,$project,$file){
        $cadena = trim($file);
        $fullpath = "../projects/$project$cadena";
        $hash_code = md5($fullpath);
        $db = new Y_DB();
        $db->Query("delete from sesiones_archivos where session_id = '$session_id' and hash_code = '$hash_code';");
        echo "File Closed.";
    }

    // function to get file extension
    function getFileExtension($filename){
        $file = strtolower($filename);
        return substr($file, strrpos($file,'.'));
    }

}

?>

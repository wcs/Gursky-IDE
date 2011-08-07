<?php

/*
  ---------------------------------------------------------
 | Y_template.class.php    Class for template objects      |
 |---------------------------------------------------------|
 | @author   Sergio A. Pohlmann <spohlmann@ycube.net>   |
 | @date     december, 29 of 2002                          |
 | @updated	 may, 17 of 2009
 |---------------------------------------------------------|
 | Instance variables:                                     |
 | -------------------                                     |
 |  $this->Language  An array with the priority languages  |
 |                                                         |
 | Instance Methods:                                       |
 | -----------------                                       |
 | Set ( string $var, any $value )                         |
 |          Attrib a $value to a $var                      |
 | Show ( string $ident )                                  |
 |          Prints in HTML the "ident" block               |
 |                                                         |
 | Internal Methods:                                       |
 | -----------------                                       |
 | Y_Template ( $file )                                    |
 |          A constructor of the class                     |
  ---------------------------------------------------------
*/

/**
 * Y_Tpl ()
 *
 *
 */

class Y_Template {


    /**
     *  Constructor
     *  ===========
     */
       
    function Y_Template ( $file="" ) {

        // Internacionalization - to work with milti languages

        // Probing if a system is configurated

        if ( ! defined( "Y_LANGUAGE_1") ) {
            define("Y_LANGUAGE_1","br");  // First Priority language
            define("Y_LANGUAGE_2","es");  // Second priotity language
            define("Y_LANGUAGE_3","en");  // Third priority language
        }

        $this->file=$file;  // file of template
               
        // Check if the variable is defines and the file exist
        if (empty( $this->file )) {
            die("Not defined file to template");
        }
        else {
		        if ( !file_exists( $this->file ) ) {
			          die("File $this->file do not exist!");
            }
        }
        
        // Making an work array
	      $arr = file ( $this->file );
	
	      // Preparing a tags and a contens array
	      $c=0;                   // a single counter
	      $noeval=false;          // to not evaluate tags
	      $tag="0";               // a name of a current tag
	      $this->t_contents[$tag]=""; // only defines a empty content
	
	      
	      while ( $c<= count($arr) ) {
		  
			// Check if a comment start with spaces
			if( strtolower(strpos( $arr[$c], "begin:" ))>0 ){
				$arr[$c]=ltrim($arr[$c]);
			}
			if( strtolower(strpos( $arr[$c], "end:" ))>0 ){
				$arr[$c]=ltrim($arr[$c]);
			}
            $line = explode(" ", $arr[$c] );
            
            // Check if start a new block
	          if (($line[0] == "<!--") and (strtolower($line[1]) == "begin:")){
	              $tag = $line[2];  // The name of the block
	              
	              // If exist a "noeval" command, to template
	              // don't evaluate this block
	            if ( strtolower($line[3]) == "noeval" ) {
	                  $noeval=true;
	                  $this->t_contents[$tag] = "\n";
                }
				
                // If the template must evaluate this block
	              else {
	                  $noeval=false;
	                  $this->t_contents[$tag] = " ";
                }
				
            }
            // Inside of the block
            else {
                 // if is the end of tag
 	              if (( $line[0] == "<!--" ) and
                    ( strtolower($line[1]) == "end:")){
                    $tag = "0"; // and the actual tag
 	              }
 	              // Line to evaluate or not
 	              else {
 	                // Line not evaluated
 	                if ( $noeval ) {
 	                      $this->t_contents[$tag] .= $arr[$c];
                  	}
                    // Evaluating a line and put this in an array
                    else {
			        	$temp = str_replace ("{", "{\$"."this->",$arr[$c] );
//			            $temp=addslashes($temp);
						if( trim($temp) != "" ){
				            $this->t_contents[$tag] .= $temp;
						}	
					}
 	              }
            }
            $c++;
	      }
    }
    
    // end constructor Y_Tpl() ................................................
    
    
    /**
     *  Set function - To set a value in a variable
     *  ===========================================
     *
     *  Parameters: string $var    - The variable name
     *              any    $value  - The content of the variable
     *
     *  Example: T->Set( name, "Peter" );
     *
     */
     
    function Set ( $var, $value="" ) {
	      $this->$var=$value;
		  $html = "HTML_" . $var;
		  $this->$html=htmlspecialchars($value);
    }
    
    // end Set() ..............................................................
      
    /**
     *  Show function - To show a template
     *  ==================================
     *
     *  Parameters: string $ident     - A tag to read and parse
     */
     
     function Show ( $ident="0" ) {
         if ( $ident == "0" ) {
             $this->t_contents[0] = ""; // Reset a "0" content
             $x="";
             foreach ( $this->t_contents as $temp ) {
                 $temp = addslashes ( $temp );
                 eval ( "\$x= \"$temp\";") ;
        	     if( trim( $x,"\x00..\x1F") != "" ){
    	         	echo $x;
	             }
             }
         }
         else {
         
             // Internationalization check - define a new name of the block
             // if exist a block with the priority language

             $found = false;
             $lang_ident = $ident . "." . Y_LANGUAGE_1;
             if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
                 $ident = $lang_ident;
                 $found = true;
             }
             $lang_ident = $ident . "." . Y_LANGUAGE_2;
             if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
                 $ident = $lang_ident;
                 $found = true;
             }
             $lang_ident = $ident . "." . Y_LANGUAGE_3;
             if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
                 $ident = $lang_ident;
                 $found = true;
             }
         

             // Not interpret a block
             if ( substr( $this->t_contents[$ident], 0 , 1) != " " ) {
                 $x = $this->t_contents[$ident];
             }
             
             // Evaluate and interpret the block
             else {
                 $temp = addslashes ( $this->t_contents[$ident] );
                 eval( "\$x= \"$temp\";");
             }
             if( trim( $x,"\x00..\x1F") != "" ){
             	echo $x;
             }
         }
     }
     
     // end Show() ............................................................
     

    /**
     *  LanguageVariables - Define the variables to a selected language
     *  ===============================================================
     *
     */

     function LanguageVariables ( $ident="language" ) {

         //Check if the variables has not defined before
         if ( defined( "DEF_LANG_" )) {
             return;
         }

         // Internationalization check - define a new name of the block
         // if exist a block with the priority language
         $found = false;
         $lang_ident = $ident . "." . Y_LANGUAGE_1;
         if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
             $ident = $lang_ident;
             $found = true;
         }
         $lang_ident = $ident . "." . Y_LANGUAGE_2;
         if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
             $ident = $lang_ident;
             $found = true;
         }
         $lang_ident = $ident . "." . Y_LANGUAGE_3;
         if ( (! $found) and ( isset($this->t_contents[$lang_ident]))) {
             $ident = $lang_ident;
             $found = true;
         }

         // Removes a comment tags
         $temp = $this->t_contents[$ident] ;
         $temp = str_replace( "<!--", "", $temp);
         $temp = str_replace( "-->", "", $temp);
         
         // Evaluate the block
         eval( "$temp" . ";");
    }

    // end LanguageVariables() ................................................

}

// end Y_Tpl ..................................................................

?>

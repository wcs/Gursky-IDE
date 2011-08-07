<?php

require_once("Config.class.php");
require_once("Logger.class.php");
/*
  ---------------------------------------------------------
 | Y_DB_MySQL.class.php    Abstration for MySQL engine     |
 |---------------------------------------------------------|
 | @author   Sergio A. Pohlmann <spohlmann@softhome.net>   |
 | @date     february, 26 of 2003                          |
 |---------------------------------------------------------|
 | Instance variables:                                     |
 | -------------------                                     |
 | $this->Host         is a Hostname to connect            |
 | $this->Database     a Database name                     |
 | $this->User         user name                           |
 | $this->Password     a user password                     |
 | $this->Link_ID      Connection Status                   |
 | $this->ID_Query     Query Status                        |
 | $this->Record       Query Result                        |
 | $this->Row          Row number                          |
 | $this->Errno        Error number                        |
 | $this->Error        Error name                          |
 |                                                         |
 | Instance Methods:                                       |
 | -----------------                                       |
 | Connect()     Makes a connection with the database      |
 |                                                         |
 | Database()    Returns a Database Name                   |
 |                                                         |
 | Query( string sql)                                      |
 |               Makes a query with a sql string           |
 |                                                         |
 | Halt ( string message )                                 |
 |               Halt the system and print a message       |
 |                                                         |
 | NextRecord()  Returns a next record                     |
 |                                                         |
 | Seek( string var )                                      |
 |               Makes a seek search with a var            |
 |                                                         |
 | AffectedRows()                                          |
 |               Returns a number of query affected rows   |
 |                                                         |
 | NumRows()     Returns a number os query rows            |
 |                                                         |
 | Begin()       Start a transactional sequence            |
 |                                                         |
 | Commit()      Ends a transactional sequence and save    |
 |                                                         |
 | Rollback()    Ends a transactional without save         |
 |                                                         |
 | Close()       Close a connection                        |
 |                                                         |
 | Internal Methods:                                       |
 | -----------------                                       |
 | none                                                    |
  ---------------------------------------------------------

  ---------------------------------------------------------
 | Note:                                                   |
 |       - This file is extended for a "Y_DB" class        |
 |                                                         |
  ---------------------------------------------------------

  CHANGELOG
  
  2003 Abr 19 - Inserted a Close() method
  2003 Feb 26 - Complete and tested a fisrt version
  2005 Dic 04 - Inserted a Rollback() method

*/

class Y_DB_MySQL {

     
     
     
    /**
     *  Constructor
     *  ===========
     */
    
     function Y_DB_MySQL (){
     
            $this->Host     = "";              // Hostname
            $this->Database = "";              // Database
            $this->User     = "";              // User
            $this->Password = "";              // Passwd
            $this->Link_ID  = 0;               // Connect Status
            $this->ID_Query = 0;               // Query Status
            $this->Record   = array();         // Query Result
            $this->Row;                        // Row number
            $this->Errno    = 0;               // Error number
            $this->Error    = "";              // Error name
            $this->NoLog    = 0;               // No log a ROLLBACK
            
    } 
    
    
    /**
     *  Connect - Make a main connection
     *  ================================
     */
    function Connect() {

        for( $conn=0; $conn<10; $conn++ ){
            $this->Link_ID = mysql_connect(  $this->Host, $this->User, $this->Password );
            if( $this->Link_ID ){
                break;
            }
            $this->Wait(10);
        }
        if( !$this->Link_ID ){
            $this->Halt( "Cannot connect");
        }
       if ( !mysql_select_db( $this->Database )) {
// 15          $this->Halt( "Cannot use Database ".$this->Database );
       }
//        $this->Query("SELECT '".$this->Link_ID." - ".$this->User." - ".$this->Password."';");		
        return;

      }

    /** 
     *  Wait - Waits for a number of cycles
     *  ===================================
     *
     */
    
    function Wait( $time ) {
        for( $i=0; $i<$time; $i++){
            $nn=$i*2;
        }
    } // Wait() ------------------------------------------------------------


    /**
     *  Halt - Stop the system and print an error message
     *  =================================================
     *
     */

    function Halt( $msg ) {
    
        global $Global;
        // New Error control
         
        
        // Modified by Douglas Log the errors, do not show erros to user.
        $l = new Logger();
        $l->writeErrorLog("`_RPC_error_`" . $this->Errno . "`" . $this->Error ."`" . $msg );

        if($this->Errno === 1044){
          echo  "Opps! An error ocurred. <br> Access denied for this user to database <br> Make sure the configuration file is correct";
        }else{
          echo  "Opps! An error ocurred. <br>";
        }
  
        $this->NoLog = 1;

        $Global['SQL_Status'] = "ER";
        $this->log( $Global['username'], 'SQL ' .
                    $this->Errno . " - " . $this->Error , $Global['SQL_Status'], $msg );
        
        
    }

 
    
    
    /**
     *  Query - Makes a query with a $Qry string
     *  ========================================
     */

    function Query( $Qry ) {
        if (empty($Qry)) {  
           $l = new Logger();
       	   $l->writeErrorLog("SQL! Query is null ",__FILE__,__LINE__); 
        }
        global $Global;
        if( !$this->Database ){
        	$this->Database = $Global['project'];
        }
        if ( !$this->Link_ID ) {
            $this->Connect();   // Makes a connection
        }
//      $Global['SQL_Status'] = "ER"; 
        $this->ID_Query=mysql_query( $Qry, $this->Link_ID );
        $this->Row = 0;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();


        if (!$this->ID_Query) {
            if( $this->NoLog == 0 ) {
                $this->Halt( "Invalid query: " . $Qry );
            }
            else{
                $this->NoLog = 0;
            }
        }else{
            //$Global['SQL_Status'] = "OK"; 
        }
        $this->Log( $Qry );
        return $this->ID_Query;
    }

    

    /**
     *  Log - Makes a log of a query string
     *  ========================================
     */

    function Log( $Qry ) { 
      // ##### 16 - LOG Control
        if ( $this->MakeLog ) {
            $c = new Config(); 
            $desc = fopen( $c->getSQLLogFile(), "a" );
            fputs( $desc, $Qry . "\n" );
            fclose( $desc );
        }

	}
    


    /**
     *  NextRecord - Next Record
     *  ========================
     */
    function NextRecord() {
        $this->Record=mysql_fetch_array( $this->ID_Query );
        $this->Row +=1;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        $stat = is_array($this->Record);
        if (!$stat) {
            mysql_free_result($this->ID_Query);
            $this->ID_Query=0;
        }
        return $stat;
    }



    /**
     *  Seek - return a row to a $pos data
     *  ==================================
     */
    function Seek( $pos ) {
        $status=mysql_data_seek($this->ID_Query, $pos);
        if ($status) {
            $this->Row = $pos;
        }
        return;
    }



   
    /**
     *  AffectedRows - A number of affected rows
     *  ========================================
     */
    function AffectedRows() {
      try{
         $rows =  mysql_affected_rows( $this->ID_Query );
	 return $rows; 
      }catch(Exception  $e){  
          return 0; 
      } 	 
    }




    /**
     *  NumRows - Return a number of rows of a query result
     *  ===================================================
     */
    function NumRows() {
     try{
	    $rows = mysql_num_rows( $this->ID_Query );
	     return $rows; 
       }catch(Exception  $e){  
          return 0; 
       } 
    }




    /**
     *  Begin - Begins a transactional sequence
     *  =======================================
     */
    function Begin() {
		
        $this->Query("START TRANSACTION;");
        return true;
    }
 



    /**
     *  Commit - Write a transactional sequence
     *  ========================================
     */
    function Commit() {
        $this->Query("COMMIT;");
// # 167		
//        $this->Query("SET AUTOCOMMIT=1;");	
		
		return true;
    }


    /**
     *  Rollback - Cancel a transactional sequence
     *  ========================================
     */
    function Rollback() {
        $this->Query("ROLLBACK;");
		
// # 167		
//       $this->Query("SET AUTOCOMMIT=1;");	
		
		
		$this->Close();
        return true;
    }




    /**
     *  Close - Close a connection
     *  ==========================
     */
 
    function Close() {
//        $this->Query("COMMIT;");

// # 167		
//        $this->Query("SET AUTOCOMMIT=1;");	
        return mysql_close( $this->Link_ID ) ;
    }


}


 
?>

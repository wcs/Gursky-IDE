<?php
 
/**
* ----------------------------------------------------------
* | Gurski IDE Logger  Class - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jan, 04 of 2009		     						|
* | 															|
* |															|
*  ----------------------------------------------------------

* Copyright (c) 2009 Doglas A. Dembogurski <dembogurski@gmail.com>

* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.

* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*
*/
require_once('Config.class.php');

class Logger {

    function __construct(){}

    public function writeLog($_String) {
        $_config = new Config();
        $path = $_config->getLogFile();
         
        $gestor = fopen($path, "a");
        // Asegurarse primero de que el archivo existe y puede escribirse sobre el.
        if (is_writable($path)) {
            if (!$gestor = fopen($path, 'a')) {
                exit;
            } 
            // Escribir $_String a nuestro arcivo abierto.
            $diaHora = date("d-m-Y, H:i:s"); 
            $concat = "[".$diaHora."] >>  ".$_String."\n";
            if (fwrite($gestor, $concat) === FALSE) {
                exit;
            }
            fflush($gestor);
            fclose($gestor);
        }
    }
 
    public function writeErrorLog($_StringErrLog) {
        $_config = new Config();
        $path = $_config->getErrorLogFile();
         
        
        $gestor = fopen($path, "a");
        // Asegurarse primero de que el archivo existe y puede escribirse sobre el.
        if (is_writable($path)) {
            if (!$gestor = fopen($path, 'a')) {
                exit;
            }
            // Escribir $_StringErrLog a nuestro arcivo abierto.
            $diaHora = date("d-m-Y, H:i:s"); 
                        
            $concat = "[".$diaHora."] >> ".$_StringErrLog."\n\n\n";
            if (fwrite($gestor, $concat) === FALSE) {
                exit;
            }
            fflush($gestor);
            fclose($gestor);
        } 
    }
    function insertSQLLog($username, $log){
        require_once('Y_DB.class.php');
        $db = new Y_DB();
        $db->Query("select id_usuario from usuarios where nick = '$username'");
        $id = 0;
        if($db->NumRows() > 0 ){
             $db->NextRecord();
             $id = $db->Record['id_usuario'];
        }  
        $db->Query("insert into logs(id_log,id_usuario, nick, fecha, log)
         values(default,$id , '$username', CURRENT_TIMESTAMP, '$log');");
    }
}
?>

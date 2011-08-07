<?php
 

/**
* ----------------------------------------------------------
* | Preferences  Class - Gurski IDE                               |
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Dec, 22 of 2009		     						|
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

require_once("Y_DB.class.php");
require_once("Y_Template.class.php");

class Preferences  {
    function __construct(){ }

    function loadPreferences($user_id){
        $db = new Y_DB();
        $db->Query("select clave, valor from preferencias where id_usuario = $user_id;");

        $t = new Y_Template("Preferences.tpl.php");
        $t->Show("header");
        while($db->NextRecord()){
           $clave = $db->Record['clave'];
           $valor = $db->Record['valor'];
           $t->Set("clave",$clave);
           $t->Set("valor",$valor);
           $t->Show("key_value");
        }
        $t->Show("footer");
    }

    function userPreferences($user_id){
        $db = new Y_DB();
        $db->Query("select clave, valor from preferencias where id_usuario = $user_id;");

        $t = new Y_Template("Preferences.tpl.php");

        $t->Show("ui_header");
        while($db->NextRecord()){
           $clave = $db->Record['clave'];
           $valor = $db->Record['valor'];
           $t->Set("key",$clave);
           $t->Set("value",$valor);
           $t->Show("ui_kv");
        }
        $t->Show("ui_footer"); 

    }
}
?>

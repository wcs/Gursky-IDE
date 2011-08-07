<?php
/**
* ----------------------------------------------------------
* | NorthPanel  Class - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		May, 24 of 2009		     						|
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
require_once("Y_Template.class.php");
require_once("Y_DB.class.php");

class NorthPanel  {

    function __construct($user_id=0){
        $t = new Y_Template("NorthPanel.tpl.php"); 
        $db = new Y_DB();
        $db->Query("select lower(ISO_Code) as iso, p.pais, u.nick, u.id_usuario from paises p, usuarios u where u.pais = p.pais and u.id_usuario = '$user_id'; ");
        $db->NextRecord();
        $flag = $db->Record['iso'];
        $flag_name = $db->Record['pais'];
        $nick = $db->Record['nick'];
        $ID = $db->Record['id_usuario'];

        $t->Set("flag", $flag);
        $t->Set("username", $nick);
        $t->Set("user_title", "User: ".$nick." ID: ".$ID);
        $t->Set("flag_name", $flag_name);
        $t->Show("north_container_header");
        $t->Show("north_container_body");
    }
}

?>

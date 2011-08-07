<?php

require_once("Y_Template.class.php");
require_once("Y_DB.class.php");

/**
* ----------------------------------------------------------
* | SouthPanel  Class - Gurski IDE		|
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
class SouthPanel  {

    function __construct($user_id=0){
        $t = new Y_Template("SouthPanel.tpl.php");
        $db = new Y_DB();
        $db->Query("select  nick  from  usuarios   where  id_usuario = '$user_id'; ");
        $db->NextRecord();
        $nick = $db->Record['nick'];
        $t->Set("nick", $nick);
        $t->Show("south_container_header"); 
    }
}

?>
<?php

/**
* ----------------------------------------------------------
* | WestPanel  Class - Gurski IDE		|
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
require_once("Projects.class.php");

class WestPanel {

    function __construct($user_id=0){
   	  $t = new Y_Template("WestPanel.tpl.php");
      $t->Show("west_container_header");

      $t->Show("tabs");
  
       $t->Show("projects_header");

       // projects tree
       //$t->Show("projects_tree");
       $p = new Projects($user_id);
       $p->showProjects();

       $t->Show("projects_footer");
       
       $t->Show("files");
       $t->Show("west_container_footer");
       $t->Show("decorator_script");

    }
}
?>

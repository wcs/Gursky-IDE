<?php
 
/**
* ----------------------------------------------------------
* | MainContainer  Class - Gurski IDE                               |
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Aug, 10 of 2009		     						|
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
require_once("NorthPanel.class.php");
require_once("WestPanel.class.php");
require_once("EastPanel.class.php");
require_once("SouthPanel.class.php");
require_once("CenterPanel.class.php");

/**
 * Class contain all Panels North, East, West, Center and South Panels
 *
 */

class MainContainer {
    public $t = null;
    function __construct(){
        $this->t = new Y_Template("MainContainer.tpl.php");
    }

    function showHeader($user_id){
        $session_id = md5(uniqid(microtime()).$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
        $this->t->Set("user_id",$user_id);
        $this->t->Set("session_id",$session_id);
        $this->t->Show("header");
    }
    function showBody($user_id, $session_id){
        $north  = new NorthPanel($user_id);
        $west   = new WestPanel($user_id);
        $east   = new EastPanel($user_id);
        $south  = new SouthPanel($user_id);
        $center = new CenterPanel($user_id);
        $this->t->Set("user_id",$user_id);
        $this->t->Set("session_id",$session_id);
        $this->t->Show("main_container");
    }
}
?>

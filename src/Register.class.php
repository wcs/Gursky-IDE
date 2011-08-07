<?php

require_once("Y_Template.class.php");
require_once("Y_DB.class.php");
 
/**
* ----------------------------------------------------------
* | Register  Class - Gurski IDE		|
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
class Register {

    function __construct(){
       $t = new Y_Template("Register.tpl.php");
       $tl = new Y_Template("Login.tpl.php");

       $t->Show('header');
       $tl->Set("login_url","../index.php");
       $tl->Set("login_link","Home");
       $tl->Show("loginform");
       $t->Show('body');
       $t->Show('countryc');
       $db = new Y_DB();
       $db->Query("select pais from paises");
       while($db->NextRecord()){
            $t->Set('country',$db->Record['pais']);
            $t->Show('countrydata');
       }
       $t->Set('country','Paraguay');
       $t->Show('countrydata');
       $t->Set('country','Paraguay');
       $t->Show('countrydata');
       $t->Set('country','Brasil');
       $t->Show('countrydata');
       $t->Set('country','Argentina');
       $t->Show('countrydata');

       $t->Show('countrye'); 
       $t->Show('states');
       $t->Show('bdc');

       // Set Days
       $t->Show('daysc');
       for($i = 1;$i < 32;$i++){
           $d = $i;
           if($i < 10 ){
               $d = '0'.$i;
           }
           $t->Set('day',"$d"); //for
           $t->Show('daysdata');
       }
       $t->Show('dayse');

       $t->Show('months');
       
       $t->Show('yearc');
       $anio = date("Y");
       for($i = 1940;$i < $anio - 6;$i++){
           $t->Set('year',"$i"); //for
           $t->Show('yeardata');
       }
       $t->Show('yeare');
       
       $t->Show('bde');
       $t->Show('last');
    } 
}
?>

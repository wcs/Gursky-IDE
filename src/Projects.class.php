<?php


/**
 * Description of Projectsclass
 * Date  19-06-2009
 * @author Doglas A. Dembogurski Feix
 *
 */

/**
* ----------------------------------------------------------
* | Projects  Class - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		May, 19 of 2009		     						|
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
require_once("ProjectHTMLReader.class.php");

class Projects {
    public $user_id = 0;
    public $t = null;

    function __construct($user_id){
       $this->user_id= $user_id;
       $this->t = new Y_Template("Projects.tpl.php");
    }
    
    function showProjects(){
        
        $db = new Y_DB();
        $db->Query("select up.id_proyecto as ID, p.nombre as NOMBRE,up.rol as ROL  from usuarios_x_proyecto up, proyectos p where p.id_proyecto=up.id_proyecto and up.estado = 'Activo' and p.estado='Activo' and up.id_usuario = $this->user_id ORDER BY NOMBRE ASC;");

        if( $db->NumRows() > 0 ){
                $this->t->Show("ul");
                while($db->NextRecord()){  // Extract All projects for this user
                   $ID = $db->Record['ID'];
                   $ROL = $db->Record['ROL'];
                   $nombre = $db->Record['NOMBRE'];
                   $this->t->Set("pr_id","$ID");
                   $this->t->Set("pr_name","$nombre");
                   $this->t->Show("menu_events");
                   if($ROL==='PL'){ // User can delete this project
                     $this->t->Set('show_delete','<div id="delete_project" text="Delete Project" img="../images/menu/default/delete.png"> </div>');
                     $this->t->Set('show_membership','<div id="membership" text="Mempbership" img="../images/membership.png"> </div>');
                   }else{
                     $this->t->Set('show_delete','');
                     $this->t->Set('show_membership','');
                   }
                   $this->t->Show("liul_project");
                }
                $this->t->Show("/ul");
                // option to create new projects
                $this->t->Show("new_project");

        }else{
            $this->t->Show("project_exist","");
            $this->newProject();
        } 
        
    }
    function newProject(){
        $this->t->Show("project_exist","No Projects");
        $this->t->Show("new_project");
    }
    function properties($project_name){  
        $this->t->Set("proj_name", $project_name);
        $db = new Y_DB();
        $db->Query("select srv_host, srv_main_path, srv_port, index_file from proyectos where nombre = '$project_name'");
        $db->NextRecord();
        $srv_host = $db->Record['srv_host'];
        $srv_main_path = $db->Record['srv_main_path'];
        $srv_port = $db->Record['srv_port'];
        $index_file = $db->Record['index_file'];

        $this->t->Set("host", $srv_host );
        $this->t->Set("host_main_path", $srv_main_path );
        $this->t->Set("port", $srv_port );
        $this->t->Set("index", $index_file );

        $this->t->Show("properties");
        $this->t->Show("update_script");
    }


}
?>

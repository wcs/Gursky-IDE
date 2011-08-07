<?php

/**
* ----------------------------------------------------------
* | NewFile  Class - Gurski IDE                               |
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jul, 06 of 2009		     						|
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
include_once("ProjectHTMLReader.class.php");
include_once("Logger.class.php");

class NewFile {

    public $user_id = 0;
    public $t = null;


    function __construct(){
        $this->t = new Y_Template("NewFile.tpl.php");
    }
    function showFolderFilesContent($user_id,$current_project){
        if($user_id != null){
            if ($current_project === 'null'){
                $this->t->Show("reload_window");
                $p = new Y_Template("Projects.tpl.php");
                $db = new Y_DB();
                $db->Query("select up.id_proyecto as ID, p.nombre as NOMBRE  from usuarios_x_proyecto up, proyectos p where p.id_proyecto=up.id_proyecto and up.estado = 'Activo' and up.id_usuario = $user_id;");

                $this->t->Show("table_header");

                if( $db->NumRows() > 0 ){
                    $p->Show("ul");
                    while($db->NextRecord()){  // Extract All projects for this user
                        $ID = $db->Record['ID'];
                        $nombre = $db->Record['NOMBRE'];
                        $p->Set("user_id","$user_id");
                        $p->Set("pr_name","$nombre");
                        $p->Show("liul_project_add_file");
                    }
                    $p->Show("/ul");

                    $this->t->Show("table_footer");
                }else{
                    echo "No projects found!!! To create a project goto menu File --> New Project";
                }

            }else{
                $reader = new ProjectHTMLReader();
                $list = $reader->htmlFolderList("../projects/$current_project/",array(""),true,null,null);

                $this->t->Set("current_project",$current_project);
                $this->t->Set("user_id",$user_id);
                $this->t->Show("new_file_window_header");
                $this->t->Set("tree",$list);
                $this->t->Show("tree_header");
                $this->t->Show("tree_footer");

                $this->t->Show("rows");
                $this->t->Show("new_file_window_footer");
                $this->t->Show("script_decorator");
            }
        }
    }
    function showFoldersTree($user_id,$current_project){
        $reader = new ProjectHTMLReader();
        $list = $reader->htmlFolderList("../projects/$current_project/",array(""),true,null,null);

        $this->t->Set("current_project_name",$current_project);
        $this->t->Set("user_id",$user_id);
        $this->t->Show("new_file_window_header");
        $this->t->Set("tree",$list);
        $this->t->Show("tree_header");
        $this->t->Show("tree_footer");
        $this->t->Show("vault_script");
        $this->t->Show("vault");
        $this->t->Show("new_file_window_footer");
        $this->t->Show("script_decorator");
    }

    function reloadFolders($project){
        $reader = new ProjectHTMLReader();
        $list = $reader->htmlFolderList("../projects/$project/",array(""),true,null,null);
        // $this->t->Set("tree",$list);
        echo "<span>&nbsp;</span>".$list;
        $this->t->Show("script_decorator");
    }

    function createNewFile(){
        $project = $_POST['project'];
        $ruta = $_POST['path'];
        $filename = $_POST['filename'];
        $file_type = $_POST['file_type'];
        $user_id = $_POST['user_id'];
        $permited_files = array(
        '.txt'=>'Permited','.php'=>'Permited','.html'=>'Permited','.xml'=>'Permited','.js'=>'Permited',
        '.py'=>'Permited','.lua'=>'Permited','.sql'=>'Permited','.css'=>'Permited','.rdf'=>'Permited',
        '.log'=>'Permited','.properties'=>'Permited','.yml'=>'Permited','.json'=>'Permited','.java'=>'Permited'
        );
        $ext0 = strtolower($filename);
        $ext   = substr($ext0, strrpos($ext0,'.'));
        if($permited_files[$ext]!='Permited'){
            echo "<label class='msgredsmall'>Files extention [".$ext."] not permited...  </label>";
            return;
        }

        $db = new Y_DB();
        $db->Query("select nick, nombre, apellido, concat(nombre,' ',apellido) as fullname from usuarios where id_usuario = $user_id;");
        $db->NextRecord();
        $fulname= $db->Record['fullname'];
        $nick = $db->Record['nick'];

        require_once("Template.class.php");
        $t = new Template();

        $contenido = $t->getTPL($file_type, $fulname, $filename);

        $fullpath = "../projects/$project$ruta$filename";
        if(!file_exists($fullpath)){
            $gestor = fopen($fullpath, "a");
            if ($gestor){
                if (fwrite($gestor, $contenido) === FALSE) {
                    echo "<label class='msgredsmall'>Can't write to file [$project$ruta$filename]</label>";
                }else{
                    /* $db->Query("select p.id_proyecto as ID from proyectos p, usuarios_x_proyecto u where p.nombre = '$project' and p.id_proyecto = u.id_proyecto and u.id_usuario = $user_id;");
                    $db->NextRecord();
                    $id= $db->Record['ID'];

                    $db->Query("insert into archivos
                        (id_archivo, id_proyecto,hash_code, path, id_version_actual, id_release_actual, cargar_inicio,estado)
                        values
                        ('$filename', '$id',md5('$fullpath') ,'$fullpath', 1, 0, 'false','Libre')");*/
                      $logger = new Logger();
                      $logger->insertSQLLog($nick,"User: $nick  create file [ $project$ruta$filename ] ");
                    

                    echo "<label class='msggrensmall'>File [$project$ruta$filename] was created succesfull</label>";
                    return;
                }
            }else{
                echo "<label class='msgredsmall'>Can't create file [$project$ruta$filename]</label>";
            }
        }else{
            echo "<label class='msgredsmall'>File [$project$ruta$filename] already exist...</label>";
        }

    }
}

?>

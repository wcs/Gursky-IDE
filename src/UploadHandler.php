<?php
require_once("DB.class.php");

$id  = $_GET['sessionId'];
$path = $_REQUEST['path'];
$project = $_REQUEST['project'];
$user_id = $_REQUEST['user_id'];

$id = trim($id);

session_name($id);
session_start();
$inputName = $_GET['userfile'];
$fileName  = $_FILES[$inputName]['name'];


$fullpath = "../projects/$project$path$fileName";
$short_path = "../projects/$project$path";


$tempLoc   = $_FILES[$inputName]['tmp_name'];
echo $_FILES[$inputName]['error'];
$target_path = $short_path;
$target_path = $target_path . basename($fileName);
if(move_uploaded_file($tempLoc,$target_path)){
    $_SESSION['value'] = -1;
}

$db = new y_DB();
$db->Query("select p.id_proyecto as ID from proyectos p, usuarios_x_proyecto u where p.nombre = '$project' and p.id_proyecto = u.id_proyecto and u.id_usuario = $user_id;");
$db->NextRecord();
$ida = $db->Record['ID'];
$db->Query("insert into archivos
              (id_archivo, id_proyecto,hash_code, path, id_version_actual, id_release_actual, cargar_inicio,estado,usuario)
               values('$fileName', '$ida',md5('$fullpath') ,'$fullpath', 1, 0, 'false','Libre','')");
?>












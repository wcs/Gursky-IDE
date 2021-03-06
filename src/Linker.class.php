<?php
/**
* ----------------------------------------------------------
* | Linker		Linker Class a Linker for Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Aug, 21 of 2009		     						|
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

*/


require_once("Login.class.php");
require_once("MainContainer.class.php");
require_once("Register.class.php");
require_once("Y_DB.class.php"); 
require_once("NewFile.class.php");
require_once("Y_Template.class.php");
require_once("Projects.class.php");
require_once("SourceEditor.class.php");
require_once("Config.class.php");


class Linker {

    function __construct(){
        $action = $_REQUEST['action'];   
        switch($action){
            case '': new Login();
                break;
            case 'showlogin': new Login();
                break;
            case 'showIDE': $this->showIDE() ;
                break;
            case 'showIDEBody': $this->showIDEBody() ;
                break;
            case 'login':$this->doLogin();
                break;
            case 'register':new Register();
                break;
            case 'saveuser':$this->saveUser();
                break;
            case 'update_user':$this->updateUser();
                break;
            case 'checkuser':$this->checkUser();
                break;
            case 'checkemail':$this->isValidEmail();
                break;
            case 'create_project':$this->createProject();
                break;
            case 'update_project':$this->updateProject();
                break;
            case 'check_project':$this->checkProject();
                break;
            case 'get_project_files':$this->getProjectFiles();
                break;
            case 'create_folder':$this->createFolder();
                break;
            case 'create_file':$this->createFile();
                break;
            case 'show_new_file_window':$this->showNewFileWindow();
                break;
            case 'get_tpl':$this->getTPL();
                break;
            case 'load_file':$this->loadfile();
                break;
            case 'close_file':$this->closeFile();
                break;
            case 'upload_files':$this->uploadFiles();
                break;
            case 'close_all_files':$this->closeAllFiles();
                break;
            case 'save_file':$this->saveFile();
                break;
            case 'delete_file':$this->deleteFile();
                break;
            case 'run_project':$this->runProject();
                break;
            case 'project_properties':$this->projectProperties();
                break;
            case 'delete_project':$this->deleteProject();
                break;
            case 'download_project':$this->downloadProject();
                break;
            case 'edit_profile':$this->editProfile();
                break;
            case 'about':$this->about();
                break;
            case 'check_passw':$this->checkPassw();
                break;
            case 'change_passw':$this->changeUserPassword();
                break;
            case 'show_change_password_window':$this->changePassword();
                break;
            case 'get_table_creator':$this->getTableCreator();
                break;
            case 'get_orderedelist_creator':$this->getOrderedListCreator();
                break;
            case 'get_unorderedelist_creator':$this->getUnorderedListCreator();
                break;
            case 'get_image_creator':$this->getImageCreator();
                break;
            case 'get_link_creator':$this->getLinkCreator();
                break;
            case 'get_meta_creator':$this->getMetaCreator();
                break;
            case 'get_form_creator':$this->getFormCreator();
                break;
            case 'get_textinput_creator':$this->getTextInputCreator();
                break;
            case 'get_multiline_creator':$this->getMultilineCreator();
                break;
            case 'get_dropdown_creator':$this->getDropdownCreator();
                break;
            case 'get_check_creator':$this->getCheckCreator();
                break;
            case 'get_radio_creator':$this->getRadioCreator();
                break;
            case 'get_file_creator':$this->getFileCreator();
                break;
            case 'get_button_creator':$this->getButtonCreator();
                break;
            case 'get_canvas_creator':$this->getCanvasCreator();
                break;
            case 'show_useradd_window':$this->showUserAddWindow();
                break;
            case 'add_user_to_project':$this->addUserToProject();
                break;
            case 'get_user_data':$this->getUserData();
                break;
            case 'lock_unlock_user':$this->lockUnlockUser();
                break;
            case 'verify_invitation':$this->verifyInvitacion();
                break;
            case 'accept_decline':$this->acceptDeclineInvetation();
                break;
            case 'logout':$this->logOut();
                break;
            case 'dump_db': $d= new DB(); $d->dumpDB();
                break;
            case 'load_preferences': $this->loadPreferences();
                break;
            case 'user_preferences': $this->userPreferences();
                break;
            case 'svn_checkout': $this->svnCheckout();
                break;
            case 'svn_list': $this->svnList();
                break;
            case 'svn_add': $this->svnAdd();
                break;
            case 'svn_update': $this->svnUpdate();
                break;
            case 'svn_add_project': $this->svnAddProject();
                break;
            case 'svn_status': $this->svnStatus();
                break;
            case 'svn_file_status': $this->svnFileStatus();
                break;
            case 'svn_commit_file': $this->svnCommitFile();
                break;
            case 'svn_diff_file': $this->svnDiffFile();
                break;
            case 'syntax_check': $this->syntaxCheck();
                break;
            case 'register_load': $this->registerLoad();
                break;

            default : $this->_default(); 
            }
    }


    /**
     * function to return the Internet Protocol
     * @return <string>
     */
    function getIP() {
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
                return $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
            } else {
                return $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
            }
        }
    }
     /**
      *
      * @param <string> $filename
      * @return <string>
      * function to get file extension
      */
    function getFileExtension($filename){
        $file = strtolower($filename);
        return substr($file, strrpos($file,'.'));
    }
    function getUserName($user_id){
        $db = new Y_DB();
        $db->Query("select nick from usuarios where id_usuario = $user_id;");
        $db->NextRecord();
        $nick = $db->Record['nick'];
        return $nick;
    }
    function about(){
        require_once("About.class.php");
        new About();
    }
    function loadPreferences(){
        $user_id = $_POST['user_id'];
        require_once("Preferences.class.php");
        $pref = new Preferences();
        $pref->loadPreferences($user_id);
    }
    function userPreferences(){
        $user_id = $_GET['user_id'];
        require_once("Preferences.class.php");
        $pref = new Preferences();
        $pref->userPreferences($user_id);
    }
    function doLogin(){
        $user = $_POST['user'];
        $passw = sha1($_POST['passw']);
        require_once('Logger.class.php');
        $l = new Logger();
        if(strlen($user) > 25 || strlen($_POST['passw']) > 25){
            $l->writeLog($user, "Try Login from ".$this->getIP()."SQLInjection ".$_POST['passw']." unsuccessfully");
            echo false;
        }
        $db = new Y_DB();
        $db->Query("select id_usuario,nick from usuarios where nick = '$user' and passw = '$passw';");
        $db->NextRecord();
        $id = $db->Record['id_usuario'];

        if($id === null){
            $l->insertSQLLog($user, "Try Login from ".$this->getIP()." unsuccessfully");
            echo false;
        }else{
           $t = new Y_Template("Linker.tpl.php");
           require_once('Config.class.php');
           $c = new Config();

           $t->Set("user",$user);
           $t->Set("passw",$passw);
           $t->Set("users_path",$c->getUsersPath()); 
           $t->Show("redirect_form");
        }
    }
    function showIDE(){
        $user = $_REQUEST['username'];
        $passw = $_REQUEST['password']; // Password is encripted with Sha1

        require_once('Logger.class.php');   
        $l = new Logger();
        if(strlen($user) > 25 || strlen($_POST['passw']) > 25){
            $l->writeLog($user, "Try Login from ".$this->getIP()."SQLInjection ".$_POST['passw']." unsuccessfully");
            echo false;
        }
        $db = new Y_DB();
        $db->Query("select id_usuario,nick from usuarios where nick = '$user' and passw = '$passw';");
        $db->NextRecord();
        $id = $db->Record['id_usuario'];
      
        if($id === null){  
            $l->insertSQLLog($user, "Try Login from ".$this->getIP()." unsuccessfully");
            echo false;
        }else{
            $l->insertSQLLog($user, "Try Login from ".$this->getIP()." success");
            $ip = $this->getIP();
            //$db->Query("delete from sesiones where id_usuario = $id  and ip = '$ip';");  // No borrar por que puede abrir otra session desde otra maquina.
            $c = new MainContainer(); 
            $c->showHeader($id);
        }

    }
    function showIDEBody(){
        $user_id = $_POST['user'];
        $session_id = $_POST['session'];
        $db = new Y_DB();
        $db->Query("insert into  sesiones
        (id_sesion, id_usuario, ip, fecha, dia, session_id)
        values(default, $user_id,'".$this->getIP()."', CURRENT_TIMESTAMP, right(current_date,2), '$session_id')");
        $c = new MainContainer();
        $c->showBody($user_id,$session_id);
    }
    function logOut(){
        $user = $_POST['user'];
        require_once('Logger.class.php');
        $l = new Logger();
        $l->insertSQLLog($this->getUserName($user), "Logout from ".$this->getIP()."");
        require_once('Config.class.php');
        $c = new Config();
        echo $c->getDomain().'';
    }
    function _default(){
        echo "<b>Redirecting to login...</b>". $_REQUEST['action'];
        new Login();
    }
    function saveUser(){
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $user = $_POST['user'];
        $passw = sha1($_POST['passw']);
        $database_user_passw = $_POST['passw'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $add = $_POST['add'];
        $birthdate = $_POST['birthdate'];
        $db = new Y_DB();

        $db->Query("insert into usuarios(id_usuario, nick, passw, nombre, apellido, email, telef, pais, estado, ciudad, dir, fecha_nac, fecha_alta)
                 values(default,'$user','$passw','$name','$lastname','$mail','$phone' ,'$country' ,'$state','$city' ,'$add','$birthdate', current_date)");

        $out = 0;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { // Windows
            exec("mkdir ../../users/$name"); echo "Insecure OS detected...<br> Please use this OS for Test software only...";
            // Copiar IDE en esta carpeta
		    @mkdir("../../users", 0777);  
            @mkdir("../../users/$name", 0777);   
		    Chdir("../../"); 
		    exec("xcopy gurski users\\$name /E /I", $a, $a1);  
			Chdir("gurski/src");
        } else {  // Linux
            passthru("sudo user_manager $name $passw", $out);
        }

        if($out === 0){
             /**
             * Create new dabase for the user
             */
             $db->Query("create database gurski_$user;");

            /**
             * Create new database user
             */
            $db->Query("GRANT ALL PRIVILEGES ON gurski_$user.* TO '$user'@'localhost' IDENTIFIED BY '$database_user_passw' WITH MAX_QUERIES_PER_HOUR 36000 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 36000 MAX_USER_CONNECTIONS 0 ;");
            echo "<br><label class='info' ><big><big> Registration successfull please wait a minute to do login...  <br><br><br>
                  <label>  Your MySQL database name is: <label style='color:blue'> gurski_$user  </label> <br> <br> Your MySQL user and password are the same of your account.
                  </big></big></label>";
        }else{
           $db->Query("delete from usuarios where nick = '$user';");
           require_once("Logger.php");
           $l = new Logger();
           $l->writeErrorLog("Intento de registro fallido Usuario: $user from ".$this->getIP()." Email $mail ");
           echo "<label class='display_error' >An error occurred in the user registration process.
                 <br>A message has been sent to administrators. Please try again later
                 </label> ";
        }
    }
    function updateUser(){
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $user = $_POST['user'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $add = $_POST['add'];
        $birthdate = $_POST['birthdate'];
        $db = new Y_DB();

        $db->Query("update usuarios set nombre='$name', apellido= '$lastname', email= '$mail', telef='$phone', pais='$country', estado='$state', ciudad='$city',dir='$add', fecha_nac='$birthdate' where  nick = '$user';");

        echo "<label class='info' > Your profile has been updated successfull...</label>";
    }
    function checkUser(){
        $user = $_POST['user'];
        $long = strlen($user);
        if($long < 3){
            echo "<label class='msgredsmall' >Username should be at least 3 letters...</label> ";
            return;
        }
        $db = new Y_DB();
        $db->Query("select count(nick) as cant from usuarios where nick = '$user'; ");
        $db->NextRecord();
        $cant = $db->Record['cant'];
        if($cant > 0){
            echo "<label class='msgredsmall' id='usercheck'>Username not available...</label> ";
        }else{
            echo "<label class='msggrensmall' id='usercheck' >Ok</label>";
        }
    }
    function checkPassw(){
        $user_id = $_POST['user_id'];
        $passw = sha1($_POST['passw']);
        $db = new Y_DB();
        $db->Query("select count(*) as cant from usuarios where id_usuario = '$user_id' and passw = '$passw';");
        $db->NextRecord();
        if($db->Record['cant'] > 0){
            echo "Ok";
        }else{
            echo "Error";
        }
    }
    function changeUserPassword(){
        $user_id = $_POST['user_id'];
        $passw = sha1($_POST['passw']);
        $db = new Y_DB();
        $db->Query("update usuarios set  passw = '$passw' where id_usuario = '$user_id';");
        echo "ok";
    }

    // Function to verify valid emails with ajax
    private function isValidEmail(){
        $address =  $_POST['mail'];
        $flag = true;
        $valid_tlds = array("arpa", "biz", "com", "edu", "gov", "int", "mil", "net", "org",
        "ad", "ae", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "as", "at", "au",
        "aw", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "bj", "bm", "bn", "bo",
        "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cc", "cf", "cd", "cg", "ch", "ci",
        "ck", "cl", "cm", "cn", "co", "cr", "cs", "cu", "cv", "cx", "cy", "cz", "de", "dj",
        "dk", "dm", "do", "dz", "ec", "ee", "eg", "eh", "er", "es", "et", "fi", "fj", "fk",
        "fm", "fo", "fr", "fx", "ga", "gb", "gd", "ge", "gf", "gh", "gi", "gl", "gm", "gn",
        "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu",
        "id", "ie", "il", "in", "io", "iq", "ir", "is", "it", "jm", "jo", "jp", "ke", "kg",
        "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk",
        "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "mg", "mh", "mk", "ml", "mm",
        "mn", "mo", "mp", "mq", "mr", "ms", "mt", "mu", "mv", "mw", "mx", "my", "mz", "na",
        "nc", "ne", "nf", "ng", "ni", "nl", "no", "np", "nr", "nt", "nu", "nz", "om", "pa",
        "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pt", "pw", "py", "qa", "re",
        "ro", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl",
        "sm", "sn", "so", "sr", "st", "su", "sv", "sy", "sz", "tc", "td", "tf", "tg", "th",
        "tj", "tk", "tm", "tn", "to", "tp", "tr", "tt", "tv", "tw", "tz", "ua", "ug", "uk",
        "um", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "vu", "wf", "ws", "ye",
        "yt", "yu", "za", "zm", "zr", "zw");

        // Rough email address validation using POSIX-style regular expressions
        if (!eregi("^[a-z0-9_.]+@[a-z0-9\-]{2,}\.[a-z0-9\-\.]{2,}$", $address))
        $flag = false;
        else
        $address = strtolower($address);

        // Explode the address on name and domain parts
        $name_domain = explode("@", $address);

        // There can be only one ;-) I mean... the "@" symbol
        if (count($name_domain) != 2)
        $flag = false;

        // Check the domain parts
        $domain_parts = explode(".", $name_domain[1]);
        if (count($domain_parts) < 2)
        $flag = false;

        // Check the TLD ($domain_parts[count($domain_parts) - 1])
        if (!in_array($domain_parts[count($domain_parts) - 1], $valid_tlds))
        $flag = false;

        // Searche DNS for MX records corresponding to the hostname ($name_domain[0])
        //	if ($checkMX && !getmxrr($name_domain[0], $mxhosts))
        //$flag = false;

        if($flag != null){
            echo "<label class='msggrensmall' id='mailcheck' >Ok</label>";
        }else{
            echo "<label class='msgredsmall' id='mailcheck' >Email not valid...</label>";
        }
        // echo "Address  ".  $address." Flag = ".$flag;
    }

    function createProject(){
        $user_id = $_POST['user_id'];
        $project = $_POST['name'];
        $host = $_POST['host'];
        $hmpath = $_POST['hmpath'];
        $port = $_POST['port'];
        $index_file = $_POST['index_file'];

        // SQL
        $db = new Y_DB();
        $db->Query("insert into proyectos
                  (id_proyecto, nombre, srv_host, srv_main_path, srv_port, backup_path,index_file,estado)
                   values(default, '$project', '$host', '$hmpath', '$port', '/backups/$project', '$index_file','Activo')");
        // get ID
        $db->Query("select id_proyecto from proyectos order by id_proyecto desc LIMIT 1");
        $db->NextRecord();
        $id = $db->Record['id_proyecto'];

        $db->Query("insert into usuarios_x_proyecto
                  (id_usuario, id_proyecto, rol, ocupacion, estado)
                   values('$user_id', '$id', 'PL', 'Project Leader', 'Activo')");

        // Create folder for project
        mkdir("../projects/$project", 0777);
        // Create backup folder for the project
        mkdir("../backups/$project", 0777);

        // Create the index file
        fopen("../projects/$project/$index_file", "a");
        
        $c = new Config();
        $repos = $c->getRepositoryPath();
        /**
         * Creating svn project  ONLY THE FIRST TIME
         * Create default structure branches, tags, trunk
         * Seting up permisions
         */
         // exec("svnadmin create $repos/$project",$result);
        
         // exec("chown -R ".$c->getApacheUser().":".$c->getApacheUser()." $repos",$result); // ONLY THE FIRST TIME
 
       /**
        * @deprecated: require_once("Executor.class.php");
        * @deprecated:$e = new Executor();
        */
        // First Import
        $command =  "svn import ../projects/$project/   file:///$repos/$project  -m  'svn_initial_import' ";

        /**
         * @deprecated: $result = $e->runCommand( $command, $code);
         */
        exec($command, $res,$error);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        if ($error){$l->writeErrorLog("OS SVN Error: $error  in file  ".__FILE__ ." Command: $command" ); }
        foreach($res as $r){ $l->writeLog($r); }
	     //@deprecated: SVN Add project
         //$command =  "svn add ../projects/$project/";
         // $result = $e->runCommand( $command, $code);


        $projects = new Projects($user_id);
        $projects->showProjects();

    }


    function checkProject(){
        $name = $_POST['name'];
        if( strlen($name) == 0 ){
            echo "<label class='msgredsmall'>Project most be not empty...</label>";
        }else{
            $db = new Y_DB();
            $db->Query("select nombre from proyectos where  nombre = '$name';");
            if($db->NumRows()>0){
                echo "<label class='msgredsmall'>Project already exist...</label>";
            }else{
                echo "<label class='msggrensmall'>Ok</label>";
            }
        }

    }
    function svnCheckout(){
        $project = $_POST['project'];
        $c = new Config();
        $repos = $c->getRepositoryPath();
        $command =  "svn checkout  file:///$repos/$project  ../projects/$project ";
        exec($command, $res);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";}
    }
    function svnList(){
        $project = $_POST['project'];
        $c = new Config();
        $repos = $c->getRepositoryPath();
        $command =  "svn list  file:///$repos/$project";
        exec($command, $res);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";}
    }
    function svnAdd(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        $command =  "svn add  $fullpath";

        exec($command, $res,$error);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__ ." Command: $command");  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";}
    }
    function svnUpdate(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        $command =  "svn update  $fullpath";

        exec($command, $res,$error);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command );
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";}
    }
    function svnAddProject(){
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project/";
        $command = "svn add $fullpath";
        exec($command, $res,$error);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command );
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";}
    }
    function svnStatus(){
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project/";
        $command = "svn status $fullpath";
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        exec($command, $res,$error);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r";   }
    }
   function svnFileStatus(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        $command = "svn status $fullpath";
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        exec($command, $res,$error);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__ ." Command: $command");  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";   }
    }
   function svnCommitFile(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        $command = "svn commit $fullpath -m 'svn_commit'";
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        exec($command, $res,$error);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__ ." Command: $command");  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";   }
    }
    function svnDiffFile(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        $command = "svn diff $fullpath";
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        exec($command, $res,$error);
        if ($error){$l->writeErrorLog("OS Error: $error in file  ".__FILE__." Command: $command" );  echo "OS Error: $error"; }
        foreach($res as $r){ $l->writeLog($r); echo "<br> $r  ";   }
    }
    function updateProject(){
        $name = $_POST['name'];
        $host = $_POST['host'];
        $hmpath = $_POST['hmpath'];
        $port = $_POST['port'];
        $index_file = $_POST['index_file'];

        // SQL
        $db = new Y_DB();
        $db->Query("update proyectos set srv_host = '$host', srv_main_path = '$hmpath',  srv_port = '$port',index_file = '$index_file'
                        where nombre = '$name';");
        echo "Ok...";
    }
    // @todo check this function 
    function syntaxCheck(){
        $file  = $_POST['file'];
        $project = $_POST['project'];
        $cadena = trim($file);
        $fullpath = "../projects/$project$cadena";

        $ext = $this->getFileExtension($file); 
        if($ext === '.php'  || $ext === '.html' ){ 
          require_once("Config.class.php");
		  
          $cnf = new Config(); $bin = $cnf->getPHPRootPath();  
		   
          exec("$bin/php -l -f $fullpath",$results); 
          foreach($results as $result){
             if (eregi("Fatal error:", $result) || eregi("Parse error:", $result) || eregi("Errors parsing", $result)  )  {
                list( $lineword, $line ) = split( 'line', $result );
                if($line != ''){
                   echo '<font style="color:red" > <a href="javascript:jumpToLine('.trim($line).')" style="text-decoration:none;color:red;">  '.$result .'</a>  </font><br>';
                }else{
                   echo '<font style="color:red" >'. $result .'</font><br>';
                }
             }else{
                echo $result."<br>";
             }
          }
        } 
    }
    function getProjectFiles(){
        $id = $_POST['id'];
        include_once("ProjectHTMLReader.class.php");
        $db = new Y_DB();
        $db->Query("select nombre, index_file  from proyectos where id_proyecto = $id; ");
        $db->NextRecord();
        $name = $db->Record['nombre'];
        $index_file = $db->Record['index_file'];

        $reader = new ProjectHTMLReader();
        //$list = $reader->htmlDirList("../projects/$name/");
        $list = $reader->htmlFolderList("../projects/$name/",array("*"),true,null,null);

        echo '<ul class="simpleTree">
              <li class="root" id=" "><span>&nbsp;</span> ';
        echo  $list ;
        echo '</li> </ul> ';

        $t = new Y_Template("Linker.tpl.php");
        $t->Show("files_script_decorator");

        echo "<script>  current_project_index_file =  '$index_file';  </script>";
    }
    function createFolder(){
        $project = $_POST['project'];
        $ruta = $_POST['path'];
        $new_folder = $_POST['new_folder'];

        //$path = substr($ruta, 5);
        $fullpath = "../projects/$project/$ruta$new_folder";
        if(!is_dir($fullpath)){
            mkdir($fullpath, 0777);
        }
        // Reloading Client Folders tree
        $f = new NewFile(null,null);
        $f->reloadFolders($project);
    }
    function createFile(){
        NewFile::createNewFile();
    }
    function showNewFileWindow(){
        $new_file = new NewFile();
        $new_file->showFolderFilesContent($_GET['user_id'],$_GET['current_project']);
    }
    function uploadFiles(){
        $new_file = new NewFile();
        $new_file->showFoldersTree($_GET['user_id'],$_GET['current_project']);
    }
    function getTPL(){
        $file_type = $_POST['file_type'];
        require_once("Template.class.php");
        $t = new Template();
        $t->getTPL_converted($file_type);
    }
    function loadfile(){
        $file  = $_GET['file'];
        $user_id = $_GET['user_id'];
        $session_id = $_GET['session_id'];
        $project = $_GET['project'];
        $se = new SourceEditor();
        $se->show($user_id,$session_id, $project,$file);
    }
    function closeFile(){
        $user_id = $_POST['user_id'];
        $session_id = $_POST['session_id'];
        $file  = $_POST['file'];
        $project = $_POST['project'];
        $se = new SourceEditor();
        $se->closeFile($user_id,$session_id,$project, $file);
    }
    function closeAllFiles(){
        $user_id = $_POST['user_id'];
        $project = $_POST['project'];
        $db = new Y_DB();
        /**
         * @deprecated use the previus method style
         */
        //$db->Query("update archivos a, proyectos p set a.estado = 'Libre', a.usuario = '' where a.id_proyecto = p.id_proyecto and p.nombre = '$project'
        //     and a.usuario = $user_id ;");
         echo "Files Closed";
    }
    function saveFile(){
        $file  = $_POST['file'];
        $project = $_POST['project'];
        $session_id = $_POST['session_id'];
        $cadena = trim($file);
        $fullpath = "../projects/$project$cadena";
        $hash_code = md5($fullpath);
        $db = new Y_DB();
        $user_id = 0;
        $db->Query("select session_id, id_usuario from sesiones where session_id = '$session_id'; ");
        $sess = '';
        if($db->NumRows() > 0){
            $db->NextRecord();
            $sess = $db->Record['session_id'];
            $user_id = $db->Record['id_usuario'];
        }
        if($sess === $session_id){ // if is my session 

           // Check if is a current session id
           $db->Query("select session_id from sesiones_archivos where id_usuario = $user_id and hash_code = '$hash_code' order by id_sesion desc limit 1; ");
            $sess_id = '';
            if($db->NumRows() > 0){
                $db->NextRecord();
                $sess_id = $db->Record['session_id'];
            }
            if($sess_id != $session_id){
               echo "<label class='display_error'>File is in other session <label>"; return;
            }
            
            require_once("Logger.class.php");

            $code =  $_POST['code'];
            $replace0 = str_replace('\"','"',$code );
            $replace1 = str_replace("\'","'",$replace0 );
            $replace2  = str_replace('\\\\', '\\',$replace1);
            if (is_writable($fullpath)) {

                if (!$gestor = fopen($fullpath, 'w')) {
                    echo "<label class='display_error'>Can`t open file <label>"; return;
                }
                if (fwrite($gestor,$replace2) === FALSE) {
                    echo "<label class='display_error'>ERROR: File can`t be writed...<label>";
                    return;
                }
                echo "<label class='label'>&nbsp;&nbsp;   File Saved successfull...  &nbsp;&nbsp;</label>";

                fclose($gestor);
                return;
            } else {
                echo "<label class='display_error'>ERROR: File is not writable...<label>";
            }
        }else{
            echo "<label class='display_error'>File is in other session <label>"; return;
        }


           /*  $write = file_put_contents($fullpath, $replace );
            if($write){
               echo "<label class='info'>&nbsp;&nbsp;   File Saved successfull...  &nbsp;&nbsp;</label>";
            }else{
               echo "<label class='display_error'>ERROR: File can`t be writed...<label>";
            }*/
    }
    function deleteFile(){
        $file  = trim($_POST['file']);
        $project = trim($_POST['project']);
        $fullpath = "../projects/$project$file";
        chdir('../projects/');

        $filetodel = "$project$file";
        $do = unlink( $filetodel );

        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog("Deleting file: ".$fullpath." filetodel ".$filetodel);
        if($do=="1"){
            //$db = new Y_DB();
           // $db->Query("delete from archivos where hash_code = md5('$fullpath');");
            echo "<label class='info'>&nbsp;The file was deleted successfully. &nbsp;</label>";
        } else {
            $l->writeErrorLog($_StringErrLog);
            echo "<label class='display_error'> There was an error trying to delete the file.</label>";
        }
    }
    function runProject(){
        $project = $_GET['project'];
        $db = new Y_DB();
        $db->Query("select index_file from proyectos where nombre = '$project';");
        $db->NextRecord();
        $index = $db->Record['index_file'];
        $indexpath = "../projects/$project/$index";
        echo '<script>  window.location.href="'.$indexpath.'"; </script>';
    }
    function projectProperties(){
        $project = $_GET['project'];
        $projects = new Projects(null);
        $projects->properties($project);
    }

    function deleteProject(){
        $project = $_POST['project'];
        $db = new Y_DB();
        $db->Query("update proyectos set estado = 'Inactivo' where  nombre = '$project';");
        echo "<label class='info'>&nbsp;&nbsp;   Project deleted successfull...  &nbsp;&nbsp;</label>";
    }
    function downloadProject(){
        $project = $_POST['project'];
        require_once("Compressor.class.php");
        $compressor = new Compressor();
        $compressor->compress($project);
    }
    function editProfile(){
        $user_id = $_GET['user_id'];
        require_once("Profile.class.php");
        $p = new Profile($user_id);
        $p->showProfile();
    }
    function changePassword(){
        $user_id = $_GET['user_id'];
        require_once("Profile.class.php");
        $p = new Profile($user_id);
        $p->changePassword();
    }
    function getTableCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getTableCreator();
    }
    function getOrderedListCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getOrderedListCreator();
    }
    function getUnorderedListCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getUnorderedListCreator();
    }
    function getImageCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getImageCreator();
    }
    function getLinkCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getLinkCreator();
    }
    function getMetaCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getMetaCreator();
    }
    function getFormCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getFormCreator();
    }
    function getTextInputCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getTextInputCreator();
    }
    function getMultilineCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getMultilineCreator();
    }
    function getDropdownCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getDropdownCreator();
    }
    function getCheckCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getCheckCreator();
    }
    function getRadioCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getRadioCreator();
    }
    function getFileCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getFileCreator();
    }
    function getButtonCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getButtonCreator();
    }
    function getCanvasCreator(){
        require_once("Template.class.php");
        $tpl = new Template();
        $tpl->getCanvasCreator();
    }
    function showUserAddWindow(){
        $project = $_GET['project'];
        $l = new Y_Template("Linker.tpl.php");
        $l->Set("prname",$project);

        $l->Show("show_adduser_window_header");
        $db = new Y_DB();
        $db->Query("select u.id_usuario, s.nick, u.estado, u.rol, u.ocupacion, p.id_proyecto  from proyectos p, usuarios_x_proyecto u , usuarios s
                where p.id_proyecto = u.id_proyecto and p.nombre = '$project' and  u.id_usuario = s.id_usuario order by u.id_usuario");
        $cant = $db->NumRows();

        while($db->NextRecord()){
            $id_usuario = $db->Record['id_usuario'];
            $nick = $db->Record['nick'];
            $estado = $db->Record['estado'];
            $role = $db->Record['rol'];
            $ocupacion = $db->Record['ocupacion'];
            $id_proyecto = $db->Record['id_proyecto'];
            $st = 'Active';
            if($estado === 'Pendiente'){
                $st = 'Pending';
            }else if($estado === 'Rechazado'){
                $st = 'Declined';
            }else if($estado === 'Baja'){
                $st = 'Inactive';
            }
            if($role === 'PL'){
                $l->Set("image","pl.jpg");
            }else{
                $l->Set("image","user.png");
            }
            $l->Set("pruser_id",$id_usuario);
            $l->Set("username",$nick);
            $l->Set("rol",$role);
            $l->Set("desc",$ocupacion);
            $l->Set("state",$st);
            if($estado === 'Pendiente' || $estado === 'Activo'  ){
                $l->Set("value","Lock this user");
                $l->Set("fn","lockUnlockUser($id_usuario,$id_proyecto,'lock')");
                $l->Set("remove","<input type='button' class='button'  value='Remove' onclick=lockUnlockUser($id_usuario,$id_proyecto,'remove') >");
            }else{
                $l->Set("value","Unlock this user");
                $l->Set("fn","lockUnlockUser($id_usuario,$id_proyecto,'unlock')");
            }

            $l->Show("show_adduser_li");
            if($cant > 2){
                $var = 280 + $cant * 40;
                echo "<script>  parent.useradd.setDimension(780, $var); </script>";
            }
        }

        $l->Show("show_adduser_body");
        $db->Query("select rol, descripcion from roles;");
        while($db->NextRecord()){
            $rol = $db->Record['rol'];
            $descripcion = $db->Record['descripcion'];
            $l->Set("rol",$rol);
            $l->Set("desc",$descripcion);
            $l->Show("roles");
        }

        $l->Show("show_adduser_footer");

    }
    function getUserData(){
        $username = $_POST['username'];
        $db = new Y_DB();
        $db->Query("select id_usuario, nick,nombre, apellido from usuarios where nick = '$username';");
        if($db->NumRows()> 0){
            $db->NextRecord();
            $id = $db->Record['id_usuario'];
            $nick = $db->Record['nick'];
            $nombre = $db->Record['nombre'];
            $apellido = $db->Record['apellido'];
            $script.= ''.$id.',';
            $script.= ''.$nick.',';
            $script.= ''.$nombre.',';
            $script.= ''.$apellido.'';
            echo trim($script);
        }else{
            echo "false";
        }
    }
    function addUserToProject(){
        $user_id = $_POST['user_id'];
        $rol = $_POST['rol'];
        $ocup = $_POST['descrip'];
        $project = $_POST['project'];
        $db = new Y_DB();
        $db->Query("select id_proyecto from proyectos where nombre = '$project'");
        $db->NextRecord();
        $project_id = $db->Record['id_proyecto'];

        $db->Query("select * from usuarios_x_proyecto where id_usuario = $user_id and id_proyecto = $project_id;");
        if($db->NumRows()> 0){
            echo "<label class='display_error'>User already member of this project... </label> " ;
        }else{
            $db->Query("insert into usuarios_x_proyecto(id_usuario,id_proyecto,rol,ocupacion,estado)
                               values($user_id,$project_id,'$rol','$ocup','Pendiente')");
            echo "<label class='info'>User added successfull... </label> " ;
        }
    }
    function lockUnlockUser(){ // Lock Unlock and Remove User from a project
        $user_id = $_POST['user_id'];
        $project_id = $_POST['project_id'];
        $lockUnlock = $_POST['lock_unlock'];
        $db = new Y_DB();
        if($lockUnlock==='lock'){
            $db->Query("update usuarios_x_proyecto set estado = 'Baja' where id_usuario = $user_id and id_proyecto = $project_id;");
            echo "<label class='info'>User removed successfull... </label> " ;
        }else if($lockUnlock==='unlock'){
            $db->Query("update usuarios_x_proyecto set estado = 'Pendiente' where id_usuario = $user_id and id_proyecto = $project_id;");
            echo "<label class='info'>User activated successfull... </label> " ;
        }else{
            // Check if have a project leader
            $db->Query("select count(id_usuario) as cant from usuarios_x_proyecto  where id_proyecto = $project_id and rol = 'PL' and estado = 'Activo'; ");
            $db->NextRecord();
            $var = $db->Record['cant'];
            if ($var >= 1){
                $db->Query("delete from usuarios_x_proyecto  where id_usuario = $user_id and id_proyecto = $project_id;");
                echo "<label class='info'>User removed successfull... </label> " ;
            }else{
                echo "<label class='display_error'>Can`t remove all users of a project. </label> " ;
            }
        }
    }

    function verifyInvitacion(){
       $user_id = $_POST['user_id'];
       $l = new Y_Template("Linker.tpl.php");
       $db = new Y_DB();
       $db->Query("select u.id_proyecto,p.nombre, rol from proyectos p, usuarios_x_proyecto u where u.id_usuario = $user_id and
       u.estado = 'Pendiente' and u.id_proyecto = p.id_proyecto");
       if($db->NumRows()> 0){
         while($db->NextRecord()){
            $id_proyecto = $db->Record['id_proyecto'];
            $rol = $db->Record['rol'];
            $nombre = $db->Record['nombre'];
            $l->Set("user_id", $user_id);
            $l->Set("prname", $nombre);
            $l->Set("rol", $rol);
            
            $l->Set("fna","acceptDecline($user_id, $id_proyecto,'accept');");
            $l->Set("fnd","acceptDecline($user_id, $id_proyecto,'decline');");
            $l->Show("invitation_popup");
            $l->Show("popup_content");
            $l->Show("invitation_script");
         }
        }
    }

    function acceptDeclineInvetation(){
        $user_id = $_POST['user_id'];
        $project_id = $_POST['project_id'];
        $acdec = $_POST['accept_decline'];
        $db = new Y_DB();
        if($acdec === 'decline'){
           $db->Query("update usuarios_x_proyecto set estado = 'Rechazado' where  id_usuario = $user_id and
           id_proyecto =$project_id");
           echo "<label class='info'>Invitation declined...</label> ";
        }else{
           $db = new Y_DB();
           $db->Query("select u.id_proyecto,p.nombre, rol from proyectos p, usuarios_x_proyecto u where u.id_usuario = $user_id and
           u.estado = 'Pendiente' and u.id_proyecto = p.id_proyecto");
           $project = $db->Record['nombre'];

        /**
         *  Create folder for project
         */
        mkdir("../projects/$project", 0777);
        /**
         *  Create backup folder for the project
         */
        mkdir("../backups/$project", 0777);

        $c = new Config();
        $repos = $c->getRepositoryPath();

        // First Import
        $command =  "svn import ../projects/$project/   file:///$repos/$project  -m  'svn_initial_import' ";

        /**
         * @deprecated: $result = $e->runCommand( $command, $code);
         */
        exec($command, $res,$error);
        require_once("Logger.class.php");
        $l = new Logger();
        $l->writeLog($command);
        if ($error){$l->writeErrorLog("OS Error: $error  in file  ".__FILE__." Command: $command"  );  echo "OS Error: $error " ; }
        foreach($res as $r){ $l->writeLog($r); }

           $db->Query("update usuarios_x_proyecto set estado = 'Activo' where  id_usuario = $user_id and
           id_proyecto =$project_id"); 
           echo "<label class='info'>Acepted reload to join in a project</label> ";
        }
    }

    function registerLoad(){
       $user_id = $_POST['user_id'];
       $db = new Y_DB();
       $db->Query("select   (CURRENT_TIMESTAMP - fecha)   as MILIS from logs where id_usuario = $user_id order by id_log desc limit 1");
       if(  $db->NumRows() > 0) {
          $db->NextRecord();
          $milis =   number_format($db->Record['MILIS'],0,',','.') ;
          if($milis < 1){
             $milis = $milis * 1000;
             echo "IDE Loaded in ".$milis." miliseconds...";
          }else{
              if($milis < 2){
                echo "IDE Loaded in ".$milis." second...";
              }else{
                echo "IDE Loaded in ".$milis." seconds...";
              }
          }          
       }
    }
    function getAdds(){
                 /*
        <script type="text/javascript"><!--
        google_ad_client = "pub-4566331952331384";
        /* 728x15_5, creado 14/12/10 */   /*
        google_ad_slot = "3235441330";
        google_ad_width = 728;
        google_ad_height = 15;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>  */
    }
}
new Linker();

?>












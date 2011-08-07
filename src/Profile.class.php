<?php
require_once("Y_Template.class.php");
require_once("Y_DB.class.php");

/**
 * Description of Profileclass
 * Date: 22-09-2009
 * @author Doglas A. Dembogurski Feix
 */
class Profile {
    public $user_id = 0;
    public $t = null;

    function __construct($user_id){
        $this->t = new Y_Template("Profile.tpl.php");
        $this->user_id = $user_id;
    }

    function showProfile(){
        $db = new Y_DB();
        $db->Query("select id_usuario, nick,nombre,apellido,email,telef,pais,estado,ciudad,dir,fecha_nac from usuarios where id_usuario= $this->user_id;");
        if($db->NumRows() > 0){
            $db->NextRecord();
            $id_usuario = $db->Record['id_usuario'];
            $nick = $db->Record['nick'];
            $nombre = $db->Record['nombre'];
            $apellido = $db->Record['apellido'];
            $email = $db->Record['email'];
            $telef = $db->Record['telef'];
            $pais = $db->Record['pais'];
            $estado = $db->Record['estado'];
            $ciudad = $db->Record['ciudad'];
            $dir = $db->Record['dir'];
            $fecha_nac = $db->Record['fecha_nac'];


            $this->t->Show('header');
            $this->t->Set('user',$nick);
            $this->t->Set('name',$nombre);
            $this->t->Set('last_name',$apellido);
            $this->t->Set('mail',$email);
            $this->t->Set('phone',$this->telef);
            $this->t->Set('state',$estado);
            $this->t->Set('city',$ciudad);
            $this->t->Set('add',$dir);

            $this->t->Show('body');
            $this->t->Show('countryc');
            $dbp = new Y_DB();
            $dbp->Query("select pais from paises");
            $this->t->Set('country',$pais);
            $this->t->Show('countrydata');
            while($dbp->NextRecord()){
                $this->t->Set('country',$dbp->Record['pais']);
                $this->t->Show('countrydata');
            }

            $this->t->Show('countrye');
            $this->t->Show('states');
            $this->t->Show('bdc');

            $anioo = substr( $fecha_nac,0,4);
            $mes = substr( $fecha_nac,5,2);
            $dia = substr( $fecha_nac,8,10);

            // Set Days
            $this->t->Show('daysc');
            $this->t->Set('day',"$dia"); //for
            $this->t->Show('daysdata');
            for($i = 1;$i < 32;$i++){
                $d = $i;
                if($i < 10 ){
                    $d = '0'.$i;
                }
                $this->t->Set('day',"$d"); //for
                $this->t->Show('daysdata');
            }
            $this->t->Show('dayse');

            $this->t->Set('month',"$mes");
            $this->t->Show('months');

            $this->t->Show('yearc');
            $anio = date("Y");
            $this->t->Set('year',"$anioo"); //for
            $this->t->Show('yeardata');
            for($i = 1940;$i < $anio - 6;$i++){
                $this->t->Set('year',"$i"); //for
                $this->t->Show('yeardata');
            }
            $this->t->Show('yeare');

            $this->t->Show('bde');
            $this->t->Show('last');

        }else{
            echo "<div class='display_error'>Error: User not found in the database...</div>";
        }
    }
    function changePassword(){
        $this->t->Set("user_id", $this->user_id);
        $this->t->Show("changePassw");
        $this->t->Show("script");
    }
}
?>

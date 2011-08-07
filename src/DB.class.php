<?php

/**
Class to init the Database creation 
Douglas A. Dembogurski Feix
*/

/**
* ----------------------------------------------------------
* | DB	  Class - Gurski IDE		|
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

include_once("Y_Template.class.php");
include_once("Y_DB.class.php");
include_once("OS.class.php");


class DB{

    function __construct(){

    }

    function create_db(){

        $DB = new Y_DB();
        $pila = array ();
		array_push($pila, "drop database IF  EXISTS gurski");
		array_push($pila, "CREATE database IF NOT EXISTS gurski"); 


        array_push($pila, "CREATE TABLE  gurski.kb  (
           id_kb  int(10) unsigned NOT NULL AUTO_INCREMENT,
           id_usuario  int(11) NOT NULL,
           id_lenguaje  varchar(30) NOT NULL,
           nombre  varchar(100) DEFAULT NULL,
           descrip  varchar(200) DEFAULT NULL,
           cuerpo  varchar(10000) DEFAULT NULL,
           compartida  varchar(10) DEFAULT NULL,
          PRIMARY KEY ( id_kb )
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


        array_push($pila, "CREATE TABLE  gurski.lenguajes  (
           id_lenguaje  varchar(30) NOT NULL,
          PRIMARY KEY ( id_lenguaje )
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        /*Table structure for table  log_auditoria  */

        array_push($pila, "CREATE TABLE  gurski.log_auditoria  (
           id_log  int(10) unsigned NOT NULL AUTO_INCREMENT,
           id_usuario  int(11) NOT NULL,
           id_proyecto  int(11) NOT NULL,
           fechah  datetime DEFAULT NULL,
           log  varchar(10000) DEFAULT NULL,
           tipo  varchar(20) DEFAULT NULL,
          PRIMARY KEY ( id_log )
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        /*Table structure for table  logs  */

        array_push($pila, "CREATE TABLE  gurski.logs  (
           id_log  int(10) unsigned NOT NULL AUTO_INCREMENT,
           id_usuario  int(11) NOT NULL,
           nick  varchar(24) DEFAULT NULL,
           fecha  datetime DEFAULT NULL,
           log  varchar(1024) DEFAULT NULL,
          PRIMARY KEY ( id_log )
        ) ENGINE=InnoDB AUTO_INCREMENT=1584 DEFAULT CHARSET=latin1;");

        /*Table structure for table  paises  */

        array_push($pila, "CREATE TABLE  gurski.paises  (
           pais  varchar(255) NOT NULL,
           ISO_Code  varchar(2) NOT NULL,
           Region  varchar(255) NOT NULL,
           Capital  varchar(255) NOT NULL,
           Currency  varchar(255) NOT NULL,
          PRIMARY KEY ( ISO_Code )
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

        /*Table structure for table  preferencias  */

        array_push($pila, "CREATE TABLE  gurski.preferencias  (
           id_usuario  int(11) NOT NULL,
           clave  varchar(100) NOT NULL,
           valor  varchar(100) DEFAULT NULL,
          PRIMARY KEY ( id_usuario , clave )
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        /*Table structure for table  proyectos  */

        array_push($pila, "CREATE TABLE  gurski.proyectos  (
           id_proyecto  int(10) unsigned NOT NULL AUTO_INCREMENT,
           nombre  varchar(30) DEFAULT NULL,
           srv_host  varchar(400) DEFAULT NULL,
           srv_main_path  varchar(400) DEFAULT NULL,
           srv_port  varchar(10) DEFAULT NULL,
           backup_path  varchar(400) DEFAULT NULL,
           index_file  varchar(400) DEFAULT NULL,
           estado  varchar(10) DEFAULT NULL,
          PRIMARY KEY ( id_proyecto )
        ) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;");

        /*Table structure for table  roles  */

        array_push($pila, "CREATE TABLE  gurski.roles  (
           rol  varchar(60) DEFAULT NULL,
           descripcion  varchar(60) DEFAULT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

        /*Table structure for table  sesiones  */

        array_push($pila, "CREATE TABLE  gurski.sesiones  (
           id_sesion  int(10) unsigned NOT NULL AUTO_INCREMENT,
           id_usuario  int(11) NOT NULL,
           ip  varchar(16) DEFAULT NULL,
           fecha  datetime DEFAULT NULL,
           dia  varchar(2) DEFAULT NULL,
           session_id  varchar(120) DEFAULT NULL,
          PRIMARY KEY ( id_sesion )
        ) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=latin1;");

        /*Table structure for table  sesiones_archivos  */

        array_push($pila, "CREATE TABLE  gurski.sesiones_archivos  (
           id_sesion  int(11) NOT NULL AUTO_INCREMENT,
           id_usuario  int(11) NOT NULL,
           hash_code  varchar(120) NOT NULL,
           session_id  varchar(120) DEFAULT NULL,
           fecha  timestamp NULL DEFAULT NULL,
          PRIMARY KEY ( id_sesion )
        ) ENGINE=InnoDB AUTO_INCREMENT=888 DEFAULT CHARSET=latin1;");

        /*Table structure for table  usuarios  */

        array_push($pila, "CREATE TABLE  gurski.usuarios  (
           id_usuario  int(10) unsigned NOT NULL AUTO_INCREMENT,
           nick  varchar(25) DEFAULT NULL,
           passw  varchar(150) DEFAULT NULL,
           nombre  varchar(30) DEFAULT NULL,
           apellido  varchar(30) DEFAULT NULL,
           email  varchar(120) DEFAULT NULL,
           telef  varchar(60) DEFAULT NULL,
           pais  varchar(60) DEFAULT NULL,
           estado  varchar(60) DEFAULT NULL,
           ciudad  varchar(60) DEFAULT NULL,
           dir  varchar(400) DEFAULT NULL,
           fecha_nac  date DEFAULT NULL,
           fecha_alta  date NOT NULL,
          PRIMARY KEY ( id_usuario )
        ) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;");

        /*Table structure for table  usuarios_x_proyecto  */

        array_push($pila, "CREATE TABLE  gurski.usuarios_x_proyecto  (
           id_usuario  int(11) NOT NULL,
           id_proyecto  int(11) NOT NULL,
           rol  varchar(60) DEFAULT NULL,
           ocupacion  varchar(60) DEFAULT NULL,
           estado  varchar(10) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        array_push($pila,"ALTER TABLE gurski.usuarios CHANGE id_usuario  id_usuario  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.sesiones CHANGE  id_sesion   id_sesion  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.sesiones_archivos CHANGE  id_sesion   id_sesion  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.proyectos CHANGE  id_proyecto  id_proyecto  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.logs CHANGE  id_log  id_log  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.kb CHANGE  id_kb  id_kb  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.log_auditoria CHANGE  id_log  id_log  INT( 11 ) NOT NULL AUTO_INCREMENT ");
        array_push($pila,"ALTER TABLE gurski.kb CHANGE  id_kb  id_kb  INT( 11 ) NOT NULL AUTO_INCREMENT ");

        $qry = "INSERT INTO gurski.paises  VALUES ('Andorra','AD','Europe','Andorra la Vella','Euro'),('United Arab Emirates','AE','Middle East','Abu Dhabi','UAE Dirham'),('Afghanistan','AF','Asia','Kabul','Afghani'),('Antigua and Barbuda','AG','Central America and the Caribbean','Saint Johns','East Caribbean Dollar'),('Anguilla','AI','Central America and the Caribbean','The Valley','East Caribbean Dollar'),('Albania','AL','Europe','Tirana','Lek'),('Armenia','AM','Commonwealth of Independent States','Yerevan','Armenian Dram'),('Netherlands Antilles','AN','Central America and the Caribbean','Willemstad','Netherlands Antillean guilder'),('Angola','AO','Africa','Luanda','Kwanza'),('Antarctica','AQ','Antarctic Region','--',''),('Argentina','AR','South America','Buenos Aires','Argentine Peso'),('American Samoa','AS','Oceania','Pago Pago','US Dollar'),('Austria','AT','Europe','Vienna','Euro'),('Australia','AU','Oceania','Canberra','Australian dollar'),('Aruba','AW','Central America and the Caribbean','Oranjestad','Aruban Guilder'),('Azerbaijan','AZ','Commonwealth of Independent States','Baku (Baki)','Azerbaijani Manat'),('Bosnia and Herzegovina','BA','Bosnia and Herzegovina, Europe','Sarajevo','Convertible Marka'),('Barbados','BB','Central America and the Caribbean','Bridgetown','Barbados Dollar'),('Bangladesh','BD','Asia','Dhaka','Taka'),('Belgium','BE','Europe','Brussels','Euro'),('Burkina Faso','BF','Africa','Ouagadougou','CFA Franc BCEAO'),('Bulgaria','BG','Europe','Sofia','Lev'),('Bahrain','BH','Middle East','Manama','Bahraini Dinar'),('Burundi','BI','Africa','Bujumbura','Burundi Franc'),('Benin','BJ','Africa','Porto-Novo','CFA Franc BCEAO'),('Bermuda','BM','North America','Hamilton','Bermudian Dollar'),('Brunei Darussalam','BN','Southeast Asia','Bandar Seri Begawan','Brunei Dollar'),('Bolivia','BO','South America','La Paz /Sucre','Boliviano'),('Brazil','BR','South America','Brasilia','Brazilian Real'),('The Bahamas','BS','Central America and the Caribbean','Nassau','Bahamian Dollar'),('Bhutan','BT','Asia','Thimphu','Ngultrum'),('Bouvet Island','BV','Antarctic Region','--','Norwegian Krone'),('Botswana','BW','Africa','Gaborone','Pula'),('Belarus','BY','Commonwealth of Independent States','Minsk','Belarussian Ruble'),('Belize','BZ','Central America and the Caribbean','Belmopan','Belize Dollar'),('Canada','CA','North America','Ottawa','Canadian Dollar'),('Cocos (Keeling) Islands','CC','Southeast Asia','West Island','Australian Dollar'),('Congo, Democratic Republic of the','CD','Africa','Kinshasa','Franc Congolais'),('Central African Republic','CF','Africa','Bangui','CFA Franc BEAC'),('Congo, Republic of the','CG','Africa','Brazzaville','CFA Franc BEAC'),('Switzerland','CH','Europe','Bern','Swiss Franc'),('Cote d`Ivoire','CI','Africa','Yamoussoukro','CFA Franc BCEAO'),('Cook Islands','CK','Oceania','Avarua','New Zealand Dollar'),('Chile','CL','South America','Santiago','Chilean Peso'),('Cameroon','CM','Africa','Yaounde','CFA Franc BEAC'),('China','CN','Asia','Beijing','Yuan Renminbi'),('Colombia','CO','South America, Central America and the Caribbean','Bogota','Colombian Peso'),('Costa Rica','CR','Central America and the Caribbean','San Jose','Costa Rican Colon'),('Cuba','CU','Central America and the Caribbean','Havana','Cuban Peso'),('Cape Verde','CV','World','Praia','Cape Verdean Escudo'),('Christmas Island','CX','Southeast Asia','The Settlement','Australian Dollar'),('Cyprus','CY','Middle East','Nicosia','Cyprus Pound'),('Czech Republic','CZ','Europe','Prague','Czech Koruna'),('Germany','DE','Europe','Berlin','Euro'),('Djibouti','DJ','Africa','Djibouti','Djibouti Franc'),('Denmark','DK','Europe','Copenhagen','Danish Krone'),('Dominica','DM','Central America and the Caribbean','Roseau','East Caribbean Dollar'),('Dominican Republic','DO','Central America and the Caribbean','Santo Domingo','Dominican Peso'),('Algeria','DZ','Africa','Algiers','Algerian Dinar'),('Ecuador','EC','South America','Quito','US dollar'),('Estonia','EE','Europe','Tallinn','Kroon'),('Egypt','EG','Africa','Cairo','Egyptian Pound'),('Western Sahara','EH','Africa','--','Moroccan Dirham'),('Eritrea','ER','Africa','Asmara','Nakfa'),('Spain','ES','Europe','Madrid','Euro'),('Ethiopia','ET','Africa','Addis Ababa','Ethiopian Birr'),('Finland','FI','Europe','Helsinki','Euro'),('Fiji','FJ','Oceania','Suva','Fijian Dollar'),('Falkland Islands (Islas Malvinas)','FK','South America','Stanley','Falkland Islands Pound'),('Micronesia, Federated States of','FM','Oceania','Palikir','US dollar'),('Faroe Islands','FO','Europe','Torshavn','Danish Krone'),('France','FR','Europe','Paris','Euro'),('France, Metropolitan','FX','','--','Euro'),('Gabon','GA','Africa','Libreville','CFA Franc BEAC'),('Grenada','GD','Central America and the Caribbean','Saint George`s','East Caribbean Dollar'),('Georgia','GE','Commonwealth of Independent States','Tbilisi','Lari'),('French Guiana','GF','South America','Cayenne','Euro'),('Guernsey','GG','Europe','Saint Peter Port','Pound Sterling'),('Ghana','GH','Africa','Accra','Cedi'),('Gibraltar','GI','Europe','Gibraltar','Gibraltar Pound'),('Greenland','GL','Arctic Region','Nuuk','Danish Krone'),('The Gambia','GM','Africa','Banjul','Dalasi'),('Guinea','GN','Africa','Conakry','Guinean Franc'),('Guadeloupe','GP','Central America and the Caribbean','Basse-Terre','Euro'),('Equatorial Guinea','GQ','Africa','Malabo','CFA Franc BEAC'),('Greece','GR','Europe','Athens','Euro'),('South Georgia and the South Sandwich Islands','GS','Antarctic Region','--','Pound Sterling'),('Guatemala','GT','Central America and the Caribbean','Guatemala','Quetzal'),('Guam','GU','Oceania','Hagatna','US Dollar'),('Guinea-Bissau','GW','Africa','Bissau','CFA Franc BCEAO'),('Guyana','GY','South America','Georgetown','Guyana Dollar'),('Hong Kong (SAR)','HK','Southeast Asia','Hong Kong','Hong Kong Dollar'),('Heard Island and McDonald Islands','HM','Antarctic Region','--','Australian Dollar'),('Honduras','HN','Central America and the Caribbean','Tegucigalpa','Lempira'),('Croatia','HR','Europe','Zagreb','Kuna'),('Haiti','HT','Central America and the Caribbean','Port-au-Prince','Gourde'),('Hungary','HU','Europe','Budapest','Forint'),('Indonesia','ID','Southeast Asia','Jakarta','Rupiah'),('Ireland','IE','Europe','Dublin','Euro'),('Israel','IL','Middle East','Jerusalem','New Israeli Sheqel'),('Man, Isle of','IM','Europe','Douglas','Pound Sterling'),('India','IN','Asia','New Delhi','Indian Rupee'),('British Indian Ocean Territory','IO','World','--','US Dollar'),('Iraq','IQ','Middle East','Baghdad','Iraqi Dinar'),('Iran','IR','Middle East','Tehran','Iranian Rial'),('Iceland','IS','Arctic Region','Reykjavik','Iceland Krona'),('Italy','IT','Europe','Rome','Euro'),('Jersey','JE','Europe','Saint Helier','Pound Sterling'),('Jamaica','JM','Central America and the Caribbean','Kingston','Jamaican dollar'),('Jordan','JO','Middle East','Amman','Jordanian Dinar'),('Japan','JP','Asia','Tokyo','Yen'),('Kenya','KE','Africa','Nairobi','Kenyan shilling'),('Kyrgyzstan','KG','Commonwealth of Independent States','Bishkek','Som'),('Cambodia','KH','Southeast Asia','Phnom Penh','Riel'),('Kiribati','KI','Oceania','Tarawa','Australian dollar'),('Comoros','KM','Africa','Moroni','Comoro Franc'),('Saint Kitts and Nevis','KN','Central America and the Caribbean','Basseterre','East Caribbean Dollar'),('Korea, North','KP','Asia','Pyongyang','North Korean Won'),('Korea, South','KR','Asia','Seoul','Won'),('Kuwait','KW','Middle East','Kuwait','Kuwaiti Dinar'),('Cayman Islands','KY','Central America and the Caribbean','George Town','Cayman Islands Dollar'),('Kazakhstan','KZ','Commonwealth of Independent States','Astana','Tenge'),('Laos','LA','Southeast Asia','Vientiane','Kip'),('Lebanon','LB','Middle East','Beirut','Lebanese Pound'),('Saint Lucia','LC','Central America and the Caribbean','Castries','East Caribbean Dollar'),('Liechtenstein','LI','Europe','Vaduz','Swiss Franc'),('Sri Lanka','LK','Asia','Colombo','Sri Lanka Rupee'),('Liberia','LR','Africa','Monrovia','Liberian Dollar'),('Lesotho','LS','Africa','Maseru','Loti'),('Lithuania','LT','Europe','Vilnius','Lithuanian Litas'),('Luxembourg','LU','Europe','Luxembourg','Euro'),('Latvia','LV','Europe','Riga','Latvian Lats'),('Libya','LY','Africa','Tripoli','Libyan Dinar'),('Morocco','MA','Africa','Rabat','Moroccan Dirham'),('Monaco','MC','Europe','Monaco','Euro'),('Moldova','MD','Commonwealth of Independent States','Chisinau','Moldovan Leu'),('Madagascar','MG','Africa','Antananarivo','Malagasy Franc'),('Marshall Islands','MH','Oceania','Majuro','US dollar'),('Macedonia, The Former Yugoslav Republic of','MK','Europe','Skopje','Denar'),('Mali','ML','Africa','Bamako','CFA Franc BCEAO'),('Burma','MM','Southeast Asia','Rangoon','kyat'),('Mongolia','MN','Asia','Ulaanbaatar','Tugrik'),('Macao','MO','Southeast Asia','Macao','Pataca'),('Northern Mariana Islands','MP','Oceania','Saipan','US Dollar'),('Martinique','MQ','Central America and the Caribbean','Fort-de-France','Euro'),('Mauritania','MR','Africa','Nouakchott','Ouguiya'),('Montserrat','MS','Central America and the Caribbean','Plymouth','East Caribbean Dollar'),('Malta','MT','Europe','Valletta','Maltese Lira'),('Mauritius','MU','World','Port Louis','Mauritius Rupee'),('Maldives','MV','Asia','Male','Rufiyaa'),('Malawi','MW','Africa','Lilongwe','Kwacha'),('Mexico','MX','North America','Mexico','Mexican Peso'),('Malaysia','MY','Southeast Asia','Kuala Lumpur','Malaysian Ringgit'),('Mozambique','MZ','Africa','Maputo','Metical'),('Namibia','NA','Africa','Windhoek','Namibian Dollar'),('New Caledonia','NC','Oceania','Noumea','CFP Franc'),('Niger','NE','Africa','Niamey','CFA Franc BCEAO'),('Norfolk Island','NF','Oceania','Kingston','Australian Dollar'),('Nigeria','NG','Africa','Abuja','Naira'),('Nicaragua','NI','Central America and the Caribbean','Managua','Cordoba Oro'),('Netherlands','NL','Europe','Amsterdam','Euro'),('Norway','NO','Europe','Oslo','Norwegian Krone'),('Nepal','NP','Asia','Kathmandu','Nepalese Rupee'),('Nauru','NR','Oceania','--','Australian Dollar'),('Niue','NU','Oceania','Alofi','New Zealand Dollar'),('New Zealand','NZ','Oceania','Wellington','New Zealand Dollar'),('Oman','OM','Middle East','Muscat','Rial Omani'),('Panama','PA','Central America and the Caribbean','Panama','balboa'),('Peru','PE','South America','Lima','Nuevo Sol'),('French Polynesia','PF','Oceania','Papeete','CFP Franc'),('Papua New Guinea','PG','Oceania','Port Moresby','Kina'),('Philippines','PH','Southeast Asia','Manila','Philippine Peso'),('Pakistan','PK','Asia','Islamabad','Pakistan Rupee'),('Poland','PL','Europe','Warsaw','Zloty'),('Saint Pierre and Miquelon','PM','North America','Saint-Pierre','Euro'),('Pitcairn Islands','PN','Oceania','Adamstown','New Zealand Dollar'),('Puerto Rico','PR','Central America and the Caribbean','San Juan','US dollar'),('Palestinian Territory, Occupied','PS','','--',''),('Portugal','PT','Europe','Lisbon','Euro'),('Palau','PW','Oceania','Koror','US dollar'),('Paraguay','PY','South America','Asuncion','Guarani'),('Qatar','QA','Middle East','Doha','Qatari Rial'),('RÃ©union','RE','World','Saint-Denis','Euro'),('Romania','RO','Europe','Bucharest','Leu'),('Russia','RU','Asia','Moscow','Russian Ruble'),('Rwanda','RW','Africa','Kigali','Rwanda Franc'),('Saudi Arabia','SA','Middle East','Riyadh','Saudi Riyal'),('Solomon Islands','SB','Oceania','Honiara','Solomon Islands Dollar'),('Seychelles','SC','Africa','Victoria','Seychelles Rupee'),('Sudan','SD','Africa','Khartoum','Sudanese Dinar'),('Sweden','SE','Europe','Stockholm','Swedish Krona'),('Singapore','SG','Southeast Asia','Singapore','Singapore Dollar'),('Saint Helena','SH','Africa','Jamestown','Saint Helenian Pound'),('Slovenia','SI','Europe','Ljubljana','Tolar'),('Svalbard','SJ','Arctic Region','Longyearbyen','Norwegian Krone'),('Slovakia','SK','Europe','Bratislava','Slovak Koruna'),('Sierra Leone','SL','Africa','Freetown','Leone'),('San Marino','SM','Europe','San Marino','Euro'),('Senegal','SN','Africa','Dakar','CFA Franc BCEAO'),('Somalia','SO','Africa','Mogadishu','Somali Shilling'),('Suriname','SR','South America','Paramaribo','Suriname Guilder'),('SÃ£o Tom?and PrÃ­ncipe','ST','Africa','Sao Tome','Dobra'),('El Salvador','SV','Central America and the Caribbean','San Salvador','El Salvador Colon'),('Syria','SY','Middle East','Damascus','Syrian Pound'),('Swaziland','SZ','Africa','Mbabane','Lilangeni'),('Turks and Caicos Islands','TC','Central America and the Caribbean','Cockburn Town','US Dollar'),('Chad','TD','Africa','NDjamena','CFA Franc BEAC'),('French Southern and Antarctic Lands','TF','Antarctic Region','--','Euro'),('Togo','TG','Africa','Lome','CFA Franc BCEAO'),('Thailand','TH','Southeast Asia','Bangkok','Baht'),('Tajikistan','TJ','Commonwealth of Independent States','Dushanbe','Somoni'),('Tokelau','TK','Oceania','--','New Zealand Dollar'),('Turkmenistan','TM','Commonwealth of Independent States','Ashgabat','Manat'),('Tunisia','TN','Africa','Tunis','Tunisian Dinar'),('Tonga','TO','Oceania','Nuku\'alofa','Pa\'anga'),('East Timor','TP','','--','Timor Escudo'),('Turkey','TR','Middle East','Ankara','Turkish Lira'),('Trinidad and Tobago','TT','Central America and the Caribbean','Port-of-Spain','Trinidad and Tobago Dollar'),('Tuvalu','TV','Oceania','Funafuti','Australian Dollar'),('Taiwan','TW','Southeast Asia','Taipei','New Taiwan Dollar'),('Tanzania','TZ','Africa','Dar es Salaam','Tanzanian Shilling'),('Ukraine','UA','Commonwealth of Independent States','Kiev','Hryvnia'),('Uganda','UG','Africa','Kampala','Uganda Shilling'),('United Kingdom','UK','Europe','London','Pound Sterling'),('United States Minor Outlying Islands','UM','','--','US Dollar'),('United States','US','North America','Washington, DC','US Dollar'),('Uruguay','UY','South America','Montevideo','Peso Uruguayo'),('Uzbekistan','UZ','Commonwealth of Independent States','Tashkent','Uzbekistan Sum'),('Holy See (Vatican City)','VA','Europe','Vatican City','Euro'),('Saint Vincent and the Grenadines','VC','Central America and the Caribbean','Kingstown','East Caribbean Dollar'),('Venezuela','VE','South America, Central America and the Caribbean','Caracas','Bolivar'),('British Virgin Islands','VG','Central America and the Caribbean','Road Town','US dollar'),('Virgin Islands','VI','Central America and the Caribbean','Charlotte Amalie','US Dollar'),('Vietnam','VN','Southeast Asia','Hanoi','Dong'),('Vanuatu','VU','Oceania','Port-Vila','Vatu'),('Wallis and Futuna','WF','Oceania','Mata-Utu','CFP Franc'),('Samoa','WS','Oceania','Apia','Tala'),('Yemen','YE','Middle East','Sanaa','Yemeni Rial'),('Mayotte','YT','Africa','Mamoutzou','Euro'),('Yugoslavia','YU','Europe','Belgrade','Yugoslavian Dinar'),('South Africa','ZA','Africa','Pretoria','Rand'),('Zambia','ZM','Africa','Lusaka','Kwacha'),('Zimbabwe','ZW','Africa','Harare','Zimbabwe Dollar'),('Proxy Server','PX','Internet','',''),('European Union','EU','Europe','none','Euro');";
        array_push($pila,$qry);
                // Invitado

        array_push($pila,"insert into  gurski.usuarios
                (id_usuario, nick, passw, nombre, apellido, email, telef, pais, estado, ciudad, dir, fecha_nac, fecha_alta)
                values
                (default, 'invited' , sha1('invited') , 'Invited', 'Invited', 'invited@gurski.com', '','Paraguay','Itapúa','Encarnación', '', '0000-00-00', current_date)");

		foreach($pila as $sql) {
		   echo "<b>Sentencia\</b><br><br>".$sql."<br><br>";
		   $DB->Query( $sql );
		}

        /**
         * if Windows create user folders
         */
        $os = new OS();
        $operating_system = substr($os->getOS(), 0, 3);

        if($operating_system === 'Win'){ // Windows
            $this->createWindowsUser("invited");
        }
    }
    function createWindowsUser($user){
           echo "<h1> Insecure OS detected... </h1><br>";
           @mkdir("../../users", 0777); echo "Creating user folder<br>";
           @mkdir("../../users/$user", 0777); echo "Creating $user user<br>"; 
		   Chdir("../../"); 
		   exec("xcopy gurski users\\$user /E /I", $a, $a1);
		   Chdir("gurski/src");
    }
    function full_copy( $source, $target ) {
        if ( is_dir( $source ) ) {
            @mkdir( $target );
            $d = dir( $source );
            while ( FALSE !== ( $entry = $d->read() ) ) {
                if ( $entry == '.' || $entry == '..'  || $entry == '.svn') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if ( is_dir( $Entry ) ) {
                    full_copy( $Entry, $target . '/' . $entry );
                    continue;
                }
                echo "$Entry, $target . '/' . $entry <br>";
                copy( $Entry, $target . '/' . $entry );
            }

            $d->close();
        }else {
            echo "$source --> $target<br>";
            copy( $source, $target );
        }
    }
    public function dumpDB(){
        require_once("Executor.class.php");
        $e = new Executor();
        Chdir("../db");
        $result = $e->runCommand("mysqldump  gurski --verbose -u plus -pcase >  gurski_dump.sql" ,  $code);
        print "<pre>";
        print $result;
        print "</pre>\n";
        echo $code;
    }
}
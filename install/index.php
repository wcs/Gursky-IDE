<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Gurski IDE Installation</title>
    </head>
    <body>
       <h1> Gurski IDE </h1>
       <p> Creating database gurski </p>
       <?php
            require_once("../src/DB.class.php");
            $d = new DB();
            $d->create_db();
       ?>
        <p> Database gurski created... </p>

       <?php
            require_once("../src/OS.class.php");
            $os = new OS();
            $operating_system = substr($os->getOS(), 0, 3);

            if($operating_system === 'Win'){ // Windows
               echo '';
            }else{  // Linux
               echo '   
			   <p>Edit as root the file <b> <i> /etc/sudoers </i> </b> add the followin comands</p>

			   <p>Cmnd_Alias USER_MANAGER = /bin/user_manager </p>
				<p>www-data ALL= NOPASSWD: USER_MANAGER </p>
				<p>apache ALL=NOPASSWD:/usr/sbin/useradd, \</p>
				<p>/bin/mkdir, /bin/ln, /bin/chown, /bin/user_manager </p>

				<br>
				<br>

				<p>Create a file named  user_manager in<b> <i> /bin/user_manager </i> </b> with the followin comands</p>

				<p>#!/bin/bash</p>

				<p>if [ `id -u` -ne 0 ]; then</p>
				 <p>  echo "Tenes que ser root para invocarme, chau" >&2</p>
				<p>   exit -1</p>
				<p>fi</p>

				<p>/bin/mkdir /home/$1</p>
				<p>/usr/sbin/useradd $1 -g usuarios -s /bin/sh -d /home/$1  -p $2</p>
				<p>/bin/mkdir /var/www/users/$1</p>
				<p>/bin/ln -s /var/www/users/$1 /home/$1/www</p>
				<p>/bin/chown -R $1 /var/www/users/$1 </p>

				<p>#Copy de IDE to  /home/user/www</p>
				<p>#cp -R  /IDEpath   /home/$1/www</p>
				<p>chown -R www-data /home/$1/www</p>


				<p>Optional: Install SVN with REPOSITORY_PATH in<b> <i> /var/local/repos </i> </b></p>';
        
            } 
       ?>
		<b> <big> Installation Complete... </big> </b> <br><br>
		<h1> Please take a look at the configuration file in /users/<user>/src/Config.class.php</h1>
		<a href="http://localhost/gurski"> Goto the GURSKI-IDE  NOW!!!</A> 
		
    </body>
</html>



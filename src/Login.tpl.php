

<!-- begin: header noeval -->
<html>
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="author" content="Doglas Antonio Dembogurski Feix">
   <meta name="Url" content="http://gurskiide.blogspot.com">
   <meta name="mailto" content="dembogurski@gmail.com">
   <meta name="keywords" content="cloud computing IDE Editor PHP Javascript HTML CSS SQL Python Lua Sparql Ruby">
   <meta name="robots" content="all">
   <meta name="description" content="Gurski IDE (Online editor) ">
   <title>Gurski Web-IDE (Alpha)</title>
   
   <link rel="shortcut icon" href="../images/favicon.ico">
   <link rel="StyleSheet" href="../css/style.css" type="text/css">

   <script type="text/javascript" src="../js/jquery.js"></script> <!-- 1.2.6 -->
   <script type="text/javascript" src="../js/minimal_functions.js"></script>

    <script type="text/javascript"> 
	     $(document).ready( init );
    </script> 
  </head>
   
    <body   style="position: relative; height: 100%; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "  >
    <div id="maincontainer" >
        <table border="0" width="100%"  height="100%"  cellspacing="30">
           <tr> <td height="50px" align="center" valign="center"  >
            <table  border="0" width="100%" >
              <tr> <td width="33%"></td> <td id="loading" valign="middle" align="left"  ><label id="loading_msg" class='loading_msg'> </label>  </td> <td width="33%"> </td> </tr>
              <tr> <td width="33%"></td> <td height="11px" id="loading_img" valign="middle" align="left"  ><img src='../images/blue-stripe.gif' name="bar" height='8' width='0'> </td> <td width="33%"> </td> </tr>
            </table>
           </td> </tr>
	 <tr> <td height="15%" align="center"  >    
	         <!--  <img src="../images/gurski_small.png" height="80" width="400" >    --> 
			<object type="application/x-shockwave-flash" data="../images/gurski.swf"
			width="400" height="80">
			<param name="movie" value="../images/gurski.swf" />
			<param name="scale" value="exactfit" />
			</object>
    </td> </tr>
           <tr> <td height="33%" align="center">
           
             <table border="0"  width="100%"  height="100%" >
               <tr>
                <td width="33%" >  </td>
                <td align="center" class="loginPanel" id="login"  >
<!-- end: header -->
<!-- begin: loginform -->
                   <table    width="100%"  height="100%" border="0" >
                     <tr>   <td  colspan="2" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp; Login </b> <small> (Alpha) </small> </td>  </tr>
                     <tr >   <td width="40%" align="center" class="label">Username:</td>  <td> <input id="username" value="" class="textfield" type="text" size="25" maxlength="25" onkeyup="checkempty(event.keyCode)" >   </td>  </tr>
                     <tr >   <td width="40%" align="center" class="label">Password:</td>  <td> <input id="password" value="" class="textfield" type="password" size="25" maxlength="25" onkeyup="checkempty(event.keyCode)" > </td>  </tr>
                     <tr >   <td width="40%"> &nbsp; </td>   <td  align="left" class="msggrensmall"> <input type="checkbox" id="remember" name="remember"  value="on" /> Remember me on this computer</td>   </tr>
                     <tr >   <td colspan="2" align="center">  <input type="button"   class="button" value="   Sign in   "  onclick="login()" id="loginbutton" > </td>  </tr>

                     <tr>   <td colspan="2" align="center"> <a href="{login_url}"   class="label" style="text-decoration:none;"  >{login_link}</a> &nbsp; &nbsp; 
                     <a href="javascript:loginAsInvited()" style="text-decoration:none;"  class="label">Login as Invited</a>  </td>  </tr>

                   </table>
<!-- end: loginform -->
<!-- begin: footer -->
                </td>
                <td width="33%"> </td>
               </tr>
           </table>


          </td> </tr>
          <tr> <td height="33%" align="center" valign="top">
                  <div> <img src="../images/sup_brows_five.gif">  </div>
                  <span> <img src="../images/ajax.gif"    >  &nbsp;
                  <a href="http://www.php.net" target="_blank" > <img src="../images/php.png" border="0" width="40" height="40" title="PHP"  ></a>  &nbsp;
                  <a href="http://www.mysql.com" target="_blank" > <img src="../images/mysql.png" border="0" width="40" height="40"  title="MySQL"></a> &nbsp;
                  <a href="http://subversion.tigris.org" target="_blank" ><img src="../images/subversion.png" border="0" width="40" height="40" title="Subversion" ></a> &nbsp;
	              <a href="http://marijn.haverbeke.nl/codemirror/" target="_blank" > <img src="../images/codemirror.png" border="0" width="40" height="40" title="Codemirror" ></a> &nbsp;
                   <a href="http://apache.org/" target="_blank" > <img src="../images/apache.jpg" border="0" width="40" height="40" title="Apache" ></a> &nbsp;
                  </span> <br><br><br>
                  <div> <img src="../images/menu/dhxmenu_aqua_sky/dhtmlxmenu_arrow_bg_over.gif" height="3px" width="100%"> </div>
                  <br><br>
                  <div style="font-size:11px; font-weight:bolder;">
                   <a href="http://groups.google.com.py/group/gurski_ide" target="_blank">Google Group</a> &nbsp;&nbsp;
				   <a href="http://twitter.com/gurskiide" target="_blank" >Twitter</a> &nbsp;&nbsp;
                   <a href="http://gurskiide.blogspot.com" target="_blank">Blogger</a> &nbsp;&nbsp;
                   <a href="http://bit.ly/cGhe6j" target="_blank">Bugtracker</a>   &nbsp;&nbsp;
                   <a href="#" target="_blank">Privacy Policy</a>  &nbsp;&nbsp;
                   <a href="#" target="_blank">Terms & Conditions</a>
                 </div>
               </td>
          </tr>

        </table>
    </div>
    </body>
  
  </html>
<!-- end: footer -->
 
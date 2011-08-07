

<!-- Esta funcion acomoda los distintos paneles  -->

<!-- begin: header -->
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  
   <title>Gurski Web-IDE (Alpha)</title>
   
   <link rel="shortcut icon" href="../images/favicon.ico">
   <link rel="StyleSheet" href="../css/style.css" type="text/css">
   <script type="text/javascript" src="../js/jquery.js"></script> <!-- 1.2.6 -->
   <script type="text/javascript" src="../js/functions.js"></script>

   <input type="hidden" id="user_id" value="{user_id}">
   <input type="hidden" id="session_id" value="{session_id}">

    <script type="text/javascript"> 
	    $(document).ready( loadlibraries );
    </script> 
  </head>

    <body  style="position: relative; height: 100%; overflow-x: hidden; overflow-y: hidden; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "  >
     <div id="maincontainer" >
            <table border="0" width="100%"  height="80%"  cellspacing="30">
               <tr>
                   <td height="40px" align="center" valign="center"  >
                    <table  border="0" width="100%" >
                      <tr> <td width="33%"></td> <td  width="33%" id="loading" valign="middle" align="left"  ><label id="loading_msg" class="loading_msg"> Loading libraries please wait...</label>  </td> <td width="33%"> </td> </tr>
                      <tr> <td width="33%"></td>
                       <td   width="33%" id="loading_img" valign="middle" align="left"  >
                         <table border="1" width="100%" cellpadding="0" cellspacing="0"  >
                           <tr> <td height="10px"> <img src="../images/blue-stripe.gif" name="bar" height='8' width='0'>  </td>  </tr>
                         </table>
                       </td>

                      <td width="33%"> </td> </tr>
                      <tr> <td width="33%" height="36px"></td> <td height="11px"  valign="middle" align="left"  > <label id="lib_progress" class="msggrensmall"> Libraries </label> </td> <td width="33%"> </td> </tr>
                    </table>
                   </td>
               </tr>
            </table>
     </div>
    </body>

</html>

<!-- end:   header -->

<!-- begin: main_container  -->
    <input type="hidden" id="user_id" value="{user_id}">
    <input type="hidden" id="session_id" value="{session_id}">
    <script>
       
        $(document).ready(  main_layout_ready );
        source_editor_tabbar.adjustSize(); // adjust de Center Panel size
        // Here we can load files in source code editor

       registerLoad();  
       // Save current file
       setInterval("save_current_file(true);",90000);
       setInterval("parse_code();",60000);
       setTimeout("verifyInvitation();",8000); //setTimeout("verifyInvitation();",180000);
    </script>


<!-- end:   main_container -->


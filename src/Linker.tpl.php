
<!-- begin: files_script_decorator noeval -->
 <script type="text/javascript" src="../js/tree/jquery.simple.tree.js"></script>
 <link rel="StyleSheet" href="../css/jquerytree.css" type="text/css">

 <link rel="StyleSheet" href="../css/jquery.contextMenu.css" type="text/css">
 <script type="text/javascript" src="../js/jquery.contextMenu.js"></script>

		<ul id="file_context_menu" class="contextMenu">
			<li class="edit"><a href="#edit">Edit</a></li> 
			<li class="delete"><a href="#delete">Delete</a></li>
            <li class="rename"><a href="#rename">Rename</a></li>
		  	<li class="quit separator"></li>
			<li class="svn_add" ><a  href="#svn_add">SVN Add</a></li>
            <li class="svn_update" ><a  href="#svn_update">SVN Update</a></li>
            <li class="svn_status" ><a  href="#svn_status">SVN Status</a></li>
            <li class="svn_commit" ><a  href="#svn_commit">SVN Commit</a></li>
            <li class="svn_diff" ><a  href="#svn_diff">SVN Diff</a></li>
		</ul>

<script>
    function fo( context ){
       var item = "#".concat(context); 
       $( item ).fadeOut(8000);
    }

    function xpath ( selector ){
       var retval_ = [], xpath_ = "" ;
       $(selector).each( function (){
         var e = this ;
         do {
              xpath_ = (e.id ? "" + e.id +"/" : "")  + xpath_ ;
              e = e.parentNode ;
         } while ( e.nodeType !== 9 )
          retval_.push(""+xpath_) ;

    });
      return retval_ ;
    }
    var simpleTreeCollection;
    $(document).ready(function(){
        simpleTreeCollection = $(".simpleTree").simpleTree({
            autoclose: true,
            afterClick:function(node){
               var fullpath = xpath( $('span:first',node) ).toString().substring(18);
               
               if(fullpath.toString().length > 2){ // Is a file
                   var length = fullpath.toString().length;
                   var fullfile = fullpath.toString().substring(0, length -1);
                   var sp = fullfile.toString().split("/");
                   var file = sp[sp.length-1].toString();

                   var regex =new RegExp("[/,\,.]", "g"); // replace /\. with _
                   var replac  =  file.replace(regex, "_"); 
                   
                   var context = "#".concat(replac);
                   $( context ).fadeIn("fast");
                   $( context ).mouseover( function(){
                       $( context ).fadeIn("fast");
                   });

                   //$( context ).blur().removeClass("file_context_menu");
                   $( context ).contextMenu({
                          menu: 'file_context_menu' 
                   },
                   function(action, el, pos) {
                       //var fullpath = xpath( $('span:first',node) ).toString().substring(18);
                       if(action === 'edit'){
                           loadFile(fullfile, file );
                       }if(action === 'rename'){
                          // rename(fullfile, file );
                          alert(
						'Action: ' + action + '\n\n' +
						'Element ID: ' + $(el).attr('id') + '\n\n' +
						'X: ' + pos.x + '  Y: ' + pos.y + ' (relative to element)\n\n' +
						'X: ' + pos.docX + '  Y: ' + pos.docY+ ' (relative to document)'+
                        'current_file: '+current_file
						);
                       }else if(action === 'delete'){
                           deleteFile(fullfile, file );
                       }else if(action === 'svn_add'){
                           svn_add(fullfile, file );
                       }else if(action === 'svn_update'){
                           svn_update(fullfile, file );
                       }else if(action === 'svn_status'){
                           svn_file_status(fullfile, file );
                       }else if(action === 'svn_commit'){
                           svn_commit_file(fullfile, file );
                       }else if(action === 'svn_diff'){
                           svn_diff_file(fullfile, file );
                       }
                     /* alert(
						'Action: ' + action + '\n\n' +
						'Element ID: ' + $(el).attr('id') + '\n\n' +
						'X: ' + pos.x + '  Y: ' + pos.y + ' (relative to element)\n\n' +
						'X: ' + pos.docX + '  Y: ' + pos.docY+ ' (relative to document)'+
                        'current_file: '+current_file
						); */
				});


               }
            },

            
            
            afterDblClick:function(node){
               var fullpath = xpath( $('span:first',node) ).toString().substring(18);

               if(fullpath.toString().length > 2){ // Is a file
                   var length = fullpath.toString().length;
                   var fullfile = fullpath.toString().substring(0, length -1);
                   var sp = fullfile.toString().split("/");
                   var file = sp[sp.length-1].toString(); 
                   loadFile(fullfile, file );
               }
            },
            afterMove:function(destination, source, pos){

            },
            afterAjax:function(){

            },
            animate:true
            //,docToFolderConvert:true
        });
    });
    
    
</script>
<!-- end:  files_script_decorator --> 



<!-- begin: show_adduser_window_header -->

 <script type="text/javascript" src="../js/jquery.js"></script>
 <script type="text/javascript" src="../js/jquery.selectboxes.min.js"></script>
 <link rel="StyleSheet" href="../css/style.css" type="text/css">
 <input type="hidden" id="project" value="{prname}">  
<table border="1" width="100%">
<tr>
    <td width="35%" height="100%" >
       <label class="label"> &nbsp; Project ({prname}) members </label>
       <ul>
<!-- end:   show_adduser_window_header -->

         <!-- begin: show_adduser_li -->
             <li id="{pruser_id}">
                <img src="../images/{image}" height="26" width="26">
                <label class="label"> [{rol}] </label> -<label style="color:green;font-size:12px;font-weight:bolder">  {username} </label><br>
                <label class="label"> {desc} - ({state}) </label>
                <input type="button" class="button"  value="{value}" onclick="{fn}" >
                {remove}
             </li>
          <!-- end:  show_adduser_li  -->

<!-- begin: show_adduser_body noeval -->
       </ul>
    </td>
    <td width="65%"  >
        <table border="0" width="100%" cellspacing="1" cellpadding="1">
             <tr class="zebra0">
              <td colspan="3" height="35px"  align="center" ><label id="msg"> </label>  <label id="userdata"> </label>    </td>
             </tr>
            <tr class="zebra1">
              <td width="50%" > <img src="../images/adduser.jpg" height="28" width="28"> <label class="label"> Enter username (Nick): </label> </td>
              <td>  <input class="textfield" maxlenght="25" type="text" id="nick" value="" size="24"   /> </td>
               <td> <input type="button" class="button" value="Search" onclick="searchUser()" >
              </td>
            </tr>
            <tr class="zebra0">
              <td height="30px"> <label  class="label"> Role: </label>   </td>
              <td  colspan="2"  >

                   <select id="roles" class="combobox" disabled=true >
                    <!-- end:  show_adduser_body -->

                      <!-- begin: roles -->
                        <option value="{rol}">{desc}</option>
                      <!-- end:  roles -->

                    <!-- begin: show_adduser_footer noeval -->
                   </select>
              </td>
            </tr>
            <tr class="zebra1">
             <td  > <label  class="label">Rol description: </label>    </td>
             <td colspan="2" > <input type="text" id="descrip" maxlength="60" size="30" class="textfield" disabled=true >  </td>
            </tr>
            <tr class="zebra0">
              <td height="36px" colspan="3" align="center">
                <input id="adduser" type="button" class="button" onclick="addUser()"  value="Add this user to project" disabled="true" >
              </td>
            </tr>
        </table>
    </td>
</tr>
<tr > <td height="35px" colspan="2" align="center"> <input type="button" class="button"  value="   Back   " onclick="parent.useradd.close();"> </td> </tr>
</table>

<script>
    var id = 0;
    function searchUser(){ 
    var nick = $("#nick").val();
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=get_user_data&username="+nick+"",
        beforeSend: function(objeto){
            $("#msg").html("<label class='info'>Searching user</label><img src='../images/progress_small.gif' height='8px' width='30px'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
              var res =  objeto.responseText.replace(/^\s+|\s+$/g,"");
              if(res === 'false'){
                  $("#msg").html("<label class='display_error'>User not found...</label>");
                  $("#userdata").html("");
                  $("#adduser").attr("disabled", "true");
                  $("#roles").attr("disabled", "true");
                  $("#descrip").attr("disabled", "true");
              }else{
                  var user = objeto.responseText.split(",");
                  id = user[0].replace(/^\s+|\s+$/g,"");
                  var nick = user[1];
                  var nombre = user[2];
                  var apellido = user[3];
                  $("#msg").html("<label class='info'>User  found</label>");
                  $("#userdata").html("<label class='msggrensmall'>"+ nombre.concat(" ",apellido)+" </label>");
                  $("#adduser").removeAttr("disabled");
                  $("#roles").removeAttr("disabled");
                  $("#descrip").removeAttr("disabled");
              }
            }
        }
    });
    }

    function addUser(){
        //var s = $("#roles").selectedTexts();
        var rol  = $("#roles").val();
        var project  = $("#project").val();
        var descrip  = $("#descrip").val();
        $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=add_user_to_project&user_id="+id+"&rol="+rol+"&descrip="+descrip+"&project="+project+"",
        beforeSend: function(objeto){
            $("#msg").html("<label class='info'>Adding user to project</label><img src='../images/progress_small.gif' height='8px' width='30px'>");
            $("#adduser").attr("disabled", "true");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
               $("#msg").html(objeto.responseText);
                parent.useradd.progressOn();
                setTimeout("reloadWindow()",3000);
            }
        } 
        });
    }
    function reloadWindow(){
        var project  = $("#project").val();
        parent.useradd.attachURL("../src/Linker.class.php?action=show_useradd_window&project="+project);
    }
    function lockUnlockUser(user_id, project_id, lock_unlock){
        $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=lock_unlock_user&user_id="+user_id+"&project_id="+project_id+"&lock_unlock="+lock_unlock,
        beforeSend: function(objeto){
            $("#msg").html("<label class='info'>Processing user state...</label><img src='../images/progress_small.gif' height='8px' width='30px'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
               $("#msg").html(objeto.responseText);
                parent.useradd.progressOn();
                setTimeout("reloadWindow()",3000);
            }
        }
        });
    } 
    setTimeout("parent.useradd.progressOff()",1500);
</script>
<!-- end:  show_adduser_footer -->

<!-- begin: invitation_popup noeval -->
<style>
#popup_message {
   z-index:2;
   position:absolute;
   border: 2px solid #6699FF ;
   text-align:center;
   background:white;
}
#popup_closed {
   float:right;
   margin-right:4px;
   cursor:pointer;
   font:Verdana, Arial, Helvetica, sans-serif;
   font-size:12px;
   font-weight:bold;
   color:#FFFFFF;
   border: 1px solid #6699FF ;
   background-image: url(../images/tabbar/bottom/dark/close.gif);
   width:14px;
   position:relative;
   margin: 2px 2px 2px 2px;
   text-align:center;
}
</style>

<script>
    function acceptDecline(user_id, project_id, accept_decline){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=accept_decline&user_id="+user_id+"&project_id="+project_id+"&accept_decline="+accept_decline,
        beforeSend: function(objeto){
            $("#msg").html("<label class='info'>Procesing...</label><img src='../images/progress_small.gif' height='8px' width='30px'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
               $("#msg").html('');
               $("#pop_label").html(objeto.responseText);
               $("#accept").fadeOut("slow");
               $("#decline").fadeOut("slow");
            }
        }
        });
    }
</script>


<!-- end: invitation_popup -->

<!-- begin: invitation_script noeval -->
<script>
    function mostrar() {
       $("#popup_message").fadeIn('slow');
    }

   //Conseguir valores de la img
   var img_w = $("#popup_message img").width() + 10;
   var img_h = $("#popup_message img").height() + 90;

   //Darle el alto y ancho
   $("#popup_message").css('width', img_w + 'px');
   $("#popup_message").css('height', img_h + 'px');

   //Esconder el popup
   $("#popup_message").hide();
    //Consigue valores de la ventana del navegador

   var h = $(this).height();

   //Centra el popup
   var w =  0 ;
   h =  h  - (img_h + 97);
   $("#popup_message").css("left",w + "px");
   $("#popup_message").css("top",h + "px");
   setTimeout("mostrar()",1500);

   $("#popup_closed").click(function (){
      $("#popup_message").fadeOut('slow');
   });
 
</script>

<!-- end:  invitation_script -->


<!-- begin: popup_content -->
   <div id="popup_message"  >
       <div id="popup_closed">&nbsp;</div>
       <img  id="fondo" src="../images/skysilver.png" height="1" width="230" border="0"><br>&nbsp;
       <label id="pop_label" class="label">&nbsp;You has invited to participate as {rol} in project: {prname} </label> <br>&nbsp;
       <input type="button" class="button" value="Accept" id="accept" onclick="{fna}">
       <input type="button" class="button" value="Decline" id="decline" onclick="{fnd}">
   </div>

<!-- end:   popup_content -->


<!-- begin: redirect_form -->
    <FORM  ACTION="{users_path}/{user}/src/Linker.class.php" name="redirection_form"   method="post">
    <input type="hidden" id="action" name="action"  value="showIDE">
     <input type="hidden" id="username" name="username"  value="{user}" >
     <input type="hidden"  id="password" name="password" value="{passw}" > 
    </FORM>
   
<!-- end:   redirect_form -->




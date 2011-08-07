 
<!-- begin: new_project -->

<div class="info" align="center">

    <label > {project_exist} </label><br>
    <a href="javascript:create_project()" > <small> Create new Project </small> </a>

</div>

<div id="new_proj_window" align="center" style="display:none;"  >
    <table border="0"  width="100%" height="100%" >
        <tr class="zebra1">
            <td height="8px" colspan="2">&nbsp;</td>
        </tr>
        <tr class="zebra0">
            <td align="left">  <label class="label" >Project name: </label>     </td>
            <td align="left"><input type="text" class="textfield"  maxlength="40" size="30" id="new_project_name" onblur="checkProject()"> <label id="msg_name">  </label> </td>
        </tr>

        <tr class="zebra1">
            <td align="left">  <label class="label" >Host: </label> </td>
            <td align="left"><input type="text" class="textfield"  size="60" maxlength="200"  id="host"></td>
        </tr>
        <tr class="zebra0">
            <td align="left"> <label class="label" >Host main path : </label> </td>
            <td align="left"><input type="text" class="textfield"   size="60" maxlength="200" id="host_main_path" value="/var/www/"></td>
        </tr>
        <tr class="zebra1">
            <td align="left">  <label class="label" >Host port : </label>  </td>
            <td align="left"> <input type="text" class="textfield"  size="10" maxlength="10"  id="host_port" value="52000" ></td>
        </tr>

        <tr class="zebra0">
            <td align="left">  <label class="label" >Index file : </label>  </td>
            <td align="left"> <input type="text" class="textfield"  size="60" maxlength="200"  id="index_file" value="index.php" ></td>
        </tr>
        <tr class="zebra1">
            <td align="center" height="40px"  colspan="2"> 
                <input type="button" class="button" onclick=windows.window("pr").close(); value="Cancel">
                <input type="button" class="button" onclick="create_new_project()"  value="Create" id="create" disabled="true">
            </td>
        </tr>
        <tr>
            <td height="8px">&nbsp;</td>
        </tr>
    </table>
</div>

<!-- end:  new_project -->

<!-- begin: ul -->
    <ul >
<!-- end:  ul -->

<!-- begin: /ul -->
    </ul>
<!-- end:  /ul -->

<!-- begin: liul_project -->
  
   <li id="{pr_id}" class="project_list" value="{pr_name}" onmouseup="" onclick=getProjectFiles("{pr_id}","{pr_name}"); >
   <a href="#" style="text-decoration:none" >{pr_name} </a>
     <span id="context_{pr_name}" title="Right click for project properties"  style="position: absolute;left:60%; width: 18px; height: 18px; border: #C1C1C1 0px solid;  background-image: url(../images/fileproperties.png); background-repeat: no-repeat;">  </span>
   </li>
  
    <div id="contextMenuData" style="display: none;">
            <div id="add_file" text="Add File" img="../images/menu/default/new.gif" imgdis="new_dis.gif"> </div>
            <div id="separator" type="separator"></div>
            <div id="add_dir" text="Add Folder"  img="../images/menu/default/folder_add.png" > </div>
            <div id="download" text="Download Project"  img="../images/Download-Folder.png" > </div>
            {show_delete}
            <div id="separator2" type="separator"></div>
            {show_membership}
            
            <div id="separator3" type="separator"></div>
            <div id="svn_add" text="SVN Add" img="../images/menu/default/add.png" > </div>
            <div id="svn_checkout" text="SVN Checkout" img="../images/svn_checkout.png" > </div>
            <div id="svn_status" text="SVN Status" img="../images/status.png" > </div>
            <div id="svn_list" text="SVN List" img="../images/list.png" > </div>
            <div id="separator4" type="separator"></div>
            <div id="properties" text="Properties" img="../images/properties.png"> </div>
    </div>
    <script>
        var p_menu = new dhtmlXMenuObject("context_{pr_name}", skin );
        p_menu.renderAsContextMenu();
        p_menu.setImagePath("../images/menu/")
        p_menu.loadFromHTML("contextMenuData", true );
        p_menu.attachEvent("onClick", events );
    </script>
<!-- end:  liul_project -->

<!-- begin: menu_events noeval -->
    <script>
        events =  function(id, zoneId){
           var project = zoneId.toString().substring(8, zoneId.toString().length);

           if(id === "delete_project" ){
              deleteProject(project);
           }else if(id === "add_file" ){
              createNewFile(project);
           }else if(id === "add_dir" ){
              createNewFile(project);
           }else if(id === "download" ){
              downloadProject(project);
           }else if(id === "svn_add" ){
              svn_add_project(project);
           }else if(id === "svn_checkout" ){
              svn_checkout(project);
           }else if(id === "svn_status" ){
              svn_status(project);
           }else if(id === "svn_list" ){
              svn_list(project);
           }else if(id === "properties" ){
              project_properties(project);
           } else if(id === "membership" ){
              project_add_user(project);
           }
         }
    </script>
<!-- end:   menu_events -->

<!-- begin: liul_project_add_file -->
   <li id="{pr_id}" class="project_list" value="{pr_name}"  onclick=goHref("{user_id}","{pr_name}"); > <a href="#">{pr_name} </a>   </li>
<!-- end:  liul_project_add_file -->


<!-- begin: properties -->
<link rel="StyleSheet" href="../css/style.css" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script> <!-- 1.2.6 -->

<div id="new_proj_window" align="center"   >
    <table border="0"  width="100%" height="100%" >
        <tr class="zebra1">
            <td height="8px" colspan="2" align="center"> <span id="msg" > </span>  </td>
        </tr>
        <tr class="zebra0">
            <td align="left">  <label class="label" >Project name: </label>     </td>
            <td align="left"><input type="text" class="textfield" value="{proj_name}" disabled  maxlength="40" size="30" id="new_project_name" > <label id="msg_name">  </label> </td>
        </tr>

        <tr class="zebra1">
            <td align="left">  <label class="label" >Host: </label> </td>
            <td align="left"><input type="text" class="textfield"  value="{host}" size="60" maxlength="200"  id="host"></td>
        </tr>
        <tr class="zebra0">
            <td align="left"> <label class="label" >Host main path : </label> </td>
            <td align="left"><input type="text" class="textfield"   size="60" maxlength="200" id="host_main_path" value="{host_main_path}"></td>
        </tr>
        <tr class="zebra1">
            <td align="left">  <label class="label" >Host port : </label>  </td>
            <td align="left"> <input type="text" class="textfield"  size="10" maxlength="10"  id="host_port" value="{port}" ></td>
        </tr>

        <tr class="zebra0">
            <td align="left">  <label class="label" >Index file : </label>  </td>
            <td align="left"> <input type="text" class="textfield"  size="60" maxlength="200"  id="index_file" value="{index}" ></td>
        </tr>
        <tr class="zebra1">
            <td align="center" height="40px"  colspan="2">
                <input type="button" class="button" onclick=parent.windows.window("properties").close(); value="Back">
                <input type="button" class="button" onclick="update_project()"  value="Update" id="update"  >
            </td>
        </tr>
        <tr>
            <td height="8px">&nbsp;</td>
        </tr>
    </table>
</div>
<!-- end:   properties -->

<!-- begin: update_script noeval -->
  <script >
     function update_project(){

        var name = $("#new_project_name").val();
        var host = $("#host").val();
        var hmpath = $("#host_main_path").val();
        var port = $("#host_port").val();
        var index_file = $("#index_file").val();

        $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=update_project&name="+name+"&host="+host+"&hmpath="+hmpath+"&port="+port+"&index_file="+index_file,

            beforeSend: function(objeto){
                $("#msg").html("<label class=info >Saving project... </label><img src='../images/progress_small.gif' height='8px' width='40px'>");
            }, 
            complete: function(objeto, exito){  
                $("#msg").html("<label class=info >Project saved... </label>");
                setTimeout('parent.windows.window("properties").close()',2500);
            }
        });
    }
  </script>
<!-- end:  update_script -->



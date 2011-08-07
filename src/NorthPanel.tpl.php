 

<!-- begin: north_container_header noeval -->
<div class="ui-layout-north pane pane-north open" pane="north" style="visibility: visible; display: block; position: absolute; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; z-index: 2; bottom: auto; width: auto; top: 0px; left: 0px; right: 0px; height: 111px; overflow-x: hidden; overflow-y: hidden;  ">
    <!--  <div  id="menuObj" style="text-align: left;" class="header2" style="overflow-x: auto; overflow-y: auto; height: 15px; ">
    overflow-x: hidden; overflow-y: hidden;  -->
    <div id="message" class="message"  style="opacity:0;" onclick="cerrarPopup()"> </div>
    <div  id="menuObj" ></div>
    <script>
        menu = new dhtmlXMenuObject("menuObj", skin );
        menu.setImagePath("../images/menu/");
        // Help
        menu.addNewSibling(null, "help", "Help", false);
          menu.addNewChild("help", 0, "help_contents", "Help Contents", false, "../images/help.png");
          menu.setHotKey("help_contents", "Ctrl+H");
          menu.addNewChild("help", 1, "about", "About", false, "");
        // Tools
        menu.addNewSibling(null, "tools", "Tools", false);
          menu.addNewChild("tools", 0, "js_console", "Javascript console", false, "../images/js_console.gif");
          //menu.setHotKey("js_console", "Ctrl+J");

          menu.addNewChild("tools", 0, "log_viewer", "Log Viewer", false, "../images/log.gif");
          menu.setHotKey("log_viewer", "Ctrl+L");

        // View
        menu.addNewSibling(null, "view", "View", false);
          // Panes
          menu.addNewChild("view", 0, "view_panes", "Panes", false, null);
              menu.addNewChild("view_panes", 0, "pane_north", "North", false, "../images/menu/default/north.gif");
              menu.addNewChild("view_panes", 1, "pane_east", "East", false, "../images/menu/default/east.gif");
              menu.addNewChild("view_panes", 2, "pane_west", "West", false, "../images/menu/default/west.gif");
              menu.addNewChild("view_panes", 3, "pane_south", "Sourth", false, "../images/menu/default/south.gif");
              menu.addNewChild("view_panes", 4, "panes_all", "All Panes", false, "../images/menu/default/all_panes.gif");
        
        //Edit
        menu.addNewSibling(null, "edit", "Edit", false);
          menu.addNewChild("edit", 0, "pref", "Preferences", false );
          menu.addNewChild("edit",1, "close_all", "Close All Documents", false );
         
          
          menu.addNewChild("edit",2, "profile", "Profile", false);
              menu.addNewChild("profile",2, "edit_profile", "Edit Profile", false ,"../images/user.png");
              menu.addNewChild("profile",2, "change_passw", "Change Password", false ,"../images/passw.gif");
         
        
         menu.addNewChild("edit",3, "add_files", "Add Local files to project", false,"../images/upload.jpg" );
          
         menu.addNewChild("edit",4, "download", "Download Project as tar.gz", false ,"../images/download.jpg");
         menu.addNewChild("edit",5, "properties", "Project Properties", false ,"../images/fileproperties.png");
         
         
         menu.addNewSeparator("profile", "prof");// Insertar separadores por ultimo

        // File
        menu.addNewSibling(null, "file", "File", false);
          // Project
          menu.addNewChild("file", 0, "new_project", "New Project", false, "../images/menu/default/new_project.gif");
          //menu.setHotKey("new_project", "Shift+N");
          // New File
          menu.addNewChild("file",1, "new_file", "New File", false, "../images/menu/default/new.gif");
          //menu.setHotKey("new_file", "Ctrl+N");
          // Save
          menu.addNewChild("file", 2, "save", "Save", false, "../images/menu/default/save.gif", "../images/menu/default/save_dis.gif")
          menu.setHotKey("save", "Ctrl+S");
          //Print
          menu.addNewChild("file", 2, "print", "Print", false, "../images/print.gif", "../images/print.gif")
          menu.setHotKey("print", "Ctrl+P");
          // Exit
          menu.addNewChild("file", 6, "exit", "Exit", false, "../images/quit.png");
          //menu.setHotKey("exit", "Ctrl+X");



        menu.attachEvent("onClick", function(id) {
           if(id === "new_file" ){
              createNewFile(undefined);
           }else if(id === "about" ){
              about();
           }else if(id === "log_viewer"){
             viewLog();
           }else if(id === "exit" ){
              logOut();
           }else if(id === "new_project" ){
              create_project();
           }else if(id === "save" ){
             save_current_file(false);
           }else if(id === "close_all" ){
             closeAllFiles();
           }else if(id === "add_files" ){
             addLocalFiles();
           }else if(id === "download" ){
             downloadProject(current_project);
           }else if(id === "properties" ){
             project_properties(current_project);
           }else if(id === "edit_profile" ){
             editProfile();
           }else if(id === "change_passw" ){
             changePassword();
           }else if(id === "pref" ){
             userPreferences();
           }else if(id === "js_console" ){
             view_js_console();
           }else if(id === "pane_north"){
              $("#tbarToggleNorth").click();
           }else if(id === "pane_south"){  
               $("#tbarOpenSouth").click();
           }else if(id === "pane_east"){
               $("#tbarPinEast").click();
           }else if(id === "pane_west"){
               $("#tbarPinWest").click();
           }else if(id === "panes_all"){ 
               $("#tbarOpenSouth").click();
               $("#tbarPinWest").click();
               $("#tbarPinEast").click();
           }
        });

    </script>
<!-- end:   north_container_header -->

<!-- begin: north_container_body -->
     <table  width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="75%">
           <UL class="toolbar">
                <LI id="tbarToggleNorth" class="first button-toggle button-toggle-north" title="Close North Panel"><SPAN  title="Close North Panel"></SPAN></LI>
                <LI id="tbarOpenSouth" class="button-open button-open-south" title="Open South Panel"><SPAN  title="Open South Panel"></SPAN>   </LI>
                <LI id="tbarCloseSouth"  class="button-close button-close-south" title="Close South Panel"><SPAN title="Close South Panel"></SPAN>   </LI>
                <LI id="tbarPinWest" class="button-pin button-pin-west button-pin-down button-pin-west-down" pin="down" title="Un-Pin"><SPAN TITLE="Open/Close West Panel"></SPAN>   </LI>
                <LI id="tbarPinEast" class="last button-pin button-pin-east button-pin-down button-pin-east-down" pin="down" title="Un-Pin"><SPAN TITLE="Open/Close East Panel"></SPAN> </LI>
                <LI><SPAN STYLE="WIDTH:60px;"></SPAN> </LI>
                <LI style="padding: 0px 0px 0px 0px;"> <input type="text" id="search_field" class="textfield" size="24" maxlength="100" >  </LI>
                <LI STYLE="background-image:url(../images/search.png);background-repeat:no-repeat;"  ONCLICK="search()" VALUE="Search" TITLE="Search"><SPAN></SPAN> </LI>
                <LI STYLE="background-image:url(../images/cut.png);background-repeat:no-repeat;"  ONCLICK="cut()"  VALUE="Cut" TITLE="Cut" > <SPAN>   </SPAN> </LI>
                <LI STYLE="background-image:url(../images/undo.png);background-repeat:no-repeat;" ONCLICK="undo()" VALUE="Cut" TITLE="Undo"> <SPAN>   </SPAN> </LI>
                <LI STYLE="background-image:url(../images/redo.png);background-repeat:no-repeat;" ONCLICK="redo()" VALUE="Cut" TITLE="Redo"> <SPAN>   </SPAN> </LI>
                <LI STYLE="background-image:url(../images/replace.png);background-repeat:no-repeat;" ONCLICK="replace()" VALUE="Replace" TITLE="Replace"><SPAN></SPAN> </LI>
                <LI STYLE="background-image:url(../images/charp.png);background-repeat:no-repeat;"ONCLICK="line()" VALUE="Line" TITLE="Line"><SPAN> </SPAN> </LI>
                <LI STYLE="background-image:url(../images/jump.png);background-repeat:no-repeat;" ONCLICK="jump()" VALUE="Jump" TITLE="Jump"><SPAN> </SPAN> </LI>
                <LI STYLE="background-image:url(../images/indent.png);background-repeat:no-repeat;" ONCLICK="reindent()" VALUE="Indent" TITLE="Indent"><SPAN></SPAN> </LI>
                <LI STYLE="background-image:url(../images/run.png);background-repeat:no-repeat;" ONCLICK="runProject()" VALUE="Indent" TITLE="Run Project"><SPAN></SPAN> </LI>
                <LI STYLE="background-image:url(../images/compile.png);background-repeat:no-repeat;" ONCLICK="syntax_check(null)" VALUE="Indent" TITLE="Compile File"><SPAN></SPAN> </LI>

           </UL>
         </td>
         <td width="25%"  style="background: #D6D6D6 url(../images/d6d6d6_40x100_textures_02_glass_80.png) repeat-x scroll 0pt 50%"  >
                <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr  >
                       <td  width="73%" height="24px" align="center" > <label  id="msg"></label> </td>
                       <td  width="20" align="right" ><label class="msggrensmall" title="{user_title}" >{username}</label>  </td>
                       <td  width="7%" align="center" id="flag"><img src="../images/flags/{flag}.gif" title="{flag_name}"></td>
                     </tr>
                </table>
         </td>
     </tr>
  </table>
 
 </div>



<!-- end:   north_container_body -->








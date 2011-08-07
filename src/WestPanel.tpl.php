

<!-- begin: west_container_header -->
<DIV class="ui-layout-west pane pane-west closed" pane="west" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; right: auto; width: 248px; overflow-x: hidden; overflow-y: hidden; visibility: visible; display: block; position: absolute; left: 0px; z-index: 2; top: 113px; bottom: 0px; height: 746px; ">
     <SPAN id="west-closer" class="button-close button-close-west" title="Close"></SPAN>
     <SPAN class="pin-button button-pin button-pin-west button-pin-down button-pin-west-down" pin="down" title="Un-Pin"></SPAN>
     <DIV class="header"><label id="west_header" class="msg" style="overflow-x: hidden; overflow-y: hidden;">Projects - Files </label> </DIV>
<!-- end:   west_container_header -->


<!-- begin: west_container_footer -->
     <div  id="popmsg" ></div>
   	<DIV class="footer">
      <input type="button" class="button" value="Refresh" onclick="parent.getProjectFiles( parent.current_project_id, parent.current_project )" >
     </DIV>

 </DIV>
<!-- end:   west_container_footer -->
 
<!-- begin: tabs -->
      <div id="west_tabbar" style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; right: 0px; overflow-x: hidden; overflow-y: hidden; width: 300px; visibility: visible; display: block; position: relative; z-index: 2; right: auto; top:1px; bottom:50px; height: 90%; " > </div>
<!-- end:   tabs -->


<!-- begin: projects_header -->
       <div id="projects_list"  style="width: 100%; height:100%; background-color:#f5f5f5; border :1px solid Silver; ">
 
<!-- end: projects_header -->

      
<!-- begin: projects_footer -->
       </div>
      
<!-- end:  projects_footer -->
 

<!-- begin: files -->
      <div id="files" style="width:100%; height:100%;" >
 
      </div>
<!-- end: files -->


<!-- begin: decorator_script -->

	<script>
            west_tabbar=new dhtmlXTabBar("west_tabbar","top","20");
            west_tabbar.setImagePath("../images/tabbar/");
            west_tabbar.setStyle(skin);
  
            west_tabbar.enableAutoSize(true,true);
            // west_tabbar.enableTabCloseButton(true);
			west_tabbar.enableAutoReSize(true);
            
			//tabbar.setSkinColors("#FCFBFC","#F4F3EE","#FCFBFC");
			west_tabbar.addTab("projects","Projects","100px");
			west_tabbar.addTab("files","Files","100px");

			west_tabbar.setContent("projects","projects_list");
			west_tabbar.setContent("files","files");
            
			west_tabbar.setTabActive("projects");
            //west_tabbar.enableScroll(true);


	</script>

<!-- end:   decorator_script -->








<!-- begin: header -->

<DIV id="mainContent" pane="center" class="pane pane-center open"
style="visibility: visible; padding: 0px; display: block; position: absolute; margin-top: 0px;
margin-right: 0px; margin-bottom: 0px; margin-left: 0px; z-index: 2; top: 113px;
bottom: 0px; left: 256px; right: 299px; width: 693px; height: 716px; ">

 <div id="source_editor_tab" style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px;height:100%;width:100%; " ></div>
</DIV>
<!-- end:   header -->
 

<!-- begin: decorator_script noeval -->

 	<script>       

            // Config
            //@todo: configure tabbar to user choose option top or bottom
            source_editor_tabbar=new dhtmlXTabBar("source_editor_tab","top","20");
            source_editor_tabbar.setImagePath("../images/tabbar/");
            source_editor_tabbar.setStyle( skin );
            
            source_editor_tabbar.enableAutoSize(true,true);
           
            source_editor_tabbar.enableTabCloseButton(true);
			source_editor_tabbar.enableAutoReSize(true); 

			source_editor_tabbar.addTab("start_page","Start Page","100px");
            source_editor_tabbar.setContent("start_page", "start_page_content");

            source_editor_tabbar.setHrefMode("ajax-html");
            source_editor_tabbar.setSize(1024, 760, true);  
            source_editor_tabbar.setTabActive("start_page"); 
            source_editor_tabbar.enableScroll(true);
            source_editor_tabbar.adjustSize();


            // Events

            function tab_click(new_file_tab,last_file_tab){
                current_file = new_file_tab;
                var regex =new RegExp("[/,\,.]", "g"); // replace /\. with _
                   var length = new_file_tab.toString().length;
                   var fullfile = new_file_tab.toString().substring(0, length );
                   var sp = fullfile.toString().split("/");
                   var file = sp[sp.length-1].toString();
                   current_filename_relaced = file.replace(regex, "_");

                   // Make like a thread
                   setTimeout("parse_code()",50);
                   syntax_check(current_file);
                   //window.console.log (' current_filename_relaced ' + current_filename_relaced );
                return true;
            }
            source_editor_tabbar.setOnSelectHandler( tab_click );
            
            source_editor_tabbar.attachEvent("onTabClose", function(id){ 
                closeFile(id);
            });



	</script>

<!-- end:   decorator_script -->
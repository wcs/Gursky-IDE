

<!-- begin: east_container_header -->
<DIV class="ui-layout-east pane pane-east closed" pane="east" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; right: 0px; overflow-x: hidden; overflow-y: hidden; width: 291px; visibility: visible; display: block; position: absolute; z-index: 2; left: auto; top: 113px; bottom: 0px; height: 86%; "><SPAN id="east-closer" class="button-close button-close-east" title="Close"></SPAN><SPAN class="pin-button button-pin button-pin-east button-pin-down button-pin-east-down" pin="down" title="Un-Pin"></SPAN>

	<DIV class="header" ><label id="east_header" class="msg" > Templates </label></DIV>

	<DIV id="accordObj"  class="content" style="overflow-x: auto; overflow-y: hidden; height:90%;"></DIV>

	<DIV class="footer">
    <label class="label" id="active_tpl">functions</label>
      <input type="button" class="button" value="  Dock  " onclick="dock()">
      <input type="button" class="button" value="Undock" onclick="undock()">
    </DIV>
 
</DIV>
 <div id="html_template">
   <ul>
     <li style="list-style-type: none; background: url(../images/html_templates/table.gif) no-repeat left; padding-left: 30px;">
         <div id="el_table"  onclick="mk_table()"     onmouseover=li_over("#el_table") onmouseout=li_out("#el_table") style="font-size:12px;font-weight:bolder; height:20px">Table </div></li>
     <li style="list-style-type: none; background: url(../images/html_templates/orderedlist.gif) no-repeat left center; padding-left: 30px;">
         <div id="el_orderedlist" onclick="mk_ol()" onmouseover=li_over("#el_orderedlist") onmouseout=li_out("#el_orderedlist") style="font-size:12px;font-weight:bolder; height:20px">Ordered List</div></li>
     <li style="list-style-type: none; background: url(../images/html_templates/unorderedlist.gif) no-repeat left center; padding-left: 30px;">
         <div id="el_unorderedlist" onclick="mk_ul()" onmouseover=li_over("#el_unorderedlist") onmouseout=li_out("#el_unorderedlist") style="font-size:12px;font-weight:bolder; height:20px">Unordered List</div></li>
     <li style="list-style-type: none; background: url(../images/html_templates/image.gif) no-repeat left center; padding-left: 30px;">
         <div id="el_image"  onclick="mk_image()"  onmouseover=li_over("#el_image") onmouseout=li_out("#el_image") style="font-size:12px;font-weight:bolder; height:20px">Image</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/link.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_link" onclick="mk_link()" onmouseover=li_over("#el_link") onmouseout=li_out("#el_link") style="font-size:12px;font-weight:bolder; height:20px">Link</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/meta.gif) no-repeat left center; padding-left: 30px;">
          <div   id="el_metadata"onclick="mk_meta()" onmouseover=li_over("#el_metadata") onmouseout=li_out("#el_metadata") style="font-size:12px;font-weight:bolder; height:20px">Metadata</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/form.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_form" onclick="mk_form()" onmouseover=li_over("#el_form") onmouseout=li_out("#el_form") style="font-size:12px;font-weight:bolder; height:20px">Form</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/inputtext.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_inputtext" onclick="mk_textImput()" onmouseover=li_over("#el_inputtext") onmouseout=li_out("#el_inputtext") style="font-size:12px;font-weight:bolder; height:20px">Text Input</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/multilineinput.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_multiline" onclick="mk_multiline()" onmouseover=li_over("#el_multiline") onmouseout=li_out("#el_multiline") style="font-size:12px;font-weight:bolder; height:20px">Multi-Line Input</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/dropdownlist.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_dropdown" onclick="mk_dropdown()" onmouseover=li_over("#el_dropdown") onmouseout=li_out("#el_dropdown") style="font-size:12px;font-weight:bolder; height:20px">Drop Down List</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/checkbox.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_check" onclick="mk_check()" onmouseover=li_over("#el_check") onmouseout=li_out("#el_check") style="font-size:12px;font-weight:bolder; height:20px">Checkbox</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/radiobutton.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_radio" onclick="mk_radio()" onmouseover=li_over("#el_radio") onmouseout=li_out("#el_radio") style="font-size:12px;font-weight:bolder; height:20px">Radio Button</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/fileselect.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_file" onclick="mk_file()" onmouseover=li_over("#el_file") onmouseout=li_out("#el_file") style="font-size:12px;font-weight:bolder; height:20px">File Select</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/button.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_button" onclick="mk_button()" onmouseover=li_over("#el_button") onmouseout=li_out("#el_button") style="font-size:12px;font-weight:bolder; height:20px">Button</div></li>
     <li  style="list-style-type: none; background: url(../images/html_templates/canvas.gif) no-repeat left center; padding-left: 30px;">
          <div id="el_canvas" onclick="mk_canvas()" onmouseover=li_over("#el_canvas") onmouseout=li_out("#el_canvas") style="font-size:12px;font-weight:bolder; height:20px">Canvas</div></li>
    </ul>
 </div>

<div id="functions" style="width:100%; height:100%; overflow-x: auto; overflow-y: auto;" >
 <ul id="fn_ul" class="functions"> </ul>
</div>

<script>
     accordion = new dhtmlXAccordion("accordObj", skin);

     accordion.addItem("html", "HTML");
     accordion.addItem("functions", "Functions");

	 accordion.openItem("html");
     accordion._enableOpenEffect = true;
    
     accordion.cells("functions").attachObject("functions");
     accordion.cells("html").attachObject("html_template"); 

</script>


<!-- end:   east_container_header -->


<!-- begin: script_decorator noeval -->

  <style type="text/css">
    .li_over{
        background: orange;
        height: 20px;
    }
    .li_out{
       background: none;
       height: 20px;
    }
  </style>
  <script>
       function mk_table(){
          tableWin = getDefaultWindow("tableWindow",420,265);
          tableWin.setText("HTML > Table"); 
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_table_creator"); 
       }
       function mk_ol(){
          tableWin = getDefaultWindow("orderedList",320,290);
          tableWin.setText("HTML > Ordered List");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_orderedelist_creator");
       }
       function mk_ul(){
          tableWin = getDefaultWindow("unorderedList",320,230);
          tableWin.setText("HTML > Unordered List");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_unorderedelist_creator");
       }
       function mk_image(){
          tableWin = getDefaultWindow("image",500,250);
          tableWin.setText("HTML > Image");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_image_creator");
       }
       function mk_link(){
          tableWin = getDefaultWindow("link",500,240);
          tableWin.setText("HTML > Link");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_link_creator");
       }
       function mk_meta(){
          tableWin = getDefaultWindow("meta",500,240);
          tableWin.setText("HTML > Meta");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_meta_creator");
       }
       function mk_form(){
          tableWin = getDefaultWindow("form",500,260);
          tableWin.setText("HTML > Form");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_form_creator");
       }
       function mk_textImput(){
          tableWin = getDefaultWindow("textinput",500,315);
          tableWin.setText("HTML > Text Input");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_textinput_creator");
       }
       function mk_multiline(){
          tableWin = getDefaultWindow("multiline",500,330);
          tableWin.setText("HTML > Multiline");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_multiline_creator");
       }
       function mk_dropdown(){
          tableWin = getDefaultWindow("dropdown",480,240);
          tableWin.setText("HTML > Dropdown List");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_dropdown_creator");
       }
       function mk_check(){
          tableWin = getDefaultWindow("check",480,220);
          tableWin.setText("HTML > Checkbox");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_check_creator");
       }
       function mk_radio(){
          tableWin = getDefaultWindow("radio",480,220);
          tableWin.setText("HTML > Radio Button");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_radio_creator");
       }
       function mk_file(){
          tableWin = getDefaultWindow("file",480,210);
          tableWin.setText("HTML > File");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_file_creator");
       }
       function mk_button(){
          tableWin = getDefaultWindow("button",480,280);
          tableWin.setText("HTML > Button");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_button_creator");
       }
       function mk_canvas(){
          tableWin = getDefaultWindow("canvas",480,210);
          tableWin.setText("HTML > Canvas");
          tableWin.button("minmax1").hide();
          tableWin.center();
          tableWin.attachURL("../src/Linker.class.php?action=get_canvas_creator");
       }
       function li_over(selector){
          $(selector).removeClass("li_out");
          $(selector).addClass("li_over");
       }
       function li_out(selector){
          $(selector).removeClass("li_over");
          $(selector).addClass("li_out");
       }

        accordion.attachEvent("onActive", function(item){
            $("#active_tpl").html(item);
        });

    </script>
<!-- end:   script_decorator -->


 






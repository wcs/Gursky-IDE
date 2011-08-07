

<!-- begin: new_file_window_header -->
<head>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/tree/jquery.simple.tree.js"></script>
    <script type="text/javascript" src="../js/dhtmlxvault.js"></script>
    <link rel="StyleSheet" href="../css/jquerytree.css" type="text/css">
    <link rel="StyleSheet" href="../css/style.css" type="text/css">
    <link rel="StyleSheet" href="../css/dhtmlxvault.css" type="text/css">
    <input type="hidden" id="user_id" value="{user_id}">
</head>
<table  width="100%"  height="100%"  border="1" cellpadding="0" cellspacing="0">
    <tr>
<!-- end:   new_file_window_header -->

<!-- begin: tree_header -->
        <td  width="30%" height="100%" valign="top"> 
         <table border="0" align="left" cellpadding="10" cellspacing="10"> <tr> <td>
           <ul  class="simpleTree">
                <li class="root" id="root"><span>&nbsp;</span>
                    {tree}

<!-- end:  tree_header -->

<!-- begin: tree_footer -->
          </li> </ul>
        </td> </tr> </table>
        </td>
<!-- end:  tree_footer -->

<!-- begin: rows  -->
       
        <div>
            <td valign="top" width="70%" height="100%">
              <table border="1" width="100%">
                <tr > <td  colspan="2" height="26px" > <label class="label">Name and Location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> <span  id="msg" >  </span> </td></tr>

                 <tr>
                   <td width="30%">  <label class="label" >Selec File Type: </label> </td>
                   <td width="50%">
                      <ul>
                         <li style="list-style-image:url(../images/php.gif); background-repeat:no-repeat;" onclick=setFileType("PHPFile.php") > <label id="php_file" style="font-size:11px;"          onmouseover=ftype_over("#php_file") onmouseout=ftype_out("#php_file") >PHP File </label></li>
                         <li style="list-style-image:url(../images/php.gif); background-repeat:no-repeat;" onclick=setFileType("PHPFile.class.php")><label id="php_class" style="font-size:11px;"          onmouseover=ftype_over("#php_class") onmouseout=ftype_out("#php_class")>PHP Class</label></li>
                         <li style="list-style-image:url(../images/php.gif); background-repeat:no-repeat;" onclick=setFileType("PHP_web_page.php")><label id="php_web_page" style="font-size:11px;"    onmouseover=ftype_over("#php_web_page") onmouseout=ftype_out("#php_web_page")>PHP Web Page</label></li>
                         <li style="list-style-image:url(../images/js.gif); background-repeat:no-repeat;" onclick=setFileType("Empty_file.js")><label id="jss" style="font-size:11px;"                        onmouseover=ftype_over("#jss") onmouseout=ftype_out("#jss") >JS</label></li>
                         <li style="list-style-image:url(../images/html.gif); background-repeat:no-repeat;" onclick=setFileType("Empty_file.html")><label id="htmls" style="font-size:11px;"                    onmouseover=ftype_over("#htmls") onmouseout=ftype_out("#htmls")>HTML</label></li>
                         <li style="list-style-image:url(../images/css.gif); background-repeat:no-repeat;" onclick=setFileType("Empty_file.css")><label id="csss" style="font-size:11px;"                      onmouseover=ftype_over("#csss") onmouseout=ftype_out("#csss") >CSS</label></li>
                         <li style="list-style-image:url(../images/new.gif); background-repeat:no-repeat;" onclick=setFileType("empty_file")><label id="empty_file" style="font-size:11px;"        onmouseover=ftype_over("#empty_file") onmouseout=ftype_out("#empty_file")> Empty file</label></li>
                      </ul>
                   </td>
                 </tr>
                 <tr>
                   <td colspan="2">
                     <table>
<tr>
                   <td width="250px"> <img src="../images/menu/default/new.gif" >  <label class="label" >File name: </label> </td>
                   <td width="50%"> <input type="text" id="filename" value="" size="30"  maxlength="60" onkeyup=checkCreate("file")></td>
                 </tr>
                 <tr>
                    <td width="250px">  <label class="label" >Current Project: </label> </td>
                    <td width="50%"> <input type="text" id="current_project" value="{current_project}" size="30"  maxlength="40" disabled="true"  > </td>
                 <tr>
                   <td width="250px"> <label class="label" >Destination: </label></td>
                   <td width="50%"> <input type="text" id="destination" value="/" size="50"  maxlength="600" disabled="true" > </td>
                 </tr>
                 <tr>
                 <td width="250px"> <img src="../images/menu/default/folder_add.png" >  <label class="label" >Add Folder: </label> </td>
                  <td align="left">
                   <input type="text" id="new_folder" value="" size="20"  maxlength="30" onkeyup=checkCreate("folder")>

                  </td>
                  </tr>
                  <tr>
                     <td colspan="2" align="center">
                      <input  type="button" value="Back" onclick="parent.file_win.close()" >
                      <input  id="create_button" type="button" onclick="newFolder()" value="Create Folder" disabled>
                      <input   id="create_file_button" type="button" onclick="newFile()" value="Create File" disabled>
                      <input   id="finish" type="button" onclick="parent.file_win.close()" value="Finish" disabled>
                    </td>
                  </tr>
                     </table>
                   </td>
                 </tr>

                    <tr>  <td colspan="2">
                     <table border="0" width="100%" height="100%" >
                         <tr>  <td  width="100%" > <label class="label" >File type content example </label></td>  </tr>
                         <tr>  <td id="content_type" height="180px">Example </td> </tr>
                     </table>
                    </td> </tr>
                                            
              </table> 
            </td>
        </div>
        <script>  $("input:text").addClass("textfield");  $("input:button").addClass("button");     </script>

<!-- end:   rows -->

<!-- begin: new_file_window_footer -->
    </tr>
</table>
<!-- end:   new_file_window_footer -->


<!-- begin: script_decorator noeval -->
  <style type="text/css">
    .ftype_over{
        background-color: gray;
    }
    .ftype_out{
       background-color: white;
    } 
 </style>

<script>
   var file_type = "";
   var fullpath = "/";
   var vault = null;

   function ftype_over(selector){
      $(selector).removeClass("ftype_out");
      $(selector).addClass("ftype_over");
   }
   function ftype_out(selector){
      $(selector).removeClass("ftype_over");
      $(selector).addClass("ftype_out");
   }
   function setFileType(type){
      file_type = type;
      $("#filename").val(type);
      getTPL_converted();
      checkCreate();
   }
 
   function checkCreate(type){
          var dest = $("#destination").val();
          var new_folder = $("#new_folder").val();
          if( (dest != '') && (new_folder!= '')){
             $("#create_button").removeAttr('disabled');
          }else{
             $("#create_button").attr("disabled", "true");
          }
          var filename = $("#filename").val();
          var aPosition = filename.toString().indexOf(".");
          if( filename != ''  ){
               if(aPosition > 0){
                  $("#create_file_button").removeAttr('disabled');
                  $("#msg").html("");
               }else{
                  $("#msg").html("<label class='msgredsmall'>File extention required...</label> ");
                  $("#create_file_button").attr("disabled", "true");
               }
          }else{
             $("#create_file_button").attr("disabled", "true");
          }
          var pathn = "";
          if(type=='folder'){
            pathn = fullpath.concat($("#new_folder").val().toString());
          }else{
            pathn = fullpath.concat($("#filename").val().toString());
          }
          $("#destination").val(pathn);
   }

   function newFolder(){
       var project = $("#current_project").val();
       var folder = $("#new_folder").val(); 
       var path =  fullpath;
       $("#finish").removeAttr('disabled'); // Enable Finish Button

       $.ajax({
                type: "POST",
                async:true,
                dataType: "html",
                url: "Linker.class.php",
                data: "action=create_folder&project="+project+"&path="+path+"&new_folder="+folder,
                beforeSend: function(objeto){
                   $("#msg").html("<img src='../images/progress_small.gif' height='13px' width='50px'>");
                },
                complete: function(objeto, exito){
                    if(exito=="success"){ 
                        $("#root").html(objeto.responseText);
                        $("#msg").html("<label class='msggrensmall'>Folder created succesfull...</label> ");
                    }
                }
            });
   }
    function newFile(){
       var project = $("#current_project").val();
       var file = $("#filename").val();
       var path =  fullpath;
       var user_id = $("#user_id").val();
       $("#finish").removeAttr('disabled');  // Enable Finish Button
       $.ajax({
                type: "POST",
                async:true,
                dataType: "html",
                url: "Linker.class.php",
                data: "action=create_file&project="+project+"&user_id="+user_id+"&path="+path+"&filename="+file+"&file_type="+file_type,
                beforeSend: function(objeto){
                   $("#msg").html("<img src='../images/progress_small.gif' height='13px' width='50px'>");
                },
                complete: function(objeto, exito){
                    if(exito=="success"){ 
                        $("#msg").html(objeto.responseText );
                        parent.getProjectFiles( parent.current_project_id, parent.current_project );
                    }
                }
            });
   }
   function getTPL_converted(){ 
        $.ajax({
                type: "POST",
                async:true,
                dataType: "html",
                url: "Linker.class.php",
                data: "action=get_tpl&file_type="+file_type+"",
                beforeSend: function(objeto){
                   $("#msg").html("<img src='../images/progress_small.gif' height='13px' width='50px'>"); 
                },
                complete: function(objeto, exito){ 
                    if(exito=="success"){
                        $("#msg").html("");
                        $("#content_type").html(objeto.responseText);
                    }
                }
            });
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
            loadMessage: "Loading files...",
            afterClick:function(node){ 
                var path = xpath( $('span:first',node) ).toString().substring(4) ;
                fullpath = path;
                $("#destination").val( path );
                try{
                    vault = new dhtmlXVaultObject();
                    vault.setImagePath("../images/vault/");
                    vault.setServerHandlers("UploadHandler.php", "GetInfoHandler.php", "GetIdHandler.php");
                    vault.onAddFile = function(fileName) {
                        var ext = this.getFileExtension(fileName);
                        if (ext != "php" && ext != "js" && ext != "py" && ext != "html" && ext != "xhtml" && ext != "yml" && ext != "json"  && ext != "xml" && ext != "sql"  && ext != "css"  && ext != "dtd" && ext != "inc" && ext != "jsp" && ext != "java"
                        && ext != "png" && ext != "gif" && ext != "jpg" && ext != "bmp" && ext != "tiff" && ext != "ico" && ext != "txt" ) {
                          $("#msg").html("You may upload only text documents (php js py html xhtml yml json xml sql css txt dtd inc jsp java png gif jpg bmp ico tiff) Please retry.");
                          $("#msg").addClass("display_error");
                          return false;
                        } else {
                             $("#msg").html("");
                            $("#msg").removeClass();
                           return true;
                        }
                    };
                    vault.create("vault");
                    vault.setFormField("path", path);
                    var project = $("#current_project").val().toString();
                    vault.setFormField("project", project );
                    vault.setFormField("user_id",  $("#user_id").val());
                }catch(e){
                   
                }
            },
            afterDblClick:function(node){
 
            },
            afterMove:function(destination, source, pos){

            },
            afterAjax:function(){

            },
            animate:true
            //,docToFolderConvert:true
            
        });
    });

    add_files.progressOff();
</script>
<!-- end:  script_decorator -->


<!-- begin: reload_window noeval -->
<script type="text/javascript" src="../js/jquery.js"></script>
<link rel="StyleSheet" href="../css/style.css" type="text/css">

 
    <script>
       function goHref(user_id, project_name ){ 
          window.location.href="../src/Linker.class.php?action=show_new_file_window&user_id="+user_id+"&current_project="+project_name+"";
       }

    </script>

<!-- end:  reload_window -->
 
<!-- begin: table_header noeval -->
  <table  width="100%"  height="100%"  border="1" cellpadding="0" cellspacing="0">
  <tr>
   <td align="center" class="info"> <label >Please select one project to add files...</label> </td>
  </tr>
  <tr>
  <td valign="top" >
<!-- end:  table_header -->

<!-- begin: table_footer noeval -->
 <label class="msgredsmall"> &nbsp; &nbsp; &nbsp;  To create a project goto menu File --> New Project</label>
  </td>
  </tr>
  <tr>
   <td align="center"> <input type="button" value="Cancel" onclick="parent.file_win.close()" >   </td>
  </tr>
  </table>
<!-- end:  table_footer -->

<!-- begin: vault_script noeval -->
 <script>
   function showVault(){
                try{
                    vault = new dhtmlXVaultObject();
                    vault.setImagePath("../images/vault/");
                    vault.setServerHandlers("UploadHandler.php", "GetInfoHandler.php", "GetIdHandler.php");
                    vault.onAddFile = function(fileName) {
                        var ext = this.getFileExtension(fileName);
                        if (ext != "php" && ext != "js" && ext != "py" && ext != "html" && ext != "xhtml" && ext != "yml" && ext != "json"  && ext != "xml" && ext != "sql"  && ext != "css"  && ext != "dtd" && ext != "inc" && ext != "jsp" && ext != "java"
                        && ext != "png" && ext != "gif" && ext != "jpg" && ext != "bmp" && ext != "tiff" && ext != "ico" && ext != "txt" ) {
                          $("#msg").html("You may upload only text documents (php js py html xhtml yml json xml sql css txt dtd inc jsp java png gif jpg bmp ico tiff) Please retry.");
                          $("#msg").addClass("display_error");
                          return false;
                        } else {
                             $("#msg").html("");
                            $("#msg").removeClass();
                           return true;
                        }
                    };
                  vault.create("vault");
                  vault.setFormField("path", "/");
                  var project = $("#current_project").val().toString();
                  vault.setFormField("project", project );
                  vault.setFormField("user_id",  $("#user_id").val());
                }catch(e){}
   }
 </script>

 <!-- end:   vault_script -->



<!-- begin: vault   -->
    <td>
    <table width="100%">
       <tr>
          <td colspan="2" >  <div class=""  id="msg">  </div> </td>
       </tr>
       <tr>
          <td width="88px">  <label class="label" >Current Project: </label> </td>
          <td width=200px"> <input type="text" id="current_project" value="{current_project_name}" size="30"  maxlength="40" disabled="true"  > </td>
       </tr>
       <tr>
          <td width="88px"> <label class="label" >Destination: </label></td>
          <td width=200px"> <input type="text" id="destination" value="/" size="50"  maxlength="600" disabled="true" > </td>
       </tr>
      <tr>
       <td colspan="2"> <div id="vault" style="width:100%">
         <script>
                fullpath = "/";
                showVault();

         </script>


       </div> </td>
      </tr>

      <tr>
       <td colspan="2" align="center"> <input class="button"  id="finish" type="button" onclick="parent.add_files.close()" value="Back"  > </td>
      </tr>


    </table>
 
    </td>
<!-- end:  vault -->








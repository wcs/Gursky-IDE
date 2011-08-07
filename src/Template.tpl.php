
<!-- begin: header -->
   <link rel="StyleSheet" href="../css/style.css" type="text/css">
   <script type="text/javascript" src="../js/jquery.js"></script> <!-- 1.2.6 -->
   <script type="text/javascript" src="../js/jquery.selectboxes.min.js"></script>   

<!-- end:  header -->


<!-- begin: getPHP_file_tpl_converted -->
    <small>
        <b>&lt;?php </b><br />
         <font color="gren">// Your php code here... </font>    <br />
        <br />
        <b>?&gt;</b> <br />
    </small>
<!-- end:  getPHP_file_tpl_converted -->


<!-- begin: getPHP_class_tpl_converted noeval -->
     <small>
      <b>
        &lt;?php<br />
          <br />
       <font color="green" >   /**<br />
         * Description of PHPClass<br />
         * Date     <br />
         * @author  <br />
         */<br />  </font>
       <font color="blue" >  class </font> PHPClass {<br />
              <br />
             <font color="blue" >&nbsp;&nbsp; function  </font> __construct(){<br />
               &nbsp;&nbsp;&nbsp;<font color="green" > // Your php code here...</font><br />
            &nbsp;&nbsp;&nbsp;}<br />
            <br />
            <br />
        } <br />
        ?&gt;
        </b>
    </small>
<!-- end:  getPHP_class_tpl_converted -->


<!-- begin: getPHP_web_page_tpl_converted -->
  <small>
<b>
<font color="blue" >
&lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Transitional//EN&quot;&gt;<br />
&lt;html&gt;<br />
    &lt;head&gt;<br />
        &lt;meta </font> <font color="orange" >  http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot;</font>&gt;<br />
  <font color="blue" >      &lt;title&gt;&lt;/title&gt;<br />
    &lt;/head&gt;<br />
 &nbsp;&nbsp;    &lt;body&gt;<br /> </font>
   &nbsp;&nbsp;&nbsp;   <font color="black" >  &lt;?php<br /></font>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <small>  <font color="green" > // put your code here...</font><br /></small>
  &nbsp;&nbsp;&nbsp;     <font color="black" >  ?&gt;<br /></font>
 <font color="blue" > &nbsp;&nbsp;  &lt;/body&gt;<br />
&lt;/html&gt; </font>  </b> </small>
<!-- end:  getPHP_web_page_tpl_converted -->

<!-- begin: getJS_tpl_converted -->
<small> <font color="green" >
/* <br />
&nbsp;&nbsp;    Document   : javascript.js <br />
&nbsp;&nbsp;    Created on : <br />
&nbsp;&nbsp;    Author     : <br />
&nbsp;&nbsp;   Description:<br />

*/<br />

/* <br />
&nbsp;&nbsp;   TODO customize this javascript file<br />
*/<br />
<br />
</font> </small>
 <br> <small>  <b> Creates empty JavaScript file. You can edit the file in the IDE's Source Editor. </b> </small> <br>&nbsp;
<!-- end:  getJS_tpl_converted -->

<!-- begin: getHTML_tpl_converted -->
  <small>
<b>
<font color="blue" >
&lt;!DOCTYPE HTML PUBLIC &quot;-//W3C//DTD HTML 4.01 Transitional//EN&quot;&gt;<br />
&lt;html&gt;<br />
    &lt;head&gt;<br />
        &lt;meta </font> <font color="orange" >  http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot;</font>&gt; <br />
  <font color="blue" >      &lt;title&gt;&lt;/title&gt;<br />
    &lt;/head&gt;<br />
 &nbsp;&nbsp;    &lt;body&gt;<br /> </font>
   

   <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TODO write content </small> <br>
 <font color="blue" > &nbsp;&nbsp;  &lt;/body&gt;<br />
&lt;/html&gt; </font>  </b> </small>
<!-- end:  getHTML_tpl_converted -->

<!-- begin: getCSS_tpl_converted noeval -->
<small> <font color="green" >  
/* <br />
&nbsp;&nbsp;    Document   : styles.css<br />
&nbsp;&nbsp;    Created on : <br />
&nbsp;&nbsp;    Author     : <br />
&nbsp;&nbsp;    Description:<br />

*/<br />
<br />
/* <br />
&nbsp;&nbsp;   TODO customize this sample style<br />
&nbsp;&nbsp;   Syntax recommendation http://www.w3.org/TR/REC-CSS2/<br />
*/<br />
<br />
</font>
<font color="green" >
<b> root </b></font> { <br />
&nbsp;&nbsp;  <font color="black" ><b> display:</b>   </font> <font color="blue" > block;</font><br />
}

</small>
<!-- end:  getCSS_tpl_converted -->

<!-- begin: getEmptyFile_tpl_converted --> 
 <br> <small>  <b> Creates empty empty file. You can edit the file in the IDE's Source Editor. </b> </small> <br>&nbsp;
<!-- end:  getEmptyFile_tpl_converted -->


<!-- begin: insert_code_function noeval -->
    <script>
    function insertCode(code,window_id){
       try{
        var editor = parent.get_current_code_mirror();
        var obj = editor.cursorPosition(true);
        editor.insertIntoLine(obj.line, obj.character , code );
        parent.windows.window(window_id).close();
       }catch(e){if(flag == 0 ){ flag = 1;
         $("#msg").html("Plese open a file to insert code...");
         $("#msg").addClass("display_error");
         } else{
            parent.windows.window(window_id ).close();
         }
      }

    }
    </script>
<!-- end:  insert_code_function -->

<!-- begin: getTableCreator noeval -->
<div id="html_table">
     <div id="msg">  </div>
   <table id="table_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Rows: </label>  </td> <td><input type="button" id="rmenos" value="<" > <input id="rows" type="text" value="2" size="4" style="text-align:right"><input type="button" id="rmas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Columns: </label>  </td> <td><input type="button" id="cmenos" value="<" >  <input id="cols" type="text" value="2" size="4" style="text-align:right"><input type="button" id="cmas" value=">" > </td></tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Border size: </label>  </td> <td> <input type="button" id="bmenos" value="<" > <input id="border" type="text" value="1" size="4" style="text-align:right"><input type="button" id="bmas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Width &quot;%&quot; or &quot;px&quot;: </label>  </td> <td> <input id="twidth" type="text" value="100%" size="8" style="text-align:right"> </td></tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Cellspacing: </label>  </td> <td><input type="button" id="pmenos" value="<" > <input id="pad" type="text" value="0" size="4" style="text-align:right" ><input type="button" id="pmas" value=">" </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Cellspadding: </label>  </td> <td><input type="button" id="smenos" value="<" > <input id="spa" type="text" value="0" size="4" style="text-align:right"><input type="button" id="smas" value=">" </td></tr>
    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("tableWindow").close()> <input class="button" type="button" value="  Ok  "  onclick="insertTable()" >  </td></tr>
   </table>
</div>

<script>
    var flag = 0;
    $("input[type=text]").addClass("textfield");
    $("input[type=button]").addClass("button");
    $("input[@id='rmas']").click(function(){
        var rows = $("#rows").val();     $("#rows").val(rows-(-1));
    });
    $("input[@id='rmenos']").click(function(){
         var rows = $("#rows").val();   $("#rows").val(rows - 1);
    });
    $("input[@id='cmas']").click(function(){
        var rows = $("#cols").val();     $("#cols").val(rows-(-1));
    });
    $("input[@id='cmenos']").click(function(){
         var rows = $("#cols").val();   $("#cols").val(rows - 1);
    });
    $("input[@id='bmas']").click(function(){
        var rows = $("#border").val();   $("#border").val(rows-(-1));
    });
    $("input[@id='bmenos']").click(function(){
         var rows = $("#border").val();   $("#border").val(rows - 1);
    });
    $("input[@id='pmas']").click(function(){
        var rows = $("#pad").val();   $("#pad").val(rows-(-1));
    });
    $("input[@id='pmenos']").click(function(){
         var rows = $("#pad").val();   $("#pad").val(rows - 1);
    });
    $("input[@id='smas']").click(function(){
        var rows = $("#spa").val();   $("#spa").val(rows-(-1));
    });
    $("input[@id='smenos']").click(function(){
         var rows = $("#spa").val();   $("#spa").val(rows - 1);
    });
    function insertTable(){
        var rows = $("#rows").val();
        var cols = $("#cols").val();
        var border = $("#border").val();
        var width= $("#twidth").val();
        var pad =  $("#pad").val();
        var spa =  $("#spa").val();
        
        var th = '';
        var tr = '';
         var tc = '';
        
        for(var i = 0; i < cols; i++){
          if(i == cols-1){
            th = th.concat("<th>   </th>");
            tc = tc.concat("<td>   </td>");
          }else{
            th = th.concat("<th>   </th>\n\
       ");
            tc = tc.concat("<td>   </td>\n\
       ");
          }
        }
        
        for(var r = 0; r < rows; r++){
            tr = tr.concat(
            '     <tr>\n\
       '+tc+'\n\
     </tr>\n\
');
        }
         
        
  var code =
'<table border="'+border+'" width="'+width+'" cellspacing="'+spa+'" cellpadding="'+pad+'">\n\
   <thead>\n\
     <tr>\n\
       '+th+'\n\
     </tr>\n\
   </thead>\n\
   <tbody>\n\
'+tr+' \n\
   </tbody>\n\
</table>';
      insertCode(code,"tableWindow");

    }


</script>
<!-- end:  getTableCreator -->


<!-- begin: getOrderedListCreator noeval -->
<div id="html_ol">
    <div id="msg">  </div>
   <table id="ol_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Number of Items: </label>  </td> <td><input type="button" id="imenos" value="<" > <input id="items" type="text" value="2" size="4" style="text-align:right"><input type="button" id="imas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%" > <label class="label">Numbering Style: </label> </td> <td>  <input type="radio" name="ol" value="" checked="checked" /><label>Default </label> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ol" value="1"    > <label>1,2,3,... </label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ol" value="a"    > <label>a,b,c,... </label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ol" value="A"    > <label>A,B,C,... </label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ol" value="i"   > <label>i,ii,iii,... </label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ol" value="I"   > <label>I,II,III,... </label> </input> </td> </tr>
 
    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("orderedList").close()> <input class="button" type="button" value="  Ok  "  onclick="insertOrderedList()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");
     $("input[@id='imas']").click(function(){
        var rows = $("#items").val();     $("#items").val(rows-(-1));
     });
     $("input[@id='imenos']").click(function(){
         var rows = $("#items").val();   $("#items").val(rows - 1);
     });
     function insertOrderedList(){
        var items = $("#items").val();
        var type= $("input[@name='ol']:checked").val();
        var li = '';

        for(var i = 0; i < items;i++){
           if(i == items-1){
            li = li.concat("  <li>   </li>")
           }else{
            li = li.concat("  <li>   </li>\n\
")         }
        }
        var code =
'<ol type="'+type+'">\n\
'+li+'\n\
</ol>';
        insertCode(code,"orderedList");

    }
</script>
<!-- end:  getOrderedListCreator -->


<!-- begin: getUnorderedListCreator noeval -->
<div id="html_ul">
     <div id="msg">  </div>
   <table id="ul_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Number of Items: </label>  </td> <td><input type="button" id="imenos" value="<" > <input id="items" type="text" value="4" size="4" style="text-align:right"><input type="button" id="imas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%" > <label class="label">Numbering Style: </label> </td> <td>  <input type="radio" name="ul" value="" checked="checked" /><label>Default </label> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ul" value="disc"    > <label>Disc</label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ul" value="circle"    > <label>Circle</label> </input> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="ul" value="square"    > <label>Square</label> </input> </td> </tr>

    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("unorderedList").close()> <input class="button" type="button" value="  Ok  "  onclick="insertUnorderedList()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");
     $("input[@id='imas']").click(function(){
        var rows = $("#items").val();     $("#items").val(rows-(-1));
     });
     $("input[@id='imenos']").click(function(){
         var rows = $("#items").val();   $("#items").val(rows - 1);
     });
     function insertUnorderedList(){
        var items = $("#items").val();
        var type= $("input[@name='ul']:checked").val();
        var li = '';

        for(var i = 0; i < items;i++){
           if(i == items-1){
            li = li.concat("  <li>   </li>")
           }else{
            li = li.concat("  <li>   </li>\n\
")
           }

        }
        var code =
'<ul type="'+type+'">\n\
'+li+'\n\
</ul>';

     insertCode(code,"unorderedList");
    }
</script>
<!-- end:  getUnorderedListCreator -->


<!-- begin: getImageCreator noeval -->
<div id="html_image">
   <div id="msg">  </div>
   <table id="image_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Location: </label>   </td> <td> <input type="file" id="file" name="Browse" value="Browse" width="80" align="right" />  </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Width: </label>  </td> <td> <input id="w" type="text" value="" size="6" style="text-align:right">  </td></tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Height: </label>  </td> <td> <input id="h" type="text" value="" size="6" style="text-align:right">  </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Alternate Text: </label>  </td> <td> <input id="alt" type="text" value="" size="30" >  </td></tr>
    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("image").close()> <input class="button" type="button" value="  Ok  "  onclick="insertImage()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertImage(){
        var file = $("#file").val();
        var w = $("#w").val();
        var h = $("#h").val();
        var alt = $("#alt").val(); 
        var code ='<img src="'+file+'" width="'+w+'" height="'+h+'" alt="'+alt+'"/>';
        insertCode(code,"image");

    }
</script>
<!-- end:  getImageCreator -->



<!-- begin: getLinkCreator noeval -->
<div id="html_link">
   <div id="msg">  </div>
   <table id="link_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Protocol: </label>   </td>
      <td>
        <select id="protocol" name="protocol" size="1">
            <option value="file">file</option>
            <option value="http">http</option>
            <option value="https">https</option>
            <option value="ftp">ftp</option>
            <option value="mailto">mailto</option>
        </select>
      </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">URL: </label>   </td> <td> <input type="file" id="file" name="Browse" value="Browse" width="80" align="right" />  </td></tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Text: </label>  </td> <td> <input id="text" type="text" value="" size="40" >  </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Target: </label>   </td>
      <td>
        <select id="target" name="target" size="1">
            <option value="_blank">Same Frame</option>
            <option  value="_blank">New Windows</option>
            <option value="_parent">Parent Frame</option>
            <option value="_top">Full Windows</option>  
        </select>
      </td>
    </tr>
  <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("link").close()> <input class="button" type="button" value="  Ok  "  onclick="insertLink()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertLink(){
        var file = $("#file").val(); 
        var text = $("#text").val();
        var protocol = $("#protocol").val();
        var target = $("#target").val();

        var code ='<a href="'+protocol+'://'+file+'" target="'+target+'">'+text+'</a>';
        insertCode(code,"link");
    }
</script>
<!-- end:  getLinkCreator -->



<!-- begin: getMetaCreator noeval -->
<div id="html_meta">
   <div id="msg">  </div>
   <table id="meta_creator" cellpadding="2" cellspacing="2" border="0" width="100%">

    <tr class="zebra0"><td width="40%" > <label class="label">Type:</label> </td> <td> <input type="radio" name="type"   value="hh" checked="checked" /><label>HTTP Header </label> </td> </tr>
    <tr class="zebra0"><td width="40%" > <label class="label">  </label> </td><td>  <input type="radio" name="type" value="se"    > <label>Search Engines</label> </input> </td> </tr>

    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
      <td>
        <select id="name" name="name" size="1">
            <option value="Content-Type">Content-Type</option>
            <option value="Content-Language">Content-Language</option>
            <option value="Refresh">Refresh</option>
            <option value="Cache-Control">Cache-Control</option>
            <option value="Expires">Expires</option>
        </select>
      </td>
    </tr>
   
    <tr class="zebra0"><td width="40%"> <label class="label">Content: </label>  </td> <td> <input id="cont" type="text" value="text/html; charset=UTF-8" size="40" >  </td></tr>

  <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("meta").close()> <input class="button" type="button" value="  Ok  "  onclick="insertMeta()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");
     $("input[@name='type']").click(function(){
         var type= $("input[@name='type']:checked").val();
         var elem = document.getElementById("name");
         if(type=='hh'){
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[0]= null;
            var op0 = document.createElement('option');
            op0.value = 'Content-Type'; op0.text = 'Content-Type';

            var op1 = document.createElement('option');
            op1.value = 'Content-Language'; op1.text = 'Content-Language';

            var op2 = document.createElement('option');
            op2.value = 'Refresh'; op2.text = 'Refresh';

            var op3 = document.createElement('option');
            op3.value = 'Cache-Control'; op3.text = 'Cache-Control';

            var op4 = document.createElement('option');
            op4.value = 'Expires'; op4.text = 'Expires';

            elem.appendChild(op0);
            elem.appendChild(op1);
            elem.appendChild(op2);
            elem.appendChild(op3);
            elem.appendChild(op4);
            $("#cont").val("text/html; charset=UTF-8");
         }else{
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[1]= null;
            elem.options[0]= null;
            var op0 = document.createElement('option');
            op0.value = 'robots'; op0.text = 'robots';

            var op1 = document.createElement('option');
            op1.value = 'descriptions'; op1.text = 'descriptions';

            var op2 = document.createElement('option');
            op2.value = 'keywords'; op2.text = 'keywords';
            elem.appendChild(op0);
            elem.appendChild(op1);
            elem.appendChild(op2);
            $("#cont").val("ALL");
         }
     });
     $("#name").change(onSelectChange);
     function onSelectChange(){
         var s = $("#name option:selected").val();
         if(s == 'Content-Type'){
            $("#cont").val("text/html; charset=UTF-8");
         }else if(s == 'Content-Language'){
            $("#cont").val("en-US");
         }else if(s == 'Refresh'){
            $("#cont").val("3;URL=http://");
         }else if(s == 'Cache-Control'){
            $("#cont").val("no-cache");
         }else if(s == 'Expires'){
            $("#cont").val(calcTime(1) );
         }else if(s == 'robots'){
            $("#cont").val("ALL");
         }else if(s == 'descriptions'){
            $("#cont").val("");
         }else if(s == 'keywords'){
            $("#cont").val("keyword[,keyword]");
         }
     }
     function calcTime(offset) {
        // create Date object for current location
        d = new Date();
        utc = d.getTime() + (d.getTimezoneOffset() * 60000);
        nd = new Date(utc + (3600000*offset));
        return "" + nd.toLocaleString()+" BOT";
     }

     function insertMeta(){
        var type= $("input[@name='type']:checked").val();
        var t = "http-equiv";
        if(type!='hh'){
           t = "name"
        }
        var selected = $("#name option:selected").val();
        var cont = $("#cont").val();

        var code ='<meta '+t+'="'+selected+'" content="'+cont+'" />';
        insertCode(code,"meta");
    }
</script>
<!-- end:  getMetaCreator -->


<!-- begin: getFormCreator noeval -->
<div id="html_form">
   <div id="msg">  </div>
   <table id="form_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Action: </label>   </td>
      <td>
         <input type="file" name="file" id="file" value="" width="60" />
      </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Method: </label> </td>
      <td>  <input type="radio" name="type" value="GET" checked > <label>GET</label> </td>
    </tr>
    <tr class="zebra0"><td width="40%">  </td>
      <td>   <input type="radio" name="type" value="POST"   > <label>POST</label>  </td>
    </tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Encoding: </label>   </td>
      <td> <input type="radio" name="enc" value="www"  disabled checked ><label>aplication/x-www-form-urlencoded</label>   </td>
    </tr>
     <tr class="zebra1"><td width="40%">     </td>
      <td> <input type="radio" name="enc" value="multipart/form-data"  disabled   > <label>multipart/form-data</label> </td>
    </tr>

    <tr class="zebra0"><td width="40%"> <label class="label">Name: </label>  </td> <td> <input id="text" type="text" value="" size="40" >  </td></tr>

  <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("form").close()>
                                                     <input class="button" type="button" value="  Ok  "  onclick="insertForm()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[@name='type']").click(function(){
         var type= $("input[@name='type']:checked").val();
         if(type=='POST'){
             $("input[@name='enc']").attr("disabled", false);
         }else{
             $("input[@name='enc']").attr("disabled", true);
         }
     });
     
     function insertForm(){
        var action = $("#file").val();
        var type= $("input[@name='type']:checked").val();
        var code;
        var name = $("#text").val();
        if(type=='POST'){
           var enc= $("input[@name='enc']:checked").val();
           if(enc == 'www'){
             code ='<form name="'+name+'" action="'+action+'" method="POST" >\n\
\n\
</form>';
           }else{
             code ='<form name="'+name+'" action="'+action+'" method="POST" enctype="'+enc+'">\n\
\n\
</form>';
           }
          
        }else{
          code ='<form name="'+name+'" action="'+action+'">\n\
\n\
</form>';
        } 
        insertCode(code,"form");
    }
</script>

 
<!-- end:  getFormCreator -->


<!-- begin: getTextInputCreator noeval -->
<div id="html_textinput">
   <div id="msg">  </div>
   <table id="textinput_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Inicial Value: </label>   </td>
       <td>  <input id="init" type="text" value="" size="40" > </td>
    </tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Type: </label>   </td>
      <td> <input type="radio" name="type" value="text" checked ><label>text</label>   </td>
    </tr>
     <tr class="zebra1"><td width="40%">     </td>
      <td> <input type="radio" name="type" value="password"  > <label>password</label> </td>
    </tr>
    <tr class="zebra1"><td width="40%">     </td>
      <td> <input type="radio" name="type" value="hidden"  > <label>hidden</label> </td>
    </tr>

     <tr class="zebra0"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>disabled</label> </td>
    </tr>
    <tr class="zebra0"><td width="40%"> </td>
      <td>   <input type="checkbox" name="readonly"  /> <label>readonly</label>  </td>
    </tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Width: </label>  </td> <td> <input id="w" type="text" value="" size="6" style="text-align:right" >  </td></tr>

  <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("textinput").close()>
                                                     <input class="button" type="button" value="  Ok  "  onclick="insertTextInput()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");

     function insertTextInput(){
        var name = $("#name").val();
        var value = $("#init").val();
        var type= $("input[@name='type']:checked").val();
        var state= $("input[@name='state']:checked").val();
        var read = $("input[@name='readonly']:checked").val();
        var width = $("#w").val();
        var code;
        var r = '';
        var s = '';
        var w = '';

        if(state=='on'){
           s =  'disabled="disabled"';
        } 
        if(read == 'on'){
           r =  'readonly="readonly"'; 
        }
        if(width != ''){
           w =  'size="'+width+'"';
        }
        code= '<input type="'+type+'" name="'+name+'" value="'+value+'" '+w+' '+r+' '+s+' />'
        insertCode(code,"textinput");
    }
</script>

<!-- end:  getTextInputCreator -->



<!-- begin: getMultilineCreator noeval -->
<div id="html_multiline">
   <div id="msg">  </div>
   <table id="multiline_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Inicial Value: </label>   </td>
       <td>  <textarea id="init" type="text" value="" cols="34" rows="4" > </textarea> </td>
    </tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>disabled</label> </td>
    </tr>
    <tr class="zebra0"><td width="40%"> </td>
      <td>   <input type="checkbox" name="readonly"  /> <label>readonly</label>  </td>
    </tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Rows: </label>  </td> <td><input type="button" id="rmenos" value="<" > <input id="rows" type="text" value="10" size="4" style="text-align:right"><input type="button" id="rmas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Columns: </label>  </td> <td><input type="button" id="cmenos" value="<" >  <input id="cols" type="text" value="30" size="4" style="text-align:right"><input type="button" id="cmas" value=">" > </td></tr>

    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("multiline").close()>
                                                       <input class="button" type="button" value="  Ok  "  onclick="insertMultiline()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");
     $("input[@id='rmas']").click(function(){
        var rows = $("#rows").val();     $("#rows").val(rows-(-1));
     });
     $("input[@id='rmenos']").click(function(){
         var rows = $("#rows").val();   $("#rows").val(rows - 1);
     });
     $("input[@id='cmas']").click(function(){
        var rows = $("#cols").val();     $("#cols").val(rows-(-1));
     });
     $("input[@id='cmenos']").click(function(){
         var rows = $("#cols").val();   $("#cols").val(rows - 1);
     });
     function insertMultiline(){
        var name = $("#name").val();
        var value = $("#init").val();
        var state= $("input[@name='state']:checked").val();
        var read = $("input[@name='readonly']:checked").val();
        var rows = $("#rows").val();
        var cols = $("#cols").val();
        var code;
        var r = '';
        var s = '';  
        if(state=='on'){
           s =  'disabled="disabled"';
        }
        if(read == 'on'){
           r =  'readonly="readonly"';
        }
        code= '<textarea name="'+name+'"  rows="'+rows+'"  cols="'+cols+'" '+r+' '+s+' >\n\
 '+value+' \n\
</textarea>';
        insertCode(code,"multiline");
    }
</script>

<!-- end:  getMultilineCreator -->


<!-- begin: getDropdownCreator noeval -->
<div id="html_dropdown">
   <div id="msg">  </div>
   <table id="dropdown_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr> 

    <tr class="zebra1"><td width="40%"> <label class="label">Options:</label>  </td> <td><input type="button" id="rmenos" value="<" > <input id="rows" type="text" value="2" size="4" style="text-align:right"><input type="button" id="rmas" value=">" > </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Visible Options:</label></td><td><input type="button" id="cmenos" value="<" >  <input id="cols" type="text" value="1" size="4" style="text-align:right"><input type="button" id="cmas" value=">" > </td></tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>Disabled:</label> </td>
    </tr>
    <tr class="zebra0"><td width="40%"><label class="label">Multiple selection: </label> </td>
      <td>   <input type="checkbox" name="multiple"  /> <label>Allowed</label>  </td>
    </tr>

    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("dropdown").close()>
                                                       <input class="button" type="button" value="  Ok  "  onclick="insertDropdown()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");
     $("input[@id='rmas']").click(function(){
        var rows = $("#rows").val();     $("#rows").val(rows-(-1));
     });
     $("input[@id='rmenos']").click(function(){
         var rows = $("#rows").val();   $("#rows").val(rows - 1);
     });
     $("input[@id='cmas']").click(function(){
        var rows = $("#cols").val();     $("#cols").val(rows-(-1));
     });
     $("input[@id='cmenos']").click(function(){
         var rows = $("#cols").val();   $("#cols").val(rows - 1);
     });
     function insertDropdown(){
        var name = $("#name").val();
        var state= $("input[@name='state']:checked").val();
        var read = $("input[@name='multiple']:checked").val();
        var rows = $("#rows").val();
        var cols = $("#cols").val();
        var code;
        var r = '';
        var s = '';
        var op = '';
        var size = '';
        for(var i = 0; i < rows; i++){
          if(i == rows-1){
            op = op.concat("<option></option>");
          }else{
            op = op.concat("<option></option>\n\
   ");
          }
        }
        if(state=='on'){
           s =  'disabled="disabled"';
        }
        if(read == 'on'){
           r =  'multiple="multiple"';
        }
        if(cols > 1){
          size = 'size="'+cols+'"';
        }
        code= '<select name="'+name+'" '+size+' '+s+' '+r+'>\n\
   '+op+'\n\
</select>';
        insertCode(code,"dropdown");
    }
</script>

<!-- end:  getDropdownCreator -->


<!-- begin: getCheckCreator noeval -->
<div id="html_check">
   <div id="msg">  </div>
   <table id="check_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Value: </label>   </td>
       <td>  <input id="init" type="text" value="ON" size="40" > </td>
    </tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>Disabled:</label> </td>
    </tr>
    <tr class="zebra1"><td width="40%">  </td>
      <td>   <input type="checkbox" name="selected"  /> <label>Selected:</label>  </td>
    </tr>

    <tr class="zebra0"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("check").close()>
                                                       <input class="button" type="button" value="  Ok  "  onclick="insertCheck()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertCheck(){
        var name = $("#name").val();
        var state= $("input[@name='state']:checked").val();
        var selected = $("input[@name='selected']:checked").val();
        var value = $("#init").val();
        var code;
        var s = '';
        var c = ''; 
        if(state=='on'){
           s =  'disabled="disabled"';
        }
        if(selected == 'on'){
           c =  'checked="checked"';
        }
        code= '<input type="checkbox" name="'+name+'"  value="'+value+'"   '+s+' '+c+'/>';
        insertCode(code,"check");
    }
</script>

<!-- end:  getCheckCreator -->



<!-- begin: getRadioCreator noeval -->
<div id="html_radio">
   <div id="msg">  </div>
   <table id="radio_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Value: </label>   </td>
       <td>  <input id="init" type="text" value="" size="40" > </td>
    </tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>Disabled:</label> </td>
    </tr>
    <tr class="zebra1"><td width="40%">  </td>
      <td>   <input type="checkbox" name="selected"  /> <label>Selected:</label>  </td>
    </tr>

    <tr class="zebra0"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("radio").close()>
                                                       <input class="button" type="button" value="  Ok  "  onclick="insertRadio()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertRadio(){
        var name = $("#name").val();
        var state= $("input[@name='state']:checked").val();
        var selected = $("input[@name='selected']:checked").val();
        var value = $("#init").val();
        var code;
        var s = '';
        var c = '';
        if(state=='on'){
           s =  'disabled="disabled"';
        }
        if(selected == 'on'){
           c =  'checked="checked"';
        }
        code= '<input type="radio" name="'+name+'"  value="'+value+'"   '+s+' '+c+'/>';
        insertCode(code,"radio");
    }
</script>

<!-- end:  getRadioCreator -->



<!-- begin: getFileCreator noeval -->
<div id="html_file">
   <div id="msg">  </div>
   <table id="file_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra1"><td width="40%"> <label class="label">Name: </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Width: </label>  </td> <td> <input id="w" type="text" value="" size="6" style="text-align:right" >  </td></tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state: </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>Disabled:</label> </td>
    </tr>

    <tr class="zebra0"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("file").close()>
                                                       <input class="button" type="button" value="  Ok  "  onclick="insertFile()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertFile(){
        var name = $("#name").val();
        var width = $("#w").val();
        var state= $("input[@name='state']:checked").val();

        var code;
        var s = '';
        var w = '';
        if(state=='on'){
           s =  'disabled="disabled"';
        }
        if(width > 0){
           w =  'width="'+width+'"';
        } 
        code= '<input type="file" name="'+name+'" value="" '+w+' '+s+' />';
        insertCode(code,"file");
    }
</script>

<!-- end:  getFileCreator -->

<!-- begin: getButtonCreator noeval -->
<div id="html_button">
   <div id="msg">  </div>
   <table id="button_creator" cellpadding="2" cellspacing="2" border="0" width="100%"> 
    <tr class="zebra1"><td width="40%"> <label class="label">Label </label>   </td>
       <td>  <input id="init" type="text" value="" size="40" > </td>
    </tr>
    <tr class="zebra0"><td width="40%"> <label class="label">Type </label>   </td>
      <td> <input type="radio" name="type" value="submit" checked ><label>Submit</label>   </td>
    </tr>
     <tr class="zebra0"><td width="40%">     </td>
      <td> <input type="radio" name="type" value="reset"  > <label>Reset</label> </td>
    </tr>
    <tr class="zebra0"><td width="40%">     </td>
      <td> <input type="radio" name="type" value="button"  > <label>Standard</label> </td>
    </tr>

     <tr class="zebra1"><td width="40%"> <label class="label">Initial state </label> </td>
      <td>  <input type="checkbox" name="state"   /> <label>disabled</label> </td>
    </tr>

    <tr class="zebra0"><td width="40%"> <label class="label">Name </label>   </td>
       <td>  <input id="name" type="text" value="" size="40" >    </td>
    </tr>
  <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("button").close()>
                                                     <input class="button" type="button" value="  Ok  "  onclick="insertButton()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");

     function insertButton(){
        var name = $("#name").val();
        var value = $("#init").val();
        var type= $("input[@name='type']:checked").val();
        var state= $("input[@name='state']:checked").val();

        var code;
        var r = '';
        var s = '';
 
        if(state=='on'){
           s =  'disabled="disabled"';
        }

        code= '<input type="'+type+'" name="'+name+'" value="'+value+'" '+s+'/>'
        insertCode(code,"button");
    }
</script>


<!-- end:  getButtonCreator -->

<!-- begin: getCanvasCreator noeval -->
<div id="html_canvas">
  <div id="msg">  </div>
   <table id="canvas_creator" cellpadding="2" cellspacing="2" border="0" width="100%">
    <tr class="zebra0"><td width="40%"> <label class="label">Width: </label>  </td> <td> <input id="w" type="text" value="" size="6" style="text-align:right">  </td></tr>
    <tr class="zebra1"><td width="40%"> <label class="label">Height: </label>  </td> <td> <input id="h" type="text" value="" size="6" style="text-align:right">  </td></tr>
    <tr class="zebra0"><td width="40%"> <label class="label">ID: </label>  </td> <td> <input id="id_" type="text" value="" size="30" >  </td></tr>
    <tr class="zebra1"><td align="center" colspan="2"> <input class="button" type="button" value="Cancel" onclick=parent.windows.window("canvas").close()> <input class="button" type="button" value="  Ok  "  onclick="insertCanvas()" >  </td></tr>
   </table>
</div>
<script >
     var flag = 0;
     $("input[type=text]").addClass("textfield");
     $("label").addClass("label");
     $("input[type=button]").addClass("button");

     function insertCanvas(){
        var w = $("#w").val();
        var h = $("#h").val();
        var id = $("#id_").val();
        var code ='<canvas id="'+id+'" width="'+w+'" height="'+h+'" >\n\
\n\
</canvas>';
        insertCode(code,"canvas");

    }
</script>

<!-- end:  getCanvasCreator -->




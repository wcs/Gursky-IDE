
/**
* ----------------------------------------------------------
* | mirror_function.js   - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Sep, 01 of 2009		     						|
* | 															|
* |															|
*  ----------------------------------------------------------

* Copyright (c) 2009 Doglas A. Dembogurski <dembogurski@gmail.com>

* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.

* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*
*/

var fn = new Map();  // HashMap for functions


// Function to return the current code editor
function get_current_code_mirror(){
    if((current_file == null) || (current_file == undefined)){
        return undefined;
    }else{
        var regex =new RegExp("[/,\,.]", "g");
        var replac  =  current_file.replace(regex, "_");
        try{
            var codemirror =  eval(current_project.concat( trim(replac) ) );
            return codemirror;
        }catch (e){
            return undefined;
        }
    }
    return undefined;
}
function fn_over(selector){
    $(selector).removeClass("fn_out");
    $(selector).addClass("fn_over");
}
function fn_out(selector){
    $(selector).removeClass("fn_over");
    $(selector).addClass("fn_out");
}
function showFunctions(){
    var fndiv = document.getElementById("functions"); 
    var ul = document.getElementById("fn_ul");
    ul.innerHTML = '';
    var keys = fn.keySet();
    //keys.sort();

    for(var i = 0; i < keys.length; i++){
        var li = document.createElement("LI"); 
        var lineNumber = fn.get(keys[i]);
        li.id = lineNumber;
        var html = '<table class="functions" border="0" width="100%" cellspacing="0" cellpadding="0">\n\
                     <tr height="16px" title="Jump to line" id="tr_'+lineNumber+'"  onmouseover=fn_over("#tr_'+lineNumber+'") onmouseout=fn_out("#tr_'+lineNumber+'") onclick="jumpToLine('+lineNumber+')">\n\
                       <td width="70%"><a href="javascript:jumpToLine('+lineNumber+')" style="color: green;text-decoration:none" >'+ keys[i]+' </a>   </td>\n\
                       <td width="30%" align="right">'+lineNumber+' &nbsp;</td>\n\
                     </tr>\n\
                     </table>';

        li.innerHTML = html;
        ul.appendChild(li);
    }
}

function parse_line(line, lineNumber){
    // function name()   or    name = function()
    var tokens = line.split(" ");  //
    for(var i=0; i < tokens.length; i++){
        if(tokens[i] ==='function'){  // spected fn name
            var next = tokens[i+1];
            var name = next.substring(0,next.indexOf("("));
            fn.put(name,lineNumber);
        /* var php_arrow = mixed_keywords.get("$this->");  // array
          if(php_arrow != null){
             var insert = true;
             for(var j=0; j < php_arrow.length; j++){
                 window.console.log('>>>> '+ php_arrow[j] + '  cur  '+' '.concat(name));
                if(php_arrow[j]===' '.concat(name)){ window.console.log('encontro--->');
                    insert = false;
                }
             }
             if(insert){ php_arrow.push(' '.concat(name));  }
             insert = true;
             mixed_keywords.put('$this->', php_arrow);
          }else{
             mixed_keywords.put('$this->', new Array(name));
          }*/
        }
    }
}

function parse_code(){
    accordion.cells("functions").setIcon("../images/loadingfn.gif") ;
    fn = new Map();
    try{
        var code = get_current_code_mirror().getCode();
        // Process every line
        var lineNumber = 0;
        var trim = "";
        // Separate in lines
        var lines = code.split("\n");

        for(var i=0; i < lines.length; i++){
            lineNumber++;
            if( lines[i].length > 0){
                parse_line(lines[i],lineNumber );
            }
        }
        showFunctions();
    }catch(e){
        accordion.cells("functions").clearIcon();
        return;
    }
    setTimeout('accordion.cells("functions").clearIcon()',800);
}
function jumpToLine(line) {
    get_current_code_mirror().jumpToLine(Number(line));
    //get_current_code_mirror().selectLines(line+1, line+1, line+2, line+2);
}

search =  function() {

    // var text = prompt("Enter search term:", "");
    var text = $("#search_field").val();
    if (!text){
        $("#search_field").val("Enter search terms here...");
        return;
    }

    var first = true;
    do {
        var cursor = get_current_code_mirror().getSearchCursor(text, first);
        first = false;
        while (cursor.findNext()) {
            cursor.select();
            if (!confirm("Search again?"))
                return;
        }
    } while (confirm("End of document reached. Start over?"));
}

cut = function(){
    get_current_code_mirror().replaceSelection("");    //replaceSelection(string)
}
undo = function(){
    get_current_code_mirror().undo();
}
redo = function(){
    get_current_code_mirror().redo();
}
replace = function() {
    // This is a replace-all, but it is possible to implement a
    // prompting replace.
    var from = prompt("Enter search string:", ""), to;
    if (from) to = prompt("What should it be replaced with?", "");
    if (to == null) return;

    var cursor = get_current_code_mirror().getSearchCursor(from, false);
    while (cursor.findNext())
        cursor.replace(to);
},

jump =  function() {
    var line = prompt("Jump to line:", "");
    if (line && !isNaN(Number(line)))
        get_current_code_mirror().jumpToLine(Number(line));
}

line = function() {
    alert("The cursor is currently at line " + get_current_code_mirror().currentLine());
    get_current_code_mirror().focus();
}

macro = function() {
    var name = prompt("Name your constructor:", "");
    if (name)
        get_current_code_mirror().replaceSelection("function " + name + "() {\n  \n}\n\n" + name + ".prototype = {\n  \n};\n");
}

reindent = function() {
    get_current_code_mirror().reindent();
}
/*
function extractMethods(){
    var code = get_current_code_mirror().getCode();   
    window.console.log(' >> Code ' + code+'');
}*/






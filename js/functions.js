 
/**
* ----------------------------------------------------------
* | functions.js   - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jul, 08 of 2009		     						|
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

var current_project = null;     // name of the project
var current_project_id = null;
var current_project_index_file = 'index.html';
var current_file = null;
var current_filename_replaced = "undefined";
var interval = null; // interval when run project
var console_counter = 0;

// Tab Bars
var west_tabbar;   // The Tab Bar for the West Panel
var source_editor_tabbar; // The Tab Bar for the Center Panel

// Menu
var menu;

// Tree`s
var projects_tree;

// Toolbars
var preview_toolbar;
// Profile edit
var editProfileWin;

// User Preferences UI
var preferences;

// Log Viewer
var logViewer;

var outerLayout, innerLayout;  

var windows = null;
// window to create projects
var proj_win;
var tableWin;
var aboutWindow;

// Javascript console
var js_console;
var useradd; // add user to project

var properties; //Project properties window

// Acordions
var accordion;

// Preview History
var historyArray = new Array();
var historyNumber = 0;

var run;

// LibrariesArray
var libsArray = [
"../js/user_preferences.js",
"../js/jquery.layout.js",
"../js/ui.core.js",
"../js/ui.draggable.js",   //OPTIONAL ui.draggable is required to resize panes
"../js/effects.core.js",   //OPTIONAL animation effects for opening/closing panes
"../js/effects.slide.js",
"../js/effects.drop.js",
"../js/effects.scale.js",
"../js/layouts.js",
     
"../js/tabbar/dhtmlxcommon.js", // tabbar  dhtmlxtabbar
"../js/tabbar/dhtmlxtabbar.js",

"../js/tree/jquery.simple.tree.js", //tree  simpletreemenu

"../js/windows/dhtmlxcommon.js", // windows dhtmlxwindows
"../js/windows/dhtmlxwindows.js",

"../js/menu/dhtmlxcommon.js", // menu dhtmlxmenu
"../js/menu/dhtmlxmenu.js",

//"../js/accordion/dhtmlxcommon.js", // accordion
"../js/accordion/dhtmlxaccordion.js",

"../js/js_map.js",                 //  Autocomplete
"../src/editor/js/codemirror.js",  // Source editor
"../js/mirror_functions.js",

"../js/toolbar/dhtmlxcommon.js",// toolbar
"../js/toolbar/dhtmlxtoolbar.js",  
"../js/windows/ext/dhtmlxwindows_wtb.js",   // windows toolbar extension

"../js/autocomplete.js"

  
];

// CSS Array
var cssArray = [
"../css/layouts.css", // Layouts
"../css/dhtmlxtabbar.css", // tabbar
"../css/dhtmlxwindows.css", // windows + skins
"../css/windows/skins/dhtmlxwindows_dhx_black.css",
"../css/windows/skins/dhtmlxwindows_dhx_blue.css",
"../css/windows/skins/dhtmlxwindows_aqua_sky.css",

"../css/jquerytree.css",  //tree
"../css/menu/dhtmlxmenu_dhx_black.css",   // Menu
"../css/menu/dhtmlxmenu_dhx_blue.css",

"../css/accordion/dhtmlxaccordion_dhx_black.css", // accordion
"../css/accordion/dhtmlxaccordion_dhx_blue.css",

"../css/editor/source_editor.css",     // Source editor

"../css/toolbar/dhtmlxtoolbar_dhx_black.css",  // toobar
"../css/toolbar/dhtmlxtoolbar_dhx_blue.css",
"../css/editor/autocomplete_popup.css"
];

var LIBS =  libsArray.length - 1;
var loaded_lib = 0;
// Array for put current files

var filesArray = new Array();

// function to show correctly librarie names
function showLibName(lib){
   var array = lib.split("/");
   $("#lib_progress").html(array[ array.length -1 ]);
}

function lib_loaded(lib){   
   showLibName(lib);
   loaded_lib++;
   $("#loading_msg").html("Loading libraries please wait...["+parseInt((loaded_lib * 100) / LIBS)+"%]");
   document.images["bar"].height = 8;
   document.images["bar"].width += 17;   
   if(loaded_lib == LIBS){
      $("#loading_msg").html("Libraries loaded complete... &nbsp;&nbsp;&nbsp;&nbsp;["+(loaded_lib * 100) / LIBS+"%]");
     document.images["bar"].width += 10;
     document.images["bar"].height = 8;
    // setTimeout('$("#loading").html("");  $("#loading_img").html("");',2000);
     var user_id = $("#user_id").val();
     var session = $("#session_id").val();
     loadContent(user_id,session);
   }    
}

// Function to include any javascript library
function includeJS(file_path){   
    var j = document.createElement("script");
    j.type = "text/javascript";
    j.onload = function(){
        lib_loaded(file_path);
    };
    j.src = file_path;
    document.getElementsByTagName('head')[0].appendChild(j); 
}
// Function to include any javascript library
function includeCSS(file_path){
    showLibName(file_path);
    var v_css  = document.createElement('link');
    v_css.rel = 'stylesheet'
    v_css.type = 'text/css';
    v_css.href = file_path;
    document.getElementsByTagName('head')[0].appendChild(v_css);
}
 

loadlibraries = function(){
    document.images["bar"].height = 8;
    cssArray.forEach( includeCSS  );
    libsArray.forEach( includeJS );
}
function loadContent(user_id,session){
  // Load User Preferences
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        data: "action=load_preferences&user_id="+user_id+"",
        beforeSend: function(objeto){
            $("#loading").html("<label class='loading_msg'> Loading user preferences...</label> <img src='../images/progress_small.gif' height='8', width='60'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){ 
               $("body").html(objeto.responseText);
                 
               (function(){ //función anónima crea un nuevo scope
                $.ajax({
                    type: "POST",
                    async:true,
                    dataType: "html",
                    data: "action=showIDEBody&user="+user_id+"&session="+session,
                    beforeSend: function(objeto){
                        $("#loading").html("<label class='loading_msg'> Loading IDE...</label> <img src='../images/progress_small.gif' height='8', width='60'>");
                    },
                    complete: function(objeto, exito){
                        if(exito=="success"){
                            if(objeto.responseText.toString()==false){
                                $("#loading").attr("class","display_error");
                                $("#loading").html("<div >&nbsp&nbsp;&nbsp; Can`t load IDE...&nbsp&nbsp;&nbsp;  </div>");
                            }else{
                                $("body").html(objeto.responseText);
                            }
                        }
                    }
                });
               })(); 
            }
        }
    });

  
}

// Layouts Configuration
main_layout_ready = function(){

    // create the OUTER LAYOUT
    outerLayout = $("body").layout( layoutSettings_Outer );

    /*******************************
		 ***  CUSTOM LAYOUT BUTTONS  ***
		 *******************************
		 *
		 * Add SPANs to the east/west panes for customer "close" and "pin" buttons
		 *
		 * COULD have hard-coded span, div, button, image, or any element to use as a 'button'...
		 * ... but instead am adding SPANs via script - THEN attaching the layout-events to them
		 *
		 * CSS will size and position the spans, as well as set the background-images
		 */

    // BIND events to hard-coded buttons in the NORTH toolbar
    outerLayout.addToggleBtn( "#tbarToggleNorth", "north" );
    outerLayout.addOpenBtn( "#tbarOpenSouth", "south" );

    outerLayout.addCloseBtn( "#tbarCloseSouth", "south" );
    outerLayout.addPinBtn( "#tbarPinWest", "west" );
    outerLayout.addPinBtn( "#tbarPinEast", "east" ); 

 
    // save selector strings to vars so we don't have to repeat it
    // must prefix paneClass with "body > " to target ONLY the outerLayout panes
    var westSelector = "body > .ui-layout-west"; // outer-west pane
    var eastSelector = "body > .ui-layout-east"; // outer-east pane

    // CREATE SPANs for pin-buttons - using a generic class as identifiers
    $("<span></span>").addClass("pin-button").prependTo( westSelector );
    $("<span></span>").addClass("pin-button").prependTo( eastSelector );
    // BIND events to pin-buttons to make them functional
    outerLayout.addPinBtn( westSelector +" .pin-button", "west");
    outerLayout.addPinBtn( eastSelector +" .pin-button", "east" );

    // CREATE SPANs for close-buttons - using unique IDs as identifiers
    $("<span></span>").attr("id", "west-closer" ).prependTo( westSelector );
    $("<span></span>").attr("id", "east-closer").prependTo( eastSelector );
    // BIND layout events to close-buttons to make them functional
    outerLayout.addCloseBtn("#west-closer", "west");
    outerLayout.addCloseBtn("#east-closer", "east");


    /* Create the INNER LAYOUT - nested inside the 'center pane' of the outer layout
		 * Inner Layout is create by createInnerLayout() function - on demand
		 *
			innerLayout = $("div.pane-center").layout( layoutSettings_Inner );
		 *
		 */
    innerLayout = $("div.pane-center").layout( layoutSettings_Inner );
    // DEMO HELPER: prevent hyperlinks from reloading page when a 'base.href' is set
    $("a").each(function () {
        var path = document.location.href;
        if (path.substr(path.length-1)=="#") path = path.substr(0,path.length-1);
        if (this.href.substr(this.href.length-1) == "#") this.href = path +"#";
    });


}
/*
	*#######################
	* INNER LAYOUT SETTINGS
	*#######################
	*
	* These settings are set in 'list format' - no nested data-structures
	* Default settings are specified with just their name, like: fxName:"slide"
	* Pane-specific settings are prefixed with the pane name + 2-underscores: north__fxName:"none"
	*/
var layoutSettings_Inner = {
    applyDefaultStyles:				false // basic styling for testing & demo purposes
    ,
    minSize:						20 // TESTING ONLY
    ,
    spacing_closed:					8
    ,
    north__spacing_closed:			8
    ,
    south__spacing_closed:			8
    ,
    north__togglerLength_closed:	-1 // = 100% - so cannot 'slide open'
    ,
    south__togglerLength_closed:	-1
    ,
    fxName:							"slide" // do not confuse with "slidable" option!
    ,
    fxSpeed_open:					1000
    ,
    fxSpeed_close:					2500
    ,
    fxSettings_open:				{
        easing: "easeInQuint"
    }
    ,
    fxSettings_close:				{
        easing: "easeOutQuint"
    }
    ,
    north__fxName:					"none"
    ,
    south__fxName:					"drop"
    ,
    south__fxSpeed_open:			500
    ,
    south__fxSpeed_close:			1000
    //,	initClosed:				    true
    ,
    center__minWidth:				200
    ,
    center__minHeight:				200
};
/*
	*#######################
	* OUTER LAYOUT SETTINGS
	*#######################
	*
	* This configuration illustrates how extensively the layout can be customized
	* ALL SETTINGS ARE OPTIONAL - and there are more available than shown below
	*
	* These settings are set in 'sub-key format' - ALL data must be in a nested data-structures
	* All default settings (applied to all panes) go inside the defaults:{} key
	* Pane-specific settings go inside their keys: north:{}, south:{}, center:{}, etc
	*/
var layoutSettings_Outer = {  
    name: "outerLayout" // NO FUNCTIONAL USE, but could be used by custom code to 'identify' a layout
    // options.defaults apply to ALL PANES - but overridden by pane-specific settings
    ,
    defaults: {
        size:					"auto"
        ,
        minSize:				50
        ,
        paneClass:				"pane" 		// default = 'ui-layout-pane'
        ,
        resizerClass:			"resizer"	// default = 'ui-layout-resizer'
        ,
        togglerClass:			"toggler"	// default = 'ui-layout-toggler'
        ,
        buttonClass:			"button"	// default = 'ui-layout-button'
        ,
        contentSelector:		".content"	// inner div to auto-size so only it scrolls, not the entire pane!
        ,
        contentIgnoreSelector:	"span"		// 'paneSelector' for content to 'ignore' when measuring room for content
        ,
        togglerLength_open:		35			// WIDTH of toggler on north/south edges - HEIGHT on east/west edges
        ,
        togglerLength_closed:	35			// "100%" OR -1 = full height
        ,
        hideTogglerOnSlide:		true		// hide the toggler when pane is 'slid open'
        ,
        togglerTip_open:		"Close This Pane"
        ,
        togglerTip_closed:		"Open This Pane"
        ,
        resizerTip:				"Resize This Pane"
        //	effect defaults - overridden on some panes
        ,
        fxName:					"slide"		// none, slide, drop, scale
        ,
        fxSpeed_open:			750
        ,
        fxSpeed_close:			1500
        ,
        fxSettings_open:		{
            easing: "easeInQuint"
        }
        ,
        fxSettings_close:		{
            easing: "easeOutQuint"
        }
    }
    ,
    north: {
        
        spacing_open:			1			// cosmetic spacing
        ,
        togglerLength_open:		0			// HIDE the toggler button
        ,
        togglerLength_closed:	-1			// "100%" OR -1 = full width of pane
        ,
        resizable: 				true
        ,
        slidable:				true
        ,
        initClosed:				false
        //	override default effect
        ,
        fxName:					"slide"
    }
    ,
    south: {
        size:					160
        ,
        maxSize:				300
        ,
        spacing_closed:			0			// HIDE resizer & toggler when 'closed'
        ,
        slidable:				false		// REFERENCE - cannot slide if spacing_closed = 0
        ,
        initClosed:				true
        //	CALLBACK TESTING...
        ,
        onhide_start:			function () {
        // return confirm("START South pane hide \n\n onhide_start callback \n\n Allow pane to hide?");
        }
        ,
        onhide_end:				function () {
        // alert("END South pane hide \n\n onhide_end callback");
        }
        ,
        onshow_start:			function () {
        // return confirm("START South pane show \n\n onshow_start callback \n\n Allow pane to show?");
        }
        ,
        onshow_end:				function () {
        //  alert("END South pane show \n\n onshow_end callback");
        }
        ,
        onopen_start:			function () {
            source_editor_tabbar.adjustSize();
        }
        ,
        onopen_end:				function () {
            source_editor_tabbar.adjustSize();
        }
        ,
        onclose_start:			function () {
            source_editor_tabbar.adjustSize();
        }
        ,
        onclose_end:			function () {
            source_editor_tabbar.adjustSize();
        }
        //,	onresize_start:			function () { return confirm("START South pane resize \n\n onresize_start callback \n\n Allow pane to be resized?)"); }
        ,
        onresize_end:			function () {
            source_editor_tabbar.adjustSize();
        }
    }
    ,
    west: {
   
        size:					250
        ,
        spacing_closed:			21			// wider space when closed
        ,
        togglerLength_closed:	21			// make toggler 'square' - 21x21
        ,
        togglerAlign_closed:	"top"		// align to top of resizer
        ,
        togglerLength_open:		0			// NONE - using custom togglers INSIDE west-pane
        ,
        togglerTip_open:		"Close West Pane"
        ,
        togglerTip_closed:		"Open West Pane"
        ,
        resizerTip_open:		"Resize West Pane"
        ,
        slideTrigger_open:		"click" 	// default
        ,
        initClosed:				false   // Added by Douglas
        //	add 'bounce' option to default 'slide' effect
        ,
        fxSettings_open:		{
            easing: "easeOutBounce"
        }
        ,
        onclose_end:			function () {
            source_editor_tabbar.adjustSize();
        } ,
        onresize_end: function () {
            west_tabbar.adjustSize();
            source_editor_tabbar.adjustSize();
        }
    }
    ,
    east: {
        size:					250
        ,
        spacing_closed:			21			// wider space when closed
        ,
        togglerLength_closed:	21			// make toggler 'square' - 21x21
        ,
        togglerAlign_closed:	"top"		// align to top of resizer
        ,
        togglerLength_open:		0 			// NONE - using custom togglers INSIDE east-pane
        ,
        togglerTip_open:		"Close East Pane"
        ,
        togglerTip_closed:		"Open East Pane"
        ,
        resizerTip_open:		"Resize East Pane"
        ,
        slideTrigger_open:	    "click"	//"mouseover"
        ,
        initClosed:				true
        //	override default effect, speed, and settings
        ,
        fxName:					"drop"
        ,
        fxSpeed:				"normal"
        ,
        fxSettings:				{
            easing: ""
        }, // nullify default easing
        onopen_end:				function () {
           source_editor_tabbar.adjustSize();
           setTimeout("parse_code()", 500 ); // Extract function and methods
        },
        onresize_end: function () {           
            source_editor_tabbar.adjustSize();
        },
        onclose_start:			function () {
            source_editor_tabbar.adjustSize();
        }
        ,
        onclose_end:			function () {
            source_editor_tabbar.adjustSize();
        } 
    }
    ,
    center: {
        size:					1024
        ,
        paneSelector:			"#mainContent" 			// sample: use an ID to select pane instead of a class
        ,
        onresize:				"innerLayout.resizeAll"	// resize INNER LAYOUT when center pane resizes
        ,
        minWidth:				200
        ,
        minHeight:				200
    }
}; 

function logOut(){
     var user = $("#user_id").val();
     $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=logout&user="+user+"",
            beforeSend: function(objeto){
                $("#msg").html("<label class='msg'>Please wait...</label>");
            },
            complete: function(objeto, exito){ 
                window.location.href= objeto.responseText;
            }
        });

}


// Function to check if exist the database gurski
function createDB(){ 
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=create_db",
        beforeSend: function(objeto){
        },
        complete: function(objeto, exito){
            if(exito=="success"){ 
        }
        }
    });
}


function getDefaultWindow(id,h_size, v_size){
    var posx = (screen.width / 2) -  (h_size / 2);
    var posy = (screen.height / 2) - (v_size + (v_size / 2)) ;
    if(windows == null){
        windows = new dhtmlXWindows();
    }
    windows.setImagePath("../images/windows/");
    windows.setSkin( skin );  // default skin "dhx_black"
    windows.enableAutoViewport(true);
    var win = windows.createWindow(id, posx, posy, h_size, v_size);
    return win;
}

function create_project(){
    proj_win =  getDefaultWindow("pr",620,226);
    proj_win.setText("Create Project");
    proj_win.setModal(true);
    proj_win.attachObject(  new_proj_window ,false);
    proj_win.button("minmax1").hide(); 
}

// Insert into  projectos
// insert into projectos por usuario
// create folder
function create_new_project(){
    var user_id = $("#user_id").val();   
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
        data: "action=create_project&user_id="+user_id+"&name="+name+"&host="+host+"&hmpath="+hmpath+"&port="+port+"&index_file="+index_file,

        beforeSend: function(objeto){
            $("#west_header").html("<img src='../images/progress_small.gif' height='13px' width='50px'>");
        },

        complete: function(objeto, exito){
            if(exito=="success"){
                proj_win.close();
                $("#projects_list").html(objeto.responseText);
                $("#west_header").html("Project - Files");
            }else{
               log("An Error ocurred. Can`t create project.");
            }
        }
    });
}

// Create and show window for new file
createNewFile = function( project ){
    var project_name = project;
    if(project==undefined){
        project_name = current_project;
    } 
    var user = $("#user_id").val();
    file_win =  getDefaultWindow("file",840,600);
    file_win.setText("Create File");
    file_win.progressOn();
    file_win.setModal(true); 
    file_win.attachURL("../src/Linker.class.php?action=show_new_file_window&user_id="+user+"&current_project="+project_name );
    setTimeout("file_win.progressOff()",2000);
}

function addLocalFiles(){
    if(current_project==undefined){
        setMessage("<label class='label'> &nbsp;&nbsp;  Please select one project to add files.  &nbsp;&nbsp;   </label> ");
        setTimeout('$("#msg").html("")',5000);
    }else{
        var user = $("#user_id").val();
        add_files = getDefaultWindow("add_files",720,480);
        add_files.setText("Add Files");
        add_files.progressOn();
        add_files.setModal(true);
        add_files.attachURL(  "../src/Linker.class.php?action=upload_files&user_id="+user+"&current_project="+current_project );

    }
}

function checkProject(){
    var name = $("#new_project_name").val();
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=check_project&name="+name+"",
        beforeSend: function(objeto){
            $("#msg_name").html("<label class='msg'>Checking project name...</label>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                $("#msg_name").html(objeto.responseText);
                var msg = $("#msg_name").html().length;
                if(msg < 60){
                    $("#create").removeAttr('disabled');
                }else{
                    $("#create").attr("disabled", "true");
                }

            }
        }
    });
}
// Function to highlight current file
function fileclicked(file){
    if(file != '.'){
        document.getElementById(file).setAttribute("style", "background-color: gray");
    }

}
function removeBackground(file){ 
    if(file != undefined){
        document.getElementById(file).setAttribute("style", "background-color: white");
    }
}
 
function getProjectFiles(project_id, project_name ){
    closeAllFiles(current_project);
    current_project = project_name;
    current_project_id = project_id;
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=get_project_files&id="+project_id+"",
        beforeSend: function(objeto){
            $("#west_header").html("<img src='../images/progress_small.gif' height='13px' width='60px'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                $("#west_header").html(current_project.toString());
                $("#files").html(objeto.responseText);
                west_tabbar.setTabActive("files"); // Automatic files tab selection
            }
        }
    });
}
// funtion to help Array Remove elements
if (!Array.prototype.remove){
    Array.prototype.remove = function(elem) {
        var index = this.indexOf(elem);
        if (index !== -1) {
            this.splice(index, 1);
        }
    };
}
// Function to trim a String
function trim(stringToTrim) {
    return stringToTrim.replace(/^\s+|\s+$/g,"");
}
//Change a Source editor tab labe to another label
function setTabLabel(tab_id, label){
    source_editor_tabbar.setLabel(tab_id.toString(),label.toString());
}
function loadFile( absolute_path, file ){
    var aPosition = file.toString().indexOf(".");
    if(aPosition > 0){ // Check if is a File
        var user_id = $("#user_id").val();
        var session_id = $("#session_id").val();
        var ext = file.toString().substr(aPosition, file.toString().length);
        if(ext === '.html' || ext === '.php' ){
           setLangType('html');
        }else if(ext === '.sql' ){
           setLangType('sql');
        }
        var regex =new RegExp("[/,\,.]", "g"); // replace /\. with _
        if( filesArray.indexOf(absolute_path) < 0 ){ // Is not in the array
            filesArray.push(absolute_path);
            source_editor_tabbar.addTab( absolute_path , file);
            source_editor_tabbar.setContentHref(absolute_path ,"../src/Linker.class.php?action=load_file&project="+current_project+"&user_id="+user_id+"&session_id="+session_id+"&file="+absolute_path);
            source_editor_tabbar.setTabActive(absolute_path);
            current_filename_replaced  =  file.replace(regex, "_");
            setTimeout("parse_code()", 2000 );
        }else{
            source_editor_tabbar.setTabActive(absolute_path);
            var id = source_editor_tabbar.getActiveTab();
            source_editor_tabbar.setLabel(id,"<img src='../images/progress_small.gif'>");
            setTimeout("setTabLabel('"+id.toString()+"','"+file.toString()+"')",1000);
            current_filename_replaced  =  file.replace(regex, "_");
            setTimeout("parse_code()", 2000 );
        }
        //window.console.log (' >> current_filename_replaced ' +current_filename_replaced );
    }
}
function deleteFile( absolute_path, file ){
    var a = confirm("Are you sure to delete this file?");
    if(a){
        var aPosition = file.toString().indexOf(".");
        if(aPosition > 0){ // Check if is a File
         $.ajax({
                type: "POST",
                async:true,
                dataType: "html",
                url: "Linker.class.php",
                data: "action=delete_file&project="+current_project+"&file="+absolute_path+"",
                beforeSend: function(objeto){
                     setMessage("<label class='label'>&nbsp;&nbsp;Deleting file  &nbsp; &nbsp;</label><img src='../images/loading.gif'>");
                },
                complete: function(objeto, exito){
                    if(exito=="success"){
                        $("#msg").html(objeto.responseText);
                        parent.getProjectFiles( parent.current_project_id, parent.current_project );
                        setTimeout("closePopup()",3500);
                        log(objeto.responseText);
                    }
                }
            });
        }
    }
}



function closeFile(file){ 
    // Check if exist code_mirror
    filesArray.remove(file);   // OnClose tab remove from the array
    current_file = filesArray[0];
    source_editor_tabbar.setTabActive(filesArray[0]);
    var code_editor_mirror = get_current_code_mirror();
    if(code_editor_mirror != undefined){
        var user_id = $("#user_id").val();
        var session_id = $("#session_id").val();
        $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=close_file&user_id="+user_id+"&session_id="+session_id+"&project="+current_project+"&file="+file+"",
            beforeSend: function(objeto){
              log("Closing file : "+ file);
            },
            complete: function(objeto, exito){
              log(objeto.responseText);
            }
        });
    }
}

function closeAllFiles(project){
    var project_name = project;
    if(project==undefined){
        project_name = current_project;
    }
    filesArray = new Array();  // Remove all alements from filesArray
    var user_id = $("#user_id").val();
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=close_all_files&user_id="+user_id+"&project="+project_name+"",
        beforeSend: function(objeto){
            setMessage("<label class='label'> &nbsp;&nbsp;  Closing files plese wait.  &nbsp;&nbsp;   </label><img src='../images/loading.gif'>");
        },
        complete: function(objeto, exito){
            source_editor_tabbar.clearAll();
            closePopup();
            current_file = null;
            accordion.cells("functions").clearIcon();
        }
    });
 }


// Function to save current file async mode 
function save_current_file(automatic){    
    var mirror = get_current_code_mirror();
    if(mirror != undefined){  
        var code = mirror.getCode();
        var session_id = $("#session_id").val();
        $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=save_file&file="+current_file.toString()+"&project="+current_project.toString()+"&project_id="+current_project_id+"&code="+code+"&session_id="+session_id+"",
            beforeSend: function(objeto){
                if(automatic){
                    $("#msg").html("<img src='../images/progress_mini.gif'>");
                }else{
                    setMessage("Saving file  &nbsp;&nbsp <img src='../images/loading.gif'>");
                    //setMessage("<label class='label'> &nbsp;&nbsp;  Saving file  &nbsp;&nbsp; </label><img src='../images/progress_small.gif' height='8px' width='30px'>");
                }
            },
            complete: function(objeto, exito){
                if(exito=="success"){
                    if(automatic){
                        $('#msg').html('')
                    }else{
                        setMessage(objeto.responseText);
                        setTimeout("closePopup()",3500);
                    }
                }
            }
        });
    }
 
} 

// function to run current project
function runProject(){
    run =  getDefaultWindow("project_runner_window",800,500);
    run.setText("Gurski Browser ["+current_project+"]");
    run.progressOn();
    run.center(); 

    preview_toolbar = run.attachToolbar();
    preview_toolbar.setSkin("dhx_blue");
    preview_toolbar.addButton("back", 0,null,  "../images/back.png", null);
    preview_toolbar.addButton("next", 1,null,  "../images/next.png", null);
    preview_toolbar.addText("labelURL",2,"URL:");
    var path = "../projects/".concat(current_project.toString(), "/", current_project_index_file.toString());
    preview_toolbar.addInput("url", 3,path,400);
    preview_toolbar.addButton("run", 4,null,  "../images/run.jpg", null);
    preview_toolbar.addInput("time", 5,"30",40);
    preview_toolbar.addButton("clock", 6,null,  "../images/clock.png","../images/clockdis.png");
    preview_toolbar.addButton("stop", 7,null,  "../images/stop.png", "../images/stopdis.png");
    preview_toolbar.disableItem("stop");
    preview_toolbar.attachEvent("onClick", function(id){
        if(id === "run"){
            run.progressOn();
            historyArray.push(preview_toolbar.getValue("url").toString());
            historyNumber++;
            run.attachURL(preview_toolbar.getValue("url").toString());
            setTimeout("run.progressOff()",2000);
        }else if(id === "next"){
            historyNumber++;
            preview_toolbar.setValue("url",historyArray[historyNumber].toString() );
            run.attachURL( historyArray[historyNumber].toString() );
        }else if(id === "back"){
            if(historyNumber > 0){
                historyNumber--;
                preview_toolbar.setValue("url",historyArray[historyNumber].toString() );
                run.attachURL( historyArray[historyNumber].toString() );
            }
        }else if(id === "clock"){ 
            interval =  setInterval("run.attachURL('"+preview_toolbar.getValue("url").toString()+"');",preview_toolbar.getValue("time")*1000);
            preview_toolbar.enableItem("stop");
            preview_toolbar.disableItem("clock");
        }else if(id === "stop"){
            clearInterval(interval);
            preview_toolbar.enableItem("clock");
            preview_toolbar.disableItem("stop");
        }
    });
    
    preview_toolbar.attachEvent("onEnter", function(id){
        if(id === "url"){
            run.progressOn();
            historyArray.push(preview_toolbar.getValue("url").toString());
            historyNumber++;
            run.attachURL(preview_toolbar.getValue("url").toString());
            setTimeout("run.progressOff()",2000);
            this.clearInterval(interval);
        }
    });


    run.attachURL("../src/Linker.class.php?action=run_project&project="+current_project+"");
    historyArray.push("../src/Linker.class.php?action=run_project&project="+current_project+"");
    setTimeout("run.progressOff()",1500);
}


function deleteProject(project_name){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=delete_project&project="+project_name.toString()+"",
        beforeSend: function(objeto){
            setMessage("<label class='label'>Deleting project   </label><img src='../images/loading.gif'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage(objeto.responseText);
                this.closeAllFiles(project_name.toString());
                setTimeout("closePopup()",3500);
            }
        }
    });
}
function downloadProject(project){
    if(project != undefined){
        $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=download_project&project="+project.toString()+"",
            beforeSend: function(objeto){
                setMessage("<label class='label'>Compressing project...</label><img src='../images/loading.gif'>");
            },
            complete: function(objeto, exito){
                if(exito=="success"){
                    setMessage("<label class='label'>Project compressed...</label> ");
                    download_window =  getDefaultWindow("project_runner_window",380,120);
                    download_window.setText("Click in the link to download ["+project+"]");
                    download_window.center();
                    download_window.button("minmax1").hide();
                    download_window.denyResize();
                    download_window.attachHTMLString( objeto.responseText );
                    setTimeout("closePopup()",3500);
                }
            }
        });
    }else{
        setMessage("<label class='label'>Please select a project...</label> ");
        setTimeout("closePopup()",5000);
    }
}
function editProfile(){
    var user_id = $("#user_id").val();
    editProfileWin =  getDefaultWindow("edit_profile",800,500);
    editProfileWin.setText("Gurski [Edit Profile]");
    editProfileWin.progressOn();
    editProfileWin.center();
    editProfileWin.attachURL("../src/Linker.class.php?action=edit_profile&user_id="+user_id+"");
    setTimeout("editProfileWin.progressOff()",1500);
}
function changePassword(){
    var user_id = $("#user_id").val();
    editProfileWin =  getDefaultWindow("change_passw",600,240);
    editProfileWin.setText("Gurski [Profile > Change Password]");
    editProfileWin.progressOn();
    editProfileWin.center();
    editProfileWin.button("minmax1").hide();
    editProfileWin.attachURL("../src/Linker.class.php?action=show_change_password_window&user_id="+user_id+"");
    setTimeout("editProfileWin.progressOff()",1500);
}
function dock(){
    accordion.cells($("#active_tpl").text()).dock();
}
function undock(){
    accordion.cells($("#active_tpl").text()).undock();
}

function view_js_console(){
    js_console = getDefaultWindow("js_console",780,420);
    js_console.setText("Gurski [Javascript console]");
    js_console.progressOn();
    js_console.center();
    js_console.attachURL("../src/js_console/javascript_console.php");
    setTimeout("js_console.progressOff()",1500);
}

function project_properties(project){ 
    properties = getDefaultWindow("properties",780,310);
    properties.setText("Gurski [Project: "+project+"]");
    properties.progressOn();
    properties.setModal(true);
    properties.button("minmax1").hide();
    properties.button("minmax2").hide();
    properties.center();
    //properties.enableAutoViewport(false);
    properties.attachURL("../src/Linker.class.php?action=project_properties&project="+project);
    setTimeout("properties.progressOff()",1500);
}
function project_add_user(project){ 
    useradd = getDefaultWindow("add_user",780,280);
    useradd.setText("Gurski [Add User to project: "+project+" ]");
    useradd.progressOn();
    useradd.center();
    useradd.attachURL("../src/Linker.class.php?action=show_useradd_window&project="+project);
}
function svn_checkout(project){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_checkout&project="+project+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Checkout</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){ 
                setMessage("<label class='label'>Checkout complete...</label> ");
                setTimeout("closePopup()",3500);
                log("Checkout complete ".concat(project,"", objeto.responseText));
            }
        }
    });
}
function svn_list(project){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_list&project="+project+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN List</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN List complete...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN List ".concat(project,"", objeto.responseText));
            }
        }
    });
}
function svn_add(absolute_path, file){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_add&project="+current_project+"&file="+absolute_path+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Add</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN add complete...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN add ".concat(file,"", objeto.responseText));
            }
        }
    });
}
function svn_update(absolute_path, file){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_update&project="+current_project+"&file="+absolute_path+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Update</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN update complete...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN update ".concat(file,"", objeto.responseText));
            }
        }
    });
}
function svn_add_project(project){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_add_project&project="+project+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Add</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN add complete...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN add ".concat(project,"", objeto.responseText));
            }
        }
    });
}
function svn_status(project){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_status&project="+project+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Status</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN Status in console...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN Status ".concat(project,"", objeto.responseText));
            }
        }
    });
}
function svn_file_status(absolute_path, file){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_file_status&project="+current_project+"&file="+absolute_path+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Status</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN Status in console...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN Status ".concat(file,"", objeto.responseText));
            }
        }
    });
}
function svn_commit_file(absolute_path, file){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_commit_file&project="+current_project+"&file="+absolute_path+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Commit</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN Commit result in console...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN Commit ".concat(file,"", objeto.responseText));
            }
        }
    });
}
function svn_diff_file(absolute_path, file){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=svn_diff_file&project="+current_project+"&file="+absolute_path+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>SVN Diff</label><img src='../images/loading.gif'>");
           $("#tbarOpenSouth").click();
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                setMessage("<label class='label'>SVN Diff result in console...</label> ");
                setTimeout("closePopup()",3500);
                log("SVN Diff ".concat(file,"", objeto.responseText));
            }
        }
    });
}
function verifyInvitation(){
    var user_id = $("#user_id").val(); 
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=verify_invitation&user_id="+user_id+"",
        beforeSend: function(objeto){
           setMessage("<label class='label'>Testing. verification.</label><img src='../images/loading.gif>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                closePopup();
                $("#popmsg").html(objeto.responseText);
            }
        }
    });
}
function about(project){
    aboutWindow = getDefaultWindow("properties",450,200);
    aboutWindow.setText("Gurski About");
    aboutWindow.setModal(true);
    aboutWindow.hideHeader();
    /*about.button("minmax1").hide();
    about.button("minmax2").hide(); */
    aboutWindow.center();
    aboutWindow.attachURL("../src/Linker.class.php?action=about");
}

/*a function to make log in the console*/
function log(text){
   var console = document.getElementById('console'); 
   $("#console").append("<br>".concat(console_counter," >> ", trim(text) ));
   console_counter++;
   console.scrollTop = console.scrollHeight;
}
function setMessage(msg){
	var m = msg.toString();
	$("#message").html(m);
	openPopup();
}
function openPopup(){
   $("#message").animate({ opacity:100 }, 1500);
}

function closePopup(){
   $("#message").animate({ opacity:0 }, "slow");
}
function syntax_check(file){
    if (file === null){
       file = current_file.toString();
       $("#tbarOpenSouth").click();
    }
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=syntax_check&file="+file+"&project="+current_project.toString()+"",
        beforeSend: function(objeto){
            $("#msg").html("<img src='../images/progress_mini.gif'>");
            log("Checking  "+file+" syntax...");  
        },
        complete: function(objeto, exito){
            if(exito=="success"){
               log( trim(objeto.responseText ));
               $('#msg').html('');
            }
        }
    });
    
}

// Show User Preferences Intereface

function userPreferences(){
    var user_id = $("#user_id").val(); 
    preferences =  getDefaultWindow("user_preferences",500,350);
    preferences.setText("Gurski [User Preferences]");
    preferences.progressOn();
    preferences.center();
    preferences.attachURL("../src/Linker.class.php?action=user_preferences&user_id="+user_id+""); 
}

function registerLoad(){
        var user_id = $("#user_id").val();
        var session_id = $("#session_id").val();
        $.ajax({
            type: "POST",
            async:true,
            dataType: "html",
            url: "Linker.class.php",
            data: "action=register_load&user_id="+user_id+"",
            beforeSend: function(objeto){
              //log("Closing file : "+ file);
            },
            complete: function(objeto, exito){
              log(objeto.responseText);
            }
        });
}
function viewLog(){
    logViewer =  getDefaultWindow("log_viewer",800,600);
    logViewer.setText("Gurski [View Logs]");
    logViewer.center();
    logViewer.attachURL("../logs/logs.log");
}




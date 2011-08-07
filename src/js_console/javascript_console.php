<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><title>Interpreter - JavaScript Interactive Interpreter</title> 
        
        <link href="console_resources/interpreter.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="console_resources/MochiKit.js"></script>
	<script src="console_resources/Base.js" type="text/javascript"></script>
	<script src="console_resources/Iter.js" type="text/javascript"></script>
	<script src="console_resources/Logging.js" type="text/javascript"></script>
	<script src="console_resources/DateTime.js" type="text/javascript"></script>
	<script src="console_resources/Format.js" type="text/javascript"></script>
	<script src="console_resources/Text.js" type="text/javascript"></script>
	<script src="console_resources/Async.js" type="text/javascript"></script>
	<script src="console_resources/DOM.js" type="text/javascript"></script>
	<script src="console_resources/Selector.js" type="text/javascript"></script>
	<script src="console_resources/Style.js" type="text/javascript"></script>
	<script src="console_resources/LoggingPane.js" type="text/javascript"></script>
	<script src="console_resources/Color.js" type="text/javascript"></script>
	<script src="console_resources/Signal.js" type="text/javascript"></script>
	<script src="console_resources/Position.js" type="text/javascript"></script>
	<script src="console_resources/Visual.js" type="text/javascript"></script>
	<script src="console_resources/DragAndDrop.js" type="text/javascript"></script>
	<script src="console_resources/Sortable.js" type="text/javascript"></script>
        <script type="text/javascript" src="console_resources/interpreter.js"></script></head>
   <body style="background-color:white;"> 
          
        <form id="interpreter_form" autocomplete="on" >
            <div id="interpreter_area"  style="background-color:black;">
                <div id="interpreter_output"><span class="banner"> <b>Gurski Javascript Interactive Console (Powered by Mochikit) </b> <br><br></span><br><span class="code"></span> </div>
            </div>
            <div id="oneline" style="background-color:white;">
                <input id="interpreter_text" name="input_text" class="textbox" size="122" maxlength="5000" type="text">
            </div>
            <div id="multiline" style="display:none">
               <textarea id="interpreter_textarea" name="input_textarea" type="text" class="textbox" cols="97" rows="10"></textarea>  
                <br>
            </div>
        </form>
         
    </body>
    </html>
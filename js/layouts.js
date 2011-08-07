/*
*	DEMO HELPERS
*/


/**
* debugData
*
* Pass me a data structure {} and I'll output all the key/value pairs - recursively
*
* @param Object  o_Data   A JSON-style data structure
* @param String  s_Title  Title for dialog (optional)
* @param Boolean  recurseData  Pass 'false' to only output the first level of data - default=true
*/
function debugData (o_Data, s_Title, recurseData) {
	var str=(s_Title) ? s_Title : 'DATA';
	str += '\n***'+'****************************'.substr(0,str.length);
	parse(o_Data, ''); // recursive parsing
	alert(str); // display data

	function parse ( data, prefix ) {
		if (typeof prefix=='undefined') prefix='';
		try {
			$.each( data, function (key, val) {
				if (typeof val=='function') // FUNCTION
					str+='\n'+prefix+key+':  function()';
				else if (typeof val=='string') // STRING
					str+='\n'+prefix+key+':  "'+val+'"';
				else if (typeof val !='object') // NUMBER or BOOLEAN
					str+='\n'+prefix+key+':  '+val;
				else if (isArray(val)) // ARRAY
					str+='\n'+prefix+key+':  [ '+val.toString()+' ]'; // output delimited array
				else { // JSON
					if (recurseData===false || !hasKeys(val))
						str+='\n'+prefix+key+':  { }';
					else {
						str+='\n'+prefix+key+': {';
							parse( val, prefix+'    '); // recurse another level deeper - indent output
						str+='\n'+prefix+'}';
					}
				}
			});
		} catch (e) {}
		function isArray(o) {
			return (o && !(o.propertyIsEnumerable('length')) && typeof o==='object' && typeof o.length==='number');
		}
		function hasKeys(o) {
			var c=0;
			for (k in o) c++;
			return c;
		}
	}
}


/**
* showOptions
*
* Pass a layout-options object, and the pane/key you want to display
*/
function showOptions (o_Settings, key) {
	var data = o_Settings.options;
	$.each(key.split("."), function() {
		data = data[this]; // resurse through multiple levels
	});
	debugData( data, 'options.'+key );
}

/**
* showState
*
* Pass a layout-options object, and the pane/key you want to display
*/
function showState (o_Settings, key) {
	debugData( o_Settings.state[key], 'state.'+key );
}


/**
* createInnerLayout
*/
function createInnerLayout () {
	// innerLayout is INSIDE the center-pane of the outerLayout
	innerLayout = $( outerLayout.options.center.paneSelector ).layout( layoutSettings_Inner );
	// hide 'Create Inner Layout' commands and show the list of testing commands
	$('#createInner').hide();
	$('#createInner2').hide();
	$('#innerCommands').show();
}


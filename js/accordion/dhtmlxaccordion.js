//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
/**
*	@desc: constructor, creates an accordion item under dhtmlxaccordion
*	@pseudonym: item
*	@type: public
*/
function dhtmlXAccordionItem(){
	
}

/**
*	@desc: constructor, creates a dhtmlXAccordion object
*	@param: baseId - object/objectId
*	@param: skin - used skin
*	@type: public
*/
function dhtmlXAccordion(baseId, skin) {
	
	var that = this;
	
	this.skin = (skin!=null?skin:"dhx_blue");
	
	this.base = document.getElementById(baseId);
	this.base.className = "dhx_acc_base_"+this.skin;
	
	this.w = this.base.offsetWidth;
	this.h = this.base.offsetHeight;
	
	//alert(this.h+" "+this.base.parentNode.offsetHeight)
	
	this.idPull = {};
	
	this.opened = null;
	
	this.items = {};
	
	/**
	*	@desc: returns the handler to an item by id
	*	@param: itemId - id
	*	@type: public
	*/
	this.cells = function(itemId) {
		if (this.idPull[itemId] == null) { return null; }
		return this.idPull[itemId];//._win;
	}
	
	this._borderFix = (this.base.offsetWidth!=this.base.clientWidth?(_isIE?1:2):0);
	// ie fix for inlayout mode
	if (_isIE && this._borderFix == 0) { this._borderFix = -1; }
	
	if (_isIE && (this.skin == "dhx_blue" || this.skin == "dhx_black" || this.skin == "standard" || this.skin == "aqua_orange")) {
		this._borderFix = (document.compatMode!="BackCompat"?2:0);
	}
	// alert(document.compatMode!="BackCompat")
	// alert(this._borderFix)
	// probably not needed
	this.imagePath = window.dhx_globalImgPath||"";
	/**
	*	@desc: set path to icons
	*	@param: path - path on the hard disk
	*	@type: public
	*/
	this.setIconsPath = function(path) {
		this.imagePath = path;
	}
	
	this._initWindows = function() {
		this.dhxWins = new dhtmlXWindows();
		this.dhxWins.setSkin(this.skin);
		this.dhxWins.setImagePath("../../../dhtmlxWindows/codebase/imgs/");
		this.dhxWins.attachEvent("onTextChange", that.setText);
	}
	
	this._count = function(obj) {
		var cnt = 0;
		for (var q in obj) { cnt++; }
		return cnt;
	}
	
	/**
	*	@desc: adds a new item
	*	@param: itemId - item's id
	*	@param: itemText - item's text
	*	@type: public
	*/
	this.addItem = function(itemId, itemText) {
		
		// adding new item
		var item = document.createElement("DIV");
		item.className = "dhx_acc_item_"+this.skin;
		this.base.appendChild(item);
		
		// adding label
		var label = document.createElement("DIV");
		label._idd = itemId;
		label.className = "dhx_acc_item_label_"+this.skin+(_isIE&&document.compatMode=="BackCompat"?" dhxAccordLabelIEFix_"+this.skin:"");
		label.innerHTML = "<span></span>";
		label.onselectstart = function(e) { e = e||event; e.returnValue = false; }
		label.onclick = function() {
			if (that.checkEvent("onBeforeActive")) {
				if (that.callEvent("onBeforeActive", [this._idd])) {
					that.openItem(this._idd, "dhx_accord_outer_event");
				}
			} else {
				that.openItem(this._idd, "dhx_accord_outer_event");
			}
		}
		item.appendChild(label);
		
		// adding content
		var content = document.createElement("DIV");
		content.innerHTML = "&nbsp;";
		content.className = "dhx_acc_item_content_closed_"+this.skin;
		content.style.height = "0px";
		item.appendChild(content);
		//
		item._id = itemId;
		item._label = label;
		item._content = content;
		this.idPull[itemId] = item;
		//
		var wId = itemId;
		var win = this.dhxWins.createWindow(wId, 10, 10, 200, 200);
		win._dockCell = itemId;
		win.setText(itemText);
		win.button("close").hide();
		win.addUserButton("dock", 99, "Dock", "dock");
		win.button("dock").attachEvent("onClick", function(win) {
			that.dockWindow(win.getId());
		});
		this.dockWindow(wId);
		//
		item.win = win;
		this.items[itemId] = item;
		// this.items[this.items.length] = item;
		//
		/**
		*	@desc: returns item's id
		*	@type: public
		*/
		item.getId = function() {
			return this._id;
		}
		/**
		*	@desc: sets item's text
		*	@param: text - new text
		*	@type: public
		*/
		item.setText = function(text) {
			that.setText(this._id, text);
		}
		/**
		*	@desc: returns item's text
		*	@type: public
		*/
		item.getText = function() {
			return that.getText(this._id);
		}
		/**
		*	@desc: opens an item
		*	@type: public
		*/
		item.open = function() {
			that.openItem(this._id);
		}
		/**
		*	@desc: closes an item
		*	@type: public
		*/
		item.close = function() {
			that.closeItem(this._id);
		}
		/**
		*	@desc: sets item's icon (header icon)
		*	@param: icon - filepath
		*	@type: public
		*/
		item.setIcon = function(icon) {
			that.setIcon(this._id, icon);
		}
		/**
		*	@desc: clears item's icon
		*	@type: public
		*/
		item.clearIcon = function() {
			that.clearIcon(this._id);
		}
		/**
		*	@desc: docks an item from a window
		*	@type: public
		*/
		item.dock = function() {
			that.dockItem(this._id);
		}
		/**
		*	@desc: undocks an item to a window
		*	@type: public
		*/
		item.undock = function() {
			that.undockItem(this._id);
		}
		/**
		*	@desc: shows an item
		*	@type: public
		*/
		item.show = function() {
			that.showItem(this._id);
		}
		/**
		*	@desc: hides an item
		*	@type: public
		*/
		item.hide = function() {
			that.hideItem(this._id);
		}
		// attach
		/**
		*	@desc: attaches an object into an item
		*	@param: obj - object/object id
		*	@type: public
		*/
		item.attachObject = function(obj) {
			this.win.attachObject(obj);
		}
		/**
		*	@desc: attaches an url into an item
		*	@param: url
		*	@type: public
		*/
		item.attachURL = function(url) {
			this.win.attachURL(url);
			this._frame = this.win._frame;
		}
		// components
		/**
		*	@desc: attaches a dhtmlxGrid into an item
		*	@type: public
		*/
		item.attachGrid = function() {
			this.grid = this.win.attachGrid();
			return this.grid;
		}
		/**
		*	@desc: attaches a dhtmlxTree into an item
		*	@param: id - not mandatory, super root's id (see dhtmlxTree documentation)
		*	@type: public
		*/
		item.attachTree = function(id) {
			this.tree = this.win.attachTree(id);
			this.tree.allTree.style.overflow = "auto";
			return this.tree;
		}
		/**
		*	@desc: attaches a dhtmlxFolders into an item
		*	@type: public
		*/
		item.attachFolders = function() {
			this.folders = this.win.attachFolders();
			return this.folders;
		}
		/**
		*	@desc: attaches a dhtmlxLayout into an item
		*	@type: public
		*/
		item.attachLayout = function(view) {
			this.layout = this.win.attachLayout(view);
			return this.layout;
		}
		/**
		*	@desc: attaches a dhtmlxTabbar into an item
		*	@type: public
		*/
		item.attachTabbar = function() {
			this.tabbar = this.win.attachTabbar();
			return this.tabbar;
		}
		/**
		*	@desc: attaches a dhtmlxEditor into an item
		*	@type: public
		*/
		item.attachEditor = function() {
			this.editor = this.win.attachEditor();
			return this.editor;
		}
		/**
		*	@desc: attaches a dhtmlxMenu into an item
		*	@type: public
		*/
		item.attachMenu = function() {
			this.menu = this.win.attachMenu();
			return this.menu;
		}
		/**
		*	@desc: attaches a dhtmlxToolbar into an item
		*	@type: public
		*/
		item.attachToolbar = function() {
			this.toolbar = this.win.attachToolbar();
			return this.toolbar;
		}
		/**
		*	@desc: attaches a status bar into an item
		*	@type: public
		*/
		item.attachStatusBar = function() {
			this.status = this.win.attachStatusBar();
			return this.status;
		}
		//
		this.openItem(itemId);
		//
		return item;
	}
	
	this.openItem = function(itemId, callEvent) {
		if (this._openBuzy == true && this._enableOpenEffect == true) { return; }
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		if ((item._content.className).search("dhx_acc_item_content_opened_"+this.skin) != -1) { return; }
		
		if (this._enableOpenEffect == true) {
			var itemToHide = null;
		}
		
		// 1. close any opened items & calculate available space
		var h = 0;
		for (var a in this.idPull) {
			if (this._enableOpenEffect == true) {
				if ((this.idPull[a]._content.className).search("dhx_acc_item_content_opened_"+this.skin) != -1) {
					itemToHide = this.idPull[a];
					// fix bottom border
					if (!_isIE) { itemToHide._content.style.height = parseInt(itemToHide._content.style.height)-1+"px"; }
				}
				h += this.idPull[a].offsetHeight - this.idPull[a]._content.offsetHeight;
			} else {
				if ((this.idPull[a]._content.className).search("dhx_acc_item_content_opened_"+this.skin) != -1) { this.closeItem(a); }
				h += this.idPull[a].offsetHeight;
			}
		}
		
		// 2. open needed item
		item._content.className = "dhx_acc_item_content_opened_"+this.skin+(_isIE&&document.compatMode!="BackCompat"?" dhxAccordPolyIEFix_"+this.skin:"");
		
		if (this._enableOpenEffect == true) {
			var maxHeight = this.h - h - this._borderFix+1;
			this._openBuzy = true;
			this._openEffect(item, itemToHide, this._openStep, maxHeight);
		} else {
			item._content.style.height = this.h - h - this._borderFix + "px";
			this._fixInnerObjsOnOpen(itemId);
			// event
			if (callEvent == "dhx_accord_outer_event") {
				this.callEvent("onActive", [itemId]);
			}
		}
		// IE fix some skins
		if (_isIE && this.skin == "nb_black") {
			
		}
	}
	
	this._fixInnerObjsOnOpen = function(itemId) {
		var win = this.dhxWins.window(itemId);
		if (win.grid) { win.grid.setSizes(); win.grid.setSizes(); }
		if (win.tabbar) { win.tabbar.adjustOuterSize(); }
		if (win.menu) { win.menu._redistribTopLevelPositions(); }
		if (win.accordion) { win.accordion.setSizes(); }
		if (win.layout) { win.layout.setSizes(win); }
		if (win.folders != null) { win.folders.setSizes(); }
		if (win.editor) { if (_isOpera) { window.setTimeout(function(){win.editor.adjustSize();},10); } else { win.editor.adjustSize(); } }
	}
	
	this._enableOpenEffect = false;
	this._openStep = 15;
	this._openStepIncrement = 10;
	this._openStepTimeout = 10;
	this._openBuzy = false;
	
	this._opera950FixData = "";
	
	this._openEffect = function(item, itemToHide, step, maxHeight) {
		
		var goOn = false;
		var h = parseInt(item._content.style.height);
		var newH = 0;
		
		if (h + step < maxHeight) {
			newH = h + step;
			goOn = true;
		} else {
			newH = maxHeight;
		}
		
		item._content.style.height = newH+"px";
		
		if (itemToHide != null) {
			var hh = parseInt(itemToHide._content.style.height);
			hh = hh - (newH - h);
			if (hh < 0) { hh = 0; }
			itemToHide._content.style.height = hh+"px";
		}
		
		if (goOn == true) {
			// opera 9.50 fix #1 start
			/*
			if (_isOpera) {
				if (this._opera950FixData == "") { this._opera950FixData = item._content.childNodes[0].childNodes[2].className; }
				item._content.childNodes[0].childNodes[2].className = "";
				window.setTimeout(function(){
								item._content.childNodes[0].childNodes[2].className = that._opera950FixData;
								that._openEffect(item, itemToHide, (step+that._openStepIncrement), maxHeight);
							}, this._openStepTimeout);
			} else {
				*/
				window.setTimeout(function(){ that._openEffect(item, itemToHide, (step+that._openStepIncrement), maxHeight); }, this._openStepTimeout);
				/*
			}
			*/
			// opera 9.50 fix #1 end
		} else {
			if (itemToHide != null) {
				itemToHide._content.className = "dhx_acc_item_content_closed_"+this.skin;
				itemToHide._content.style.height = "0px";
			}
			this._fixInnerObjsOnOpen(item._id);
			//
			this._openBuzy = false;
			// opera 9.50 fix #2 start
			if (_isOpera) {
				var p = item._content.childNodes[0].childNodes[2].className;
				item._content.childNodes[0].childNodes[2].className = "";
				window.setTimeout(function(){item._content.childNodes[0].childNodes[2].className = p;},1);
			}
			// opera 9.50 fix #2 end
			// event
			this.callEvent("onActive", [item._id]);
		}
	}
	
	this.closeItem = function(itemId) {
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		item._content.className = "dhx_acc_item_content_closed_"+this.skin;
		item._content.style.height = "0px";
	}
	
	this.setText = function(itemId, itemText) {
		if (that.idPull[itemId] == null) { return; }
		that.idPull[itemId]._label.childNodes[0].innerHTML = itemText;
		if (that.idPull[itemId].win != null) { that.idPull[itemId].win.childNodes[2].innerHTML = itemText; }
	}
	
	this.getText = function(itemId) {
		if (that.idPull[itemId] == null) { return; }
		return that.idPull[itemId]._label.childNodes[0].innerHTML;
	}
	this.dockWindow = function(wId) {
		if (this.idPull[wId] == null) { return; }
		if (this.dhxWins.window(wId) == null) { return; }
		//
		this.showItem(wId);
		// 1. getting window
		var win = this.dhxWins.window(wId);
		// editor fix
		if (win.editor != null) { var winEditorStoredData = win.editor.getContent(); }
		//
		win._isDocked = true;
		var data = win._content;
		data.parentNode.removeChild(data);
		win.hide();
		// 2. prepare accordion's polygon
		while (this.idPull[wId]._content.childNodes.length > 0) { this.idPull[wId]._content.removeChild(this.idPull[wId]._content.childNodes[0]); }
		
		data.style.width = "100%";
		data.style.height = "100%";
		
		this.idPull[wId]._content.appendChild(data);
		// editor fix
		if (win.editor != null && winEditorStoredData != null) {
			var iconsPath = win.editor.iconsPath;
			win.editor = win.attachEditor();
			win.editor.setIconsPath(iconsPath);
			win.editor.init();
			win.editor.setContent(winEditorStoredData);
		}
		// fix grid sizes
		/*
		if (win.grid != null) { win.grid.setSizes(); }
		// fix tabbar sizes
		if (win.tabbar) { win.tabbar.adjustOuterSize(); }
		// fix menu toplevel visibility
		if (this.idPull[wId]._content.className != "dhx_acc_item_content_closed_"+this.skin) {
			if (win.menu != null) { win.menu._redistribTopLevelPositions(); }
		}
		*/
		this._fixInnerObjsOnOpen(wId);
	}
	
	this.undockWindow = function(wId) {
		if (this.idPull[wId] == null) { return; }
		if (this.dhxWins.window(wId) == null) { return; }
		// 1. gettinw window
		var win = this.dhxWins.window(wId);
		// editor fix
		if (win.editor != null) { var winEditorStoredData = win.editor.getContent(); }
		//
		win._isDocked = false;
		var winCell = win.childNodes[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[1];
		// prepare accordion's polygon
		var data = this.idPull[wId]._content.childNodes[0];
		data.parentNode.removeChild(data);
		this.idPull[wId]._content.innerHTML = "&nbsp;";
		//
		winCell.appendChild(data);
		//
		if (win._isParked) {
			data.style.height = "0px";
		} else {
			win.setDimension(400, 300);
		}
		//
		win.show();
		win.bringToTop();
		win.center();
		// editor fix
		if (win.editor != null && winEditorStoredData != null) {
			var iconsPath = win.editor.iconsPath;
			win.editor = win.attachEditor();
			win.editor.setIconsPath(iconsPath);
			win.editor.init();
			win.editor.setContent(winEditorStoredData);
		}
		// fix grid sizes
		/*
		if (win.grid != null) { win.grid.setSizes(); }
		if (!win._isParked) {
			// fix menu toplevel visibility
			if (win.menu != null) { win.menu._redistribTopLevelPositions(); }
		}
		// fix tabbar sizes
		if (win.tabbar) { win.tabbar.adjustOuterSize(); }
		*/
		this._fixInnerObjsOnOpen(wId);
		// hide item
		this.hideItem(wId);
	}
	
	/**
	*	@desc: changes object instance's size according to the outer container
	*	@type: public
	*/
	this.setSizes = function() {
		this.h = this.base.offsetHeight;
		var itemOpened = null;
		var h = 0;
		for (var a in this.idPull) {
			if ((this.idPull[a]._content.className).search("dhx_acc_item_content_opened_"+this.skin) != -1) {
				itemOpened = this.idPull[a];
				h += this.idPull[a].offsetHeight - this.idPull[a]._content.offsetHeight;
			} else {
				h += this.idPull[a].offsetHeight;
			}
		}
		if (itemOpened != null) {
			itemOpened._content.style.height = this.h - h - (_isIE?-1:-1) + "px";
			this._fixInnerObjsOnOpen(itemOpened._id);
		}
	}
	
	this.showItem = function(itemId) {
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		if (item.className == "dhx_acc_item_"+this.skin) { return; }
		item.className = "dhx_acc_item_"+this.skin;
		this.setSizes();
	}
	
	this.hideItem = function(itemId) {
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		if (item.className == "dhx_acc_item_hidden_"+this.skin) { return; }
		item.className = "dhx_acc_item_hidden_"+this.skin;
		this.setSizes();
	}
	
	/**
	*	@desc: iterator, calls a user-defined function n-times
	*	@param: handler - user defined-function, item's object is passed as an incoming argument
	*	@type: public
	*/
	this.forEachItem = function(handler) {
		for (var a in this.idPull) {
			handler(this.idPull[a]);
		}
	}
	
	/**
	*	@desc: sets open effect
	*	@param: state - true/false to enable/disable, disabled by default
	*	@type: public
	*/
	this.setEffect = function(state) {
		this._enableOpenEffect = state;
	}
	
	this.setActive = function(itemId) {
		this.openItem(itemId);
	}
	
	this.dockItem = function(itemId) {
		this.dockWindow(itemId);
	}
	
	this.undockItem = function(itemId) {
		this.undockWindow(itemId);
	}
	
	this.setIcon = function(itemId, icon) {
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		if (item._label.childNodes.length < 2) {
			var img = document.createElement("IMG");
			img.className = "dhx_acc_item_icon_"+this.skin;
			item._label.appendChild(img);
		}
		item._label.childNodes[1].src = this.imagePath+icon;
	}
	
	this.clearIcon = function(itemId) {
		if (this.idPull[itemId] == null) { return; }
		var item = this.idPull[itemId];
		while (item._label.childNodes.length > 1) { item._label.removeChild(item._label.childNodes[1]); }
	}
	
	
	this._initWindows();
	dhtmlxEventable(this);
	
	return this;
	
}
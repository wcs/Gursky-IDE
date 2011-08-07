//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
dhtmlXWindows.prototype._enableWebToolbar = function() {this._attachWebToolbar = function(win) {win._toolbarId = win._tidd;win._toolbarH = (_isIE?24:24)
 win._toolbarT = (_isIE?23:24);win.toolbar = new dhtmlXToolbarObject(win._toolbarId, this.skin);win._content.childNodes[1].style.display = "";win._content.childNodes[1].style.height = win._toolbarH + "px";win._content.childNodes[2].style.top = win._toolbarT + (win._menuT!=null?win._menuT:0) + "px";if (_isIE){win._IEFixMTS = true;if (document.compatMode == "BackCompat"){var pad = win._toolbarT + (win._menuT!=null?win._menuT:0) + (win._sbH!=null?win._sbH:0);win._content.childNodes[2].style.paddingBottom = pad + "px"}};if (win.menu != null){win._content.childNodes[1].className += " dhtmlxToolbar_"+this.skin+"_bottom_top"};if (win.grid != null){win.grid.setSizes()};if (win.accordion != null){win.accordion.setSizes()};if (win.layout != null){win.layout.setSizes(win)};if (_isIE=="adv"){var that = this;var dim = win.getDimension();win.setDimension(dim[0], dim[1]+1);that._redrawWindow(win);window.setTimeout(function(){var dim=win.getDimension();win.setDimension(dim[0],dim[1]-1);that._redrawWindow(win)},1)};return win.toolbar}};
//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
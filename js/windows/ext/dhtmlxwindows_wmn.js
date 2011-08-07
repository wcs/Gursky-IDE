//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
dhtmlXWindows.prototype._enableWebMenu = function() {this._attachWebMenu = function(win) {win._menuId = win._midd;win._menuH = (_isIE?25:22);win._menuT = (_isIE?24:23);win.menu = new dhtmlXMenuObject(win._menuId, "topId");var skin = "glassy_blue";switch (this.skin) {case "glassy_blue":
 case "glassy_blue_light":
 
 win._menuH = 23;win._menuT = 23;break;case "dhx_black":
 case "dhx_blue":
 skin = this.skin;if (win.toolbar != null){win._menuH = 25;win._menuT = 25;win._content.childNodes[0].className += " dhtmlxMenu_"+this._skin+"_bottom_border"}else {win._menuH = 24;win._menuT = 24};break};win.menu.setSkin(skin);win._content.childNodes[0].style.display = "";win._content.childNodes[0].style.height = win._menuH + "px";win._content.childNodes[2].style.top = win._menuT + (win._toolbarT!=null?win._toolbarT:0) + "px";if (_isIE){win._IEFixMTS = true;if (document.compatMode == "BackCompat"){var pad = win._menuT + (win._toolbarT!=null?win._toolbarT:0) + (win._sbH!=null?win._sbH:0);win._content.childNodes[2].style.paddingBottom = pad + "px"}};if (_isOpera && win.layout != null){win.layout._fixCellsContentOpera950()};if (win.accordion != null){win.accordion.setSizes()};if (win.layout != null){win.layout.setSizes(win)};return win.menu}};
//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
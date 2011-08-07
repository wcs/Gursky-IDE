//v.2.1 build 90226

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
/*_TOPICS_
@0:Initialization
@1:Visual appearence
@3:Event Handlers
*/


/**
*   @desc:  TabBar Object
*   @param: parentObject - parent html object or id of parent html object
*   @param: mode - tabbar mode - top.bottom,left,right; top is default
*   @param: height - height of tab (basis size)
*   @type: public
*   @topic: 0
*/
function dhtmlXTabBar(parentObject,mode,height)
{
	this._isIE7s=((_isIE)&&window.XMLHttpRequest&&(document.compatMode != "BackCompat"));
	
		dhtmlxEventable(this);
        mode=mode||"top";
        this._mode=mode+"/";
        this._linePos=2;
        this._eczF=true;
		this._bFix=4;
		this._imgPath=window.dhx_globalImgPath||""; 
	   if (_isIE) this.preventIECashing(true);

        //get parent object
        if (typeof(parentObject)!="object")
            this.entBox=document.getElementById(parentObject);
        else
            this.entBox=parentObject;

        this.width  = this.entBox.getAttribute("width") || this.entBox.style.width || (window.getComputedStyle?window.getComputedStyle(this.entBox,null)["width"]:(this.entBox.currentStyle?this.entBox.currentStyle["width"]:0));
        this.height = this.entBox.getAttribute("height") || this.entBox.style.height || (window.getComputedStyle?window.getComputedStyle(this.entBox,null)["height"]:(this.entBox.currentStyle?this.entBox.currentStyle["height"]:0));

		if (((this.width||"").indexOf("%")!=-1)||((this.width||"").indexOf("%")!=-1))
			this.enableAutoReSize(true,true);

        if ((!this.width)||(this.width=="auto")||(this.width.indexOf("%")!=-1)||(parseInt(this.width)==0))
                this.width=this.entBox.offsetWidth+"px";

        if ((!this.height)||(this.height.indexOf("%")!=-1)||(this.height=="auto"))
			this.height=this.entBox.offsetHeight+"px";

        this.activeTab = null;          //initialize activeTab
        this.tabsId = new Object();

        this._align="left";
        this._offset=5;
        this._margin=1;
        this._height=parseInt(height||20);
        this._bMode=(mode=="right"||mode=="bottom");
        this._tabSize='150';
        this._content=new Array();
        this._tbst="win_text";
        this._styles={
            winDflt:["p_left.gif","p_middle.gif","p_right.gif","a_left.gif","a_middle.gif","a_right.gif","a_middle.gif",3,3,6,"#F4F3EE","#F0F8FF",false],
            winScarf:["with_bg/p_left.gif","with_bg/p_middle.gif","with_bg/p_right_skos.gif","with_bg/a_left.gif","with_bg/a_middle.gif","with_bg/a_right_skos.gif","with_bg/p_middle_over.gif",3,18,6,false,false,false],
            winBiScarf:["with_bg/p_left_skos.gif","with_bg/p_middle.gif","with_bg/p_right_skos.gif","with_bg/a_left_skos.gif","with_bg/a_middle.gif","with_bg/a_right_skos.gif","with_bg/p_middle_over.gif",18,18,6,false,false,false],
            winRound:["circuses/p_left.gif","circuses/p_middle.gif","circuses/p_right.gif","circuses/a_left.gif","circuses/a_middle.gif","circuses/a_right.gif","circuses/p_middle_over.gif",10,10,6,false,false,false],
            silver:["silver/p_left.gif","silver/p_middle.gif","silver/p_right.gif","silver/a_left.gif","silver/a_middle.gif","silver/a_right.gif","silver/p_middle.gif",7,8,6,"#F4F3EE","#F0F8FF","white"],
            modern:["modern/p_left.gif","modern/p_middle.gif","modern/p_right.gif","modern/a_left.gif","modern/a_middle.gif","modern/a_right.gif","modern/p_middle_over.gif",5,5,6,false,false,"white"],
glassy_blue:["dhxgrid_glassy_blue/p_left.png","dhxgrid_glassy_blue/p_middle.png","dhxgrid_glassy_blue/p_right.png","dhxgrid_glassy_blue/a_left.png","dhxgrid_glassy_blue/a_middle.png","dhxgrid_glassy_blue/a_right.png","dhxgrid_glassy_blue/p_middle.png",2,3,8,false,false,"white",null,3,3,-4],
dhx_blue:["blue/r_p.png","blue/c_p.png","blue/l_p.png","blue/r_a.png","blue/c_a.png","blue/l_a.png","blue/c_p.png",2,2,4,false,false,"transparent",0,2,0,0,";border:1px solid #C2D5DC; border-top:1px solid #C2D5DC; background-color:#D2E3EA","#D2E3EA","top/blue/close.gif","top/blue/scrl_r.gif","top/blue/scrl_l.gif"],
dhx_black:["dark/r_p.png","dark/c_p.png","dark/l_p.png","dark/r_a.png","dark/c_a.png","dark/l_a.png","dark/c_p.png",2,2,4,false,false,"transparent",0,2,0,0,";border:1px solid #333333; border-top:1px solid #626262; background-color:#000000","#333333","top/dark/close.gif","top/dark/scrl_r.gif","top/dark/scrl_l.gif"]
            



        };

        this._createSelf(mode=="right"||mode=="left");            //generate TabBar DOM structure
        this.setStyle("winDflt");
        this._TabCloseButton = false;
        this._TabCloseButtonSrc = 'close.png';
        this._TabScrRight="scrl_r.gif";
        this._TabScrLeft="scrl_l.gif";

		this._enableAutoRowAdd = false;
        return this;
}

/**
*   @desc:  set offset before first tab on tabbar
*   @param: offset - offset value
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setOffset = function(offset){
        this._offset=offset;
}
/**
*   @desc:  set align of tabs on tabbar
*   @param: align - left/right for gorizontal tabbar, top/bottom for vertical tabbar
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setAlign = function(align){
        if (align=="top") align="left";
        if (align=="bottom") align="right";
        this._align=align;
}
/**
*   @desc:  set distance between tabs
*   @param: margin - margin value
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setMargin = function(margin){
        this._margin=margin;
}





/**
*   @desc: create DOM Structure
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._createSelf = function(vMode)
{
        this._tabAll=document.createElement("DIV");
        this._tabZone=document.createElement("DIV");
        this._conZone=document.createElement("DIV");


        this.entBox.appendChild(this._tabAll);
//#4DTabs:23052006{
if (this._bMode){
        this._tabAll.appendChild(this._conZone);
        this._tabAll.appendChild(this._tabZone);
        }
        else
//#}
        {
        this._tabAll.appendChild(this._tabZone);
        this._tabAll.appendChild(this._conZone);
        }


        this._vMode=vMode;
//#4DTabs:23052006{
        if (vMode){
            this._tabAll.className='dhx_tabbar_zoneV';
            this._setSizes=this._setSizesV;
            this._redrawRow=this._redrawRowV;

            }
        else
//#}
            this._tabAll.className='dhx_tabbar_zone';

//#4DTabs:23052006{
        if (this._bMode)
            this._tabAll.className+='B';
//#}
        this._tabZone.className='dhx_tablist_zone';
        this._conZone.className='dhx_tabcontent_zone';

        this._tabZone.onselectstart = function(){ return false; };
        this._tabAll.onclick = this._onClickHandler;
        this._tabAll.onmouseover = this._onMouseOverHandler;
        if (_isFF)
            this._tabZone.onmouseout = this._onMouseOutHandler;
        else
            this._tabZone.onmouseleave = this._onMouseOutHandler;
        this._tabAll.tabbar=this;

        this._lineA=document.createElement("div");
        this._lineA.className="dhx_tablist_line";

        this._lineA.style[vMode?"left":"top"]=(this._bMode?0:(this._height+this._linePos))+"px";
        if (this._lineAHeight)
			this._lineA.style[vMode?"width":"height"]=this._lineAHeight;
        this._lineA.style[vMode?"height":"width"]=parseInt(this[vMode?"height":"width"])+((_isIE && document.compatMode!="BackCompat")?2:0)+"px";
//#4DTabs:23052006{
        if(vMode)
            this._conZone.style.height=parseInt(this.height)+"px";
        else
//#}
            this._conZone.style.width=parseInt(this.width)-(_isFF?2:0)+"px";

        this.rows=new Array();
        this.rowscount=1;
        this._createRow();
        this._setSizes();
}

/**
*   @desc:  create DOM structures of tabbar row
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._createRow = function(){
    var z=document.createElement("DIV");
    z.className='dhx_tabbar_row';
    this._tabZone.appendChild(z);
        z._rowScroller=document.createElement('DIV');
        z._rowScroller.style.display="none";
        z.appendChild(z._rowScroller);
    this.rows[this.rows.length]=z;
//#4DTabs:23052006{
    if (this._vMode){
        z.style.width=this._height+3+"px";
        z.style.height=parseInt(this.height)+"px";
        if (!this._bMode)
            this.setRowSizesA();
        else
            this.setRowSizesB();
     }
     else
//#}
     {
    z.style.height=parseInt(this._height)+3+"px";
     z.style.width=parseInt(this.width)+((_isIE && document.compatMode!="BackCompat")?2:0)+"px";
     }

     z.appendChild(this._lineA);
}


dhtmlXTabBar.prototype._removeRow=function(row){
    row.parentNode.removeChild(row);
    var z=new Array();
    for (var i=0; i<this.rows.length; i++)
        if (this.rows[i]!=row) z[z.length]=this.rows[i];

    this.rows=z;
}

dhtmlXTabBar.prototype._checkSizes = function(row){
    var count=parseInt(this._offset);
    for (var i=0; i<row.tabCount; i++) {
        if (row.childNodes[i].style.display=="none") continue;
        count+=row.childNodes[i]._offsetSize+this._margin*1;
    }
//#scrollers:23052006{
    return (row.offsetWidth<(count-this._margin*1));
//#}

}
/**
*   @desc: fix sizes of tabbar, can be used after changing size of tabbar parent node
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._setSizes = function(){ 

       this._tabAll.height=this.height;
        this._tabAll.width=this.width;

        if (this._tabZone.childNodes.length)
            var z=this._tabZone.lastChild.offsetTop-this._tabZone.firstChild.offsetTop+this._height;
        else
            var z=this._height+(_isIE?5:0);

        var a=z-2;
        this._tabZone.style.height=(a>0?a:0)+"px";
        a=parseInt(this.height)-z-this._bFix;
        this._conZone.style.height=(a>0?a:0)+"px";

        
}
//#4DTabs:23052006{
/**
*   @desc: fix sizes of tabbar, version for vertical toolbar
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._setSizesV = function(){
        this._tabAll.height=this.height;
        this._tabAll.width=this.width;

        var z=this._height*this.rows.length;

        if (!this._bMode){
        this._tabZone.style.width=z+3+"px";
        this._conZone.style.width=parseInt(this.width)-(z+(_isFF?5:3))+"px";
        this._conZone.style.left= z+3+"px";
        }
        else{
        this._tabZone.style.width=z+3+"px";
        this._conZone.style.width=parseInt(this.width)-(z+3)+"px";
        this._tabZone.style.left=parseInt(this.width)-(z+3)+"px";
        }

        this._conZone.style.height=parseInt(this.height)-(_isFF?2:0)+"px";
        

        
        this._tabZone.style.height=parseInt(this.height)+"px";
}


/**
*   @desc: redraw row in tabbar, version for vertical tabbar
*   @param: row - row in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._redrawRowV=function(row){
        var talign=this._align=="left"?"top":"bottom";
        var count=parseInt(this._offset);
        for (var i=0; i<row.tabCount; i++){
			if (row.childNodes[i].style.display=="none") continue;
            row.childNodes[i]._cInd=i;
            row.childNodes[i].style[talign]=count+"px";
            count+=row.childNodes[i]._offsetSize+parseInt(this._margin);
        }
//#scrollers:23052006{
            if ((row.offsetHeight<count-parseInt(this._margin))||(parseInt(row.childNodes[0].style[this._align=="left"?"top":"bottom"])<0))
                 this._showRowScroller(row);
             else
                 this._hideRowScroller(row); 
//#}

};

//#multiline:23052006{
/**
*   @desc: move tab's row to the top
*   @param: tab - tab object
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._setTabTop=function(tab){
    if (!this._vMode){
    if (tab.parentNode!=this.rows[0])
        this._tabZone.insertBefore(tab.parentNode,this.rows[0]);
        }

    var j=new Array();
    j[j.length]=tab.parentNode;

    for (var i=0; i<this.rows.length; i++)
        if (this.rows[i]!=tab.parentNode)
            j[j.length]=this.rows[i];
    this.rows=j;

    if (this._vMode) this.setRowSizesB();
    else this.setRowSizesC();

	//fix for STUPID Netscape 8
	this._lineA.parentNode.removeChild(this._lineA);
    this.rows[0].appendChild(this._lineA);
}
//#}

/**
*   @desc: set row positions for left mode
*   @param: tab - tab object
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype.setRowSizesA=function(){
     for (var i=0; i<this.rows.length; i++){
        this.rows[i].style.left=i*this._height+"px";
        this.rows[i].style.zIndex=5+i;
        }
}
/**
*   @desc: set row positions for right
*   @param: tab - tab object
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype.setRowSizesB=function(){
     for (var i=this.rows.length-1; i>=0; i--){
        this.rows[i].style.left=i*this._height+"px";
        this.rows[i].style.zIndex=15-i;
        }
}
/**
*   @desc: fix zIndex of rows in right mode (is it still necessary???)
*   @param: tab - tab object
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype.setRowSizesC=function(){
     for (var i=this.rows.length-1; i>=0; i--){
        this.rows[i].style.zIndex=15-i;
        }
}

//#}

//#scrollers:23052006{
/**
*   @desc:  initialize scrollers for the row
*   @param: row - row in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._initScroller = function(row){
    var z=row._rowScroller;
//#4DTabs:23052006{
    if (this._vMode)
        z.innerHTML="<img src='"+this._imgPath+"scrl_t.gif' style='display:block;'><img src='"+this._imgPath+"scrl_b.gif'>";
    else
//#}
        z.innerHTML="<img src='"+this._imgPath+this._TabScrLeft+"'><img src='"+this._imgPath+this._TabScrRight+"'>";
    if (this._align=="left")
    {
        z.childNodes[1].onclick=this._scrollRight;
        z.childNodes[0].onclick=this._scrollLeft;
    }
    else
    {
        z.childNodes[1].onclick=this._scrollLeft;
        z.childNodes[0].onclick=this._scrollRight;
    }
    z.className='dhx_tablist_scroll';
    z._init=1;  
}
/**
*   @desc:  scroll tabbar in left direction
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._scrollLeft=function(){
    var that=this.parentNode.parentNode.parentNode.parentNode.tabbar;
    var row=this.parentNode.parentNode;
    if (!row.scrollIndex)
        row.scrollIndex=0;

    row.scrollIndex--;
    if (row.scrollIndex<0) { row.scrollIndex=0; return; }

    var shift=row.childNodes[row.scrollIndex]._offsetSize+that._margin*1;
    that._offset+=shift;
    that._redrawRow(row);
    return shift;
};
/**
*   @desc:  scroll tabbar to specified tab
*   @param: tab - tab in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._scrollTo=function(tab){  //  if (this._vMode) return 0;
    var that=this;
    var row=tab.parentNode;
    if (!row._rowScroller._init) this._initScroller(row);
//#4DTabs:23052006{
    if (this._vMode)
        var z=parseInt(tab.style[that._align=="left"?"top":"bottom"])+tab._offsetSize-parseInt(that.height);
    else
//#}
        var z=parseInt(tab.style[that._align])+tab._offsetSize-parseInt(that.width);

    while (z>0)
        if (that._align=="left")
            z-=row._rowScroller.childNodes[1].onclick();
        else
            z-=row._rowScroller.childNodes[0].onclick();
//#4DTabs:23052006{
    if (this._vMode)
        var z=parseInt(tab.style[that._align=="left"?"top":"bottom"])-tab._offsetSize;
    else
//#}
        var z=parseInt(tab.style[that._align])-tab._offsetSize;

    while (z<0)
        if (that._align=="left")
            z+=row._rowScroller.childNodes[0].onclick();
        else
            z+=row._rowScroller.childNodes[1].onclick();

};
/**
*   @desc:  scroll tabbar in right direction
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._scrollRight=function(){
    var that=this.parentNode.parentNode.parentNode.parentNode.tabbar;
    var row=this.parentNode.parentNode;
    if (row.tabCount-row.scrollIndex<2) return;

    if (!row.scrollIndex)
        row.scrollIndex=0;

    var shift=row.childNodes[row.scrollIndex]._offsetSize+that._margin*1;
    that._offset-=shift;
    that._redrawRow(row);
    row.scrollIndex++;
    return shift;
};
/**
*   @desc: hide scrollers in the row
*   @param: row - row in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._hideRowScroller = function(row){
    row._rowScroller.style.display='none';
}

/**
*   @desc: enable/disable scrollers ( enabled by default )
*   @param: mode - true/false
*   @type: public
*   @edition: Professional
*   @topic: 0
*/
dhtmlXTabBar.prototype.enableScroll = function(mode){
        this._edscr=(!convertStringToBoolean(mode));
		if(this._edscr)
        	for (var i=0; i<this.rows.length; i++)
		  		this._hideRowScroller(this.rows[i]);
}


/**
*   @desc: show scrollers in the row
*   @param: row - row in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._showRowScroller = function(row){
	if (this._edscr) return;
//#scrollers:23052006{
    if (!row._rowScroller._init) this._initScroller(row);
    row._rowScroller.style.display='block';
//#}
//#4DTabs:23052006{
    if (this._vMode){
        if (this._align=="left")
            row._rowScroller.style.top=row.scrollTop-38+parseInt(this.height)+"px";
        else
            row._rowScroller.style.top=row.scrollTop+4+"px";
        this._lineA.style.top=row.scrollLeft+"px";
    }
    else
//#}
    {
        if (this._align=="left")
            row._rowScroller.style.left=row.scrollLeft-38+parseInt(this.width)+"px";
        else
            row._rowScroller.style.left=row.scrollLeft+4+"px";
        this._lineA.style.left=row.scrollLeft+"px";
    }

}
//#}
/**
*   @desc: onTab mouse over handler
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._onMouseOverHandler=function(e)
{
        if (_isIE)
            var target = event.srcElement;
        else
            var target = e.target;

        target=this.tabbar._getTabTarget(target);
        if (!target)   {
            this.tabbar._hideHover(target); return;
            }

        this.tabbar._showHover(target);

        (e||event).cancelBubble=true;
}
/**
*   @desc: onTab mouse out handler
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._onMouseOutHandler=function(e)
{
    this.parentNode.tabbar._hideHover(null); return;
}




/**
*   @desc: onTab Click handler
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._onClickHandler=function(e)
{
        if (_isIE)
            var target = event.srcElement;
        else
            var target = e.target;

      	if (document.body.onclick) document.body.onclick(e);
      	if (_isIE){
       		document.body.fireEvent("onclick",event);
   		} else {
   			var cl=document.createEvent("MouseEvents")
			cl.initEvent("click", true, true)
			document.body.dispatchEvent(cl)
		}
		
        (e||event).cancelBubble=true;


        target=this.tabbar._getTabTarget(target);
        if (!target || !this.tabbar.tabsId[target.idd]) return;

        this.tabbar._setTabActive(target);
        return false;
}

/**
*   @desc: return tab object from parentNode collections
*   @param: t - some child node
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._getTabTarget=function(t){
	if (!t) return null;
    while ((!t.className)||(t.className.indexOf("dhx_tab_element")==-1)){
        if ((t.className)&&(t.className.indexOf("dhx_tabbar_zone")!=-1)) return null;
        t=t.parentNode;
        if (!t) return null;
        }
    return t;
}

/**
*   @desc: redraw row in tabbar
*   @param: row - row in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._redrawRow=function(row){
        var count=parseInt(this._offset);
        for (var i=0; i<row.tabCount; i++){
			if (row.childNodes[i].style.display=="none") continue;
            row.childNodes[i]._cInd=i;
            row.childNodes[i].style[this._align]=count+"px";
            count+=row.childNodes[i]._offsetSize+parseInt(this._margin);
        }
//#scrollers:23052006{
            if ((row.offsetWidth<count-parseInt(this._margin))||(parseInt(row.childNodes[0].style[this._align])<0))
                 this._showRowScroller(row);
             else
                 this._hideRowScroller(row);
//#}
    };


/**
*   @desc: remove tab from tabbar
*   @param: tab - id of tab
*   @param: mode - if set to true, selection jump from current tab to nearest one
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.removeTab = function(tab,mode){
	if (this.wins) this.wins[tab]=null;
    var tab=this.tabsId[tab];
    if (!tab) return;

	if (this._content[tab.idd]){
		this._content[tab.idd].parentNode.removeChild(this._content[tab.idd]);
	    this._content[tab.idd]=null;
		}

    this._goToAny(tab,mode);

    var row=tab.parentNode;
    row.removeChild(tab);
    row.tabCount--;
    if ((row.tabCount==0)&&(this.rows.length>1))
        this._removeRow(row);
    delete this.tabsId[tab.idd];
    this._redrawRow(row)
    this._setSizes();    
}

dhtmlXTabBar.prototype._goToAny=function(tab,mode){
    if ((this._lastActive)==tab)
        if (convertStringToBoolean(mode)) { if (null===this.goToPrevTab()) if (null===this.goToNextTab()) this._lastActive=null; }
        else this._lastActive=null;
}

/**
*   @desc: add tab to TabBar
*   @param: id - tab id
*   @param: text - tab content
*   @param: size - width(height) of tab
*   @param: position - tab index , optional
*   @param: row - index of row, optional  [only in PRO version]
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.addTab = function(id, text, size, position, row){    // return 0;
    row=row||0;
//#multiline:23052006{
    if (this.rows.length<=row)
        for (var i=this.rows.length; i<=row; i++)
            this._createRow();
//#}
    var z=this.rows[row].tabCount||0;
    if ((!position)&&(position!==0))
        position=z;

	var nss=this._getTabStyle(id);
    var tab=this._createTab(text, size, this._TabCloseButton, nss);
    tab.idd=id;
    this.tabsId[id] = tab;
    var close = tab.childNodes[2].getElementsByTagName('img')[0];
    if (this._TabCloseButton && close){
	    var self = this;
	    close.onclick = function(){
	    	self.callEvent("onTabClose",[id]);
	    	self.removeTab(id, true);
    	}
    }

    this.rows[row].insertBefore(tab,this.rows[row].childNodes[position]);

	var prevCount = this.rows[row].tabCount;
    this.rows[row].tabCount=z+1;

    if (size=="*") this.adjustTabSize(tab);
//#multiline:23052006{
    if ( this._enableAutoRowAdd && this._checkSizes(this.rows[row]) ) {
    	this.rows[row].tabCount = prevCount;
    	delete this.tabsId[id];
    	this.rows[row].removeChild(tab);
    	row++;
    	position = this.rows[row] ? this.rows[row].tabCount : 0;

    	this.addTab(id, text, size, position, row);
    	return;
    }
//#}

    this._redrawRow(this.rows[row]);
    this._setSizes();

}

//#multiline:23052006{

/**
*   @desc: enable mode, in which new row created automatically to prevent tab scrollers
*   @param: mode - true|false - enable | disable
*	@edition:  professional
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.enableAutoRow=function(mode){
	this._enableAutoRowAdd=convertStringToBoolean(mode);
}


/**
*   @desc: reformat tabbar to remove tab scrollers
*   @param: limit - width of tabbar zone, optional
*   @param: full - true | false - force to change size of tabs to make rows of equal width
*	@edition:  professional
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.normalize=function(limit,full){
	limit=limit||this._tabZone.offsetWidth;
	var tabs=[];
	for (var j=0; j<this.rows.length; j++)
		for (var i=0; i<this.rows[j].tabCount; i++)
		tabs[tabs.length]=this.rows[j].removeChild(this.rows[j].childNodes[0]);

	this._tabZone.innerHTML="";
	this.rows=[];

	this._createRow();
	var row=0; var size=this._offset*1;
	var sizes=[];
	this.rows[row].tabCount=0;
	for (var i=0; i<tabs.length; i++)
		if ((size + tabs[i]._offsetSize + this._margin*1) < limit){
		    this.rows[row].insertBefore(tabs[i],this.rows[row].childNodes[this.rows[row].tabCount]);
			this.rows[row].tabCount++
			size+=tabs[i]._offsetSize + this._margin*1;
			}
		else {
			sizes[row]=size;
			this._createRow();
			i--;	row++;     size=this._offset*1;
			this.rows[row].tabCount=0;
			continue;
		}
	sizes[row]=size;
	
	if (full){
		var max=sizes[0];
		for (var i=1; i<this.rows.length; i++)
			max=Math.max(max,sizes[i]);
			
		for (var i=0; i<this.rows.length; i++)
			if (sizes[i]<max){
				var tab=this.rows[i].childNodes[this.rows[i].tabCount-1];
				var size=tab._offsetSize+(max-sizes[i]);
				this.adjustTabSize(tab,size);
			}

	}

	for (var i=0; i<this.rows.length; i++)
        this._redrawRow(this.rows[i]);
	this._setSizes();
}
//#}

/**
*   @desc: showing hover over tab
*   @param: tab - tab in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._showHover=function(tab){
	if (tab._disabled) return;
    this._hideHover(tab);
    if (tab==this._lastActive) return;
    var nss=this._getTabStyle(tab.idd);
    switch (this._tbst){
        case "win_text":
           tab._lChild.style.backgroundImage='url('+this._imgPath+this._mode+nss[6]+')';
        break;
    }
    this._lastHower=tab;
}
dhtmlXTabBar.prototype._getTabStyle=function(id){
	var nss=this._styles[this._cstyle];	if (nss["id_"+id]) nss=nss["id_"+id];
	return nss;
}
/**
*   @desc: set specific colors for specific tab
*   @param: id - id of tab for which setting will be applied
*   @param: color - tab color
*   @param: color - scolor - color in selected state ( optional)
*   @param: css - css class will be attached to text of tab in question
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setCustomStyle=function(id,color,scolor,css){
	var nss=this._styles[this._cstyle];	
	if (nss["id_"+id]) nss=nss["id_"+id];
	else { nss = ( nss["id_"+id] = ([]).concat(nss) ); }
	nss[10]=color;
	nss[11]=scolor;
	nss[13]=css
		}


/**
*   @desc: hiding hover over tab
*   @param: tab - tab in question
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._hideHover=function(tab){
    if ((!this._lastHower)||(this._lastHower==tab)||(this._lastHower==this._lastActive))
        return;
    var nss=this._getTabStyle(this._lastHower.idd);
    switch (this._tbst){
        case "win_text":
               this._lastHower._lChild.style.backgroundImage='url('+this._imgPath+this._mode+nss[1]+')';
        break;
    }
    this._lastHower=null;
}

/**
*   @desc: return tab by it's id
*   @param: tabId - id of searced tab
*   @type: private
*   @topic: 1
*/
dhtmlXTabBar.prototype._getTabById=function(tabId){
    return this.tabsId[tabId];
}

/**
*   @desc: switch tab to active state
*   @param: tabId - id of tab
*	@param: mode - if to run onTabChanged handler (true by default)
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setTabActive=function(tabId,mode,hide){
	if (hide){
    	this.showTab(tabId);	
    	for (var a  in this.tabsId)
    		if (a!=tabId) this.hideTab(a)
    }
    var tab=this._getTabById(tabId);
    if (tab) this._setTabActive(tab,(mode===false));    
}
/**
*   @desc: switch tab to active state
*   @param: tab - tab object
*	@param: mode - if to run onTabChanged handler (true by default)
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._setTabActive=function(tab,mode){ 
	if (tab==this._lastActive) return false;
	var nss=this._styles[this._cstyle]
	if (nss["id_"+tab.idd]) nss=nss["id_"+tab.idd];
	
	if ((tab._disabled)||(tab.style.display=="none")) return false;
    if ((!mode) && !this.callEvent("onSelect",[tab.idd,this._lastActive?this._lastActive.idd:null])) return false;
    
    tab.className=tab.className.replace(/dhx_tab_element_inactive/g,"dhx_tab_element_active");
    if  (nss[11])
        tab.style.backgroundColor=nss[11];
        
    this._setContent(tab);    
	this._deactivateTab();
//#4DTabs:23052006{
    if (this._vMode){
      switch (this._tbst){
          case "win_text":
              tab._lChild.style.backgroundImage='url('+this._imgPath+this._mode+nss[4]+')';
              tab.childNodes[0].childNodes[0].src=this._imgPath+this._mode+nss[3];
              tab.childNodes[1].childNodes[0].src=this._imgPath+this._mode+nss[5];
              tab.style.height=parseInt(tab.style.height)+nss[9]+"px";
              tab._lChild.style.height=parseInt(tab._lChild.style.height)+nss[9]+"px";
              tab.style[this._align=="right"?"marginBottom":"marginTop"]=(nss[16]||-3)+"px"
              tab.style.width=this._height+(nss[15]||3)+"px";
              //if (this._bMode)
                  tab._lChild.style.width=this._height+(nss[15]||3)+"px";
              this._conZone.scrollLeft=tab._scrollState||0;
          break;
      }
    }
    else
//#}
    {
      switch (this._tbst){
          case "win_text":
              tab._lChild.style.backgroundImage='url('+this._imgPath+this._mode+nss[4]+')';
              tab.childNodes[0].childNodes[0].src=this._imgPath+this._mode+nss[3];
              tab.childNodes[1].childNodes[0].src=this._imgPath+this._mode+nss[5];
              tab.style.width=parseInt(tab.style.width)+nss[9]+"px";
              tab._lChild.style.width=parseInt(tab._lChild.style.width)+nss[9]+"px";
              tab.style[this._align=="left"?"marginLeft":"marginRight"]=(nss[16]||-3)+"px"
              tab.style.height=this._height+(nss[15]||3)+"px";
//#4DTabs:23052006{
              if (this._bMode)
                  tab._lChild.style.height=this._height+(nss[15]||3)+"px";
//#}
			   this._conZone.scrollTop=tab._scrollState||0;
			   
          break;
      }
    }


//#multiline:23052006{
//#4DTabs:23052006{
    if (this._bMode)
        this._setTabTop(tab);
	else
//#}
	    this._setTabBottom(tab);
//#}

//#scrollers:23052006{
    this._scrollTo(tab);
//#}



    this._lastActive=tab;
	return true;
}

//#multiline:23052006{
/**
*   @desc: move tab's row to the bottom
*   @param: tab - tab object
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._setTabBottom=function(tab){
    if (!this._vMode){
    if (tab.parentNode!=this.rows[this.rows.length-1])
        this._tabZone.appendChild(tab.parentNode);
        }

    var j=new Array();
    for (var i=0; i<this.rows.length; i++)
        if (this.rows[i]!=tab.parentNode)
            j[j.length]=this.rows[i];
    j[j.length]=tab.parentNode;
    this.rows=j;

//#4DTabs:23052006{
    if (this._vMode) this.setRowSizesA();
//#}
	//fix for STUPID Netscape 8
	if (this._lineA.parentNode!=this.rows[this.rows.length-1]){
		this._lineA.parentNode.removeChild(this._lineA);
	    this.rows[this.rows.length-1].appendChild(this._lineA);
	}
}
//#}



/**
*   @desc: create DOM structures of tab
*   @param: text - tab content
*   @param: size - width (height) of the tab
*   @type: private
*   @topic: 0
*/
dhtmlXTabBar.prototype._createTab = function(text,size,IsCloseButton,nss){
    var tab=document.createElement("DIV");
    tab.className='dhx_tab_element dhx_tab_element_inactive';
    var thml="";
	if (size=="*") {
		size="10";
		tab.style.whiteSpace="nowrap";
	}
	
    switch (this._tbst){
        case 'text':
            thml=text;
        break;
        case 'win_text':
//#4DTabs:23052006{
            if (this._vMode)
            {
            thml='<div style="position:absolute; '+(this._bMode?"right":"left")+':0px; top:0px; height:'+nss[7]+'px; width:'+(this._height+(nss[15]||3))+'px;"><img src="'+this._imgPath+this._mode+nss[0]+(((_isFF||this._isIE7s||_isOpera))?'" style="position:absolute; '+(this._bMode?"right":"left")+':1px;"':'"')+'></div>';
            thml+='<div style="position:absolute; '+(this._bMode?"right":"left")+':0px; bottom:0px; height:'+nss[8]+'px; width:'+(this._height+(nss[15]||3))+'px;"><img src="'+this._imgPath+this._mode+nss[2]+(((_isFF||this._isIE7s||_isOpera))?'" style="position:absolute; '+(this._bMode?"right":"left")+':1px;"':'"')+'></div>';
            thml+='<div style="position:absolute; background-repeat: repeat-y; background-image:url('+this._imgPath+this._mode+nss[1]+'); width:'+(this._height)+'px; left:0px; top:'+nss[7]+'px; height:'+(parseInt(size||this._tabSize)-nss[8]-nss[7]+"px")+(nss[13]?('" class="'+nss[13]):'')+'">'+text+'';
			if (IsCloseButton) {
				thml+='<img src="'+(this._imgPath+this._TabCloseButtonSrc)+'" style="cursor:pointer;position:absolute;right:2px;bottom:4px;" onclick="" />';
			}
			thml+='</div>';
            }
            else
//#}
            {
            thml='<div style="position:absolute; '+(this._bMode?"bottom":"top")+':0px; left:0px; width:'+nss[7]+'px; height:'+(this._height+(nss[15]||3))+'px;"><img src="'+this._imgPath+this._mode+nss[0]+((this._bMode&&(_isOpera||_isFF||this._isIE7s))?'" style="position:absolute; bottom:0px;"':'"')+'></div>';
            thml+='<div style="position:absolute;'+(this._bMode?"bottom":"top")+':0px; right:0px; width:'+nss[8]+'px; height:'+(this._height+(nss[15]||3))+'px;"><img src="'+this._imgPath+this._mode+nss[2]+((this._bMode&&(_isOpera||_isFF||this._isIE7s))?'" style="position:absolute; bottom:0px; left:0px;"':'"')+'></div>';
            thml+='<div style="position:absolute; background-repeat: repeat-x; background-image:url('+this._imgPath+this._mode+nss[1]+'); height:'+(this._height+(this._bMode?1:3))+'px; top:0px; left:'+nss[7]+'px; width:'+(parseInt(size||this._tabSize)-nss[8]-nss[7]+"px")+';">';
			if (IsCloseButton) {
				thml+='<img src="'+(this._imgPath+this._TabCloseButtonSrc)+'" style="cursor:pointer;position:absolute;right:0px;top:4px;" onclick="" />';
			}
			thml+='<div style="padding-top:3px;" '+(nss[13]?('" class="'+nss[13]+'"'):'')+'>'+text+'</div>';
			thml+='</div>';
            }
            if (!nss[10]) tab.style.backgroundColor='transparent';
            else tab.style.backgroundColor=nss[10];
        break;
        }
    tab.innerHTML=thml;
	//Netscape 7.1 fix
	tab.style.padding="0px";
    tab._lChild=tab.childNodes[tab.childNodes.length-1];


//#4DTabs:23052006{
   if (this._vMode)
        {
        tab.style.height=parseInt(size||this._tabSize)+"px";
        tab.style.width=this._height+(nss[14]||1)+"px";
        }
    else
//#}
        {

        tab.style.width=parseInt(size||this._tabSize)+"px";
        tab.style.height=this._height+(nss[14]||1)+"px";
        }

    tab._offsetSize=parseInt(size||this._tabSize);
    return tab;
}

dhtmlXTabBar.prototype.adjustTabSize=function(tab,size){
	var nss=this._getTabStyle(tab.idd);
	size=size||tab.scrollWidth+(this._TabCloseButton?50:20);
	tab.style[this._vMode?"height":"width"]=size+"px";
	tab.childNodes[2].style[this._vMode?"height":"width"]=size-nss[8]-nss[7]+"px";
	tab._offsetSize=size;
}

/**
*   @desc: reinitialize  tabbar
*   @type: public
*   @topic: 0
*/
dhtmlXTabBar.prototype.clearAll = function(){
	var z=this._conZone.style.backgroundColor;
	this._content=new Array();
    this.tabsId=new Array();
    this.rows=new Array();
    this._lastActive=null;
    this._lastHower=null;
    this.entBox.innerHTML="";
	this._glframe=null;   
	this.wins={};

    this._createSelf(this._vMode);
    this.setStyle(this._cstyle);
	if (z) this._conZone.style.backgroundColor=z;

	this.enableContentZone(this._eczF);
}



/**
*   @desc: set path to image folder ( not affect already created element until their state changes ) 
*   @param: path - path to image folder
*   @type: public
*   @topic: 0
*/
dhtmlXTabBar.prototype.setImagePath = function(path){
    this._imgPath=path;
}




/**
*     @desc: load tabbar from xml string
*     @type: public
*     @param: xmlString - XML string
*     @param: afterCall - function which will be called after xml loading
*     @topic: 0
*/
dhtmlXTabBar.prototype.loadXMLString = function(xmlString, afterCall) {
    this.XMLLoader = new dtmlXMLLoaderObject(this._parseXML, this, true, this.no_cashe);
    this.XMLLoader.waitCall = afterCall || 0;
    this.XMLLoader.loadXMLString(xmlString);
};
/**
*     @desc: load tabbar from xml file
*     @type: public
*     @param: file - link too XML file
*     @param: afterCall - function which will be called after xml loading
*     @topic: 0
*/
dhtmlXTabBar.prototype.loadXML=function(file,afterCall){
	this.callEvent("onXLS",[]);
	this.XMLLoader=new dtmlXMLLoaderObject(this._parseXML,this,true,this.no_cashe);
	this.XMLLoader.waitCall=afterCall||0;
	this.XMLLoader.loadXML(file);
}


    dhtmlXTabBar.prototype._getXMLContent=function(node){
       var text="";
       for (var i=0; i<node.childNodes.length; i++)
            {
                var z=node.childNodes[i];
                text+=(z.nodeValue===null?"":z.nodeValue);
            }
       return text;
    }
/**
*     @desc: parse xml of tabbar
*     @type: private
*     @param: that - tabbar object
*     @param: obj - xmlLoader object
*     @topic: 0
*/
   dhtmlXTabBar.prototype._parseXML=function(that,a,b,c,obj){
   		that.clearAll();
        var selected="";
        if (!obj) obj=that.XMLLoader;

          var atop=obj.getXMLTopNode("tabbar");
          var arows = obj.doXPath("//row",atop);
//#href_support:24052006{
            that._hrfmode=atop.getAttribute("hrefmode")||that._hrfmode;
//#}
            that._margin =atop.getAttribute("margin")||that._margin;
            that._align  =atop.getAttribute("align") ||that._align;
            that._offset =atop.getAttribute("offset")||that._offset;

            var acs=atop.getAttribute("tabstyle");
            if (acs) that.setStyle(acs);

            acs=atop.getAttribute("skinColors");
            if (acs) that.setSkinColors(acs.split(",")[0],acs.split(",")[1]);
            for (var i=0; i<arows.length; i++){
              var atabs = obj.doXPath("./tab",arows[i]);
                for (var j=0; j<atabs.length; j++){
                    var width=atabs[j].getAttribute("width");
                    var name=that._getXMLContent(atabs[j]);
                    var id=atabs[j].getAttribute("id");
                    that.addTab(id,name,width,"",i);
                    if (atabs[j].getAttribute("selected")) selected=id;

//#href_support:24052006{
                    if (that._hrfmode)
                        that.setContentHref(id,atabs[j].getAttribute("href"));
                    else
//#}
                    for (var k=0; k<atabs[j].childNodes.length; k++){
						var cont=atabs[j].childNodes[k];
                        if (cont.tagName=="content"){
							if (cont.getAttribute("id"))
							   that.setContent(id,cont.getAttribute("id"));
							else
    	                        that.setContentHTML(id,that._getXMLContent(cont));
							}
					}


                }
            }
        if (selected) that.setTabActive(selected);
        that.callEvent("onXLE",[that]);
    }

    /**
    *     @desc: set function called after xml loading/parsing ended
    *     @param: func - event handling function
    *     @type: public
    *     @edition: Professional
    *     @topic: 3
    *     @event:  onXMLLoadingEnd
    *     @eventdesc: event fired simultaneously with ending XML parsing, new items already available in tabbar
    *     @eventparam: tabbar object
    */
   dhtmlXTabBar.prototype.setOnLoadingEnd=function(func){
		this.attachEvent("onXLE",func);
    };
    /**
    *     @desc: set function called after tab content loaded ( works only for ajax based tabs )
    *     @param: func - event handling function
    *     @type: public
    *     @edition: Professional
    *     @topic: 3
    *     @event:  onTabLoaded
    *     @eventdesc: event fired imideatly after tab content loaded and can be accessed through DOM
    *     @eventparam: id of tab for which content loaded
    */
   dhtmlXTabBar.prototype.setOnTabContentLoaded=function(func){
		this.attachEvent("onTabContentLoaded",func);
    };
    
    /**
    *     @desc: set function called after tab closed, works only in "closeButton" mode
    *     @param: func - event handling function
    *     @type: public
    *     @topic: 3
    *     @event:  onTabClose
    *     @eventdesc: event fired imideatly before tab closed by pressing close button, returning false block closing
    *     @eventparam: id of tab for which content loaded
    */
   dhtmlXTabBar.prototype.setOnTabClose=function(func){
		this.attachEvent("onTabClose",func);
    };    


//#href_support:24052006{
/**
*     @desc: forcing to load tab in question
*     @type: public
*     @param: tabId - id of tab in question
*     @param: href - new href, optional
*     @topic: 0
*/
    dhtmlXTabBar.prototype.forceLoad=function(tabId,href){
	    var tab=this.tabsId[tabId];
        if (href) this._hrefs[tabId]=href;
		this._content[tab.idd]._loaded=false;

		this._setContent(tab,(!this._lastActive || this._lastActive.idd!=tabId));
	}

/**
*     @desc: set mode of loading external content
*     @type: public
*     @param: mode - href mode - ifram/iframes/ajax
*     @topic: 0
*/
         dhtmlXTabBar.prototype.setHrefMode=function(mode){
            this._hrfmode=mode;
        }
/**
*     @desc: set content as a href to an external file
*     @type: public
*     @param: href - link too external file
*     @topic: 1
*/
         dhtmlXTabBar.prototype.setContentHref=function(id,href){
            if (!this._hrefs)   this._hrefs=new Array();
            this._hrefs[id]=href;
            switch(this._hrfmode){
                case "iframe":
                        if (!this._glframe){
                            var z=document.createElement("DIV");
                            z.className="dhx_tabcontent_sub_zone";
                            z.innerHTML="<iframe frameborder='0' width='100%' height='100%' src='"+this._imgPath+"blank.html'></iframe>";
                            this._glframe=z.childNodes[0];
                            this._conZone.appendChild(this._glframe);
                            }
/*return*/              return; 
                    break;
                case "iframes":
                case "iframes-on-demand":
                            var z=document.createElement("DIV");
                            z.className="dhx_tabcontent_sub_zone";
                            z.style.display='none';
                            z.innerHTML="<iframe frameborder='0' width='100%' height='100%' src='"+((this._hrfmode=="iframes")?href:(this._imgPath+"blank.html"))+"'></iframe>";
                            this.setContent(id,z);
                    break;
                case "ajax":
                case "ajax-html":
                            var z=document.createElement("DIV");
                            z.className="dhx_tabcontent_sub_zone";
                            this.setContent(id,z);
                    break;
            }
            this._content[id]._loaded=false;
        }

/**
*     @desc: return window of tab content for iframe based tabbar
*     @type: public
*     @param: tab_id - tab id
*     @topic: 1
*/
        dhtmlXTabBar.prototype.tabWindow=function(tab_id){
            if  (this._hrfmode.indexOf("iframe")==0)
                return (this._content[tab_id]?this._content[tab_id].childNodes[0].contentWindow:null);
        }

         dhtmlXTabBar.prototype._ajaxOnLoad=function(obj,a,b,c,loader){
			if (obj[0]._hrfmode=="ajax"){
	            var z=loader.getXMLTopNode("content");
				var val=obj[0]._getXMLContent(z);
				}
			else var val=loader.xmlDoc.responseText;

			obj[0]._resolveContent(obj[1],val);
            //#size_adjust:18072006{
                obj[0].adjustSize();
            //#}
			obj[0].callEvent("onTabContentLoaded",[obj[1]]);
			obj[0].callEvent("onXLE",[obj[0]]);
        }
		dhtmlXTabBar.prototype._resolveContent=function(id,val){
			var z=val.match(/<script[^>]*>[^\f]*?<\/script>/g);
			if (this._content[id]){
				this._content[id].innerHTML=val;
				if (z)
  					for (var i=0; i<z.length; i++){
  						 if (window.execScript)
  						 	window.execScript(z[i].replace(/<([\/]{0,1})script[^>]*>/g,""));
  						 else
  						 	window.eval(z[i].replace(/<([\/]{0,1})script[^>]*>/g,""));
  					}
			}
		}
//#}


/**
*     @desc: set content of tab
*     @type: public
*     @param: id - id of tab
*     @param: nodeId - id of container, or container object
*     @topic: 3
*     @event: onSelect
*     @eventdesc: event called when any tab selected
*     @eventparam: id - id of tab
*     @eventreturn: if false returned the selection aborted
*/
    dhtmlXTabBar.prototype.setOnSelectHandler=function(func){
    	this.attachEvent("onSelect",func);
    }
/**
*     @desc: set content of tab
*     @type: public
*     @param: id - id of tab
*     @param: nodeId - id of container, or container object
*     @topic: 1
*/
    dhtmlXTabBar.prototype.setContent=function(id,nodeId){
        if (typeof(nodeId)=="string")
            nodeId=document.getElementById(nodeId);
		nodeId.className+=" dhx_tabcontent_sub_zone";

		if (this._content[id])
			this._content[id].parentNode.removeChild(this._content[id]);

        this._content[id]=nodeId;
	    this._content[id]._loaded=true;        
	    
        if (nodeId.parentNode) nodeId.parentNode.removeChild(nodeId);
        nodeId.style.position="absolute";
		if (this._dspN){
    	    nodeId.style.display="none";
	        nodeId.style.visibility="visible";
			}
		else{
	        nodeId.style.visibility="hidden";
    	    nodeId.style.display="block";
			}
        nodeId.style.top="0px";        nodeId.style.top="0px";
        this._conZone.appendChild(nodeId);
        if ((this._lastActive)&&(this._lastActive.idd==id)) this._setContent(this._lastActive);
    }


/**
*     @desc: set content of tab
*     @type: private
*     @param: tab - tab in question
*     @topic: 0
*/
    dhtmlXTabBar.prototype._setContent=function(tab,stelth){
//#href_support:24052006{
        if (this._hrfmode)
           switch(this._hrfmode){
                case "iframe":
                    this._glframe.src=this._hrefs[tab.idd];
                    return;
                break;
                case "iframes":
				case "iframes-on-demand":
					if ((this._hrfmode=="iframes-on-demand")&&(!this._content[tab.idd]._loaded))
						{
							this._content[tab.idd].childNodes[0].src=this._hrefs[tab.idd];
                        	this._content[tab.idd]._loaded="true";
						}
                break;
                case "ajax":
                case "ajax-html":
                    var z=this._content[tab.idd];
                    if (!z._loaded) {
                        z.innerHTML="<div class='dhx_ajax_loader'><img src='"+this._imgPath+"loading.gif' />&nbsp;Loading...</div>";
                        this.callEvent("onXLS",[]);
                        (new dtmlXMLLoaderObject(this._ajaxOnLoad,[this,tab.idd],true,this.no_cashe)).loadXML(this._hrefs[tab.idd]);
                        z._loaded=true;
                        }
                break;
           }
//#}

		if (!stelth){
            this._hideContent();

        if (this._content[tab.idd])
			if (this._dspN)
	            this._content[tab.idd].style.display='block';
			else{
	            this._content[tab.idd].style.visibility='';
	            this._content[tab.idd].style.zIndex=2;
	        }
        }
        //#size_adjust:18072006{
            this.adjustSize();
        //#}
    }
    dhtmlXTabBar.prototype._hideContent=function(){
        if ((this._lastActive)&&(this._content[this._lastActive.idd]))
		if (this._dspN)
	        this._content[this._lastActive.idd].style.display='none';
		else{
	        this._content[this._lastActive.idd].style.visibility='hidden';
	        this._content[this._lastActive.idd].style.zIndex=-1;
	    }
	}
/**
*     @desc: set content of tab, as HTML string
*     @type: public
*     @param: id - id of tab
*     @param: html - html string
*     @topic: 1
*/
    dhtmlXTabBar.prototype.setContentHTML=function(id,html){
        var z=document.createElement("DIV");
        z.className="dhx_tabcontent_sub_zone";
        z.innerHTML=html;
        this.setContent(id,z);
    }

/**
*     @desc: set style used for tabbar
*     @type: public
*     @param: name - any valid style name
*     @topic: 0
*/
    dhtmlXTabBar.prototype.setSkin=function(name){
        if (this._styles[name]){
                this._cstyle=name;
                if(this._styles[this._cstyle][12])
                    this._conZone.style.backgroundColor=this._styles[this._cstyle][12];
            	this._tabAll.className='dhx_tabbar_zone'+(this._vMode?"V":"")+(this._bMode?"B":"")+' dhx_tabbar_zone_'+name;
            }
        var s=this._styles[this._cstyle]
        if (this._lineA && s[17])
        	this._lineA.style.cssText+=s[17];
        if (s[18])
        	this._conZone.style.border="1px solid "+s[18];
        this._TabCloseButtonSrc=s[19]||this._TabCloseButtonSrc;
        this._TabScrRight=s[20]||this._TabScrRight;
        this._TabScrLeft=s[21]||this._TabScrLeft;
        
        this._tabZone.className+=" skin_"+name;
    }
    dhtmlXTabBar.prototype.setStyle=dhtmlXTabBar.prototype.setSkin;


/**
*     @desc: enable/disable content zone (enabled by default)
*     @type: public
*     @param: mode - true/false
*     @topic: 0
*/
    dhtmlXTabBar.prototype.enableContentZone=function(mode){
		this._eczF=convertStringToBoolean(mode);
        this._conZone.style.display=this._eczF?"":'none';
        }

/**
*     @desc: enable/disable force hiding mode, solves IE problems with iframes in HTML content, but can cause problems for other dhtmlx components inside tabs
*     @type: public
*     @param: mode - true/false
*     @topic: 0
*/
    dhtmlXTabBar.prototype.enableForceHiding=function(mode){
        this._dspN=convertStringToBoolean(mode);
        }

/**
*     @desc: allow to set skin specific color, must be used AFTER selecting skin
*     @type: public
*     @param: a_tab - color of activ tab
*     @param: p_tab - color of passive tab
*     @param: c_zone - color of content zone  (optional)
*     @topic: 0
*/
    dhtmlXTabBar.prototype.setSkinColors=function(a_tab,p_tab,c_zone){
        this._styles[this._cstyle][10]=p_tab;
        this._styles[this._cstyle][11]=a_tab;
        this._conZone.style.backgroundColor=c_zone||a_tab;
    }

/**
*     @desc: get id of current active tab
*     @type: public
*     @return: id of current active tab
*     @topic: 0
*/
dhtmlXTabBar.prototype.getActiveTab=function(){
    if (this._lastActive) return this._lastActive.idd;
    return null;
}

/**
*   @desc: makes all tabs inactive
*   @type: private
*   @topic: 1
*/
dhtmlXTabBar.prototype._deactivateTab=function(){
	if (!this._lastActive)  return;
	var oss=this._styles[this._cstyle]
	if (oss["id_"+this._lastActive.idd]) oss=oss["id_"+this._lastActive.idd];
	if  (oss[10])	
		this._lastActive.style.backgroundColor=oss[10];
	this._lastActive.className=this._lastActive.className.replace(/dhx_tab_element_active/g,"dhx_tab_element_inactive");
	
    if (this._vMode)
      switch (this._tbst){
          case "win_text":
              if (this._lastActive){
              this._lastActive._scrollState=this._conZone.scrollLeft;
              this._lastActive._lChild.style.backgroundImage='url('+this._imgPath+this._mode+oss[1]+')';
              this._lastActive.childNodes[0].childNodes[0].src=this._imgPath+this._mode+oss[0];
              this._lastActive.childNodes[1].childNodes[0].src=this._imgPath+this._mode+oss[2];
              this._lastActive.style.height=parseInt(this._lastActive.style.height)-oss[9]+"px";
              this._lastActive._lChild.style.height=parseInt(this._lastActive._lChild.style.height)-oss[9]+"px";
              this._lastActive.style[this._align=="right"?"marginBottom":"marginTop"]="0px"
              this._lastActive.style.width=this._height+(oss[14]||1)+"px";
              if (this._bMode)
                  this._lastActive._lChild.style.width=this._height+(oss[14]||1)+"px";
              }
	    }
	else
	  switch (this._tbst){
	    case "win_text":
        	if (this._lastActive){
				this._lastActive._scrollState=this._conZone.scrollTop;
				this._lastActive._lChild.style.backgroundImage='url('+this._imgPath+this._mode+oss[1]+')';
				this._lastActive.childNodes[0].childNodes[0].src=this._imgPath+this._mode+oss[0];
				this._lastActive.childNodes[1].childNodes[0].src=this._imgPath+this._mode+oss[2];
				this._lastActive.style.width=parseInt(this._lastActive.style.width)-oss[9]+"px";
				this._lastActive._lChild.style.width=parseInt(this._lastActive._lChild.style.width)-oss[9]+"px";
				this._lastActive.style[this._align=="left"?"marginLeft":"marginRight"]="0px"
				this._lastActive.style.height=this._height+(oss[14]||1)+"px";
//#4DTabs:23052006{
            if (this._bMode)
                this._lastActive._lChild.style.height=this._height+(oss[14]||1)+"px";
//#}
            }
	    }
		this._lastActive=null;	
}

/**
*     @desc: select tab next to active
*     @type: public
*     @return: id of current active tab
*     @topic: 0
*/
dhtmlXTabBar.prototype.goToNextTab=function(tab){
	var z=tab||this._lastActive;
    if (z){
        if (z.nextSibling.idd){
            if (!this._setTabActive(z.nextSibling))
                return  this.goToNextTab(z.nextSibling);
            return z.nextSibling.idd;
            }
        else
            if (z.parentNode.nextSibling){
                var arow=z.parentNode.nextSibling.childNodes[0];
                if (!this._setTabActive(arow))
					return  this.goToNextTab(arow);
                return arow.idd;
                }
        }
    return null;
}
/**
*     @desc: select tab previous to active
*     @type: public
*     @return: id of current active tab
*     @topic: 0
*/
dhtmlXTabBar.prototype.goToPrevTab=function(tab){
	var z=tab||this._lastActive;
    if (z){
        if (z.previousSibling){
            if (!this._setTabActive(z.previousSibling))
				return this.goToPrevTab(z.previousSibling);
            return this._lastActive.idd;
            }
        else
            if (z.parentNode.previousSibling){
                var arow=z.parentNode.previousSibling.childNodes;
				if ((!arow)||(!arow.tabCount)) return null;
				arow=arow[arow.tabCount-1];
                if (!this._setTabActive(arow))
					return this.goToPrevTab(arow);
                return arow.idd;
                }
    }
    return null;
}

//#size_adjust:18072006{
/**
*     @desc: enable disable auto adjusting height and width   to inner content
*     @type: public
*     @param: autoWidth - enable/disable auto adjusting width
*     @param: autoHeight - enable/disable auto adjusting height
*     @topic: 0
*/
dhtmlXTabBar.prototype.enableAutoSize=function(autoWidth,autoHeight){
    this._ahdj=convertStringToBoolean(autoHeight);
    this._awdj=convertStringToBoolean(autoWidth);
	if (this._awdj && this._ahdj) this._conZone.style.overflow='hidden';
	else this._conZone.style.overflow='auto';
}


/**
*     @desc: enable / disable auto adjusting height and width   to outer conteiner
*     @type: public
*     @param: mode - enable/disable
*     @topic: 0
*/
dhtmlXTabBar.prototype.enableAutoReSize=function(mode){
	this._EARS=convertStringToBoolean(mode)
    if (this._EARS){
	this.entBox.style.overflow="hidden";
	if  (arguments.length==1){
		if ((this.entBox.style.width||"").indexOf("%")==-1) this.entBox.style.width="100%";
		if ((this.entBox.style.height||"").indexOf("%")==-1) this.entBox.style.height="100%";
	}
    var self=this;
    if(this.entBox.addEventListener){
       if ((_isFF)&&(_FFrv<1.8))
          window.addEventListener("resize",function (){
                        window.setTimeout(function(){ self.adjustOuterSize();  },10);
                        },false);
                else
                    window.addEventListener("resize",function (){  if (self.adjustOuterSize) self.adjustOuterSize(); },false);
       }
    else if (window.attachEvent)
                window.attachEvent("onresize",function(){
                    if (self._resize_timer) window.clearTimeout(self._resize_timer);
                    if (self.adjustOuterSize)
                        self._resize_timer=window.setTimeout(function(){ self.adjustOuterSize(); },500);
                });
	if (this._lineA)
	this.adjustOuterSize();
   }
}

/**
*     @desc: set control size
*     @type: public
*     @param: width - new width
*     @param: height - new height
*     @param: contentZone - if set to true, than width and height set only to content zone
*     @topic: 0
*/
dhtmlXTabBar.prototype.setSize=function(width,height,contentZone){
	height=parseInt(height);
	width=parseInt(width);
    if (contentZone){
        //#4DTabs:23052006{
            if(!this._vMode)
                height+=20*this.rows.length;
            else
        //#}
                width+=20*this.rows.length;
    }


        this.height=height+"px";
        this.width=width+"px";

        this._lineA.style[this._vMode?"left":"top"]=(this._bMode?0:(this._height+this._linePos))+"px";
        this._lineA.style[this._vMode?"height":"width"]=this[this._vMode?"height":"width"];


//#4DTabs:23052006{
        if(this._vMode){
            for (var i=0; i<this.rows.length; i++)
                this.rows[i].style.height=parseInt(this.height)+"px";

            this._conZone.style.height=height-(_isFF?2:0)+"px";
            }
        else
//#}
           {
            this._conZone.style.width=parseInt(this.width)-(_isFF?2:0)+"px";
            for (var i=0; i<this.rows.length; i++)
                this.rows[i].style.width=parseInt(this.width)+"px";
            }
            for (var i=0; i<this.rows.length; i++)
                this._redrawRow(this.rows[i]);
            this._setSizes();

}

dhtmlXTabBar.prototype.adjustOuterSize=function(){
	if (!this._EARS) return;
	var w = this.entBox.offsetWidth+(this.entBox.parentNode.className=="dhtmlxWindowMainContent"?(_isOpera?-2:0):0);
	var h = this.entBox.offsetHeight+(this.entBox.parentNode.className=="dhtmlxWindowMainContent"?(_isIE?1:0):0);
	if (this._tabZone.style.display=="none")
		this.setSize(w,h+4,true);
	else
		this.setSize(w,h,false);
	if (this.wins)
		for (var i in this.wins)
			if (this.wins[i]){
				var win=this.wins[i];
				if (win.grid) { win.grid.setSizes(); }
				if (win.tabbar) { win.tabbar.adjustOuterSize(); }
				if (win.accordion) { win.accordion.setSizes(); }
				if (win.layout) { win.layout.setSizes(win); win.layout.callEvent("onResize", []); }		
			}
}

dhtmlXTabBar.prototype.adjustSize=function(){
			if ((!this._ahdj)&&(!this._awdj)) return;
            var flag=false;
			var x=0;
			var y=0;
			for (var id in this._content){
				var box=this._content[id];
				if (!box) continue;
				var h=Math.max(box.scrollHeight,box.offsetHeight); //in IE , scrollHeight can be lesser than offsetHeight
	            if ((this._ahdj)&&(box.scrollHeight>y)){
	            	
	                y=box.scrollHeight+(_isIE?6:4);
	                flag=true;
	            }

	            if ((this._awdj)&&(box.scrollWidth>x)){
	                x=box.scrollWidth+2;
	                flag=true;
	            }
			}
            if (flag) this.setSize(x||this._conZone.offsetWidth,y||this._conZone.offsetHeight,true);
            if (this._EARS) this.adjustOuterSize();
}
//#}

/**
*   @desc: prevent caching in IE  by adding random seed to URL string
*   @param: mode - enable/disable random seed ( disabled by default )
*   @type: public
*   @topic: 2,9
*/
dhtmlXTabBar.prototype.preventIECashing=function(mode){
    this.no_cashe = convertStringToBoolean(mode);
    if (this.XMLLoader) this.XMLLoader.rSeed=this.no_cashe;
}


/**
*   @desc: hide tab in tabbar
*   @param: tab - id of tab
*   @param: mode - if set to true, selection jump from current tab to nearest one
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.hideTab = function(tab,mode){
	    var tab=this.tabsId[tab];
		if (!tab) return;
		if (tab==this._lastActive) {
		    this._hideContent();
		    this._deactivateTab();
	    }
		this._goToAny(tab,mode);
		tab.style.display='none';
    var row=tab.parentNode;
    this._redrawRow(row);
}

/**
*   @desc: show hidden tab in tabbar
*   @param: tab - id of tab
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.showTab = function(tab){
	    var tab=this.tabsId[tab];
		if (!tab) return;
	 	tab.style.display='block';
    var row=tab.parentNode;
    this._redrawRow(row)
}

/**
*   @desc: enable tab in tabbar
*   @param: tab - id of tab
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.enableTab = function(tab){
	    var tab=this.tabsId[tab];
		if (!tab) return;
		tab._disabled=false;
		tab.className=(tab.className||"").replace(/dhx_tab_element_disabled/g,"");
}

/**
*   @desc: disable tab in tabbar
*   @param: tab - id of tab
*   @param: mode - if set to true, selection jump from current tab to nearest one
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.disableTab = function(tab,mode){
	    var tab=this.tabsId[tab];
		if (!tab) return;
	    this._goToAny(tab,mode);
		tab._disabled=true;
		tab.className+=" dhx_tab_element_disabled";
}

/**
*   @desc: set label of tab
*   @param: tab - id of tab
*   @param: value -  new label
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.setLabel = function(tab,value){
	var tab=this.tabsId[tab];
	if (!tab) return;
	switch(this._tbst){
        case 'text':
            tab.innerHTML=value;
        break;
        case 'win_text':
			tab.childNodes[2].childNodes[this._TabCloseButton?1:0].innerHTML=value;
		break;
	}
}

/**
*   @desc: get label of tab
*   @param: tab - id of tab
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.getLabel = function(tab){
	var tab=this.tabsId[tab];
	if (!tab) return;
	switch(this._tbst){
        case 'text':
            return tab.innerHTML;
        break;
        case 'win_text':
			return tab.childNodes[2].childNodes[this._TabCloseButton?1:0].innerHTML;
		break;
	}
}

dhtmlXTabBar.prototype.detachTab=function(id) {
	var WindowName = this.getLabel(id);
    var tab=this.tabsId[id];
    if (!tab) return;
	var node = this._content[tab.idd];
	tab = this._getTabById(id);
	var tab_w = parseInt(tab.style.width);
	this.removeTab(id, true);
	node.style.position = '';
	var width = parseInt(this._conZone.style.width)+5;
	var height = parseInt(this._conZone.style.height)+25;
	var min_width = 100;
	var min_height = 50;
	width = width<min_width?min_width:width;
	height = height<min_height?min_height:height;

    var top = Math.ceil(window.offsetHeight/20-height/20);
    var left = Math.ceil(window.offsetWidth/20-width/20);

	var win = new dhtmlxWindow(420,300,width,height,WindowName,false);
	win._tab_w = tab_w;
	win.attachContent(node);
	return win;
}

/**
*   @desc: enable mode, in which each tab has close button, mode will be applied to the tabs created AFTER command
*   @param: bool - false/true - enable/disable
*   @type: public
*   @topic: 1
*/
dhtmlXTabBar.prototype.enableTabCloseButton=function(bool) {
	this._TabCloseButton = convertStringToBoolean(bool);
}
/** 
* @desc: returns the number of tabs in all rows 
* @type: public 
* @topic: 0 
*/ 
dhtmlXTabBar.prototype.getNumberOfTabs = function (){ 
	var rc = this.rowscount; 
	var tc = 0; 
	for(var i=0; i<rc; i++){ 
		if (!isNaN(this.rows[i].tabCount)){ 
			tc += this.rows[i].tabCount; 
		} 
	} 
	return tc; 
}


//(c)dhtmlx ltd. www.dhtmlx.com

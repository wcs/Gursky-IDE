/*
-------------------------------------------------------------
| autocomplete.js		Autocomplete for Codemirror 		 |
|------------------------------------------------------------|
|															 |
| @authors		Doglas A. Dembogurski <dembogurski@gmail.com>|
|       		David Thevenin    <david.thevenin@gmail.com> |
| @date		    Oct, 21 of 2009								 |
| 															 |
|															 |
 ------------------------------------------------------------


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/


var timer_out = undefined;  
var autocomplete_open = false;
var current_selected_li = undefined;
var current_word = undefined;
var prev_token = undefined;
var AUTOCOMPLETE_OPEN_VELOCITY = 500; // Miliseconds
var select = true;
var line_tokens_array = [''];
var MIN_CHARS = 2; // Minimun characters to show autocomplete will be defined by user
var lang_type = 'phphtmlmixed'; // php html as default

var popup = "pop_".concat(current_filename_replaced);
var popup_concat = "#pop_".concat(current_filename_replaced);
 
 var mixed_keywords = new Map();  // Reserved Words
 //------------------ HTML Specification Tags and Atributes html keywords ---------------------//
 //Words 
 //     Atributes
 
 mixed_keywords.put('<html>', new Array('</html>') );
 		mixed_keywords.put('<html', new Array('Version="string"') );
 
 mixed_keywords.put('<head>', new Array('</head>') );
 mixed_keywords.put('<title>', new Array('</title>') );
 mixed_keywords.put('<base>', new Array('</base>') );
 		mixed_keywords.put('<base', new Array('Href="URL"','>') );
 mixed_keywords.put('<isindex>', new Array('') );
 mixed_keywords.put('<style>', new Array('</style>') );
 		mixed_keywords.put('<style', new Array('type="text/css"','>') );
 mixed_keywords.put('<script>', new Array('</script>') );
 		mixed_keywords.put('<script', new Array('type="text/javascript"') );
 mixed_keywords.put('<label>', new Array('</label>') );
        mixed_keywords.put('<label', new Array('class=""','style=""','>') );  
 		mixed_keywords.put('<link', new Array('Href="URL','Name="rel|rev"','Rel=""','Rev=""','Urn="string"','Title=""','Methods=""','>') );

 		mixed_keywords.put('<meta', new Array('Http-equiv=""','Http-equiv="refresh" Content="n"','Http-equiv="refresh" Content="n; Url=URL"','Http-equiv="expires" Content="string-date"','Name=""','Content=""','>') );
		mixed_keywords.put('<nextid', new Array('N="string"','>') );
 mixed_keywords.put('<body>', new Array('</body>') );
 		mixed_keywords.put('<body', new Array('Background = "URL"','BGColor="color"','Text="color"','Link="color"','VLink="color"','ALink="color"','>') );
 mixed_keywords.put('<a>', new Array('</a>') );
 		mixed_keywords.put('<a', new Array('Href="URL','Name="string"','Title=""','Rel=""','Rev=""','Urn="string"','Methods=""','>') );
 mixed_keywords.put('<div>', new Array('</div>') );
 		mixed_keywords.put('<div', new Array('id=""','align=""','>') );
 mixed_keywords.put('<blockquote>', new Array('</blockquote>') );
 mixed_keywords.put('<pre>', new Array('</pre>') );
 mixed_keywords.put('<ul>', new Array('</ul>') );
 		mixed_keywords.put('<ul', new Array('Compact','type="disc|circle|square"','>') );
 mixed_keywords.put('<ol>', new Array('</ol>') );
 		mixed_keywords.put('<ol', new Array('type="1|a|A|i|I"','Start="N"','>') );
 mixed_keywords.put('<menu>', new Array('</menu>') );
 mixed_keywords.put('<dir>', new Array('</dir>') );
 mixed_keywords.put('<li>', new Array('</li>') );
 mixed_keywords.put('<dl>', new Array('</dl>') );
 		mixed_keywords.put('<dl', new Array('Compact','>') );
 mixed_keywords.put('<td>', new Array('</td>') );
        mixed_keywords.put('<td', new Array('align="center"','align="left"','align="right"','colspan=""','rowspan=""' ) );
 mixed_keywords.put('<dd>', new Array('</dd>') );
 mixed_keywords.put('<address>', new Array('</address>') );
 mixed_keywords.put('<h1>', new Array('</h1>') );
 mixed_keywords.put('<h2>', new Array('</h2>') );
 mixed_keywords.put('<h3>', new Array('</h3>') );
 mixed_keywords.put('<h4>', new Array('</h4>') );
 mixed_keywords.put('<h5>', new Array('</h5>') );
 mixed_keywords.put('<h6>', new Array('</h6>') );
 mixed_keywords.put('<hr>', new Array('</hr>') );
		mixed_keywords.put('<hr', new Array('size="n"','Noshade','width=""','align="left|right|center"','>') );

 mixed_keywords.put('<p>', new Array('</p>') );
		mixed_keywords.put('<p', new Array('align="left|right|center"','>') );
 mixed_keywords.put('<br>', new Array('') );
 mixed_keywords.put('<center>', new Array('center') );
 mixed_keywords.put('<img>', new Array('</img>') );
 		mixed_keywords.put('<img', new Array('src="URL"','alt="string"','align="top|middle|bottom|left|right"','width="n"','height="n"','border="n"','vspace="n"','hspace="n"','ismap','usemap="string"','>') );
 mixed_keywords.put('<map>', new Array('</map>') );
 		mixed_keywords.put('<map', new Array('name="string"','>') );
 mixed_keywords.put('<area>', new Array('</area>') );
 		mixed_keywords.put('<area', new Array('shape="rect|poly|circle"','shape="rect" Coords="left,top,right,bottom"','shape="poly" Coords="x1,y1,x2,y2,...xn,yn""','shape="circle" Coords="x,y,r"','href="URL"','Nohref','','>') );
 mixed_keywords.put('<fig>', new Array('</fig>') );
 		mixed_keywords.put('<fig', new Array('src="URL"','>') );
 mixed_keywords.put('<cite>', new Array('</cite>') );
 mixed_keywords.put('<code>', new Array('</code>') );
 mixed_keywords.put('<em>', new Array('</em>') );
 mixed_keywords.put('<kbd>', new Array('</kbd>') );
 mixed_keywords.put('<samp>', new Array('</samp>') );
 mixed_keywords.put('<strong>', new Array('</strong>') );
 mixed_keywords.put('<var>', new Array('</var>') );
 mixed_keywords.put('<dfn>', new Array('</dfn>') );
 mixed_keywords.put('<q>', new Array('</q>') );
 mixed_keywords.put('<lang>', new Array('</lang>') );
 mixed_keywords.put('<au>', new Array('</au>') );
 mixed_keywords.put('<person>', new Array('</person>') );
 mixed_keywords.put('<acronym>', new Array('</acronym>') );
 mixed_keywords.put('<ins>', new Array('</ins>') );
 mixed_keywords.put('<del>', new Array('</del>') );
 mixed_keywords.put('<b>', new Array('</b>') );
 mixed_keywords.put('<i>', new Array('</i>') );
 mixed_keywords.put('<u>', new Array('</u>') );
 mixed_keywords.put('<big>', new Array('</big>') );
 mixed_keywords.put('<small>', new Array('</small>') );
 mixed_keywords.put('<sub>', new Array('</sub>') );
 mixed_keywords.put('<sup>', new Array('</sup>') );
 mixed_keywords.put('<basefont>', new Array('</basefont>') );
 		mixed_keywords.put('<basefont', new Array('size="n"','size="+|-n"','color="color"','>') );
 mixed_keywords.put('<font>', new Array('</basefont>') );
 		mixed_keywords.put('<font', new Array('size="n"','size="+|-n"','color="color"','>') );
 		
 mixed_keywords.put('<form>', new Array('</form>') );
 		mixed_keywords.put('<form', new Array('action="URL"','method="get|post"','encytpe="string"','>') );
 mixed_keywords.put('<input>', new Array('</input>') );
 		mixed_keywords.put('<input', new Array('type="text"','type="button"','type="submit"','type="reset"','type="hidden"','type="password"','type="radio"','image','checkbox','value="string"','>') );
 mixed_keywords.put('<select>', new Array('</select>') );
 		mixed_keywords.put('<select', new Array('name="string"','Multiple','size="n"','>') );
 mixed_keywords.put('<option>', new Array('</option>') );
 		mixed_keywords.put('<option', new Array('selected','value="n"','>') );
 mixed_keywords.put('<textarea>', new Array('</textarea>') );
 	 	mixed_keywords.put('<textarea', new Array('name="string"','rows=""', 'cols=""') );
 mixed_keywords.put('<table>', new Array('<th> </th>','<tbody> </tbody>','<tr> </tr>','</table>') );
 		mixed_keywords.put('<table', new Array('align="center"','align="left"','align="right"','align="justify"','align="bleedleft"','align="bleedright"','border=""','cellspacing=""','cellpadding=""','width=""',
 		'id=""','class=""','lang=""','dir="rtl"','dir="ltr"','char=""','charoff="n"','valign="top"','valign="middle"','valign="bottom"','valign="baseline"','cols=""',
 		'frame="void"','frame="above"','frame="below"','frame="hsides"','frame="lhs"','frame="rhs"','frame="vsides"','frame="box"','frame="border"',
 		'rules="none"','rules="groups"','rules=rows""','rules="cols"','rules="all"','>') );	
 mixed_keywords.put('<th>', new Array('</th>') );
 		mixed_keywords.put('<th', new Array('align="center"','align="left"','align="right"','align="justify"','valign="top"','valign="middle"','valign="bottom"','valign="baseline"','colspan="n"','rowspan="n"','nowrap','>') );
 	 
 mixed_keywords.put('<tr>', new Array('<td> </td>','</tr>') );
 		mixed_keywords.put('<tr', new Array('align="center"','align="left"','align="right"','align="justify"','valign="top"','valign="middle"','valign="bottom"','valign="baseline"','colspan="n"','rowspan="n"','nowrap','>') );

/*HTML 5 support*/

/* Special Characters in HTML */
        mixed_keywords.put('&lsquo;', new Array(''));
        mixed_keywords.put('&rsquo;', new Array(''));
        mixed_keywords.put('&sbquo;', new Array(''));
        mixed_keywords.put('&ldquo;', new Array(''));
        mixed_keywords.put('&rdquo;', new Array(''));
        mixed_keywords.put('&bdquo;', new Array(''));
        mixed_keywords.put('&dagger;', new Array(''));
        mixed_keywords.put('&Dagger;', new Array(''));
        mixed_keywords.put('&permil;', new Array(''));
        mixed_keywords.put('&lsaquo;', new Array(''));
        mixed_keywords.put('&rsaquo;', new Array(''));
        mixed_keywords.put('&spades;', new Array(''));
        mixed_keywords.put('&clubs;', new Array(''));
        mixed_keywords.put('&hearts;', new Array(''));
        mixed_keywords.put('&diams;', new Array(''));
        mixed_keywords.put('&oline;', new Array(''));
        mixed_keywords.put('&larr;', new Array(''));
        mixed_keywords.put('&uarr;', new Array(''));
        mixed_keywords.put('&rarr;', new Array(''));
        mixed_keywords.put('&darr;', new Array(''));
        mixed_keywords.put('&trade;', new Array(''));
        mixed_keywords.put('&quot;', new Array(''));
        mixed_keywords.put('&amp;', new Array(''));
        mixed_keywords.put('&frasl;', new Array(''));
        mixed_keywords.put('&lt;', new Array(''));
        mixed_keywords.put('&gt;', new Array(''));
        mixed_keywords.put('&ndash;', new Array(''));
        mixed_keywords.put('&mdash;', new Array(''));
        mixed_keywords.put('&nbsp;', new Array(''));
        mixed_keywords.put('&iexcl;', new Array(''));
        mixed_keywords.put('&cent;', new Array(''));
        mixed_keywords.put('&pound;', new Array(''));
        mixed_keywords.put('&curren;', new Array(''));
        mixed_keywords.put('&yen;', new Array(''));
        mixed_keywords.put('&brvbar;', new Array(''));
        mixed_keywords.put('&brkbar;', new Array(''));
        mixed_keywords.put('&sect;', new Array(''));
        mixed_keywords.put('&uml;', new Array(''));
        mixed_keywords.put('&die;', new Array(''));
        mixed_keywords.put('&copy;', new Array(''));
        mixed_keywords.put('&ordf;', new Array(''));
        mixed_keywords.put('&laquo;', new Array(''));
        mixed_keywords.put('&not;', new Array(''));
        mixed_keywords.put('&shy;', new Array(''));
        mixed_keywords.put('&reg;', new Array(''));
        mixed_keywords.put('&macr;', new Array(''));
        mixed_keywords.put('&hibar;', new Array(''));
        mixed_keywords.put('&deg;', new Array(''));
        mixed_keywords.put('&plusmn;', new Array(''));
        mixed_keywords.put('&sup2;', new Array(''));
        mixed_keywords.put('&sup3;', new Array(''));
        mixed_keywords.put('&acute;', new Array(''));
        mixed_keywords.put('&micro;', new Array(''));
        mixed_keywords.put('&para;', new Array(''));
        mixed_keywords.put('&middot;', new Array(''));
        mixed_keywords.put('&cedil;', new Array(''));
        mixed_keywords.put('&sup1;', new Array(''));
        mixed_keywords.put('&ordm;', new Array(''));
        mixed_keywords.put('&raquo;', new Array(''));
        mixed_keywords.put('&frac14;', new Array(''));
        mixed_keywords.put('&frac12;', new Array(''));
        mixed_keywords.put('&frac34;', new Array(''));
        mixed_keywords.put('&iquest;', new Array(''));
        mixed_keywords.put('&Agrave;', new Array(''));
        mixed_keywords.put('&Aacute;', new Array(''));
        mixed_keywords.put('&Acirc;', new Array(''));
        mixed_keywords.put('&Atilde;', new Array(''));
        mixed_keywords.put('&Auml;', new Array(''));
        mixed_keywords.put('&Aring;', new Array(''));
        mixed_keywords.put('&AElig;', new Array(''));
        mixed_keywords.put('&Ccedil;', new Array(''));
        mixed_keywords.put('&Egrave;', new Array(''));
        mixed_keywords.put('&Eacute;', new Array(''));
        mixed_keywords.put('&Ecirc;', new Array(''));
        mixed_keywords.put('&Euml;', new Array(''));
        mixed_keywords.put('&Igrave;', new Array(''));
        mixed_keywords.put('&Iacute;', new Array(''));
        mixed_keywords.put('&Icirc;', new Array(''));
        mixed_keywords.put('&Iuml;', new Array(''));
        mixed_keywords.put('&ETH;', new Array(''));
        mixed_keywords.put('&Ntilde;', new Array(''));
        mixed_keywords.put('&Ograve;', new Array(''));
        mixed_keywords.put('&Oacute;', new Array(''));
        mixed_keywords.put('&Ocirc;', new Array(''));
        mixed_keywords.put('&Otilde;', new Array(''));
        mixed_keywords.put('&Ouml;', new Array(''));
        mixed_keywords.put('&times;', new Array(''));
        mixed_keywords.put('&Oslash;', new Array(''));
        mixed_keywords.put('&Ugrave;', new Array(''));
        mixed_keywords.put('&Uacute;', new Array(''));
        mixed_keywords.put('&Ucirc;', new Array(''));
        mixed_keywords.put('&Uuml;', new Array(''));
        mixed_keywords.put('&Yacute;', new Array(''));
        mixed_keywords.put('&THORN;', new Array(''));
        mixed_keywords.put('&szlig;', new Array(''));
        mixed_keywords.put('&agrave;', new Array(''));
        mixed_keywords.put('&aacute;', new Array(''));
        mixed_keywords.put('&acirc;', new Array(''));
        mixed_keywords.put('&atilde;', new Array(''));
        mixed_keywords.put('&auml;', new Array(''));
        mixed_keywords.put('&aring;', new Array(''));
        mixed_keywords.put('&aelig;', new Array(''));
        mixed_keywords.put('&ccedil;', new Array(''));
        mixed_keywords.put('&egrave;', new Array(''));
        mixed_keywords.put('&eacute;', new Array(''));
        mixed_keywords.put('&ecirc;', new Array(''));
        mixed_keywords.put('&euml;', new Array(''));
        mixed_keywords.put('&igrave;', new Array(''));
        mixed_keywords.put('&iacute;', new Array(''));
        mixed_keywords.put('&icirc;', new Array(''));
        mixed_keywords.put('&iuml;', new Array(''));
        mixed_keywords.put('&eth;', new Array(''));
        mixed_keywords.put('&ntilde;', new Array(''));
        mixed_keywords.put('&ograve;', new Array(''));
        mixed_keywords.put('&oacute;', new Array(''));
        mixed_keywords.put('&ocirc;', new Array(''));
        mixed_keywords.put('&otilde;', new Array(''));
        mixed_keywords.put('&ouml;', new Array(''));
        mixed_keywords.put('&divide;', new Array(''));
        mixed_keywords.put('&oslash;', new Array(''));
        mixed_keywords.put('&ugrave;', new Array(''));
        mixed_keywords.put('&uacute;', new Array(''));
        mixed_keywords.put('&ucirc;', new Array(''));
        mixed_keywords.put('&uuml;', new Array(''));
        mixed_keywords.put('&yacute;', new Array(''));
        mixed_keywords.put('&thorn;', new Array(''));
        mixed_keywords.put('&yuml;', new Array(''));
        mixed_keywords.put('&#x2122;', new Array(''));
        mixed_keywords.put('&#00;', new Array(''));
        mixed_keywords.put('&#08;', new Array(''));
        mixed_keywords.put('&#09;', new Array(''));
        mixed_keywords.put('&#10;', new Array(''));
        mixed_keywords.put('&#11;', new Array(''));
        mixed_keywords.put('&#32;', new Array(''));
        mixed_keywords.put('&#33;', new Array(''));
        mixed_keywords.put('&#34;', new Array(''));
        mixed_keywords.put('&#35;', new Array(''));
        mixed_keywords.put('&#36;', new Array(''));
        mixed_keywords.put('&#37;', new Array(''));
        mixed_keywords.put('&#38;', new Array(''));
        mixed_keywords.put('&#39;', new Array(''));
        mixed_keywords.put('&#40;', new Array(''));
        mixed_keywords.put('&#41;', new Array(''));
        mixed_keywords.put('&#42;', new Array(''));
        mixed_keywords.put('&#43;', new Array(''));
        mixed_keywords.put('&#44;', new Array(''));
        mixed_keywords.put('&#45;', new Array(''));
        mixed_keywords.put('&#46;', new Array(''));
        mixed_keywords.put('&#47;', new Array(''));
        mixed_keywords.put('&#48;', new Array(''));
        mixed_keywords.put('&#57;', new Array(''));
        mixed_keywords.put('&#58;', new Array(''));
        mixed_keywords.put('&#59;', new Array(''));
        mixed_keywords.put('&#60;', new Array(''));
        mixed_keywords.put('&#61;', new Array(''));
        mixed_keywords.put('&#62;', new Array(''));
        mixed_keywords.put('&#63;', new Array(''));
        mixed_keywords.put('&#64;', new Array(''));
        mixed_keywords.put('&#65;', new Array(''));
        mixed_keywords.put('&#90;', new Array(''));
        mixed_keywords.put('&#91;', new Array(''));
        mixed_keywords.put('&#92;', new Array(''));
        mixed_keywords.put('&#93;', new Array(''));
        mixed_keywords.put('&#94;', new Array(''));
        mixed_keywords.put('&#95;', new Array(''));
        mixed_keywords.put('&#96;', new Array(''));
        mixed_keywords.put('&#97;', new Array(''));
        mixed_keywords.put('&#122;', new Array(''));
        mixed_keywords.put('&#123;', new Array(''));
        mixed_keywords.put('&#124;', new Array(''));
        mixed_keywords.put('&#125;', new Array(''));
        mixed_keywords.put('&#126;', new Array(''));
        mixed_keywords.put('&#127;', new Array(''));
        mixed_keywords.put('&#149;', new Array(''));
        mixed_keywords.put('&#150;', new Array(''));
        mixed_keywords.put('&#151;', new Array(''));
        mixed_keywords.put('&#152;', new Array(''));
        mixed_keywords.put('&#159;', new Array(''));
        mixed_keywords.put('&#160;', new Array(''));
        mixed_keywords.put('&#161;', new Array(''));
        mixed_keywords.put('&#162;', new Array(''));
        mixed_keywords.put('&#163;', new Array(''));
        mixed_keywords.put('&#164;', new Array(''));
        mixed_keywords.put('&#165;', new Array(''));
        mixed_keywords.put('&#166;', new Array(''));
        mixed_keywords.put('&#167;', new Array(''));
        mixed_keywords.put('&#168;', new Array(''));
        mixed_keywords.put('&#169;', new Array(''));
        mixed_keywords.put('&#170;', new Array(''));
        mixed_keywords.put('&#171;', new Array(''));
        mixed_keywords.put('&#172;', new Array(''));
        mixed_keywords.put('&#173;', new Array(''));
        mixed_keywords.put('&#174;', new Array(''));
        mixed_keywords.put('&#175;', new Array(''));
        mixed_keywords.put('&#176;', new Array(''));
        mixed_keywords.put('&#177;', new Array(''));
        mixed_keywords.put('&#178;', new Array(''));
        mixed_keywords.put('&#179;', new Array(''));
        mixed_keywords.put('&#180;', new Array(''));
        mixed_keywords.put('&#181;', new Array(''));
        mixed_keywords.put('&#182;', new Array(''));
        mixed_keywords.put('&#183;', new Array(''));
        mixed_keywords.put('&#184;', new Array(''));
        mixed_keywords.put('&#185;', new Array(''));
        mixed_keywords.put('&#186;', new Array(''));
        mixed_keywords.put('&#187;', new Array(''));
        mixed_keywords.put('&#188;', new Array(''));
        mixed_keywords.put('&#189;', new Array(''));
        mixed_keywords.put('&#190;', new Array(''));
        mixed_keywords.put('&#191;', new Array(''));
        mixed_keywords.put('&#192;', new Array(''));
        mixed_keywords.put('&#193;', new Array(''));
        mixed_keywords.put('&#194;', new Array(''));
        mixed_keywords.put('&#195;', new Array(''));
        mixed_keywords.put('&#196;', new Array(''));
        mixed_keywords.put('&#197;', new Array(''));
        mixed_keywords.put('&#198;', new Array(''));
        mixed_keywords.put('&#199;', new Array(''));
        mixed_keywords.put('&#200;', new Array(''));
        mixed_keywords.put('&#201;', new Array(''));
        mixed_keywords.put('&#202;', new Array(''));
        mixed_keywords.put('&#203;', new Array(''));
        mixed_keywords.put('&#204;', new Array(''));
        mixed_keywords.put('&#205;', new Array(''));
        mixed_keywords.put('&#206;', new Array(''));
        mixed_keywords.put('&#207;', new Array(''));
        mixed_keywords.put('&#208;', new Array(''));
        mixed_keywords.put('&#209;', new Array(''));
        mixed_keywords.put('&#210;', new Array(''));
        mixed_keywords.put('&#211;', new Array(''));
        mixed_keywords.put('&#212;', new Array(''));
        mixed_keywords.put('&#213;', new Array(''));
        mixed_keywords.put('&#214;', new Array(''));
        mixed_keywords.put('&#215;', new Array(''));
        mixed_keywords.put('&#216;', new Array(''));
        mixed_keywords.put('&#217;', new Array(''));
        mixed_keywords.put('&#218;', new Array(''));
        mixed_keywords.put('&#219;', new Array(''));
        mixed_keywords.put('&#220;', new Array(''));
        mixed_keywords.put('&#221;', new Array(''));
        mixed_keywords.put('&#222;', new Array(''));
        mixed_keywords.put('&#223;', new Array(''));
        mixed_keywords.put('&#224;', new Array(''));
        mixed_keywords.put('&#225;', new Array(''));
        mixed_keywords.put('&#226;', new Array(''));
        mixed_keywords.put('&#227;', new Array(''));
        mixed_keywords.put('&#228;', new Array(''));
        mixed_keywords.put('&#229;', new Array(''));
        mixed_keywords.put('&#230;', new Array(''));
        mixed_keywords.put('&#231;', new Array(''));
        mixed_keywords.put('&#232;', new Array(''));
        mixed_keywords.put('&#233;', new Array(''));
        mixed_keywords.put('&#234;', new Array(''));
        mixed_keywords.put('&#235;', new Array(''));
        mixed_keywords.put('&#236;', new Array(''));
        mixed_keywords.put('&#237;', new Array(''));
        mixed_keywords.put('&#238;', new Array(''));
        mixed_keywords.put('&#239;', new Array(''));
        mixed_keywords.put('&#240;', new Array(''));
        mixed_keywords.put('&#241;', new Array(''));
        mixed_keywords.put('&#242;', new Array(''));
        mixed_keywords.put('&#243;', new Array(''));
        mixed_keywords.put('&#244;', new Array(''));
        mixed_keywords.put('&#245;', new Array(''));
        mixed_keywords.put('&#246;', new Array(''));
        mixed_keywords.put('&#247;', new Array(''));
        mixed_keywords.put('&#248;', new Array(''));
        mixed_keywords.put('&#249;', new Array(''));
        mixed_keywords.put('&#250;', new Array(''));
        mixed_keywords.put('&#251;', new Array(''));
        mixed_keywords.put('&#252;', new Array(''));
        mixed_keywords.put('&#253;', new Array(''));
        mixed_keywords.put('&#254;', new Array(''));
        mixed_keywords.put('&#255;', new Array(''));
        mixed_keywords.put('&Alpha;', new Array(''));
        mixed_keywords.put('&alpha;', new Array(''));
        mixed_keywords.put('&Beta;', new Array(''));
        mixed_keywords.put('&beta;', new Array(''));
        mixed_keywords.put('&Gamma;', new Array(''));
        mixed_keywords.put('&gamma;', new Array(''));
        mixed_keywords.put('&Delta;', new Array(''));
        mixed_keywords.put('&delta;', new Array(''));
        mixed_keywords.put('&Epsilon;', new Array(''));
        mixed_keywords.put('&epsilon;', new Array(''));
        mixed_keywords.put('&Zeta;', new Array(''));
        mixed_keywords.put('&zeta;', new Array(''));
        mixed_keywords.put('&Eta;', new Array(''));
        mixed_keywords.put('&eta;', new Array(''));
        mixed_keywords.put('&Theta;', new Array(''));
        mixed_keywords.put('&theta;', new Array(''));
        mixed_keywords.put('&Iota;', new Array(''));
        mixed_keywords.put('&iota;', new Array(''));
        mixed_keywords.put('&Kappa;', new Array(''));
        mixed_keywords.put('&kappa;', new Array(''));
        mixed_keywords.put('&Lambda;', new Array(''));
        mixed_keywords.put('&lambda;', new Array(''));
        mixed_keywords.put('&Mu;', new Array(''));
        mixed_keywords.put('&mu;', new Array(''));
        mixed_keywords.put('&Nu;', new Array(''));
        mixed_keywords.put('&nu;', new Array(''));
        mixed_keywords.put('&Xi;', new Array(''));
        mixed_keywords.put('&xi;', new Array(''));
        mixed_keywords.put('&Omicron;', new Array(''));
        mixed_keywords.put('&omicron;', new Array(''));
        mixed_keywords.put('&Pi;', new Array(''));
        mixed_keywords.put('&pi;', new Array(''));
        mixed_keywords.put('&Rho;', new Array(''));
        mixed_keywords.put('&rho;', new Array(''));
        mixed_keywords.put('&Sigma;', new Array(''));
        mixed_keywords.put('&sigma;', new Array(''));
        mixed_keywords.put('&Tau;', new Array(''));
        mixed_keywords.put('&tau;', new Array(''));
        mixed_keywords.put('&Upsilon;', new Array(''));
        mixed_keywords.put('&upsilon;', new Array(''));
        mixed_keywords.put('&Phi;', new Array(''));
        mixed_keywords.put('&phi;', new Array(''));
        mixed_keywords.put('&Chi;', new Array(''));
        mixed_keywords.put('&chi;', new Array(''));
        mixed_keywords.put('&Psi;', new Array(''));
        mixed_keywords.put('&psi;', new Array(''));
        mixed_keywords.put('&Omega;', new Array(''));
        mixed_keywords.put('&omega;', new Array(''));
        mixed_keywords.put('&#9679;', new Array(''));
        mixed_keywords.put('&#8226;', new Array(''));

//-------------------------------- php keywords ------------------------------------//


//-------------------------------- php functios ------------------------------------//

mixed_keywords.put('$this->', new Array(''));
mixed_keywords.put('$this', new Array(' ->'));

/*Will be added on the fly*/

//-------------------------------- js keywords ------------------------------------//
var js_keywords = new Map();  // Reserved Words


//-------------------------------- SQL keywords -----------------------------------//
var sql_keywords = new Map();  // Reserved Words

sql_keywords.put('abs ', new Array('') );
sql_keywords.put('acos ', new Array('') );
sql_keywords.put('adddate ', new Array('') );
sql_keywords.put('aes_decryp t', new Array('') );
sql_keywords.put('aes_encrypt ', new Array('') );
sql_keywords.put('all ', new Array('') );
sql_keywords.put('alter ', new Array('') );
sql_keywords.put('and ', new Array('') );
sql_keywords.put('as ', new Array('') );
sql_keywords.put('asc ', new Array('') );
sql_keywords.put('ascii ', new Array('') );
sql_keywords.put('asin ', new Array('') );
sql_keywords.put('atan ', new Array('') );
sql_keywords.put('atan2 ', new Array('') );
sql_keywords.put('avg ', new Array('') );
sql_keywords.put('benchmark ', new Array('') );
sql_keywords.put('between ', new Array('') );
sql_keywords.put('bigint ', new Array('') );
sql_keywords.put('bin ', new Array('') );
sql_keywords.put('binary ', new Array('') );
sql_keywords.put('bit ', new Array('') );
sql_keywords.put('bit_and ', new Array('') );
sql_keywords.put('bit_count ', new Array('') );
sql_keywords.put('bit_length ', new Array('') );
sql_keywords.put('bit_or ', new Array('') );
sql_keywords.put('blob ', new Array('') );
sql_keywords.put('bool ', new Array('') );
sql_keywords.put('by ', new Array('') );
sql_keywords.put('cast ', new Array('') );
sql_keywords.put('ceil ', new Array('') );
sql_keywords.put('ceiling ', new Array('') );
sql_keywords.put('char ', new Array('') );
sql_keywords.put('char_length ', new Array('') );
sql_keywords.put('character ', new Array('') );
sql_keywords.put('character_length ', new Array('') );
sql_keywords.put('coalesce ', new Array('') );
sql_keywords.put('commit ', new Array('') );
sql_keywords.put('concat ', new Array('') );
sql_keywords.put('concat_ws ', new Array('') );
sql_keywords.put('connection_id ', new Array('') );
sql_keywords.put('conv ', new Array('') );
sql_keywords.put('convert ', new Array('') );
sql_keywords.put('cos ', new Array('') );
sql_keywords.put('cot ', new Array('') );
sql_keywords.put('count ', new Array('') );
sql_keywords.put('create ', new Array('table','database','trigger','procedure') );
sql_keywords.put('curdate ', new Array('') );
sql_keywords.put('current_date ', new Array('') );
sql_keywords.put('current_time ', new Array('') );
sql_keywords.put('current_timestamp ', new Array('') );
sql_keywords.put('current_user ', new Array('') );
sql_keywords.put('curtime ', new Array('') );
sql_keywords.put('database ', new Array('') );
sql_keywords.put('database ', new Array('') );
sql_keywords.put('date ', new Array('') );
sql_keywords.put('date_add ', new Array('') );
sql_keywords.put('date_format ', new Array('') );
sql_keywords.put('date_sub ', new Array('') );
sql_keywords.put('datetime ', new Array('') );
sql_keywords.put('dayname ', new Array('') );
sql_keywords.put('dayofmonth ', new Array('') );
sql_keywords.put('dayofweek ', new Array('') );
sql_keywords.put('dayofyear ', new Array('') );
sql_keywords.put('dec ', new Array('') );
sql_keywords.put('decimal ', new Array('') );
sql_keywords.put('decode ', new Array('') );
sql_keywords.put('degrees ', new Array('') );
sql_keywords.put('delete ', new Array('') );
sql_keywords.put('des_decrypt ', new Array('') );
sql_keywords.put('des_encrypt ', new Array('') );
sql_keywords.put('desc ', new Array('') );
sql_keywords.put('describe ', new Array('') );
sql_keywords.put('distinct ', new Array('') );
sql_keywords.put('double ', new Array('') );
sql_keywords.put('elt ', new Array('') );
sql_keywords.put('encode ', new Array('') );
sql_keywords.put('encrypt ', new Array('') );
sql_keywords.put('enum ', new Array('') );
sql_keywords.put('exists ', new Array('') );
sql_keywords.put('exp ', new Array('') );
sql_keywords.put('export_set ', new Array('') );
sql_keywords.put('extract ', new Array('') );
sql_keywords.put('field ', new Array('') );
sql_keywords.put('find_in_set ', new Array('') );
sql_keywords.put('float ', new Array('') );
sql_keywords.put('float4 ', new Array('') );
sql_keywords.put('float8 ', new Array('') );
sql_keywords.put('floor ', new Array('') );
sql_keywords.put('format ', new Array('') );
sql_keywords.put('found_rows ', new Array('') );
sql_keywords.put('from ', new Array('') );
sql_keywords.put('from_days ', new Array('') );
sql_keywords.put('from_unixtime ', new Array('') );
sql_keywords.put('get_lock ', new Array('') );
sql_keywords.put('grant ', new Array('') );
sql_keywords.put('greatest ', new Array('') );
sql_keywords.put('group ', new Array('') );
sql_keywords.put('group_unique_users ', new Array('') );
sql_keywords.put('hex ', new Array('') );
sql_keywords.put('if ', new Array('') );
sql_keywords.put('ifnull ', new Array('') );
sql_keywords.put('in ', new Array('') );
sql_keywords.put('in ', new Array('') );
sql_keywords.put('inet_aton ', new Array('') );
sql_keywords.put('inet_ntoa ', new Array('') );
sql_keywords.put('inner ', new Array('') );
sql_keywords.put('insert ', new Array('') );
sql_keywords.put('instr ', new Array('') );
sql_keywords.put('int ', new Array('') );
sql_keywords.put('int1 ', new Array('') );
sql_keywords.put('int2 ', new Array('') );
sql_keywords.put('int3 ', new Array('') );
sql_keywords.put('int4 ', new Array('') );
sql_keywords.put('int8 ', new Array('') );
sql_keywords.put('integer ', new Array('') );
sql_keywords.put('interval ', new Array('') );
sql_keywords.put('into ', new Array('') );
sql_keywords.put('is_free_lock ', new Array('') );
sql_keywords.put('isnull ', new Array('') );
sql_keywords.put('join ', new Array('') );
sql_keywords.put('key ', new Array('') );
sql_keywords.put('last_insert_id ', new Array('') );
sql_keywords.put('lcase ', new Array('') );
sql_keywords.put('least ', new Array('') );
sql_keywords.put('left ', new Array('') );
sql_keywords.put('left ', new Array('') );
sql_keywords.put('length ', new Array('') );
sql_keywords.put('like ', new Array('') ); 
sql_keywords.put('limit ', new Array('') );
sql_keywords.put('ln ', new Array('') );
sql_keywords.put('load_file ', new Array('') );
sql_keywords.put('locate ', new Array('') );
sql_keywords.put('lock ', new Array('') );
sql_keywords.put('log ', new Array('') );
sql_keywords.put('log10 ', new Array('') );
sql_keywords.put('log2 ', new Array('') );
sql_keywords.put('long ', new Array('') );
sql_keywords.put('longblob ', new Array('') );
sql_keywords.put('longtext ', new Array('') );
sql_keywords.put('lower ', new Array('') );
sql_keywords.put('lpad ', new Array('') );
sql_keywords.put('ltrim ', new Array('') );
sql_keywords.put('make_set ', new Array('') );
sql_keywords.put('master_pos_wait ', new Array('') );
sql_keywords.put('max ', new Array('') );
sql_keywords.put('md5 ', new Array('') );
sql_keywords.put('mediumblob ', new Array('') );
sql_keywords.put('mediumint ', new Array('') );
sql_keywords.put('mediumtext ', new Array('') );
sql_keywords.put('mid ', new Array('') );
sql_keywords.put('middleint ', new Array('') );
sql_keywords.put('min ', new Array('') );
sql_keywords.put('mod ', new Array('') );
sql_keywords.put('monthname ', new Array('') );
sql_keywords.put('natural ', new Array('') );
sql_keywords.put('nchar ', new Array('') );
sql_keywords.put('not ', new Array('') );
sql_keywords.put('now ', new Array('') );
sql_keywords.put('null ', new Array('') );
sql_keywords.put('nullif ', new Array('') );
sql_keywords.put('numeric ', new Array('') );
sql_keywords.put('oct ', new Array('') );
sql_keywords.put('octet_length ', new Array('') );
sql_keywords.put('offset ', new Array('') );
sql_keywords.put('on ', new Array('') );
sql_keywords.put('or ', new Array('') );
sql_keywords.put('ord ', new Array('') );
sql_keywords.put('order ', new Array('') );
sql_keywords.put('password ', new Array('') );
sql_keywords.put('period_add ', new Array('') );
sql_keywords.put('period_diff ', new Array('') );
sql_keywords.put('pi ', new Array('') );
sql_keywords.put('position ', new Array('') );
sql_keywords.put('pow ', new Array('') );
sql_keywords.put('power ', new Array('') );
sql_keywords.put('primary ', new Array('') );
sql_keywords.put('quarter ', new Array('') );
sql_keywords.put('quote ', new Array('') );
sql_keywords.put('radians ', new Array('') );
sql_keywords.put('rand ', new Array('') );
sql_keywords.put('real ', new Array('') );
sql_keywords.put('release_lock ', new Array('') );
sql_keywords.put('repeat ', new Array('') );
sql_keywords.put('replace ', new Array('') );
sql_keywords.put('reverse ', new Array('') );
sql_keywords.put('revoke ', new Array('') );
sql_keywords.put('right ', new Array('') );
sql_keywords.put('rlike ', new Array('') );
sql_keywords.put('rollback ', new Array('') );
sql_keywords.put('round ', new Array('') );
sql_keywords.put('rpad ', new Array('') );
sql_keywords.put('rtrim ', new Array('') );
sql_keywords.put('sec_to_time ', new Array('') );
sql_keywords.put('select ', new Array('* ') );
sql_keywords.put('separator ', new Array('') );
sql_keywords.put('session_user ', new Array('') );
sql_keywords.put('set ', new Array('') ); 
sql_keywords.put('sha ', new Array('') );
sql_keywords.put('sha1 ', new Array('') );
sql_keywords.put('show ', new Array('') );
sql_keywords.put('sign ', new Array('') );
sql_keywords.put('sin ', new Array('') );
sql_keywords.put('smallint ', new Array('') );
sql_keywords.put('soundex ', new Array('') );
sql_keywords.put('space ', new Array('') );
sql_keywords.put('sqrt ', new Array('') );
sql_keywords.put('start ', new Array('') );
sql_keywords.put('status ', new Array('') );
sql_keywords.put('std ', new Array('') );
sql_keywords.put('stddev ', new Array('') );
sql_keywords.put('strcmp ', new Array('') );
sql_keywords.put('subdate ', new Array('') );
sql_keywords.put('substring ', new Array('') );
sql_keywords.put('substring_index ', new Array('') );
sql_keywords.put('sum ', new Array('') );
sql_keywords.put('sysdate ', new Array('') );
sql_keywords.put('system_user ', new Array('') );
sql_keywords.put('table ', new Array('') );
sql_keywords.put('tan ', new Array('') );
sql_keywords.put('text ', new Array('') );
sql_keywords.put('time ', new Array('') );
sql_keywords.put('time_format ', new Array('') );
sql_keywords.put('time_to_sec ', new Array('') );
sql_keywords.put('timestamp ', new Array('') );
sql_keywords.put('tinyblob ', new Array('') );
sql_keywords.put('tinyint ', new Array('') );
sql_keywords.put('tinytext ', new Array('') );
sql_keywords.put('to_days ', new Array('') );
sql_keywords.put('transaction ', new Array('') );
sql_keywords.put('trim ', new Array('') );
sql_keywords.put('truncate ', new Array('') );
sql_keywords.put('ucase ', new Array('') );
sql_keywords.put('union ', new Array('') );
sql_keywords.put('unique ', new Array('') );
sql_keywords.put('unique_users ', new Array('') );
sql_keywords.put('unix_timestamp ', new Array('') );
sql_keywords.put('update ', new Array('') );
sql_keywords.put('upper ', new Array('') );
sql_keywords.put('user ', new Array('') );
sql_keywords.put('using ', new Array('') );
sql_keywords.put('values ', new Array('') );
sql_keywords.put('varbinary ', new Array('') );
sql_keywords.put('varchar ', new Array('') );
sql_keywords.put('version ', new Array('') );
sql_keywords.put('view ', new Array('') );
sql_keywords.put('week ', new Array('') );
sql_keywords.put('weekday ', new Array('') );
sql_keywords.put('where ', new Array('') );
sql_keywords.put('xor', new Array('') );
sql_keywords.put('xor ', new Array('') );
sql_keywords.put('year ', new Array('') );
sql_keywords.put('yearweek ', new Array('') );
sql_keywords.put('* ', new Array('from') );

//-------------------------------- css keywords ------------------------------------//
var css_keywords = new Map();  // Reserved Words


var map = mixed_keywords;

var tokens = [''];

function setLangType( lang ){
    if(lang === 'html' || lang === 'phphtmlmixed' || lang === 'php' ){
       map = mixed_keywords;
    }else if(lang === 'js'){
       map = js_keywords;
    }else if(lang === 'sql'){
       map = sql_keywords;
    }else if(lang === 'css'){
       map = css_keywords;
    }
}

function insertCode (lineObj, position, code, curr_token){ //  window.console.log (' >> tk_lenght ' + curr_token  + ' code '+code+' position '+ position);  
	var tk_lenght = curr_token.length;
	var code_lenght = code.length; 
	var code_cut = code.substr (tk_lenght);  
	
	if(curr_token === ' '){    		
		get_current_code_mirror().insertIntoLine (lineObj, position, code);  // window.console.log("lineObj "+lineObj+" position: "+position);
		startOffset = endOffset = position + code.length;
		get_current_code_mirror().selectLines (lineObj, startOffset, lineObj, endOffset);
		//window.console.log("startOffset "+startOffset+" endOffset: "+endOffset);
	}else{ 		 
		get_current_code_mirror().insertIntoLine (lineObj, position , code_cut);
		startOffset = endOffset = position + code_cut.length;
		get_current_code_mirror().selectLines (lineObj, startOffset, lineObj, endOffset)
	} 
}

function showMenu (lineObj, linea, columna, wordsArray, current_word) {  // window.console.log (' wordsArray >>' + wordsArray   );
// Test
	var coords = get_current_code_mirror().cursorCoords(0);
	var x =coords.x - 250;  // 250 Tamaño por defecto del Layout Oeste  Modificar para que funcione cuando se cambia el tamaño de los layouts
	var y =coords.y - 80 + 18;   // 80 Tamaño en pixeles por defecto del panel Norte 18 Altura de la linea
	 
	// keyboard events grab
	get_current_code_mirror().grabKeys (autoCompleteGrabkeys, keyEventFilter);
	
	var first = wordsArray[0]; // Insert first
	
	for (var k = 0; k < wordsArray.length; k++){
		var li  = document.createElement('LI');
		li.className = "lista";
		var name = document.createTextNode (wordsArray[k]);
		li.appendChild (name);
		var string = wordsArray [k];
		li.id = string;
		li.lineObj = lineObj;
		li.columna = columna;
		li.current_word = current_word;
        var tmpo = "pop_".concat(current_filename_replaced) ;
		document.getElementById ( tmpo ).appendChild(li);
         
		li.onclick = function () {
			current_selected_li.className = "lista";
			this.className = "lista selected";
			insertCode (lineObj, columna, this.id, current_word );
		};
	}
	/*var x = (columna - current_word.length) *  9.25 + 45;
    x -= get_current_code_mirror().frame.contentDocument.body.scrollLeft;
    var y = linea * 16 + 8;
    y -= get_current_code_mirror().frame.contentDocument.body.scrollTop;  */
    $(popup_concat).addClass("pop");
 	$(popup_concat).css("left", x + "px");
	$(popup_concat).css("top", y + "px");

	/*$(popup_concat).css("left",columna * 9.25 + 45 + "px");
	$(popup_concat).css("top",linea * 15 + 15 + "px"); */
	  
	$(popup_concat).click (function (){
		closeAutocomplete();
	});
    
	$(popup_concat).fadeIn('fast');
	
	// window.console.log (' > autocomplete_open '+ autocomplete_open);
     var tmp = "pop_".concat(current_filename_replaced) ;
	 current_selected_li = document.getElementById(tmp ).firstChild;
	 
	 if (current_selected_li) {
		 current_selected_li.className = "lista selected";
	 } 
	autocomplete_open = true;
}

var autocompleteManagement = function (e) {
    popup = "pop_".concat(current_filename_replaced);
    popup_concat = "#pop_".concat(current_filename_replaced);
    // window.console.log (' > popup: '+popup);
    if(!select){
    	return;
    } 
	if (timer_out) {
		clearTimeout (timer_out); timer_out = undefined;
	}
	timer_out = setTimeout (openAutocomplete, AUTOCOMPLETE_OPEN_VELOCITY); 
}

var closeAutocomplete = function (){
	$(popup_concat).html("");
	$(popup_concat).fadeOut('fast');
    /*$(popup_concat).removeClass("pop");
    $(popup_concat).addClass("cerrar");*/
	get_current_code_mirror().ungrabKeys ();
	autocomplete_open = false;
	current_selected_li = undefined;   
    select = true;
}

function keyEventFilter(keycode){   // window.console.log (' > keycode '+ keycode);
	if (keycode === 27) return true; // ESC
	if (keycode === 37) return true; // LEFT_ARROW
	if (keycode === 38) return true; // UP_ARROW
	if (keycode === 39) return true; // RIGHT_ARROW
	if (keycode === 40) return true; // DOWN_ARROW
	if (keycode === 8) return true; // BACK SPACE
	if (current_selected_li && keycode === 13) return true; // ENTER
	return false;
}

function autoCompleteGrabkeys(e){   //window.console.log (' > grab '+e.keyCode);
	if (e.keyCode === 27 || e.keyCode === 37 ||  e.keyCode === 39 || e.keyCode === 8) // ESC || LEFT_ARROW || RIGHT_LEFT_ARROW || BACK SPACE
	{
		// setTimeout (closeAutocomplete, 200);
		closeAutocomplete(); // Inmediately close
	}
	else if (e.keyCode === 40) // DOWN_ARROW
	{  select = false;
		if (current_selected_li && current_selected_li.nextSibling)
		{
			current_selected_li.className = "lista";
			current_selected_li = current_selected_li.nextSibling;
			current_selected_li.className = "lista selected";
		}
	}
	else if (e.keyCode === 38) // UP_ARROW
	{ select = false;
		if (current_selected_li && current_selected_li.previousSibling){
			current_selected_li.className = "lista";
			current_selected_li = current_selected_li.previousSibling;
			current_selected_li.className = "lista selected";   
		}
	}
	else if (e.keyCode === 13) // ENTER
	{
		if (!current_selected_li) return;

		insertCode (current_selected_li.lineObj, current_selected_li.columna, current_selected_li.id, current_selected_li.current_word);
		/* setTimeout (closeAutocomplete, 200); */

		closeAutocomplete();
	}
}

var openAutocomplete = function (e) {

	var word = "";
	var tmp = "";
	var accum = [];
	var obj = get_current_code_mirror().cursorPosition (true);
	var column = obj.character-1;

	try { 
		                                  //LineContent        //Cut      //Trim
		var str = get_current_code_mirror().lineContent(obj.line).substring(0,column+1).replace(/^\s+|\s+$/g,"");
		var str2 = get_current_code_mirror().lineContent(obj.line).substring(0,column+1);
	    prev_token = str2.substring(str2.length -1, str2.length);
		 
		line_tokens_array = str.split(" ");   //Separete by space
		 
        
        word = line_tokens_array[line_tokens_array.length-1];
        // window.console.log (' > word '+   word  );
        
        
		current_word = word;
		if(word.length >= MIN_CHARS){
		    //Searsh in Reserved Keys and get the new tokens array  
		    // Si tiene un espacio busco el arreglo sino el arreglo es el key set   
		    //if(prev_token === ' ') { //  window.console.log (' > tokens '+ map.get( word ));
		    // window.console.log ('>>> word   ['+word+']');
		    tokens = map.get( word );  // Buscar la palabra por clave exactamente = y devolver el array
		    if(tokens != null){ // si existen palabras, accum = palabras
		    	accum = tokens;
		    	if(prev_token === ' ') { 
			       word = ' ';
		    	}else{
                   word = prev_token;
		    	   window.console.log ('>>> word   ['+word+']');
		    	}
		    }else{   // sino buscar en las llaves
		        tokens = map.keySet();
		        for(var j = 0; j < tokens.length; j++){
		          if(tokens[j].indexOf(word) == 0 ){
					accum.push (tokens[j]);
				  }
		        }
		    } 
 
			closeAutocomplete(); 
			
			var currLine = get_current_code_mirror().currentLine() ;

		    if(accum != null){
			  if(accum[0] != undefined){
			   showMenu (obj.line,currLine, column+1, accum, word);
			  }
		    }else{
			  closeAutocomplete();
		    }


		}else{
			closeAutocomplete();
		}
	}  catch(e) {
		window.console.log (' >> ERROR:'+ e);
	}
}

function initCallback (){
	closeAutocomplete();
}

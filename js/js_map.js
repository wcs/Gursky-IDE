 
/**
* ----------------------------------------------------------
* | js_map.js   Javascript HashMap  - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jul, 02 of 2009		     						|
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

function Map(){
	 
	this.keyArray = new Array(); 
	this.valArray = new Array();  

	 
	this.put = put;
	this.get = get;
	this.size = size;
	this.clear = clear;
	this.keySet = keySet;
	this.valSet = valSet;
	this.showMe = showMe;   
	this.findIt = findIt;
	this.remove = remove;
}

function put( key, val ){
	var elementIndex = this.findIt( key );

	if( elementIndex == (-1) ){
		this.keyArray.push( key );
		this.valArray.push( val );
	}
	else{
		this.valArray[ elementIndex ] = val;
	}
}

function get( key ){
	var result = null;
	var elementIndex = this.findIt( key );

	if( elementIndex != (-1) )	{
		result = this.valArray[ elementIndex ];
	}

	return result;
}

function remove( key ){
	var result = null;
	var elementIndex = this.findIt( key );

	if( elementIndex != (-1) )	{
		this.keyArray = this.keyArray.removeAt(elementIndex);
		this.valArray = this.valArray.removeAt(elementIndex);
	}

	return ;
}

function size(){
	return (this.keyArray.length);
}

function clear(){
	for( var i = 0; i < this.keyArray.length; i++ )	{
		this.keyArray.pop(); this.valArray.pop();
	}
}

function keySet(){
	return (this.keyArray);
}

function valSet(){
	return (this.valArray);
}

function showMe(){
	var result = "";

	for( var i = 0; i < this.keyArray.length; i++ )
	{
		result += "Key: " + this.keyArray[ i ] + "\tValues: " + this.valArray[ i ] + "\n";
	}
	return result;
}

function findIt( key ){
	var result = (-1);

	for( var i = 0; i < this.keyArray.length; i++ )
	{
		if( this.keyArray[ i ] == key )
		{
			result = i;
			break;
		}
	}
	return result;
}

function removeAt( index ){
	var part1 = this.slice( 0, index);
	var part2 = this.slice( index+1 );

	return( part1.concat( part2 ) );
}
Array.prototype.removeAt = removeAt;
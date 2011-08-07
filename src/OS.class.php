<?php


/**
* ----------------------------------------------------------
* | OS  Class - Gurski IDE                               |
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jan, 23 of 2010		     						|
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

/**
 * Class For acces to de Opereting System information
 */
class OS {
    
   function __construct(){}

   function getOS(){
        $OSList = array  (
              // Match user agent string with operating systems 
              'Windows 3.11' => 'Win16',
	          'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
              'Windows 98' => '(Windows 98)|(Win98)',
              'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
              'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
              'Windows Server 2003' => '(Windows NT 5.2)',
              'Windows Vista' => '(Windows NT 6.0)',
              'Windows 7' => '(Windows NT 7.0)',
              'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
              'Windows ME' => 'Windows ME',
              'Open BSD' => 'OpenBSD',
              'Sun OS' => 'SunOS',
              'Linux' => '(Linux)|(X11)',
              'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
              'QNX' => 'QNX',
              'BeOS' => 'BeOS',
              'OS/2' => 'OS/2', 
              'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'

      );
      foreach($OSList as $CurrOS=>$Match)  {
              // Find a match
              if (eregi($Match, $_SERVER['HTTP_USER_AGENT']))  {
                      // We found the correct match
                      break;
              }

      }
      return $CurrOS;
   }
}
?>

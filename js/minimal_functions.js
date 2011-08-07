 
/**
* ----------------------------------------------------------
* | minimal_functions.js   - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Dec, 15 of 2009		     						|
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
 function checkBrowser(){
     
     //$("#loginbutton").attr("disabled", true);
 }

// Cookie management
function setCookie(name,value,days) {
    var expires = "";
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		expires = "; expires="+date.toGMTString();
	}
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function deleteCookie(name) {
	setCookie(name,"",-1);
}

function checkempty(code){
    var user = $("#username").val();
    var passw = $("#password").val();
    if(user.length > 0 && passw.length > 4){
       $("#loginbutton").removeAttr("disabled");
       if (code == 13){
           login();
       }
    }else{
       $("#loginbutton").attr("disabled", true);
    }
}
// Registrarion nick check
function checkuser(){
    var user = $("#user").val();
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=checkuser&user="+user+"",
        beforeSend: function(objeto){
            $("#msg_u").html("<label class='msgredsmall'> Checking user disponibility...");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                $("#msg_u").html(objeto.responseText);
                isAllValid();
            }
        }
    });
}

// Registrarion email check
function checkemail(){
    var mail = $("#mail").val();
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=checkemail&mail="+mail+"",
        beforeSend: function(objeto){
            $("#msg_mail").html("<label class='msgredsmall'> Checking Email...");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                $("#msg_mail").html(objeto.responseText);   isAllValid();
            }
        }
    });
}



function register(){
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=register",
        beforeSend: function(objeto){
            $("#loading").html("<label class='loading_msg'> Geting registration form...</label> <img src='../images/progress_small.gif' height='8' width='60'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){
                $("#maincontainer").html(objeto.responseText);
            }
        }
    });
}
function saveUser(){
    // Obtener datos
    var name = $("#fname").val();
    var lastname = $("#lname").val();
    var user = $("#user").val();
    var passw = $("#passw").val();
    var mail = $("#mail").val();
    var phone = $("#phone").val();
    var country = $("#countrys").val();
    var state = $("#state").val();
    var city = $("#city").val();
    var add = $("#add").val();
    var day = $("#day").val();
    var month = $("#month").val();
    var year = $("#year").val();
    var birthdate = ""+year+"-"+month+"-"+day+"";

    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=saveuser&name="+name+"&lastname="+lastname+"&user="+user+"&passw="+passw+"&mail="+mail+"&phone="+phone
        +"&country="+country+"&state="+state+"&city="+city+"&add="+add+"&birthdate="+birthdate+"&add="+add+"",  // Dont work

        beforeSend: function(objeto){
            $("#loading").html("<label class='info'>Saving your data...</label><img src='../images/progress_small.gif' height='8px' width='30px'> ");
        },

        complete: function(objeto, exito){
            if(exito=="success"){
                $("#loading").html(objeto.responseText);
                $("#registrationPanel").slideUp(2000);
                $("#loginform").css("display", "inline");
            }else{
                $("#loading").html("Error..."+exito);
            }
        }
    });
}

// Registrarion name check
function checkusername(){
    var username = $("#fname").val().length;
    if( (username > 0) ){
        $("#msg_fn").html("<label class='msggrensmall' >Ok</label>");
    }else{
        $("#msg_fn").html("<label class='msgredsmall' >Name should be not empty...</label>");
    } isAllValid();
}
// Registrarion lastname check
function checklastname(){
    var lastname = $("#lname").val().length;
    if( (lastname > 0) ){
        $("#msg_ln").html("<label class='msggrensmall' >Ok</label>");
    }else{
        $("#msg_ln").html("<label class='msgredsmall' >Last Name should be not empty...</label>");
    }isAllValid();
}
// Registrarion password check
function checkpassw(){
    var lenght = $("#passw").val().length;
    if(  lenght < 5  ){
        $("#msg_pw").html("<label class='msgredsmall' >Password should be at least 5 letters...</label>");
    }else{
        $("#msg_pw").html("<label class='msggrensmall' >Ok</label>");
    }isAllValid();
}
function isAllValid(){
    var username = $("#fname").val().length;
    var lastname = $("#lname").val().length;
    var plenght = $("#passw").val().length;
    var user = $("#usercheck").text().length;
    var mail = $("#mailcheck").text().length;    //  alert(" user "+ username+ "  ape "+ lastname+" pass "+plenght+" user "+user+" mail "+mail);
    if( (username > 0) && (lastname > 0) && (plenght > 4) && (user == 2) && (mail==2) ){
        $("#savebutton").removeAttr('disabled');
    }else{
        $("#savebutton").attr("disabled", "true");
    }
}

function loginAsInvited(){
     $("#username").val("invited");
     $("#password").val("invited");
     document.getElementById("loginbutton").click(); 
}

init = function(){
    $("#login").fadeTo(1,0);
    $("#login").fadeTo(3000,1);
    // $("#login").slideUp(1);
    //$("#login").slideDown(3000); 
    
    var user = getCookie('user');  
    if(user != null){
       $("input[@name='remember']").attr('checked', true);
    }
    $("#username").val(getCookie('user'));
    $("#password").val(getCookie('passw'));
   
    checkBrowser();
}

// To Login function
function login(){
    var user = $("#username").val();
    var passw = $("#password").val();
    var remember = $("input[@name='remember']:checked").val();
    if(remember==='on'){
       setCookie('user',user,30);
       setCookie('passw', passw,30);
    }else{
        deleteCookie('user');
        deleteCookie('passw');
    }
    $.ajax({
        type: "POST",
        async:true,
        dataType: "html",
        url: "Linker.class.php",
        data: "action=login&user="+user+"&passw="+passw+"",
        beforeSend: function(objeto){
            $("#loading").html("<label class='loading_msg'> Checking user information...</label> <img src='../images/progress_small.gif' height='8', width='60'>");
        },
        complete: function(objeto, exito){
            if(exito=="success"){ 
                if(objeto.responseText.toString()==false){
                    $("#loading").attr("class","display_error");
                    $("#loading").html("<div >&nbsp&nbsp;&nbsp; Invalid Username or password...&nbsp&nbsp;&nbsp;  </div>");
                }else{
                    $("body").html(objeto.responseText);
                    document.redirection_form.submit();
                }

            }
        } 
    });
} 










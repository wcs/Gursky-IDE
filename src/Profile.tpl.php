



<!-- begin: header noeval -->
        <head>
           <link rel="StyleSheet" href="../css/style.css" type="text/css">
           <script type="text/javascript" src="../js/jquery.js"></script>
  <script>
     function updateUser(){
        // Obtener datos
        var name = $("#fname").val();
        var lastname = $("#lname").val();
        var user = $("#user").val(); 
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
            data: "action=update_user&name="+name+"&lastname="+lastname+"&user="+user+"&mail="+mail+"&phone="+phone
            +"&country="+country+"&state="+state+"&city="+city+"&add="+add+"&birthdate="+birthdate+"&add="+add+"",  // Dont work

            beforeSend: function(objeto){
                $("#loading").html("<label class='info'>Updating your data...</label><img src='../images/progress_small.gif' height='8px' width='30px'> ");
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
        function allValid(){
            var username = $("#fname").val().length;
            var lastname = $("#lname").val().length;   
            var mail = $("#mailcheck").text().length;  
            if( (username > 0) && (lastname > 0)  && (mail==2) ){
                $("#savebutton").removeAttr('disabled');
            }else{
                $("#savebutton").attr("disabled", "true");
            }
        }

        // Registrarion name check
        function checkusername(){
            var username = $("#fname").val().length;
            if( (username > 0) ){
                $("#msg_fn").html("<label class='msggrensmall' >Ok</label>");
            }else{
                $("#msg_fn").html("<label class='msgredsmall' >Name should be not empty...</label>");
            } allValid();
        }
        // Registrarion lastname check
        function checklastname(){
            var lastname = $("#lname").val().length;
            if( (lastname > 0) ){
                $("#msg_ln").html("<label class='msggrensmall' >Ok</label>");
            }else{
                $("#msg_ln").html("<label class='msgredsmall' >Last Name should be not empty...</label>");
            }allValid();
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
                        allValid();
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
                        $("#msg_mail").html(objeto.responseText);   allValid();
                    }
                }
            });
        }


  </script>

        </head>
        
        <table border="0" width="100%"  height="100%" >
           <tr> <td height="3%" align="center" id="loading">  </td> </tr>
           <tr> <td height="1%" width="100%" align="center"   >

<!-- end:  header -->

<!-- begin: body -->

           </td> </tr>
           <tr> <td height="15%" align="center">

             <table border="0"  width="100%"  height="100%" >
               <tr>
                <td width="10%" >  </td>
                <td align="center" class="registrationPanel" id="profile" cellspacing="0" cellpadding="0" >

                   <table    width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" class="registrationPanel"   >
                    <tr>   <td  colspan="2" align="center" height="36px" ><b> Gurski Edit Profile</b> </td>  </tr>
                     <tr class="zebra1">   <td  width="40%" align="left" style="text-indent:50pt"> <label class="label"> Username:</label> </td>
                     <td> <input value="{user}" disabled id="user" class="textfield" type="text" size="25" maxlength="25"  ><b></b><label id="msg_u">  </label>   </td></tr>
                   
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"  > <label class="label" >First Name:</label> </td>
                      <td > <input value="{name}" id="fname" class="textfield" type="text" size="25" maxlength="25" onblur="checkusername()" ><b>*</b> <label id="msg_fn">  </label>   </td></tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Last Name:</label>
                      </td>  <td> <input value="{last_name}" id="lname" class="textfield" type="text" size="25" maxlength="25" onblur="checklastname()" ><b>*</b> <label id="msg_ln">  </label>  </td></tr>
                     
                      <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Email:</label> </td>
                      <td> <input value="{mail}" id="mail"  class="textfield" type="text" size="25" maxlength="25" onblur="checkemail()" ><b>*</b><label id="msg_mail">  </label>   </td>  </tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Phone: </label> </td>
                      <td> <input value="{phone}" id="phone" class="textfield" type="text" size="25" maxlength="25" onblur="allValid()" >   </td>  </tr>



<!-- end: body -->

<!-- begin: countryc -->
                           <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Country: </label> </td>  <td>
                           <select id="countrys" class="combobox">
<!-- end:   countryc -->
<!-- begin: countrydata -->
                                 <option>{country}</option>
<!-- end: countrydata -->
<!-- begin:   countrye -->
                           </select>
                           </td> </tr>
<!-- end:   countrye -->

<!-- begin: states -->
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> State: </label> </td>  
                     <td> <input value="{state}"   id="state" class="textfield" type="text" size="25" maxlength="25" >   </td>  </tr>
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> City: </label> </td> 
                     <td> <input value="{city}"  id="city" class="textfield" type="text" size="25" maxlength="25" >   </td>  </tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Address: </label> </td> 
                     <td> <input value="{add}" id="add" class="textfield" type="text" size="40" maxlength="400" >   </td>  </tr>

<!-- end:  states -->

<!-- begin: bdc -->
                    <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Birth Date: </label> </td>
                     <td>
                     <table cellpadding="0" cellspacing="0">
                           <tr>
<!-- end:  bdc -->
<!-- begin: daysc -->
                         <td><select class="combobox" id="day">
<!-- end:  daysc -->
<!-- begin: daysdata -->
                                   <option> {day} </option>
<!-- end:   daysdata -->
<!-- begin: dayse -->
                         </select>
<!-- end:  dayse -->
<!-- begin: months -->

                                <select class="combobox" id="month">
                                    <option>{month}</option>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
<!-- end:  months -->

<!-- begin: yearc -->        &nbsp;
                               <select id="year" class="combobox">
<!-- end:  yearc -->
<!-- begin: yeardata -->
                                    <option>{year}</option>
<!-- end: yeardata -->

<!-- begin: yeare -->
                               </select>
                             </td>
<!-- end:   yeare -->
<!-- begin: bde -->
                            </tr>
                      </table>
                     </td>  </tr>
<!-- end: bde -->
<!-- begin: last -->
                     <tr>   <td height="36px"  colspan="2"  align="center" >
                     <input type="button"   class="button" value="   Back   "  onclick="parent.editProfileWin.close()" id="backbutton"  >
                     <input type="button"  class="button" value="   Save   "  onclick="updateUser()"  id="savebutton" ></td>  </tr>
                  </table>

                </td>
                <td width="10%">   </td>
               </tr>
           </table>

          </td> </tr>
          <tr> <td height="5%">   </td> </tr>
        </table>

<!-- end:   last -->


<!-- begin: changePassw  -->
        <head>
           <link rel="StyleSheet" href="../css/style.css" type="text/css">
           <script type="text/javascript" src="../js/jquery.js"></script>
           <link rel="StyleSheet" href="../css/style.css" type="text/css">
           <input type="hidden"  id="user_id" value="{user_id}">
         </head>

     <table border="0"  width="100%"  height="100%" >
       <tr>
        <td width="5%" >  </td>
        <td>
        <table width="100%" height="100%" border="0" cellspacing="1" cellpadding="1">
             <tr> <td height="28px" colspan="3" id="msg" align="center"  > </td> </tr>
             <tr> <td  class="registrationPanel">
             <table border="0"  width="100%" >
                <tr>
                   <td  colspan="2"  align="center" > <label class="label"> Change Password </label>  </td>
                </tr>
                <tr class="zebra0">
                    <td > <label class="label">Enter current password </label>  </td>
                    <td> <input type="password" size="20" id="passw" class="textfield" onblur="check()"> <span id="loading"></span> </td>
                </tr>
                <tr class="zebra1">
                    <td> <label class="label">New password </label> </td>
                    <td> <input type="password" size="20" id="pass1" class="textfield" disabled> </td>
                </tr>
                <tr class="zebra0">
                    <td> <label class="label">Confirm password </label> </td>
                    <td> <input type="password" size="20" id="pass2" onblur="checkEqual()" onchange="checkEqual()" class="textfield" disabled> </td>
                </tr>
                 <tr class="zebra1">
                   <td colspan="2" align="center" height="26px" >
                     <input type="button"   class="button" value="   Back   "  onclick="parent.editProfileWin.close()" >
                    <input type="button" id="change" class="button" value="Change Password" onclick="changePassword()" disabled>
                   </td>
                </tr>
            </table>
            </td> </tr>
             <tr> <td height="28px" colspan="3"   align="center"  > &nbsp;</td> </tr>
        </table>
        </td>
        <td width="5%" >  </td>
       </tr>
   </table>
<!-- end:   changePassw -->


<!-- begin: script noeval -->
          <script>
              function checkEqual(){
                var p0 = $("#pass1").val();
                var p1 = $("#pass2").val();
                if(p0===p1){
                      var lenght = $("#pass2").val().length;
                        if(  lenght < 5  ){
                            $("#msg").html("<label class='display_error' >Password should be at least 5 letters...</label>");
                        }else{
                            $("#change").removeAttr('disabled');
                            $("#msg").html("");
                        }   
                }else{
                   $("#msg").html("<label class='display_error'>Passwords are not equals...</label>");
                   $("#change").attr("disabled", "true"); 
                }
              }
              function check(){
                var user_id = $("#user_id").val();
                var passw = $("#passw").val();
                    $.ajax({
                        type: "POST",
                        async:true,
                        dataType: "html",
                        url: "Linker.class.php",
                        data: "action=check_passw&user_id="+user_id+"&passw="+passw+"",
                        beforeSend: function(objeto){
                            $("#msg").html("<label class='info'> Checking current password...</label>");
                            $("#loading").html("<img src='../images/progress_small.gif' height='8', width='24'>");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){
                                if(objeto.responseText.toString().replace(/^\s+|\s+$/g,"") === "Ok"){
                                  $("#msg").html("");
                                  $("#loading").html("<label class='msggrensmall'>Ok</label>");
                                  $("#pass1").removeAttr('disabled');
                                  $("#pass2").removeAttr('disabled');
                                  $("#passw").attr("disabled", "true");
                                }else{
                                  $("#msg").html("<label class='display_error' >Wrong password...</label>");
                                  $("#loading").html("<img src='../images/tree/cross.png' height='16', width='16'>");
                                  $("#pass1").attr("disabled", "true");
                                  $("#pass2").attr("disabled", "true");
                                  $("#change").attr("disabled", "true");
                                }
                            }
                        }
                    });
              }

              function changePassword(){
                var user_id = $("#user_id").val();
                var passw = $("#pass2").val();
                $.ajax({
                        type: "POST",
                        async:true,
                        dataType: "html",
                        url: "Linker.class.php",
                        data: "action=change_passw&user_id="+user_id+"&passw="+passw+"",
                        beforeSend: function(objeto){
                            $("#msg").html("<label class='info'> Checking current password...</label><img src='../images/progress_small.gif' height='8', width='24'>");
                        },
                        complete: function(objeto, exito){
                            if(exito=="success"){
                               $("#change").attr("disabled", "true");
                               $("#msg").html("<label class='info'>Password changed successfull...</label>");
                               setTimeout("parent.editProfileWin.close();",3000);
                            }
                        }

                 });
              }

          </script>

 <!-- end:   script -->

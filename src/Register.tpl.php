

<!-- begin: header -->
        <table border="0" width="100%"  height="100%" >
           <tr> <td height="3%" align="center" id="loading">  </td> </tr>
           <tr> <td height="1%" width="100%" align="center"   >
             <table border="0" id="loginform" width="100%"  height="100%" style="display:none"  width="100%" >
               <tr>
                <td width="33%" >  </td>
                <td align="center" class="loginPanel" id="login"  >
<!-- end:  header -->
       <!-- Login form here  -->
<!-- begin: body -->
                </td>
                <td width="33%"> </td>
               </tr>
           </table>
           </td> </tr>
           <tr> <td height="20%" align="center">

             <table border="0"  width="100%"  height="100%" >
               <tr>
                <td width="20%" >  </td>
                <td align="center" class="registrationPanel" id="registrationPanel" cellspacing="0" cellpadding="0" >

                   <table    width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0" class="registrationPanel"   >
                     <tr>   <td  colspan="2" align="center" height="36px" ><b> Gurski Registration</b> </td>  </tr>
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"  > <label class="label" >First Name:</label> </td>
                      <td > <input id="fname" class="textfield" type="text" size="25" maxlength="25" onblur="checkusername()" ><b>*</b> <label id="msg_fn">  </label>   </td></tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Last Name:</label>
                      </td>  <td> <input id="lname" class="textfield" type="text" size="25" maxlength="25" onblur="checklastname()" ><b>*</b> <label id="msg_ln">  </label>  </td></tr>
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Username:</label> </td>
                      <td> <input id="user" class="textfield" type="text" size="25" maxlength="25"  onblur="checkuser()" ><b>*</b><label id="msg_u">  </label>   </td></tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Password:</label> </td>
                      <td> <input id="passw" class="textfield" type="password" size="25" maxlength="25"   onblur="checkpassw()"  ><b>*</b> <label id="msg_pw">  </label>  </td></tr>
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Email:</label> </td>
                      <td> <input id="mail"  class="textfield" type="text" size="25" maxlength="25" onblur="checkemail()" ><b>*</b><label id="msg_mail">  </label>   </td>  </tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Phone: </label> </td>
                      <td> <input id="phone" class="textfield" type="text" size="25" maxlength="25" onblur="isAllValid()" >   </td>  </tr>
                     

                    
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
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> State: </label> </td>  <td> <input id="state" class="textfield" type="text" size="25" maxlength="25" >   </td>  </tr>
                     <tr class="zebra0">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> City: </label> </td>  <td> <input id="city" class="textfield" type="text" size="25" maxlength="25" >   </td>  </tr>
                     <tr class="zebra1">   <td width="40%" align="left" style="text-indent:50pt"> <label class="label"> Address: </label> </td>  <td> <input id="add" class="textfield" type="text" size="40" maxlength="400" >   </td>  </tr>
                     
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
                     <input type="button"   class="button" value="   Back   "  onclick="home()" id="backbutton"  >
                     <input type="button" disabled="true" class="button" value="   Save   "  onclick="saveUser()"  id="savebutton" ></td>  </tr>
                  </table>

                </td>
                <td width="20%">   </td>
               </tr>
           </table>

          </td> </tr>
          <tr> <td height="20%">   </td> </tr>
        </table>

<!-- end:   last -->

 


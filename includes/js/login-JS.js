// JavaScript Document
// Javascript for login module

              $( "#submitButton" ).click(function() {
                  var userName = $( "#username" ).val();
                  var passWord = $( "#password" ).val();
                  var customerID = "<?php echo $_SESSION['MM_UserGroup']; ?>";
				  var buttonValue = $( "#submitButton" ).attr( "value" );
				  if(buttonValue == "Sign Out") {
						   var oTable = $('#example').dataTable();
						   oTable.fnClearTable();
						   $( "#logged-in-user-details" ).html( "Signing Out..." ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 ).fadeOut( 400 );
						   $( ".username" ).html( '' );
						   $( "#email" ).html( '' );						   
						   $( "#member_since" ).html( '' );
						   $( "#customerid" ).html( '' );
						   $( ".ship_address" ).html( '' );
						   $( ".ship_city" ).html( '' );
						   $( ".ship_state" ).html( '' );
						   $( ".ship_zip" ).html( '' );
						   $( "#submitButton" ).attr( 'value', "Sign In" );
						   $.post("includes/php/logout.php");
						   $( "#logged-in-user-details-2" ).fadeOut( 0 ).html( "You are Logged out" ).delay( 1000 ).fadeIn( 2000 );
 				  } else {					  
                  $.ajax({
                      type:"POST",
                      url:"includes/php/class-login.php",
					  
					  //the data object contains the username and password and is 
					  //used to submit the users credentials to the class-login.php script
                      data:{username:userName, password:passWord}
                      }).done(function( html ) {
                          $( "#disc_table" ).append(html);
                          $.post("includes/php/class-raw-user-discounts.php", function(aaData){
							  $( ".id2" ).html( aaData.id );
							  $( ".discount_code2" ).html( aaData.discount_code );
							  $( ".type2" ).html( aaData.type );
							  $( ".amount2" ).html( aaData.amount );
							  $( ".applied2" ).html( aaData.applied );
							  $( ".date_obtained2" ).html( aaData.date_obtained );
							  $( ".expiration_date2" ).html( aaData.expiration_date );
							  $( ".multiple_use2" ).html( aaData.discount_code );
							  $( ".combinable2" ).html( aaData.combinable );
                         }, "json");
                          $( "#promptDiv" ).append(html);
                          $.post("includes/php/class-account-details.php", function(data){
							  $( "#logged-in-user-details" ).html( "Username: " + data.username + "<br>Customer ID: " + data.customerid );
							  $( "#submitButton" ).attr( 'value', "Sign Out" );
							  $( ".username" ).html( data.username );
							  $( "#email" ).html( data.email );
							  $( "#member_since" ).html( data.member_since );
							  $( "#customerid" ).html( data.customerid );
							  $( ".ship_address1" ).html( data.ship_address1 );
							  $( ".ship_address2" ).html( data.ship_address2 );
							  $( ".ship_city" ).html( data.ship_city );
							  $( ".ship_state" ).html( data.ship_state );
							  $( ".ship_zip" ).html( data.ship_zip );
							  $( ".bill_address1" ).html( data.bill_address1 );
							  $( ".bill_address2" ).html( data.bill_address2 );
							  $( ".bill_city" ).html( data.bill_city );
							  $( ".bill_state" ).html( data.bill_state );
							  $( ".bill_zip" ).html( data.bill_zip );
							  $( ".bill_phone" ).html( data.bill_phone );
                          }, "json");
						  // $( "#disc_table" ).append( html );
						   //$.post( "includes/php/class-account-details.php", function( data ) {
							   //$( "						  						  
						  $( "#logged-in-user-details" ).effect( "highlight", "easeOutBounce", 900 );

                          var active = $( "#application" ).accordion( "option", "active" );
                          // setter - set the 2nd accordion tab to open
                          $( "#application" ).accordion( "option", "active", 1 );

                          var oTable = $('#example').dataTable();
						   oTable.fnDestroy();
 						  						                          
						  var oTable = $('#example').dataTable({
							  "aoColumns": [
                                { "sClass": "id"},//discounts_customer database id of user discount
								{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Customer ID					  
								{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Name of the discount
								null,//discount code
								{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Type of discount
								null,//amount of discount
								{ "sClass": "editable_textarea" },//status of the discount(i.e. applied or not applied)
								{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Date the discount was obtained
								null,//Expiration date of the discount
								null,//availability for more than one use
								null,//availability to be combined with other discounts								
								{ "bVisible": false, "aTargets": [ 0 ] }//Hides the Column for the Life of the Discount
							  ],
							  "bProcessing": true,
							  "bJQueryUI": true,
							  "bLengthChange": false, //disables user ability to change the number of discounts displayed
							  "bFilter": false,// displays Search box, setting false removes filter ability all together
							  "sAjaxSource": "includes/php/class-user-discounts.php"
                          }).makeEditable( 'includes/php/editable_ajax.php', {
                              "callback": function( sValue, y ) {
                                  var aPos = oTable.fnGetPosition( this );
                                  oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                              },
                              "submitdata": function ( value, settings ) {
                                  return {
                                      "row_id": this.parentNode.getAttribute('id'),
                                      "column": oTable.fnGetPosition( this )[2]
                                  };
                              },
                              "height": "24px"
                          });
                      });
				  };
              });				  	

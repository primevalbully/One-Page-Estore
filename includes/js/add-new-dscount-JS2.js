// JavaScript Document
// Javascript for Add New Discount Module

                      $("#fuck").click(function() {
                          var discountCode = $( "#discount_code" ).val();
                          var code = $( "#code" ).val();
                          var hidden = $( "#hidden" ).val();
                          $.ajax(
                          {
                              type:"POST",
                              url:"../php/php-ajax-output.php",
                              data:{ discount_code:discountCode, code:code, hidden:hidden}
                              }).done(function( html ) 
                              {
                                  $( "#discount-messages" ).empty();
                                  $( '#siimage' ).attr('src', '../php/securimage_show.php?sid=' + Math.random());
                                  $( '#code' ).val( '' );
                                 // $( "#messages" ).append(html);
                                  $( "#discount-messages" ).append(html);
								  $( "#discount-messages" ).dialog({
									  draggable: false,
									  modal: true,
									  height: "auto",
									  width: "auto",
									  resizable: false,
									  autoOpen: true,
									  //appendTo: "#messages",
									  buttons: {
										  Ok: function() {
											  $( this ).dialog( "close" );
										  }
									  },
									  show: {
										  effect: "blind",
										  duration: 1000
									  },
									  hide: {
										  effect: "explode",
										  duration: 1000
									  }
								  });

								  // Example call to reload from original file
								  $(function() {
									  var oTable = $('#example').dataTable();
									   
									  // Reload discount table after user attempts to register a new discount
									  var oTableReloadAjax =  oTable.fnReloadAjax();
									  console.log( oTableReloadAjax );
									  
									  //After the discount data table is reloaded this code acivates the 
									  //accordion and automatically opens the user discounts tab.
									  // getter
									  
									  var active = $( "#application" ).accordion( "option", "active" );
									      // setter - set the 5th accordion tab to open
										  $( "#application" ).accordion( "option", "active", 4 );
									  /*if(isset($_SESSION['M_added']) && ($_SESSION['M_added'] !== '')) {						   
									  if(true) {
										  // setter - set the 5th accordion tab to open
										  $( "#application" ).accordion( "option", "active", 4 );
									  } else {
										  $( "#application" ).accordion( "option", "active", 3 );*/
									  });
                              });
                      });

// jQuery UI Widgets
$(function () {
    $("#application").accordion({
        heightStyle: "content",
        collapsible: true,
        active: 3
    });// Accordion containing all modules within the application
    $("#accordion").accordion({
        heightStyle: "content",
        collapsible: true,
        active: 1
    });// Accordion for the checkout module
    $("#tabs").tabs({
        show: {
            effect: "fold",
            duration: 400
        }
    });// Tabs widget function for accound details module.
	
	// What is this code doing?
    $('#fuck').click(function () {
        // because we have overriden the global AJAX settings
        // the spinner will be shown during the request
       $('fieldset').load();
    });

    $( '#application' ).tooltip({		
		show: {
			effect: "clip", duration: 1, delay: 800
			},
		hide: {
		    effect: "scale", duration: 150
			},
        position: {
			my: "left bottom",
			at: "left top",
			using: function( position, feedback ) {
			  $( this ).css( position );
			  $( "<div>" )
				.addClass( "arrow" )
				.addClass( feedback.vertical )
				.addClass( feedback.horizontal )
				.appendTo( this );
			},
		}
	}); 
});

	function buttFormatter( data ) {
		return '<form class="field" id="' + data[i][0] + '"><input type="' +  data[i][3] + '" class="three-d-button" value="' +  data[i][2] + '"><input id="id" type="hidden" value="' + data[i][0]+ '"><input id="' +  data[i][0] + '" type="hidden" value="' + changeStatusTo + '"></form>'; 
	}
	
	$(function() {
	// Add a default gif loading image each time an ajax request is made.
    // This block of code must be placed at the end of the page head.
	// set global ajax options:
    $.ajaxSetup({
        beforeSend: function (xhr, status) {
            // TODO: show spinner
            $('.spinner').show();
        },
        complete: function () {
            // TODO: hide spinner
            $('.spinner').hide();
        }
    });
});

$(document).ready( function () {
    var table = $('#example').DataTable({
        processing: true,
        serverSide: true,
        //orderFixed: {
         //"pre": [ 5, 'asc' ]
       // },
        stateSave: true,
        ajax: {
            type: "POST",
            url: "../../test/ids-objects4.php",
			data: null,
        },
		// Oddly enough, if the initial ordering of the table
		// uses the first column "id" it results in a SQL error
		// and fails to display the table after initially signing in.
		order: [3, 'asc'],
		orderable: true,
		columnDefs: [{
            data: "id",
            name: "ID",
            title: "",
			orderable: false,
            type: "html",
            targets: 0,
            render: (function (data) {
                if ($.isNumeric(data)) {
                    return '<form class="field" id="' + data + '" data-order="' + data + '"><input type="button" class="delete" value="X"><input id="' + data + '" type="hidden" value="' + data + '"></form>';
                } else {
                    return data;
                }
            }),
            createdCell: function ( td, cellData, rowData, row, col ) {
                $(td).attr("data-sort", cellData);
            }
        }, // discounts_customer database id of user discount
        {
            data: "customerid",
            name: "customerid",
            visible: false,
            targets: 1
        }, // Hides the Column for the Customer ID
        {
            data: "discount_name",
            name: "discount_name",
            visible: false,
            targets: 2
        }, // Hides the Column for the name of the discount
        {
            data: "discount_code",
            name: "discount_code",
            title: "Discount Code",
            targets: 3,
            createdCell: function ( td, cellData, rowData, row, col ) {
                $(td).attr("data-sort", cellData);
            }
        }, // discount code
        {
            data: "type",
            name: "type",
            visible: false,
            targets: 4
        }, // Hides the Column for the type of discount
        {
            data: "amount",
            name: "amount",
            title: "Amount",
            targets: 5,
            createdCell: function ( td, cellData, rowData, row, col ) {
				var num = rowData.amount;
                $(td).attr({"data-sort": cellData});
				if( rowData.type == "percent" ) {
					//console.log( "percent is: " + num + "%");
					return $(td).html( num + "%" );
				} else if ( rowData.type == "fixed" ) {
					//console.log( "fixed is: " +  "$" + num + ".00");
					return $(td).html( "$" + num + ".00" );
				}
            }
        }, // amount of discount
        {
            data: null,
			defaultContent: '',
            name: "applied",
            className: "applied",
            type: "html",
            title: "Applied",
            targets: 6,
            createdCell: function ( td, cellData, rowData, row, col ) {
				//console.log("row: " + row + " col: " + col + " rowData: " + rowData.id + " cellData: " + cellData);
                // This adds a unique id to each table cell in the
					// "applied" columning allowing for further changes to 
					// be made as seen below in the code following the DT
					// table initialization. 
				$( td ).attr( { id: "applied_" + rowData.id, "data-sort": rowData.applied } );
				if (rowData.applied == "YES") {
					var changeStatusTo = "NO";
					var button_value = "Use Later";
				} else {
					var changeStatusTo = "YES";
					var button_value = "Apply";
				}
 				$(td).append('<form class="field"><input id="' + "button_" + rowData.id + '" type="button" class="three-d-button" value="' + button_value + '"style="display:none;"></form>');           },
        }, 
		{
            data: "date_obtained",
            name: "date_obtained",
            visible: false,
            targets: 7
        }, // Hides Column for date the discount was obtained
        {
            data: "expiration_date",
            name: "expiration_date",
            title: "Expiration Date",
            targets: 8
        }, // Expiration date of the discount
        {
            data: "multiple_use",
            name: "multiple_use",
            visible: false,
            targets: 9
        }, // availability for more than one use
        {
            data: "combinable",
            name: "combinable",
            title: "Combinable",
            targets: 10,
			createdCell: function( td, cellData, rowData, row, col ) {
				$( td ).attr( { "data-sort": cellData } );
				if( cellData == "YES" ) {
					$( td ).addClass( "combinable-discount-text" ).attr( "title", "you may combine this with other discounts!" ).html( "YES!" );
				} else {
					$( td ).attr( "title", "Sorry, may not be combined with any other discount." );
				}
			}
        }, // availability to be combined with other discounts
        {
            data: "life_of_discount",
            name: "life_of_discount",
            visible: false,
            targets: 11
        } // Hides the Column for the Life of the Discount
        ],
        paging: true,
        pageLength: 5,
        lengthChange: true, 
		// Allows the user to change how many discounts are displayed per page
        lengthMenu: [
            [1, 2, 3, 4, 5, -1],
            [1, 2, 3, 4, 5, "All"]
        ],
        pagingType: "full_numbers", // Displays: 'First', 'Previous', [Numerical Page Numbers], 'Next', and 'Last' buttons.
        jQueryUI: true, // use the jQuery UI theming capabilities.
        filter: false, // Hides Search input. 
		    // Setting it to false removes the DT table filter capabilites all together
        ordering: true, // Enables the ordering of column data for sorting purposes.
		autoWidth: false,
		//scrollY: "200px",
		//scrollCollapse: false, // Restricts the table from reducing in height when a limited number of rows are shown.
		language: {
			emptyTable: "Please Sign-In as a Guest to Preview this Feature!",
			infoEmpty: "There are no records to display.",
			processing: "Retrieving Data..."
		}, // Table summary message used when the table is empty or has no records.
        dom: '<"H"<"drop_menu"l><"field"f>r>t<"F"ip>', // DT table control elements and layout properties; 
		//including order, appearance, occurances, and tag insertions to control styling options with CSS. 
			// <"H" === inserts the jQueryUI wrapper for the header.
			// <"drop_menu"l> === inserts a nested DT page length control element "l" wrapped in a div of class .drop_menu.
			// <"field"f> === inserts a nested input filtering table element "f" wrapped in a div of class .field.
			// r> === "r" is the processing display table element.
			// t === inserts the table element "t".
			// <"F"ip> === inserts the jQueryUI footer wrapper with nested table elements "i" and "p" for table display info and pagination control, respectively. 
        infoCallback: function (settings, start, end, max, total, pre) {
            var api = this.api();
            var pageInfo = api.page.info();
            var pageLength = api.page.len();
            var pageStart = api.page.len();
            var tableinfo = api.page.info();
            total = tableinfo.recordsTotal;
            pageIndex = tableinfo.end;
            // recordsDisplay - Data set length once the current search criteria has been applied.	
            RD_Total = tableinfo.recordsDisplay;
            return pre;
        },
		drawCallback: function( settings ) {
			$.post("class-discount3.php", function(d) {
				 for ( var i = 0; i < d.length; i = i +1 ) {
                    //var button_visibility = $( '#' + "button_" + d[i][0] ).attr({ type: d[i][3] });	
					// At first, I attempted to toggle the type="hidden" vs type="submit" of the input
					// field in order to hide the ability to add restricted discounts from the user.
					// However, this method proved far too slow it application which may have been 
					// because of the intensive processing load placed on the dataTables api in being 
					// required to search throught and alter to many specific fields in the dom.
					// Ultimately, it proved far faster to simply identify the discounts and buttons
					// thereof that needed to be hidden and simply use the jQuery .html() method to 
					// remove them completely from the dom. It is not surprising that this route proved
					// to be much faster because the jQuery .html() method uses the browsers native and 
					// usually faster methods, and in this case being the innerHTML method.		
					
					// d[i][3] refers to the enumerative array variable for the input field type,
					// i.e. "hidden" or "submit"		 
					if(d[i][3] == "submit") {
						var button_visibility = $( '#' + "button_" + d[i][0] ).css({display: "inline"});
			          
						/*** 
						var formTemplate = '<form class="field" id="' + d[i][0] + '">
						  <input type="' +  d[i][3] + '" class="three-d-button" value="' +  d[i][2] + '">
						  <input id="' +  d[i][0] + '" type="hidden" value="' + changeStatusTo + '"></form>'; 
						***/
					 //$("#0").append( '<div id="' + i + '">' + formTemplate + '</div>' );
					 } else {
						//var button_visibility = $( '#' + "button_" + d[i][0] ).css({display: "none"});
						// If d[i][3] does not equal "submit" it must therfore equal "hidden"
						// and we can safely use the jQuery .html() method to completely remove
						// the button from the dom. 
						// The asterisks in red serve as a place holder letting the customer
						// know these discounts are restricted.
						$('#' + "applied_" + d[i][0]).html("**").css({color: "red" });
					}
				 }
			}, "json");
		},
		initComplete: function( settings ) {
			table.column( 9 ).visible( false );
		}
    }); //Closing tags for initialization of DT settings.
 
    // Event listener for user deleted discounts.				
    $('#example tbody').on('click', '.delete', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var ID = data.id;
		
        $.ajax({
            type: "post",
            url: "class-delete-user-discount.php",
            data: {
                id: ID
            }
        })
            table.row($(this).parents('tr')).remove().draw(false);
    });

    // Event listener for user modified discounts.				
    $('#example tbody').on('click', '.three-d-button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var ID = data.id;
        var button_value = $('#example tbody .three-d-button').attr('value');
		        
		if (data.applied == "YES") {
            var changeStatusTo = "NO";
        } else {
            var changeStatusTo = "YES";
        }
        $.ajax({
            type: "post",
            url: "class-update-user-discount.php",
            data: {
                id: ID,
                applied: changeStatusTo
            }
        }).done(function (html) {
            $.post("../php/cart-summary.php", function (data) {
                $(".total-cart-items").html("Items: " + data.total_cart_items);
                $(".cart-subtotal-price").html("Subtotal: " + data.cart_subtotal_price).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 );;
                $(".total-savings").html("Savings: " + data.total_savings).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 );;
            }, "json");
            table.draw(false);
        });
    });

    $('#next').on('click', function () {
        table.page('next').draw(false);
    });
    $('#previous').on('click', function () {
        table.page('previous').draw(false);
    });
    var data = table.column(2).data().sort();
    var order = table.order();
    //table.order([0, 'desc']).draw(false);
    var page = table.page();
    var info = table.page.info();

    // Javascript for login module
	$( "#submitButton" ).click(function() {
		// Show loading gif
		$(".spinner").show();
		var userName = $( "#username" ).val();
		var passWord = $( "#password" ).val();
		//var customerID = "<?php echo $_SESSION['MM_UserGroup']; ?>";
		var buttonValue = $( "#submitButton" ).attr( "value" );
		if(buttonValue == "Sign Out") {
			$.ajax({
				type:"POST",
				url:"../php/logout.php"
			}).done(function(html) {
				 $( "#submitButton" ).attr( 'value', "Sign In" );
				 $( "#logged-in-user-details" ).html( "Signing Out..." ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 ).fadeOut( 400 );
				 $( ".username" ).html( '' );
				 $( "#email" ).html( '' );						   
				 $( "#member_since" ).html( '' );
				 $( "#customerid" ).html( '' );
				 $( ".ship_address" ).html( '' );
				 $( ".ship_city" ).html( '' );
				 $( ".ship_state" ).html( '' );
				 $( ".ship_zip" ).html( '' );
				  $(".total-cart-items").html( "Items: " + '' ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 700 ).fadeOut( 400 );
				  $(".cart-subtotal-price").html( "Subtotal: " + '' ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 ).delay( 600 ).fadeOut( 400 );
				  $(".total-savings").html( "Savings: " + '' ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 ).delay( 1200 ).fadeOut( 400 );
				 $( "#logged-in-user-details-2" ).fadeOut( 0 ).html( "You are Logged out" ).delay( 1000 ).fadeIn( 2000 );
				 $('#example').DataTable({
					   retrieve: true, //Retrieves an existing DT instance
					   destroy: true 
					}).clear().draw(); 
					//clear() the users data from temporary memory and then 
						//redraw the table so that it renders with the enhancements made by DT but with no user data
					//This allows for the appearence of the enhanced table to remain intact
				var active = $( "#application" ).accordion( "option", "active" );
				// setter - set the 2nd accordion tab to open
				$( "#application" ).accordion( "option", "active", 3 );
						//instead of reverting back to the original table HTML.
				// Hide the loading gif.
				$(".spinner").hide();
			});
		} else {					  
		$.ajax({
			type:"POST",
			url:"../php/class-login.php",			
			//the data object contains the username and password and is 
			//used to submit the users credentials to the class-login.php script
			data:{username:userName, password:passWord}
			}).done(function( html ) {
				$( "#logged-in-user-details-2" ).html( '' );
				$.post("../php/class-account-details.php", function(data){
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
						  $.post( "../php/cart-summary.php", function( data ) { 
							  $(".total-cart-items").html( "Items: " + data.total_cart_items ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 );
							  $(".cart-subtotal-price").html( "Subtotal: " + data.cart_subtotal_price ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 );
							  $(".total-savings").html( "Savings: " + data.total_savings ).fadeIn( 400 ).effect( "highlight", "easeOutBounce", 900 );
						  }, "json" );

				$( "#logged-in-user-details" ).effect( "highlight", "easeOutBounce", 900 );

				var active = $( "#application" ).accordion( "option", "active" );
				// setter - set the 2nd accordion tab to open
				$( "#application" ).accordion( "option", "active", 3 );
				
				$('#example').DataTable({
					retrieve:true,
					destroy:true
				}).draw();
			}); 
		};
	});	// Closing tags for login module.			  	
	
	// Javascript for Add New Discount Module
    // select all the a tag with name equal to modal
    $('input[name=submit]').click(function (e) {
        // Cancel the link behavior
        e.preventDefault();
        // Get the A tag
        // The var id = '#dialog' or <a href="#dialog">
        // associates the <a> tag with the <div id="dialog"> tag
        // making it possible to identify what pops up when the event
        // is triggered.
        var id = $(this).attr('id');

        // Get the screen height and width
        var maskHeight = $("#application").height();
        var maskWidth = $(".container").width();

        // Set height and width to mask to fill up the whole screen
        $('#mask').css({
            'width': maskWidth,
            'height': maskHeight
        });

        // transition effect
        $('#mask').fadeIn(500);
        $('#mask').fadeTo("fast", 0.8);

        // Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
		//alert( "the winH is: " + winH + " and the winW is: " + winW );
        // Set the popup window to center
        $(id).css('top', maskHeight / 2 - $(id).height() / 2);
        $(id).css('left', maskWidth / 2 - $(id).width() / 2);

        // transition effect
        $(id).fadeIn(500);

    });

    // if close button is clicked
    $('button').click(function (e) {
        // Cancel the link behavior
        e.preventDefault();

        $('#mask').hide();
        $('.window').hide();
    });

    // if mask is clicked
    $('#mask').click(function () {
        $('#mask').hide();
        $('.window').hide();
    });

    $(window).resize(function () {

        var box = $('#boxes .window');

        // Get the screen height and width
        var maskHeight = $("#application").height();
        var maskWidth = $(".container").width();

        // Set height and width to mask to fill up the whole screen
        $('#mask').css({
            'width': maskWidth,
            'height': maskHeight
        });

        // Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        // Set the popup window to center
        box.css('top', winH / 2 - box.height() / 2);
        box.css('left', winW / 2 - box.width() / 2);

    });
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
				$( "#discount-messages" ).append(html);
				$( "#discount-messages" ).dialog({
					draggable: false,
					modal: false,
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
						duration: 400
					},
					hide: {
						effect: "fade",
						duration: 100
					}
				});
	
				// Reload table data following the update the user just made.
					table.ajax.reload();
					
					//After the discount data table is reloaded this code acivates the 
					//accordion and automatically opens the user discounts tab.					
					var active = $( "#application" ).accordion( "option", "active" );
						// setter - set the 5th accordion tab to open
						$( "#application" ).accordion( "option", "active", 3 );
					/*if(isset($_SESSION['M_added']) && ($_SESSION['M_added'] !== '')) {						   
					if(true) {
						// setter - set the 5th accordion tab to open
						$( "#application" ).accordion( "option", "active", 4 );
					} else {
						$( "#application" ).accordion( "option", "active", 3 );*/
			});
	}); // Closing tags for the add-new-discount-module.	
	$("#change-pw-dialog").dialog({
		autoOpen: false,
		modal: false,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			},
		 show: {
			effect: "blind",
			duration: 100
		  },
		  hide: {
			effect: "explode",
			duration: 1000
		  },
		},
	});
	$("#change-password").click(function() {
		var active = $( "#application" ).accordion( "option", "active" );
			$( "#application" ).accordion( "option", "active", 1 );
		$("#change-pw-dialog").dialog("open");
	});
});//Ends $(document).ready

// jeditable plugin for jQuery. Enables one click updates for the accound details module.
$(function () {
    $(".editable_select").editable("../php/class-update-user-account.php", {
        indicator: '<img src="../images/loading.gif">',
        data: "{'Lorem ipsum':'Lorem ipsum','Ipsum dolor':'Ipsum dolor','Dolor sit':'Dolor sit'}",
        type: "select",
        submit: "OK",
        style: "inherit",
        submitdata: function () {
            return {
                id: 2
            };
        }
    });
    $(".editable_select_json").editable("../php/class-update-user-account.php", {
        indicator: '<img src="../images/ajax-loader.gif">',
        loadurl: "json.php",
        type: "select",
        submit: "OK",
        style: "inherit"
    });
    $(".editable_textarea").editable("../php/class-update-user-account.php", {
        indicator: "<img src='../images/ajax-loader.gif'>",
        type: 'text',
        // id : 'elementid',
        // name : 'newvalue',
        submitdata: {
            _method: "post"
        },
        select: false,
        submit: 'OK',
        cancel: 'cancel',
        cssclass: "field"
    });
    $(".click").editable("../php/class-update-user-account.php", {
        indicator: "<img src='../images/ajax-loader.gif'>",
        tooltip: "Delete this discount.",
        style: "inherit"
    });
    $(".dblclick").editable("../php/class-delete-user-discount.php", {
        indicator: "<img src='../images/ajax-loader.gif'>",
        tooltip: "Doubleclick to edit...",
        event: "dblclick",
        style: "inherit",
        type: "button"
    });
});
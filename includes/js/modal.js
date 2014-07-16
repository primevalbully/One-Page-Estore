$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('input[name=submit]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		//The var id = '#dialog' or <a href="#dialog">
		//associates the <a> tag with the <div id="dialog"> tag 
		//making it possible to identify what pops up when the event
		//is triggered.
		var id = $(this).attr('id');
	
		//Get the screen height and width
		var maskHeight = $("#add-user-discount").height();
		var maskWidth = $("#container").width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(1000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
		var maskHeight = $("#add-user-discount").height();
		var maskWidth = $("#container").width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});
	  $(function() {
		  $( "#application" ).accordion({
			  heightStyle: "content", 
			  collapsible: true, 
			  active: 1 });
	  });
	  $(function() {
		  $( "#tabs" ).tabs(
			  {
				  show: {
					  effect: "fold", duration: 400
				  }
			  });
		  }); 
	  $(function() {
	  var oTable = $('#example').dataTable({
		  "aoColumns": [
			  { "sClass": "id"},//discounts_customer database id of user discount
			{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Customer ID					  
			{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Name of the discount
			null,//discount code
			{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Type of discount
			null,//amount of discount
			{ "sClass": "editable_textarea", "aTargets": [ 0 ] },
			{ "bVisible": false, "aTargets": [ 0 ] },//Hides the Column for the Date the discount was obtained
			null,//Expiration date of the discount
			null,//availability for more than one use
			null,//availability to be combined with other discounts								
			{ "bVisible": false, "aTargets": [ 0 ] }//Hides the Column for the Life of the Discount
		  ],
		  "bRetrieve": true,
		  "bProcessing": true,
		  "bJQueryUI": true,
		  "bLengthChange": false, //disables user ability to change the number of discounts displayed
		  "bFilter": false,// displays Search box, setting false removes filter ability all together
		  "sAjaxSource": "../php/class-user-discounts.php"
		  });		  /* Apply the jEditable handlers to the table 
		  $('td', oTable.fnGetNodes()).editable( '../DataTables-1.9.4/examples/examples_support/editable_ajax.php', {
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
			  "height": "14px"
		  });*/
	  });
	  $(function() {
		// set global ajax options:
		$.ajaxSetup({
			beforeSend: function(xhr, status) {
				// TODO: show spinner
				$('.spinner').show();
			},
			complete: function() {
				// TODO: hide spinner
				$('.spinner').hide();
			}
		});
		$('#fuck').click(function() {
			// because we have overriden the global AJAX settings
			// the spinner will be shown during the request
			$('fieldset').load();
		});
	  });
	  
	  $( "#fuck" ).click(function() {
		  $( "#discount-messages" ).dialog( "open" );
	  });
	 
	  $(function() {
		$(".editable_select").editable("includes/php/class-update-user-account.php", {
			indicator : '<img src="includes/images/loading.gif">',
			data   : "{'Lorem ipsum':'Lorem ipsum','Ipsum dolor':'Ipsum dolor','Dolor sit':'Dolor sit'}",
			type   : "select",
			submit : "OK",
			style  : "inherit",
			submitdata : function() {
				return {id : 2};
			}
		});
		$(".editable_select_json").editable("includes/php/class-update-user-account.php", {
			indicator : '<img src="includes/images/loading.gif">',
			loadurl : "http://www.appelsiini.net/projects/jeditable/php/json.php",
			type   : "select",
			submit : "OK",
			style  : "inherit"
		});
		$(".editable_textarea").editable("includes/php/class-update-user-account.php", {
			indicator : "<img src='includes/images/loading.gif'>",
			type   : 'text',
			//id : 'elementid',
			//name : 'newvalue',
			submitdata: { _method: "post" },
			select : false,
			submit : 'OK',
			cancel : 'cancel',
			cssclass : "field"
		});
		$(".editable_textile").editable("includes/php/class-update-user-account.php?renderer=textile", {
			indicator : "<img src='includes/images/loading.gif'>",
			loadurl   : "http://www.appelsiini.net/projects/jeditable/php/load.php",
			type      : "textarea",
			submit    : "OK",
			cancel    : "Cancel",
			tooltip   : "Click to edit..."
		});

		$(".click").editable("http://www.appelsiini.net/projects/jeditable/php/echo.php", {
			indicator : "<img src='includes/images/loading.gif'>",
			tooltip   : "Click to edit...",
			style  : "inherit"
		});
		$(".dblclick").editable("http://www.appelsiini.net/projects/jeditable/php/echo.php", {
			indicator : "<img src='includes/images/loading.gif'>",
			tooltip   : "Doubleclick to edit...",
			event     : "dblclick",
			style  : "inherit"
		});
		$(".mouseover").editable("http://www.appelsiini.net/projects/jeditable/php/echo.php", {
			indicator : "<img src='includes/images/loading.gif'>",
			tooltip   : "Move mouseover to edit...",
			event     : "mouseover",
			style  : "inherit"
		});
		/* Should not cause error. */
		$("#nosuch").editable("http://www.appelsiini.net/projects/jeditable/php/echo.php", {
			indicator : "<img src='includes/images/loading.gif'>",
			type   : 'textarea',
			submit : 'OK'
		});
	  });
	 /* $(function() {
		  var oTable = $('#example').dataTable().makeEditable(
			  {
			  "aoColumns": [
					null,
					null,
					null,
				{  indicator: 'Saving platforms...',
				   tooltip: 'Click to edit platforms',
				   type: 'textarea',
				   submit:'Save changes',
				   fnOnCellUpdated: function(sStatus, sValue, settings){
					  alert("(Cell Callback): Cell is updated with value " + sValue);
				   }
				},//status of the discount(i.e. applied or not applied)
				null,//Expiration date of the discount
				null,//availability for more than one use
				null,//availability to be combined with other discounts								
			  ]
			});
		});*/	  
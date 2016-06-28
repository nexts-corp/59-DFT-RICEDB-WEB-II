/*
 * general_ui.js
 *
 * Demo JavaScript used on General UI-page.
 */


$(document).ready(function(){

	//===== Date Pickers & Time Pickers & Color Pickers =====//
	$( ".datepicker" ).datepicker({
		defaultDate: +7,
		showOtherMonths:true,
		autoSize: true,
		appendText: '<span class="help-block">(yyyy-mm-dd)</span>',
		dateFormat: 'yy-mm-dd'
		});

	});
	
	

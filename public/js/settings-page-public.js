(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$(function() {
	var starting_week = $( "#pick_date" ).attr('data-start-week');
	var date_format = $( "#pick_date" ).attr('data-date-format');
	var picking_date = JSON.parse($( "#pick_date" ).attr(
		'data-arr'));
	var picking_date_array = picking_date.map( Number );

	    $( ".datepicker" ).datepicker({
        dateFormat : date_format,
        minDate: 0,
        firstDay: starting_week,
        beforeShowDay: function(date) {
            var startDate = new Date();
            startDate.setHours(0,0,0,0);
            var endDate = new Date().setDate(new Date().getDate() + 5);
            if(date < startDate){
                return [true, 'ui-datepicker-unselectable', 'Pickup/Delivery not allowed'];
            }else{

                // ------------shayan ----------------
               if($.inArray(date.getDay(), picking_date_array) == -1){
                 return [true, 'ui-datepicker-unselectable ui-state-disabled', 'Pickup/Delivery not allowed'];
               
                }else{
                    return [true, '', ''];
                }
                // ------------shayan----------------

            }

        }
    });
});

// $(function() {
//     var weekday=new Array(7);
//         weekday[1]="Monday";
//         weekday[2]="Tuesday";
//         weekday[3]="Wednesday";
//         weekday[4]="Thursday";
//         weekday[5]="Friday";
//         weekday[6]="Saturday";
//         weekday[7]="Sunday";
//     $('#pick_date').datepicker().on("change", function () {  
//         var date = $(this).datepicker('getDate');
//         var dayOfWeek = weekday[date.getUTCDay()];
//         $.post("/wp-admin/admin-ajax.php", {action: "woodelivery_checkout_timepic", dayOfWeek: dayOfWeek}, function(response){
// 	        // var variable_responce = JSON.parse(response);
// 	        $("#stallion_id option").remove();     
// 	     	//alert(response);  
// 	     	$(".woodelivery_delivery_time").html(response); 
//  		 });
//     });
// });

$(function() {
	// var weekday=new Array(7);
	// 	weekday[0]="Sunday";
 //        weekday[1]="Monday";
 //        weekday[2]="Tuesday";
 //        weekday[3]="Wednesday";
 //        weekday[4]="Thursday";
 //        weekday[5]="Friday";
 //        weekday[6]="Saturday";

 	var weekday = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        
	$('#pick_date').datepicker().on("change", function () {  
        // var date = $(this).datepicker('getDate');
        // var dayOfWeek = weekday[date.getUTCDay()];

        var order_type = $(this).attr('order_type');
        var pick_date = $(this).val();
        var site_url = $('#site_url').val();
        
        	jQuery.ajax({
	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_WooDelivery_time_slots',
	                        'order_type':order_type,'pick_date':pick_date
	                
	            },
	            success: function(time_response){
	            	$("#wooDelivery_time").empty(); 
	     			$("#wooDelivery_time").append(time_response); 
	            }
	        });
    });

    $('.radio_clk').on('click',function(){
		
    	var delivery_type = $(this).val();
    	var site_url = $('#site_url').val();

    	if(delivery_type == '1'){
    		var delivery_type_n = 'pick_up';

    	}else if(delivery_type == '2'){
    		var delivery_type_n = 'delivery';
    	}

    	if(delivery_type_n !='' && site_url !=''){

    		//var site_url = 'https://websitedevelopmentpreview.com/deliveryplugin';

    		jQuery.ajax({
	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_WooDelivery_change_delivery_type',
	                        'delivery_type':delivery_type_n
	                
	            },
	            success: function(type_response){
	            	
	                if(type_response == '1'){
	        			location.reload();
	        		}
	            }
	        });

    		
    	}
    	

    });

    $('#wooDelivery_time').on('change', function(){

            //var extra_fee = jQuery(this).attr('extra_fee');

            //if(extra_fee == true){
                jQuery('body').trigger('update_checkout');
            //}
            
        });

        $('#woo_delivery_add_tips').on('change', function(){

            //var extra_fee = jQuery(this).attr('extra_fee');

            //if(extra_fee == true){
                jQuery('body').trigger('update_checkout');
            //}
            
        });
});
 	

})( jQuery );

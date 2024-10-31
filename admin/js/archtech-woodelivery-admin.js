jQuery(document).ready(function ($){
	var site_url = $('#site_url').val();

	$('.tabs').on('click',function(){
		var tab_val = $(this).attr('data-tab');
		$(this).addClass('archt-woo-delivery-active').siblings().removeClass('archt-woo-delivery-active');
		$('#'+tab_val).show();

		$('#'+tab_val).siblings().hide();
	});


	function setCookie(cookieName, cookieValue, expirationDays) {
        var d = new Date();
        d.setTime(d.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
	}

	function getCookie(cookieName) {
	    var name = cookieName + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var cookieArray = decodedCookie.split(';');
	    for (var i = 0; i < cookieArray.length; i++) {
	        var cookie = cookieArray[i];
	        while (cookie.charAt(0) == ' ') {
	            cookie = cookie.substring(1);
	        }
	        if (cookie.indexOf(name) == 0) {
	                return cookie.substring(name.length, cookie.length);
	            }
	    }
	    return "";
	}
	function activateTab(tabID) {
	        jQuery('.tabs[data-tab="' + tabID + '"]').addClass('archt-woo-delivery-active').siblings().removeClass('archt-woo-delivery-active');
	        jQuery('#' + tabID).show().siblings().hide();
	    }
	    var activeTab = getCookie('activeTab');
	    if (activeTab !== "") {
	        activateTab(activeTab);
	    }
	jQuery('.tabs').on('click', function () {
	        var tab_val = jQuery(this).attr('data-tab');
	        setCookie('activeTab', tab_val, 30);
	        activateTab(tab_val);
	});


	/******* Time zone setting form jq start ********/

	$('#arch_woo_delivery_timezone_setting_form').on('submit',function (e){
		e.preventDefault();
        var arch_delivery_time_timezone = $('#arch_delivery_time_timezone').val();

        if(arch_delivery_time_timezone !=''){

        	jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_time_zone_settings',
	                         'arch_delivery_time_timezone':arch_delivery_time_timezone
	                
	            },
	            success: function(time_zone_response){
	            	//console.log(time_zone_response);
	            	 if(time_zone_response == '1'){
	            	 	$('.arch_woo_delivery_timezone_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_delivery_timezone_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_timezone_setting_notice').css('right', '-400px'); 
					    }, 3000);

	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	                    // setTimeout(function () {
	                    $('.arch_woo_delivery_timezone_setting_notice').html("<span class='dashicons dashicons-yes'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_delivery_timezone_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_timezone_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 }
	                
	            }
	        });
        }

	});

	/******* Time zone setting form jq end ********/

	/******* Order Settings form jq start ********/

	$('#arch_woo_delivery_order_setting_form_submit').on('submit',function (e){
		e.preventDefault();
        var order_type = $('input[name=order_type]:checked').val();
        var default_order_type = $('input[name=default_order_type]:checked').val();
        var arch_woo_order_type_field_label = $.trim($('#arch_woo_order_type_field_label').val());
        var arch_woo_delivery_option_label = $.trim($('#arch_woo_delivery_option_label').val());
        var arch_woo_pickup_option_label = $.trim($('#arch_woo_pickup_option_label').val());

	        if(order_type !=''){
	        	var order_type = $('input[name=order_type]:checked').val();
	        }else{
	        	var order_type = 'both';
	        }
	        if(default_order_type !=''){
	        	var default_order_type = $('input[name=default_order_type]:checked').val();
	        }else{
	        	var default_order_type = 'delivery';
	        }
	        if(arch_woo_order_type_field_label !=''){
	        	var arch_woo_order_type_field_label = $.trim($('#arch_woo_order_type_field_label').val());
	        }else{
	        	var arch_woo_order_type_field_label = 'Order Type';
	        }
	        if(arch_woo_delivery_option_label !=''){
	        	var arch_woo_delivery_option_label = $.trim($('#arch_woo_delivery_option_label').val());
	        }else{
	        	var arch_woo_delivery_option_label = 'Delivery';
	        }
	        if(arch_woo_pickup_option_label !=''){
	        	var arch_woo_pickup_option_label = $.trim($('#arch_woo_pickup_option_label').val());
	        }else{
	        	var arch_woo_pickup_option_label = 'Pickup';
	        }


        	jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_order_settings_form',
	                         'order_type':order_type,'default_order_type':default_order_type,'arch_woo_order_type_field_label':arch_woo_order_type_field_label,'arch_woo_delivery_option_label':arch_woo_delivery_option_label,'arch_woo_pickup_option_label':arch_woo_pickup_option_label
	                
	            },
	            success: function(order_settings_response){
	            	 if(order_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_delivery_order_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_order_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_delivery_order_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_order_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });

	        return false;

	});


	/******* Order Settings form jq end ********/

	/******* Delivery Date Settings form jq start ********/
	$('#arch_delivery_date_settings_form_submit').on('submit',function (e){
		e.preventDefault();

		if($("#arch_enable_delivery_date").prop('checked') == true){
			var arch_enable_delivery_date = '1';
		}else{
			var arch_enable_delivery_date = '0';
		}

		if($("#arch_delivery_date_mandatory").prop('checked') == true){
			var arch_delivery_date_mandatory = '1';
		}else{
			var arch_delivery_date_mandatory = '0';
		}

		if($("#arch_delivery_date_field_label").val() != ''){
			var arch_delivery_date_field_label = $.trim($("#arch_delivery_date_field_label").val());
		}else{
			var arch_delivery_date_field_label = 'Delivery Date';
		}

		if($("#arch_delivery_date_week_starts_from").val() != ''){
			var arch_delivery_date_week_starts_from = $.trim($("#arch_delivery_date_week_starts_from").val());
		}else{
			var arch_delivery_date_week_starts_from = '0';
		}

		if($("#arch_delivery_date_format").val() != ''){
			var arch_delivery_date_format = $("#arch_delivery_date_format").val();
		}else{
			var arch_delivery_date_format = 'dd-mm-yy';
		}

		var arch_delivery_date_delivery_days_arr = [];

		$('input[name="arch_delivery_date_delivery_days[]"]:checked').each(function(i){
          arch_delivery_date_delivery_days_arr[i] = $(this).val();
        });

        jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_date_settings_form',
	                         'arch_enable_delivery_date':arch_enable_delivery_date,'arch_delivery_date_mandatory':arch_delivery_date_mandatory,'arch_delivery_date_field_label':arch_delivery_date_field_label,'arch_delivery_date_week_starts_from':arch_delivery_date_week_starts_from,'arch_delivery_date_format':arch_delivery_date_format,'arch_delivery_date_delivery_days_arr':JSON.stringify(arch_delivery_date_delivery_days_arr)
	                
	            },
	            success: function(delivery_date_settings_response){
	            	
	            	if(delivery_date_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_date_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_delivery_date_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_date_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_date_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_delivery_date_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_date_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });

        return false;

	});

	/******* Delivery Date Settings form jq end ********/

	/******* Pickup Date Settings form jq start ********/

	$('#arch_delivery_pickup_date_form_submit').on('submit',function (e){
		e.preventDefault();

		if($("#arch_enable_pickup_date").prop('checked') == true){
			var arch_enable_pickup_date = '1';
		}else{
			var arch_enable_pickup_date = '0';
		}

		if($("#arch_pickup_date_mandatory").prop('checked') == true){
			var arch_pickup_date_mandatory = '1';
		}else{
			var arch_pickup_date_mandatory = '0';
		}

		if($("#arch_pickup_date_field_label").val() != ''){
			var arch_pickup_date_field_label = $.trim($("#arch_pickup_date_field_label").val());
		}else{
			var arch_pickup_date_field_label = 'Pickup Date';
		}

		if($("#arch_pickup_date_week_starts_from").val() != ''){
			var arch_pickup_date_week_starts_from = $.trim($("#arch_pickup_date_week_starts_from").val());
		}else{
			var arch_pickup_date_week_starts_from = '0';
		}

		if($("#arch_pickup_date_format").val() != ''){
			var arch_pickup_date_format = $("#arch_pickup_date_format").val();
		}else{
			var arch_pickup_date_format = 'dd-mm-yy';
		}

		var arch_pickup_date_delivery_days_arr = [];

		$('input[name="arch_pickup_date_delivery_days[]"]:checked').each(function(i){
          arch_pickup_date_delivery_days_arr[i] = $(this).val();
        });

        jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_pickup_date_settings_form',
	                         'arch_enable_pickup_date':arch_enable_pickup_date,'arch_pickup_date_mandatory':arch_pickup_date_mandatory,'arch_pickup_date_field_label':arch_pickup_date_field_label,'arch_pickup_date_week_starts_from':arch_pickup_date_week_starts_from,'arch_pickup_date_format':arch_pickup_date_format,'arch_pickup_date_delivery_days_arr':JSON.stringify(arch_pickup_date_delivery_days_arr)
	                
	            },
	            success: function(pickup_date_settings_response){
	            	
	            	if(pickup_date_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_pickup_date_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_delivery_pickup_date_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_pickup_date_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_pickup_date_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_delivery_pickup_date_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_pickup_date_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });

        return false;

	});

	/******* Pickup Date Settings form jq end ********/

	/******* Delivery Time Settings form jq start ********/
	$('#arch_delivery_time_form_submit').on('submit',function (e){
		e.preventDefault();

		if($("#arch_enable_delivery_time").prop('checked') == true){
			var arch_enable_delivery_time = '1';
		}else{
			var arch_enable_delivery_time = '0';
		}

		if($("#arch_delivery_time_mandatory").prop('checked') == true){
			var arch_delivery_time_mandatory = '1';
		}else{
			var arch_delivery_time_mandatory = '0';
		}

		if($("#arch_delivery_time_field_label").val() != ''){
			var arch_delivery_time_field_label = $.trim($("#arch_delivery_time_field_label").val());
		}else{
			var arch_delivery_time_field_label = 'Delivery Time';
		}

		if($("#arch_delivery_time_slot_starts_hour").val() != ''){
			var startTimeHour = parseInt($.trim($('#arch_delivery_time_slot_starts_hour').val()));
		}else{
			var startTimeHour = 12;
		}

		if($("#arch_delivery_time_slot_starts_min").val() != ''){
			var startTimeMin = parseInt($.trim($('#arch_delivery_time_slot_starts_min').val()));
		}else{
			var startTimeMin = 0;
		}

		if($("#arch_delivery_time_slot_starts_format").val() != ''){
			var startTimeFormat = $('#arch_delivery_time_slot_starts_format').val();
		}else{
			var startTimeFormat = 'AM';
		}

		if($("#arch_delivery_time_slot_ends_hour").val() != ''){
			var endTimeHour = parseInt($.trim($('#arch_delivery_time_slot_ends_hour').val()));
		}else{
			var endTimeHour = 11;
		}

		if($("#arch_delivery_time_slot_ends_min").val() != ''){
			var endTimeMin = parseInt($.trim($('#arch_delivery_time_slot_ends_min').val()));
		}else{
			var endTimeMin = 59;
		}

		if($("#arch_delivery_time_slot_ends_format").val() != ''){
			var endTimeFormat = $('#arch_delivery_time_slot_ends_format').val();
		}else{
			var endTimeFormat = 'PM';
		}

		if($("#arch_delivery_time_slot_duration_format").val() != ''){
			var duration = parseInt($('#arch_delivery_time_slot_duration_format').val());
		}else{
			var duration = 30;
		}

		if($("#arch_delivery_time_format").val() != ''){
			var format = parseInt($('#arch_delivery_time_format').val());
		}else{
			var format = 12;
		}

		/** code for time slote calculation  **/
		var timeSlots = [];
	    var startTimeInMinutes = convertToMinutes(startTimeHour, startTimeMin, startTimeFormat);
	    var endTimeInMinutes = convertToMinutes(endTimeHour, endTimeMin, endTimeFormat, startTimeFormat );
	    var timevar=[];
	    if(endTimeInMinutes<startTimeInMinutes){

	      	$('.arch_woo_delivery_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> Enter Valid Start and End Time Range");
	      	$('.arch_woo_delivery_time_setting_notice').css('right', '0');
	        setTimeout(function() {
				$('.arch_woo_delivery_time_setting_notice').css('right', '-400px'); 
			}, 3000);
	      return false;
	    }

	    if(format==12){
	      var startTime = convertTo24HourFormat(startTimeHour, startTimeMin, startTimeFormat);
	    var endTime = convertTo24HourFormat(endTimeHour, endTimeMin, endTimeFormat);
	      
	    var timevarrev=[];
	    if (endTime < startTime && (endTimeFormat === 'am' && startTimeFormat === 'pm')) {
	        endTimeFormat='pm';
	        startTimeFormat='am';

	        var startTimerev=convertTo24HourFormat(startTimeHour, startTimeMin, startTimeFormat);

	        var endTimerev=convertTo24HourFormat(endTimeHour, endTimeMin, endTimeFormat);

	        var currentTimerev = startTimerev; 
	        while (currentTimerev < endTimerev) {

		        var slotStartTimerev = convertTo12HourFormatrev(currentTimerev, startTimeFormat);
		        
		        var slotEndTimerev = convertTo12HourFormatrev(Math.min(currentTimerev + duration, endTimerev), startTimeFormat);

		        timevarrev.push(slotStartTimerev + ' - ' + slotEndTimerev);

		        currentTimerev += duration;
		    }
	        
	   
		    return false;

		}

	    var newtime=[];

	    var currentTime = startTime;
	    if(currentTime == endTime){
	      	$('.arch_woo_delivery_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> The start and end time ranges should not be identical.");
	      	$('.arch_woo_delivery_time_setting_notice').css('right', '0');
	        setTimeout(function() {
				$('.arch_woo_delivery_time_setting_notice').css('right', '-400px'); 
			}, 3000);

	      return false;
	    }
	    while (currentTime < endTime) {
	        var slotStartTime = convertTo12HourFormat(currentTime, startTimeFormat);
	        var slotEndTime = convertTo12HourFormat(Math.min(currentTime + duration, endTime), startTimeFormat);

	        timevar.push(slotStartTime + ' - ' + slotEndTime);

	        currentTime += duration;
	    }
	    
	    var dropdown = document.querySelector('.dropdown_selected_slot_next');
	    var currentTime = new Date();
	    var currentHour = currentTime.getHours();
	    var currentMinute = currentTime.getMinutes();

	    timevar.forEach(function(slot) {
	    var [slotStartTime, slotEndTime] = slot.split(' - ');

	    var [startHour, startMinute] = slotStartTime.split(':').map(Number);
	    var [endHour, endMinute] = slotEndTime.split(':').map(Number);

	    var option = document.createElement('option');
	    option.text = slot;

	    if (startHour < currentHour || (startHour === currentHour && startMinute <= currentMinute)) {
	        option.disabled = true;
	    }

	    //dropdown.appendChild(option);
	     });

	    }else{

		    if (endTimeInMinutes < startTimeInMinutes) {
		        
		        endTimeInMinutes += 24 * 60; 
		    }

		    var currentTimeInMinutes = startTimeInMinutes;
		    while (currentTimeInMinutes < endTimeInMinutes) {
		        var slotStartTime = convertToTime(currentTimeInMinutes, format, startTimeFormat, endTimeFormat);
		        var slotEndTime = convertToTime(currentTimeInMinutes + duration, format, startTimeFormat, endTimeFormat);
		        
		        if (currentTimeInMinutes + duration > endTimeInMinutes) {
		            slotEndTime = convertToTime(endTimeInMinutes, format, startTimeFormat, endTimeFormat);
		        }
		        
		        timevar.push(slotStartTime + ' - ' + slotEndTime);

		        currentTimeInMinutes += duration;
		    }

		    // console.log('24hrs- '+timevar);
		    var dropdown = document.querySelector('.dropdown_selected_slot_next');
		    var currentTime = new Date();
		    var currentHour = currentTime.getHours();
		    var currentMinute = currentTime.getMinutes();
		    timevar.forEach(function(slot) {
		    var [slotStartTime, slotEndTime] = slot.split(' - ');

		    var [startHour, startMinute] = slotStartTime.split(':').map(Number);
		    var [endHour, endMinute] = slotEndTime.split(':').map(Number);

		    var option = document.createElement('option');
		    option.text = slot;

		    if (startHour < currentHour || (startHour === currentHour && startMinute <= currentMinute)) {
		        option.disabled = true;
		    }

		    //dropdown.appendChild(option);
		    });

	 	}

	 	//console.log(timevar);// time slots print

		jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_time_settings_form',
	                        'arch_enable_delivery_time':arch_enable_delivery_time,'arch_delivery_time_mandatory':arch_delivery_time_mandatory,'arch_delivery_time_field_label':arch_delivery_time_field_label,'arch_delivery_time_slot_starts_hour':startTimeHour,'arch_delivery_time_slot_starts_min':startTimeMin,'arch_delivery_time_slot_starts_format':startTimeFormat,'arch_delivery_time_slot_ends_hour':endTimeHour,'arch_delivery_time_slot_ends_min':endTimeMin,'arch_delivery_time_slot_ends_format':endTimeFormat,'arch_delivery_time_slot_duration_format':duration,'arch_delivery_time_format':format,'timevar':JSON.stringify(timevar)
	                
	            },
	            success: function(delivery_time_settings_response){

	            	//console.log(delivery_time_settings_response);
	            	
	            	if(delivery_time_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_delivery_time_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_time_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_delivery_time_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_delivery_time_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_delivery_time_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });
		return false;
	    

	});
/******* Delivery Time Settings form jq end ********/

/******* Pickup Time Settings form jq start ********/
	$('#arch_pickup_time_form_submit').on('submit',function (e){
		e.preventDefault();

		if($("#arch_enable_pickup_time").prop('checked') == true){
			var arch_enable_pickup_time = '1';
		}else{
			var arch_enable_pickup_time = '0';
		}

		if($("#arch_pickup_time_mandatory").prop('checked') == true){
			var arch_pickup_time_mandatory = '1';
		}else{
			var arch_pickup_time_mandatory = '0';
		}

		if($("#arch_pickup_time_field_label").val() != ''){
			var arch_pickup_time_field_label = $.trim($("#arch_pickup_time_field_label").val());
		}else{
			var arch_pickup_time_field_label = 'Delivery Time';
		}

		if($("#arch_pickup_time_slot_starts_hour").val() != ''){
			var startTimeHour = parseInt($.trim($('#arch_pickup_time_slot_starts_hour').val()));
		}else{
			var startTimeHour = 12;
		}

		if($("#arch_pickup_time_slot_starts_min").val() != ''){
			var startTimeMin = parseInt($.trim($('#arch_pickup_time_slot_starts_min').val()));
		}else{
			var startTimeMin = 0;
		}

		if($("#arch_pickup_time_slot_starts_format").val() != ''){
			var startTimeFormat = $('#arch_pickup_time_slot_starts_format').val();
		}else{
			var startTimeFormat = 'AM';
		}

		if($("#arch_pickup_time_slot_ends_hour").val() != ''){
			var endTimeHour = parseInt($.trim($('#arch_pickup_time_slot_ends_hour').val()));
		}else{
			var endTimeHour = 11;
		}

		if($("#arch_pickup_time_slot_ends_min").val() != ''){
			var endTimeMin = parseInt($.trim($('#arch_pickup_time_slot_ends_min').val()));
		}else{
			var endTimeMin = 59;
		}

		if($("#arch_pickup_time_slot_ends_format").val() != ''){
			var endTimeFormat = $('#arch_pickup_time_slot_ends_format').val();
		}else{
			var endTimeFormat = 'PM';
		}

		if($("#arch_pickup_time_slot_duration_format").val() != ''){
			var duration = parseInt($('#arch_pickup_time_slot_duration_format').val());
		}else{
			var duration = 30;
		}

		if($("#arch_pickup_time_format").val() != ''){
			var format = parseInt($('#arch_pickup_time_format').val());
		}else{
			var format = 12;
		}

		/** code for time slote calculation  **/
		var timeSlots = [];
	    var startTimeInMinutes = convertToMinutes(startTimeHour, startTimeMin, startTimeFormat);
	    var endTimeInMinutes = convertToMinutes(endTimeHour, endTimeMin, endTimeFormat, startTimeFormat );
	    var timevar=[];
	    if(endTimeInMinutes<startTimeInMinutes){

	      	$('.arch_woo_pickup_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> Enter Valid Start and End Time Range");
	      	$('.arch_woo_pickup_time_setting_notice').css('right', '0');
	        setTimeout(function() {
				$('.arch_woo_pickup_time_setting_notice').css('right', '-400px'); 
			}, 3000);
	      return false;
	    }

	    if(format==12){
	      var startTime = convertTo24HourFormat(startTimeHour, startTimeMin, startTimeFormat);
	    var endTime = convertTo24HourFormat(endTimeHour, endTimeMin, endTimeFormat);
	      
	    var timevarrev=[];
	    if (endTime < startTime && (endTimeFormat === 'am' && startTimeFormat === 'pm')) {
	        endTimeFormat='pm';
	        startTimeFormat='am';

	        var startTimerev=convertTo24HourFormat(startTimeHour, startTimeMin, startTimeFormat);

	        var endTimerev=convertTo24HourFormat(endTimeHour, endTimeMin, endTimeFormat);

	        var currentTimerev = startTimerev; 
	        while (currentTimerev < endTimerev) {

		        var slotStartTimerev = convertTo12HourFormatrev(currentTimerev, startTimeFormat);
		        
		        var slotEndTimerev = convertTo12HourFormatrev(Math.min(currentTimerev + duration, endTimerev), startTimeFormat);

		        timevarrev.push(slotStartTimerev + ' - ' + slotEndTimerev);

		        currentTimerev += duration;
		    }
	        
	   
		    return false;

		}

	    var newtime=[];

	    var currentTime = startTime;
	    if(currentTime == endTime){
	      	$('.arch_woo_pickup_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> The start and end time ranges should not be identical.");
	      	$('.arch_woo_pickup_time_setting_notice').css('right', '0');
	        setTimeout(function() {
				$('.arch_woo_pickup_time_setting_notice').css('right', '-400px'); 
			}, 3000);

	      return false;
	    }
	    while (currentTime < endTime) {
	        var slotStartTime = convertTo12HourFormat(currentTime, startTimeFormat);
	        var slotEndTime = convertTo12HourFormat(Math.min(currentTime + duration, endTime), startTimeFormat);

	        timevar.push(slotStartTime + ' - ' + slotEndTime);

	        currentTime += duration;
	    }
	    
	    var dropdown = document.querySelector('.dropdown_selected_slot_next');
	    var currentTime = new Date();
	    var currentHour = currentTime.getHours();
	    var currentMinute = currentTime.getMinutes();

	    timevar.forEach(function(slot) {
	    var [slotStartTime, slotEndTime] = slot.split(' - ');

	    var [startHour, startMinute] = slotStartTime.split(':').map(Number);
	    var [endHour, endMinute] = slotEndTime.split(':').map(Number);

	    var option = document.createElement('option');
	    option.text = slot;

	    if (startHour < currentHour || (startHour === currentHour && startMinute <= currentMinute)) {
	        option.disabled = true;
	    }

	    //dropdown.appendChild(option);
	     });

	    }else{

		    if (endTimeInMinutes < startTimeInMinutes) {
		        
		        endTimeInMinutes += 24 * 60; 
		    }

		    var currentTimeInMinutes = startTimeInMinutes;
		    while (currentTimeInMinutes < endTimeInMinutes) {
		        var slotStartTime = convertToTime(currentTimeInMinutes, format, startTimeFormat, endTimeFormat);
		        var slotEndTime = convertToTime(currentTimeInMinutes + duration, format, startTimeFormat, endTimeFormat);
		        
		        if (currentTimeInMinutes + duration > endTimeInMinutes) {
		            slotEndTime = convertToTime(endTimeInMinutes, format, startTimeFormat, endTimeFormat);
		        }
		        
		        timevar.push(slotStartTime + ' - ' + slotEndTime);

		        currentTimeInMinutes += duration;
		    }

		    //console.log(timeSlots);
		    var dropdown = document.querySelector('.dropdown_selected_slot_next');
		    var currentTime = new Date();
		    var currentHour = currentTime.getHours();
		    var currentMinute = currentTime.getMinutes();
		    timevar.forEach(function(slot) {
		    var [slotStartTime, slotEndTime] = slot.split(' - ');

		    var [startHour, startMinute] = slotStartTime.split(':').map(Number);
		    var [endHour, endMinute] = slotEndTime.split(':').map(Number);

		    var option = document.createElement('option');
		    option.text = slot;

		    if (startHour < currentHour || (startHour === currentHour && startMinute <= currentMinute)) {
		        option.disabled = true;
		    }

		    //dropdown.appendChild(option);
		    });

	 	}

	 	//console.log(timevar);// time slots print

		jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_pickup_time_settings_form',
					'arch_enable_pickup_time':arch_enable_pickup_time,'arch_pickup_time_mandatory':arch_pickup_time_mandatory,'arch_pickup_time_field_label':arch_pickup_time_field_label,'arch_pickup_time_slot_starts_hour':startTimeHour,'arch_pickup_time_slot_starts_min':startTimeMin,'arch_pickup_time_slot_starts_format':startTimeFormat,'arch_pickup_time_slot_ends_hour':endTimeHour,'arch_pickup_time_slot_ends_min':endTimeMin,'arch_pickup_time_slot_ends_format':endTimeFormat,'arch_pickup_time_slot_duration_format':duration,'arch_pickup_time_format':format,'timevar':JSON.stringify(timevar)
	                
	            },
	            success: function(pickup_time_settings_response){

	            	//console.log(delivery_time_settings_response);
	            	
	            	if(pickup_time_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_pickup_time_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_pickup_time_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_time_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_pickup_time_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_pickup_time_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_time_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });
		return false;
	    

	});
/******* Pickup Time Settings form jq end ********/

/******* Delivery/Pickup Time Time Slot jq start ********/
	function tConvert(time) {
	  
	    time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

	    if (time.length > 1) { 
	        time = time.slice(1); 
	        var hour = +time[0];
	        var minute = +time[2];
	        
	        var period = hour < 12 ? 'AM' : 'PM';

	       
	        hour = hour % 12 || 12;

	      
	        hour = ('0' + hour).slice(-2);
	        minute = ('0' + minute).slice(-2);

	       
	        time = hour + ':' + minute + ' ' + period;
	    }
	    return time[0]; 
	}

	   function convertTo24HourFormat(hour, minute, format) {
	    if (format === 'pm' && hour !== 12) {
	        hour += 12;
	    } else if (format === 'am' && hour === 12) {
	        hour = 0;
	    }
	    return hour * 60 + minute;
	}

	function convertTo12HourFormat(minutes) {
	    var hour = Math.floor(minutes / 60);
	    var minute = minutes % 60;
	    var ampm = hour < 12 ? 'AM' : 'PM';
	    hour = hour % 12 || 12;

	    return hour + ':' + (minute < 10 ? '0' : '') + minute + ' ' + ampm;
	}

	function convertTo12HourFormatno(minutes) {
	    var hour = Math.floor(minutes / 60);
	    var minute = minutes % 60;
	    var ampm = hour < 12 ? 'PM' : 'AM';
	    hour = hour % 12 || 12;

	    return hour + ':' + (minute < 10 ? '0' : '') + minute + ' ' + ampm;
	}
	function convertTo12HourFormatrev(minutes) {
	    var hour = Math.floor(minutes / 60);
	    var minute = minutes % 60;
	    var ampm = hour < 12 ? 'PM' : 'AM';
	    hour = hour % 12 || 12;

	    return hour + ':' + (minute < 10 ? '0' : '') + minute + ' ' + ampm;
	}


	function convertToTime(minutes, format, startTimeFormat, endTimeFormat) {
	    var hour = Math.floor(minutes / 60) % (format === 24 ? 24 : 12) || (format === 24 ? 0 : 12);
	    var minute = minutes % 60;

	    if (format === 12) {
	        var ampm = hour < 12 ? 'AM' : 'PM';
	        hour = (hour === 0 || hour === 12) ? 12 : hour % 12;

	        if ((startTimeFormat === 'am' && endTimeFormat === 'pm' && hour >= 12) ||
	            (startTimeFormat === 'pm' && endTimeFormat === 'am' && hour < 12)) {
	            ampm = ampm === 'AM' ? 'PM' : 'AM'; 
	        }

	        return hour + ':' + (minute < 10 ? '0' : '') + minute + ' ' + ampm;
	    } else {
	        return hour + ':' + (minute < 10 ? '0' : '') + minute;
	    }
	}


	function convertToMinutes(hour, minute, format) {
	    if (format === 'pm' && hour !== 12) {
	        hour += 12;
	    } else if (format === 'am' && hour === 12) {
	        hour = 0;
	    }
	    return hour * 60 + minute;
	}
/******* Delivery/Pickup Time Time Slot jq end ********/	
	

	/******* Pickup Location Settings form jq start ********/

	$('#arch_pickup_location_settings_form_submit').on('submit',function (e){
		e.preventDefault();

		if($("#arch_enable_pickup_location").prop('checked') == true){
			var arch_enable_pickup_location = '1';
		}else{
			var arch_enable_pickup_location = '0';
		}

		if($("#arch_pickup_location_mandatory").prop('checked') == true){
			var arch_pickup_location_mandatory = '1';
		}else{
			var arch_pickup_location_mandatory = '0';
		}

		if($("#arch_pickup_location_field_label").val() != ''){
			var arch_pickup_location_field_label = $.trim($("#arch_pickup_location_field_label").val());
		}else{
			var arch_pickup_location_field_label = 'Pickup Date';
		}


        jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_pickup_location_settings_form',
	                         'arch_enable_pickup_location':arch_enable_pickup_location,'arch_pickup_location_mandatory':arch_pickup_location_mandatory,'arch_pickup_location_field_label':arch_pickup_location_field_label
	                
	            },
	            success: function(pickup_location_settings_response){
	            	
	            	if(pickup_location_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_pickup_location_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_pickup_location_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_location_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_pickup_location_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_pickup_location_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_location_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });

        return false;

	});

	/******* Pickup Location Settings form jq end ********/


	/******* Other Settings form jq start ********/

	$('#arch_delivery_other_settings_form_submit').on('submit',function (e){
		e.preventDefault();

		if($.trim($("#arch_woo_delivery_delivery_heading_checkout").val()) != ''){
			var arch_woo_delivery_delivery_heading_checkout = $.trim($("#arch_woo_delivery_delivery_heading_checkout").val());
		}else{
			var arch_woo_delivery_delivery_heading_checkout = '';
		}

		var arch_woo_delivery_field_position = $("#arch_woo_delivery_field_position").val();
		var arch_woo_delivery_code_editor_css = $("#arch_woo_delivery_code_editor_css").val();

		jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_others_settings_form',
	                         'arch_woo_delivery_delivery_heading_checkout':arch_woo_delivery_delivery_heading_checkout,'arch_woo_delivery_field_position':arch_woo_delivery_field_position,'arch_woo_delivery_code_editor_css':arch_woo_delivery_code_editor_css
	                
	            },
	            success: function(others_settings_response){
	            	
	            	if(others_settings_response == '1'){
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_other_setting_notice').html("<span class='dashicons dashicons-yes'></span> Settings Changed Successfully");
	            	 	$('.arch_woo_other_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_other_setting_notice').css('right', '-400px'); 
					    }, 3000);
	                    // setTimeout(function () {
	                    //     $('.arch_woo_delivery_timezone_setting_notice').hide('slide', {
	                    //         direction: 'right'
	                    //     });
	                    // }, 4000);
	            	 }else{
	            	 	//console.log(order_settings_response);
	            	 	$('.arch_woo_other_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_other_setting_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_other_setting_notice').css('right', '-400px'); 
					    }, 3000);
	            	 	//$('.arch_woo_delivery_order_setting_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later").css('background', '#9d2424');
	                    // setTimeout(function () {
	            	 }
	                
	            }
	        });

		return false;

	

	});

	/******* Other Settings form jq end ********/

	$('#arch_woo_setting_form').on('submit',function (){
		$('.com_response').empty();
		var site_url = $('#site_url').val();
		var order_type = $('input[name=order_type]:checked').val();
		var aks_time_chk = $('input[name=aks_time]:checked').val();
		if(aks_time_chk == '1'){
			var aks_time = '1';
		}else{
			var aks_time = '0';
		}
		var time_required_chk = $('input[name=time_required]:checked').val();
		if(time_required_chk == '1'){
			var time_required = '1';
		}else{
			var time_required = '0';
		}
		var time_interval = $('#time_interval').val();
		var pickup_text = $('#pickup_text').val();
		var date_field_text = $('#date_field_text').val();
		var time_field_text = $('#time_field_text').val();
		var charge_field_text = $('#charge_field_text').val();
		var additional_charge_text = $('#additional_charge_text').val();

		var tip_values = $("input[name='tip_amount[]']")
              .map(function(){return $(this).val();}).get();


		if(order_type !='' && aks_time !='' && time_required !='' && time_interval !='' && pickup_text !='' && date_field_text !='' && time_field_text !='' && charge_field_text !='' && additional_charge_text !='' && tip_values !='' ){
			jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_main_settings',
	                         'order_type':order_type,'aks_time':aks_time,'time_required':time_required,'time_interval':time_interval,
	                         'pickup_text':pickup_text,'date_field_text':date_field_text,'time_field_text':time_field_text,
	                         'charge_field_text':charge_field_text,'additional_charge_text':additional_charge_text,'tip_values':tip_values
	                
	            },
	            success: function(response_main_settings){
	            	
	            	$('.com_response').empty();

	            	if(response_main_settings == '1'){
	            		$('.woo_delivery_primary_settings').append('<span class="succ_response1">Settings saved successfully.</span>');
	            	}else{
	            		$('.woo_delivery_primary_settings').append('<span class="fail_response1">Setting not saved due to server error, please try again later.</span>');
	            	}
	                
	            }
	        });
		}
		
		return false;
	});

	$('#arch_woo_setting_form').on('submit',function (){

		$('.com_response').empty();
		var site_url = $('#site_url').val();
		var obj = {
			  "form_values": []
		};
		var count = 1;
		$("input[name='days[]']").each(function(){
			
			if($(this).is(':checked')){
				var day1_val = '1';
			}else{
				var day1_val = '0';
			}
			var start_time1 = $('#start_time'+count).val();
			var end_time1 = $('#end_time'+count).val();

			obj.form_values.push({"day_id":count,"status": day1_val,"start_time": start_time1,"end_time": end_time1 });
			count++;
		});


		jQuery.ajax({

            type: 'post',
            url: site_url+"/wp-admin/admin-ajax.php",
            
            data: {
                action: 'arch_time_intervals_settings',
                         'setting_form':obj
                
            },
             
            success: function(response_settings){

            	$('.com_response').empty();
            	//console.log(response_settings);
                if(response_settings == '1'){
                	$('.slot_settings_form_response').append('<span class="succ_response">Time Settings saved successfully.</span>');
                }else if(response_settings == '0'){
                	$('.slot_settings_form_response').append('<span class="fail_response">Time Setting not saved, please try again later.</span>');
                }else{
                	$('.slot_settings_form_response').append('<span class="fail_response">Time Setting not saved due to server error, please try again later.</span>');
                }
            }
        });
		
	});

	$('.fees_form').on('submit',function (){

		$('.com_response').empty();
		var woo_delivery_extra_fee_id = $(this).find('.woo_delivery_extra_fee_id').val();
		var woo_delivery_extra_fee = $(this).find('.woo_delivery_extra_fee').val();
		var site_url = $(this).find('.site_u_cls').val();

		if(woo_delivery_extra_fee_id !='' && woo_delivery_extra_fee !='' && site_url !=''){

			jQuery.ajax({
	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_time_slots_settings_update',
	                         'woo_delivery_extra_fee_id':woo_delivery_extra_fee_id,'woo_delivery_extra_fee':woo_delivery_extra_fee
	                
	            },
	            success: function(response_slot_settings){
	                $('.com_response').empty();

	                if(response_slot_settings == '1'){
	                	
	                	$('#res_'+woo_delivery_extra_fee_id).append('<span class="succ_response">Extra fees updated successfully.</span>');
	                }else{
	                	$('#res_'+woo_delivery_extra_fee_id).append('<span class="fail_response">Extra fees not saved due to server error, please try again later.</span>');
	                }

	                setTimeout(function() {
					    $('#res_'+woo_delivery_extra_fee_id).empty();
					}, 5000);
	                
	            }
	        });
		}
		return false;
	});

	$('#woo_delivery_add_store').on('submit', function (){

		$('.com_response').empty();
		var store_name = $.trim($(this).find('#store_name').val());
		var store_address = $.trim($(this).find('#store_address').val());
		var store_email = $.trim($(this).find('#store_email').val());
		var store_contact_no = $.trim($(this).find('#store_contact_no').val());
		var site_url = $(this).find('#site_url').val();

		if(store_name !='' && store_address !='' && store_email !='' && store_contact_no !='' && site_url !=''){
			jQuery.ajax({
	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_add_store',
	                        'store_name':store_name,'store_address':store_address,'store_email':store_email,'store_contact_no':store_contact_no
	                
	            },
	            success: function(response_add_store){

	                $('.com_response').empty();
	                if(response_add_store == '1'){
	                	$('#store_name').val('');
						$('#store_address').val('');
						$('#store_email').val('');
						$('#store_contact_no').val('');
	                	//$('.arch_woo_pickup_locations_notice').append('<span class="succ_response">New Store Added successfully.</span>');

	                	$('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-yes'></span> Pickup Location added Successfully");
	            	 	$('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);

	                }else{
	                	$('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);

	                	
	                }
	                return false;
	            }
	        });

		}

		return false;
	});

	$(document).on('submit','#woo_delivery_update_store', function (){

		$('.com_response').empty();
		var store_name = $.trim($(this).find('#store_name').val());
		var store_address = $.trim($(this).find('#store_address').val());
		var store_email = $.trim($(this).find('#store_email').val());
		var store_contact_no = $.trim($(this).find('#store_contact_no').val());
		var site_url = $(this).find('#site_url').val();
		var store_id = $(this).find('#store_id').val();

		if(store_name !='' && store_address !='' && store_email !='' && store_contact_no !='' && site_url !='' && store_id !=''){
			jQuery.ajax({
	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_update_store',
	                        'store_name':store_name,'store_address':store_address,'store_email':store_email,'store_contact_no':store_contact_no,'store_id':store_id
	                
	            },
	            success: function(response_update_store){
	                $('.com_response').empty();
	                if(response_update_store == '1'){
	                	
	                	$('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-yes'></span> Pickup Location Updated Successfully");
	            	 	$('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);

	                }else{
	                	$('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	$('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);
	                }
	                return false;
	            }
	        });

		}

		return false;

	});	

	$('#select_days').on('change',function(){
		var select_days = $(this).val();

		$('#day-'+select_days).show();
		$('#day-'+select_days).prevAll().hide();
		$('#day-'+select_days).nextAll().hide();
	});

	$('.day_check').click(function(){
		if($(this).is(':checked')){
			
			$(this).parent().nextAll('td').removeClass('td_inv');
		}else{
			
			$(this).parent().nextAll('td').addClass('td_inv');
		}
	})

	$('#tip_btn').on('click',function(){

    	$('#tip_sub_d').append('<div class="tip_vv"><span class="tip_inp"><input type="text" name="tip_amount[]" class="tip_amount" placeholder="Tip Amount" onkeypress="return isNumber(event)" ></span><span class="add_remv_btn">Remove</span></div>');
    });

    $(document).on('click','.add_remv_btn',function (){
    	$(this).parent().remove();
    });

    $('.add_pickup_location_btn').on('click',function(){
    	$('.Woo_Delivery_add_store_main_div').slideToggle();
    });

});

function change_store_status(store_id,status){

	if (confirm("Are you sure? Want to change status of this store")) {

		if(store_id !='' && status !=''){
			jQuery('.com_response').empty();
			var site_url = jQuery('#site_url').val();

			jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_store_actions',
	                         'store_id':store_id,'status':status,'action_id':'1'
	                
	            },
	            success: function(response_1){
	            	jQuery('.com_response').empty();
	            	if(response_1 == '1'){
	            		jQuery('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-yes'></span> Pickup Location Activated successfully");
	            	 	jQuery('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      jQuery('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);

	            	}else if(response_1 == '2'){
						jQuery('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-yes'></span> Pickup Location Deactivated successfully");
	            	 	jQuery('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      $('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);

	            	}else{
	            		jQuery('.arch_woo_pickup_locations_notice').html("<span class='dashicons dashicons-no'></span> Something went wrong, try again later");
	            	 	jQuery('.arch_woo_pickup_locations_notice').css('right', '0');
	            	 	setTimeout(function() {
					      jQuery('.arch_woo_pickup_locations_notice').css('right', '-400px'); 
					    }, 3000);
	            		//jQuery('.all_stores_response').append('<span class="succ_response">Store not Activated/Deactivated due to server error, Please try again.</span>');
	            	}
	                return false;
	                
	            }
	        });

	        return false;
		}else{
			return false;
		}
	}else{
        return false;
    }

}

function store_view(store_id){
	jQuery('.store_details_pop').empty();
	if(store_id !=''){
		var site_url = jQuery('#site_url').val();

			jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_store_actions',
	                         'store_id':store_id,'action_id':'2'
	                
	            },
	            success: function(response_2){
	            	jQuery('.store_details_pop').empty();
	            	jQuery('.store_details_pop').append(response_2);
	                
	            }
	        });

		return false;
	}else{
		return false;
	}
}

function store_edit(store_id){
	jQuery('.store_details_pop').empty();
	if(store_id !=''){
		var site_url = jQuery('#site_url').val();

			jQuery.ajax({

	            type: 'post',
	            url: site_url+"/wp-admin/admin-ajax.php",
	            
	            data: {
	                action: 'arch_woo_delivery_store_actions',
	                         'store_id':store_id,'action_id':'3'
	                
	            },
	            success: function(response_3){
	                jQuery('.store_details_pop').empty();
	            	jQuery('.store_details_pop').append(response_3);
	            }
	        });

		return false;
	}else{
		return false;
	}
}

function store_delete(store_id){
	//alert('Work in progress');
	if (confirm("Are you sure? Want to delete this store")) {
		if(store_id !=''){
			var site_url = jQuery('#site_url').val();

				jQuery.ajax({

		            type: 'post',
		            url: site_url+"/wp-admin/admin-ajax.php",
		            
		            data: {
		                action: 'arch_woo_delivery_store_actions',
		                         'store_id':store_id,'action_id':'4'
		                
		            },
		            success: function(response_4){
		                jQuery('.com_response').empty();
		            	if(response_4 == '1'){
		            		jQuery('.all_stores_response').append('<span class="succ_response">Store Deleted successfully.</span>');
		            		setTimeout(function() {
							    location.reload();
							}, 3000);
		            	}else{
		            		jQuery('.all_stores_response').append('<span class="succ_response">Store not Deleted due to server error, Please try again.</span>');
		            	}
		                return false;
		            }
		        });

			return false;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/*** Check is number function start ***/

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
/*** Check is number function end ***/

/*** popup cloase function start ***/
function popup_close(){
    jQuery('.store_details_pop').empty();
}
/*** popup cloase function end ***/





// JavaScript Document
jQuery(document).ready(function() {
		<!-- Js for Menu -->	
	
		jQuery(".toggle_menu a").click(function () {
			jQuery("#topMenu").slideToggle("fast");
			});	
			
		jQuery(".drop-button a").click(function () {
			jQuery(".show_dropdown").slideToggle("fast");
			});

		/*<!-- Js for BXSLIDER -->
		$('.bxslider').bxSlider({
			captions: true,
			auto:true,
			controls:false,				
			pager: false,			
		});

		
		
		<!-- Grid Section -->
		$('.grid-scetion img').css('opacity', 0.7);
		// when hover over the selected image change the opacity to 1  
		$('.grid-scetion li').hover(  
			function(){  
			  $(this).find('img').stop().fadeTo('slow', 1.0);  
			},  
			function(){  
			  $(this).find('img').stop().fadeTo('fast', 0.7);  
		});  */

	/*	jQuery('.bxslider1').bxSlider({
			captions: true,
			auto:true,
			controls:false,				
			pager: false	
		});*/


﻿
	/* Fixed Header */
	var lastScroll = 0;
    $(window).scroll(function(event) {
        //Sets the current scroll position
        var st = $(this).scrollTop();
        //Determines up-or-down scrolling
        if (st > lastScroll) {
            $("header").addClass("header_fixed");
    //$("header").css("transition", "background .3s");
        } else {
            //Replace this with your function call for upward-scrolling
            if ($(this).scrollTop() == 0) {

    $("header").removeClass("header_fixed");


            }
        }
        //Updates scroll position
        lastScroll = st;

    	});
	/* Fixed Header */

	/* Fixed Contact Number */   
	$(window).scroll(function(event){
		if($(window).scrollTop() == $(document).height() - $(window).height()){
			$(".fixed_contact_number").css("display","none");
		}else{
			$(".fixed_contact_number").css("display","block");
		}
	});		
	/* Fixed Header */

	// add multiple select / deselect functionality
	$("#checkbox_all").click(function () {
		$('.checkbox').attr('checked', this.checked);
	});


	// if all checkbox are selected, check the selectall checkbox
	// and viceversa
	$(".checkbox").click(function(){

		if($(".checkbox").length == $(".checkbox:checked").length) {
			$("#checkbox_all").attr("checked", "checked");
		} else {
			$("#checkbox_all").removeAttr("checked");
		}

	});


	//pushing checkbox value into array
	$("#delete_multiple").on("click",function(){
		var category_id = [];
		$(".inner_checkbox:checked").each(function() {
			category_id.push($(this).val());
		});
		console.log(category_id);
		$.ajax({
			type: "POST",
			url: "http://10.0.11.22/assignment_4/category_bulkdelete.php",
			data: {category_id:category_id},
			success: function(msg){
				alert('Categories deleted sucessfully!!');
				window.location.reload();
				
			}
		});
	});
	//pushing checkbox value into array
	$("#delete_multiple_product").on("click",function(){
		var category_id = [];
		$(".inner_checkbox:checked").each(function() {
			category_id.push($(this).val());
		});
		console.log(category_id);
		$.ajax({
			type: "POST",
			url: "http://10.0.11.22/assignment_4/product_bulkdelete.php",
			data: {category_id:category_id},
			success: function(msg){
				alert('Categories deleted sucessfully!!');
				window.location.reload();

			}
		});
	});
	
});



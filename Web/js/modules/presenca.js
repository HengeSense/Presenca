$(document).ready(function() {

// ------------------------------------- PRESENCA ------------------------------------- //

// 	VARS //
	var editingPresenca = false;
	var editingCell = false;
	var star = $(".star");
	var weekFromNow = 0;
	
// -------------------------------------- STYLE -------------------------------------- //

	function removeCellPadding() {
		$("td").has(".multipleUsers").each(function () {
			$(this).css("padding", "0");
		});
	}

// -------------------------------------- MENU -------------------------------------- //
	
	/**
	 * Page initialization
	 * @return {null}
	 */
	$("#presencaContent").live("hashDidLoad", function() {

		// We request the information on the server
		$.post('ajaxPresenca.php',
		{	
			computerState: "computerState", 
			tokenID: localStorage.getItem("tokenID") || "no",
		}, // And we print it on the screen
		function(data) {
			if (data == "true") {
				$("#presencaContent #favoriteButton").trigger("click", [true]);
			}
		}, 'html' );

	});

	/**
	 * Change edit mode
	 * @return {null}
	 */
	$("#presencaContent #editButton").live("click", function () {
		editingPresenca = !editingPresenca;
		
		if (editingPresenca) {
			$(this).toggle(0).attr('src', 'images/50-check.png').fadeIn(500);
			star = $(".star");
			star.removeClass('star');
		} else {
			$(this).toggle(0).attr('src', 'images/50-pen.png').fadeIn(500);
			star.addClass('star');
		}
	});

	/**
	 * Request a table that will be copied
	 * @return {null} 
	 */
	$("#presencaContent #copyButton").live("click", function () {
		
		$.post('ajaxPresenca.php', {
			copyButton: "copyButton"
		}, 
		function(data) {
			$("#userBox").html(data).slideToggle(500);
		}, 'html' );
	});
	
	/**
	 * Confirm which table is being copied
	 * @return {null}
	 */
	$("#presencaContent #copyTableButton").live("click", function () {
	
		var ref = $(this).parent();
		var weeks = $("#numberWeeks").val();
		
		// Disable it for no futher simultaneous requisitions 
		ref.attr('disabled','disabled');
		
		$.post('ajaxPresenca.php', {
			copyTable: weekFromNow, 
			fromShift: weeks
		}, 
		function(data) {
			ref.toggle().html(data).fadeIn(800, function () {
				$("#userBox").slideToggle(500);
				
				$("table").fadeOut(500);
				
				$.post('ajaxPresenca.php', {
					shiftWeek: weekFromNow
				}, 
				function(data) {
					ref.removeAttr('disabled');
					$("table").replaceWith(data).fadeIn(500);
					removeCellPadding();
				}, 'html' );
			});
		}, 'html' );
			
	});
	
	/**
	 * Request the explanations to be reviewed
	 * @return {null}
	 */
	$("#presencaContent #reviewButton").live("click", function () {
		
		$.post('ajaxPresenca.php', {
			reviewButton: "reviewButton"
		}, 
		function(data) {
			$("#userBox").html(data).slideToggle(500);
		}, 'html' );
	});
	
	/**
	 * Confirm which explanations have been reviewed
	 * @return {null}
	 */
	$("#presencaContent #handContraButton, #presencaContent #handProButton").live("click", function () {

		var ref = $(this).parents("#reviewBox");
		var refHandBox = $(this).parents("#handBox");
		var dateID = ref.find("#dateID").val();
		var decision = ($(this).attr("id") == "handContraButton") ?  -1 : 1;
		
		$.post('ajaxPresenca.php', {
			confirmReview: dateID,
			decision: decision
		}, 
		function(data) {
			refHandBox.html(data).fadeIn(800);
		}, 'html' );
			
	});
	
	
	/**
	 * Change which week is on focus
	 * @return {null}
	 */
	$("#presencaContent #leftArrow, #presencaContent #rightArrow").live("click", function () {
	
		var ref = $(this).parent();
		
		// Disable it for no futher simultaneous requisitions 
		ref.attr('disabled','disabled');
		
		// See which element was clicked
		($(this).attr("id") == "leftArrow") ?  weekFromNow-- : weekFromNow++;
		
		$("table").fadeOut(500);

		$.post('ajaxPresenca.php', {
			shiftWeek: weekFromNow
		}, 
		function(data) {
			ref.removeAttr('disabled');
			$("table").replaceWith(data).fadeIn(500);
			removeCellPadding();
		}, 'html' );
			
	});

	/**
	 * Tool to favorite a carte
	 * @return {null}       
	 */
	$("#presencaContent #favoriteButton").live("click", function (event, propagate) {	
		
		// We must stop the bubble
		event.stopPropagation();
	
		$image = $(this);

		// Toggle the image
		if ($image.hasClass("favorite")) {
		    $image.attr('src', 'images/50-star_unfilled.png');
		} else {
			$image.attr('src', 'images/50-star_filled.png');
		}

		// A little animation to give the impression the user has put some pressure on the click (it's really cool)
		$image.toggleClass("favorite") // Toggle the class
			.width($image.width() * 1.25) // Set the width a little bigger
			.animate({
				"width": $image.width() / 1.25 // And then default it
			}, 100);

		if (propagate !== true) {
			// Toggle the tokenID
			$.post('ajaxPresenca.php', {
				toggleToken: "toggleToken",
				tokenID: localStorage.getItem("tokenID") || "no",
			}, 
			function(data) {
				// Save the item
				localStorage.setItem("tokenID", data);
			}, 'html' );
		}

	});
	
// -------------------------------------- TABLE -------------------------------------- //
	
	/**
	 * Begin and end shift
	 * @return {[type]} [description]
	 */
	$("#presencaContent .star").live("click", function () {
	
		// We have to check if this cell still can be selected (can be on edit mode)
		if ($(this).hasClass('star')) { 
			var ref = $(this);
			var html = $(this).html();
			var dateID = ref.find("#dateID").val();
			
			if ($(this).siblings("#multipleUserCell").val() == 'YES') {
				// MIGHT NEW A REVISION!
				ref = $(this).parents("td"); // We need to get out of our nested table!
				ref.css("padding", "20px 0");
			}
			
			ref.html("<img src='images/64-loading.gif'>");
			ref.removeClass().addClass("white");
			
			$.post('ajaxPresenca.php', {
				confirm: "confirm",
				tokenID: localStorage.getItem("tokenID"),
			}, 
			function(data) {
					
				ref.html(data);
				
				// Animate and only loads the box again when the animation is complete
				ref.find("img").toggle().fadeIn(500, function () {
					$.post('ajaxPresenca.php', {cellText: "cellText", date:dateID}, 
						function(data) {
							var content = $(data); // Hold a reference for the newly created element
							ref.toggle(0).replaceWith(content).fadeIn(500);
							content.has(".multipleUsers").css("padding", "0");
						}, 'html' );
				});
				
			}, 'html' );
		}
		
	});
	
	
	/**
	 * Request a user shift to change
	 * @return {null}
	 */
	$("#presencaContent td").live("click", function () {
		if (editingPresenca == true && editingCell == false) {
		
			editingCell = true;
	
			var ref = $(this);
			var dateID = $(this).find("#dateID").val();

			if ($(this).siblings("#multipleUserCell").val() == 'YES') {
				// MIGHT NEW A REVISION!
				ref = $(this).parents("td"); // We need to get out of our nested table!
				ref.css("padding", "20px 0");
			}

			ref.html("<img src='images/64-loading.gif'>");
			ref.removeClass().addClass("white");
			
			$.post('ajaxPresenca.php', {usersList: "usersList", date: dateID}, 
				function(data) {
					ref.html(data);
				}, 'html' );
		}
		
	});


	/**
	 * Confirm which shift has been changed
	 * @return {null	}
	 */
	$("#confirmButton").live("click", function () {
		
		var ref = $(this).parents("td");
		var dateID = $(this).parents("td").find("#dateID").val();
		var choosenUser = $("#confirmSelect").val();

		$.post('ajaxPresenca.php', {
			changeUser: choosenUser,
			date: dateID
		}, 
		function(data) {
			var content = $(data); // Hold a reference for the newly created element
			ref.toggle(0).replaceWith(content).fadeIn(500);
			content.has(".multipleUsers").css("padding", "0");

			if (editingPresenca == true) {
				star = $(".star");
				content.removeClass('star').find(".star").removeClass('star'); // $(this) referencing the new element
			}
			
			editingCell = false;
			
		}, 'html' );
			
	});
		
	/**
	 * Add and remove users from a certain shift
	 * @return {null}
	 */
	$("#presencaContent #addUserToCell, #presencaContent #removeUserFromCell").live("click", function () {
	
		// We must get the type before changing ref
		var type = ($(this).attr("id") == "removeUserFromCell") ?  0 : 1;
	
		var ref = $(this).parents("td");
		var dateID = $(this).parents("td").find("#dateID").val();
		
		$.post('ajaxPresenca.php', {addRemoveUserToCell: type, date: dateID}, 
			function(data) {
				var content = $(data); // Hold a reference for the newly created element
				ref.toggle(0).replaceWith(content).fadeIn(500);
				content.has(".multipleUsers").css("padding", "0");
				
				if (editingPresenca == true) {
					star = $(".star");
					content.removeClass('star').find(".star").removeClass('star'); // $(this) referencing the new element
				}
				
				editingCell = false;
				
			}, 'html' );
	});
	

	/**
	 * Request the addition of a new justification
	 * @return {null}
	 */
	$("#presencaContent #paperAirplane").live("click", function () {
		
		var dateID = $(this).parents("td").find("#dateID").val();
		
		$.post('ajaxPresenca.php', {paperAirplane: dateID}, 
			function(data) {
				$("#userBox").html(data).slideDown(500);
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}, 'html' );
	});
	
	/**
	 * Confirm the insertion of a justification
	 * @return {null}
	 */
	$("#presencaContent #addExplanationButton").live("click", function () {
	
		var ref = $(this).parent();
		var dateID = $(this).parent().find("#dateID").val();
		var justificationID = $("#justificationID").val();
		var justificationText = $("#justificationText").val();
		
		$.post('ajaxPresenca.php', {
			addExplanationButton: dateID,
			justificationID: justificationID,
			justificationText: justificationText
		}, 
		function(data) {
			ref.toggle().html(data).fadeIn(800, function () {
				$("#userBox").slideToggle(500);
			});
		}, 'html' );
			
	});
	
	/**
	 * If the notification is already know, we can make a small tweak
	 * @return {null}
	 */
	$("#presencaContent #justificationID").live("change", function () {
		
		if ($(this).val() == "0") {
			$(this).siblings("#justificationTextBox").slideDown(500);
		} else {
			$(this).siblings("#justificationTextBox").slideUp(500);
		}
			
	});
	
});
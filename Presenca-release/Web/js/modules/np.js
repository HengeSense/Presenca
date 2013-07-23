// ------------------------------------- NP MODULE ------------------------------------- //

$.fn.np = function(method) {

	var telephoneInput = "";

	var methods = {
		/**
		 * Verification for brazilian telephones, including the ones within São Paulo
		 * @return {null}
		 */
		telephoneVerification: function() {

			// We apply the mask and see if the user is in São Paulo, where the phone may have 9 digits
			this.mask("(99) 9999-9999")
			.keyup(function () {
					var beginning = $(this).val().substring(0, 6);
					if ((beginning == "(11) 6" || beginning == "(11) 7" || beginning == "(11) 8" || beginning == "(11) 9") && $(this).parent().find(".infoContainerFieldContentSub").size() == 0) {
						$(this).parent().append("<br><span class='infoContainerFieldContentSub'>O prefixo 9 será adicionado automaticamente.</span>");
					}
			}).blur(function () {
				telephoneInput = $(this).val();
				$(this).parent().find(".infoContainerFieldContentSub").text("");
				
				var beginning = $(this).val().substring(0, 6);
				if (beginning == "(11) 6" || beginning == "(11) 7" || beginning == "(11) 8" || beginning == "(11) 9") {
					$(this).val($(this).val().replace(/\(11\)\ /g,"(11) 9"));
				}
			}).focus(function () {
				if (telephoneInput.length = 15) {
					$(this).val(telephoneInput);
				}
			});

			return this;

		},

		/**
		 * Verification for dates, adopting the standard brazilian format
		 * @return {null}
		 */
		dateVerification: function() {

			// We apply a mask, so the user recognize the date format and we also da a GUI picker
			this.mask("99/99/9999")
			.datepicker( {
				"dateFormat": "dd/mm/yy"
			});

		},

		/**
		 * Create a field inside a infoContainer
		 * @param  {string} elementType Type of element (HTML)
		 * @param  {object} attrOptions Options for the attributes
		 * @param  {object} cssOptions  Options for the css
		 * @return {null}         
		 */
		createField: function (elementType, attrOptions, cssOptions) {

			// We gotta check if the arguments are properly designed
			if (typeof elementType !== "string") {
				elementType = "div";
			}
			
			if (typeof attrOptions !== "object") {
				attrOptions = {};
			}

			if (typeof cssOptions !== "object") {
				cssOptions = {};
			}

			var $fields = $();

			this.each(function () {
				var className = $(this).attr('class');
				var name = $(this).attr("name");
				var value = $(this).text();

				// Seek an optional name
				if (typeof name === 'undefined' || name === false) {
				    var name = $(this).attr("title");
				}

				var $fieldContent = $(document.createElement(elementType))
						.val(value) // We must set a value
						.attr("name", name) // We must set a name
						.addClass(className) // We must set the class it came with
						.attr(attrOptions) // We must set attrOptions
						.css(cssOptions); // We must set cssOptions

				// Add the new field and capture the collection
				$fields = $fields.add($fieldContent);

				$(this).replaceWith($fieldContent);
			});

			return $fields;
		},

		/**
		 * Remove a field inside a infoContainer
		 * @param  {object} attrOptions Options for the attributes
		 * @param  {object} cssOptions  Options for the css
		 * @return {null}         
		 */
		removeField: function (attrOptions, cssOptions) {

			// We gotta check if the arguments are properly designed
			if (typeof attrOptions !== "object") {
				attrOptions = {};
			}

			if (typeof cssOptions !== "object") {
				cssOptions = {};
			}

			var $fields = $();
			// $fields.add("div");
			this.each(function () {
				var className = $(this).attr('class');
				var name = $(this).attr("name");
				var value = ($(this).val() + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + '<br ' + '/>' + '$2');

				var $fieldContent = $(document.createElement("span"))
						.html(value) // We must set a value
						.attr("name", name) // We must set a name
						.attr("title", name) // We must set a name
						.addClass(className) // We must set the class it came with
						.attr(attrOptions) // We must set attrOptions
						.css(cssOptions); // We must set cssOptions

				if ($(this).attr('type') == 'password') {
					$fieldContent.text("*****");
				}

				// Add the new field and capture the collection
				$fields = $fields.add($fieldContent);

				$(this).replaceWith($fieldContent);
			});

			return $fields;
		},

		/**
		 * See if all the form input's are valid
		 * @return {null}
		 */
		consistentForm: function(vetor) {

			var consistent = false;
		
			for (var i = 0; i < vetor.length; i++) {
				if (vetor[i].value != "") {
					consistent = true;
				} else {
					consistent = false;
					break;
				}
			}

			return consistent;
		},

		/**
		 * Get all form inputs, serialize and save them
		 * @return {null}
		 */
		saveForm: function() {
			$info = this.parents(".infoContainer").toggleClass("editMode");
	
			if ($info.hasClass("editMode")) {
				// We change the icon
				this.toggle(0).attr('src', 'images/50-check.png').fadeIn(500);

				// So we have to loop through all elements on the form
				// First we go with the input
				$info.find(".infoContainerInputContent[type!='password']").np("createField", "input", {"type": "text"});
				$info.find(".infoContainerInputContent[type='password']").np("createField", "input", {"type": "password"});

				// And finally we load the necessary components
				$info.find(".infoContainerInputContent[name='telephone']").np("telephoneVerification");
				
				$info.find(".infoContainerInputContent[name='birthday'], .infoContainerInputContent[name='historyDate']").np("dateVerification");

				$info.find(".infoContainerSave").show();


				// Special elements (according to layout) - will not always apply
				$info.find(".badgeHistory").hide();
				$info.find(".badgeActive").show();

				
				// Creating the uploader
				var uploader = new qq.FileUploader({
					// pass the dom node (ex. $(selector)[0] for jQuery users)
					element: $info.find('#file-uploader')[0],
					// path to server-side upload script
					action: 'fileuploader.php',
					
					onComplete: function(id, fileName, responseJSON){
						
						$(".qq-upload-list").css("display", "none");
						$info.find(".infoContainerImage img").attr("src", "uploads/" + responseJSON.fileName);
						
					}
				});
				
				
			} else {
				
				var memberID = $info.find("#memberID").val();
				var vetor = $info.find("form").serializeArray();
				
				// Since the function does not serialize the image, we have to do this ourselves
				if ($info.find(".infoContainerImage img").size() != 0) {
					vetor[vetor.length] = {
						"name": "photo",
						"value": $info.find(".infoContainerImage img").attr("src")
					}
				}

				if ($info.np("consistentForm", vetor) == true) {

					// And the part of url necessary for the ajax requisition
					var destiny = $info.parents(".pageContent").attr("data-ajax");
	
					// And then we send it to the server, if the conditions have been met
					$.post(destiny + '.php',
					{	// We are gonna roll it down according to the badge content flow (so if the flow changes, the code has to change)
						saveForm: "saveForm",
						memberID: memberID,
						data: vetor
					},
					function(data) {
						// And just need to make sure that the content was properly saved

						if (data != "true") {
							$(".errorBox").fadeToggle(200);
						}
					}, 'html' );

					// Since we saved it, we can now remove
					$info.removeClass("newInfoContainer");
					
					// We change the icon
					this.toggle(0).attr('src', 'images/50-pen.png').fadeIn(500);
					
					// So we have to loop through all elements on the form and reset them to their default state
					$info.find(".infoContainerInputContent").np("removeField");
					$info.find(".infoContainerSave").hide();

					// Delete the uploader
					$info.find("#file-uploader").html('<noscript>Javascript please!</noscript>');
					// Reset the error message
					$info.find(".saveButtonError").text("");

					// Special elements (according to layout) - will not always apply
					$info.find(".badgeHistory").show();
					$info.find(".badgeActive").hide();
					
				} else {
					$info.toggleClass("editMode").find(".saveButtonError").text("Insira todos os dados.");
				}
			}
		}
	};

	// Method calling logic
	if ( methods[method] ) {
		return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
		return methods.init.apply( this, arguments );
	} else {
		$.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
	} 

};
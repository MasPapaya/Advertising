$(document).ready(function() {
	
	
	$('.content_scroll').mCustomScrollbar({
		set_width: false, /*optional element width: boolean, pixels, percentage*/
		set_height: false, /*optional element height: boolean, pixels, percentage*/
		horizontalScroll: false, /*scroll horizontally: boolean*/
		scrollInertia: 950, /*scrolling inertia: integer (milliseconds)*/
		mouseWheel: true, /*mousewheel support: boolean*/
		mouseWheelPixels: "auto", /*mousewheel pixels amount: integer, "auto"*/
		autoDraggerLength: true, /*auto-adjust scrollbar dragger length: boolean*/
		autoHideScrollbar: false, /*auto-hide scrollbar when idle*/
		snapAmount: null, /* optional element always snaps to a multiple of this number in pixels */
		snapOffset: 0, /* when snapping, snap with this number in pixels as an offset */
		scrollButtons: {/*scroll buttons*/
			enable: true, /*scroll buttons support: boolean*/
			scrollType: "continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
			scrollSpeed: "auto", /*scroll buttons continuous scrolling speed: integer, "auto"*/
			scrollAmount: 40 /*scroll buttons pixels scroll amount: integer (pixels)*/
		},
		advanced: {
			updateOnBrowserResize: true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
			updateOnContentResize: true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
			autoExpandHorizontalScroll: false, /*auto-expand width for horizontal scrolling: boolean*/
			autoScrollOnFocus: false, /*auto-scroll on focused elements: boolean*/
			normalizeMouseWheelDelta: false /*normalize mouse-wheel delta (-1/1)*/
		},
		contentTouchScroll: true, /*scrolling by touch-swipe content: boolean*/
		callbacks: {
			onScrollStart: function() {
													
			}, /*user custom callback function on scroll start event*/
			onScroll: function() {
			}, /*user custom callback function on scroll event*/
			onTotalScroll: function() {
			}, /*user custom callback function on scroll end reached event*/
			onTotalScrollBack: function() {
			}, /*user custom callback function on scroll begin reached event*/
			onTotalScrollOffset: 0, /*scroll end reached offset: integer (pixels)*/
			onTotalScrollBackOffset: 0, /*scroll begin reached offset: integer (pixels)*/
			whileScrolling: function() {
			} /*user custom callback function on scrolling event*/
		},
		theme: "dark" /*"light", "dark", "light-2", "dark-2", "light-thick", "dark-thick", "light-thin", "dark-thin"*/
	});
	
	$('li a , a').bind('contextmenu', function(e) {return false;}).bind('click',function(event){		
		switch (event.button){
			case 1 :
			case 2:
				return false;
				break;
		}	
	});
	
	var resize_window = function(){
		$('body').mCustomScrollbar("destroy");
		if($(window).width() < 766){
			$('.content_scroll').mCustomScrollbar("disable",true);
				$(' body ').mCustomScrollbar({		
					set_width: false, /*optional element width: boolean, pixels, percentage*/
					set_height: false, /*optional element height: boolean, pixels, percentage*/
					horizontalScroll: false, /*scroll horizontally: boolean*/
					scrollInertia: 950, /*scrolling inertia: integer (milliseconds)*/
					mouseWheel: true, /*mousewheel support: boolean*/
					mouseWheelPixels: "auto", /*mousewheel pixels amount: integer, "auto"*/
					autoDraggerLength: true, /*auto-adjust scrollbar dragger length: boolean*/
					autoHideScrollbar: false, /*auto-hide scrollbar when idle*/
					snapAmount: null, /* optional element always snaps to a multiple of this number in pixels */
					snapOffset: 0, /* when snapping, snap with this number in pixels as an offset */
					scrollButtons: {/*scroll buttons*/
						enable: true, /*scroll buttons support: boolean*/
						scrollType: "continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
						scrollSpeed: "auto", /*scroll buttons continuous scrolling speed: integer, "auto"*/
						scrollAmount: 40 /*scroll buttons pixels scroll amount: integer (pixels)*/
					},
					advanced: {
						updateOnBrowserResize: true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
						updateOnContentResize: true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
						autoExpandHorizontalScroll: false, /*auto-expand width for horizontal scrolling: boolean*/
						autoScrollOnFocus: false, /*auto-scroll on focused elements: boolean*/
						normalizeMouseWheelDelta: false /*normalize mouse-wheel delta (-1/1)*/
					},
					contentTouchScroll: true, /*scrolling by touch-swipe content: boolean*/
					callbacks: {
						onScrollStart: function() {

						}, /*user custom callback function on scroll start event*/
						onScroll: function() {
						}, /*user custom callback function on scroll event*/
						onTotalScroll: function() {
						}, /*user custom callback function on scroll end reached event*/
						onTotalScrollBack: function() {
						}, /*user custom callback function on scroll begin reached event*/
						onTotalScrollOffset: 0, /*scroll end reached offset: integer (pixels)*/
						onTotalScrollBackOffset: 0, /*scroll begin reached offset: integer (pixels)*/
						whileScrolling: function() {
						} /*user custom callback function on scrolling event*/
					},
					theme: "dark" /*"light", "dark", "light-2", "dark-2", "light-thick", "dark-thick", "light-thin", "dark-thin"*/
				});
		}else{			
			$('.content_scroll').mCustomScrollbar("update");
		}
		
//		$('h2').html($(window).width());
	};
	resize_window();
	$(window).resize(function(){
		resize_window();
	});
	
	/**
	 * ordenamiento de archivos
	 */
	$('.sortable_groups').sortable({
		placeholder: "ui-state-highlight",
		start:function(event,ui){
			ui.placeholder.css({
//				width:ui.item.width(),
//				height:ui.item.height()
				height:ui.item.outerHeight()			
			});
			ui.placeholder.addClass('span4');
		},
		update:function(event,ui){
			$('#btn_update_list').show();
			if(!ui.item.parents('.sortable_groups').hasClass('sortable_groups_update')){
				ui.item.parents('.sortable_groups').addClass('sortable_groups_update');
			}
		}
	});
	
	$('#btn_update_list').bind('click',function(event){
		var btn = $(this);
		
		if(!btn.hasClass('disabled')){
			
			btn.addClass('disabled');			
			var ResourceGroupList = {};
			/**
			 * iteramos sobre cada grupo modificado
			 */
			$('.sortable_groups_update').each(function(key){

				var List = {
					"ResourceGroupType":$(this).attr('data-gti'),
					"ResourcesList":[]
				};
				/**
				 * iteramos sobre cada elemento de cada grupo para obtener su posición
				 */
				$(this).children('li.span4').each(function(key_2){
					var img = $(this).children('.img').length === 1 ? $(this).children('.img') : null;				
					if(img !== null){
						List.ResourcesList[key_2] = {
							"group_id":img.attr('data-group_id'),
							"resource_id":img.attr('data-id')
						};
					}
				});			
				ResourceGroupList[key] = List;
			});

			
			var loading = $('<img src="'+base_url+'/img/loading.gif" alt="cargando" class="loading_sorting" />');
			$.ajax({
				url:base_url+"/resources/order/"+entity_alias+'/'+parent_entityid,
				data:ResourceGroupList,
				dataType:"JSON",
				type:"POST",
				beforeSend:function(){
					btn.after(loading);
				},
				complete:function(){
					loading.remove();
					window.location.reload();
				},
				success:function (data, textStatus) {
//						window.Location.reload();
				}
			});			
		}		
	});	
	
	$('.content_multimedia .img').bind('click', function() {
		
		var loading = $('<img src="'+base_url+'/img/loading.gif" alt="cargando" class="loading"/>');
		var update = $('#options_imgs');
		
		update.html(loading);
			
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
			if($(this).parent().hasClass('img-polaroid')){
				$(this).parent().removeAttr('style');
			}
			loading.remove();
		} else {
			$(this).addClass('selected');
			if($(this).parent().hasClass('img-polaroid')){
				$(this).parent().css({'background-color':'rgba(0, 136, 204, 0.5)'});
			}
		}
		
		if ($('.content_multimedia .selected').length > 1) {
				update.html('');
				$.tmpl($('#template-count-resources').html(),{total:$('.content_multimedia .selected').length}).appendTo('#options_imgs');
				$('a#delete_select_resources').bind('click',function(event){
					event.preventDefault();
					
					if(confirm(i18n.delete_resources)){
						var data = {"Resources":[]};
						$.each($('.content_multimedia .selected'),function(index,value){
							data.Resources.push({id: $(this).attr('data-id')});
						});
						$.ajax({
							url:base_url+"/resources/delete/"+entity_alias+'/'+parent_entityid,
							data:data,
							dataType:"html",
							type:"post",
							success:function (data, textStatus) {
								update.html(data);
							}
						});
					}
					
					
				}).bind('contextmenu', function(e) {
					return false;
				});
			}else{
				if ($('.content_multimedia .selected').length === 1){
					
					var img = $('.content_multimedia .selected');
					
					/***
					 * condicion para archivos que son de grupos de un solo archivo
					 */
					if($(this).hasClass('in_group')){
						$.ajax({
							url:base_url+"/resources/edit/"+entity_alias+'/'+parent_entityid,
							data:{
								id_resource				:img.attr('data-id'),
								resource_group_id		:img.attr('data-group_id'),
								resource_group_type_id	:img.attr('data-group_type_id'),
							},
							dataType:"html",
							type:"post",
							success:function (data, textStatus) {
								update.html(data);
							}
						});
					}
					
					/**
					 * condicion para archivos que no pertenecen a ningun grupo
					 */
					if($(this).hasClass('no_group')){						
						$.ajax({
							url:base_url+"/resources/edit/"+entity_alias+'/'+parent_entityid,
							data:{
								id_resource	:img.attr('data-id')
							},
							dataType:"html",
							type:"post",
							success:function (data, textStatus) {
								update.html(data);
							}
						});
					}					
					
				}
			}
		
		
	});
		
	// Initialize the jQuery File Upload widget:
	$('#fileupload').fileupload({
		// The regular expression for the types of images to load:
		// matched against the file type:
//		loadImageFileTypes: /^image\/(gif|jpeg|png)$/,
		// The maximum file size of images to load:
//		loadImageMaxFileSize: 5000000, // 5MB
		// The maximum width of resized images:
//		imageMaxWidth: 1920,
//		 The maximum height of resized images:
//		imageMaxHeight: 1080,
		// Define if resized images should be cropped or only scaled:
//		imageCrop: false,
		// Disable the resize image functionality by default:
//		disableImageResize: true,
//		 The maximum width of the preview images:
//		previewMaxWidth: 80,
		// The maximum height of the preview images:
//		previewMaxHeight: 80,
		// Define if preview images should be cropped or only scaled:
//		previewCrop: false,
//		 Define if preview images should be resized as canvas elements:
		previewAsCanvas: true,
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
//		url: url_file_upload,
		// The drop target element(s), by the default the complete document.
		// Set to null to disable drag & drop support:
		dropZone: $(document),
		// The paste target element(s), by the default the complete document.
		// Set to null to disable paste support:
		pasteZone: $(document),
		// The file input field(s), that are listened to for change events.
		// If undefined, it is set to the file input fields inside
		// of the widget element on plugin initialization.
		// Set to null to disable the change listener.
		fileInput: $('#ResourceFilename'),
		// By default, the file input field is replaced with a clone after
		// each input field change event. This is required for iframe transport
		// queues and allows change events to be fired for the same file
		// selection, but can be disabled by setting the following option to false:
//		replaceFileInput: true,
		// The parameter name for the file form data (the request argument name).
		// If undefined or empty, the name property of the file input field is
		// used, or "files[]" if the file input name property is also empty,
		// can be a string or an array of strings:
//		paramName: undefined,
		// By default, each file of a selection is uploaded using an individual
		// request for XHR type uploads. Set to false to upload file
		// selections in one request each:
//		singleFileUploads: true,
		// To limit the number of files uploaded with one XHR request,
		// set the following option to an integer greater than 0:
//		limitMultiFileUploads: undefined,
		// Set the following option to true to issue all file upload requests
		// in a sequential order:
//		sequentialUploads: false,
//		 To limit the number of concurrent uploads,
		// set the following option to an integer greater than 0:
//		limitConcurrentUploads: undefined,
		// Set the following option to true to force iframe transport uploads:
//		forceIframeTransport: false,
		// Set the following option to the location of a redirect url on the
		// origin server, for cross-domain iframe transport uploads:
//		redirect: undefined,
		// The parameter name for the redirect url, sent as part of the form
		// data and set to 'redirect' if this option is empty:
//		redirectParamName: undefined,
		// Set the following option to the location of a postMessage window,
		// to enable postMessage transport uploads:
//		postMessage: undefined,
		// By default, XHR file uploads are sent as multipart/form-data.
		// The iframe transport is always using multipart/form-data.
		// Set to false to enable non-multipart XHR uploads:
//		multipart: true,
		// To upload large files in smaller chunks, set the following option
		// to a preferred maximum chunk size. If set to 0, null or undefined,
		// or the browser does not support the required Blob API, files will
		// be uploaded as a whole.
//		maxChunkSize: undefined,
		// When a non-multipart upload or a chunked multipart upload has been
		// aborted, this option can be used to resume the upload by setting
		// it to the size of the already uploaded bytes. This option is most
		// useful when modifying the options object inside of the "add" or
		// "send" callbacks, as the options are cloned for each file upload.
//		uploadedBytes: undefined,
		// By default, failed (abort or error) file uploads are removed from the
		// global progress calculation. Set the following option to false to
		// prevent recalculating the global progress data:
//		recalculateProgress: true,
		// Interval in milliseconds to calculate and trigger progress events:
//		progressInterval: 100,
		// Interval in milliseconds to calculate progress bitrate:
//		bitrateInterval: 500,
		// By default, uploads are started automatically when adding files:
//		autoUpload: true,
		// Error and info messages:
		messages: {
			uploadedBytes: 'Uploaded bytes exceed file size'
		},
		// Translation function, gets the message key to be translated
		// and an object with context specific data as arguments:
//		i18n: function(message, context) {},

		// Additional form data to be sent along with the file uploads can be set
		// using this option, which accepts an array of objects with name and
		// value properties, a function returning such an array, a FormData
		// object (for XHR file uploads), or a simple object.
		// The form of the first fileInput is given as parameter to the function:
//		formData: function(form) {
//			return form.serializeArray();
//		},
		// The add callback is invoked as soon as files are added to the fileupload
		// widget (via file input selection, drag & drop, paste or add API call).
		// If the singleFileUploads option is enabled, this callback will be
		// called once for each file in the selection for XHR file uplaods, else
		// once for each file selection.
		// The upload starts when the submit method is invoked on the data parameter.
		// The data object contains a files property holding the added files
		// and allows to override plugin options as well as define ajax settings.
		// Listeners for this callback can also be bound the following way:
		// .bind('fileuploadadd', func);
		// data.submit() returns a Promise object and allows to attach additional
		// handlers using jQuery's Deferred callbacks:
		// data.submit().done(func).fail(func).always(func);
//		add: function(e, data) {
//			if (data.autoUpload || (data.autoUpload !== false && $(this).fileupload('option', 'autoUpload'))) {
//				data.process().done(function() {
//					data.submit();
//				});
//			}
//		}, //No tocar estas lineas
		// Other callbacks:

		// Callback for the submit event of each file upload:
		 submit: function (e, data) {
			 var inputs = data.context.find(':input, select');			
			data.formData = inputs.serializeArray();
		 }, // .bind('fileuploadsubmit', func);

		// Callback for the start of each file upload request:
//		 send: function (e, data) {}, 
				// // .bind('fileuploadsend', func);

		// Callback for successful uploads:
		// done: function (e, data) {}, // .bind('fileuploaddone', func);

		// Callback for failed (abort or error) uploads:
		// fail: function (e, data) {}, // .bind('fileuploadfail', func);

		// Callback for completed (success, abort or error) requests:
		// always: function (e, data) {}, // .bind('fileuploadalways', func);

		// Callback for upload progress events:
		progress: function(e, data) {
			$('.content_scroll').mCustomScrollbar("update");
			$('.chosen_groups').chosen();
//							$('.chosen_').trigger("liszt:updated");			
		}, // .bind('fileuploadprogress', func);

		// Callback for global upload progress events:
//		 progressall: function (e, data) {}, // .bind('fileuploadprogressall', func);

		// Callback for uploads start, equivalent to the global ajaxStart event:
//		 start: function (e) {}, // .bind('fileuploadstart', func);

		// Callback for uploads stop, equivalent to the global ajaxStop event:
		// stop: function (e) {}, // .bind('fileuploadstop', func);

		// Callback for change events of the fileInput(s):
//		 change: function (e, data) {}, // .bind('fileuploadchange', func);

		// Callback for paste events to the pasteZone(s):
		// paste: function (e, data) {}, // .bind('fileuploadpaste', func);

		// Callback for drop events of the dropZone(s):
		// drop: function (e, data) {}, // .bind('fileuploaddrop', func);

		// Callback for dragover events of the dropZone(s):
		// dragover: function (e) {}, // .bind('fileuploaddragover', func);

		// Callback for the start of each chunk upload request:
		// chunksend: function (e, data) {}, // .bind('fileuploadchunksend', func);

		// Callback for successful chunk uploads:
		// chunkdone: function (e, data) {}, // .bind('fileuploadchunkdone', func);

		// Callback for failed (abort or error) chunk uploads:
		// chunkfail: function (e, data) {}, // .bind('fileuploadchunkfail', func);

		// Callback for completed (success, abort or error) chunk upload requests:
		// chunkalways: function (e, data) {}, // .bind('fileuploadchunkalways', func);

		// The plugin options are used as settings object for the ajax calls.
		// The following are jQuery ajax settings required for the file uploads:
//		processData: false,
//		contentType: false,
//		cache: false
	});
});

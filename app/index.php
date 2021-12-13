<?php

require '../config/config.php';

$url_key = $_SERVER['QUERY_STRING'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">
	<base href="">
	<title>Prototype Survey PVS</title>

	<link href="assets/css/editor.css" rel="stylesheet">
	<link href="assets/css/line-awesome.css" rel="stylesheet">
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!-- <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet"> -->
	<script>
		if (typeof module === 'object') {
			window.module = module;
			module = undefined;
		}
	</script>
	<script src="https://www.google.com/cloudprint/client/cpgadget.js"></script>
	<style>
		@media print {

			#top-panel,
			#left-panel,
			#right-panel,
			#bottom-panel {
				display: none !important;
			}

			#vvveb-builder #canvas {
				margin-left: 0px;
				width: 100%;
				height: 100%;
			}
		}
	</style>
</head>

<body>


	<div id="vvveb-builder">
		<div id="top-panel">
			<div class="btn-group mr-3 float-left" role="group">
				<button class="btn btn-light" title="Menu" id="menu-btn">
					<i class="la la-bars"></i>
				</button>

				<button class="btn btn-light" title="Back" id="back-btn" onclick="location.href='../index.php'">
					<i class="la la-arrow-circle-o-left"></i> Exit
				</button>
				<button class="btn btn-light" title="Save" id="btn-save">
					<i class="la la-save"></i> Save
				</button>

				<input type="text" id="url_key" value="<?php echo $url_key; ?>" hidden>
			</div>

			<div class="btn-group mr-3" role="group">
				<button class="btn btn-light" title="Undo (Ctrl/Cmd + Z)" id="undo-btn" data-vvveb-action="undo" data-vvveb-shortcut="ctrl+z">
					<i class="la la-undo"></i> Undo
				</button>

				<button class="btn btn-light" title="Redo (Ctrl/Cmd + Shift + Z)" id="redo-btn" data-vvveb-action="redo" data-vvveb-shortcut="ctrl+shift+z">
					<i class="la la-undo la-flip-horizontal"></i> Redo
				</button>
			</div>


			<div class="btn-group mr-3" role="group">
				<button class="btn btn-light" title="Fullscreen (F11)" id="fullscreen-btn" data-toggle="button" aria-pressed="false" data-vvveb-action="fullscreen">
					<i class="la la-arrows"></i> Fullscreen
				</button>

				<button class="btn btn-light" title="Preview" id="preview-btn" type="button" data-toggle="button" aria-pressed="false" data-vvveb-action="preview">
					<i class="la la-eye"></i> Preview
				</button>
			</div>


			<div class="btn-group float-right" role="group">
				<button id="mobile-view" data-view="mobile" class="btn btn-light" title="Mobile view" data-vvveb-action="viewport">
					<i class="ion-iphone"></i>
				</button>

				<button id="tablet-view" data-view="tablet" class="btn btn-light" title="Tablet view" data-vvveb-action="viewport">
					<i class="ion-ipad"></i>
				</button>

				<button id="desktop-view" data-view="" class="btn btn-light" title="Desktop view" data-vvveb-action="viewport">
					<i class="ion-monitor"></i>
				</button>

			</div>

		</div>

		<div id="left-panel">
			<div id="components">

				<div class="header">

					<!-- <input class="form-control form-control-sm" placeholder="" type="text" id="component-search" data-vvveb-action="componentSearch" data-vvveb-on="keyup">
					<button id="clear-backspace" data-vvveb-action="clearComponentSearch">
						<i class="ion-backspace"></i>
					</button> -->

				</div>

				<div id="components-sidepane" class="sidepane">
					<div>

						<ul id="components-list" class="clearfix">
						</ul>

					</div>
				</div>
			</div>


		</div>

		<div class="canvas" id="canvas">
			<div class="iframe-wrapper" id="iframe-wrapper">

				<div id="iframe-layer">

					<div id="highlight-box">
						<div id="highlight-name"></div>

					</div>

					<div id="select-box">

						<div id="wysiwyg-editor">
							<a id="bold-btn" href="" title="Bold"><i><strong>B</strong></i></a>
							<a id="italic-btn" href="" title="Italic"><i>I</i></a>
							<a id="underline-btn" href="" title="Underline"><u>U</u></a>
							<a id="strike-btn" href="" title="Strikeout"><strike>S</strike></a>
							<!-- <a id="link-btn" href="" title="Create link"><strong>a</strong></a> -->
						</div>

						<div id="select-actions">
							<!-- <a id="drag-box" href="" title="Drag element"><i class="ion-arrow-move"></i></a>
							<a id="parent-box" href="" title="Select parent"><i class="ion-reply"></i></a>

							<a id="up-box" href="" title="Move element up"><i class="ion-arrow-up-a"></i></a>
							<a id="down-box" href="" title="Move element down"><i class="ion-arrow-down-a"></i></a> -->
							<a id="clone-box" href="" title="Duplicate"><i class="ion-ios-copy"></i></a>
							<a id="delete-box" href="" title="Delete"><i class="ion-trash-a"></i></a>
						</div>
					</div>




				</div>
				<iframe src="about:none" id="iframe1"></iframe>
			</div>


		</div>

		<div id="right-panel">
			<div id="component-properties">

			</div>
		</div>

		<div id="bottom-panel">
		</div>
	</div>


	<!-- templates -->




	<script id="vvveb-input-textinput" type="text/html">
		<div>
			<input name="{%=key%}" type="text" class="form-control" />
		</div>
	</script>

	<script id="vvveb-input-checkboxinput" type="text/html">
		<div>

			<label class="custom-control custom-checkbox">
				<input name="{%=key%}" class="custom-control-input" type="checkbox"><span class="custom-control-indicator"></span>
				<!-- span class="custom-control-description">Text</span -->
			</label>

		</div>
	</script>


	<script id="vvveb-input-toggle" type="text/html">
		<div class="toggle">
			<input type="checkbox" name="{%=key%}" value="{%=on%}" data-value-off="{%=off%}" data-value-on="{%=on%}" class="toggle-checkbox" id="{%=key%}">
			<label class="toggle-label" for="{%=key%}">
				<span class="toggle-inner"></span>
				<span class="toggle-switch"></span>
			</label>
		</div>
	</script>

	<script id="vvveb-input-header" type="text/html">
		<h6 class="header">{%=header%}</h6>
	</script>


	<script id="vvveb-input-select" type="text/html">
		<div>

			<select class="form-control custom-select">
				{% for ( var i = 0; i < options.length; i++ ) { %}
				<option value="{%=options[i].value%}">{%=options[i].text%}</option>
				{% } %}
			</select>

		</div>
	</script>

	<script id="vvveb-input-grid" type="text/html">
		<div class="row">
			<div class="mb-1 col-12">

				<label>Flexbox</label>
				<select class="form-control custom-select" name="col">

					<option value="">None</option>
					{% for ( var i = 1; i <= 12; i++ ) { %}
					<option value="{%=i%}" {% if ((typeof col !== 'undefined') && col == i) { %} selected {% } %}>{%=i%}</option>
					{% } %}

				</select>
				<br />
			</div>

			<div class="col-6">
				<label>Extra small</label>
				<select class="form-control custom-select" name="col-xs">

					<option value="">None</option>
					{% for ( var i = 1; i <= 12; i++ ) { %}
					<option value="{%=i%}" {% if ((typeof col_xs !== 'undefined') && col_xs == i) { %} selected {% } %}>{%=i%}</option>
					{% } %}

				</select>
				<br />
			</div>

			<div class="col-6">
				<label>Small</label>
				<select class="form-control custom-select" name="col-sm">

					<option value="">None</option>
					{% for ( var i = 1; i <= 12; i++ ) { %}
					<option value="{%=i%}" {% if ((typeof col_sm !== 'undefined') && col_sm == i) { %} selected {% } %}>{%=i%}</option>
					{% } %}

				</select>
				<br />
			</div>

			<div class="col-6">
				<label>Medium</label>
				<select class="form-control custom-select" name="col-md">

					<option value="">None</option>
					{% for ( var i = 1; i <= 12; i++ ) { %}
					<option value="{%=i%}" {% if ((typeof col_md !== 'undefined') && col_md == i) { %} selected {% } %}>{%=i%}</option>
					{% } %}

				</select>
				<br />
			</div>

			<div class="col-6 mb-1">
				<label>Large</label>
				<select class="form-control custom-select" name="col-lg">

					<option value="">None</option>
					{% for ( var i = 1; i <= 12; i++ ) { %}
					<option value="{%=i%}" {% if ((typeof col_lg !== 'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
					{% } %}

				</select>
				<br />
			</div>

			{% if (typeof hide_remove === 'undefined') { %}
			<div class="col-12">

				<button class="btn btn-sm btn-outline-light text-danger">
					<i class="ion-trash-a"></i> Remove
				</button>

			</div>
			{% } %}

		</div>
	</script>

	<script id="vvveb-input-textvalue" type="text/html">
		<div class="row">
			<div class="col-6 mb-1">
				<label>Value</label>
				<input name="value" type="text" value="{%=value%}" class="form-control" />
			</div>

			<div class="col-6 mb-1">
				<label>Text</label>
				<input name="text" type="text" value="{%=text%}" class="form-control" />
			</div>

			{% if (typeof hide_remove === 'undefined') { %}
			<div class="col-12">

				<button class="btn btn-sm btn-outline-light text-danger">
					<i class="ion-trash-a"></i> Remove
				</button>

			</div>
			{% } %}

		</div>
	</script>

	<script id="vvveb-input-rangeinput" type="text/html">
		<div>
			<input name="{%=key%}" type="range" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-control" />
		</div>
	</script>

	<script id="vvveb-input-button" type="text/html">
		<div>
			<button class="btn btn-sm btn-primary">
				<i class="ion-trash-a"></i> {%=text%}
			</button>
		</div>
	</script>


	<script id="vvveb-property" type="text/html">
		<div class="form-group row" data-key="{%=key%}">
			<label class="col-sm-4 control-label" for="input-model">{%=name%}</label>
			<div class="col-sm-8 input">
			</div>
		</div>
	</script>

	<!--// end templates -->


	<!-- export html modal-->
	<!-- <div id="textarea-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="textarea-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Contents</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<textarea rows="25" cols="150" class="form-control" id="content"></textarea>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save</button>
				</div>
			</div>
		</div>
	</div> -->


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		// $(document).ready(function() {
		// 			const slideValue = document.querySelector("span");
		// 			const inputSlider = document.querySelector("input");
		// 			inputSlider.oninput = (() => {
		// 				let value = inputSlider.value;
		// 				slideValue.textContent = value;
		// 				slideValue.style.left = (value / 2) + "%";
		// 				slideValue.classList.add("show");
		// 			});
		// 			inputSlider.onblur = (() => {
		// 				slideValue.classList.remove("show");
		// 			});

		// 			function resetFormModal() {
		// 				$('#textarea-modal').modal('hide');
		// 			};


		// 		}
		$(document).ready(function() {

			// function loadFormBuilder(){
			//     $.ajax({
			//         url: 'backend/selectElements.php',
			//         data: { survey_id: getUrlParameter('id') },
			//         type: 'POST',
			//         success: response =>{
			//             var options = {
			//                 dataType: 'json',
			//                 formData: response
			//             };

			//         }
			//     });
			// }

			Vvveb.Builder.init('', function() {

				Vvveb.Gui.init();

			});

			function saveSurvey(data) {
				$.ajax({
					url: '../backend/saveSurvey.php',
					type: 'POST',
					data: data,
					success: response => {
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: 'Your survey has been saved',
							showConfirmButton: false,
							timer: 1500
						})
						// .then(() => {
						// 	resetFormModal();
						// 	getSurvey();
						// });
					}
				});
			}

			$('#btn-save').click(function() {
				var iframe = $('#iframe1').val();

				alert(iframe);
				// var errCounter = 0;
				// if (errCounter === 0) {
				// 	const data = {
				// 		iframe: $('#iframe1').val(),
				// 		url_key: $('#url_key').val(),

				// 	};
				// 	saveSurvey(data);
				// }
			});
		});
	</script>




	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.hotkeys.js"></script>


	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>


	<script src="assets/libs/builder/builder.js"></script>

	<script src="assets/libs/builder/undo.js"></script>

	<script src="assets/libs/builder/inputs.js"></script>

	<script src="assets/libs/builder/components-choice-based.js"></script>
	<script src="assets/libs/builder/components-media-based.js"></script>
	<script src="assets/libs/builder/components-text-based.js"></script>
	<script src="assets/libs/builder/components-fields.js"></script>


	<script src="mainscript.js"></script>
	<script>
		if (window.module) module = window.module;
	</script>
</body>

</html>
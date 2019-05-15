<?php
?>

<!-- START of INCLUDES for CKEDITOR -->

			<meta charset="utf-8">
			<script src="./CKEditorFiles/Editor/ckeditor.js"></script>						
			<script src="./CKEditorFiles/Editor/samples/sample.js"></script>
			<link href="./CKEditorFiles/Editor/samples/sample.css" rel="stylesheet">
			              
			<!-- <link rel="stylesheet" href="./E/E/samples/sample.css"> -->
			<meta name="ckeditor-sample-required-plugins" content="sourcearea">
			<meta name="ckeditor-sample-name" content="Full page support">
			<meta name="ckeditor-sample-group" content="Plugins">
			<meta name="ckeditor-sample-description" content="CKEditor inserted with a JavaScript call and used to edit the whole page from &lt;html&gt; to &lt;/html&gt;.">
			
			<script>

				// This code is generally not necessary, but it is here to demonstrate
				// how to customize specific editor instances on the fly. This fits well
				// this demo because we have editable elements (like headers) that
				// require less features.

				// The "instanceCreated" event is fired for every editor instance created.
				CKEDITOR.on( 'instanceCreated', function( event ) {
					var editor = event.editor,
						element = editor.element;

					// Customize editors for headers and tag list.
					// These editors don't need features like smileys, templates, iframes etc.
					if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
						// Customize the editor configurations on "configLoaded" event,
						// which is fired after the configuration file loading and
						// execution. This makes it possible to change the
						// configurations before the editor initialization takes place.
						editor.on( 'configLoaded', function() {

							// Remove unnecessary plugins to make the editor simpler.
							editor.config.removePlugins = 'colorbutton,find,flash,font,' +
								'forms,iframe,image,newpage,removeformat,' +
								'smiley,specialchar,stylescombo,templates';

							// Rearrange the layout of the toolbar.
							editor.config.toolbarGroups = [
								{ name: 'editing',		groups: [ 'basicstyles', 'links' ] },
								{ name: 'undo' },
								{ name: 'clipboard',	groups: [ 'selection', 'clipboard' ] },
								{ name: 'about' }
							];
						});
					}
				});

			</script>
			
<!-- END of INCLUDES for CKEDITOR -->
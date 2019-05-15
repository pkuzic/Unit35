<?php
?>

	<script>
/*		CKEDITOR.replace
		( 
			'editor1', 
			{
				fullPage: true,
				allowedContent: true,
				extraPlugins: 'wysiwygarea',
				toolbar: 	[	{ 	name: 'document', 
									items: 	[ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },						// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
											[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],		// Defines toolbar group without name.
										'/',																				// Line break - next group will be placed in new line.
								{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
							]
			}
		);
*/

		CKEDITOR.replace( 
			'editor1', 
			{
			
			removePlugins : 'elementspath', 
			
			fullPage: true,
			allowedContent: true,
			extraPlugins: 'wysiwygarea',
						
			toolbar: 'Custom', //makes all editors use this toolbar
			toolbarStartupExpanded : false,
			toolbarCanCollapse  : false,
			toolbar: 	[	{ 	name: 'document', items: 	['Preview'] }, ['Copy']	]
			
		}
	);

	CKEDITOR.appendTo('editor1', {
		removePlugins: 'elementspath' 
	});

	
	//	http://ckeditor.com/latest/samples/plugins/toolbar/toolbar.html
	
	/* CKEDITOR.replace( 'textarea_id', {
	toolbar: [
		{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		'/',																					// Line break - next group will be placed in new line.
		{ name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
	]
	});
	*/
	
	</script>														
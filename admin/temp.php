	<html>
		<head>
		
<!-- START of INCLUDES for CKEDITOR -->

			<meta charset="utf-8">
			<script src="../../CKEditorFiles/Editor/ckeditor.js"></script>						
			<script src="../../CKEditorFiles/Editor/samples/sample.js"></script>
			<!-- <link rel="stylesheet" href="./E/E/samples/sample.css"> -->
			<meta name="ckeditor-sample-required-plugins" content="sourcearea">
			<meta name="ckeditor-sample-name" content="Full page support">
			<meta name="ckeditor-sample-group" content="Plugins">
			<meta name="ckeditor-sample-description" content="CKEditor inserted with a JavaScript call and used to edit the whole page from &lt;html&gt; to &lt;/html&gt;.">

<!-- END of INCLUDES for CKEDITOR -->

		</head>

		<body>

			<div class="container"> 																	<!-- overall page container div -->
				<div class="CenterContent">
					<form action="../../CKEditorFiles/Editor/samples/sample_posteddata.php" method="post">
						Please enter the NEW article abstract<br>
						<textarea cols="80" id="editor1" name="editor1" rows="10">	
						</textarea>
		
						<script>
							CKEDITOR.replace( 
								'editor1', 
								{
									fullPage: true,
									allowedContent: true,
									extraPlugins: 'wysiwygarea'
								}
							);
						</script>														
									
					</form>
				</div>
				<br style="clear: left;" />
			</div>
		</body>
	</html>

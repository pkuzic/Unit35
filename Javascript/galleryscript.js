	var imageData= new Array(10);		// Define an array to contain the image data
	createTwoDimensionalArray(3);		// call function 
	var initialvalue = 0;

	// Image path data

	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";		
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";
	imageData[0][0]= "";	imageData[0][1]= "";	imageData[0][2] = "";

	// Our index, boundry and scroll tracking variables
	var imageIndexFirst = 0;
	var imageIndexLast = 3;
	var continueScroll = 0;
	var maxIndex = 9;
	var minIndex = 0;
	
	// This function creates our two dimensional array
	function createTwoDimensionalArray(arraySize) 
	{
		for (i = 0; i < imageData.length; ++ i)
		imageData[i] = new Array(arraySize);
	}

	// This function preloads the thumbnail images
	function preloadThumbnails() 
	{
		imageObject = new Image();
		for (i = 0; i < imageData.length; ++ i)
			imageObject.src = imageData[i][0];
		
		handleThumbOnMouseOver(0);			
		scrollImages("initialise");
	}		


	// This function changes the text of a table cell
	function changeCellText(cellId,myCellData)
	{
		document.getElementById(cellId).innerHTML = myCellData;
//		alert("a");
	}

	// This function changes the images
	function changeImage(ImageToChange,MyimageData)
	{
		document.getElementById(ImageToChange).setAttribute('src',MyimageData)
//		alert("b");		
	}

	// This function changes the image alternate text
	function changeImageAlt(ImageToChange,imageData)
	{
		document.getElementById(ImageToChange).setAttribute('alt',imageData)
//		alert("c");		
	}

	// This function changes the image alternate text
	function changeImageTitle(ImageToChange,imageData)
	{
		document.getElementById(ImageToChange).setAttribute('title',imageData)
//		alert("d");
	}

	// This function changes the image onmouseover
	function changeImageOnMouseOver(ImageToChange,imageIndex)
	{
		document.getElementById(ImageToChange).setAttribute('onmouseover','handleThumbOnMouseOver(' + imageIndex + ');')
//		alert("e");		
	}

	// This function handles calling on change function
	// for a thumbnail onmouseover event
	function handleThumbOnMouseOver(imageIndex)
	{
//		alert("f");		
		changeImage('imageLarge',imageData[imageIndex][0]);
		changeCellText('imageTitleCell',imageData[imageIndex][1]);
		changeCellText('imageDescriptionCell',imageData[imageIndex][2]);
		changeImageAlt('imageLarge',imageData[imageIndex][1] + ' - ' + imageData[imageIndex][2]);
//		changeImageTitle('imageLarge',imageData[imageIndex][1] + ' - ' + imageData[imageIndex][2]);		// This line is responsible for the popu when you hover over the main image
//		alert("g");		
		
	}

	// This function handles the scrolling in both directions
	function scrollImages(scrollDirection) 
	{
		// We need a variable for holding our working index value
		var currentIndex;

//		alert("h");		

		if (scrollDirection == 'initialise')
		{
			currentIndex = 0;
			initialiseArrays(9);
			
//			alert("Scroll image function image = " + imageData[0][0]);
//			alert("Scroll image function title = " + imageData[0][1]);
//			alert("Scroll image function desc = "  + imageData[0][2]);
		
			// We set the color to black for both before we begin
			// If we reach the end during the process we'll change the "button" color to silver
			document.getElementById('scrollPreviousCell').setAttribute('style','color: Black')
			document.getElementById('scrollNextCell').setAttribute('style','color: Black')
				
			// Changescrollbar images in a set delay sequence to give a pseudo-animated effect
			currentIndex = imageIndexLast;
			changeImage('scrollThumb4',imageData[currentIndex][0]);
			changeImageOnMouseOver('scrollThumb4',currentIndex);
			currentIndex = imageIndexLast - 1;
			setTimeout("changeImage('scrollThumb3',imageData[" + currentIndex + "][0])",25);
			setTimeout("changeImageOnMouseOver('scrollThumb3'," + currentIndex + ")",25);
			currentIndex = imageIndexLast - 2;
			setTimeout("changeImage('scrollThumb2',imageData[" + currentIndex + "][0])",50);
			setTimeout("changeImageOnMouseOver('scrollThumb2'," + currentIndex + ")",50);
			currentIndex = imageIndexLast - 3;
			setTimeout("changeImage('scrollThumb1',imageData[" + currentIndex + "][0])",75);
			setTimeout("changeImageOnMouseOver('scrollThumb1'," + currentIndex + ")",75);

			// Wait and check to see if user is still hovering over button
			// This pause gives the user a chance to move away from the button and stop scrolling
			setTimeout("scrollAgain('" + scrollDirection + "')",1000);
			
			handleThumbOnMouseOver(0);


		}

		// Determine which direction to scroll - default is down (left)
		else if (scrollDirection == 'up')
		{
			// Only do work if we are not to the last image
			if (imageIndexLast != maxIndex)
			{
				// We set the color to black for both before we begin
				// If we reach the end during the process we'll change the "button" color to silver
				document.getElementById('scrollPreviousCell').setAttribute('style','color: Black')
				document.getElementById('scrollNextCell').setAttribute('style','color: Black')
				
				// Move our tracking indexes up one
				imageIndexLast = imageIndexLast + 1;
				imageIndexFirst = imageIndexFirst + 1;

				//  Change next "button" to silver if we are at the end
				if (imageIndexLast == maxIndex)
				{
					document.getElementById('scrollNextCell').setAttribute('style','color: Silver')
				}

				// Changescrollbar images in a set delay sequence to give a pseudo-animated effect
				currentIndex = imageIndexLast;
				changeImage('scrollThumb4',imageData[currentIndex][0]);
				changeImageOnMouseOver('scrollThumb4',currentIndex);
				currentIndex = imageIndexLast - 1;
				setTimeout("changeImage('scrollThumb3',imageData[" + currentIndex + "][0])",25);
				setTimeout("changeImageOnMouseOver('scrollThumb3'," + currentIndex + ")",25);
				currentIndex = imageIndexLast - 2;
				setTimeout("changeImage('scrollThumb2',imageData[" + currentIndex + "][0])",50);
				setTimeout("changeImageOnMouseOver('scrollThumb2'," + currentIndex + ")",50);
				currentIndex = imageIndexLast - 3;
				setTimeout("changeImage('scrollThumb1',imageData[" + currentIndex + "][0])",75);
				setTimeout("changeImageOnMouseOver('scrollThumb1'," + currentIndex + ")",75);

				// Wait and check to see if user is still hovering over button
				// This pause gives the user a chance to move away from the button and stop scrolling
				setTimeout("scrollAgain('" + scrollDirection + "')",1000);
			}
		}

		else
		{
			// Only do work if we are not to the first image
			if (imageIndexFirst != minIndex)
			{
				// We set the color to black for both before we begin
				// If we reach the end during the process we'll change the "button" color to silver
				document.getElementById('scrollPreviousCell').setAttribute('style','color: Black')
				document.getElementById('scrollNextCell').setAttribute('style','color: Black')
				
				// Move our tracking indexes down one
				imageIndexLast = imageIndexLast - 1;
				imageIndexFirst = imageIndexFirst - 1;

				//  Change previous "button" to silver if we are at the beginning
				if (imageIndexFirst == minIndex)
				{
					document.getElementById('scrollPreviousCell').setAttribute('style','color: Silver')
				}

				// Change scrollbar images in a set delay sequence to give a pseudo-animated effect
				currentIndex = imageIndexFirst;
				changeImage('scrollThumb1',imageData[currentIndex][0]);
				changeImageOnMouseOver('scrollThumb1',currentIndex);
				currentIndex = imageIndexFirst + 1;
				setTimeout("changeImage('scrollThumb2',imageData[" + currentIndex + "][0])",25);
				setTimeout("changeImageOnMouseOver('scrollThumb2'," + currentIndex + ")",25);
				currentIndex = imageIndexFirst + 2;
				setTimeout("changeImage('scrollThumb3',imageData[" + currentIndex + "][0])",50);
				setTimeout("changeImageOnMouseOver('scrollThumb3'," + currentIndex + ")",50);
				currentIndex = imageIndexFirst + 3;
				setTimeout("changeImage('scrollThumb4',imageData[" + currentIndex + "][0])",75);
				setTimeout("changeImageOnMouseOver('scrollThumb4'," + currentIndex + ")",75);
				
				// Wait and check to see if user is still hovering over button
				// This pause gives the user a chance to move away from the button and stop scrolling
				setTimeout("scrollAgain('" + scrollDirection + "')",1000);
			}
		}
	}

	// This function determines whether or not to keep scrolling
	function scrollAgain(scrollDirection)
	{
//		alert("i");		
		
		if (continueScroll == 1)
		{
			scrollImages(scrollDirection);
		}
	}

	// This function kicks off scrolling down (left)
	function scrollPrevious() 
	{
//		alert("j");		

		continueScroll = 1;
		scrollImages('down');
	}

	// This function kicks off scrolling up (right)
	function scrollNext() 
	{

//		alert("k");		
		
		continueScroll = 1;
		scrollImages('up');
	}

	// This function stops the scrolling action
	function scrollStop() 
	{
//		alert("l");		

		continueScroll = 0;
	}
	
	function ImageMapscrollPrevious()
	{

//		alert("m");		
		
		scrollPrevious();
		scrollStop();
	}
	
		function ImageMapscrollNext()
	{

//		alert("n");		
		
		scrollNext();
		scrollStop();
	}

	function initialiseArrays(numberOfFiles)
	{
	    var rawFile = new XMLHttpRequest();
	    var file = "";
	    var allText = "";
		var image = "";
	    var title = "";
	    var description = ""
	    var numberofvolumes = 2;
	    var volumeloopcount = 0;
	    var issueloopcount = 0;
	    var numberofissues = 4;
	    var arraysubscriptnumber = 0;
	    var filepath = "./Journals/";
	    
	    
		for (volumeloopcount = 1; volumeloopcount <= numberofvolumes; volumeloopcount++)
		{
			for (issueloopcount = 1; issueloopcount <= numberofissues; issueloopcount++)
			{
		  		file = filepath + "vol" + (volumeloopcount) + "iss" + (issueloopcount) + ".txt";
		    	rawFile.open("GET", file, false);
		    	rawFile.onreadystatechange = function ()
		    	{
		    	    if(rawFile.readyState === 4)
		    	    {
		    	        if(rawFile.status === 200 || rawFile.status == 0)
		    	        {
		    	            allText = rawFile.responseText;
		    	            image = allText.substring(0, 34);								//alert("Initialise Arrays function image = " + image);
		    	            title = allText.substring(image.length, image.length+28);		//alert("Initialise Arrays function title = " + title);	                
		    	            description = allText.substring(image.length + title.length);	//alert("Initialise Arrays function desc = " + description);
		    	            
		                	imageData[arraysubscriptnumber][0] = image;
			                imageData[arraysubscriptnumber][1] = title;
			                imageData[arraysubscriptnumber][2] = description;
			                arraysubscriptnumber++;
		            	}
		        	}
		    	}
		    	rawFile.send(null);
			}
		}
	}
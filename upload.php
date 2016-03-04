<?php
	/**
		Document 		: CDN/upload.php
		Description		: Authentication + Upload handler.
		Date 			: 2016-03-04
		Copyright (c) Prashant M. Shrestha (www.prashant.me)
	**/

	define('HOST', 'https://cdn.prashant.me/');
	// Change it => 1prashantmshrestha1 <- MD5
	define('_KEY', 'cbc0d1cfa4f7d27b0db6f0e125ef2793');
	// Change it => *1*prashantmshrestha*1* <- Salt
	define('SALT', '1');

	if(isset($_FILES['file']) && isset($_POST['securityKey'])){
		$ourKey = md5(SALT. $_POST['securityKey'] . SALT);
		if (strcmp(_KEY, $ourKey) === 0) {
		    // The key matches, therefore continue the upload!
		    // Generate a filename with unique md5(timestamp)!
		    $filename = md5(time()) . ".png";
		    // Save the file as the md5(timestamp) and save it as is.
			move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
			// Return the full path URL to the user!
			print_r(HOST . $filename);
		}else{
			// Joke around with the random non-authenticated user(s).
			print_r(json_encode("Are you sure you are allowed to do that?"));
		}
	}else{
		// Joke around with the random non-authenticated user(s).
		print_r(json_encode("You got some serious problem, snooping into someone else's stuff!"));
	}

	exit();
?>
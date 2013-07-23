<?php header('Content-Type:application/javascript; charset=UTF-8'); ?>
<?php

	// Define the javascript modules
	$modules = array(
		"validator.js",
		"np.js",
		"ajax.js",

		"functions.js",
		"collection.js",
		"infoContainer.js",
		"notification.js",
		"search.js",
		"select.js",
		"userSettings.js",

		"index.js",
		"bar.js",
		"members.js",
		"groups.js",
		"presenca.js",
		"projects.js"
	);

	$hashes = "";

	// Include the modules
	for ($i = 0; $i < count($modules); $i++) {
		include_once("modules/" . $modules[$i]);
		$hashes .= md5_file("modules/" . $modules[$i]);
	}

	echo "// Hash: " . md5($hashes) . "\n";
?>
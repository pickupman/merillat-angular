<?php
header('Content-type: application/json');
//if ( ! $data = apc_fetch('merillat_images')) {
	// Read all images in the folder
	$images = scandir(dirname(__FILE__) . '/doors');

	$data = array();
	foreach ($images as $image) {
		// skip . and ..
		if ($image == '.' OR $image =='..') continue;

			//Let create some data from filenames
			$file    = explode("-", $image);
			$door = preg_split('/(?=[A-Z53])/',$file[0]);
			array_shift($door);
			$door = implode(" ", $door);
			if (isset($file[1]) AND isset($file[2])) {
				$data[]  = array(
					'doors'   => $door,
					'species'   => $file[1],
					'finish' => substr($file[2], 0, -4),
					'image' => $image
				);
			}

	}
//	apc_store('merillat_images', $data, 600);
//}
echo json_encode($data);
public function createThumbnail($source_folder, $thumbs_folder, $source_file, $extension, $thumbHeight){
  	if ($extension == 'gif') {
			$imgt = "ImageGIF";
			$imgcreatefrom = "ImageCreateFromGIF";
		}else if($extension == 'jpg' || $extension == 'jpeg'){
			$imgt = "ImageJPEG";
			$imgcreatefrom = "ImageCreateFromJPEG";
		}else if ($extension == 'png') {
			$imgt = "ImagePNG";
			$imgcreatefrom = "ImageCreateFromPNG";
		}
		if ($imgt) {
			$img = $imgcreatefrom( $source_folder.$source_file.'.'.$extension );
			$width = imagesx( $img );
			$height = imagesy( $img );
     // keep aspect ratio with these operations...
			$new_width = floor( $width * ( $thumbHeight / $height ) );
			$new_height = $thumbHeight;
			$tmp_img = imagecreatetruecolor( $new_width, $new_height );
			if($extension == 'png'){
				// Disable alpha mixing and set alpha flag if is a png file
				imagealphablending($tmp_img, false);
				imagesavealpha($tmp_img, true);
			}
			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			$imgt( $tmp_img, $thumbs_folder.($source_file.'_'.$new_width.'x'.$new_height.'.'.$extension));
		}
	}
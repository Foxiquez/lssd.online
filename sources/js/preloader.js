var
	images 				= document.images,
	images_total_count 	= images.length,
	images_loaded_count = 0,
	preloader_img			= document.getElementById('preloader');

for (var i = 0; i < images_total_count; i++) 
{
	image_clone = new Image();
	image_clone.onload 	= image_loaded;
	image_clone.onerror = image_loaded;
	image_clone.src 	= images[i].src;
}

function image_loaded() {
	images_loaded_count++;
	preloader_img.style.width = ( ( (100/images_total_count) * images_loaded_count ) << 0 ) + '%';

	if (images_loaded_count >= images_total_count)
	{
		preloader_img.style.width = 'auto';
	}
}

jQuery(document).ready(function($){
    $('#upload-btn-1').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            var image_id = uploaded_image.toJSON().id;
            // Let's assign the url value to the input field
            $('#header_logo').val(image_url);
            $('#header_logo_id').val(image_id);
        });
        custom_uploader.open();
    });
    
    $('#upload-btn-2').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            var image_id = uploaded_image.toJSON().id;
            // Let's assign the url value to the input field
            $('#footer_logo').val(image_url);
            $('#footer_logo_id').val(image_id);
        });
        custom_uploader.open();
    });
});
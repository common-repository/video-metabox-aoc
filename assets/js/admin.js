var frame;
jQuery(document).on('click', '.aoc_vid_add', function (event) {
    event.preventDefault();
    // If the media frame already exists, reopen it.
    if (frame) {
        frame.open();
        return;
    }

    // Create a new media frame
    frame = wp.media({
        title: 'Select or upload the video',
        button: {
            text: 'Use this video'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });


    // When an image is selected in the media frame...
    frame.on('select', function () {

        // Get media attachment details from the frame state
        var attachment = frame.state().get('selection').first().toJSON();

        // Send the attachment URL to our custom video input field.
        jQuery('.aoc-vid-container').html('<div class="aoc-vid-wrap"><video width="320" height="240" controls><source src="' + attachment.url + '">Your browser does not support the video tag.</video><input type="hidden" name="aoc_video" id="aoc_vid_input_' + attachment.id + '" value="' + attachment.id + '"><button type="button" data-vid-id="' + attachment.id + '" class="aoc-del-vid">X</button></div>');

    });

    // Finally, open the modal on click
    frame.open();
});

jQuery(document).on('click', '.aoc-del-vid', function(){
   jQuery(this).parent().remove(); 
});
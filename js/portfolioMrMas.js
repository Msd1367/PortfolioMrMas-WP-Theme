jQuery(document).ready(function ($) {

    // Optional: Handle modal gallery interactions.
    $('#add-gallery-image').on('click', function (e) {
        e.preventDefault();
        $('#gallery-images-container').append('<div class="gallery-image-item"><input type="text" name="gallery_images[]" class="widefat" placeholder="Image URL" /></div>');
    });

    $('.embed-link a').on('click', function() {
        $(this).find('.link-box').css('background-color', '#0056b3');
    });

    $(".toggle-sidebar").on("click", function () {
        const sidebar = $(".portfolioMrMas-sidebar");
        const body = $("body");
        const fadedBackground = $(".faded-background");
    
        // Toggle the active state for the sidebar
        sidebar.toggleClass("active");
    
        // Lock/unlock the body scroll
        if (sidebar.hasClass("active")) {
            body.addClass("lock-scroll");
            fadedBackground.addClass("active");
        } else {
            body.removeClass("lock-scroll");
            fadedBackground.removeClass("active");
        }
    
        // Update the toggle icon
        const icon = $(this).find("i");
        if (sidebar.hasClass("active")) {
            icon.removeClass("fa-chevron-left").addClass("fa-chevron-right");
        } else {
            icon.removeClass("fa-chevron-right").addClass("fa-chevron-left");
        }
    });
    
    $(".faded-background").on("click", function () {
        const sidebar = $(".portfolioMrMas-sidebar");
        const body = $("body");
        const fadedBackground = $(".faded-background");
        const icon = $(".toggle-sidebar i");
    
        // Remove active state
        sidebar.removeClass("active");
        body.removeClass("lock-scroll");
        fadedBackground.removeClass("active");
        icon.removeClass("fa-chevron-right").addClass("fa-chevron-left");
    });
    

});
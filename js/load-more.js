jQuery(document).ready(function ($) {
    let loadMoreButton = $('#load-more');

    loadMoreButton.on('click', function () {
        let page = parseInt(loadMoreButton.data('page'));
        let newPage = page + 1;

        $.ajax({
            url: portfolioMrMas_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: newPage, // use the incremented page number
            },
            beforeSend: function () {
                loadMoreButton.text('Loading...');
            },
            success: function (response) {
                if (response === 'no_more_posts') {
                    loadMoreButton.text('No More Posts').prop('disabled', true);
                } else {
                    $('#post-container').append(response);
                    loadMoreButton.text('Load More').data('page', newPage); // update the button's data-page
                }
            },
            error: function () {
                loadMoreButton.text('Error. Try Again');
            },
        });
    });
});

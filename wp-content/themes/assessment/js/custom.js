jQuery(document).ready(function($) {
//For Dropdown Menu
    $('.has-dropdown > a').click(function(e) {
        e.preventDefault(); 
        var $this = $(this);
        var expanded = $this.attr('aria-expanded') === 'true';
        $this.attr('aria-expanded', !expanded);
        $this.siblings('.sub-menu').slideToggle();
    });
//For Mobile Menu
    $('.mobile-menu-toggle').click(function() {
        $('#mobile-navigation').addClass('active');
    });
    $('.close-navigation span').click(function(){
       $('#mobile-navigation').removeClass('active');
    });
//For Filter Ajax
    $('#projects-filter button').click(function(e) {
        e.preventDefault(); 

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_projects', 
                start_date: start_date,
                end_date: end_date
            },
            success: function(response) {
                $('.project-section .row').html(response);
            },
            error: function() {
                $('#projects-results').html('<p>An error occurred.</p>');
            }
        });
    });
});
define([
    'jquery'
], function($) {
    'use strict';

    return function() {
        $(document).ready(function() {
            var $faqContainer = $('.category-faq');
            
            // Hide all answer panels initially
            var $allPanels = $faqContainer.find('dd').hide();
            
            // Add 'last' class to the last question
            $faqContainer.find('dt').last().addClass('last');
            
            // Click event handler for FAQ questions
            $faqContainer.find('dt').click(function(e) {
                e.preventDefault();
                
                // Slide up all panels
                $allPanels.slideUp();
                
                // Slide down the clicked panel
                $(this).next('dd').slideDown();
                
                // Remove 'active' class from all questions
                $faqContainer.find('dt').removeClass('active');
                
                // Add 'active' class to clicked question
                $(this).addClass('active');
            });
        });
    };
});
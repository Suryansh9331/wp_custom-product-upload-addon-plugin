jQuery(function($) {
    // Track original price
    let originalPrice = null;

    // Function to update price dynamically
    function updatePrice(extraAmount) {
        const $priceElement = $('.woocommerce-Price-amount bdi'); // WooCommerce price selector
        
        if (!originalPrice) {
            // Save original price if not set
            originalPrice = parseFloat($priceElement.text().replace(/[^0-9.]/g, ''));
        }

        let newPrice = originalPrice + parseFloat(extraAmount);

        // Update price display
        $priceElement.text('₹' + newPrice.toFixed(2));
    }

    // Handle file upload event
    $('#custom_upload').on('change', function() {
        let extraAmount = $(this).data('price');

        if (this.files.length > 0) {
            $('#upload-price-notice').fadeIn(); // Show price notice
            updatePrice(extraAmount);
        } else {
            $('#upload-price-notice').fadeOut(); // Hide notice if file removed
            updatePrice(0);
        }
    });
});



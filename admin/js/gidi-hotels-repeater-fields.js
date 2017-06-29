(function($){
    $(document).ready(function() {
        /**
         * Gidi Hotels Repeater Fields
         */
        // Repeater fields inputs.
        $( '.gidi-hotel-repeater-container' ).on( 'click','.gidi-hotels-repeater-wrap a.insert', function() {
            $( this ).closest( '.gidi-hotels-repeater-wrap' ).find( 'tbody' ).append( $( this ).data( 'row' ) );
            return false;
        });
        $( '.gidi-hotel-repeater-container' ).on( 'click','.gidi-hotels-repeater-wrap a.delete',function() {
            $( this ).closest( 'tr' ).remove();
            return false;
        });

        // Repeater fields ordering.
        $( '.gidi-hotels-repeater-wrap tbody' ).sortable({
            items: 'tr',
            cursor: 'move',
            axis: 'y',
            handle: 'td.sort',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            helper: 'clone',
            opacity: 0.65
        });

        /**
         * Gidi Hotels Product Type Repeater Fields
         */
        // Repeater fields inputs.
        $( '#woocommerce-product-data' ).on( 'click','.gidi_repeater_fields a.insert', function() {
            $( this ).closest( '.gidi_repeater_fields' ).find( 'tbody' ).append( $( this ).data( 'row' ) );
            return false;
        });
        $( '#woocommerce-product-data' ).on( 'click','.gidi_repeater_fields a.delete',function() {
            $( this ).closest( 'tr' ).remove();
            return false;
        });

        // Repeater fields ordering.
        $( '.gidi_repeater_fields tbody' ).sortable({
            items: 'tr',
            cursor: 'move',
            axis: 'y',
            handle: 'td.sort',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            helper: 'clone',
            opacity: 0.65
        });
    });
})(jQuery);
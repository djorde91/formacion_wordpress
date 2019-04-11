( function( api ) {

	// Extends our custom "trade-hub" section.
	api.sectionConstructor['trade-hub'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

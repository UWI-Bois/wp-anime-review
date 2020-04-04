/*global ajaxurl*/
;(function( $ ) {
	$(document).ready(function() {
		// Hide the dashboard banner.
		$('.sg-button-hide-banner').on('click', function(e) {
			e.preventDefault();

			$('.banner--wizard, .banner-title').remove();


			$.post( $(this).attr('href') );
		})

		// Hide the dashboard banner.
		$('.btn--hide-notifications').on('click', function(e) {
			e.preventDefault();

			$('.important--notifications, .title-notifications').remove();

			$.post( $(this).attr('href') );
		})

		// Switch to default dashboard.
		$('.switch-dashboard').on('click', function(e) {
			e.preventDefault();

			var adminUrl = $(this).data('admin-url');

			$.ajax(
				$(this).attr('href')
			)
			.success(function () {
				window.location.href = adminUrl;
			})

		})

		// Switch to default dashboard.
		$('.sg-restart-wizard').on('click', function(e) {
			e.preventDefault();

			var adminUrl = $(this).data('admin-url');

			$.ajax(
				$(this).attr('href')
			)
			.success(function () {
				window.location.href = adminUrl;
			})
		})

		$('.sg-modals').appendTo('#wpwrap');

		$('.special-offer .sg-close-button').on('click', function(e) {
			e.preventDefault();
			let $this = $(this);

			$.ajax(
				$(this).attr('href')
			)
			.success(function (response) {
				$this.parents( '.box.special-offer' ).hide();
			})
		})

		$('.special-offer').on('click', '.install-button', function(e) {
			e.preventDefault();
			let $this = $(this);
			let $parent = $this.parents( '.box.special-offer' );
			let url = $this.attr('href')
			let button = $parent.find( '.install-button, .popup-button' )
			let buttonText = $parent.find( '.install-button .button__text, .popup-button .button__text' )
			$this.addClass( 'button-disabled' );

			$.ajax(
				url
			)
			.success(function (response) {
				button.addClass( 'button--outlined' ).removeClass( 'popup-button button-disabled install-button' );
				$parent.removeClass( 'special-offer' );
				$parent.find( '.sg-card-label' ).remove();
				$parent.find( '.sg-close-button' ).remove();

				button.attr('href', button.data( 'alt-link' ))
				buttonText.text(buttonText.data( 'alt-text' ))
			})
		})

		$('.sg-popup-close-button').on('click', function (e) {
			e.preventDefault();
			$('.dashboard-page').removeClass( 'sg-dialog-freez' )
			$( this ).parents('.sg-popup').addClass( 'sg-popup-hidden' );
			$( '.sg-dialog-wrapper' ).addClass( 'sg-dialog-hidden' );
		})

		$('.special-offer').on('click', '.popup-button', function(e) {
			e.preventDefault();
			let $this = $(this);
			let $parent = $this.parents( '.box.special-offer' );
			let url = $this.attr('href')
			let popupId = url.substring( url.indexOf( '#' ) );

			$('.dashboard-page').addClass( 'sg-dialog-freez' )

			$( popupId ).removeClass( 'sg-popup-hidden' );
			$( '.sg-dialog-wrapper' ).removeClass( 'sg-dialog-hidden' );
		})
	})
})( jQuery )

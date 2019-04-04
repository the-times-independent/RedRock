jQuery(document).ready(function($) {
	$('#jetpack-notice .notice-dismiss').click(function() {
		data = {
			action: 'redrock_jetpack_admin_notice',
			redrock_jetpack_admin_nonce: redrock_jetpack_admin.redrock_jetpack_admin_nonce
		};
		$.post( ajaxurl, data );

		return false;
	});
});
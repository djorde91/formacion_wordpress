"use strict";
function gm_authFailure() {
    jQuery("#map").remove();
    jQuery("#error-api-key").removeClass("hide");
    var addr = jQuery("#address").val();
    jQuery("#address").parent().empty();
    jQuery(".venue_info").find(".venue_field:first td:last").append('<input type="text" name="address" id="address" autocomplete="off" placeholder="Address..." value="' + addr +'">');
    jQuery(".event_venue_info").find(".venue_field:nth-child(2) td:last").append('<input type="text" name="address" id="address" autocomplete="off" placeholder="Address..." value="' + addr +'">');
}
jQuery(document).ready(function(){
    var saveButton = jQuery(".gd_calendar_save_api_key_button");
    if (saveButton.length) {
        saveButton.on('click', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            // var key = jQuery(this).closest("form").find(".gd_calendar_api_key_input").val();
            var key = jQuery(".gd_calendar_api_key_input").eq(0).val();
            if ( key != undefined ) {
                var data = {
                    action: 'gd_calendar_save_api_key',
                    api_nonce: gdCalendarAdminApiKeyObj.apiKeyNonce,
                    api_key: key
                };
                jQuery.ajax({
                    url: gdCalendarAdminApiKeyObj.ajaxUrl,
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function (xhr) {
                        _this.attr("disabled", true);
                        _this.parent().find(".spinner").css("visibility", "visible");
                    }
                }).done(function(result){
                    if (result.success === 0) {
                        alert('API KEY CANNOT BE EMPTY');
                        return false;
                    }
                    if (result.success === 1) {
                        setTimeout(function () {
                            var successNotice = "<div id='gd_calendar_api_key_success' class='notice notice-success is-dismissible'>" +
                                "<p class='map_api_info'>" + gdCalendarAdminApiKeyObj.mapApiInfo + "</p>" +
                                "<button type='button' class='notice-dismiss'><span class='screen-reader-text'>" + gdCalendarAdminApiKeyObj.noticeDismiss + "</span></button>" +
                                "</div>";
                            var bigNotice = jQuery("#gd_calendar_no_api_key_big_notice"),
                                freeBanner = jQuery(".free_version_banner"),
                                screenMeta = jQuery("#screen-meta"),
                                apiForm = jQuery(".gd_calendar_main_api_form");

                            if (bigNotice.length ) {
                                bigNotice.replaceWith(successNotice);
                            } else if (freeBanner.length) {
                                freeBanner.after(successNotice);
                            } else if (screenMeta.length) {
                                screenMeta.after(successNotice);
                            } else {
                                jQuery("#wpbody-content").prepend(successNotice);
                            }
                            jQuery("#gd_calendar_api_key_success .notice-dismiss").on("click", function () {
                                jQuery(this).parent().remove();
                            });

                            if (apiForm.length && apiForm.hasClass("hide")) {
                                apiForm.removeClass("hide");
                                apiForm.find(".gd_calendar_api_key_input").val(key);
                            }
                        }, 1500);
                        setTimeout(function () {
                            location.reload();
                        },2500);
                    }
                }).always(function(){
                    var form = _this.closest("form");
                    _this.removeAttr('disabled');
                    if (form.hasClass("gd_calendar_main_api_form")) {
                        form.find("button").css("visibility", "hidden");
                    }
                    form.find(".spinner").css("visibility", "hidden");
                })
            }
            return false;
        });
    }
    jQuery(".gd_calendar_main_api_form .gd_calendar_api_key_input").on("keyup", function () {
        if (jQuery(this).val() != "") {
            jQuery(this).closest("form").find("button").css("visibility", "visible");
        }
    });

    jQuery('#gd_calendar_no_api_key_big_notice .hide_notification_button').on('click', function(){
       jQuery('#gd_calendar_no_api_key_big_notice').hide();
       return false;
    });
});
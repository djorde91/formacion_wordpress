"use strict";

jQuery(document).ready(function() {
    var select_all = jQuery('input#select-all');
    select_all.on('change',function () {
        if(this.checked){
            jQuery('input.item-checkbox').prop('checked', true);
        } else{
            jQuery('input.item-checkbox').prop('checked', false);
        }
    });

    jQuery('.item-checkbox').on('change', function () {
        if(jQuery(".item-checkbox").length === jQuery(".item-checkbox:checked").length) {
            select_all.attr("checked", "checked");
        } else {
            select_all.removeAttr("checked");
        }
    });

    // Theme save button make fixed

    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() >= 300) {
            if (jQuery(".theme-save-head").hasClass("theme-save-fixed") === false) {
                jQuery(".theme-save-head").addClass("theme-save-fixed");
            }
        }
        else {
            if (jQuery(".theme-save-head ").hasClass("theme-save-fixed")) {
                jQuery(".theme-save-head").removeClass("theme-save-fixed");
            }
        }
    });

    // Save Theme settings

    var doingAjax = false;
    jQuery('#gd_calendar_theme_save_form').on('submit', function (e) {
        e.preventDefault();

        if (doingAjax) return false;

        var form = jQuery('#gd_calendar_theme_save_form'),
            submitBtn = form.find('input[type=submit]'),
            formData = form.serialize(),
            data = {
                action: "theme_save_settings",
                nonce: gdCalendarThemesJsObj.gdNonceThemeSettings,
                formdata: formData
            };

        jQuery.ajax({
            url: gdCalendarThemesJsObj.ajaxUrl,
            method: 'post',
            data: data,
            dataType: 'text',
            beforeSend: function () {
                doingAjax = true;
                submitBtn.attr("disabled", 'disabled');
                submitBtn.parent().find(".spinner").css("visibility", "visible");
            }
        }).always(function () {
            doingAjax = false;
            submitBtn.removeAttr("disabled");
            submitBtn.parent().find(".spinner").css("visibility", "hidden");
        }).done(function (response) {

            if (response === 'ok') {
                toastr.success('Saved Successfully');
            } else {
                toastr.error('Error while saving');
            }
        }).fail(function () {
            toastr.error('Error while saving');
        });

        return false;
    });

    jQuery('.gd_calendar_theme_option_body').masonry();
    jQuery('.gd_calendar_theme_section_heading').on('click', function () {
        var section = jQuery(this).closest('.gd_calendar_theme_section_wrap');
        section.toggleClass('active');
        jQuery('.gd_calendar_theme_option_body').masonry();
    });

});

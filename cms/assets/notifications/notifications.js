/**
 * Theme: Moltran Admin Template
 * Author: Coderthemes
 * Notification
 */

!function ($) {
    "use strict";

    var Notification = function () {
    };

    //simple notificaiton
    Notification.prototype.notify = function (style, position, title, text) {
        var icon = 'fa fa-adjust';
        if (style == "error") {
            icon = "fa fa-exclamation";
        } else if (style == "warning") {
            icon = "fa fa-warning";
        } else if (style == "success") {
            icon = "fa fa-check";
        } else if (style == "info") {
            icon = "fa fa-question";
        } else {
            icon = "fa fa-adjust";
        }
        $.notify({
            title: title,
            text : text,
            image: "<i class='" + icon + "'></i>"
        }, {
            style         : 'metro',
            className     : style,
            globalPosition: position,
            showAnimation : "show",
            showDuration  : 0,
            hideDuration  : 0,
            autoHide      : false,
            clickToHide   : true
        });
    },

        //auto hide notification
        Notification.prototype.autoHideNotify = function (style, position, title, text) {
            var icon = "fa fa-adjust";
            if (style == "error") {
                icon = "fa fa-exclamation";
            } else if (style == "warning") {
                icon = "fa fa-warning";
            } else if (style == "success") {
                icon = "fa fa-check";
            } else if (style == "info") {
                icon = "fa fa-question";
            } else {
                icon = "fa fa-adjust";
            }
            $.notify({
                title: title,
                text : text,
                image: "<i class='" + icon + "'></i>"
            }, {
                style         : 'metro',
                className     : style,
                globalPosition: position,
                showAnimation : "show",
                showDuration  : 0,
                autoHideDelay : 7000,
                hideDuration  : 0,
                autoHide      : true,
                clickToHide   : true
            });
        },
        //confirmation notification
        Notification.prototype.confirm = function (style, position, title, text, callback) {
            var icon = "fa fa-adjust";
            if (style == "error") {
                icon = "fa fa-exclamation";
            } else if (style == "warning") {
                icon = "fa fa-warning";
            } else if (style == "success") {
                icon = "fa fa-check";
            } else if (style == "info") {
                icon = "fa fa-question";
            } else {
                icon = "fa fa-adjust";
            }
            $.notify({
                title: title,
                text : text + '<div class="clearfix"></div><br><a id="yesConfirmBtn" class="btn btn-sm btn-default yes">Yes</a><a id="noConfirmBtn"  class="btn btn-sm btn-danger no">No</a>',
                image: "<i class='" + icon + "'></i>"
            }, {
                style         : 'metro',
                className     : style,
                globalPosition: position,
                showAnimation : "show",
                showDuration  : 0,
                hideDuration  : 0,
                autoHide      : false,
                clickToHide   : false
            });

            function removeEvents() {
                $(document).off('click', '.notifyjs-metro-base .no', noClick);
                $(document).off('click', '.notifyjs-metro-base .yes', yesClick);
            }

            function noClick() {
                //programmatically trigger propogating hide event
                $(this).trigger('notify-hide');
                removeEvents();
            }


            function yesClick () {
                //callback when user clicks
                callback();

                //hide notification
                $(this).trigger('notify-hide');
                removeEvents();
            }


            $(document).on('click', '.notifyjs-metro-base .no', noClick);
            $(document).on('click', '.notifyjs-metro-base .yes', yesClick);
        },
        //init - examples
        Notification.prototype.init = function () {

        },
        //init
        $.Notification = new Notification, $.Notification.Constructor = Notification
}(window.jQuery),

//initializing 
    function ($) {
        "use strict";
        $.Notification.init()
    }(window.jQuery);

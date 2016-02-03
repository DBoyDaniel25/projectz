/**
 * Created by prince on 12/9/15.
 */
var Notify = function () {

};

/**
 * Creates and Error Message, displays message if text is set
 * @returns {Notify}
 */
Notify.prototype.error = function (body, title) {
    var titleText = title || "Error";
    $.Notification.autoHideNotify('error', 'top right', titleText, body);
    return this;
};

/**
 * Creates Info Message, displays message if text is set
 * @returns {Notify}
 */
Notify.prototype.info = function (body, title) {
    var titleText = title || "Information";
    $.Notification.autoHideNotify('info', 'top right', titleText, body);
    return this;
};

/**
 * Creates a Success Message, displays message if text is set
 * @returns {Notify}
 */
Notify.prototype.success = function (body, title) {
    var titleText = title || "Success";
    $.Notification.autoHideNotify('success', 'top right', titleText, body);
    return this;
};


Notify.prototype.confirmDelete = function (body, title, cb) {
    var titleText = title || "Hold On!";
    $.Notification.confirm('error','center', titleText, body, cb);
    return this;
};
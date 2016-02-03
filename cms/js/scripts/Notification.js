/**
 * Created by prince on 12/9/15.
 */
var Notification = function () {

};

/**
 * Creates and Error Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.error = function (text) {

    return this;
};

/**
 * Creates Info Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.info = function (body, title) {
    var titleText = title || "Information";
    $.Notification.autoHideNotify('info', 'top right', titleText, body);
    return this;
};

/**
 * Creates a Success Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.success = function (text) {

    return this;
};

/**
 * Sets a loading bar
 * @param msg Message to show as loading text
 */
Notification.prototype.processing = function (msg) {

};

/**
 * Clears processing icon
 * @param func Callback function
 */
Notification.prototype.clearProcessing = function (func) {

};

/**
 * Sets the text of the notification
 * @param text
 */
Notification.prototype.text = function (text) {

};

/**
 * Hides the notification
 * @returns {Notification}
 */
Notification.prototype.hide = function () {

    return this;
};
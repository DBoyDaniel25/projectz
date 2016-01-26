/**
 * Created by prince on 12/9/15.
 */
var Notification = function () {
    this.notification = document.querySelector("#notification");
    this.interval     = null;
};

/**
 * Creates and Error Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.error = function (text) {
    this.notification.setAttribute("class", "alert_error");
    this.notification.textContent = text;
    return this;
};

/**
 * Creates Info Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.info = function (text) {
    this.notification.setAttribute("class", "alert_info");
    this.notification.textContent = text;
    return this;
};

/**
 * Creates a Success Message, displays message if text is set
 * @returns {Notification}
 */
Notification.prototype.success = function (text) {
    this.notification.setAttribute("class", "alert_success");
    this.notification.textContent = text;
    return this;
};

/**
 * Sets a loading bar
 * @param msg Message to show as loading text
 */
Notification.prototype.processing = function (msg) {
    // set notification bar visible
    this.notification.setAttribute("class", "alert_info");
    var dots = ".",
        self = this,
        loadMessage;
    if (msg) {
        loadMessage = msg;
    } else {
        loadMessage = "Processing";
    }

    this.interval = setInterval(function () {
        self.text(loadMessage + dots);
        if (dots.length === 4) {
            dots = ".";
        }
        dots += ".";
    }, 1000);
};

/**
 * Clears processing icon
 * @param func Callback function
 */
Notification.prototype.clearProcessing = function (func) {
    clearInterval(this.interval);
    if (func) {
        func.call(this);
    } else {
        this.success("Success");
    }
};

/**
 * Sets the text of the notification
 * @param text
 */
Notification.prototype.text = function (text) {
    this.notification.textContent = text;
};

/**
 * Hides the notification
 * @returns {Notification}
 */
Notification.prototype.hide = function () {
    this.notification.setAttribute("class", "hide");
    return this;
};
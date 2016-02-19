/**
 * Created by Daniel Prince on 1/14/16.
 * Manager Class to handle client to server communications
 * for database tables
 */

/**
 * Manager Constructor
 * @constructor
 */
var Manager = function (processFile) {
    var ENV          = "local";
    this.notif       = new Notify();
    this.processFile = processFile;
    // local: http://localhost/versatile/projectz/cms/
    // prod:  http://myprincess.esy.es/cms/
    if (ENV === "local") {
        // production
        this.hostName = "http://localhost/web/projectz/cms/";
    } else {
        // local
        this.hostName = "http://myprincess.esy.es/cms/";
    }
};


Manager.prototype.performRequest = function (successCB, failureCB, data, method) {
    this.ajaxRequest(successCB, failureCB, data, method);
};

Manager.prototype.performCreate = function (data) {
    data.create = "create";
    this.notif.info("Creating");
    var self      = this;
    var successCB = function (text) {
        console.log(text);
        if (text.indexOf("true") !== -1) {
            var form = new Validate();
            self.notif.success("Item has been created", "Successfully created");
            form.resetForm();
        } else {
            self.notif.error("Could not be created...");
        }
    }, failCB     = function () {
        this.Success("false");
    };
    this.ajaxRequest(successCB, failCB, data);
};

Manager.prototype.performUpdate = function (data, updateMethod) {
    data.update = "update";
    this.notif.info("Updating");
    var self      = this;
    var successCB = function (text) {
        console.log(text);
        if (text.indexOf("true") !== -1) {
            self.notif.success("Item has been Updated", "Successfully Updated");
            // updates row with new data
            updateMethod(data, text);
        } else {
            self.notif.error("Could not be updated...");
        }
    }, failCB     = function () {
        this.Success("false");
    };

    this.ajaxRequest(successCB, failCB, data);
};


Manager.prototype.performDelete = function (data) {
    data.delete = "delete";
    var self = this;
    this.notif.confirmDelete("Are you sure?", "Delete this Item?", function () {
        self.notif.info("Deleting");
        var successCB = function (text) {
            if (text.indexOf("true") !== -1) {
                self.notif.success("Item has been deleted", "Successfully Deleted");
                var form  = new Validate(),
                    table = new Table();
                form.resetForm();
                table.removeRow(data.id);
            } else {
                self.notif.error("Could not be deleted...");
            }
        }, failCB     = function () {
            this.Success("false");
        };
        self.ajaxRequest(successCB, failCB, data);
    });
};


Manager.prototype.ajaxRequest = function (successCallback, failureCallback, data, method) {
    var self          = this;
    var dataToProcess = data || {};
    var methodType = method || "POST";
    Ajaxify({
        host        : self.hostName + "Backend/manage/" + self.processFile,
        data        : [dataToProcess],
        responseType: "text",
        method      : methodType,
        execute     : true,
        Success     : successCallback,
        Failure     : failureCallback
    });
};
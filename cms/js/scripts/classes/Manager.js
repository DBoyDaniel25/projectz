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
    var ENV   = "local";
    this.processFile = processFile;
    // local: http://localhost/versatile/projectz/cms/
    // prod:  http://myprincess.esy.es/cms/
    if(ENV === "local"){
        // production
        this.hostName = "http://localhost/web/projectz/cms/";
    }else {
        // local
        this.hostName = "http://myprincess.esy.es/cms/";
    }
};


Manager.prototype.performCreate = function (notification, data) {
    data.create = "create";
    var successCB = function (text) {
        console.log(text);
        notification.clearProcessing(function () {
            if (text.indexOf("true") !== -1) {
                this.success("Created Successfully");
                var form = new Validate();
                form.resetForm();
            } else {
                this.error("Could not be created...");
            }
        });
    }, failCB = function () {
        this.Success("false");
    };

    notification.processing("Creating");
    this.ajaxRequest(successCB, failCB, data);
};

Manager.prototype.performUpdate = function (notification, data, updateMethod) {
    data.update = "update";
    var successCB = function (text) {
        console.log(text);
        notification.clearProcessing(function () {
            if (text.indexOf("true") !== -1) {
                this.success("Updated Successfully");
                // updates row with new data
                updateMethod(data, text);
            } else {
                this.error("Could not be updated...");
            }
        });
    }, failCB = function () {
        this.Success("false");
    };

    notification.processing("Updating");
    this.ajaxRequest(successCB, failCB, data);
};


Manager.prototype.performDelete = function (notification, data) {
    if(confirm("Are you sure you want to delete this?")) {
        data.delete = "delete";
        var successCB = function (text) {
            notification.clearProcessing(function () {
                if (text.indexOf("true") !== -1) {
                    this.success("Deleted Successfully");
                    var form = new Validate(),
                        table = new Table("#tbody");
                    form.resetForm();
                    table.removeRow(data.id);
                } else {
                    this.error("Could not be deleted...");
                }
            });
        }, failCB = function () {
            this.Success("false");
        };
        notification.processing("Deleting");
        this.ajaxRequest(successCB, failCB, data);
    }
};


Manager.prototype.ajaxRequest = function (successCallback, failureCallback, data) {
    var self = this;
    var dataToProcess = data || {};
    Ajaxify({
        host :  self.hostName + "Backend/manage/" +  self.processFile,
        data: [dataToProcess],
        responseType: "text",
        method : "POST",
        execute: true,
        Success: successCallback,
        Failure : failureCallback
    });
};
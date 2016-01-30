/**
 * Created by Daniel Prince on 1/15/16.
 *
 * This file is the base for all Schema Classes
 * The class constructor expects the name of form field ID's of the input element
 * Where "id" must be the first argument passed in
 */

/**
 * Takes in all field ID's as arguments and creates properties of it
 * @constructor
 */
var Structure = function (fields) {
    this.fieldNames = [];
    // add all field names
    for (var i = 0; i < fields.length; i++) {
        this.fieldNames.push(fields[i]);
    }

    // create properties
    for (i = 0; i < this.fieldNames.length; i++) {
        this[this.fieldNames[i]] = "no-data";
    }
};

/**
 * Chainable
 * Gets form inputs and set it to the current instance properties
 * @param getId boolean To retrieve the ID if its set on the form
 * @param setValForImage boolean If to set a default value if a image was not set
 */
Structure.prototype.getFormValues = function (getId, setValForImage) {
    for (var i = 0; i < this.fieldNames.length; i++) {
        if (this.fieldNames[i] !== "id" && this.fieldNames[i].toLowerCase().indexOf("file") === -1 && this.fieldNames[i].toLowerCase().indexOf("mce") === -1 && this.fieldNames[i].toLowerCase().indexOf("checkbox") === -1) {
            this[this.fieldNames[i]] = document.querySelector("#" + this.fieldNames[i]).value;
        }

        if (this.fieldNames[i].toLowerCase().indexOf("file") !== -1) {
            var file = document.querySelector("#" + this.fieldNames[i]).files[0];
            if (setValForImage) {
                this[this.fieldNames[i]] = file || "imhere";
            } else {
                this[this.fieldNames[i]] = file || "";
            }
        }

        if(this.fieldNames[i].toLowerCase().indexOf("checkbox") !== -1){
            var val = document.querySelector("#" + this.fieldNames[i]).checked;
            if(val){

                this[this.fieldNames[i]] = "true";
            }else {
                this[this.fieldNames[i]] = "false";
            }
        }

        if (this.fieldNames[i].toLowerCase().indexOf("mce") !== -1) {
            this[this.fieldNames[i]] = tinyMCE.get(this.fieldNames[i]).getContent();
        }
    }

    if (getId) {
        this[this.fieldNames[0]] = document.querySelector("#" + this.fieldNames[1]).getAttribute("data-id");
    }

    return this;
};

/**
 * Chainable
 * Populate the form with the the current instance properties
 * @param setId boolean Whether to set the ID on the form or not
 */
Structure.prototype.populateForm = function (setId) {
    for (var i = 0; i < this.fieldNames.length; i++) {
        if (this.fieldNames[i] !== "id" && this.fieldNames[i].toLowerCase().indexOf("file") === -1 && this.fieldNames[i].toLowerCase().indexOf("checkbox") === -1 && this.fieldNames[i].toLowerCase().indexOf("select") === -1) {
            document.querySelector("#" + this.fieldNames[i]).value = this[this.fieldNames[i]];
        }

        if (this.fieldNames[i].toLowerCase().indexOf("checkbox") !== -1) {
            //noinspection RedundantIfStatementJS
            if (this[this.fieldNames[i]] === "true") {
                document.querySelector("#" + this.fieldNames[i]).checked = true;
            } else {
                document.querySelector("#" + this.fieldNames[i]).checked = false;
            }
        }

        if (this.fieldNames[i].toLowerCase().indexOf("select") !== -1) {
            document.querySelector("#" + this.fieldNames[i]).value = this[this.fieldNames[i]];
        }



        if (this.fieldNames[i].toLowerCase().indexOf("mce") !== -1) {
            tinyMCE.get(this.fieldNames[i]).setContent(this[this.fieldNames[i]]);
        }
    }
    if (setId) {
        document.querySelector("#" + this.fieldNames[1]).setAttribute("data-id", this[this.fieldNames[0]]);
    }
    return this;
};

/**
 * Retrieve object with key values of the current instance
 * @returns {{}}
 */
Structure.prototype.getValues = function () {
    var object = {};
    for (var i = 0; i < this.fieldNames.length; i++) {
        object[this.fieldNames[i]] = this[this.fieldNames[i]];
    }
    return object;
};

/**
 * Needs to be overridden
 * @param data
 */
Structure.prototype.updateTable = function (data, response) {

};

Structure.prototype.hasId = function () {
    return this[this.fieldNames[0]] !== "no-data";
};


/**
 * Chainable
 * Get the data from an element
 * @param element
 */
Structure.prototype.getEditButtonData = function (element) {
    for (var i = 0; i < this.fieldNames.length; i++) {
        this[this.fieldNames[i]] = element.getAttribute("data-" + this.fieldNames[i].toLowerCase());
    }
    return this;
};


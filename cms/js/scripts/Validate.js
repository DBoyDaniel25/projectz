/**
 * Created by prince on 12/9/15.
 */

(function (global) {

    var Validate = function (errorHolder) {
        if (arguments.length >= 3) {
            return new Validate.init(arguments[0], arguments[1], arguments[2]);
        } else {
            return new Validate.init(errorHolder);
        }
    };
    // private fields
    var msgs = {// error msgs
        empty: "Fill in all empty fields!."
    };

    // private methods
    var isEmpty                 = function (value) {
            var exp = /[a-zA-z0-9]/;
            // return the opposite of what was evaluated
            // if evaluated to false meaning it failed return true
            // so it's empty

            // if evaluated to true meaning it passed return false
            // so it means it's not empty
            return !exp.test(value);
        },
        passSpecifiedLength     = function (val, maxLength) {
            return val.length > maxLength;
        },
        displayErrors           = function (errorHolder, errors) {
            var html = "";
            if(errors.length > 0){
                html += "<ul>";
                for (var i = 0; i < errors.length; i++) {
                    html += "<li>";
                    html += errors[i];
                    html += "</li>"
                }
                html += "</ul>";
            }
            errorHolder.innerHTML = html;
        },

        evaluateSpecifiedParams = function (obj, specificArr) {
            /**
             * specificArr = [
             *     {
                 *          property : <name of property on object>,
                 *          length : max length for this property,
                 *          msg : error message for if it fails
                 *     }
             * ]
             * */
            var specific = specificArr,
                current,
                key;
            if (specific) {
                for (var i = 0; i < specific.length; i++) {
                    for (key in specific[i]) {
                        if (specific[i].hasOwnProperty(key) && key !== "length" && key !== "msg") {
                            current = specific[i];
                            // checking for length
                            if (passSpecifiedLength(obj[current[key]], current.length)) {
                                this.errors.push(current["msg"] + " Max length is " + current.length + ". Your length " + obj[current[key]].length);
                            }
                        }
                    }// end of for in loop
                }// end of for loop
            }
        };

    Validate.prototype = {
        /**
         *
         * @param {{}}         obj
         * @param {{}}         options
         * @param {boolean}    options.checkIsEmpty bool
         * @param {[{}]}       options.specific
         * @param {[{string}]} options.specific.property
         * @param {[{int}]}    options.specific.length
         * @param {[{string}]} options.specific.msg
         */
        validate: function (obj, options) {
            var key;// key for each object iteration

            // set default value for checkIsEmpty
            options              = options || {};
            options.checkIsEmpty = options.checkIsEmpty || true;

            // loop through each object property
            for (key in obj) {
                // make sure th key is on the current objects prototype
                if (obj.hasOwnProperty(key)) {
                    // check if the option to check if value is empty is on
                    // then validate
                    if (options.checkIsEmpty) {
                        if (isEmpty(obj[key])) { // returns false if it is empty
                            this.errors.push(msgs.empty);
                            // empty message is already set so no need to continue
                            options.checkIsEmpty = false;
                            break;
                        }
                    }// end of checking is a value is empty
                }
            }// end of for in loop

            if (options.specific) {
                // check to see if specific values need specific testing such as length
                evaluateSpecifiedParams.call(this, obj, options.specific);
            }

            displayErrors(this.errorBlk, this.errors);

            if (this.errors.length !== 0) {
                this.errors = [];
                return true;
            } else {
                return false;
            }
        },
        resetForm : function(){
            var form = document.querySelector('form[role="form"]');
            if(form !== null){
                form.reset();
                this.errorBlk.innerHTML = "";
            }
        }
    };

    Validate.init = function (errorHolder) {
        // hold any errors encountered
        this.errors = [];
        var msg,
            holder,
            obj,// object to validate
            options;// options to apply for validation

        if (arguments.length >= 3) {
            holder  = arguments[0];
            obj     = arguments[1];
            options = arguments[2];
        } else {
            holder = errorHolder;
        }

        if (holder) {
            this.errorBlk = document.querySelector(holder);
            msg           = "Error Holder, element given, was not found."
        } else {
            this.errorBlk = document.querySelector("#errorBlk");
            msg           = "No error holder element was specified!";
        }

        if (this.errorBlk === null) {
            throw new Error(msg);
        }

        if (arguments.length >= 3) {
            this.validate(obj, options);
        }
    };

    Validate.init.prototype = Validate.prototype;
    /**
     * Takes either the errorHolder alone
     * or all three params for validation which are
     * errorHolder, object to process, and options
     * @type {Validate}
     */
    global.Validate = Validate;
})(window);

/*
 E.G

 var obj = {
 firstname: "Daniel",
 lastname : "Prince",
 month    : "Dec",
 year     : ""
 },
 options = {
 checkIsEmpty: true,
 specific    : [
 {
 property: "firstname",
 length  : 5,
 msg     : "Firstname is to long."
 },
 {
 property: "lastname",
 length  : 6,
 msg     : "Lastname is to long."
 },
 {
 property: "month",
 length  : 2,
 msg     : "Month is to long."
 }
 ]
 };

 Validate(null, obj, options);
 */
/**
 * Created by prince on 12/9/15.
 */
var Validate = function () {

};

Validate.prototype.isFieldsEmpty = function (obj) {
    var expression = /[a-zA-Z0-9]/;
    for(var key in obj){
        if(obj.hasOwnProperty(key)){
            if(expression.test(obj[key]) === false){
                return true;
            }
        }
    }
    return false;
};

Validate.prototype.resetForm = function () {
    document.querySelector("form").reset();
};
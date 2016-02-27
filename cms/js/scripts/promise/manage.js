/**
 * Created by evolutionarycoder on 2/4/16.
 */
var submitBtn = document.querySelector("#create"),
    manage    = new Manager("promise.php"),
    notif     = new Notify(),
    validate  = Validate(),
    promise,
    options   = {
        checkIsEmpty: true,
        specific    : [
            {
                property: "promise",
                length  : 500,
                msg     : "Promise has to many characters."
            }
        ]
    };

if (submitBtn) {
    promise = new Promise("promise");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = promise.getFormValues().getValues();
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    promise       = new Promise("id", "promise");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = promise.getFormValues(true).getValues();
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, promise.updateTable);
    }, false)
}
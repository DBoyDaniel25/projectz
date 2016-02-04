/**
 * Created by evolutionarycoder on 2/4/16.
 */
var submitBtn = document.querySelector("#create"),
    manage    = new Manager("promise.php"),
    notif     = new Notify(),
    validate  = new Validate(),
    promise;

if (submitBtn) {
    promise = new Promise("promise");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = promise.getFormValues().getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    promise         = new Promise("id", "promise");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = promise.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, promise.updateTable);
    }, false)
}
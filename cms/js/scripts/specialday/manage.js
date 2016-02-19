/**
 * Created by evolutionarycoder on 2/19/16.
 */

var submitBtn = document.querySelector("#create"),
    manage    = new Manager("specialday.php"),
    notif     = new Notify(),
    validate  = new Validate(),
    specialday;

if (submitBtn) {
    specialday = new SpecialDay("date", "message");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = specialday.getFormValues().getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    specialday    = new SpecialDay("id", "date", "message");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = specialday.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, specialday.updateTable);
    }, false)
}
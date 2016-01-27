/**
 * Created by Daniel Prince on 1/27/16.
 */
var submitBtn = document.querySelector("#create"),
    manage    = new Manager("ilove.php"),
    notif     = new Notification(),
    validate  = new Validate(),
    ilove;

if (submitBtn) {
    ilove = new ILove("ilove");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = ilove.getFormValues().getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(notif, data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    ilove         = new Poem("id", "ilove");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = ilove.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(notif, data, ilove.updateTable);
    }, false)
}
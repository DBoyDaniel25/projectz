/**
 * Created by Daniel Prince on 1/27/16.
 */
var submitBtn = document.querySelector("#create"),
    manage    = new Manager("ilove.php"),
    notif     = new Notify(),
    validate  = new Validate(),
    ilove;

if (submitBtn) {
    ilove = new ILove("ilove");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = ilove.getFormValues().getValues();
        console.log(data);
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    ilove         = new ILove("id", "ilove");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = ilove.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, ilove.updateTable);
    }, false)
}
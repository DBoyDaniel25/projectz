/**
 * Created by evolutionarycoder on 2/4/16.
 */


var submitBtn = document.querySelector("#create"),
    manage    = new Manager("memory.php"),
    notif     = new Notify(),
    validate  = new Validate(),
    memory;

if (submitBtn) {
    memory = new Memory("memory");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = memory.getFormValues().getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    memory        = new Memory("id", "memory");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = memory.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, memory.updateTable);
    }, false)
}
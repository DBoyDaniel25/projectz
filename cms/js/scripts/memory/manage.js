/**
 * Created by evolutionarycoder on 2/4/16.
 */


var submitBtn = document.querySelector("#create"),
    manage    = new Manager("memory.php"),
    notif     = new Notify(),
    validate  = Validate(),
    memory,
    options = {
        checkIsEmpty : true,
        specific :[
            {
                property : "memory",
                length : 300,
                msg : "Memory has to many characters."
            }
        ]
    };

if (submitBtn) {
    memory = new Memory("memory");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = memory.getFormValues().getValues();
        if (validate.validate(data, options)) {
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
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, memory.updateTable);
    }, false)
}
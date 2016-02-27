/**
 * Created by evolutionarycoder on 2/4/16.
 */


var submitBtn = document.querySelector("#create"),
    manage    = new Manager("reassure.php"),
    notif     = new Notify(),
    validate  = Validate(),
    reassure,
    options   = {
        checkIsEmpty: true,
        specific    : [
            {
                property: "reassure",
                length  : 300,
                msg     : "Reassure has to many characters."
            }
        ]
    };

if (submitBtn) {
    reassure = new Reassure("reassure");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = reassure.getFormValues().getValues();
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    reassure         = new Reassure("id", "reassure");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = reassure.getFormValues(true).getValues();
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, reassure.updateTable);
    }, false)
}
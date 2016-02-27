/**
 * Created by evolutionarycoder on 2/19/16.
 */

var submitBtn = document.querySelector("#create"),
    manage    = new Manager("specialday.php"),
    notif     = new Notify(),
    validate  = Validate(),
    specialday,
    options   = {
        checkIsEmpty: true,
        specific    : [
            {
                property: "date",
                length  : 5,
                msg     : "Date is to long"
            },
            {
                property: "message",
                length  : 120,
                msg     : "Message is to long"
            }
        ]
    };

if (submitBtn) {
    specialday = new SpecialDay("date", "message");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = specialday.getFormValues().getValues();
        if (validate.validate(data, options)) {
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
        if (validate.validate(data, options)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(data, specialday.updateTable);
    }, false)
}
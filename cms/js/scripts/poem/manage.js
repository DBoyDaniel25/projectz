/**
 * Created by Daniel Prince on 1/9/16.
 */
var submitBtn = document.querySelector("#create"),
    manage    = new Manager("poem.php"),
    notif     = new Notification(),
    validate  = new Validate(),
    poem;

if (submitBtn) {
    poem = new Poem("name", "poem", "author");
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = poem.getFormValues().getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performCreate(notif, data);
    }, false);
} else {
    var updateBtn = document.querySelector("#update");
    poem          = new Poem("id", "name", "poem", "author");
    updateBtn.addEventListener("click", function (e) {
        e.preventDefault();
        var data = poem.getFormValues(true).getValues();
        if (validate.isFieldsEmpty(data)) {
            notif.error("Please fill in all fields");
            return;
        }
        manage.performUpdate(notif, data, poem.updateTable);
    }, false)
}
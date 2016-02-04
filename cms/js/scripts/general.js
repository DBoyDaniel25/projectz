/**
 * Created by Daniel Prince on 1/14/16.
 */
// hide edit form
$(".row.form").fadeOut();

// set up the edit, delete buttons
var editBtn      = document.querySelectorAll(".edit-row"),
    deleteBtn    = document.querySelectorAll(".remove-row"),
    closeBtn        = document.querySelector("#close"),
    closeMethod  = function () {
        // show edit form
        $(".row.form").fadeOut();
    },
    editMethod   = function (e) {
        e.preventDefault();

        if (manage.processFile.indexOf("poem") !== -1) {
            poem.getEditButtonData(this).populateForm(true);
        }

        if (manage.processFile.indexOf("ilove") !== -1) {
            ilove.getEditButtonData(this).populateForm(true);
        }

        // show edit form
        $(".row.form").fadeIn();
    },
    deleteMethod = function (e) {
        e.preventDefault();
        var rowId = this.getAttribute("data-id");
        var data  = {
            "delete": "delete",
            id      : rowId
        };
        manage.performDelete(data);
    };

for (var i = 0; i < editBtn.length; i++) {
    try {
        editBtn[i].addEventListener("click", editMethod, false);
        deleteBtn[i].addEventListener("click", deleteMethod, false);
    } catch (e) {
    }
}

closeBtn.addEventListener("click", closeMethod, false);

/**
 * Created by Daniel Prince on 1/14/16.
 */
// set up the edit, delete and close buttons
var editBtn      = document.querySelectorAll(".edit"),
    deleteBtn    = document.querySelectorAll(".delete"),
    closeIcon    = document.querySelector("#close"),
    closeMethod  = function () {
        var form = $("#form");
        form.removeClass("showForm");
        document.querySelector("#form").style.display            = "none";
        document.querySelector("#content_manager").style.display = "block";
    },
    editMethod   = function (e) {
        e.preventDefault();
        document.querySelector("#form").style.display = "block";
        $("#form").addClass("showForm");
        document.querySelector("#content_manager").style.display = "none";

        if (manage.processFile.indexOf("poem") !== -1) {
            poem.getEditButtonData(e.target).populateForm(true);
        }

        if (manage.processFile.indexOf("ilove") !== -1) {
            ilove.getEditButtonData(e.target).populateForm(true);
        }

    },
    deleteMethod = function (e) {
        e.preventDefault();
        var rowId = this.getAttribute("data-id");
        var data  = {
                "delete": "delete",
                id      : rowId
            },
            notif = new Notification();

        manage.performDelete(notif, data);
    };

for (var i = 0; i < editBtn.length; i++) {
    if (editBtn !== null) {
        editBtn[i].addEventListener("click", editMethod, false);
    }

    if (deleteBtn !== null) {
        deleteBtn[i].addEventListener("click", deleteMethod, false);
    }
}

closeIcon.addEventListener("click", closeMethod, false);


// hide notification bar when the user types in the form
var inputs    = document.querySelectorAll("input"),
    textAreas = document.querySelectorAll("textarea"),
    onType    = function () {
        var notif = new Notification();
        notif.hide();
    };

for (i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("keydown", onType, false);
}

for (i = 0; i < textAreas.length; i++) {
    textAreas[i].addEventListener("keydown", onType, false);
}

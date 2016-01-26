/**
 * Created by prince on 12/9/15.
 */
var Table = function (table) {
    if (table) {
        this.table = document.querySelector(table);
    } else {
        this.table = null;
    }
    this.row = null;
};

Table.prototype.removeRow = function (rowId) {
    var row = document.querySelector("tr[data-id='" + rowId + "']");
    row.parentNode.removeChild(row);
};

Table.prototype.createRow = function (opt) {
    this.row = document.createElement("tr");
    if (opt) {
        for (var key in opt) {
            if (opt.hasOwnProperty(key)) {
                this.row.setAttribute(key, opt[key]);
            }
        }
    }

    return this;
};

Table.prototype.createCell = function (content, opt) {
    var cell        = document.createElement("td"),
        cellContent = document.createTextNode(content);
    cell.appendChild(cellContent);
    if (opt) {
        for (var key in opt) {
            if (opt.hasOwnProperty(key)) {
                cell.setAttribute(key, opt[key]);
            }
        }
    }
    this.row.appendChild(cell);

    return this;
};

Table.prototype.createActions = function (opt) {
    /*<td>
     <input type="image" src="images/icn_edit.png" title="Edit">
     <input type="image" src="images/icn_trash.png" title="Trash">
     </td>*/
    var cell        = document.createElement("td"),
        inputEdit   = document.createElement("input"),
        inputDelete = document.createElement("input");

    inputEdit.setAttribute("type", "image");
    inputDelete.setAttribute("type", "image");

    inputEdit.setAttribute("src", "images/icn_edit.png");
    inputDelete.setAttribute("src", "images/icn_trash.png");

    inputEdit.setAttribute("title", "Edit");
    inputDelete.setAttribute("title", "Trash");

    if (opt) {
        for (var key in opt) {
            if (opt.hasOwnProperty(key)) {
                inputDelete.setAttribute(key, opt[key]);
                inputEdit.setAttribute(key, opt[key]);
            }
        }
    }

    cell.appendChild(inputEdit);
    cell.appendChild(inputDelete);


    this.row.appendChild(cell);
    return this;
};

Table.prototype.add = function () {
    this.table.appendChild(this.row);
    this.row = null;
};


Table.prototype.changeCell = function (rowId, cellNumber, text) {
    var row      = document.querySelector("tr[data-id='" + rowId + "']"),
        children = row.children;

    children[cellNumber].textContent = text;
};


Table.prototype.updateActionAttributes = function (rowId, data) {
    var row        = document.querySelector("tr[data-id='" + rowId + "']"),
        children   = row.children,
        length     = children.length,
        editAction = children[length - 1].children[0];

    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            editAction.setAttribute(key, data[key]);
        }
    }
};
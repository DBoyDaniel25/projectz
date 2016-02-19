/**
 * Created by evolutionarycoder on 2/19/16.
 */

var SpecialDay = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
SpecialDay.prototype = Object.create(Structure.prototype);


/**
 *
 * @param data
 * @param data.date
 * @param data.message
 * @param response
 */
SpecialDay.prototype.updateTable = function (data, response) {
    var table = new Table();
    table.changeCell(data.id, 0, data.date);
    table.changeCell(data.id, 1, data.message);
    table.updateActionAttributes(data.id, {
        "data-date" : data.date,
        "data-message" : data.message
    });
};

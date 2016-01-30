/**
 * Created by Daniel Prince on 1/27/16.
 */
var ILove = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
ILove.prototype = Object.create(Structure.prototype);

/**
 *
 * @param data
 * @param data.ilove
 * @param response Response from server
 */
ILove.prototype.updateTable = function (data, response) {
    var table = new Table("#tbody");
    table.changeCell(data.id, 0, data.ilove);
    table.updateActionAttributes(data.id, {
        "data-ilove": data.ilove
    });
};

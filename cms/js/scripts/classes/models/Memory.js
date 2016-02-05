/**
 * Created by evolutionarycoder on 2/4/16.
 */
var Memory = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
Memory.prototype = Object.create(Structure.prototype);


/**
 *
 * @param data
 * @param data.memory
 * @param response
 */
Memory.prototype.updateTable = function (data, response) {
    var table = new Table();
    table.changeCell(data.id, 0, data.memory);
    table.updateActionAttributes(data.id, {
        "data-memory" : data.memory
    });
};
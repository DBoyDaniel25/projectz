/**
 * Created by evolutionarycoder on 2/4/16.
 */
var Promise = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
Promise.prototype = Object.create(Structure.prototype);


/**
 *
 * @param data
 * @param data.promise
 * @param response
 */
Promise.prototype.updateTable = function (data, response) {
    var table = new Table();
    table.changeCell(data.id, 0, data.promise);
    table.updateActionAttributes(data.id, {
        "data-promise" : data.promise
    });
};

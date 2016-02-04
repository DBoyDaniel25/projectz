/**
 * Created by evolutionarycoder on 2/4/16.
 */
var Reassure = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
Reassure.prototype = Object.create(Structure.prototype);


/**
 *
 * @param data
 * @param data.reassure
 * @param response
 */
Reassure.prototype.updateTable = function (data, response) {
    var table = new Table();
    table.changeCell(data.id, 0, data.reassure);
    table.updateActionAttributes(data.id, {
        "data-reassure" : data.reassure
    });
};

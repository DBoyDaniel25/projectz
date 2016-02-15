/**
 * Created by evolutionarycoder on 2/5/16.
 */

var Quote = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
Quote.prototype = Object.create(Structure.prototype);


/**
 *
 * @param data
 * @param data.quote
 * @param response
 */
Quote.prototype.updateTable = function (data, response) {
    var table = new Table();
    table.changeCell(data.id, 0, data.quote);
    table.updateActionAttributes(data.id, {
        "data-quote" : data.quote
    });
};

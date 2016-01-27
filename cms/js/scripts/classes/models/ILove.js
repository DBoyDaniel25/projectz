/**
 * Created by Daniel Prince on 1/27/16.
 */
var ILove = function () {
    Structure.call(this, arguments);
};

// assign structure prototype to brand class (inherit it's methods)
ILove.prototype = Object.create(Structure.prototype);

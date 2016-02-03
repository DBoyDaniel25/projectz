/**
 * Created by evolutionarycoder on 2/3/16.
 */

/**
 * Each parameter as an array of data and reflects on one another
 * labels[0] is part of data[0] and colors[0]
 * @param labels [] Array of labels
 * @param data   [] Array of data Associate with the labels
 * @param colors [] Array of colors for each label
 * @constructor
 */
PieChart = function (labels, data, colors) {
    this.labels = labels || null;
    this.data   = data || null;
    this.color  = colors || null;
};

PieChart.prototype.getLabels = function () {
    return this.labels;
};

PieChart.prototype.getData = function () {
    return this.data;
};

PieChart.prototype.getColors = function () {
    return this.color;
};
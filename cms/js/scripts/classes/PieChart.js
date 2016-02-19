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
PieChart.prototype.setLabels = function (labels) {
    this.labels = labels;
};

PieChart.prototype.getData = function () {
    return this.data;
};

PieChart.prototype.setData = function (data) {
    this.data = data;
};

PieChart.prototype.getColors = function () {
    return this.color;
};

PieChart.prototype.createGraph = function () {
    this.createPieGraph("#pie-chart #pie-chart-container", this.getLabels(), this.getData(), this.getColors());
};

//creates Pie Chart
PieChart.prototype.createPieGraph = function (selector, labels, datas, colors) {
    var data = [];
    for (var i = 0; i < labels.length; i++) {
        // labels datas and colors should be same length
        var obj = {
            label: labels[i],
            data : datas[i]
        };
        data.push(obj);
        // outcome
        /*
         data = [{
         label: labels[0],
         data : datas[0]
         }, {
         label: labels[1],
         data : datas[1]
         }, {
         label: labels[2],
         data : datas[2]
         }];
         */
    }

    var options = {
        series     : {
            pie: {
                show: true
            }
        },
        legend     : {
            show: false
        },
        grid       : {
            hoverable: true,
            clickable: true
        },
        colors     : colors,
        tooltip    : true,
        tooltipOpts: {
            defaultTheme: false
        }
    };

    $.plot($(selector), data, options);
};
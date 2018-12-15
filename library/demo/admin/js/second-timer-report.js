$(function() {
    
    // Colors 
var color01 = '#6384ee';
var color02 = '#15d4be';
var color03 = '#ff6262';
var color04 = '#f0ad4e ';

var data = [
            {data: [[0, 4.1]], color: color01},
            {data: [[1, 1.8]], color: color02},
            {data: [[2, 2]], color: color03},
            {data: [[3, 4.5]], color: color04},
            {data: [[4, 3.7]], color: color01},
            {data: [[5, 5.6]], color: color02},
            {data: [[6, 2.6]], color: color03}
        ];

        $.plot($("#flot-bar-chart"), data, {
            series: {
                lines: {
                    fill: false
                },
                points: {show: false},
                bars: {
                    show: true,
                    align: 'center',
                    barWidth: 0.5,
                    fill: 1,
                    lineWidth: 1
                }
            },
            xaxis: {
                tickLength: 0,
                ticks: [
                    [0, "Jan"],
                    [1, "Feb"],
                    [2, "Mar"],
                    [3, "Apr"],
                    [4, "May"],
                    [5, "June"],
                    [6, "July"]]
            },
            yaxis: {
                min: 0
            },
            grid: {
                 color:'#ffffff',
                hoverable: true,
                backgroundColor: null,
                borderWidth:1,
                borderColor: 'rgba(198, 198, 198, 0.8)'
            }
        });
    
    
   
});
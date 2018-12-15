$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            iphone: 2666,
            ipad: null,
            itouch: 2647
        }, {
            period: '2010 Q2',
            iphone: 2778,
            ipad: 2294,
            itouch: 2441
        }, {
            period: '2010 Q3',
            iphone: 4912,
            ipad: 1969,
            itouch: 2501
        }, {
            period: '2010 Q4',
            iphone: 3767,
            ipad: 3597,
            itouch: 5689
        }, {
            period: '2011 Q1',
            iphone: 6810,
            ipad: 1914,
            itouch: 2293
        }, {
            period: '2011 Q2',
            iphone: 5670,
            ipad: 4293,
            itouch: 1881
        }, {
            period: '2011 Q3',
            iphone: 4820,
            ipad: 3795,
            itouch: 1588
        }, {
            period: '2011 Q4',
            iphone: 15073,
            ipad: 5967,
            itouch: 5175
        }, {
            period: '2012 Q1',
            iphone: 10687,
            ipad: 4460,
            itouch: 2028
        }, {
            period: '2012 Q2',
            iphone: 8432,
            ipad: 5713,
            itouch: 1791
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true,
        lineColors: ["#6c8bef", "#15d4be", "#ff6262"],
        pointFillColors: [ "#0D47A1", "#2196F3", "#4CAF50"],
        
    });

    Morris.Bar({
        element: 'district-general-statistics',
          data: [
            { y: 'Communities', Alpha: 100, Beta: 90, Charlie:50 },
            { y: 'Zones', Alpha: 75,  Beta: 65, Charlie:50 },
            { y: 'Cells', Alpha: 50,  Beta: 40, Charlie:50},
            { y: 'Members', Alpha: 75,  Beta: 65, Charlie:50 }
          ],
         resize: true,hideHover: 'auto',
          xkey: 'y',
          ykeys: ['Alpha', 'Beta', 'Charlie'],
          labels: ['Alpha', 'Beta', 'Charlie'],
            barColors: [ "#ff6262", "#15d4be", "#2196F3","#FFC107"],
            fillOpacity: 0.2
    });

    Morris.Bar({
        element: 'average-monthly-membership',
          data: [
            { y: 'January', Alpha: 100, Beta: 90 },
            { y: 'February', Alpha: 75,  Beta: 65 },
            { y: 'March'},
            { y: 'April', Alpha: 75,  Beta: 65 }
          ],
         resize: true,hideHover: 'auto',
          xkey: 'y',
          ykeys: ['Alpha', 'Beta'],
          labels: ['Alpha', 'Beta'],
            barColors: [ "#ff6262", "#15d4be", "#2196F3","#FFC107"],
            fillOpacity: 0.2
    });
    
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "January",
            value: 12
        }, {
            label: "February",
            value: 30
        }, {
            label: "March",
            value: 20
        }, {
            label: "April",
            value: 20
        }],
        resize: true,hideHover: 'auto',
        colors: ["#6c8bef", "#15d4be", "#ff6262", "#2196f3"]
    });

    Morris.Line({
      element: 'morris-line-chart',
      data: [
        { y: '2006', a: 100, b: 90 },
        { y: '2007', a: 75,  b: 65 },
        { y: '2008', a: 50,  b: 40 },
        { y: '2009', a: 75,  b: 65 },
        { y: '2010', a: 50,  b: 40 },
        { y: '2011', a: 75,  b: 65 },
        { y: '2012', a: 100, b: 90 }
      ],
      resize: true,
      xkey: 'y',hideHover: 'auto',
      ykeys: ['a', 'b'],
      lineColors: [ "#ff6262", "#15d4be"],
      labels: ['Series A', 'Series B']
    });
});

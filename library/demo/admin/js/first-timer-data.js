 $(function() {
    
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

    Morris.Line({
      element: 'morris-line-chart',
      data: [
        { y: '2006', a: 100},
        { y: '2007', a: 75},
        { y: '2008', a: 50},
        { y: '2009', a: 75},
        { y: '2010', a: 50},
        { y: '2011', a: 75},
        { y: '2012', a: 100}
      ],
      resize: true,
      xkey: 'y',hideHover: 'auto',
      ykeys: ['a'],
      lineColors: [ "#ff6262", "#15d4be"],
      labels: ['Number of Visitors']
    });
});
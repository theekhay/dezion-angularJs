$(function() {

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
});
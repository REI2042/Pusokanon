document.addEventListener("DOMContentLoaded", function() {
    const chartData = [
        { sitio_name: "Arca", initial_population: 2981, registered_residents: 500},
        { sitio_name: "Cemento", initial_population: 2682, registered_residents: 450},
        { sitio_name: "Chumba-Chumba", initial_population: 2235, registered_residents: 300},
        { sitio_name: "Ibabao", initial_population: 2533, registered_residents: 600},
        { sitio_name: "Lawis", initial_population: 2384, registered_residents: 400},
        { sitio_name: "Matumbo", initial_population: 2831, registered_residents: 350},
        { sitio_name: "Mustang", initial_population: 3130, registered_residents: 550},
        { sitio_name: "New Lipata", initial_population: 2086, registered_residents: 480},
        { sitio_name: "San Roque", initial_population: 1937, registered_residents: 700},
        { sitio_name: "Seabreeze", initial_population: 1788, registered_residents: 520},
        { sitio_name: "Seaside", initial_population: 2682, registered_residents: 650},
        { sitio_name: "Sewage", initial_population: 2533, registered_residents: 420},
        { sitio_name: "Sta. Maria", initial_population: 2981, registered_residents: 580}
      ];

      const options = {
        chart: {
          type: 'bar',
          height: 350
        },
        series: [{
          name: 'Initial Population',
          data: chartData.map(item => item.initial_population)
        }, {
          name: 'Registered Residents',
          data: chartData.map(item => item.registered_residents)
        }],
        dataLabels: {
            enabled: false
        },
        colors: ['#FD7E14', '#28A745'],
        xaxis: {
          categories: chartData.map(item => item.sitio_name),
          title: {
            text: 'Sitios',
            offsetY: -30
          }
        },
        yaxis: {
          title: {
            text: 'Number of Residents'
          }
        },
        title: {
          text: 'Initial Population vs Registered Residents by Sitio',
          align: 'center'
        },
        legend: {
          position: 'top'
        }
      };
      
      const chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
});
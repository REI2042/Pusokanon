function monthlyCaseByMonth() {
    var options = {
        series: [], 
        chart: {
            height: 500,
            type: 'bar',
            stacked: true,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Monthly Cases by Case Type',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], 
                opacity: 0.5
            },
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '70%',
                borderRadius: 4,
                borderRadiusApplication: 'end',
            }
        },
    };

    // Dynamically create series based on case types
    for (const caseType in monthlyChartData) {
        options.series.push({
            name: caseType,
            data: monthlyChartData[caseType]
        });
    }

    // Create the chart
    var chart = new ApexCharts(document.querySelector("#monthly-case-chart"), options);
    chart.render();
}

function casesBySitio() {
    var sitios = [
        "Arca", "Cemento", "Chumba-chumba", "Ibabao", "Lawis", "Matumbo", "Mustang",
        "Lipata", "San Roque", "Seabreeze", "Seaside", "Seawage", "Sta. Maria"
    ];

    var options = {
        series: [],
        chart: {
            height: 500,
            type: 'bar',
            stacked: true,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Cases Filed by Sitio',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: sitios,
            labels: {
                formatter: function (value) {
                    return value;
                }
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                horizontal: true,
                columnWidth: '70%',
            }
        },
    };

    // Define the order of case types
    var orderedCaseTypes = [
        "Bullying", "Damaging Properties", "Defamation", "Libel", 
        "Physical Abuse", "Threat", "Trespassing", "Theft", "Vandalism", "Others"
    ];

    // Dynamically create series based on case types
    orderedCaseTypes.forEach(caseType => {
        if (sitioChartData[caseType]) {
            var seriesData = sitios.map(sitio => sitioChartData[caseType][sitio] || 0);
            options.series.push({
                name: caseType,
                data: seriesData
            });
        }
    });

    // Create the chart
    var chart = new ApexCharts(document.querySelector("#sitio-case-chart"), options);
    chart.render();
}

// Call both functions to render the charts
document.addEventListener('DOMContentLoaded', function() {
    monthlyCaseByMonth();
    casesBySitio();
});
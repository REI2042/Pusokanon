document.addEventListener("DOMContentLoaded", function() {
    function renderChart() {
        const options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Registered Residents',
                data: chartData.map(item => parseInt(item.registered_residents))
            }, {
                name: 'Initial Population',
                data: chartData.map(item => parseInt(item.total_initial_residents))
            }],
            dataLabels: {
                enabled: false
            },
            colors: ['#28A745', '#FD7E14'],
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
                text: 'Registered Residents vs Initial Population by Sitio',
                align: 'center'
            },
            legend: {
                position: 'top'
            }
        };
        
        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
  
    renderChart();
  
    document.getElementById('Update').addEventListener('click', function() {
      const sitio = document.getElementById('sitios').value;
      const population = document.getElementById('sitio_population').value;
  
      if (isNaN(population) || parseInt(population) < 0) {
          Swal.fire({
              title: 'Invalid Input',
              text: 'Please enter a non-negative number for the population.',
              icon: 'error',
              confirmButtonColor: '#3085d6',
              customClass: {
                  popup: 'custom-swal'
              }
          });
          return;
      }
  
      Swal.fire({
          title: 'Are you sure?',
          text: `Do you want to update the population of ${sitio} to ${population}?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, update it!',
          customClass: {
            popup: 'custom-swal'
        }
      }).then((result) => {
          if (result.isConfirmed) {
              fetch('phpConn/update_population.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded',
                  },
                  body: `sitio=${encodeURIComponent(sitio)}&population=${encodeURIComponent(population)}`
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
                      const sitioIndex = chartData.findIndex(item => item.sitio_name === sitio);
                      if (sitioIndex !== -1) {
                          chartData[sitioIndex].total_initial_residents = population;
                      }
                      document.querySelector("#chart").innerHTML = '';
                      renderChart();
                      
                      Swal.fire({
                          title: 'Updated!',
                          text: 'The population has been updated.',
                          icon: 'success',
                          confirmButtonColor: '#3085d6',
                          customClass: {
                            popup: 'custom-swal'
                        }
                      });
                  } else {
                      Swal.fire(
                          'Error!',
                          'Failed to update population',
                          'error'
                      );
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  Swal.fire(
                      'Error!',
                      'An error occurred while updating the population',
                      'error'
                  );
            });
          }
      });
    });
  });
  
  
  document.addEventListener("DOMContentLoaded", function() {
      const salesChart = renderSalesChart();
      
      document.querySelectorAll('input[name="chartType"]').forEach((elem) => {
          elem.addEventListener("change", function(event) {
              const chartType = event.target.value;
              updateSalesChart(salesChart, chartType);
          });
      });
  });
  
  function renderSalesChart() {
      const options = {
          chart: {
              type: 'area',
              height: 400,
          },
          series: [{
              name: 'Total Amount',
              data: chartAmountDocs.map(item => parseInt(item.doc_amount))
          }],
          xaxis: {
              categories: chartAmountDocs.map(item => item.doc_name),
              labels: {
                  rotate: -60,
                  rotateAlways: true,
                  style: {
                      fontSize: '10px',
                      fontWeight: 400,
                  }
              }
          },
          title: {
              text: 'Document Sales by Type',
              align: 'center'
          },
          yaxis: {
              title: {
                  text: 'Total Amount (PHP)'
              }
          },
          dataLabels: {
              enabled: false
          },
          fill: {
              colors: ['#008FFB']
          },
          markers: {
              size: 5,
              colors: ['#008FFB'],
              strokeColor: '#fff',
              strokeWidth: 2,
          },
      };
  
      const chart = new ApexCharts(document.querySelector("#sales-chart"), options);
      chart.render();
      return chart;
  }
  
  function updateSalesChart(chart, chartType) {
      let newOptions;
      if (chartType === 'byDocType') {
          newOptions = {
              xaxis: {
                  categories: chartAmountDocs.map(item => item.doc_name)
              },
              title: {
                  text: 'Document Sales by Type'
              },
              series: [{
                  name: 'Total Amount',
                  data: chartAmountDocs.map(item => parseInt(item.doc_amount))
              }],
              markers: {
                  size: 5,
                  colors: ['#008FFB'],
                  strokeColor: '#fff',
                  strokeWidth: 2,
              },
          };
      } else if (chartType === 'byMonth') {
          // Assuming you have monthlyData available
          const monthNames = ["January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"];
          newOptions = {
              xaxis: {
                  categories: monthlyData.map(item => {
                      const [year, month] = item.month.split('-');
                      return `${monthNames[parseInt(month) - 1]} ${year}`;
                  })
              },
              title: {
                  text: 'Document Sales by Month'
              },
              series: [{
                  name: 'Total Amount',
                  data: monthlyData.map(item => parseInt(item.total_amount))
              }],
              markers: {
                  size: 5,
                  colors: ['#008FFB'],
                  strokeColor: '#fff',
                  strokeWidth: 2,
              },
          };
      }
      
      chart.updateOptions(newOptions);
  }  
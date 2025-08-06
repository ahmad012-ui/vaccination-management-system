// Chart: Appointments in Last 7 Days
document.addEventListener("DOMContentLoaded", function () {
  if (typeof appointmentsChartLabels !== 'undefined' && typeof appointmentsChartData !== 'undefined') {
    const ctxAppointments = document.getElementById("appointmentsChart").getContext("2d");
    new Chart(ctxAppointments, {
      type: "line",
      data: {
        labels: appointmentsChartLabels,
        datasets: [{
          label: "Appointments",
          data: appointmentsChartData,
          backgroundColor: "rgba(54, 162, 235, 0.2)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 2,
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true },
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1 }
          }
        }
      }
    });
  }

  // Chart: Vaccines by Type
  if (typeof vaccineLabels !== 'undefined' && typeof vaccineData !== 'undefined') {
    const ctxVaccines = document.getElementById("vaccineChart").getContext("2d");
    new Chart(ctxVaccines, {
      type: "bar",
      data: {
        labels: vaccineLabels,
        datasets: [{
          label: "Available Vaccines",
          data: vaccineData,
          backgroundColor: "rgba(75, 192, 192, 0.5)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1 }
          }
        }
      }
    });
  }
});

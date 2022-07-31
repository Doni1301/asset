// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
	'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
var pieChart = document.getElementById("myPieChart");
var myPieChart = new Chart(pieChart, {
	type: "doughnut",
	data: {
		labels: ["Pemasukan", "Pengeluaran", "Retur"],
		datasets: [
			{
				data: [55, 30, 15],
				backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 0,
		},
		legend: {
			display: true,
			position: "right",
		},
		cutoutPercentage: 50,
	},
});

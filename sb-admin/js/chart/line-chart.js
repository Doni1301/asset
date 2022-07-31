let lineChart = document.getElementById("lineChart");

let dataFirst = {
	label: "Pengeluaran",
	data: [10, 20, 20, 55, 40],
	lineTension: 0,
	fill: false,
	borderColor: "red",
};

let dataSecond = {
	label: "Pemasukan",
	data: [20, 40, 40, 110, 80],
	lineTension: 0,
	fill: false,
	borderColor: "blue",
};

let dataThird = {
	label: "Retur",
	data: [10, 15, 5, 20, 30],
	lineTension: 0,
	fill: false,
	borderColor: "yellow",
};

let chartOptions = {
	plugins: {
		legend: {
			display: true,
			position: "top",
			labels: {
				boxWidth: 80,
				fontColor: "black",
			},
		},
		htmlLegend: {
			// ID of the container to put the legend in
			containerID: "legend-container",
		},
	},
};

let lineData = {
	labels: ["2018", "2019", "2020", "2021", "2022"],
	datasets: [dataFirst, dataSecond, dataThird],
};

let ctx = new Chart(lineChart, {
	type: "line",
	data: lineData,
	options: chartOptions,
});

const getOrCreateLegendList = (chart, id) => {
	const legendContainer = document.getElementById(id);
	let listContainer = legendContainer.querySelector("ul");

	if (!listContainer) {
		listContainer = document.createElement("ul");
		listContainer.style.display = "flex";
		listContainer.style.flexDirection = "row";
		listContainer.style.margin = 0;
		listContainer.style.padding = 0;

		legendContainer.appendChild(listContainer);
	}

	return listContainer;
};

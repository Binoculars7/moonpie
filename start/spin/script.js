const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin-btn");
const finalValue = document.getElementById("final-value");

const generateColors = (count) => {
    const colors = [];
    for (let i = 0; i < count; i++) {
        colors.push(`#${Math.floor(Math.random()*16777215).toString(16)}`);
    }
    return colors;
};

let pieColors = generateColors(6);

const rotationValues = [
    { minDegree: 0, maxDegree: 30, value: 0 },
    { minDegree: 31, maxDegree: 90, value: 100 },
    { minDegree: 91, maxDegree: 150, value: 20 },
    { minDegree: 151, maxDegree: 210, value: 100 },
    { minDegree: 211, maxDegree: 270, value: 50 },
    { minDegree: 271, maxDegree: 330, value: 5 },
    { minDegree: 331, maxDegree: 360, value: 0 },
];

let myChart = new Chart(wheel, {
    plugins: [ChartDataLabels],
    type: "pie",
    data: {
        labels: ["100", "0", "5", "50", "1", "20"],
        datasets: [{
            backgroundColor: pieColors,
            data: [1, 1, 1, 1, 1, 1],
        }],
    },
    options: {
        responsive: true,
        animation: { duration: 0 },
        plugins: {
            tooltip: false,
            legend: { display: false },
            datalabels: {
                color: "#ffffff",
                formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                font: { size: 24 },
            },
        },
    },
});

const valueGenerator = (angleValue) => {
    for (let i of rotationValues) {
        if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
            finalValue.innerHTML = `<p><small>You just earned ${i.value} point(s)</small></p>`;
            spinBtn.disabled = false;
            break;
        }
    }
};

let count = 0;
let resultValue = 101;

spinBtn.addEventListener("click", () => {
    spinBtn.disabled = true;
    finalValue.innerHTML = `<p><small>Spinning the wheel. Good luck!</small></p>`;
    let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
    let rotationInterval = window.setInterval(() => {
        myChart.options.rotation = myChart.options.rotation + resultValue;
        myChart.update();
        if (myChart.options.rotation >= 360) {
            count += 1;
            resultValue -= 5;
            myChart.options.rotation = 0;
        } else if (count > 15 && myChart.options.rotation == randomDegree) {
            valueGenerator(randomDegree);
            clearInterval(rotationInterval);
            count = 0;
            resultValue = 101;
        }
    }, 10);
});
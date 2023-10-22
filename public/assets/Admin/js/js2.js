document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
            labels: ["Chrome", "Firefox", "IE", "Other"],
            datasets: [{
                data: [4306, 3801, 1689, 3251],
                backgroundColor: [
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.danger,
                    "#E8EAED"
                ],
                borderWidth: 5,
                borderColor: window.theme.white
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            cutoutPercentage: 70
        }
    });
});
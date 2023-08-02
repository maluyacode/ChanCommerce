$(function () {

})
const ctx = document.getElementById('myChart');

Chart.defaults.font.size = 16;

let productSoldChart;
let totalSalesChart;
let categoriesChart;

$('#productSold').on('click', function () {
    if (categoriesChart) {
        categoriesChart.destroy();
    }
    if (totalSalesChart) {
        totalSalesChart.destroy()
    }

    $('.chart-container').css({
        "display": "none"
    })
    $.ajax({
        url: "/api/product/sold",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            productSoldChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Items of Sold',
                        data: Object.values(data),
                        borderWidth: 1,
                        backgroundColor: [
                            '#7158e2',
                            '#3ae374',
                            '#ff3838',
                            "#FF851B",
                            "#7FDBFF",
                            "#B10DC9",
                            "#FFDC00",
                            "#001f3f",
                            "#39CCCC",
                            "#01FF70",
                            "#85144b",
                            "#F012BE",
                            "#3D9970",
                            "#111111",
                            "#AAAAAA",
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                color: "white",
                                fontSize: 18,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        },
                        x: {
                            ticks: {
                                color: "white",
                                fontSize: 20,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }
                    },
                    plugins: {
                        customCanvasBackgroundColor: {
                            color: 'lightGreen',
                        }
                    },
                    responsive: true
                }
            });
        },
        error: function () {
            alert("error");
        }
    })
    $('.chart-container').css({
        "display": "block",
        "width": "80%",
    })
    $('.responsive').css({
        "display": "none"
    })
});

$('#totalSales').on('click', function () {
    if (categoriesChart) {
        categoriesChart.destroy();
    }
    if (productSoldChart) {
        productSoldChart.destroy()
    }
    $.ajax({
        url: "/api/total/sales",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            totalSalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Total Sales',
                        data: Object.values(data),
                        // borderWidth: 1,
                        backgroundColor: [
                            '#7158e2',
                            '#3ae374',
                            '#ff3838',
                            "#FF851B",
                            "#7FDBFF",
                            "#B10DC9",
                            "#FFDC00",
                            "#001f3f",
                            "#39CCCC",
                            "#01FF70",
                            "#85144b",
                            "#F012BE",
                            "#3D9970",
                            "#111111",
                            "#AAAAAA",
                        ],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        hoverOffset: 10,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                color: "white",
                                fontSize: 18,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        },
                        x: {
                            ticks: {
                                color: "white",
                                fontSize: 20,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }
                    },
                    // plugins: {
                    //     customCanvasBackgroundColor: {
                    //         color: 'lightGreen',
                    //     }
                    // },
                    responsive: true
                }
            });
        },
        error: function () {
            alert("error");
        }
    })
    $('.chart-container').css({
        "display": "block",
        "width": "80%",
    })
    $('.responsive').css({
        "display": "none"
    })
})

$('#itemCategories').on('click', function () {
    if (totalSalesChart) {
        totalSalesChart.destroy();
    }
    if (productSoldChart) {
        productSoldChart.destroy()
    }

    $('.chart-container').css({
        "display": "none"
    })
    $.ajax({
        url: "/api/product/categories",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            categoriesChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: 'Items per category',
                        data: Object.values(data),
                        borderWidth: 1,
                        backgroundColor: [
                            '#7158e2',
                            '#3ae374',
                            '#ff3838',
                            "#FF851B",
                            "#7FDBFF",
                            "#B10DC9",
                            "#FFDC00",
                            "#001f3f",
                            "#39CCCC",
                            "#01FF70",
                            "#85144b",
                            "#F012BE",
                            "#3D9970",
                            "#111111",
                            "#AAAAAA",
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    scales: {
                        y: {
                            ticks: {
                                color: "white",
                                fontSize: 18,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        },
                        x: {
                            ticks: {
                                color: "white",
                                fontSize: 20,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }
                    },
                    plugins: {
                        customCanvasBackgroundColor: {
                            color: 'lightGreen',
                        }
                    },
                    responsive: true
                }
            });
        },
        error: function () {
            alert("error");
        }
    })
    $('.chart-container').css({
        "display": "block",
        "width": "50%",
    })
    $('.responsive').css({
        "display": "none"
    })
});

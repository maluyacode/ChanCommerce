$(function () {
    $('.chart-container').css({
        "display": "none"
    })
    const ctx = document.getElementById('myChart');
    $.ajax({
        url: "/api/product/sold",
        type: "GET",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (responseData) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(responseData),
                    datasets: [{
                        label: 'Items of Sold',
                        data: Object.values(responseData),
                        borderWidth: 1,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
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
})

$('#productSold').on('click', function () {
    $('.chart-container').css({
        "display": "block"
    })
    $('.responsive').css({
        "display": "none"
    })
});

$('#productStocks').on('click',  function (){
    alert("No Stocks")
})

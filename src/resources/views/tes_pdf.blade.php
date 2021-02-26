<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    
    {{-- <link href="{{url('/css/my_chart.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{url('chart/flot/examples/examples.css')}}" rel="stylesheet"> --}}
    {{-- <script language="javascript" type="text/javascript" src="{{url('chart/flot/source/jquery.flot.categories.js')}}"></script> --}}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"  crossorigin="anonymous" />
    
</head>

<body >
    <div class="canvas-holder" style="width: 818px; height: 409px;">
        <canvas width="1636" height="818" style="width: 818px; height: 409px;" id="myChart"></canvas>
    </div>
    <h1>image nya</h1>
    <img id="header" alt="asdadasdsd">
    <img id="sd" alt="asdadasdsd" src="http://pngimg.com/uploads/chicken/chicken_PNG2166.png">
    
    {{-- <script language="javascript" type="text/javascript" src="{{url('js/canvas.js')}}"></script> --}}
    <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                animation: {
                onComplete: function(animation){
                    document.querySelector('#header').setAttribute('src', this.toBase64Image());
                }
            }
            }
        });

        // let xxx = myChart.toBase64Image();
        // console.log(xxx)
        // let tmpl = `<img src="${xxx}" alt="dasdasds">`;
        //     // var img = document.createElement("img");
        //     // img.src = myChart.toBase64Image();
        //     var src = document.getElementById("header");
        //     // src.appendChild(img);
        //     src.innerHTML = tmpl
            
            // console.log(src)
            // console.log(url_base64jp)
        
       
    </script>
</body>

</html>
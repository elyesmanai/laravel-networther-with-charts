<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script src="js/jquery.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- Styles -->
    </head>
    <body>
        <div class="container-fluid  full-height">
           <div class="row">
                <div class="col-lg-6">

                    <div class="row" id="header">
                        <div class="col-lg-2 "><h1>Elyes <br>   Manai</h1></div>
                        <div class="col-lg-10">
                            <h4><div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <strong>Global : </strong><br>
                                    <strong>Teaching :</strong> <br>
                                    <strong>Dev : </strong><br>
                                </div>
                                <div class="col-lg-3">
                                    <center><strong>Hourly Rate</strong><br>
                                    {{$globalrate}}<br>
                                    {{$teachrate}}<br>
                                    {{$devrate}}<br></center> 
                                </div>
                                <div class="col-lg-2">
                                    <center><strong>Max</strong><br>
                                    {{$maxglobalrate}} <br>
                                    {{$maxteachrate}} <br>
                                    {{$maxdevrate}} <br></center> 
                                </div>
                                <div class="col-lg-2">
                                    <center><strong>Min</strong><br>
                                    {{$minglobalrate}}<br> 
                                    {{$minteachrate}}<br> 
                                    {{$mindevrate}}</div></center> 
                            </div>

                            </h4>
                        </div>  
                    </div>

                    <div class="row"  id="list">
                        <hr>
                        <div class="col-lg-12">
                            <form action="/" method="POST" autocomplete="">
                                <label for="name"> Job Name : </label> <input type="text" name="name">
                                <label for="reward"> Reward : </label> <input type="text" name="reward">
                                <label for="hours">   Hours : </label> <input id="hours" type="text" name="hours"><br>
                                <label for="type">     Type : </label>
                                    <input type="radio" name="type" value="teaching" checked> Teaching
                                    <input type="radio" name="type" value="Development"> Development <br>
                                <label for="kind">     Kind : </label>
                                    <input type="radio" name="kind" value="full-time" checked> full-time
                                    <input type="radio" name="kind" value="part-time"> part-time
                                    <input type="radio" name="kind" value="freelance"> freelance 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="submit">
                            </form>
                        </div>
                       <hr>
                        @if(!empty($jobs))
                           @foreach($jobs as $job)
                           <li>{{$job['name']}}</li>
                           @endforeach
                        @endif
                    </div>

                </div>
                   

                <div class="col-lg-6">
                    <canvas id="myChart" width="100%" height=""></canvas><br>
                    <canvas id="myChart2" width="100%" height=""></canvas>
                </div>
            </div>
                    
        </div>
    </body>

    <script>
    var myjson;
    $.getJSON("jobs.json", function(json) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var ctx1 = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels : ["January", "February", "March", "April", "May", "June", "July"], 
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: json.map(el => el.reward)}]}
            // data: {
            //     labels: ["January", "February", "March", "April", "May", "June", "July"],
            //         datasets: [{
            //         label: "My First dataset",
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [0, 10, 5, 2, 20, 30, 45],
            //         }]
            //     },
            });
        var chart = new Chart(ctx1, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels : ["January", "February", "March", "April", "May", "June", "July"], 
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: json.map(el => el.reward)}]}
            // data: {
            //     labels: ["January", "February", "March", "April", "May", "June", "July"],
            //         datasets: [{
            //         label: "My First dataset",
            //             backgroundColor: 'rgb(255, 99, 132)',
            //             borderColor: 'rgb(255, 99, 132)',
            //             data: [0, 10, 5, 2, 20, 30, 45],
            //         }]
            //     },
            });
    });   
        </script>
</html>

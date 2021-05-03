<!doctype html>
<html lang="en">
  <head>
    <title>Laravel 8 Google Line Graph Chart - Tutsmake.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
  <body>
 
    <div class="container p-5">
        <input type="text" id="trip" placeholder="Y-m-d" >
        <input type="button" value="Enter" onclick="get_date()" >
        <h5>Laravel 8 Google Line Chart | Tutsmake.com</h5>
        <a href="{{url('donut-chart')}}">Go To Dount Chart</a>
 
        <div id="google-line-chart" style="width: 900px; height: 500px"></div>
       
    </div>
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
 
        function drawChart() {
 
        var data = google.visualization.arrayToDataTable([
            // ['Month Name', 'Register Users Count'],
            ['Month Name', 'Sum'],
 
                @php
               
                foreach($lineChart as $d) {
                    echo "['".$d->month_name."', ".$d->sums."],";
                    
                     
                }
              
                @endphp
        ]);
 
        var options = {
          title: 'Trip Cost Month Wise',
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };
 
          var chart = new google.visualization.LineChart(document.getElementById('google-line-chart'));
 
          chart.draw(data, options);
         
        }

        function get_date(){
          
           var bla= document.getElementById('trip').value

           $.ajax({
           type:'POST',
           url:"{{ route('get_data_date') }}",
           data:{date:bla, "_token": "{{ csrf_token() }}",
           },
           success:function(result){

            myarray = [['Month Name', 'Sum']];

            $.each(result.res.lineChart, function(k, v) {
                     // alert(v.sums);
                     myarray.push([v.month_name, v.sums]);
                      // [v.month_name + $v.sums];
                    // alert (v.month_name+v.sums);
            })

            var data = google.visualization.arrayToDataTable(myarray);
 
        var options = {
          title: 'Trip Cost Month Wise',
          
          curveType: 'function',
          legend: { position: 'bottom' }
        };
       
          var chart = new google.visualization.LineChart(document.getElementById('google-line-chart'));
 
          chart.draw(data, options); 
              

           } //end success
        });
            
        }
    </script>
</body>
</html> 
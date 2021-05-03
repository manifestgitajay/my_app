<!DOCTYPE html>
<html>
<head>
    <title>Make Donut HighChart in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style type="text/css">
        .box{
            width:800px;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Laravel Donut HighChart Tutorial Example - NiceSnippets.com</h3>
                    </div>
                    <a href="{{url('line-chart')}}">Go To Line Chart</a>
                    <div class="panel-body" align="center">
                 <select id="my-dropdown">
                 <option value="">Select</option>
                 <option value="year">Year</option>
                 <option value="month">Month</option>                
                 <option value="week">Week</option>
                 </select>   
                   <lable>From </label> 
                    <input type="text" id="from" placeholder="Y-m-d" >
                    <lable>To </label> 
                    <input type="text" id="to" placeholder="Y-m-d" >
               <input type="button" value="Enter" onclick="get_date()" >
                        <div id="pie_chart" style="width:750px; height:450px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var students =  <?php echo json_encode($students); ?>;
            var options = {
                chart: {
                    renderTo: 'pie_chart',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Trip Status'
                },
                 tooltip: {
                    // pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                            }
                        }
                    }
                },
                series: [{
                    type:'pie',
                    name:'Trip'
                }]
            }
            myarray = [];
            var status;
            $.each(students, function(index, val) {
                // alert(val.trip_status);
                if(val.trip_status==1){
                    status='Started';
                }
                if(val.trip_status==2){
                    status='Completed';
                }
                if(val.trip_status==3){
                    status='Rejected';
                }
                myarray[index] = [status, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options);
            
        });


        function get_date(){
          

     var selected = $('#my-dropdown option:selected');

            var status=selected.val();
          var from= document.getElementById('from').value
          var to= document.getElementById('to').value

          $.ajax({
          type:'POST',
          url:"{{ route('get_date_dount') }}",
          data:{from:from,to:to,status:status,
          "_token": "{{ csrf_token() }}",
          },
          success:function(result){ 

            //   alert(result.res); 

            //  var students =  <?php echo json_encode($students); ?>;
            var options = {
                chart: {
                    renderTo: 'pie_chart',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Trip Status'
                },
                 tooltip: {
                    // pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                            }
                        }
                    }
                },
                series: [{
                    type:'pie',
                    name:'Trip'
                }]
            }
            myarray = [];
            var status;
            $.each(result.res, function(index, val) {
                // alert(val.trip_status);
                if(val.trip_status==1){
                    status='Started';
                }
                if(val.trip_status==2){
                    status='Completed';
                }
                if(val.trip_status==3){
                    status='Rejected';
                }
                myarray[index] = [status, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options); 

          } //end success
       });
           
       }
    </script>
</body>
</html>
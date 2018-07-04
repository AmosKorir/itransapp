<?php
// define earning of the week day



?>











<div class="row">
    <div class="col-md-4">
        <div class="well"><h3 class="text2">Today's earning</h3>
        <div class="center"><h2 class="titletext"><?php echo $yourearning;?></h2></div>
        
        </div>
        
    </div>
    <div class="col-md-4">
    <div class="well"><h3 class="text2">This month's earning</h3>
    <div class="center"><h2 class="titletext"><?php echo $monthearning;?></h2></div>
    </div>
    
    </div>
    <div class="col-md-4">
    <div class="well"><h3 class="text2">Total Lifetime earning</h3>
    <div class="center"><h2 class="titletext"><?php echo $lifeEarning;?></h2></div>
    </div>
    </div>
</div>


<!-- the following weekly Todays in graph analytics-->
<div class="row">
    <div class="col-md-6">
        <div class="well">
        <h1>Today's chart;</h1>

<canvas id="myChart"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ["Your commpany","Other"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [<?php echo $yourearning;?>,<?php echo $othertoday;?>],
            //background color
            backgroundColor:[
                "#9b227b", "#5cf1f9",
            ]

        }]
    },
    

    // Configuration options go here
    options: {}
});
</script>
 </div>


 </div>
    <div class="col-md-6">
    <div class="well">
            <h1>Monthly chart;</h1>
            <!-- this is the section showing the monthly -->
           
 <canvas id="monthgraph"></canvas>
<script>
var ctx = document.getElementById('monthgraph').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ["Your commpany","Other"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [<?php echo $monthearning;?>,<?php echo $othermonthearning;?>],
            //background color
            backgroundColor:[
                "#9b227b", "#5cf1f9",
            ]

        }]
    },
    

    // Configuration options go here
    options: {}
});
</script>


           
        </div>
    </div>
</div>


<!-- section for the day of the week graph-->

    <div class="row">
        <h2 class="titletext">Day Comparison<h2>
        <div class="col-md-4">
        <!-- description goes here -->
        <div class="centertext">
        <h2>Bar graph for daily earning of the week.</h2>
        </div>

        </div>
        <div class="col-md-8">
         <!-- the graph begin from here -->
         <canvas id="daygraph"></canvas>
<script>
var ctx = document.getElementById('daygraph').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ],
        datasets: [{
            label: "My First dataset",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                <?php echo $monday;?>,
                <?php echo $tuesday;?>,
                <?php echo $wednesday;?>,
                <?php echo $thurday;?>,
                <?php echo $friday;?>,
                <?php echo $saturday;?>,
                <?php echo $sunday;?>,

                
                ],
            //background color
            backgroundColor:[
                "#5cf1f9",
                "#5cf1f9",
                "#5cf1f9",
                "#5cf1f9",
                "#5cf1f9",
                "#5cf1f9",
                "#5cf1f9",
            ]

        }]
    },
    

    // Configuration options go here
    options: {}
});
</script>

         <!-- the grap ends from here -->
        </div>
</container>
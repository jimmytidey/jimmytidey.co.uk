<?php 
$title = 'PhD Overview';
include('../header.php');
?>

<div class='container'>
    <div class='row'>
        <div id='background' class='col-md-12 '>
            <h1  id='intro'>Network Toy</h1>
        </div>
    </div>
    
    <div class='row'>
        <div class='col-md-9 d3_container'>

        </div> 

        <div class='col-md-3'> 
            <div class='row'>
                
                <div class='col-md-12'>
                    Network Constraint: 
                </div>

                <div class='col-md-12'>
                    Indirect Network Constraint: 
                </div>

                <div class='col-md-12'>
                    Connectedness: 
                </div>

                <div class='col-md-12'>
                    Density: 
                </div>

                <div class='col-md-12'>
                    <button class='btn btn-primary btn-block'>Recalculate &nbsp;<span class="glyphicon glyphicon-refresh"></span></button>
                </div>

            </div> 
        </div>        
    </div>
    <div class='row'>
        <div class='col-md-12'>
            <h3>Show calculations</h3>
          </div>
    </div>
    <div class='row '>
        <div class='col-md-3'>  
                      <button class='btn btn-primary btn-block'>Density </button>
            <button class='btn btn-primary btn-block'>Connectedness</button>
            <button class='btn btn-primary btn-block'>Network Constraint</button>
            <button class='btn btn-primary btn-block'>Indirect Network Constraint</button>

        </div>
        <div class='col-md-9 '> 
            <div class='row'>
                <button class='btn btn-default'><span class="glyphicon glyphicon-backward"></span></button>
                <button class='btn btn-default'><span class="glyphicon glyphicon-play"></span></button>
                <button class='btn btn-default'><span class="glyphicon glyphicon-forward"></span></button>                
                
            <div> 

            <div class='row '>
                <div class='col-md-12 calculation_container'>
                    <p>Calculation will appear here</p>
                </div>
            <div>     
        <div>       
    </div> 

</div>

<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src='graph-toy.js'></script>

<style>
.calculation_container { 
    min-height:400px;

}

.link {
  fill: none;
  stroke: #666;
  stroke-width: 1.5px;
}

#licensing {
  fill: green;
}

.link.licensing {
  stroke: green;
}

.link.resolved {
  stroke-dasharray: 0,2 1;
}

circle {
  fill: #ccc;
  stroke: #333;
  stroke-width: 1.5px;
}

text {
  font: 10px sans-serif;
  pointer-events: none;
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
}

</style>


<?php  include '../footer.php' ?>





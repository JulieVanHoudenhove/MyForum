<template>
    <section class="graph">
        <!-- Voir qui sont les utilisateurs qui postent le plus (pie chart…) -->
        <div id="chart_div"></div>
        <p>Les utilisateurs qui postent le plus</p>
    </section>
</template>

 <!--Load the AJAX API-->
 <script type="text/javascript">
    export default {
       name: "graph"
    }
     // Load the Visualization API and the corechart package.
     google.charts.load("current", {packages: ["corechart"]});
 
     // Set a callback to run when the Google Visualization API is loaded.
     google.charts.setOnLoadCallback(drawChart);
 
     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
     // draws it.
     function drawChart() {
 
         // Create the data table.
         var data = google.visualization.arrayToDataTable([
             ["Element", "Posts", { role: "style" } ],
             ["Pseudo3", 889, "#b87333"],
             ["Pseudo4", 1049, "silver"],
             ["Pseudo5", 1930, "gold"],
             ["Psqeudo6", 2145, "color: #e5e4e2"]
         ]);
 
         // Set chart options
         var options = {
             title: "Nombre de posts",
             width: 600,
             height: 400,
             bar: {groupWidth: "95%"},
             legend: { position: "none" },
         };
 
         // Instantiate and draw our chart, passing in some options.
         var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
         chart.draw(data, options);
     }
 </script>
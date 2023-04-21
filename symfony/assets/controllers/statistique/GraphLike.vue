<template>
    <section class="graph">
        <!-- Voir qui sont les utilisateurs qui postent le plus (pie chart…) -->
        <p>Total des likes par semaine</p>
        <div id="chart_column_div"></div>
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
     google.charts.setOnLoadCallback(drawChartColumn);
 
     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
     // draws it.
     function drawChartColumn() {
 
        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Element', 'Density', { role: 'style' }],
        ['Copper', 8.94, '#b87333'],            // RGB value
        ['Silver', 10.49, 'silver'],            // English color name
        ['Gold', 19.30, 'gold'],
        ['Platinum', 21.45, 'color: #e5e4e2' ], // CSS-style declaration
      ]);

        // Set chart options
        var options = {
            title: "Nombre de like par semaine",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_column_div'));
        chart.draw(data, options);
        }
 </script>
<script setup>
    const get = defineProps ({ users: { type: Array }})
    console.log(get)
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
        ['Semaine', 'Likes', { role: 'style' }],
        [`Semaine n°${get.users[0].w}`, parseInt(`${get.users[0][1]}`), '#3D4741'],            // RGB value
        [`Semaine n°${get.users[1].w}`, parseInt(`${get.users[1][1]}`), '#617967'],            // English color name
        [`Semaine n°${get.users[2].w}`, parseInt(`${get.users[2][1]}`), '#84A98C'],
        [`Semaine n°${get.users[3].w}`, parseInt(`${get.users[3][1]}`), '#e1e5e0' ], // CSS-style declaration
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

<template>
    <section class="grid-areas_2 py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <!-- Voir qui sont les utilisateurs qui postent le plus (pie chart…) -->
        <p>Total des likes par semaine</p>
        <div id="chart_column_div"></div>
    </section>
</template>
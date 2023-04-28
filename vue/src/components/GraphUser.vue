<script setup>
    const get = defineProps ({ users: { type: Array }})
    console.log('user', get)
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
            [`${get.users[0].username}`, parseInt(`${get.users[0].posts.length}`), "#3D4741"],
            [`${get.users[1].username}`, parseInt(`${get.users[1].posts.length}`), "#617967"],
            [`${get.users[2].username}`, parseInt(`${get.users[2].posts.length}`), "#84A98C"],
            [`${get.users[3].username}`, parseInt(`${get.users[3].posts.length}`), "#A3BDA8"],
            [`${get.users[4].username}`, parseInt(`${get.users[4].posts.length}`), "#E1E5E0"]
        ]);

        // Set chart options
        var options = {
            title: "Nombre de posts par utilisateur",
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

<template>
    <section class="grid-areas py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <div id="chart_div"></div>
        <p>Les utilisateurs qui postent le plus</p>
    </section>
</template>


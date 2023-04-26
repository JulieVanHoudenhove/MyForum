<script type="text/javascript">
 import axios from 'axios';
    import { onMounted, ref } from 'vue';

    const current = defineProps({ utilisateur: { type: Object }})
    const stats = ref();

    onMounted(async () => {
    const response = await axios.get('http://localhost:8088/myforum/index.php/api/user_stats/'+current.utilisateur.id);
    stats.value = await response.data;
    console.log(stats.value)
  }); 






export default {
       name: "graph"
    }
     // Load the Visualization API and the corechart package.
     google.charts.load("current", {packages: ["corechart"]});
 
     // Set a callback to run when the Google Visualization API is loaded.
     google.charts.setOnLoadCallback(drawChart);
     google.charts.setOnLoadCallback(drawChartColumn);
 
     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
     // draws it.
     function drawChart() {
 
         // Create the data table.
         var data = google.visualization.arrayToDataTable([
             ["Element", "Posts", { role: "style" } ],
             ["User1", 889, "#b87333"],
             ["User2", 1049, "silver"],
             ["User3", 1930, "gold"],
             ["User4", 2145, "color: #e5e4e2"]
             ["User5", 2245, "color: #e5e4e2"]
         ]);
 
         // Set chart options
         var options = {
             title: "Nombre de posts",
             width: 600,
             height: 500,
             bar: {groupWidth: "95%"},
             legend: { position: "none" },
         };
 
         // Instantiate and draw our chart, passing in some options.
         var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
         chart.draw(data, options);
     }
     function drawChartColumn() {
 
        // Create the data table.
        var data = google.visualization.arrayToDataTable([
        ['Element', 'Density', { role: 'style' }],
        ['Semaine n°14', 8.94, '#b87333'],            // RGB value
        ['Semaine n°15', 10.49, 'silver'],            // English color name
        ['Semaine n°16', 19.30, 'gold'],
        ['Semaine n°17', 21.45, 'color: #e5e4e2' ], // CSS-style declaration
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
<main class="mt-20 font-Poppins flex flex-col justify-center items-center">
    <h1 class="h1 text-vert">Statistiques</h1>
    <div class="grid grid-cols-2 gap-x-10 gap-y-10 text-center justify-center items-center m-12">
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre total de post de l'utilisateur -->
            <h2 class="text-2xl font-bold">5<!--{{ totalPost|length }}--></h2>
            <p><!--{{ totalPost|length > 1 ? 'Posts' : 'Post' }}-->Posts</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre total de likes tous les posts de l'utilisateur -->
            <h2 class="text-2xl font-bold">5<!--{{ totalLike|length }}--></h2>
            <p><!--{{ totalLike|length > 1 ? 'Likes' : 'Like' }}-->Likes</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre de posts fait depuis 7 jours -->
            <h2 class="text-2xl font-bold">7<!--{{ lastWeekPost|length }}--></h2>
            <p><!--{{ lastWeekPost|length > 1 ? 'Posts' : 'Post' }}-->Posts des <br>7 derniers jours</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre de likes sur les posts depuis 7 jours -->
            <h2 class="text-2xl font-bold">10<!--{{ lastWeekLike|length }}--></h2>
            <p><!--{{ lastWeekLike|length > 1 ? 'Likes' : 'Like' }}-->Likes des <br>7 derniers jours</p>
        </section>
        <section class="grid-areas py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <h2>Les utilisateurs qui postent le plus</h2>
                    <div>
                        <p><!--{{ activeUser.username }} = {{ activeUser.posts|length }}--></p>
                    </div>
            <!-- Voir qui sont les utilisateurs qui postent le plus (pie chart…) -->
            <div id="chart_div"></div>
        </section>
        <section class="grid-areas_2 py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <h2>Likes per weeks</h2>
            <div>
              <p>Semaine n°: <!--{{ like.w }} -->17<br>total like sur les posts : <!--{{ like.1 }}-->800</p>
            </div>
            <div id="chart_column_div"></div>
        </section>
    </div>
</main>
</template>

<style>
</style>

<script>
   export default {
       name: "post"
   }
</script>

<template>
    <article>
        <a href="post_detail.html">
            <h3>Post 1</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quam possimus eum voluptates illum totam, sunt veritatis blanditiis quibusdam doloribus laudantium quidem ad repellendus autem consequuntur id non, eos maxime?</p>
            <img src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
            <div>
                <p><span>Écrit par :</span> Pseudo 1</p>
                <p>17/04/2023 16:03</p>
            </div>
        </a>
        <div class="react">
            <i class="fa-regular fa-comment"></i>
            <i class="fa-regular fa-heart"></i>
        </div>
    </article>
</template>
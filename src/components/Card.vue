<template>
    <div class="card">
        <div class="card-header">
            <div class="card-id">1 A</div>
            <div class="card-name">VUE CARD</div>
        </div>
        <div class="card-image">
            <img src="../assets/img/cards/1.png">
        </div>
        <div class="card-features">
            <h4>Features</h4>
            <div class="feature" v-for="i in 5">
                <div class="feature-name">  Cilindraje</div>
                <div class="feature-value"> 1290</div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .card{
        background: #fff;
        width: 100%;
        min-width: 190px;
        max-width: 190px;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: 0 0 5px rgb(100, 100, 100);
        border-radius: .1rem;
        font-size: .95rem;
        padding: .5rem 1rem 1.5rem 1rem;
    }
    /* CABECERA DE LA CARTA */
    .card .card-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
    }
    .card .card-header .card-id {
        font-size: 1.2rem;
    }
    .card .card-features h4 {
        margin-bottom: .6rem;
    }
    /* IMAGNE DE LA CARTA */
    .card .card-image {
        display: flex;
        justify-content: center;
    }
    .card .card-image {
        height: 150px;
        max-width: 100%;
    }
    .card .feature {
        display: flex;
        justify-content: space-between;
    }
</style>
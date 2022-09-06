<template>
    <div class="game">
        <!-- JUGADORES -->
        <div v-for="player in players" class="player-wrapper" :class="'player-wrapper-'+i">
            <div class="player" :class="'player'+i">
                <div class="player-image">
                    <img src="../assets/logo.png">
                </div>
                <div class="player-info">
                    <div class="player-name">{{player.name}}</div>
                    <div class="player-cards">
                        <label>logo-c</label> 3
                    </div>
                </div>
            </div>
        </div>
        <!-- JUEGO CENTRAL -->
        <div class="cards">
            <Card class="active-card"></Card>
            <div class="played-cards">
                <Card style="transform: rotateZ(-20deg);"></Card>
                <Card style="transform: rotateZ(-8deg);"></Card>
                <Card style="transform: rotateZ(-2deg);"></Card>
                <Card style="transform: rotateZ(-10deg);"></Card>
            </div>
        </div>
    </div>
</template>
<script>
    import Card from '../components/Card.vue'
    export default {
        name: 'Game',
        data: function() {
            return {
                players: [
                    {
                        'id': 1,
                        'name': 'Alejandro',
                        'cards': 1
                    },
                ]
            }
        },
        components: {
            Card
        }
    } 
</script>
<style>
    /* PLAYERS */
    .player-wrapper {
        display: flex;
        justify-content: center;
    }
    .player{
        padding:  .3rem .5rem 1.2rem .5rem;
        width: 100%;
        max-width: 150px;
        max-height: 190px;
        border-radius: 5px;
        box-shadow: 0 0 1rem #8d8d8d;
        display: grid;
    }
    .player .player-info{
        display: grid;
        grid-template-columns: 1fr;
        gap: .1rem;
    }
    .player .player-image {
        width: 100%;
        height: 120px;
        background: #3a3a3a;
        display: flex;
        justify-content: center;
    }
    .player .player-image img {
        height: 100%;
        max-width: 100%;
    }
    /* INFORMACIÓN */
    .player .player-info{
        padding: .5rem 0;
    }
    /* CARTAS JUGADAS */
    .played-cards {
        z-index: 1;
        position: relative;
        width: 190px;
        height: 300px;
    }
    .played-cards .card {
        position: absolute;
    }
    /* CARTA ACTIVA */
    .card.active-card {
        position: absolute;
        z-index: 10;
        transform: scale(1.1);
        box-shadow: 0 0 20px #e4e707;
    }
</style>
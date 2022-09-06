<template>
    <div>
        <div class="game">
            <!-- JUGADORES -->
            <div v-for="(player, i) in players" class="player-wrapper" :class="'player-wrapper-'+(i+1)">
                <!--CARTAS DEL JUGADOR-->
                <div class="player-cards" 
                v-if="(i+1) == 1 && config.userPlaying == 1 && myCards.length ">
                    <Card class="player-card" :info="{ftHover:true,  data: myCards[0]}" :putCart="onFeatures"></Card>
                    <div class="false-card" style="top: 3px"></div>
                    <div class="false-card" style="top: 5px"></div>
                    <div class="false-card" style="top: 7px"></div>
                </div>
                <div class="player" :class="'player'+(i+1)">
                    <div class="player-image">
                        <img src="../assets/logo.png">
                    </div>
                    <div class="player-info">
                        <div class="player-name">{{player.name}}</div>
                        <div class="player-num-cards">
                            <label>logo-c</label> {{player.cards}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- JUEGO CENTRAL -->
            <div class="cards">
                <Card v-if="playedCards.length" :info="{feature: playedCards[0].feature,  data: playedCards[0].data}" class="active-card"></Card>
                <!-- <div class="played-cards">
                    <Card style="transform: rotateZ(-20deg);"></Card>
                    <Card style="transform: rotateZ(-8deg);"></Card>
                    <Card style="transform: rotateZ(-2deg);"></Card>
                    <Card style="transform: rotateZ(-10deg);"></Card>
                </div> -->
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
                config: {
                    userPlaying: 1
                },
                playedCards:[],
                myCards: [
                    {
                        id: '1 A',
                        name: 'Kawasaki Ninja H2R',
                        cylinder: 998,
                        year: '2022-01-01',
                        torque: 25,
                        top_speed: 400,
                        weigh: 500,
                    }
                ],
                players: [
                    {
                        'id': 1,
                        'name': 'Alejandro',
                        'cards': 1
                    },
                    {
                        'id': 2,
                        'name': 'Santiago',
                        'cards': 1
                    },
                    {
                        'id': 3,
                        'name': 'James',
                        'cards': 1
                    },
                ]
            }
        },
        methods: {
            onFeatures(returned) {
                this.userPlaying = 2;
                const result = this.myCards.filter(card => card.id != this.myCards[0].id);
                this.playedCards.push({
                    feature: returned,
                    data: this.myCards[0]
                });
                this.myCards = result;
            }
        },
        components: {
            Card,
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

    /* CARTAS DEL JUGADOR */
    .player-cards{
        top: -20px;
        width: 305px;
        position: relative;
    }
    .player-cards .player-card {
        position: absolute;
        z-index: 15;
    }
    .player-cards .player-card:hover {
        transform: scale(1.3);
    }
    .false-card {
        position: absolute;
        width: 222px;
        height: 330px;
        background: #d3d3d3;
        box-shadow: 0 .3rem .2rem #8d8d8d;
    }
</style>
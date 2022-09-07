<template>
    <div style="box-sizing:border-box;">
        <div class="wrapper-modal f-c" v-if="config.gameState == 'finished'">
            <div class="winner-modal">
                <div class="modal-header">
                    <h1>¡JUEGO FINALIZADO!</h1>
                </div>
                <div class="modal-body">
                    <table class="general-table">
                        <thead>
                            <tr>
                                <th colspan="3">Resultados</th>
                            </tr>
                            <tr>
                                <th>Posición</th>
                                <th>Jugador</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><center>1°</center></td>
                                <td><center>James</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <router-link to="/" class="button">Volver al Inicio</router-link>
                </div>
            </div>
        </div>
        <div class="wrapper-modal f-c" v-if="config.showWinner">
            <div class="winner-modal">
                <div class="modal-header">
                    <h1>¡GANADOR DE RONDA!</h1>
                </div>
                <div class="modal-body">
                    <div class="player" style="
                        box-shadow: 0 0 5px #000;
                        margin: 0 auto;">
                        <div class="player-image">
                            <img src="../assets/logo.png">
                        </div>
                        <div class="player-info">
                            <div class="player-name">Alejandro</div>
                            <div class="player-num-cards">
                                <label>logo-c</label> 2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="round-table" v-if="config.showCard > 0">
            <thead>
                <tr>
                    <th colspan="2">Caracteríastica <br> Cilindraje</th>
                </tr>
                <tr>
                    <th>Jugador</th>
                    <th>Puntaje</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="i in config.showCard">
                    <td>James</td>
                    <td>2500</td>
                </tr>
            </tbody>
        </table>
        <div class="game">
            <!-- JUGADORES -->
            <div v-for="(player, i) in players" class="center-wrapper" :class="'player-wrapper-'+(i+1)">
                <!--CARTAS DEL JUGADOR-->
                <div class="player-cards" 
                v-if="(i+1) == 1 && config.userPlaying == 1 && myCards.length ">
                    <Card class="player-card" :info="{ftHover:true,  data: myCards[0]}" :putCart="onFeatures"></Card>
                    <div class="false-card" style="top: -93px"></div>
                    <div class="false-card" style="top: -92px"></div>
                    <div class="false-card" style="top: -91px"></div>
                </div>
                <!-- INFORMACIÓN DE JUGADORES -->
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
                <div class="played-cards">
                    <Card v-if="playedCards.length" :info="{feature: playedCards[0].feature,  data: playedCards[0].data}" class="active-card"></Card>
                    <Card v-if="config.showCard >= 2" :info="{}"></Card>
                    <Card v-if="config.showCard >= 3" :info="{}"></Card>
                    <Card v-if="config.showCard >= 4" :info="{}"></Card>
                    <Card v-if="config.showCard >= 5" :info="{}"></Card>
                    <Card v-if="config.showCard >= 6" :info="{}"></Card>
                    <Card v-if="config.showCard >= 7" :info="{}"></Card>
                </div>
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
                    userPlaying: 1,
                    showCard: 0,
                    showWinner: false,
                    gameState: 'playing'
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

                this.config.showCard = 1;
                let i = 2;
                let intervalo = setInterval(()=> {
                    this.config.showCard = i;
                    i++;
                    if(i > 7) {
                        clearInterval(intervalo);
                        setTimeout(() => {
                            this.config.showWinner = true;
                            setTimeout(() => {this.config.showWinner = false;
                            setTimeout(() => {this.config.gameState = 'finished';}, 1000);
                            }, 2000);
                        }, 800);
                            
                    }
                }, 500);
            },
        },
        components: {
            Card,
        }
    } 
</script>
<style>
    /* PLAYERS */
    .center-wrapper {
        display: flex;
        justify-content: center;
    }
    .player{
        padding:  .3rem .5rem 1.2rem .5rem;
        width: 100%;
        max-width: 120px;
        max-height: 150px;
        border-radius: 5px;
        font-size: .8rem;
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
        height: 90px;
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
    .played-cards .card:nth-child(2n){transform: rotateZ(-20deg);}
    .played-cards .card:nth-child(3n){transform: rotateZ(-8deg);}
    .played-cards .card:nth-child(4n){transform: rotateZ(-2deg);}
    .played-cards .card:nth-child(5n){transform: rotateZ(-10deg);}
    .played-cards .card:nth-child(6n){transform: rotateZ(-3deg);}
    .played-cards .card:nth-child(7n){transform: rotateZ(0);}
    /* CARTA ACTIVA */
    .card-1{grid-area: card1;}
    .card-2{grid-area: card2;}
    .card-3{grid-area: card3;}
    .card-4{grid-area: card4;}
    .card-5{grid-area: card5;}
    .card-6{grid-area: card6;}
    .card-7{grid-area: card7;}
    .f-c{display:flex;align-items: center;justify-content: center;}
    .card.active-card {
        position: absolute;
        transform: scale(1);
        box-shadow: 0 0 20px #e4e707;
    }
    .card.throw-card{
        transform: scale(.8);
    }

    /* CARTAS DEL JUGADOR */
    .player-cards{
        top: -20px;
        width: 245px;
        position: relative;
    }
    .player-cards .player-card {
        top: -90px;
        position: absolute;
        transform: scale(.8);
        z-index: 15;
    }
    .player-cards .player-card:hover {
        transform: scale(1);
    }
    .false-card {
        position: absolute;
        width: 222px;
        height: 325px;
        background: #d3d3d3;
        box-shadow: 0 .3rem .2rem #8d8d8d;
        transform: scale(.8);
    }
</style>
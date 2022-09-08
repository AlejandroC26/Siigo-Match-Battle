<template>
    <div class="game-page" style="box-sizing:border-box;">
        <div class="wrapper-modal f-c" v-if="config.gameState == 'finished'">
            <div class="winner-modal">
                <div class="modal-header">
                    <h1 style="margin-top: 0;">¡JUEGO FINALIZADO!</h1>
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
                            <tr  v-for="i in 7">
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
                    <h1 style="margin-top: 0;">¡GANADOR DE RONDA!</h1>
                </div>
                <div class="modal-body">
                    <div class="player" style="
                        box-shadow: 0 0 5px #000;
                        margin: 0 auto;">
                        <div class="player-image">
                            <img src="../assets/logo.png">
                        </div>
                        <div class="player-info">
                            <div class="player-name"
                            style="color: #000;">{{winner_round}}</div>
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
                <tr v-for="(user, index) in playedCards">
                    <td>Jugador {{index + 1}}</td>
                    <td><center>{{user.feature.value}}</center></td>
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
                    <div class="false-card" style="top: -88px"></div>
                </div>
                <!-- INFORMACIÓN DE JUGADORES -->
                <div class="player" :class="'player'+(i+1)">
                    <div class="player-image">
                        <img src="../assets/logo.png">
                    </div>
                    <div class="player-info">
                        <div class="player-name">{{player.name}}</div>
                        <div class="player-num-cards">
                            N° Cartas - {{player.count_cards}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- JUEGO CENTRAL -->
            <div class="cards">
                <div class="played-cards">
                    <Card v-if="playedCards.length" :info="{feature: playedCards[0].feature,  data: playedCards[0].data}" class="active-card"></Card>
                    <Card v-if="config.showCard >= 2" :info="{feature: playedCards[1].feature,  data: playedCards[1].data}"></Card>
                    <Card v-if="config.showCard >= 3" :info="{feature: playedCards[2].feature,  data: playedCards[2].data}"></Card>
                    <Card v-if="config.showCard >= 4" :info="{feature: playedCards[3].feature,  data: playedCards[3].data}"></Card>
                    <Card v-if="config.showCard >= 5" :info="{feature: playedCards[4].feature,  data: playedCards[4].data}"></Card>
                    <Card v-if="config.showCard >= 6" :info="{feature: playedCards[5].feature,  data: playedCards[5].data}"></Card>
                    <Card v-if="config.showCard >= 7" :info="{feature: playedCards[6].feature,  data: playedCards[6].data}"></Card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import Card from '../components/Card.vue'
    export default {
        name: 'Game',
        components: {
            Card,
        },
        data: function() {
            return {
                round: 2,
                winner_round: '',
                room_id: '',
                users_interval:'',
                config: {
                    userPlaying: 1,
                    showCard: 0,
                    showWinner: false,
                    gameState: 'playing'
                },
                playedCards:[],
                myCards: [],
                players: []
            }
        },
        methods: {
            async onFeatures(returned) {
                // SELECCIONA LA CARACTERÍSTICA
                const select_characteristic = new Promise((resolve, reject)=> {
                    axios.post(`http://127.0.0.1:8000/api/match/${this.room_id}/firstGame`, {
                        round_match_id: 1,
                        characteristic: returned.feature
                    },{ headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                    .then(res => {
                        resolve(res.data.data);
                    }).catch(err => {reject(err.response)});
                })
                let round = await select_characteristic;
                // LANZA LA CARTA
                let throw_card = new Promise((resolve, reject)=> {
                    axios.post(`http://127.0.0.1:8000/api/round/throwCard/match/${this.room_id}`, null,
                    { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                    .then(res => {
                        resolve(res.data.data);
                    }).catch(err => {reject(err.response)});
                });
                await throw_card;
                // COMPARA LAS CARTAS
                const cards_compare = new Promise((resolve, reject)=> {
                    axios.post(`http://127.0.0.1:8000/api/round/${round.id}/compareCards`, null,
                    { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                    .then(res => {
                        resolve(res.data.data);
                    }).catch(err => {reject(err.response)});
                });
                let compare = await cards_compare;
                this.winner_round = compare[0].name;
                // OBTIENE LAS CARTAS POR RONDA
                const cards_of_round = new Promise((resolve, reject)=> {
                    axios.get(`http://127.0.0.1:8000/api/round/${round.id}/cards`,
                    { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                    .then(res => {
                        resolve(res.data);
                    }).catch(err => {reject(err.response)});
                });

                let cards = await cards_of_round;

                this.config.userPlaying = 1; // USUARIO QUE TIENE EL TURNO

                const result = this.myCards.filter(card => card.id != this.myCards[0].id);

                cards.forEach(card => {
                    let json ={
                        id: card.fk_card,
                        name: card.name,
                        cylinder: card.cylinder,
                        year: card.year,
                        torque: card.torque,
                        top_speed: card.top_speed,
                        weigh: card.weight,
                    }

                    this.playedCards.push({
                        feature: returned,
                        data: json
                    });
                });


                this.myCards = result;

                this.config.showCard = 1;
                let i = 2;
                let intervalo = setInterval(()=> {
                    this.config.showCard = i;
                    i++;
                    // TIRA LAS CARTAS DE LOS USUARIOS
                    if(i > this.players.length) {
                        clearInterval(intervalo);
                        setTimeout(() => {
                            this.config.showWinner = true;
                            setTimeout(() => {
                                this.config.showWinner = false;
                                this.playedCards = [];
                                this.config.showCard = 0;

                                this.round = this.round++;
                                this.getNextRoundCard();
                                return;
                                setTimeout(() => {this.config.gameState = 'finished';}, 1000);
                            }, 2000);
                        }, 800);
                    }
                }, 500);
            },
            usersInLine(){
                axios.get(`http://127.0.0.1:8000/api/match/${this.room_id}/users`, 
                { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                .then(res => {
                    this.players = res.data;
                    this.num_players = res.data.length;
                }).catch(err => {console.log(err.response)})
            },
            getFirstCard(){
                axios.get(`http://127.0.0.1:8000/api/match/${this.room_id}/firstCard`, 
                { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                .then(res => {
                    this.myCards = [];
                    let card ={
                        id: res.data[0].fk_card,
                        name: res.data[0].name,
                        cylinder: res.data[0].cylinder,
                        year: res.data[0].year,
                        torque: res.data[0].torque,
                        top_speed: res.data[0].top_speed,
                        weigh: res.data[0].weight,
                    }
                    this.myCards.push(card);
                }).catch(err => {console.log(err.response)})
            },
            getNextRoundCard(){
                axios.get(`http://127.0.0.1:8000/api/round/${this.round}/cards`, 
                { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
                .then(res => {
                    console.log(res.data);
                    this.myCards = [];
                    let card ={
                        id: res.data[0].fk_card,
                        name: res.data[0].name,
                        cylinder: res.data[0].cylinder,
                        year: res.data[0].year,
                        torque: res.data[0].torque,
                        top_speed: res.data[0].top_speed,
                        weigh: res.data[0].weight,
                    }
                    this.myCards.push(card);
                }).catch(err => {console.log(err.response)})
            }
        },
        mounted(){
            this.room_id = this.$route.params.id;
            this.usersInLine();
            this.getFirstCard();
            this.interval = setInterval(()=> {
                this.usersInLine();
            }, 2000);
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
        background: #fff;
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
        box-shadow: 0 0 20px #0000;
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
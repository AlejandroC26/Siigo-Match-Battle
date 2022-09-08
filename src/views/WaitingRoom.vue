<template>
    <div class="home-game">
        <div class="color-line"></div>
        <div class="game-menu">
            <div class="game-menu-header">
                <div class="game-name">Siigo Match Battle</div>
            </div>
            <div class="game-menu-body">
                <!-- IMAGEN -->
                <div class="game-image">
                    <img src="../assets/img/game/menu-image.png" alt="">
                </div>
                <!-- CONTENIDO -->
                <div class="game-options">
                    <div class="game-buttons code-room">
                        <div style="margin-bottom: 1rem;">
                            <span>Código de la sala</span>
                            <div class="room-id">
                                {{room_id}}
                            </div>
                        </div>
                        <div class="middle-row">
                            <div>N° Jugadores</div>
                            <div>{{num_players}}/7</div>
                        </div>
                        <div class="middle-row"
                        style="margin-bottom: 1rem;">
                            <div>Tiempo límite</div>
                            <div>1h</div>
                        </div>
                        <button @click="startGame()" class="button" 
                            :class="{'disabled': num_players < 2}">
                                Iniciar Partida
                        </button>
                        <router-link to="/inicio" class="button">
                            Abandonar
                        </router-link>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'CreateMatch',
    data(){
        return {
            interval :'',
            room_id: '',
            num_players: 0,
        }
    },
    methods: {
        usersInLine(){
            axios.get(`http://127.0.0.1:8000/api/match/${this.room_id}/users`, 
            { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
            .then(res => {
                console.log('recargando');
                this.num_players = res.data.length;
            }).catch(err => {console.log(err.response)})
        },
        startGame(){
            if(this.num_players < 2) return false;
            axios.post(`http://127.0.0.1:8000/api/match/${this.room_id}/start`, {time_match: 30},
            { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
            .then(res => {
                clearInterval(this.interval);
                window.location.href = '/juego/'+this.room_id;
            }).catch(err => {console.log(err.response)})
        }
        //quitMatch(){window.location.href = '/'}
    },
    mounted(){
        this.room_id = this.$route.params.id;
        this.usersInLine();
        this.interval = setInterval(()=> {
            this.usersInLine();
        }, 2000);
    }
}
</script>
<style scoped>
    .room-id {
        background: #fff;
        padding: .5rem;
        border-radius: .3rem;
        font-weight: bold;
        border: solid 1px rgb(0, 0, 0);
    }
    .code-room {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 0 .5rem #b8b8b8;
        padding: .5rem 1rem;
        font-size: 1.2rem;
    }
    .middle-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }
    .game-menu .game-buttons .button.disabled.disabled {
        background: rgba(0, 0, 0, .2);
        border: solid 2px #fff;
        cursor:not-allowed;
    }
</style>
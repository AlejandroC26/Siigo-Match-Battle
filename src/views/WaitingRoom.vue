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
                        <div>
                            <span>Código de la sala</span>
                            <div class="room-id">
                                # FF123123
                            </div>
                        </div>
                        <div>
                            N° Jugadores 2/7
                        </div>
                        <div>
                            Límite tiempo 1h
                        </div>
                        <router-link to="/juego" class="button">
                            Iniciar Partida
                        </router-link>
                        <button class="button"
                        @click="quitMatch()">
                            Abandonar
                        </button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'CreateMatch',
        methods: {
            quitMatch(){window.location.href = '/'}
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
    }
</style>
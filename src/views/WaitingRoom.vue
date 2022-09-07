<template>
    <div class="home-game">
        <div class="game-menu">
            <div class="game-menu-header">
                <div class="game-name">Siigo Match Battle - Sala Espera</div>
            </div>
            <div class="game-menu-body">
                <!-- CONTENIDO -->
                <div class="game-options">
                    <div class="game-buttons">
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
                <!-- IMAGEN -->
                <div class="game-image">
                    <img src="../assets/img/game/menu-image.png" alt="">
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
        border-radius: 1px;
        font-weight: bold;
        border: solid 1px rgb(0, 0, 0);

    }
</style>
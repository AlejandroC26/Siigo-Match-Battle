<template>
  <div class="home-game">
    <div class="color-line"></div>
    <div class="game-menu">
      <div class="game-menu-header">
        <div class="game-name">Siigo Match Battle</div>
      </div>
      <div class="game-menu-body">
        <div class="game-image">
          <img src="../assets/img/game/menu-image.png" alt="">
        </div>
        <div class="game-options">
          <div class="game-buttons">
            <router-link class="button" to="/sala-espera/123">CREAR PARTIDA</router-link>
            <a class="button" @click="launchModalJoin()">UNIRSE PARTIDA</a>
            <router-link class="button" to="/">COLECCIÓN DE CARTAS</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  methods: {
    launchModalJoin(){
      alert('HOLA');
    }
  }
}
</script>

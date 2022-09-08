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
            <a class="button" to="/sala-espera/123"
            @click="createRoom()">CREAR PARTIDA</a>
            <a class="button" @click="launchModalJoin()">UNIRSE PARTIDA</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  
export default {
  name: 'HomeView',
  methods: {
    createRoom(){
      axios.post('http://127.0.0.1:8000/api/match/register', {time_match:30}, 
      { headers: { "Authorization": "Bearer " + localStorage.getItem('token')}})
      .then(res => {
        console.log(res);
        window.location.href = '/sala-espera/'+res.data.data.id;
      }).catch(err => {
        console.log(err.response)
        this.launchAlert({type: 'error', title: '¡Errror creando partida!'})
      })
      //
    },
  },
}
</script>

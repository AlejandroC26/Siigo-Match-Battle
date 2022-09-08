<template>
    <div class="home-game">
      <div class="color-line"></div>
      <div class="game-menu">
        <div class="game-menu-body">
          <div>
            <form @submit.prevent="Login()">
                <h3>Inicio de Sesión</h3>

                <label for="username">Nombre de Usuario</label>
                <input v-model="user.name" type="text" placeholder="Nombre...">

                <label for="password">Contraseña</label>
                <input v-model="user.password" type="password" placeholder="Contraseña...">

                <button>Ingresar</button>
                <router-link to="/registro">Registrarse</router-link>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
  
<script>
  import axios from 'axios';
  export default {
    name: 'Login',
    data(){
      return {
        user: {
          name: 'santiago',
          password: '123'
        }
      }
    },
    methods: {
      Login(){
        axios.post('http://127.0.0.1:8000/api/auth/login', this.user).then(res => {
          if(res.status == 200){
            localStorage.setItem('token', res.data.access_token)
            window.location.href = '/inicio';
          }
        }).catch(err => {
          console.log(err.response)
          this.launchAlert({type: 'error', title: '¡Usuario o contraseña incorrectos!'})
        })
      },
      launchAlert(config){
          if(!config.timeout) config.timeout = 2500;
          const Toast = this.$swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: config.timeout,
          })
          Toast.fire({
              icon: config.type,
              title: config.title,
              text: config.message,
          })
      },
    },
    
  }
</script>

<style>
     a {
        margin-top: 20px;
        display: block;
    }
    .shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
    }
.shape:last-child{
  background: linear-gradient(
      to right,
      #ff512f,
      #f09819
  );
  right: -30px;
  bottom: -80px;
}
form{
  height: 520px;
  width: 400px;
  background-color: rgba(92, 92, 92, 0.83);
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  border-radius: 10px;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255,255,255,0.1);
  box-shadow: 0 0 40px rgba(8,7,16,0.6);
  padding: 50px 35px;
}
form *{
  font-family: 'Poppins',sans-serif;
  color: #ffffff;
  letter-spacing: 0.5px;
  outline: none;
  border: none;
}
form h3{
  font-size: 32px;
  font-weight: 500;
  line-height: 42px;
  text-align: center;
}

label{
  display: block;
  margin-top: 30px;
  font-size: 16px;
  font-weight: 500;
}
input{
  display: block;
  height: 50px;
  width: 100%;
  background-color: rgba(255,255,255,0.07);
  border-radius: 3px;
  padding: 0 10px;
  margin-top: 8px;
  font-size: 14px;
  font-weight: 300;
}
::placeholder{
  color: #ffffff;
}
button{
  margin-top: 50px;
  width: 100%;
  background-color: #ffffff;
  color: #080710;
  padding: 15px 0;
  font-size: 18px;
  font-weight: 600;
  border-radius: 5px;
  cursor: pointer;
}
.social{
margin-top: 30px;
display: flex;
}
.social div{
background: red;
width: 150px;
border-radius: 3px;
padding: 5px 10px 10px 5px;
background-color: rgba(255,255,255,0.27);
color: #eaf0fb;
text-align: center;
}
.social div:hover{
background-color: rgba(255,255,255,0.47);
}
.social .fb{
margin-left: 25px;
}
.social i{
margin-right: 4px;
}

</style>
<script>
import axios from 'axios';
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      email: '',
      password: '',
      showPassword: false,
      showPasswordd: false,
    }
  },
  methods: {
    ...mapActions(['auth/setUserRole']),
    autoriz() {
      const formData = new FormData();
      formData.append('email', this.email);
      formData.append('password', this.password);
      formData.append('autoriz', true); // добавить флаг "autoriz" в POST запрос

      axios.post('http://localhost/this_is_the_base/Rautorization.php', formData)
           .then(response => {
            if (response.data.success) {
              console.log('Данные успешно добавлены в базу данных');
              const role = response.data.role;
            this['auth/setUserRole']({ userRole: role, userId: response.data.userId });
 // Используйте setUserRole из модуля auth с пространством имен
            if (role === 'admin') {
              this.$router.push({ path: '/admin' });
            } else if (role === 'guest') {
              this.$router.push({ path: '/' });
            } else if (role === 'employer') {
              this.$router.push({ path: '/employer1' });
            }
          } else {
            console.log('Произошла ошибка', response.data.error);
          }
        })
           .catch(error => {
              // Обработка ошибки
              console.log('Произошла ошибка', error);
           });
      }
    }
  }
</script>

<template>
 <div class="sss">
    <form @submit.prevent="autoriz" class="login-form"> 
       <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
      <div class="circle"></div>
        <div class="form-inner">
      <h2 class="form-title">Вход в аккаунт</h2>
      <input type="email" id="email" v-model="email" name="email" required class="form-input" placeholder="email"/>
      <input type="password" id="password" v-model="password" name="password" required class="form-input" placeholder="password"/>
      <input type="submit" value="Войти" name="go" class="form-submit" />
    </div>
    </form>
    </div>
</template>

<style scoped>
* {
    box-sizing: border-box;
 }
 .sss {
    background: url("src/assets/img/img.jpg");
    background-size: 100%;
    margin-top: -45px;
    height: 700px;

 }
.login-form {
    position: relative;
    max-width: 400px;
    top:50px;
    margin: 50px auto 0;
    background: white;
    border-radius: 30px;
 }
 .form-left-decoration, .form-right-decoration {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    background: #f69a73;
    border-radius: 20px;
   
 }
 .form-left-decoration {
    bottom: 60px;
    left: -30px;
 }
 .form-right-decoration {
    top: 60px;
    right: -30px;
 }
 .form-left-decoration:before, .form-left-decoration:after, .form-right-decoration:before, .form-right-decoration:after {
    content: "";
    position: absolute;
    width: 50px;
    height: 20px;
    border-radius: 30px;
    background: white;
 }
 .form-left-decoration:before {
    top: -20px;
 }
 .form-left-decoration:after {
    top: 20px;
    left: 10px;
 }
 .form-right-decoration:before {
    top: -20px;
    right: 0;
 }
 .form-right-decoration:after {
    top: 20px;
    right: 10px;
 }
 .circle {
    position: absolute;
    bottom: 80px;
    left: -55px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
 }
 .form-inner {
    padding: 50px;
 }
 .form-inner input, .form-inner textarea , .form-inner textarea {
    display: block;
    width: 100%;
    padding: 0 20px;
    margin-bottom: 10px;
    background: #E9EFF6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    font-family: 'Roboto', sans-serif;
 }
 .form-inner input[type="submit"] {
    margin-top: 30px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
 }
 .form-inner textarea {
    resize: none;
 }
 .form-inner h3 {
    margin-top: 0;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    font-size: 24px;
    color: #707981;
 }
</style>
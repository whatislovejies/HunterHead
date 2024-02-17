<script>
import axios from 'axios';
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      email_exists: false,
      organization: '',
      number: '+7',
      Email: '',
      password: '',
      passwordd: '',
      showPassword: false,
      showPasswordd: false,
      errors: []
    }
  },
  computed: {
    hasErrors() {
      return this.errors.length > 0;
    }
  },
  methods: {
    ...mapActions(['auth/setUserRole']),
    onSubmit() {
      console.log('onSubmit called');
    this.validateForm();
    console.log('errors:', this.errors);
    if (!this.errors.length) {
      this.register();
    }
  },
    validateForm() {
      this.errors = [];

      if (!this.organization.trim() || this.organization.length < 2) {
        this.errors.push('Введите организацию');
      }

      const phoneRegex = /^\+?[0-9]{11}$/;
      if (!phoneRegex.test(this.number.trim())) {
        this.errors.push('Некорректный телефон');
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.Email.trim())) {
        this.errors.push('Некорректный email');
      }

      if (this.password.length < 6) {
        this.errors.push('Пароль должен содержать не менее 6 символов');
      }

      if (this.password !== this.passwordd) {
        this.errors.push('Пароли не совпадают');
      }
    },
    register() {
        const formData = new FormData();
        formData.append('organization',this.organization);
        formData.append('number',this.number);
        formData.append('Email',this.Email);
        formData.append('password',this.password);
        formData.append('registr',true);
    
        axios.post('http://localhost/this_is_the_base/Rregister.php', formData)
          .then(response => {
            if (response.data === "email_exists") {
             // Если email уже существует, добавить ошибку в массив errors
             this.errors.push("Этот email уже зарегистрирован");
         } 
         else if (response.data.success === true) {
            // Если данные успешно добавлены, перенаправить на главную страницу
            console.log('Данные успешно добавлены в базу данных');
            const role = 'employer'; // Установите роль пользователя
            const userId = response.data.userId; // Получите идентификатор пользователя из ответа сервера
            this['auth/setUserRole']({ userRole: role, userId: userId }); // Установите роль пользователя в хранилище
            this.$router.push('/employer1'); 
         } else {
             // Если произошла какая-то другая ошибка, вывести сообщение об ошибке
             console.log('Произошла ошибка', response.data);
         }
     })
          .catch(error => {
            console.error(error);
          });
    }
  }};
</script>
<template>
  <div class="sss">
  <div class="container">
    <form @submit.prevent="onSubmit" class="login-form">
      <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
      <div class="circle"></div>
        <div class="form-inner">
        <h2 class="form-title">Регистрация</h2>
      <label :class="{'error-label': errors.includes('Введите организацию')}">организация:
        <span class="error-message">{{ errors.includes('Введите организацию') ? 'Введите организацию' : '' }}</span>
      </label>
      <input type="text" name="organization" required v-model.trim="organization" @input="validateForm"
        :class="{'error-input': errors.includes('Введите организацию')}" :title="errors.includes('Введите организацию') ? 'Введите организацию' : ''">

      <label :class="{'error-label': errors.includes('Некорректный телефон')}">Телефон:
        <span class="error-message">{{ errors.includes('Некорректный телефон') ? 'Некорректный телефон' : '' }}</span>
      </label>
      <input type="tel" name="number" required v-model.trim="number" @input="validateForm"
        :class="{'error-input': errors.includes('Некорректный телефон')}" :title="errors.includes('Некорректный телефон') ? 'Некорректный телефон' : ''">

      <label :class="{'error-label': errors.includes('Некорректный email')}">Email:
        <span class="error-message">{{ errors.includes('Некорректный email') ? 'Некорректный email' : '' }}</span>
      </label>
      <input type="email" name="Email" required v-model.trim="Email" @input="validateForm"
        :class="{'error-input': errors.includes('Некорректный email')}" :title="errors.includes('Некорректный email') ? 'Некорректный email' : ''">

      <label :class="{'error-label': errors.includes('Пароль должен содержать не менее 6 символов')}">Пароль:
        <span class="error-message">{{ errors.includes('Пароль должен содержать не менее 6 символов') ? 'Пароль должен содержать не менее 6 символов' : '' }}</span>
      </label>
      <input :type="showPassword ? 'text' : 'password'" name="password" id="password-input" required v-model.trim="password" @input="validateForm"
        :class="{'error-input': errors.includes('Пароль должен содержать не менее 6 символов')}"
        :title="errors.includes('Пароль должен содержать не менее 6 символов') ? 'Пароль должен содержать не менее 6 символов' : ''">
        <a @click="showPassword = !showPassword" class="password-control"></a>

      <label :class="{'error-label': errors.includes('Пароли не совпадают')}">Подтверждение пароля:
        <span class="error-message">{{ errors.includes('Пароли не совпадают') ? 'Пароли не совпадают' : '' }}</span>
      </label>
      <input :type="showPasswordd ? 'text' : 'password'" v-model.trim="passwordd" required @input="validateForm"
        :class="{'error-input': errors.includes('Пароли не совпадают')}" :title="errors.includes('Пароли не совпадают') ? 'Пароли не совпадают' : ''">
      <a class="password-controll" @click="showPasswordd = !showPasswordd"></a>

      <p v-if="errors.includes('Этот email уже зарегистрирован')" class="error-message">{{ errors.find(error => error === 'Этот email уже зарегистрирован') }}</p>

      <button :disabled="hasErrors" type="submit">Регистрация</button>
      </div>
    </form>
  </div>
  </div>
</template>


<style scoped>
.sss {
    background: url("src/assets/img/img.jpg");
    background-size: 100%;
    margin-top: -45px;
    height: 1200px;

 }
.login-form {
    position: relative;
    max-width: 500px;
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
 .form-inner input, .form-inner textarea {
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
 .form-inner select{
 display: block;
    width: 436px;
    height: 45px;
    padding: 0 20px;
    margin-bottom: 10px;
    background: #E9EFF6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    font-family: 'Roboto', sans-serif;
 }
 .form-inner button {
  display: block;
    width: 100%;
    padding: 0 20px;
    margin-bottom: 10px;
    background: #E9EFF6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    font-family: 'Roboto', sans-serif;
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
 .form-inner a{
  margin-left: 130px;
  margin-top: 0;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    font-size: 16px;
    color: #707981;
 }
   .password-control {
	position: absolute;
	top: 349px;
	right: 35px;
	display: inline-block;
	width: 20px;
	height: 20px;
	background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
}
.password-control.view {
	background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
}
.password-controll {
	position: absolute;
  top: 418px;
	right: 35px;
	display: inline-block;
	width: 20px;
	height: 20px;
	background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
}
.password-controll.view {
	background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
}
.error-list {
  color: red;
  margin-top: 10px;
  margin-bottom: 20px;
  padding-left: 0;
  list-style: none;
}
.error-list li {
  margin-bottom: 5px;
}
.error-message{
  color: red;
}
.input-container {
  position: relative;
  }
  
  .input-container .error-message {
    position: absolute;
  top: 100%;
  left: 0;
  font-size: 14px;
    color: red;
    margin-top: 5px;
  }
</style>

<script>
import axios from 'axios';
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      formIsValid: false,
      email_exists: false,
      name: '',
      surname: '',
      patronymic: '',
      telephone: '+7',
      date_birth: '',
      city_residence: '',
      citizenship: '',
      Paul: '',
      email: '',
      password: '',
      passwordd: '',
      errors: [],
      showPassword: false,
      showPasswordd: false,
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
    register() {
      console.log('register called');
      const formData = new FormData();
      formData.append('name', this.name);
      formData.append('surname', this.surname);
      formData.append('patronymic', this.patronymic);
      formData.append('telephone', this.telephone);
      formData.append('date_birth', this.date_birth);
      formData.append('city_residence', this.city_residence);
      formData.append('citizenship', this.citizenship);
      formData.append('Paul', this.Paul);
      formData.append('email', this.email);
      formData.append('password', this.password);
      formData.append('registr', true); // добавить флаг "registr" в POST запрос

      axios.post('http://localhost/this_is_the_base/Sregistr.php', formData)
     .then(response => {
         if (response.data === "email_exists") {
             // Если email уже существует, добавить ошибку в массив errors
             this.errors.push("Этот email уже зарегистрирован");
         } else if (response.data.success === true) {
             // Если данные успешно добавлены, перенаправить на главную страницу
             console.log('Данные успешно добавлены в базу данных');
             const role = 'employer'; // Установите роль пользователя
            const userId = response.data.userId; // Получите идентификатор пользователя из ответа сервера
            this['auth/setUserRole']({ userRole: role, userId: userId });
             this.$router.push('/applicant1');
         } else {
             // Если произошла какая-то другая ошибка, вывести сообщение об ошибке
             console.log('Произошла ошибка', response.data);
         }
     })
     .catch(error => {
         // Обработка ошибки
         console.log('Произошла ошибка', error);
     });
    },
    validateForm() {
      this.errors = [];
      if (!this.surname.trim()) this.errors.push("Введите фамилию");
      if (!this.name.trim()) this.errors.push("Введите имя");
      if (!/^\+?[0-9]{11}$/.test(this.telephone)) this.errors.push("Некорректный телефон");
      if (!this.date_birth) this.errors.push("Введите дату рождения");
      if (!this.city_residence) this.errors.push("Введите город проживания");
      if (!this.citizenship) this.errors.push("Введите гражданство");
      if (!this.Paul) this.errors.push("Введите пол");
      if (!this.email.trim() || !/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(this.email)) this.errors.push("Некорректный email");
      if (!this.password) {
    this.errors.push('Введите пароль');
  } else if (this.password.length < 6) {
    this.errors.push('Пароль должен содержать не менее 6 символов');
  }
      if (this.password !== this.passwordd) this.errors.push("Пароли не совпадают");
      if (new Date().getFullYear() - new Date(this.date_birth).getFullYear() < 18) { this.errors.push('Вам должно быть 18 лет или старше'); } 
    },
  }
}
  //валидация
  
</script>

<template>
  <div class="sss">
    <div class="container">
      <form @submit.prevent="onSubmit()" novalidate class="login-form">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
      <div class="circle"></div>
        <div class="form-inner">
        <h2>Регистрация</h2>
        <label :class="{'error-label': errors.includes('Введите фамилию')}">Фамилия: <span class="error-message">{{ errors.includes('Введите фамилию') ? 'Введите фамилию' : '' }}</span></label>
        <input type="text" name="surname" required v-model.trim="surname" @input="validateForm" :class="{'error-input': errors.includes('Введите фамилию')}" :title="errors.includes('Введите фамилию') ? 'Введите фамилию' : ''">
       

        <label :class="{'error-label': errors.includes('Введите имя')}">Имя: <span class="error-message">{{ errors.includes('Введите имя') ? 'Введите имя' : '' }}</span></label>
        <input type="text" name="name" required v-model.trim="name" @input="validateForm" :class="{'error-input': errors.includes('Введите имя')}" :title="errors.includes('Введите имя') ? 'Введите имя' : ''">
        
        <label>Отчество:</label>
        <input type="text" name="patronymic" v-model.trim="patronymic">
        
        <label :class="{'error-label': errors.includes('Некорректный телефон')}">Телефон: <span class="error-message">{{ errors.includes('Некорректный телефон') ? 'Некорректный телефон' : '' }}</span></label>
        <input type="tel" name="telephone" required v-model.trim="telephone" pattern="[0-9]{10}" @input="validateForm" :class="{'error-input': errors.includes('Некорректный телефон')}" :title="errors.includes('Некорректный телефон') ? 'Некорректный телефон' : ''">
        

        <label :class="{'error-label': errors.includes('Вам должно быть 18 лет или старше')}">Дата рождения: <span class="error-message">{{ errors.includes('Вам должно быть 18 лет или старше') ? 'Вам должно быть 18 лет или старше' : '' }}</span></label>
        <input type="date" name="date_birth" required v-model="date_birth" @input="validateForm" :class="{'error-input': errors.includes('Вам должно быть 18 лет или старше')}" :title="errors.includes('НВам должно быть 18 лет или старше') ? 'Вам должно быть 18 лет или старше' : ''">
        
        <label>Проживание:</label>
        <select name="city_residence" id="city_residence" v-model="city_residence" @change="validateForm">
          <option value="Магнитогорск">Магнитогорск</option>
        </select>
        
        <label>Гражданство:</label>
        <select name="citizenship" id="citizenship" v-model="citizenship" @change="validateForm">
          <option value="Российское">Российское</option>
        </select>
        
        <label>Пол:</label>
        <select name="Paul" id="Paul" v-model="Paul" @change="validateForm">
          <option value="Мужской">Мужской</option>
          <option value="Женский">Женский</option>
        </select>
        
        <label :class="{'error-label': errors.includes('Некорректный email')}">Email: <span class="error-message">{{ errors.includes('Некорректный email') ? 'Некорректный email' : '' }}</span></label>
        <input type="email" name="email" required v-model.trim="email" @input="validateForm" :class="{'error-input': errors.includes('Некорректный email')}" :title="errors.includes('Некорректный email') ? 'Некорректный email' : ''">
        
        <label :class="{'error-label': errors.includes('Введите пароль')}">Пароль:<span v-if="errors.includes('Введите пароль')" class="error-message">Введите пароль</span>
        <span v-if="errors.includes('Пароль должен содержать не менее 6 символов')" class="error-message">Пароль должен содержать не менее 6 символов</span></label>
      <input :type="showPassword ? 'text' : 'password'" v-model.trim="password" name="password" id="password-input" required @input="validateForm" :class="{'error-input': errors.includes('Введите пароль')}" :title="errors.includes('Введите пароль') ? 'Введите пароль' : ''">
      <a @click="showPassword = !showPassword" class="password-control"></a>

        <label :class="{'error-label': errors.includes('Пароли не совпадают')}">Подтверждение пароля:<span class="error-message">{{ errors.includes('Пароли не совпадают') ? 'Пароли не совпадают' : '' }}</span></label>
        <input :type="showPasswordd ? 'text' : 'password'" v-model.trim="passwordd" name="confirm_password" id="password-inputt" required  @input="validateForm" :class="{'error-input': errors.includes('Пароли не совпадают')}" :title="errors.includes('Пароли не совпадают') ? 'Пароли не совпадают' : ''">
        <a @click="showPasswordd = !showPasswordd" class="password-controll"></a>

        <p v-if="errors.includes('Этот email уже зарегистрирован')" class="error-message">{{ errors.find(error => error === 'Этот email уже зарегистрирован') }}</p>

        <input type="submit" class="sub"  value="Зарегистрироваться" name="register">
        <router-link to="/Sautoriz">Уже есть аккаунт? Войти!</router-link>
        </div>
      </form>
    </div>
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
 .form-inner select {
  display: block;
    width: 400px;
    height:45px;
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
   .password-control {
	position: absolute;
  top: 772px;
	right: 70px;
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
  top: 842px;
	right: 70px;
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
  
  .input-container.error-input input {
  border-color: red;
  }
</style>
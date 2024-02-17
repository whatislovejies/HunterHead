<script>
import axios from 'axios';
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      surname: '',
      name: '',
      patronymic: '',
      telephone: '',
      date_birth: '',
      city_residence: '',
      Paul: '',
      citizenship: '',
      Email: '',
      password: '',
      userId: '', // Вы должны инициализировать переменную userId
    };
  },
  mounted() {
    this.fetchUser();
  },
  created() {
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    ...mapActions(['auth/setUserRole']),
    fetchUser() {
      axios.get('http://localhost/this_is_the_base/person.php', {
        params: {
          id_app: this.userId,
        },
      })
      .then(response => {
        const userData = response.data;
        this.surname = userData.surname;
        this.name = userData.name;
        this.patronymic = userData.patronymic;
        this.telephone = userData.telephone;
        this.date_birth = userData.date_birth;
        this.city_residence = userData.city_residence;
        this.Paul = userData.Paul;
        this.citizenship = userData.citizenship;
        this.Email = userData.Email;
        this.password = userData.password;
      })
      .catch(error => {
        console.error(error);
      });
    },
    updateUser() {
      axios.post('http://localhost/this_is_the_base/person.php', {
        id_app: this.userId,
        surname: this.surname,
        name: this.name,
        patronymic: this.patronymic,
        telephone: this.telephone,
        date_birth: this.date_birth,
        city_residence: this.city_residence,
        Paul: this.Paul,
        citizenship: this.citizenship,
        Email: this.Email,
        password: this.password,
      })
      .then(response => {
        // Обработка успешного обновления данных
        console.log(response.data);
      })
      .catch(error => {
        console.error(error);
      });
    },
  },
};
</script>


<template>
    <div class="sss">
      <form @submit.prevent="updateUser" class="login-form">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
      <div class="circle"></div>
      <div class="form-inner">
        <label for="surname">Фамилия:</label>
        <input type="text" v-model="surname" id="surname">
  
        <label for="surnanameme">Имя:</label>
        <input type="text" v-model="name" id="name">

        <label for="patronymic">Отчество:</label>
        <input type="text" v-model="patronymic" id="patronymic">
  
        <label for="telephone">Телефон:</label>
        <input type="text" v-model="telephone" id="telephone">

        <label for="date_birth">Дата рождения:</label>
        <input type="date" v-model="date_birth" id="date_birth">

        <label for="city_residence">Проживание:</label>
        <input type="text" v-model="city_residence" id="city_residence">

        <label for="citizenship">Гражданство:</label>
        <input type="text" v-model="citizenship" id="citizenship">

        <label for="Paul">Пол::</label>
        <input type="text" v-model="Paul" id="Paul">

        <label for="Email">Email:</label>
        <input type="Email" v-model="Email" id="Email">

        <button type="submit" class="form-submit">Save</button>
      </div>
      </form>
    </div>
  </template>

<style scoped>
.sss {
    background: url("src/assets/img/img.jpg");
    background-size: 100%;
    margin-top: -45px;
    height: 900px;

 }
.login-form {
    position: relative;
    max-width: 400px;
    max-height:760px;
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
 .form-inner select{
  display: block;
    width: 340px;
    height: 40px;
    padding: 0 20px;
    margin-bottom: 10px;
    background: #E9EFF6;
    line-height: 40px;
    border-width: 0;
    border-radius: 20px;
    font-family: 'Roboto', sans-serif;
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
 .form-inner input[type="submit"] {
    margin-top: 30px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
 }
.form-submit{
  display: block;
  width: 180px;
  margin-left: 60px;
  height: 40px;
  margin-top: 30px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
    border-radius: 20px;
}

</style>

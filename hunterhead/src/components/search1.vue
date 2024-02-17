<script>
import axios from 'axios';
import { mapActions } from 'vuex';
export default {
  data() {
    return {
      searchText: '',
      vacancies: [],
      showDropdown: false,
      userId: ''
    };
  },
  created() {
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    ...mapActions(['logout']),
    logout () {
      // Очистка данных в хранилище Vuex
    this.$store.dispatch('auth/logout');
    this.$router.push('/');

    },
    goToVacancyDetails(vacancyId) {
      this.$router.push(`/vacancy/${vacancyId}`);
    },
    searchVacancies(searchText) {
      const url = `http://localhost/this_is_the_base/search.php?searchText=${encodeURIComponent(searchText)}`;
      axios.get(url)
        .then(response => {
          this.vacancies = response.data;
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    },
    sortVacancies(sortBy) {
      const url = `http://localhost/this_is_the_base/search.php?sortBy=${encodeURIComponent(sortBy)}`;
      axios.get(url)
        .then(response => {
          this.vacancies = response.data;
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    applyForVacancy(vacancyId,userId) {
      const url = `http://localhost/this_is_the_base/apply.php?vacancyId=${encodeURIComponent(vacancyId)}&userId=${encodeURIComponent(this.userId)}`;
      const data = {
    vacancyId: vacancyId,
    userId: this.userId
  };
      axios.get(url,data)
        .then(response => {
          // Обработка ответа от сервера, если необходимо
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    }
  }
};

</script>

<template>
  <header>
      <ul class="menu">
        <li>
          <router-link to="" class="resume_create" @click="createResume">
            Создать резюме
          </router-link>
          <p v-if="resumeExists===true" class="error-message">
            Ошибка: Резюме уже существует.
          </p>
        </li>
        <li class="dropdown">
          <router-link to="#" class="entrance" @click="toggleDropdown">Личный кабинет <i class="fa fa-user"></i></router-link>
          <ul class="dropdown-menu" v-show="showDropdown" :class="{ 'dropdown-open': showDropdown }">
            <li class="one"><router-link to="/person">Личные данные</router-link></li>
            <li class="one"><router-link to="/resume_data">Резюме</router-link></li>
            <li class="one"><router-link to="/responseAp">Отклики</router-link></li>
            <li class="one"><router-link to="#" @click="logout">Выход</router-link></li>
          </ul>
        </li>
      </ul>
      <form @submit.prevent="goToOtherPage">
        <input type="text" placeholder="Поиск" class="input" v-model="searchText">
        <button type="submit" class="btn" @click="searchVacancies(searchText)"><i class="fas fa-search"></i></button><br>
      </form>
  </header>
  <div class="container">
    <div class="right-block">
      <h3>Список вакансий:</h3>
      <ul class="job-list">
        <li class="job-item" v-for="vacancy in vacancies" :key="vacancy.id">
          <div class="job-title">{{ vacancy.title }}</div>
          <div class="job-description">{{ vacancy.salary }}</div>
          <div class="job-description">{{ vacancy.description_vacancy }}</div>
          <button @click="applyForVacancy(vacancy.id)" class="btng" >Откликнуться</button>
          <input type="submit" value="Показать контакты" class="btnw" @click="goToVacancyDetails(vacancy.id)">
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
header {
  position: sticky;
  top: 0;
  z-index: 999;
}

.middle-menu {
  background-size: cover;
  background-repeat: no-repeat;
  height: 750px;
  margin-top: -70px;
}

.menu {
  border-bottom: 60px solid #E0FFFF;
  position: relative;
  top: -104px;
}

form {
  position: relative;
  width: 500px;
  margin: 0 auto;
  height: 42px;
  margin-top: -30px;
}

.container {
  display: flex;
  flex-direction: row;
}

.left-block {
  flex: 1;
  padding: 10px;
}

.right-block {
  flex: 2;
  margin-left: -440px;
  padding: 10px;
}

input[type="radio"] {
  margin-right: 10px;
}

.job-list {
  list-style: none;
  padding: 0;
}

.job-item {
  margin-bottom: 10px;
  border-left: 5px solid #5F9EA0;
}

.job-title {
  font-weight: bold;
  margin-bottom: 5px;
  font-size: 24px;
  margin-left: 10px;
}

.job-description {
  margin-bottom: 5px;
  margin-left: 10px;
}

.container {
  margin-top: 100px;
  margin-left: 470px;
}

.btng {
  background-color: #feb386;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-top: 20px;
  margin-left: 15px;
}

.btnw {
  background-color: white;
  padding: 10px;
  border: 1px solid #feb386;
  border-radius: 5px;
  margin-left: 10px;
  margin-top: 20px;
}

.btng:hover {
  transform: scale(1.1);
}

.btnw:hover {
  transform: scale(1.1);
  background-color: #feb386;
  color: white;
}

.vidget {
  display: flex;
  margin-top: 80px;
  margin-left: -270px;
}

.vidget li {
  margin-left: 29px;
  list-style: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.one {
  padding-left: 10px;
}

.dropdown-menu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0px;
  padding: 0;
  margin-top: 5px;
  transition: height 0.5s ease;
}

.dropdown .dropdown-menu {
  display: block;
  white-space: normal;
}

.dropdown-menu li {
  width: 100%;
  margin-left: -12px;
  margin-top: -50px;
}

.dropdown-menu li a {
  display: block;
  padding: 10px;
  color: #333;
  text-decoration: none;
  border-radius: 50px;
  background-color: #fff;
}
.dropdown-menu li a:hover{
  background: #feb386;
}
.dropdown-menu li:last-child a {
  border-bottom: none;
}
.dropdown-menu.dropdown-open {
  height: auto;
  animation: slide-down 0.9s ease;
}
@keyframes slide-down {
  0% {
    transform: translateY(-30%);
  }
  100% {
    transform: translateY(0);
  }
}
.error-message{
  color: red;
  background-color: #000;
}
footer {
	position: absolute;
	left: 0;
	bottom: 0;
	width: 97%;
	height: 80px;
}
</style>
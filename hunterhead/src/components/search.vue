<script>
import axios from 'axios';

export default {
  data() {
    return {
      searchText: '',
      vacancies: []
    };
  },
  methods: {
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
    goToVacancyDetails(vacancyId) {
      this.$router.push(`/vacancy/${vacancyId}`);
    },
  }
};

</script>

<template>
    <header>
    <nav class="top-menu">
        <ul class="menu-main">
          <li class="left-item current"><router-link to="/">Соискателям</router-link></li>
          <li class="left-item"><router-link to="/employer">Работодателям</router-link></li>
      </ul>
      </nav>
      <section class="midle-menu">
      <ul class="menu">
        <li class=""><router-link to="/Sregister" class="resume_create">Создать резюме</router-link></li>
        <li class=""><router-link to="/Sautoriz" class="entrance">Вход</router-link></li>
    </ul>
      <form @submit.prevent="goToOtherPage">
        <input type="text" placeholder="Поиск" class="input" v-model="searchText">
    <button type="submit" class="btn" @click="searchVacancies(searchText)"><i class="fas fa-search"></i></button><br>
      </form>
    </section>
    <div class="container">
  
  <div class="right-block">
   <h3>Список вакансий:</h3>
   <ul class="job-list">
    <li class="job-item" v-for="vacancy in vacancies" :key="vacancy.id">
      <div class="job-title">{{ vacancy.title }}</div>
      <div class="job-description">{{ vacancy.salary }}</div>
      <div class="job-description">{{ vacancy.description_vacancy }}</div>
      <input type="submit" value="Откликнуться" class="btng">
     <input type="submit" value="Показать контакты" class="btnw" @click="goToVacancyDetails(vacancy.id)">
    </li>
   </ul>
  </div>
 </div>
    </header>
  
</template>

<style scoped>
.midle-menu{
  background-size: cover;
  background-repeat: no-repeat;
  height: 750px;
  margin-top: -70px; 
}
.menu {
    border-bottom: 60px solid #E0FFFF;
    
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
   flex-direction: row
  }

  .left-block {
   flex: 1;
   padding: 10px;
  }

  .right-block {
   flex: 2;
   margin-left:-440px;
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

  .container{
    margin-top: -400px;
    margin-left: 470px;
  }
  .btng{
  background-color: #feb386;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-top: 20px;
  margin-left: 15px;
}
.btnw{
  background-color: white;
  padding: 10px;
  border: 1px solid #feb386;
  border-radius: 5px;
  margin-left: 10px;
  margin-top: 20px;
  }
  .btng:hover{
    transform: scale(1.1);
  }
  .btnw:hover{
    transform: scale(1.1);
    background-color: #feb386;
    color: white;
  }
.vidget{
    display: flex;
    margin-top: 80px;
    margin-left:-270px
}
.vidget li{
    margin-left:29px;
    list-style: none;
}
</style>

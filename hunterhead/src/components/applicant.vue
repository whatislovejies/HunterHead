<script>
import axios from 'axios';
export default {
  data() {
    return {
      showNewVacancies: true,
      showWorkFromHome: false,
      showPartTime: false,
      showNoExperience: false,
      name: 'HomePage',
      vacancies: [],
      vacanciesNew: [], // Переменная для новых вакансий
      vacanciesHome: [], // Переменная для работы из дома
      vacanciesPartTime: [], // Переменная для подработки
      vacanciesNoExperience: [], // Переменная для работы без опыта
    }
  },

  mounted() {
    // Получение данных из сервера
    axios.get('http://localhost/this_is_the_base/vacancy.php')
      .then(response => {
        this.vacancies = response.data;
      })
      .catch(error => {
        console.log(error);
      });


      axios.get('http://localhost/this_is_the_base/getVacancies.php?category=new')
    .then(response => {
      this.vacanciesNew = response.data;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о новых вакансиях:', error);
    });

  // Получение данных для категории "Работа из дома"
  axios.get('http://localhost/this_is_the_base/getVacancies.php?category=home')
    .then(response => {
      this.vacanciesHome = response.data;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансиях для работы из дома:', error);
    });

  // Получение данных для категории "Подработка"
  axios.get('http://localhost/this_is_the_base/getVacancies.php?category=underworking')
    .then(response => {
      this.vacanciesPartTime = response.data;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансиях для подработки:', error);
    });

  // Получение данных для категории "Работа без опыта"
  axios.get('http://localhost/this_is_the_base/getVacancies.php?category=noexperience')
    .then(response => {
      this.vacanciesNoExperience = response.data;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансиях для работы без опыта:', error);
    });      
  },
  methods: {
      goToOtherPage () {
      this.$router.push('/Search')
    },
    goToVacancyDetails(vacancyId) {
      this.$router.push(`/vacancy/${vacancyId}`);
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
    },
  },
};

</script>

<template>
  <div>
    <header>
      
      <nav class="top-menu">
        <ul class="menu-main">
          <li class="left-item current"><router-link to="/">Соискателям</router-link></li>
          <li class="left-item"><router-link to="/employer">Работодателям</router-link></li>
      </ul>
      </nav>
      <section class="middle-menu">
      <ul class="menu">
        <li class=""><router-link to="/Sregister" class="resume_create">Регистрация</router-link></li>
        <li class=""><router-link to="/Sautoriz" class="entrance">Вход</router-link></li>
    </ul>
      <form class="form">
        <h1 >Работа найдётся для каждого</h1>
        <input type="text" placeholder="Поиск" class="input">
        <button type="submit" class="btn" @click="goToOtherPage"><i class="fas fa-search"  ></i></button>
      </form>
      <router-link to="/employer">Я ищу сотрудника</router-link> 
    </section>  
      </header>
      <section class="actual-menu">
        <ul class="skyline">
          <li @click.prevent="showNewVacancies = true; showWorkFromHome = false; showPartTime = false; showNoExperience = false;">
        <router-link to="" :class="{ 'active-link': showNewVacancies }">Новые вакансии</router-link>
      </li>
      <li @click.prevent="showNewVacancies = false; showWorkFromHome = true; showPartTime = false; showNoExperience = false;">
        <router-link to="" :class="{ 'active-link': showWorkFromHome }">Работа из дома</router-link>
      </li>
      <li @click.prevent="showNewVacancies = false; showWorkFromHome = false; showPartTime = true; showNoExperience = false;">
        <router-link to="" :class="{ 'active-link': showPartTime }">Подработка</router-link>
      </li>
      <li @click.prevent="showNewVacancies = false; showWorkFromHome = false; showPartTime = false; showNoExperience = true;">
        <router-link to="" :class="{ 'active-link': showNoExperience }">Работа без опыта</router-link>
      </li>
          <li><router-link to=" "></router-link></li>
        </ul>
        <div v-show="showNewVacancies">
  <div style="display: flex; margin-top:50px;">
    <div v-for="vacancy in vacanciesNew.slice(0, 3)" :key="vacancy.id">
      <div style="width: 426px; background-color: #f2f2f2; padding: 20px;">
        <div class="s1">{{ vacancy.date }}</div>
        <div class="s2">{{ vacancy.title }}</div>
        <div class="s3">{{ vacancy.description_vacancy }}</div>
        <div class="s4">{{ vacancy.key_skills }}</div>
        <button class="btng">Откликнуться</button>
        <button class="btnw" @click="goToVacancyDetails(vacancy.id)">Подробнее</button>
      </div>
    </div>
  </div>
</div>
<div v-show="showWorkFromHome">
  <div style="display: flex; margin-top:50px;">
    <div v-for="vacancy in vacanciesHome.slice(0, 3)" :key="vacancy.id">
      <div style="width: 426px; background-color: #f2f2f2; padding: 20px;">
        <div class="s1">{{ vacancy.date }}</div>
        <div class="s2">{{ vacancy.title }}</div>
        <div class="s3">{{ vacancy.description_vacancy }}</div>
        <div class="s4">{{ vacancy.key_skills }}</div>
        <button class="btng">Откликнуться</button>
        <button class="btnw" @click="goToVacancyDetails(vacancy.id)">Подробнее</button>
      </div>
    </div>
  </div>
</div>
<div v-show="showPartTime">
  <div style="display: flex; margin-top:50px;">
    <div v-for="vacancy in vacanciesPartTime.slice(0, 3)" :key="vacancy.id">
      <div style="width: 426px; background-color: #f2f2f2; padding: 20px;">
        <div class="s1">{{ vacancy.date }}</div>
        <div class="s2">{{ vacancy.title }}</div>
        <div class="s3">{{ vacancy.description_vacancy }}</div>
        <div class="s4">{{ vacancy.key_skills }}</div>
        <button class="btng">Откликнуться</button>
        <button class="btnw" @click="goToVacancyDetails(vacancy.id)">Подробнее</button>
      </div>
    </div>
  </div>
</div>
<div v-show="showNoExperience">
  <div style="display: flex; margin-top:50px;">
    <div v-for="vacancy in vacanciesNoExperience.slice(0, 3)" :key="vacancy.id">
      <div style="width: 426px; background-color: #f2f2f2; padding: 20px;">
        <div class="s1">{{ vacancy.date }}</div>
        <div class="s2">{{ vacancy.title }}</div>
        <div class="s3">{{ vacancy.description_vacancy }}</div>
        <div class="s4">{{ vacancy.key_skills }}</div>
        <button class="btng">Откликнуться</button>
        <button class="btnw" @click="goToVacancyDetails(vacancy.id)">Подробнее</button>
      </div>
    </div>
  </div>
</div>
      </section>
      <section class="bblock">
  <h1>Работа и вакансии в Магнитогорске</h1>
    <div v-for="vacancy in vacancies" :key="vacancy.id" class="block" @click="goToVacancyDetails(vacancy.id)">
  <h2>{{ vacancy.title }}</h2>
  <p>{{ vacancy.salary }} р</p>
  <p>{{ vacancy.work_experience }}</p>
</div>
      </section>
    <footer>
  <p>© 2023 Работа.онлайн - поиск работы онлайн. Все права защищены.</p>
  <nav>
   <ul>
    <li><a href="#">Политика конфиденциальности</a></li>
    <li><a href="#">Условия использования</a></li>
    <li><a href="#">О нас</a></li>
   </ul>
  </nav>
 </footer>
 
  </div>
</template>

<style scoped>
.s1{
  font-size: 18px;
  font-weight: bold;
}
.s2{
  font-size: 24px;
  font-weight: bold;
  margin-top: 10px;
}
.s3{
  font-size: 16px;
   margin-top: 20px;
}
.s4{
  font-size: 16px;
   margin-top: 10px;
}
.btng{
  background-color: #feb386;
  color: white;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-top: 20px;
}
.btnw{
  background-color: white;
  color: black;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-left: 10px;
  margin-top: 20px;
  }
  .bblock{
    width: 1400px;
    margin-left:12%;
  }
  .block {
    display: inline-block;
    width: 304px;
    margin: 10px;
    padding: 10px;
    border: 1px solid black;
    text-align: center;
    border-right: 5px solid #5F9EA0;
    
}
.block:hover {
  transform: scale(1.1);
}
</style>

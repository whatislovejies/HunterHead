<script>
import axios from 'axios';

export default {
  data() {
    return {
      vacancy: null
    };
  },
  mounted() {
    const vacancyId = this.$route.params.id;

    axios.get(`http://localhost/this_is_the_base/vacancyid.php?id=${vacancyId}`)
      .then(response => {
        this.vacancy = response.data;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>


<template>
<div class="vacancy-details">
    <div class="vacancy-card">
      <h2 v-if="vacancy" class="vacancy-title">{{ vacancy.title }}</h2>
      <p v-if="vacancy" class="vacancy-info">Зарплата: {{ vacancy.salary }}</p>
      <p v-if="vacancy" class="vacancy-info">Место работы: {{ vacancy.place_work }}</p>
      <p v-if="vacancy" class="vacancy-description">Описание вакансии:{{ vacancy.description_vacancy }}</p>
      <p v-if="vacancy" class="vacancy-info">Требуемый опыт работы: {{ vacancy.work_experience }}</p>
      <p v-if="vacancy" class="vacancy-info">Обязанности сотрудника: {{ vacancy.employee_responsibilities }}</p>
      <p v-if="vacancy" class="vacancy-info">Ключевые навыки: {{ vacancy.key_skills }}</p>
      <button class="btng" @click="applyForVacancy(vacancy.id)">Откликнуться</button>
    </div>
  </div>
</template>

<style scoped>
.vacancy-details {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f2f2f2;
}

.vacancy-card {
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.vacancy-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

.vacancy-info {
  margin-bottom: 10px;
  color: #666;
}

.vacancy-description {
  margin-top: 20px;
  color: #333;
}
</style>

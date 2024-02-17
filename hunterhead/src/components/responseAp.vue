<script>
import axios from 'axios';

export default {
  data() {
    return {
      responses: [], // Массив для хранения откликов
      userId: '' // Идентификатор пользователя (соискателя)
    };
  },
  created() {
    this.userId = localStorage.getItem('userId');
    this.getResponses();
  },
  methods: {
    getResponses() {
      const userId = this.userId;
      const url = `http://localhost/this_is_the_base/get_responsesAp.php?userId=${userId}`;
      axios.get(url)
        .then(response => {
          this.responses = response.data;
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    }
  }
}
</script>


<template>
    <div>
      <header>
        <!-- Ваш заголовок и меню -->
      </header>
      <div class="profile-container">
        <h2>Личный кабинет соискателя</h2>
        <div v-if="responses.length === 0">
          <p>У вас пока нет откликов.</p>
        </div>
        <div v-else>
          <h3>Список откликов:</h3>
          <table>
            <thead>
              <tr>
                <th>Название вакансии</th>
                <th>Статус отклика</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="response in responses" :key="response.id">
                <td>{{ response.vacancy_title }}</td>
                <td>{{ response.status }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  

<style scoped>
.profile-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f0f0;
  border-radius: 5px;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

p {
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #f8f8f8;
  font-weight: bold;
}

tr:hover {
  background-color: #f5f5f5;
}
</style>

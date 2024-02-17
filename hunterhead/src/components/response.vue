<script>
import axios from 'axios';

export default {
  data() {
    return {
      responses: [], // Массив для хранения откликов
      userId: ''
    };
  },
  created() {
    this.getResponses(); // Вызов метода при создании компонента
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    getResponses() {
      const userId = localStorage.getItem('userId');
      const url = `http://localhost/this_is_the_base/get_responses.php?userId=${userId}`;
      axios.get(url)
        .then(response => {
          this.responses = response.data.map(response => {
            response.isAccepted = false; // Добавление свойства isAccepted со значением false
            return response;
          });
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    },
    viewResume(resumeId) {
      // Метод для просмотра полного резюме
      const url = `http://localhost/this_is_the_base/view_resume.php?resumeId=${resumeId}`;
      window.open(url, "_blank", "noopener noreferrer"); // Открытие резюме в новой вкладке
    },
    rejectResponse(responseId) {
      // Метод для отклонения отклика
      const url = `http://localhost/this_is_the_base/reject_response.php?responseId=${responseId}`;
      axios.get(url)
        .then(() => {
          this.getResponses(); // Обновление списка откликов
        })
        .catch(error => {
          console.error('Ошибка при выполнении запроса:', error);
        });
    },
    acceptResponse(responseId) {
      // Метод для принятия отклика
      const url = `http://localhost/this_is_the_base/accept_response.php?responseId=${responseId}`;
      axios.get(url)
        .then(() => {
          const response = this.responses.find(response => response.id === responseId);
          if (response) {
            response.isAccepted = true;
          }
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
      <h2>Личный кабинет </h2>
      <table class="responses-table">
        <thead>
          <tr>
            <th>Название вакансии</th>
            <th>Соискатель</th>
            <th>Email соискателя</th>
            <th>Статус отклика</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="response in responses" :key="response.id">
            <td>{{ response.vacancy_title }}</td>
            <td>{{ response.name }}</td>
            <td>{{ response.email }}</td>
            <td>{{ response.status }}</td>
            <td>
              <button v-if="!response.isAccepted" @click="rejectResponse(response.id)" class="response-action-btn">Отклонить</button>
              <button v-if="!response.isAccepted" @click="acceptResponse(response.id)" class="response-action-btn accept-btn">Принять</button>
              <button v-if="response.status === 'принят'" @click="viewResume(response.resume_id)" class="view-resume-btn">Просмотреть резюме</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.profile-container {
  margin: 20px;
}

.responses-table {
  width: 100%;
  border-collapse: collapse;
}

.responses-table th,
.responses-table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

.responses-table th {
  background-color: #f0f0f0;
}

.response-action-btn {
  padding: 5px 10px;
  background-color: #e74c3c;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.response-action-btn.accept-btn {
  background-color: #2ecc71;
}
.response-action-btn.accept-btn:hover {
  background-color: #b4fad1;
}
.response-action-btn:hover {
  background-color: #f08e8e;
}

.view-resume-btn {
  padding: 5px 10px;
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

.view-resume-btn:hover {
  background-color: #2980b9;
}
</style>

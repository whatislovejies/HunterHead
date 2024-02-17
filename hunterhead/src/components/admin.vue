<script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        vacancies: [],
        resumes: [],
        responses: [],
        isEditModalOpen: false,
        isEditModalOpentwo: false,
        isEditModalOpenthree: false,
        selectedVacancyId: null,
        selectedResumeId: null,
        selectedResponseId: null,
        editedVacancy: {},
        editedResume: {},
        editedResponse: {},
      };
    },
    mounted() {
      this.fetchVacancies();
      this.fetchResumes();
      this.fetchResponses();
    },
    methods: {
      fetchVacancies() {
        axios.get('http://localhost/this_is_the_base/get_vacancies.php')
          .then(response => {
            this.vacancies = response.data;
          })
          .catch(error => {
            console.error('Ошибка при получении вакансий:', error);
          });
      },
      fetchResumes() {
        axios.get('http://localhost/this_is_the_base/get_resumes.php')
          .then(response => {
            this.resumes = response.data;
          })
          .catch(error => {
            console.error('Ошибка при получении резюме:', error);
          });
      },
      fetchResponses() {
        axios.get('http://localhost/this_is_the_base/get_responsesAdmin.php')
          .then(response => {
            this.responses = response.data;
          })
          .catch(error => {
            console.error('Ошибка при получении откликов:', error);
          });
      },
      deleteVacancy(vacancyId) {
  axios.delete(`http://localhost/this_is_the_base/delete_vacancy.php?id=${vacancyId}`)
    .then(response => {
      // Обработка успешного удаления вакансии
      // Например, обновление списка вакансий после удаления
      this.fetchVacancies();
    })
    .catch(error => {
      console.error('Ошибка при удалении вакансии:', error);
    });
},
editVacancy(vacancyId) {
  // Запрос к серверу для получения данных о выбранной вакансии
  this.selectedVacancyId = vacancyId;
  axios.get(`http://localhost/this_is_the_base/get_vacancy.php?id=${vacancyId}`)
    .then(response => {
      // Присваиваем полученные данные объекту editedVacancy
      this.editedVacancy = response.data;
      // Открываем модальное окно
      this.isEditModalOpen = true;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансии:', error);
    });
},
editResume(ResumeId) {
  // Запрос к серверу для получения данных о выбранной вакансии
  this.selectedResumeId = ResumeId;
  axios.get(`http://localhost/this_is_the_base/get_resume.php?id=${ResumeId}`)
    .then(response => {
      // Присваиваем полученные данные объекту editedVacancy
      this.editedResume = response.data;
      // Открываем модальное окно
      this.isEditModalOpentwo = true;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансии:', error);
    });
},
editResponse(ResponseId) {
  // Запрос к серверу для получения данных о выбранной вакансии
  this.selectedResponseId = ResponseId;
  axios.get(`http://localhost/this_is_the_base/get_response.php?id=${ResponseId}`)
    .then(response => {
      // Присваиваем полученные данные объекту editedVacancy
      this.editedResponse = response.data;
      // Открываем модальное окно
      this.isEditModalOpenthree = true;
    })
    .catch(error => {
      console.error('Ошибка при получении данных о вакансии:', error);
    });
},
submitEditResponse() {
  // Отправка изменений вакансии на сервер
  // Пример использования axios для отправки данных
  axios.get(`http://localhost/this_is_the_base/update_response.php?id=${this.selectedResponseId}`, {
      params: {
          editedResponse: this.editedResponse
      },
    })
    .then(response => {
      // Обработка успешного сохранения изменений
      // Например, обновление списка вакансий после сохранения

      // Закрываем модальное окно после успешного сохранения
      this.isEditModalOpenthree = false;

      // Сбрасываем значения полей формы
      this.editedResponse = {};

      // Обновляем список откликов
      this.fetchResponses();
    })
    .catch(error => {
      console.error('Ошибка при сохранении изменений вакансии:', error);
    });
},
submitEditVacancy() {
    // Отправка изменений вакансии на сервер
    // Пример использования axios для отправки данных
    axios.get(`http://localhost/this_is_the_base/update_vacancy.php?id=${this.selectedVacancyId}`,{
        params: {
            editedVacancy : this.editedVacancy
        },
      })
      .then(response => {
        // Обработка успешного сохранения изменений
        // Например, обновление списка вакансий после сохранения

        // Закрываем модальное окно после успешного сохранения
        this.isEditModalOpen = false;

        // Сбрасываем значения полей формы
        this.editedVacancy = {};

        // Обновляем список вакансий
        this.fetchVacancies();
      })
      .catch(error => {
        console.error('Ошибка при сохранении изменений вакансии:', error);
      });
  },
  submitEditResume() {
    // Отправка изменений вакансии на сервер
    // Пример использования axios для отправки данных
    axios.get(`http://localhost/this_is_the_base/update_resume.php?id=${this.selectedResumeId}`,{
        params: {
            editedResume : this.editedResume
        },
      })
      .then(response => {
        // Обработка успешного сохранения изменений
        // Например, обновление списка вакансий после сохранения

        // Закрываем модальное окно после успешного сохранения
        this.isEditModalOpentwo = false;

        // Сбрасываем значения полей формы
        this.editedResume = {};

        // Обновляем список вакансий
        this.fetchResume();
      })
      .catch(error => {
        console.error('Ошибка при сохранении изменений вакансии:', error);
      });
  },
    },
  };
  </script>
<template>
    <div>
      <h2>Страница администратора</h2>
  
      <h3>Вакансии</h3>
      <div v-if="isEditModalOpen">
        <h3>Редактирование вакансии</h3>
  <form @submit="submitEditVacancy">

    <label for="title">Название:</label>
    <input type="text" id="title" v-model="editedVacancy.title" required>

    <label for="salary">Уровень дохода:</label>
    <input type="number" id="salary" v-model="editedVacancy.salary" required>

    <label for="place_work">Место работы:</label>
    <input type="text" id="place_work" v-model="editedVacancy.place_work" required name="place_work">

    <label for="description_vacancy">Описание работы:</label>
    <input type="text" id="description_vacancy" v-model="editedVacancy.description_vacancy" required name="description_vacancy">

    <label for="work_experience">Требуемый опыт работы:</label>
    <input type="text" id="work_experience" v-model="editedVacancy.work_experience" required name="work_experience">

    <label for="employee_responsibilities">обязанности сотрудника:</label>
    <input type="text" id="employee_responsibilities" v-model="editedVacancy.employee_responsibilities" required>

    <label for="key_skills">Ключевые навыки:</label>
    <input type="text" id="key_skills" v-model="editedVacancy.key_skills" required>

    <label for="category">Категория:</label>
    <select name="category" id="category" v-model="editedVacancy.category">
        <option value="new">Новые</option>
        <option value="home">Работа из дома</option>
        <option value="underworking">Подработка</option>
        <option value="noexperience">Без опыта</option>
    </select>
    
    <button type="submit">Сохранить</button>
</form>
</div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Уровень дохода</th>
            <th>Место работы</th>
            <th>Описание вакансии</th>
            <th>Требуемый опыт работы</th>
            <th>Обязанности сотрудника</th>
            <th>Ключевые навыки</th>
            <th>Категория</th>
            <th>Дата</th>
            <th>редактирование</th>
            <th>удаление</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="vacancy in vacancies" :key="vacancy.id" >
            <td>{{ vacancy.id }}</td>
            <td>{{ vacancy.title }}</td>
            <td>{{ vacancy.salary }}</td>
            <td>{{ vacancy.place_work }}</td>
            <td>{{ vacancy.description_vacancy }}</td>
            <td>{{ vacancy.work_experience }}</td>
            <td>{{ vacancy.employee_responsibilities }}</td>
            <td>{{ vacancy.key_skills }}</td>
            <td>{{ vacancy.category }}</td>
            <td>{{ vacancy.date }}</td>
            <td>
    <button @click="editVacancy(vacancy.id)">Редактировать</button>
  </td>
  <td>
    <button @click="deleteVacancy(vacancy.id)">Удалить</button>
  </td>
          </tr>
        </tbody>
      </table>
  
      <h3>Резюме</h3>
      <div v-if="isEditModalOpentwo">
        <h3>Редактирование резюме</h3>
  <form @submit="submitEditResume">

    <label for="work_experience">Опыт работы:</label>
        <input type="text" id="work_experience" v-model="editedResume.work_experience" required name="work_experience">

        <label for="desired_position">Желаемая должность:</label>
        <input type="text" id="desired_position" v-model="editedResume.desired_position" required name="desired_position">

        <label for="desired_salary">Желаемая зарплата:</label>
        <input type="number" id="desired_salary" v-model="editedResume.desired_salary" required name="desired_salary">

        <label for="move">Готовность к переезду:</label>
        <select id="move" v-model="editedResume.move" required name="move">
          <option value="">Выберите</option>
          <option value="yes">Да</option>
          <option value="no">Нет</option>
        </select>

        <label for="busyness">Занятость:</label>
        <select id="busyness" v-model="editedResume.busyness" required name="busyness">
          <option value="">Выберите</option>
          <option value="full-time">Полная занятость</option>
          <option value="part-time">Частичная занятость</option>
          <option value="freelance">Фриланс</option>
        </select>

        <label for="work_schedule">График работы:</label>
        <input type="text" id="work_schedule" v-model="editedResume.work_schedule" required>

        <label for="work_permit">Разрешение на работу:</label>
        <input type="text" id="work_permit" v-model="editedResume.work_permit" required>
     
        <label for="availability_car">Наличие автомобиля:</label>
        <select id="availability_car" v-model="editedResume.availability_car" required>
          <option value="">Выберите</option>
          <option value="yes">Да</option>
          <option value="no">Нет</option>
        </select>
      

    <button type="submit">Сохранить</button>
</form>
</div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Опыт работы</th>
            <th>Желаемая должность</th>
            <th>Желаемая зарплата</th>
            <th>Возможность переезда</th>
            <th>Занятость</th>
            <th>График работы</th>
            <th>разрешение на работу</th>
            <th>Наличие автомобиля</th>
            <th>редактирование</th>
            <th>удаление</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="resume in resumes" :key="resume.id">
            <td>{{ resume.id }}</td>
            <td>{{ resume.work_experience }}</td>
            <td>{{ resume.desired_position}}</td>
            <td>{{ resume.desired_salary }}</td>
            <td>{{ resume.move }}</td>
            <td>{{ resume.busyness }}</td>
            <td>{{ resume.work_schedule  }}</td>
            <td>{{ resume.work_permit  }}</td>
            <td>{{ resume.availability_car  }}</td>
            <td>
    <button @click="editResume(resume.id)">Редактировать</button>
  </td>
  <td>
    <button @click="deleteResume(resume.id)">Удалить</button>
  </td>
          </tr>
        </tbody>
      </table>
  
      <h3>Отклики</h3>
      <div v-if="isEditModalOpenthree">
        <h3>Редактирование отклика</h3>
  <form @submit="submitEditResponse">

    <label for="status">статус отклика:</label>
    <input type="text" id="status" v-model="editedResponse.status" required>

    
    <button type="submit">Сохранить</button>
</form>
</div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Дата отклика</th>
            <th>Статус</th>
            <th>редактирование</th>
            <th>удаление</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="response in responses" :key="response.id">
            <td>{{ response.id_re }}</td>
            <td>{{ response.date_created }}</td>
            <td>{{ response.status }}</td>
            <td>
    <button @click="editResponse(response.id_re)">Редактировать</button>
  </td>
  <td>
    <button @click="deleteResponse(response.id)">Удалить</button>
  </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  
  
  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  
  th, td {
    padding: 10px;
    border: 1px solid #ccc;
  }
  
  th {
    background-color: #f0f0f0;
    font-weight: bold;
  }
  .modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  max-width: 500px;
}

/* Other table styles */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th,
td {
  padding: 10px;
  border: 1px solid #ccc;
}

th {
  background-color: #f0f0f0;
  font-weight: bold;
}

/* Button styles */
button {
  padding: 5px 10px;
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #2980b9;
}

/* Form styles */
form {
  display: flex;
  flex-direction: column;
  margin-top: 20px;
}

label {
  margin-bottom: 5px;
}

input,
select {
  margin-bottom: 10px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
  </style>
  
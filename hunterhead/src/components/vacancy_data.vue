<script>
import axios from 'axios';
import { mapActions, mapState } from 'vuex';

export default {
  data() {
    return {
      form: {
        title: "",
        salary: "",
        place_work: "",
        description_vacancy: "",
        work_experience: "",
        employee_responsibilities: "",
        key_skills: "",
        title_specializ: "",
        discharge: "",
        operating_mode: "",
        work_schedule: ""
      },
      userId: '',
      id_work: '',
      specializationid: '',
    };
  },
  mounted() {
    this.fetchvacancy();
  },
  created() {
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    ...mapActions(['setUserId']),
    fetchvacancy() {
      axios
        .get('http://localhost/this_is_the_base/vacancy_data.php', {
          params: {
            id_employer: this.userId,
          },
        })
        .then(response => {
          const userData = response.data;
          this.form.title = userData.vacancy.title;
          this.form.salary = userData.vacancy.salary;
          this.form.place_work = userData.vacancy.place_work;
          this.form.description_vacancy = userData.vacancy.description_vacancy;
          this.form.work_experience = userData.vacancy.work_experience;
          this.form.employee_responsibilities = userData.vacancy.employee_responsibilities;
          this.form.key_skills = userData.vacancy.key_skills;
          this.form.title_specializ = userData.specialization.title_specializ;
          this.form.discharge = userData.specialization.discharge;
          this.form.operating_mode = userData.work_schedule.operating_mode;
          this.form.work_schedule = userData.work_schedule.work_schedule;
          this.id_work = userData.work_schedule.id;
          this.specializationid = userData.specialization.id;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateResumeData() {
      const requestData = {
        id_employer: this.userId,
        specializationid: this.specializationid,
        id_work: this.id_work,
        vacancyData: this.form,
      };
      axios
        .get('http://localhost/this_is_the_base/vacancy_dataTWO.php', {
          params: requestData
        })
        .then(response => {
          const success = response.data;
          console.log(success);
          console.log(requestData);
          if (success === true) {
            console.log('Данные успешно обновлены в базе данных');
          } else if (success === false) {
            // Резюме отсутствует, перенаправление на страницу создания резюме
            console.log('Ошибка при обновлении данных в базе данных');
          }
        })
        .catch(error => {
          console.error('Ошибка при обновлении данных в базе данных:', error);
        });
    },
    deleteVacancy() {
      const requestData = {
        id_employer: this.userId,
      };
      axios
        .get('http://localhost/this_is_the_base/delete_vacancy.php', {
          params: requestData
        })
        .then(response => {
          const success = response.data;
          console.log(success);
          if (success === true) {
            console.log('Вакансия успешно удалена');
          } else if (success === false) {
            console.log('Ошибка при удалении вакансии');
          }
        })
        .catch(error => {
          console.error('Ошибка при удалении вакансии:', error);
        });
    }
  },
};
</script>

<template>
  <div class="sss">
    <form class="login-form" novalidate>
      <div class="form-left-decoration"></div>
      <div class="form-right-decoration"></div>
      <div class="circle"></div>
      <div class="form-inner">
        <h3 class="form-title">Личные данные</h3>
        <label for="title">О работе:</label>
        <input type="text" id="title" v-model="form.title" required name="title">

        <label for="salary">Зарплата:</label>
        <input type="number" id="salary" v-model="form.salary" required name="salary">

        <label for="place_work">Место работы:</label>
        <input type="text" id="place_work" v-model="form.place_work" required name="place_work">

        <label for="description_vacancy">Описание работы:</label>
        <input type="text" id="description_vacancy" v-model="form.description_vacancy" required name="description_vacancy">

        <label for="work_experience">Требуемый опыт работы:</label>
        <input type="text" id="work_experience" v-model="form.work_experience" required name="work_experience">

        <label for="employee_responsibilities">обязанности сотрудника:</label>
        <input type="text" id="employee_responsibilities" v-model="form.employee_responsibilities" required>

        <label for="key_skills">Ключевые навыки:</label>
        <input type="text" id="key_skills" v-model="form.key_skills" required>
      </div>
      <div class="form-inner">
        <h3 class="form-title">Специализация</h3>

        <label for="title_specializ">Название:</label>
        <input type="text" id="title_specializ" v-model="form.title_specializ" required>

        <label for="discharge">Разряд:</label>
        <input type="text" id="discharge" v-model="form.discharge" required>
      </div>
      <div class="form-inner">
        <h3 class="form-title">Дополнительные данные</h3>

        <label for="operating_mode">Режим работы</label>
        <input type="text" id="operating_mode" v-model="form.operating_mode">

        <label for="work_schedule">График работы</label>
        <input type="text" id="work_schedule" v-model="form.work_schedule">
      </div>
      <div class="form-inner">
        <button type="button" class="delete-btn" @click="deleteVacancy">Удалить</button>
        <button type="button" class="form-submit" @click="updateResumeData">Сохранить</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
}

.sss {
  background: url("src/assets/img/img.jpg") no-repeat;
  background-size: 100%;
  width: 100%;
  height: 100%;
  background-attachment: fixed;
}

.login-form {
  position: relative;
  max-width: 400px;
  max-height: 1800px;
  margin-top: 20px;
  top: 50px;
  margin: 50px auto 0;
  background: white;
  border-radius: 30px;
}

.form-left-decoration,
.form-right-decoration {
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

.form-left-decoration:before,
.form-left-decoration:after,
.form-right-decoration:before,
.form-right-decoration:after {
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
  margin-top: -70px;
  padding: 50px;
}

.form-inner input,
.form-inner textarea,
.form-inner textarea {
  display: block;
  width: 100%;
  padding: 0 20px;
  margin-bottom: 10px;
  background: #e9eff6;
  line-height: 40px;
  border-width: 0;
  border-radius: 20px;
  font-family: 'Roboto', sans-serif;
}

.form-inner select {
  display: block;
  width: 340px;
  height: 40px;
  padding: 0 20px;
  margin-bottom: 10px;
  background: #e9eff6;
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

.form-submit {
  display: block;
  width: 180px;
  margin-left: 155px;
  height: 40px;
  margin-top: -37px;
  background: #368cdd;
  border-bottom: 4px solid #183e9d;
  color: white;
  font-size: 14px;
  border-radius: 20px;
}

.delete-btn {
  display: block;
  width: 180px;
  margin-left: -30px;
  height: 40px;
  margin-top: 20px;
  background: #e74c3c;
  border-bottom: 4px solid #c0392b;
  color: white;
  font-size: 14px;
  border-radius: 20px;
}

</style>

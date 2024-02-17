<script>
import axios from 'axios';
import { mapActions, mapState } from 'vuex';

export default {
  data() {
    return {
      form: {
        work_experience: '',
        desired_position: '',
        desired_salary: null,
        move: '',
        busyness: '',
        work_schedule: '',
        work_permit: '',
        availability_car: '',
        level: '',
        educational_institution: '',
        faculty: '',
        specialization: '',
        year_graduation: '',
        category: '',
        date_rec: '',
        languages: '',
        level_lang: '',
      },
      userId: '',
      resumeId: 0,
      educationId: null,
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
        .get('http://localhost/this_is_the_base/resume_data.php', {
          params: {
            id_app: this.userId,
          },
        })
        .then(response => {
          const userData = response.data;
          this.form.work_experience = userData.resume.work_experience;
          this.form.desired_position = userData.resume.desired_position;
          this.form.desired_salary = userData.resume.desired_salary;
          this.form.move = userData.resume.move;
          this.form.busyness = userData.resume.busyness;
          this.form.work_schedule = userData.resume.work_schedule;
          this.form.work_permit = userData.resume.work_permit;
          this.form.availability_car = userData.resume.availability_car;
          this.form.level = userData.education.level;
          this.form.educational_institution = userData.education.educational_institution;
          this.form.faculty = userData.education.faculty;
          this.form.specialization = userData.education.specialization;
          this.form.year_graduation = userData.education.year_graduation;
          this.educationId = userData.education.id;
        })
        .catch(error => {
          console.error(error);
        });
    },
    updateResumeData() {
      const requestData = {
    id_app: this.userId,
    resumeData: {
        ...this.form,
        educationId: this.educationId // Добавьте educationId в объект resumeData
      }
  };
  
    axios
    .get('http://localhost/this_is_the_base/resume_dataTWO.php', {
      params: requestData
    })
      .then(response => {
        const success = response.data;
        console.log(success);
        console.log(requestData);
        if (success === true) {
           console.log('Данные успешно обновлены в базе данных');
        } else if(success === false) {
          // Резюме отсутствует, перенаправление на страницу создания резюме
          console.log('Ошибка при обновлении данных в базе данных');
        }
       
      })
      .catch(error => {
        console.error('Ошибка при обновлении данных в базе данных:', error);
      });}
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
        <label for="work_experience">Опыт работы:</label>
        <input type="text" id="work_experience" v-model="form.work_experience" required name="work_experience">

        <label for="desired_position">Желаемая должность:</label>
        <input type="text" id="desired_position" v-model="form.desired_position" required name="desired_position">

        <label for="desired_salary">Желаемая зарплата:</label>
        <input type="number" id="desired_salary" v-model="form.desired_salary" required name="desired_salary">

        <label for="move">Готовность к переезду:</label>
        <select id="move" v-model="form.move" required name="move">
          <option value="">Выберите</option>
          <option value="yes">Да</option>
          <option value="no">Нет</option>
        </select>

        <label for="busyness">Занятость:</label>
        <select id="busyness" v-model="form.busyness" required name="busyness">
          <option value="">Выберите</option>
          <option value="full-time">Полная занятость</option>
          <option value="part-time">Частичная занятость</option>
          <option value="freelance">Фриланс</option>
        </select>

        <label for="work_schedule">График работы:</label>
        <input type="text" id="work_schedule" v-model="form.work_schedule" required>

        <label for="work_permit">Разрешение на работу:</label>
        <input type="text" id="work_permit" v-model="form.work_permit" required>
     
        <label for="availability_car">Наличие автомобиля:</label>
        <select id="availability_car" v-model="form.availability_car" required>
          <option value="">Выберите</option>
          <option value="yes">Да</option>
          <option value="no">Нет</option>
        </select>
      </div>   
        <div class="form-inner">
          <h3 class="form-title">Образование</h3>
          <label for="level"> Уровень образования</label>
          <select id="level" v-model="form.level">
          <option value="Среднее общее">Среднее общее — 10—11 классы</option>
          <option value="Среднее профессиональное">Среднее профессиональное</option>
          <option value="Высшее I">Высшее I степени — бакалавриат</option>
          <option value="Высшее II">Высшее II степени — специалитет, магистратура</option>
          <option value="Высшее III">Высшее III степени — подготовка кадров высшей квалификации</option>
          </select>

          <label for="educational_institution">Учебное заведение</label>
          <input type="text" id="educational_institution" v-model="form.educational_institution">

          <label for="faculty">Факультет</label>
          <input type="text" id="faculty" v-model="form.faculty">

          <label for="specialization">Специализация</label>
          <input type="text" id="specialization" v-model="form.specialization">

          <label for="year_graduation">Год окончания</label>
          <input type="date" id="year_graduation" v-model="form.year_graduation">

    </div>
    <div class="form-inner">
          <h3 class="form-title">Дополнительные данные</h3>

          <label for="category">Категория прав</label>
          <input type="text" id="category" v-model="form.category">

          <label for="date_rec">Дата получения</label>
          <input type="date" id="date_rec" v-model="form.date_rec">

          <label for="languages">Язык</label>
          <input type="text" id="languages" v-model="form.languages">

          <label for="level_lang">уровень владения языком</label>
          <input type="text" id="level_lang" v-model="form.level_lang">
    </div>
    <input type="button" value="Save" class="form-submit" @click="updateResumeData">
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
    max-height:1800px;
    margin-top: 20px;
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
  margin-top: -70px;
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
  margin-left: 120px;
  height: 40px;
  margin-top: -30px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
    border-radius: 20px;
}

</style>
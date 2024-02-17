<script>
import axios from 'axios';
import { mapActions, mapState } from 'vuex';
export default {
  data() {
    return {
      currentStep: 1,
      form: {
        workExperience: '',
        desiredPosition: '',
        desiredSalary: null,
        move: '',
        busyness: '',
        workSchedule: '',
        workPermit: '',
        availabilityCar: '',
        level:'',
        educational_institution:'',
        faculty:'',
        specialization:'',
        year_graduation:'',
        category:'',
        date_rec:'',
        languages:'',
        level_lang: ''
      },
      userId:'',
      resumeId: 0, // Идентификатор резюме, созданного в таблице "resume"
      educationId: null // Идентификатор образования, созданного в таблице "education"
    };
  },
  created() {
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    ...mapActions(['setUserId']),
    submitForm() {
        if (this.currentStep <3) {
          this.currentStep+=1;
        } else {
          console.log(this.userId);
          // Форма заполнена на всех шагах
          // Вы можете отправить данные на сервер или выполнить другие необходимые действия
          axios.post('http://localhost/this_is_the_base/save_resume.php', {
          resume: this.form,
          educationId: this.educationId,
          id_app: this.userId
        })
          .then(response => {
            console.log(response.data);
            // Добавьте обработку успешного сохранения данных, если необходимо
            // console.log(this.form);
          })
          .catch(error => {
            console.error(error);
            // Добавьте обработку ошибок, если необходимо
            console.log('fail');
          });
        }
    },
    backstep(){
      this.currentStep--;
    },
 
    submitFormEducation() {
      if (this.currentStep=2) {
          this.currentStep+=1;
         } 
     
    },
    endform(){
        // Отправка данных на сервер для сохранения образования и получение идентификатора
        axios.post('http://localhost/this_is_the_base/save_education.php', {
        education: this.form
      })
        .then(response => {
          console.log(response.data);
          this.educationId = response.data.educationId;
          this.submitForm();
          this.$router.push('/applicant1');
        })
        .catch(error => {
          console.error(error);
          // Добавьте обработку ошибок, если необходимо
        });
    }
  },
}
</script>

<template>
   <div class="sss">
    <form class="login-form" novalidate >
      <div v-if="currentStep === 1">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
      <div class="circle"></div>
        <div class="form-inner">
          <h3 class="form-title">Личные данные</h3>
        <label for="workExperience">Опыт работы:</label>
        <input type="text" id="workExperience" v-model="form.workExperience" required name="workExperience">

        <label for="desiredPosition">Желаемая должность:</label>
        <input type="text" id="desiredPosition" v-model="form.desiredPosition" required name="desiredPosition">

        <label for="desiredSalary">Желаемая зарплата:</label>
        <input type="number" id="desiredSalary" v-model="form.desiredSalary" required name="desiredSalary">

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

        <label for="workSchedule">График работы:</label>
        <input type="text" id="workSchedule" v-model="form.workSchedule" required>

        <label for="workPermit">Разрешение на работу:</label>
        <input type="text" id="workPermit" v-model="form.workPermit" required>
     
        <label for="availabilityCar">Наличие автомобиля:</label>
        <select id="availabilityCar" v-model="form.availabilityCar" required>
          <option value="">Выберите</option>
          <option value="yes">Да</option>
          <option value="no">Нет</option>
        </select>

      </div>   
      <button type="button" class="form-submit"  @click="submitForm">Следующий шаг</button>
    </div>

      <div v-if="currentStep === 2">
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

      <button type="button" class="back-button"  @click="backstep" >предыдущий шаг</button>
      <button type="button" class="next-buttonn"  @click="submitFormEducation">Следующий шаг</button>
    </div>
  </div>

  <div v-if="currentStep === 3">
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

      <button type="button" class="back-button"  @click="backstep">предыдущий шаг</button>
      <button type="button" class="next-buttonn" @click="endform">завершить регистрацию</button>
    </div>
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
  margin-left: 100px;

  height: 40px;
  margin-top: -40px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
    border-radius: 20px;
}
.back-button{
  display: block;
  width: 180px;
  margin-left: -29px;
  height: 40px;
  margin-top: 20px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
    border-radius: 20px;
}
.next-buttonn{
  display: block;
  width: 180px;
  margin-left: 160px;
  height: 40px;
  margin-top: -39px;
    background: #368cdd;
    border-bottom: 4px solid #183e9d;
    color: white;
    font-size: 14px;
    border-radius: 20px;
}
</style>

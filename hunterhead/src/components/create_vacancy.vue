<script>
import axios from 'axios';
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      currentStep: 1,
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
  created() {
    this.userId = localStorage.getItem('userId');
  },
  methods: {
    next(){
      this.currentStep += 1;
    },
    ...mapActions(['setUserId']),
    submitForm() {
  if (this.currentStep === 3) {
    const saveWorkSchedulePromise = axios.post('http://localhost/this_is_the_base/save_work_schedule.php', {
      operating_mode: this.form.operating_mode,
      work_schedule: this.form.work_schedule,
    });

    const saveSpecializationPromise = axios.post('http://localhost/this_is_the_base/save_specialization.php', {
      specialization: this.form.title_specializ,
      discharge: this.form.discharge,
      id_app: this.userId,
    });

    Promise.all([saveWorkSchedulePromise, saveSpecializationPromise])
      .then(([workScheduleResponse, specializationResponse]) => {
        console.log(workScheduleResponse.data);
        console.log(specializationResponse.data);
        this.id_work = workScheduleResponse.data.id_work;
        this.specializationid = specializationResponse.data.specializationid;

        axios.post('http://localhost/this_is_the_base/save_vacancy.php', {
          vacancy: this.form,
          id_app: this.userId,
          id_work: this.id_work,
          specializationid: this.specializationid,
        })
          .then(response => {
            console.log(response.data);
            // Handle successful vacancy saving if necessary

            // Перенаправление на страницу "employer1"
            this.$router.push('/employer1');
          })
          .catch(error => {
            console.error(error);
            // Handle vacancy saving error if necessary
          });
      })
      .catch(error => {
        console.error(error);
        // Handle errors if necessary
      });
  } else {
    this.currentStep += 1;
  }
},
    backstep() {
      this.currentStep--;
    },
    endform() {
      console.log("Form submission completed");
    },
  }
};
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
        <label for="title">О работе</label>
        <input type="text" id="title" v-model="form.title" required name="title">

        <label for="salary">Зарплата:</label>
        <input type="number" id="	salary" v-model="form.salary" required name="salary">

        <label for="place_work">Место работы:</label>
        <input type="text" id="place_work" v-model="form.place_work" required name="place_work">

        <label for="description_vacancy">Описание работы:</label>
        <input type="text" id="description_vacancy" v-model="form.description_vacancy" required name="description_vacancy">

        <label for="work_experience">Требуемый опыт работы:</label>
        <input type="text" id="work_experience" v-model="form.work_experience" required name="work_experience">

        <label for="employee_responsibilities">обязанности сотрудника:</label>
        <input type="text" id="employee_responsibilities" v-model="form.employee_responsibilities" required name="employee_responsibilities">

        <label for="key_skills">Ключевые навыки:</label>
        <input type="text" id="key_skills" v-model="form.key_skills" required name="key_skills">
      </div>   
      <button type="button" class="form-submit"  @click="next">Следующий шаг</button>
    </div>

      <div v-if="currentStep === 2">
        <div class="form-inner">
          <h3 class="form-title" >специализация</h3>
          <label for="title_specializ">Название:</label>
        <input type="text" id="title_specializ" v-model="form.title_specializ" required name="title_specializ">

        <label for="discharge">Разряд:</label>
        <input type="text" id="discharge" v-model="form.discharge" required name="discharge">

      <button type="button" class="back-button"  @click="backstep" >предыдущий шаг</button>
      <button type="button" class="next-buttonn"  @click="next">Следующий шаг</button>
    </div>
  </div>

  <div v-if="currentStep === 3">
    <div class="form-inner">
          <h3 class="form-title">Дополнительные данные</h3>

          <label for="operating_mode">Режим работы</label>
          <input type="text" id="operating_mode" v-model="form.operating_mode">

          <label for="work_schedule">График работы</label>
          <input type="text" id="work_schedule" v-model="form.work_schedule">

      <button type="button" class="back-button"  @click="backstep">предыдущий шаг</button>
      <button type="button" class="next-buttonn" @click="submitForm">завершить регистрацию</button>
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

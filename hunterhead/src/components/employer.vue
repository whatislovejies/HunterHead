<script>
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
        <li class=""><router-link to="/Rregister" class="resume_create">Зарегистрироваться</router-link></li>
        <li class=""><router-link to="/Rautoriz" class="entrance">Войти</router-link></li>
    </ul>
      
     </section>
      </header>
   
    <div class="vacancy-block" style="background-image: url('background-image.jpg');">
        <h2>Разместите вакансию</h2>
        <router-link to ="/Rregister" class="button">Разместить вакансию</router-link>
      </div>

      <footer>
  <p>© 2021 Работа.онлайн - поиск работы онлайн. Все права защищены.</p>
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
html{

width: 100%;
max-width: 100%;
overflow-x: hidden;
}
@import url('https://fonts.googleapis.com/css?family=Ubuntu+Condensed');
.menu-main {
  list-style: none;
  margin: 0px 0 5px;
  padding: 0px 0 5px;
  text-align: center;
  background: white;
}
.left-item {float: left;
  margin-left: 30px;}
.menu-main li {display: inline-block;}
.menu-main li:after {
  content: "|";
  color: #606060;
  display: inline-block;
  vertical-align:top;
}
.menu-main li:last-child:after {content: none;}
.menu-main a {
  text-decoration: none;
  font-family: 'Ubuntu Condensed', sans-serif;
  letter-spacing: 2px;
  position: relative;
  padding-bottom: 20px;
  margin: 0 34px 0 30px;
  font-size: 17px;
  text-transform: uppercase;
  display: inline-block;
  transition: color .1s;
}
.menu-main a, .menu-main a:visited {color: #000000;}
.menu-main a.current, .menu-main a:hover{color: #feb386;}
.menu-main a:before,
.menu-main a:after {
  content: "";
  position: absolute;
  height: 4px;
  top: auto;
  right: 50%;
  bottom: -5px;
  left: 50%;
  background: #feb386;
  transition: .3s;
}
.menu-main a:hover:before, .menu-main .current:before {left: 0;}
.menu-main a:hover:after, .menu-main .current:after {right: 0;}   
@media (max-width: 550px) {
.menu-main {padding-top: 0;}
.menu-main li {display: block;}
.menu-main li:after {content: none;}
.menu-main a {
  padding: 25px 0 20px; 
  margin: 0 30px;
}
}
/* Search field */
form {
  position: relative;
  width: 500px;
  margin: 0 auto;
  height: 42px;
  margin-top: 150px;
  
}
.middle-menu{
  background-image: url('https://welcome-to-canada.org/wp-content/uploads/2017/07/%D0%A0%D0%B0%D0%B1%D0%BE%D1%82%D0%B0-%D0%B2-%D0%9A%D0%B0%D0%BD%D0%B0%D0%B4%D0%B5-scaled.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  height: 750px;
  margin-top: -70px;
}
input {
  height: 42px; 
  width: 600px;
  margin-left: 430px;
  padding: 0px 15px; 
  border: 1px solid #F9F0DA;
  outline: none;
  background: white;
  position: absolute;
  top: 0;
  left: 0;
  transform: translate(-100%, 100%);
  z-index: 2;
}
button {
  background: #feb386;
  border: none;
  margin-top: 44px;
  height: 44px; 
  width: 62px;
  position: absolute;
  top: 0;
  right: 0;
  cursor: pointer;
}
form h1{
  margin-left: -190px;
  color: #000000;
  font-weight: 400;
  font-size: 34px;
}
.middle-menu a{
  position: relative;
  color: #000000;
  left: 500px;
  top: 55px;
  font-weight: 400;
  font-size: 18px;
}
/* Login */
.menu {
  list-style: none;
  margin: 0px 0 5px;
  padding: 0px 0 5px;
  text-align: center;
  background: white;
}
.menu li {display: inline-block;}
.menu li:after {
  color: #000000;
  display: inline-block;
  vertical-align:top;
}
.menu a {
  text-decoration: none;
  font-family: 'Ubuntu Condensed', sans-serif;
  letter-spacing: 2px;
  position: relative;
  padding: 5px 10px;
  margin: 60px 0px 0px 20px;
  top: 50px;
  font-size: 17px;
  text-transform: uppercase;
  display: inline-block;
  border: 2px solid #777;
  color: #777;
  transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
}
.menu a:hover{
  background-color: #feb386;
  color: #fff;
}
.entrance{
color: black;
border-radius: 50px;
}
.resume_create{
  border-radius: 50px;
}
.middle-menu{
  background-image:red ;
}
/* Content */
.content {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-template-rows: repeat(4, 1fr);
  grid-gap: 50px;
  margin-top: 100px;
  justify-items: center;
}

.vacancies-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between; 
  align-items: flex-start;
}

.vacancy {
  background-color: #f5f5f5;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 5px;
  margin: 10px;
  position: relative;
  width: 300px;
  height: 150px;
  font-size: 14px;
}
.vacancy h2 {
  margin-bottom: 5px;
}

.vacancy p {
  margin-top: 5px;
}
.vacancy:before {
  content: "";
  display: block;
  width: 5px;
  height: 100%;
  background-color: #f0690f;
  position: absolute;
  left: 0;
}

.vacancy:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease-in-out;
}
/* footer */
footer {
 background-color: #f2f2f2;
 padding: 20px;
 display: flex;
 justify-content: space-between;
 align-items: center;
}

footer nav ul {
 display: flex;
 list-style: none;
}

footer nav li {
 margin-right: 20px;
}

footer nav a {
 color: #333; 
 text-decoration: none;
}

footer p {
 font-size: 0.8rem;
 color: #666;
 margin-right: auto;
}
.vacancy-block {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
  text-align: center;
  color: #000000;
  background-size: cover;
  background-position: center;
  position: relative;
}

.vacancy-block h2 {
  font-size: 36px;
  margin-bottom: 20px;
}

.vacancy-block p {
  font-size: 18px;
  margin-bottom: 30px;
}

.vacancy-block ul {
  font-size: 16px;
  list-style: none;
  margin-bottom: 30px;
  padding: 0;
}

.vacancy-block ul li {
  margin-bottom: 10px;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  border: 2px solid #fff;
  border-radius: 50px;
  background-color: transparent;
  color: #000000;
  text-decoration: none;
  position: relative;
  transition: all 0.3s ease;
  overflow: hidden;
}

.button:before {
  content: '';
  position: absolute;
  width: 0%;
  height: 100%;
  background-color: #beb2b2;
  top: 0;
  left: 0;
  transition: all 0.3s ease;
  z-index: -1;
}

.button:hover {
  color: #000;
}

.button:hover:before {
  width: 100%;
}
</style>

import { createRouter, createWebHashHistory } from 'vue-router';
import employer from "./components/employer.vue";
import applicant from "./components/applicant.vue";
import Sregister from "./components/Sregister.vue";
import Sautoriz from "./components/Sautoriz.vue";
import Rregister from "./components/Rregister.vue";
import Rautoriz from "./components/Rautoriz.vue";
import Search from "./components/Search.vue";
import Search1 from "./components/Search1.vue";
import applicant1 from "./components/applicant1.vue";
import resume from "./components/resume.vue";
import person_data from "./components/person_data.vue";
import resume_data from "./components/resume_data.vue";
import vacancy_data from "./components/vacancy_data.vue";
import employer1 from "./components/employer1.vue";
import create_vacancy from "./components/create_vacancy.vue";
import personE_data from "./components/personE_data.vue";
import response from "./components/response.vue";
import responseAp from "./components/responseAp.vue";
import admin from "./components/admin.vue";
import VacancyDetailsComponent from "./components/VacancyDetailsComponent.vue";




const routes = [
  { path: '/employer', component: employer, meta: { requiredRoles: ['guest'] } },
  { path: '/', component: applicant, alias: '/', meta: { requiredRoles: ['guest'] } },
  { path: '/Sregister', component: Sregister, meta: { requiredRoles: ['guest'] } },
  { path: '/Sautoriz', component: Sautoriz, meta: { requiredRoles: ['guest'] } },
  { path: '/Rregister', component: Rregister, meta: { requiredRoles: ['guest'] } },
  { path: '/Rautoriz', component: Rautoriz, meta: { requiredRoles: ['guest'] } },
  { path: '/Search', component: Search, meta: { requiredRoles: ['guest'] } },
  { path: '/Search1', component: Search1, meta: { requiredRoles: ['guest'] } },
  { path: '/applicant1', component: applicant1, meta: { requiredRoles: ['guest'] } },
  { path: '/resume', component: resume, meta: { requiredRoles: ['applicant','admin'] } },
  { path: '/person', component: person_data, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/resume_data', component: resume_data, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/vacancy_data', component: vacancy_data, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/employer1', component: employer1, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/create_vacancy', component: create_vacancy, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/personE_data', component: personE_data, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/response', component: response, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/responseAp', component: responseAp, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/admin', component: admin, meta: { requiredRoles: ['guest' ,'admin'] } },
  { path: '/vacancy/:id', name: 'VacancyDetails', component: VacancyDetailsComponent , meta: { requiredRoles: ['guest' ,'admin'] }}
];

const createRouterInstance = (store) => {
  const router = createRouter({
    history: createWebHashHistory(),
    routes,
  });

  router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiredRoles)) {
      if (store.getters.isAuthenticated) {
        const requiredRoles = to.meta.requiredRoles;
        if (requiredRoles.includes('guest') || requiredRoles.every(role => store.getters.userRole === role)) {
          next();
        } else {
          next({ path: '/applicant1' });
        }
      } else {
        if (to.path !== '/' && to.path !== '/Sregister' && to.path !== '/Sautoriz' && to.path !== '/applicant1' && to.path !== '/Rautoriz' && to.path !== '/Search' && to.path !== '/Search1' && to.path !== '/employer' && to.path !== '/resume'  && to.path !== '/person'  && to.path !== '/resume_data' && to.path !== '/Rregister'  && to.path !== '/employer1'  && to.path !== '/create_vacancy' && to.path !== '/personE_data'&& to.name !== 'VacancyDetails'&& to.path  !== '/vacancy_data'&& to.path  !== '/response'&& to.path  !== '/responseAp' && to.path  !== '/admin') {
          next({ path: '/Sautoriz' });
        } else {
          next();
        }
      }
    } else {
      next();
    }
  });

  return router;
};

export default createRouterInstance;

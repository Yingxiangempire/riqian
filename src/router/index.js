import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home'
import DiaryEditor from '../components/DiaryEditor'
import Post from '../components/Post'
import Mine from '../components/Mine'
import List from '../components/List'
import Diary from '../components/Diary'
import Bbs from '../components/Bbs'
import Login from '../components/Login'
Vue.use(Router)

const router= new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home,
      children:[
        {
          path: '',
          name: 'list',
          component: List
        },{
          path: 'mine',
          name: 'mine',
          component: Mine
        }
      ]
    },{
      path: '/editor',
      name: 'editor',
      component: DiaryEditor
    },
    {
      path: '/post/:imageUrl',
      name: 'post',
      component: Post
    },{
      path: '/diary',
      name: 'diary',
      redirect: to => {
        return 'http://diary.yingxiangempire.com';
      }
    },{
      path: '/bbs',
      name: 'bbs',
      component: Bbs
    }
    ,{
      path: '/login',
      name: 'login',
      component: Login
    }
  ]
})

router.beforeEach((to, from, next) => {
  if(to.query.token){
    window.localStorage.setItem('ACCESS_TOKEN', to.query.token)
  }
  if (window.localStorage.ACCESS_TOKEN) { // 如果本地存在 access_token，则继续导航
    next()
  }
})

export default router

import Vue from 'vue'
import Router from 'vue-router'
import Home from '../components/Home'
import DiaryEditor from '../components/DiaryEditor'
import Post from '../components/Post'
import Mine from '../components/Mine'
import List from '../components/List'
import Diary from '../components/Diary'
import Bbs from '../components/Bbs'
Vue.use(Router)

export default new Router({
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
      component: Diary
    },{
      path: '/bbs',
      name: 'bbs',
      component: Bbs
    }
  ]
})

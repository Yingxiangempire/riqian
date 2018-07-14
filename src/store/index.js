/**
 * Created by yuxiangwang on 18/4/21.
 */
import Vue from 'vue'
import state from './state'
import Vuex from 'vuex'
import getters from './getters'
import post from './modules/post'
import weixinconfig from './modules/weixin'
import user from './modules/user'
Vue.use(Vuex);
const store = new Vuex.Store({
    state,
    getters,
    modules: {
        post,
        user,
        weixinconfig
    }
})
export default store
/**
 * Created by yuxiangwang on 18/4/21.
 */
import Vue from 'vue'
import state from './state'
import Vuex from 'vuex'
import getters from './getters'
import post from './modules/post'
Vue.use(Vuex);
const store = new Vuex.Store({
    state,
    getters,
    modules: {
        post
    }
})
export default store
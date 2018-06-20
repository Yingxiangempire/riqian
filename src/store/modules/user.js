// initial state
import Vue from 'vue'
import api from '../../api/index'
const state = {
    user: {}
}

// getters
const getters = {
    user:state=>state.user
}

// actions
const actions = {
    async getUserInfo({commit}){
        api.get('userInfo').then(response => {
            state.user=response.data.data;
          }).catch(error => {
            alert('获取用户信息失败');
          })
    }
}

// mutations
const mutations = {

}

export default {
    state,
    getters,
    actions,
    mutations
}

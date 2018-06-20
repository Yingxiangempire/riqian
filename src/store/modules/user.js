// initial state
import Vue from 'vue'
import api from '../../api/index'
const state = {
    user: []
}

// getters
const getters = {
    user:state=>state.user
}

// actions
const actions = {
    async getUserInfo({commit}){
        api.get('userInfo').then(response => {
             state.user=[{
                 'title':response.data.data.name,
                 'src':response.data.data.avatar,
                'desc':response.data.data.nick_name}]
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

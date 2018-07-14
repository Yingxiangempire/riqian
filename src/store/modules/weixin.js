// initial state
import Vue from 'vue'
import api from '../../api/index'
const state = {
    config: []
}

// getters
const getters = {
    config:state=>state.config
}

// actions
const actions = {
     getWeixinConfig({commit}){
        return api.get('weixinConfig').then(response => {
            return response.data;
          }).catch(error => {
            alert('获取微信配置');
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

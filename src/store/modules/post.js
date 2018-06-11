// initial state
import Vue from 'vue'
import api from '../../api/index'
const state = {
    post: {
        weather:'',
        location:'',
        images:'',
        content:'',
        tag:''
    },
    redirect:''
}

// getters
const getters = {
    post:state=>state.post,
    tag:state=>state.tag,
    redirect:state=>state.redirect
}

// actions
const actions = {
    async getLocationAndWeather({commit}){
        api.post('locationAndWeather').then(response => {
            console.log(response.data.data);
            state.post.weather=response.data.data.weather;
            state.post.location=response.data.data.location;
          }).catch(error => {
            alert('获取位置信息失败');
          })
    },
    async getTags({commit}){
        api.post('tags').then(response => {
            state.tag=[].slice.call(response.data);
            console.log(response.data);
          }).catch(error => {
            alert('获取标签信息失败');
          })
    },
    updatePost ({commit}) {
       return api.post('post', state.post).then(response => {
              return response.data.data.imageUrl;
          }).catch(error => {
              alert('失败');
          })
    }
}

// mutations
const mutations = {
    setPost (state, {val}) {
        console.log(val)
        Object.keys(val).map(key => {
            Vue.set(state.post, key, val[key])
        })
    },
    updatePost (state, {key, val}) {
        Vue.set(state.post, key, val)
        console.log(state.post)
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}

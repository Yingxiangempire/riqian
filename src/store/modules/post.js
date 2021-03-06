// initial state
import Vue from 'vue'
import api from '../../api/index'
import axios from 'axios'
const state = {
    post: {
        weather:'',
        location:'',
        images:'',
        content:'',
        tag:''
    },
    tag:[],
    redirect:'',
    list:[],
    myList:[]
}

// getters
const getters = {
    post:state=>state.post,
    tag:state=>state.tag,
    redirect:state=>state.redirect,
    list:state=>state.list,
    myList:state=>state.myList
}

// actions
const actions = {
    async getLocationAndWeather({commit}){
        api.post('locationAndWeather').then(response => {
            state.post.weather=response.data.data.weather;
            state.post.location=response.data.data.location;
          }).catch(error => {
            alert('获取位置信息失败');
          })
    },
    async getTags({commit}){
        api.post('tags').then(response => {
            state.tag=[].slice.call(response.data);
          }).catch(error => {
            alert('获取标签信息失败');
          })
    },
    async getList({commit},page){
        api.get('post?page='+page.page).then(response => {
            state.list=response.data.data;
            response.data.data.map((item,key)=>
            state.list[key]={'html':'<img src='+item+' alt='+key +'>'}
           );
          }).catch(error => {
            alert('获取日签列表信息失败');
          })
    },
    async getMyList({commit},page){
        api.get('myPost?page='+page.page).then(response => {
            state.list=response.data.data;
            response.data.data.map((item,key)=>
            state.list[key]={'html':'<img src='+item+' alt='+key +'>'}
           );
          }).catch(error => {
            alert('获取日签列表信息失败');
          })
    },
    updatePost ({commit}) {
       return api.post('post', state.post).then(response => {
              return response.data.data.imageUrl;
          }).catch(error => {
              alert('失败');
          })
    },
    updateImage ({commit},s) {
        return axios.post('api/image', s.data,{headers:{'Content-Type': 'multipart/form-data;charset=utf-8;','Authorization' : 'Bearer ' + window.localStorage.ACCESS_TOKEN}}).then(response => {
            state.post.images= response.data.data.url  
            return response;
           }).catch(error => {
               alert('失败');
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

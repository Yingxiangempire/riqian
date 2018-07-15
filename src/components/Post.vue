<template>
  <div>
    <div v-for="src in list" style="background-color:yellow;text-align:center;">
      <span style="font-size:20px;">Loading</span>
      <x-img :src="src" :webp-src="`${src}?type=webp`" @on-success="success" @on-error="error" class="ximg-demo" error-class="ximg-error" :offset="-100" container="#vux_view_box_body"></x-img>
    </div>
  </div>
</template>

<script>
import { XImg } from 'vux'
import { WechatPlugin, AjaxPlugin } from 'vux'
import Vue from 'vue'
Vue.use(WechatPlugin)

export default {
  components: {
    XImg
  },
  methods: {
    success (src, ele) {
      console.log('success load', src)
      const span = ele.parentNode.querySelector('span')
      ele.parentNode.removeChild(span)
    },
    error (src, ele, msg) {
      console.log('error load', msg, src)
      const span = ele.parentNode.querySelector('span')
      span.innerText = 'load error'
    }
  },
  data () {
    return {
      list: [
        this.$route.params.imageUrl
      ]
    }
  },
  created(){
    // Vue.http.get('/api', ({data}) => {
    //   console.log(data.data);
    //     Vue.wechat.config(data.data)
    //  })
    this.$store.dispatch({
        type: "getWeixinConfig"
      }).then(res =>{
        Vue.wechat.config(res);
        var wechat=this.$wechat;
        this.$wechat.ready(function(){
          setTimeout(  
            wechat.onMenuShareTimeline({
               title: '除非经由记忆之路，人不能达到纵深',
              success:function(){
                alert('分享成功')
              },
              cancel:function(){
                alert('分享失败')
              }
       }),3000)

        })(wechat);
        this.$wechat.error(function(){
          alert('你妹');
        });
       
        });
  }
}
</script>

<style>
.ximg-demo {
  width: 100%;
  height: auto;
}
.ximg-error {
  background-color: yellow;
}
.ximg-error:after {
  content: '加载失败';
  color: red;
}
</style>
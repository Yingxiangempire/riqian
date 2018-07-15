<template>
  <div>
    <div v-for="src in list" style="background-color:yellow;text-align:center;">
      <span style="font-size:20px;">Loading</span>
      <x-img :src="src" :webp-src="`${src}?type=webp`" @on-success="success" @on-error="error" class="ximg-demo" error-class="ximg-error" :offset="-100" container="#vux_view_box_body"></x-img>
    </div>
    <button  @click="share" type="primary">保存</button> 
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
    share(){
     this.$store.dispatch({
        type: "getWeixinConfig"
      }).then(res =>{
        Vue.wechat.config(res);
        console.log(this.$wechat);
        this.$wechat.ready(function(){
        this.$wechat.onMenuShareTimeline({
              title: 'hello VUX',
              desc:'我已经在映像日记平台坚持写日记20天',
              link:'https://www.yingxiangempire.com/aa',
              imageUrl:'http://css.tools.chinaz.com/tools/images/public/logos/logo-index.png',
              success:function(){
                alert('分享成功')
              },
              cancel:function(){
                alert('分享失败')
              }
          })
        });
        this.$wechat.error(function(){
          alert('你妹');
        });
        });
    },
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
  mounted(){
    // Vue.http.get('/api', ({data}) => {
    //   console.log(data.data);
    //     Vue.wechat.config(data.data)
    //  })
    
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
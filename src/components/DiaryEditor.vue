<template>
  <div>
  
<header><input class="weather" v-model="post.weather" hidden/>天气：{{post.weather}}<span class="date">日期：2018/4/5</span><hr/></header>
<div id="main" class="input">
  <uploader :max="varmax"
    :images="images"
    v-model="post.images"
    :handle-click="false"
    :show-header="true"
    :readonly="false"
    :autoUpload="false"
    :upload-url="uploadUrl"
    name="img"
    :params="params"
    size="small"
    @upload-image="ad"
  ></uploader>
    <div class="mycontent">
     <textarea class="input" rows="5" cols="50"  v-model="post.content"></textarea>
         </div>
        </div>

    <footer>  
    <group >
        <selector placeholder="请选择标签" v-model="post.tag" title="标签" name="district" :options="tag" ></selector>
    </group>  
     <x-button  @click.native="createPost" type="primary">保存</x-button> 
            位置：{{post.location}}</footer>
　　</div>

</template>

<script>
import {Divider,XButton,Selector, Group,Cell, CellBox} from 'vux'
import Uploader from 'vux-uploader'
import { mapState, mapActions, mapGetters } from "vuex";
export default {
    components: {
      Group,
      Divider,
      XButton,
      Uploader,
      Selector,
      Cell, 
      CellBox
  },
  data () {
    return {
    }
  },
  methods: {
     createPost() {
      this.$store.dispatch({
        type: "updatePost"
      }).then(res=>{this.$router.push({ name: 'post', params: { imageUrl: res }})});
    },
    ad: function (formData) {
     if (this.$vux && this.$vux.loading) {
          this.$vux.loading.show('正在上传')
        }
       this.$store.dispatch({
          type: "updateImage",data:formData
      }).then((response) => {
          
          this.images.push(response.data.data)
        })
    }
  },

   computed: {
    ...mapGetters([
      'tag',
      'post'
    ])
  },
  created(){
     this.$store.dispatch({
          type: "getTags"
      }
      );
      this.$store.dispatch({
         type: "getLocationAndWeather"
      }
      );
  },
  props: {
    images: {
      type: Array,
      default: () => []
    },
    varmax: {
      type: Number,
      default: 9
    },
    showHeader: {
      type: Boolean,
      default: true
    },
    showTip: {
      type: Boolean,
      default: true
    },
    readonly: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: '图片上传'
    },
    // 是否接管+号的click事件，如果是，点击不弹出选择文件的框
    handleClick: {
      type: Boolean,
      default: true
    },
    // 选择文件后是否自动上传，如果不是，则emit change事件
    autoUpload: {
      type: Boolean,
      default: false
    },
    uploadUrl: {
      type: String,
      default: "http://114.215.134.80/api/image"
    },
    size: {
      type: String,
      default: 'normal'
    },
    capture: {
      type: String,
      default: ''
    },
    name: {
      type: String,
      default: 'img'
    },
    params: {
      type: Object,
      default: null
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
        header {
            width:100%;
            height:2rem;
            position:absolute;
            z-index:3;
            top:1;
        }
        weather{
          float:left;
        }
        date{
          float:right;
        }
        #main {
            width:100%;
            overflow:auto;
            top:2rem;
            position:absolute;
            z-index:10;
            bottom:2rem;
        }
        footer {
            height:6rem;
            width:100%;
            position:absolute;
            z-index:200;
            bottom:0;
            text-align:center;
        }
</style>

<template>
  <div>
    <panel :list="list" type="1"></panel>

   <group title="应用设置">
          <router-link to="/diary">
             <div  class="weui-cell weui-cell_access">
                <div class="weui-cell__hd"><img src="http://placeholder.qiniudn.com/60x60/3cc51f/ffffff" alt="" style="width: 20px; margin-right: 5px; display: block;">
                </div> 
                 <div class="weui-cell__bd">
                    <p> 绑定手机</p>
                </div> 
             </div>
          </router-link>
             <a href="javascript:void(0);" class="weui-cell weui-cell_access">
                 <div class="weui-cell__hd">
                  <img src="http://placeholder.qiniudn.com/60x60/3cc51f/ffffff" alt="" style="width: 20px; margin-right: 5px; display: block;">
                </div> 
                 <div class="weui-cell__bd">
                   <p> 推送设置( 默认每晚9点推送 )</p>
                  </div> 
              </a>
     </group>

     <group title="日签设置">
             <a href="#!/component/cell" class="weui-cell weui-cell_access">
                <div class="weui-cell__hd">
                  <img src="http://placeholder.qiniudn.com/60x60/3cc51f/ffffff" alt="" style="width: 20px; margin-right: 5px; display: block;">
                </div> 
                 <div class="weui-cell__bd">
                    <p> 设置纪念标记( 倒计时;纪念日 )</p>
                </div> 
             </a>
             <a href="javascript:void(0);" class="weui-cell weui-cell_access">
                 <div class="weui-cell__hd">
                  <img src="http://placeholder.qiniudn.com/60x60/3cc51f/ffffff" alt="" style="width: 20px; margin-right: 5px; display: block;">
                </div> 
                 <div class="weui-cell__bd">
                   <p> 日记本选项</p>
                  </div> 
              </a>
     </group>
  </div>
</template>

<script>
import {Group,Cell,Panel} from 'vux'
export default {
  components: {
    Group,
    Cell,
    Panel
  },
  data () {
   return {
          header:"2018/4/5",
          type: '5',
          list: [ {
            title: 'YingxiangEmpire',
            src: 'http://placeholder.qiniudn.com/60x60/3cc51f/ffffff',
            desc: '微信号:XJTLU_Liverpool',
          }]
        }
  }
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

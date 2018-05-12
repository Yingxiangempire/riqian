<template>
  <div>
      <router-view></router-view>
     <tabbar>
          <tabbar-item selected link="/">
            <img slot="icon" src="../assets/demo/icon_nav_button.png">
            <span slot="label">日签轴</span>
          </tabbar-item>
          <tabbar-item show-dot link="/bbs">
            <img slot="icon" src="../assets/demo/icon_nav_msg.png">
            <span slot="label">日签圈</span>
          </tabbar-item>
          <tabbar-item link="/diary">
            <img slot="icon" src="../assets/demo/icon_nav_article.png">
            <span slot="label">日记本</span>
          </tabbar-item>
          <tabbar-item badge="4" link="/mine">
            <img slot="icon" src="../assets/demo/icon_nav_cell.png">
            <span slot="label">我</span>
          </tabbar-item>
        </tabbar>
  </div>
</template>

<script>
import {Tabbar, TabbarItem} from 'vux'
import List from './List'
export default {
  components: {
    Tabbar,
    TabbarItem,
     List
  },
  data () {
    return {
        }
  }
}
</script>

<style>
.vux-demo {
  text-align: center;
}
.logo {
  width: 100px;
  height: 100px
}
</style>

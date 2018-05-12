<template>
  <div>
    <div class="vux-demo">
      <img class="logo" src="../assets/vux_logo.png">
      <h1> </h1>
    </div>
    <group title="cell demo">
      <cell title="VUX" value="cool" is-link></cell>
    </group>
     <tabbar>
          <tabbar-item>
            <img slot="icon" src="../assets/demo/icon_nav_button.png">
            <span slot="label">日签</span>
          </tabbar-item>
          <tabbar-item show-dot>
            <img slot="icon" src="../assets/demo/icon_nav_msg.png">
            <span slot="label">日签圈</span>
          </tabbar-item>
          <tabbar-item selected>
            <img slot="icon" src="../assets/demo/icon_nav_article.png">
            <span slot="label">日记本</span>
          </tabbar-item>
          <tabbar-item badge="4">
            <img slot="icon" src="../assets/demo/icon_nav_cell.png">
            <span slot="label">我</span>
          </tabbar-item>
        </tabbar>
  </div>
</template>

<script>
import { Group, Cell,Tabbar, TabbarItem } from 'vux'

export default {
  components: {
    Group,
    Cell,
    Tabbar,
    TabbarItem
  },
  data () {
    return {
      // note: changing this line won't causes changes
      // with hot-reload because the reloaded component
      // preserves its current state and we are modifying
      // its initial state.
      msg: 'Hello World!'
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

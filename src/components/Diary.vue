<template>
  <div>
   <group>
      <cell is-link title="日记本" link="/component/tabbar-simple"></cell>
    </group>
  </div>
</template>

<script>
import {Group,Cell} from 'vux'
export default {
  components: {
    Group,
    Cell
  },
  data () {
    return {
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

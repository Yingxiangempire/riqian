<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style lang="less">
@import '~vux/src/styles/reset.less';

body {
  background-color: #fbf9fe;
}
.input{position:relative;width:98%}
.word{position:absolute;line-height:20px;left:0px;top:1px;z-index:10;background:#fff}
.input textarea{height:920px;border:none; text-indent:25px;line-height:20px;background:url(http://www.w3dev.cn/eg/linebg.gif) repeat;overflow:auto}
</style>

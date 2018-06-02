<template>
<div>
<div class='touch' @touchstart.stop.capture="touchstart"
      @touchmove.stop.capture="touchmove"
      @touchend.stop.capture="touchend"
      @mousedown.stop.capture="touchstart"
      @mouseup.stop.capture="touchend"
      @mousemove.stop.capture="touchmove" :style="[transformIndex(1),transform(1)]">huuihihuihiu</div>
</div>
</template>

<script>
import jQuery from "jquery"

export default {
  components: {},
  created() {
  },
  mounted(){
    
  },
  data () {
    return {
      // basicdata数据包含组件基本数据
      basicdata: {
        start: {}, // 记录起始位置
        end: {}, // 记录终点位置
        currentPage: 0 // 默认首图的序列
      },
      // temporaryData数据包含组件临时数据
      temporaryData: {
        poswidth: '', // 记录位移
        posheight: '', // 记录位移
        tracking: false, // 是否在滑动，防止多次操作，影响体验
        animation: false, // 首图是否启用动画效果，默认为否
        opacity: 1 // 记录首图透明度
      }
    }
  },
  methods: {
    touchstart (e) {
      if (this.temporaryData.tracking) {
        return
      }
      // 是否为touch
      if (e.type === 'touchstart') {
        console.log('yes');
        if (e.touches.length > 1) {
          this.temporaryData.tracking = false
          return
        } else {
          // 记录起始位置
          this.basicdata.start.t = new Date().getTime()
          this.basicdata.start.x = e.targetTouches[0].clientX
          this.basicdata.start.y = e.targetTouches[0].clientY
          this.basicdata.end.x = e.targetTouches[0].clientX
          this.basicdata.end.y = e.targetTouches[0].clientY
        }
      // pc操作
      } else {
         console.log('pcyes');
        this.basicdata.start.t = new Date().getTime()
        this.basicdata.start.x = e.clientX
        this.basicdata.start.y = e.clientY
        this.basicdata.end.x = e.clientX
        this.basicdata.end.y = e.clientY
      }
      this.temporaryData.tracking = true
      this.temporaryData.animation = false
    },
    touchmove (e) {
      // 记录滑动位置
      if (this.temporaryData.tracking && !this.temporaryData.animation) {
        if (e.type === 'touchmove') {
          this.basicdata.end.x = e.targetTouches[0].clientX
          this.basicdata.end.y = e.targetTouches[0].clientY
        } else {
          this.basicdata.end.x = e.clientX
          this.basicdata.end.y = e.clientY
        }
        // 计算滑动值
        this.temporaryData.poswidth = this.basicdata.end.x - this.basicdata.start.x
        this.temporaryData.posheight = this.basicdata.end.y - this.basicdata.start.y
         console.log(this.temporaryData.poswidth);
         console.log(this.temporaryData.posheight);
      }
    },
    touchend (e) {
      this.temporaryData.tracking = false
      this.temporaryData.animation = true
      // 滑动结束，触发判断
      // 简单判断滑动宽度超出100像素时触发滑出
      if (Math.abs(this.temporaryData.poswidth) >= 100) {
        // 最终位移简单设定为x轴200像素的偏移
        let ratio = Math.abs(this.temporaryData.posheight / this.temporaryData.poswidth)
        this.temporaryData.poswidth = this.temporaryData.poswidth >= 0 ? this.temporaryData.poswidth + 200 : this.temporaryData.poswidth - 200
        this.temporaryData.posheight = this.temporaryData.posheight >= 0 ? Math.abs(this.temporaryData.poswidth * ratio) : -Math.abs(this.temporaryData.poswidth * ratio)
        this.temporaryData.opacity = 0
      // 不满足条件则滑入
      } else {
        this.temporaryData.poswidth = 0
        this.temporaryData.posheight = 0
      }
    },
    // 非首页样式切换
    transform (index) {
      if (index > this.basicdata.currentPage) {
        let style = {}
        let visible = 3
        let perIndex = index - this.basicdata.currentPage
        // visible可见数量前滑块的样式
        if (index <= this.basicdata.currentPage + visible - 1) {
          style['opacity'] = '1'
          style['transform'] = 'translate3D(0,0,' + -1 * perIndex * 60 + 'px' + ')'
          style['zIndex'] = visible - index + this.basicdata.currentPage
          style['transitionTimingFunction'] = 'ease'
          style['transitionDuration'] = 300 + 'ms'
        } else {
          style['zIndex'] = '-1'
          style['transform'] = 'translate3D(0,0,' + -1 * visible * 60 + 'px' + ')'
        }
        return style
      }
    },
    // 首页样式切换
    transformIndex (index) {
      // 处理3D效果
      if (index === this.basicdata.currentPage) {
        let style = {}
        style['transform'] = 'translate3D(' + this.temporaryData.poswidth + 'px' + ',' + this.temporaryData.posheight + 'px' + ',0px)'
        style['opacity'] = this.temporaryData.opacity
        style['zIndex'] = 10
        if (this.temporaryData.animation) {
          style['transitionTimingFunction'] = 'ease'
          style['transitionDuration'] = 300 + 'ms'
        }
        return style
      }
    }
  }
};


</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style >
  #touch{
        bottom: 5px;
        right: 5px;
        position:fixed;
    } 
</style>

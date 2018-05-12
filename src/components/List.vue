<template>
  <div>
   <timeline>
        			<timeline-item>
                      <router-link to="/editor">
                        <x-icon type="ios-plus" size="60"></x-icon>
                       </router-link>
        			</timeline-item>
        			<timeline-item>
        				<panel  :header="header" :list="list" type="1">
                                  				 </panel>
        			</timeline-item>
        			<timeline-item>
        				<panel  :header="header" :list="list" type="1">
                                  				 </panel>
        			</timeline-item>
        		</timeline>
        		<timeline>
        			<timeline-item v-for="(i, index) in count" :key="index">
        				<h4 :class="[i === 0 ? 'recent' : '']">Timeline Node {{i + 1}}</h4>
        				<p :class="[i === 0 ? 'recent' : '']">index {{i + 1}}</p>
        			</timeline-item>   
        		</timeline>
  </div>
</template>

<script>
import {Timeline, TimelineItem, Panel} from 'vux'
export default {
  components: {
    Timeline,
    TimelineItem,
     Panel
  },
  data () {
    return {
          header:"2018/4/5",
          type: '5',
          list: [ {
            src: 'http://placeholder.qiniudn.com/60x60/3cc51f/ffffff',
            fallbackSrc: 'http://placeholder.qiniudn.com/60x60/3cc51f/ffffff',
            desc: '王玉翔的第一条日签这个宽度得自己设置让它自动撑满大幅度放松的多福多寿',
            url: '/component/cell'
          }]
        }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.cell-x-icon {
  display: block;
  fill: green;
}
.vux-x-icon {
  fill: green;
}
</style>

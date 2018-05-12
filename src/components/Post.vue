<template>
  <div>
   <timeline>
        			<timeline-item>
                      <router-link to="/editor">
                        <x-icon type="ios-plus" size="60"></x-icon>
                       </router-link>
        			</timeline-item>
        			<timeline-item>
        				<panel  :header="imageUrl" :list="list" type="1">
                                  				 </panel>
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
          imageUrl:''
        }
  },
  mounted() {
   this.imageUrl=this.$route.params.imageUrl;
  },
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

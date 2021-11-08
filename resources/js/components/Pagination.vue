<template>
  <div v-if="links.length > 3">
      <!-- 페이지가 2개부터 생긴다.(그래야 4개의 links가 생긴다.) (이전, 현재, 다음 버튼 누를때 나오는 페이지가 기본으로 3개) -->
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
        <div @click="pageClicked(link.url)" v-else :key="key" class="px-4 py-3 mb-1 mr-1 text-sm leading-4 border rounded hover:bg-blue-600 bg-white-500 font-bold focus:border-indigo-500 focus:text-indigo-500" :class="{'bg-blue-500':link.active}" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
  methods:{
      pageClicked(url){
          this.$emit('pageClicked',url);
      }
  }
}
</script>

<template>
    <div>
        <button @click="getComments" class="btn btn-default">댓글 불러오기</button>
        <comment-item v-for="(comment,index) in comments" :key="index" :comment="comment"></comment-item>
    </div>
</template>

<script>
import CommentItem from './CommentItem'

export default{
    components:{
        CommentItem,
    },
    data(){
        return{
            comments:[],
        }
    },
    props:['post','loginuser'],
    
    methods:{
        getComments(){
            this.comments=['1임','2임','3임']
        }
    }

}
</script>

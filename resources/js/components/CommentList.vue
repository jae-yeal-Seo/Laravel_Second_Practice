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
           
            this.comments=['1임','2임','3임'];
        //서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청
        //즉, axios를 이용해서 요청.
        //서버가 댓글 리스트를 주면 그 놈을 
        //this.comments에 할당.
        }
    }

}
</script>

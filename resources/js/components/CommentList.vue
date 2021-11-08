<template>
    <div>
        <label class="block text-left" style="max-width: 400px">
  <button @click="addComment" class="text-gray-700">댓글등록</button>
  <textarea v-model="newComment"
    class="form-textarea mt-1 block w-full"
    rows="3"
    placeholder="Enter some long form content."
  ></textarea>
</label>
        <button id="commentcall" @click="getComments" class="btn btn-default">댓글 불러오기</button>
        <div id = "commentslide">
        <comment-item v-for="(comment,index) in comments.data" :key="index" :comment="comment" :login_user_id="loginuser"></comment-item>
        </div>
        <pagination @pageClicked="getPage" v-if="comments.data != null" :links="comments.links"/>
        <!-- paginate를 했기때문에 comments라는 Object가 links를 가지고 있다. -->
        <!-- 버튼을 눌러서 데이터를 가져오는 순간 pagination이 생긴다. -->
    </div>
</template>

<script>

import CommentItem from './CommentItem'
import Pagination from './Pagination.vue'



export default{
    
    components:{
        CommentItem,
        Pagination,
    },
    data(){
        return{
            comments:[],
            newComment:''
        }
    },
    props:['post','loginuser'],
    
    methods:{
        addComment(){
            if(this.newComment == ''){
                alert('한글자라도 입력하십시오');
                return;
            }
            else{
            axios.post('/comments/'+this.post.id,{'comment':this.newComment})
            .then(res=>{console.log(res.data)
                        this.getComments();
                        this.newComment = '';
            })
            .catch(err=>{console.log(err)})
            }
        },
        getPage(url){
            axios.get(url)
            .then(response=>{
               this.comments = response.data;
             })
        .catch(err=>{
               console.log(err);
           })
        },
        getComments(){
           axios.get('/comments/'+this.post.id)
           .then(response=>{
               this.comments = response.data;
           })
           .catch(err=>{
               console.log(err);
           });
            // this.comments=['1임','2임','3임'];
        //서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청
        //즉, axios를 이용해서 요청.
        //서버가 댓글 리스트를 주면 그 놈을 
        //this.comments에 할당.
        }
    }

}
</script>

<template>
    <div>
        <div class="container" v-if="loading==false">
            <div class="main-body m-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                    <div class="mt-3">
                                        <h1>Id: {{AuthUser.id}}</h1>
                                        <h4>{{AuthUser.name}}</h4>
                                        
                                        
                                    </div>
                                </div>
                                <hr class="my-4">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                        
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" v-model="form.name" :placeholder=AuthUser.name>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" :placeholder=AuthUser.email v-model="form.email">
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" v-model="form.password" placeholder="new Password">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="button" class="btn btn-primary px-4" value="Update Changes" @click="updateDetails">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</template>


<script>
import {reactive,ref} from 'vue';
export default{
    data(){
        return{
            AuthUser:null,
            loading:true,
        }
    },
    setup(){
            
            let form = reactive({
                name:'',
                email:'',
                password:'',
            })
            
            
            return {form};
        },
        mounted(){
            this.AuthUser=this.$store.state.AuthUser;
            // console.log('updated '+this.$store.state.AuthUser);
            this.loading=false;
        },methods:{
            updateDetails(){
                console.log(this.AuthUser);
                axios.post('api/updateUser/'+this.AuthUser.id,this.form).then(res=>{
                    console.log(res);
                    if(res.data=='validation fails'){
                        alert('Fill all particulars');
                    }else{
                        alert(res.data);
                        this.$router.push('/');
                    }
                })
            } 
        }
}
</script>


<style>
body{
    background: #f7f7ff;

}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>


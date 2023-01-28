<template>
    <div>
        <div class="container align-items-center m-5">
            <div class="row justify-content-center align-items-center">
              
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        
                        <div class="card-body">
                            <p class="text-danger" >{{error}}</p>
                            <form @submit.prevent="loginUser">
                        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email"  required autocomplete="email" autofocus v-model="form.email">
        
                                       
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password"  v-model="form.password">
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" >
        
                                            <label class="form-check-label" for="remember">
                                                Remember me
                                            </label>
                                        </div> -->
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                    </div>
                                </div>
                            </form>
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
            return {
                error:''
            }
        },
        setup(){
            
            let form = reactive({
                email:'',
                password:''
            })
            
            
            return {form};
        },
        methods:{
            loginUser(){
                
                axios.post('/api/login',this.form)
                .then(res=>{
                    if(res.data.success===false){
                        
                        this.error='Wrong Credentials';

                    }else{
                        
                        localStorage.setItem('token',res.data.data.token);
                        const config = {
                            headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                        };
                        axios.get('api/user',config).then(res=>{
                            this.$store.state.AuthUser=res.data;
                            console.log('LogIn');
                        })
                        
                        this.$store.commit('changeStatus');
                        this.$router.push({path:'/'})
                        
                    }
                })
                
            }
            
        }
        

    }
</script>
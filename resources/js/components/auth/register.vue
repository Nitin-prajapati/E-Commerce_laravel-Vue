<template>
    <div>
        
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <p class="text-danger" >{{errors}}</p>
                    <form @submit.prevent="registerUser">
                       

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  required autocomplete="name" autofocus v-model="name">

                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email address</label>

                            <div class="col-md-6">
                                <input id="email" type="email"  required autocomplete="email" v-model="email">

                                  
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  name="password" required autocomplete="new-password" v-model="password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password" 
                                v-model="c_password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
    import {useRouter} from 'vue-router';
    const router=useRouter();
    export default{
        data(){
            return{
                name:'',
                email:'',
                password:'',
                c_password:'',
                errors:'',
            }
        },
        methods:{
             registerUser(){
                
                axios.post('api/register',{
                    name:this.name,
                    email:this.email,
                    password:this.password,
                    c_password:this.c_password,
                }).then(res=>{

                    if(res.data.success===false){
                        this.errors='Registration Failed';
                    }else{  
                        localStorage.setItem('token',res.data.data.token);
                        const config = {
                            headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                        };
                        axios.get('api/user',config).then(res=>{
                            this.$store.state.AuthUser=res.data;
                           
                        })
                        this.$store.commit('changeStatus');
                        this.$router.push({path:'/'})
                        
                    }
                });
            }
            
        }
    }

</script>
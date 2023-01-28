
<template>
    <div>
        
        <!-- Image and text -->
        <nav class="navbar  rounded extra ">
            <a class="navbar-brand ms-2">
                <img src="https://www.southcharlottefamilycounseling.com/wp-content/uploads/2015/10/cropped-logo-dummy.png" width="30" height="30" class="d-inline-block align-top" alt=""> E-Comm
            </a>
            <div class="d-flex flex-row-reverse">
                 
                <router-link to="/log">
                    <div  class="p-2 " v-if="isUserLogin==false">
                        <loginButton  ></loginButton>
                    </div>   
                </router-link>
                <router-link to="/reg">
                    <div  class="p-2" v-if="isUserLogin==false">
                        <registerButton  ></registerButton>
                    </div>   
                </router-link>
                
                
                
                <router-link to="/cart">
                    <div class="p-2">
                        <button type="button" class="btn btn-outline-secondary m-2 ">
                            <span style="color:black">Cart | {{ cartCount }}   
                            </span>
                        </button>  
                    </div>
                </router-link>
                <div class="mt-3" v-if="!loading && isUserLogin==true">
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ currentUser }}
                        </a>
                      
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <router-link to="/profile"><a class="dropdown-item">Profile</a></router-link>
                          <button class="p-2 m-2 bg-danger rounded"  v-if="isUserLogin==true" @click="logout">
                           LogOut
                          </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </nav>

        <div class="row justify-content-evenly homeBg" >
            <gridView v-for="item in this.$store.state.listedItems" :key="item.data.id"  :item="item" @addedToCart="addedToCart" @removedFromCart="removedFromCart">  </gridView>
        </div>

        <!-- <profile></profile> -->
    </div>
</template>

<script>
    import gridView from './gridView.vue'
    import loginButton from '../auth/LoginButton.vue';
    import profile from '../Profile/profile.vue';
    import registerButton from '../auth/RegisterButton.vue';
    
    export default {
        data(){
            return{
                ListedItems:[],
                loading:true,
                currentUser:'',
            }
        },
        computed:{
            isUserLogin(){
                return this.$store.getters.authData;
            },
            cartCount(){
                return this.$store.getters.currentCartSize;
            }
        },
        components: {
            gridView,
            loginButton,
            registerButton,
            profile,
        },
        methods: {
            addedToCart(id){
                for(var i=0;i<this.ListedItems.length;i++){
                    if(this.ListedItems[i].data.id==id){
                        this.ListedItems[i].data.added=true;
                        break;
                    }
                }
            },
            removedFromCart(id){
                for(var i=0;i<this.ListedItems.length;i++){
                    if(this.ListedItems[i].data.id==id){
                        this.ListedItems[i].data.added=false;
                        break;
                    }
                }
            },
            logout(){
                localStorage.removeItem('token');
                this.$store.dispatch('logOutUser');
                this.$store.commit('changeStatus');
                
                this.$router.push({path:'/'})
            },
            
        },
        mounted(){
            
            if(this.$store.state.listedItems.length==0){
                var fetchedItem=[];
                // console.log('home page');
                axios.get('api/getItems').then(res=>{
                
                    fetchedItem=res.data.data;
                    for(var i=0;i<fetchedItem.length;i++){
                        this.$store.state.listedItems.push({data:fetchedItem[i],added:false});
                    }
                    
                    
                });
            }
            

            if(localStorage.getItem('token')){
                const config = {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                };
                axios.get('api/user',config).then(res=>{
                    this.$store.state.AuthUser=res.data;
                    this.currentUser=res.data.name;
                })
            }
            this.loading=false;
        }

        
    }
</script>

<style>
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
    }
    .btn-circle {
        width: 50px;
        height: 50px;
        padding: 6px 0px;
        border-radius: 25px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
    .extra {
        background: #e1e3d6;
        box-shadow: 2px 2px gray;
    }
    .homeBg{
        --bs-gutter-x: 0rem;
        background: rgb(79,73,174);
        background: linear-gradient(90deg, rgba(79,73,174,1) 0%, rgba(9,121,9,0.4739145658263305) 0%, rgba(0,212,255,0.42629551820728295) 96%);
    }
</style>
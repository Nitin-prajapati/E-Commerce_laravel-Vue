<template>
    <div class="parent">
        <h1 style="margin-bottom">Cart</h1>
        
        <div class="child overflow-auto card">
            
            <card v-for="i in this.$store.state.cart" :key="i.data.id" :cartItem="i" @remove-item="removeItem" @increase-count="IncreseCount" @decrease-count="DecreseCount"></card>
        </div>
        <button class="btn btn-success m-auto" @click="PlaceOrder">Order</button>
    </div>
</template>

<script>
import card from './CartCard.vue'
export default{
    data(){
        return{
            placedOrder:[],
            
        } 
    },
    components:{
        card,
        
    },
    mounted(){
      console.log(this.$store.state.cart);  
    },
    
    methods:{
        IncreseCount(id){
            
            for(var i=0;i<this.$store.state.cart.length;i++){
                if(this.$store.state.cart[i].data.id==id){
                    this.$store.state.cart[i].itemCount++;
                    break;
                }
            }
            
        },
        DecreseCount(id){
            
            for(var i=0;i<this.$store.state.cart.length;i++){
                if(this.$store.state.cart[i].data.id==id && this.$store.state.cart[i].itemCount>1){
                    this.$store.state.cart[i].itemCount--;
                    break;
                }
            }
            
        },
       removeItem(id){
            // console.log(id);
            this.$store.dispatch('removeFromCart',{'id':id});
            
       },
       PlaceOrder(){
            if(this.$store.state.AuthUser==null){
                alert('You Must Be LoggedIn to complete the action');

            }else{
                for(var i=0;i<this.$store.state.cart.length;i++){
                    this.placedOrder.push(this.$store.state.cart[i]);
                
            }
            var description='';
            var orderAmt=0;
            for(var i=0;i<this.placedOrder.length;i++){
                description+=this.placedOrder[i].data.id+"-"+this.placedOrder[i].itemCount+"#";
                orderAmt+=this.placedOrder[i].itemCount*this.placedOrder[i].data.ItemPrice;
            }
            
            axios.post('api/placeOrder',{
                'desc':description,
                'amt':orderAmt,
                'user_id':this.$store.state.AuthUser.id,
            }).then(res=>{
                if(res.status==201){
                    alert('Thank You '+this.$store.state.AuthUser.name+'\nOrder Successful for the amount of '+orderAmt);
                    this.$store.dispatch('refreshApp');
                    this.$router.push({path:'/'})
                }else{
                    alert(res.data);
                }
            });
            }
            

       } 
    }
    
}

</script>

<style>

.parent{
    background: rgb(79,73,174);
    background: linear-gradient(90deg, rgba(79,73,174,1) 0%, rgba(9,121,9,0.4739145658263305) 0%, rgba(0,212,255,0.42629551820728295) 96%);
    height: 100vh;
    width: 100vw;
    display: flex;
    flex-direction: column;
    align-items: center;
    
}
.child{
    height: 80%;
    width: 70%;
    border: 1px solid black;
    border-radius: 2%;
    flex-direction: column;
    
 
}
</style>

<template>
    <div class="">
        <div class="row cardBg" v-if="!cartItem.deleted">
            <div class="col-4 cardItem cardImageBox">
                <img class="cardImage" :src=cartItem.data.ItemPic alt="###">
                
            </div>
            
            <div class="col-4 cardItem d-flex flex-column justify-content-around align-items-center">
                <div class="row d-flex flex-md-row">
                    <div class="col-4">
                        <button type="button" class="btn btn-success" @click="$emit('decrease-count',cartItem.data.id)">-</button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-around align-items-center">
                        {{ cartItem.itemCount }}
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-success"  @click="$emit('increase-count',cartItem.data.id)">+</button>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-danger" @click="$emit  ('remove-item',cartItem.data.id)">Delete from Cart</button>
                </div> 
            </div>
            <div class="col-4 cardItem d-flex flex-column justify-content-around align-items-center">
                <div class="row-4 ">₹ :{{ currentPrice }}</div>
            </div>
        </div>
        
    </div>
</template>


<script>

    export default{
        
        props:[
            'cartItem',
            'isVisible'
        ],
        
        computed:{
            currentPrice(){
                return this.cartItem.itemCount*this.cartItem.data.ItemPrice;
            },
            
        }
    }

</script>

<style scoped>
    .cardBg{
        border: 1px solid black;
        margin: 2%;
        background-color: #f1f1f1;
        border-radius: 50px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .cardImageBox {
        width: 300px;
        object-fit: fill;
        background-color: rgba(11, 64, 97, 0.2);
        box-shadow: 0 4px 8px 0 rgba(43, 150, 216, 0.2);
        border-radius: 50px;
        object-fit: cover;
    }
    .cardImage {
        height: 200px;
        margin-left: 5%;
        border-radius: 60px;
    }
</style>
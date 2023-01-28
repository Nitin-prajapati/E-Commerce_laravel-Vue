<template>
    
        <div class="card" >
     
            <div class="card-header">
              <img :src=item.data.ItemPic  alt="rover" />
              
            </div>
            <div class="card-body">
              <span class="tag tag-teal">{{item.data.ItemType}}</span>
              <h4>
                {{ item.data.ItemName }}
              </h4>
              <p>
                {{ item.data.description }}
              </p>
              <p>At Just: {{item.data.ItemPrice}}</p>
              
                <button type="button" class="btn border border-secondary" @click="addToCart(item.data.id)" v-if="! item.added">Add to Cart</button>
                <button type="button" class="btn btn-success" @click="removeFromCart(item.data.id)" v-if="item.added">Added Succesfully | Remove</button>
            </div>
        </div>

        
      
</template>

<script>


  export default{
    
    methods:{
      addToCart(id){
        // this.$emit('addedToCart',id);
          this.$store.dispatch('addToCart',{'id':id});
       
      },
      removeFromCart(id){
        
        // this.$emit('removedFromCart',id);
        this.$store.dispatch('removeFromCart',{'id':id});
      }
      
    },
    props:[
      'item'
    ],
    
    
  }
</script>


<style scoped>

* {
  box-sizing: border-box;
}
body {
 
  justify-content: center;
  align-items: center;
  margin: 0;
  background-color: #480c8c;
  font-family: "Roboto", sans-serif;
  color: #10182f;
}
.container {
  display: flex;
  width: 100%;
  justify-content: space-evenly;
  flex-wrap: wrap;
}
.card {
  margin: 10px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  width: 300px;
}
.card-header img {
  width: 100%;
  height: 200px;
  
}
.card-body {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  padding: 20px;
  min-height: 250px;
  justify-content: space-around;
}

.tag {
  background: #cccccc;
  border-radius: 50px;
  font-size: 12px;
  margin: 0;
  color: #fff;
  padding: 2px 10px;
  text-transform: uppercase;
  cursor: pointer;
}
.tag-teal {
  background-color: #47bcd4;
}
.tag-purple {
  background-color: #5e76bf;
}
.tag-pink {
  background-color: #cd5b9f;
}

.card-body p {
  font-size: 13px;
  margin: 0 0 40px;
}
.user {
  display: flex;
  margin-top: auto;
}

.user img {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  margin-right: 10px;
}
.user-info h5 {
  margin: 0;
}
.user-info small {
  color: #545d7a;
}

</style>
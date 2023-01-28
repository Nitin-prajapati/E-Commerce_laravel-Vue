import {createStore} from 'vuex';

export const store = createStore({
    state:{ 
        isUserLogin:localStorage.getItem('token')?true:false,
       cart:[],
       listedItems:[],
       currentlyAddedItems:[],
       AuthUser:null,
    },
    actions:{
        addToCart(context,payload){
            const carT=context.state.cart;
            axios.get('api/getItemWithId/'+payload.id).
            then(res=>{
                
                carT.push({'data':res.data.data,'deleted':false,'itemCount':1});
            }).catch(e=>{console.log(e)});
            // carT.push({'id':payload.id,'itemCount':payload.itemCount});
            context.commit('updateCart',carT);
            context.commit('updateListedItems',payload);
        },
        removeFromCart(context,payload){
            const carT=context.state.cart;
            const newCart=[];
            for(var i=0;i<carT.length;i++){
                if(carT[i].data.id!=payload.id)newCart.push(carT[i]);
            }
            context.commit('updateCart',newCart);
            context.commit('updateListedItems',payload);
            
        }, 
        logOutUser(context){
            context.commit('logOut');
        },
        refreshApp(context){
            context.commit('refresh');
        },
    },
    getters:{
        authData(state){
            return state.isUserLogin;
        },
        currentCartSize(state){
            return state.cart.length;
        },
        currentCart(state){
            return state.cart;
        },
        currentListedItems(state){
            return state.listedItems;
        }
    },
    mutations:{
        changeStatus(state){
            if(localStorage.getItem('token')){
                state.isUserLogin=true;
            }else state.isUserLogin=false;
        },
        updateCart(state,payload){
            state.cart=payload;
            // console.log(state.cart);
        },
        logOut(state){
            state.AuthUser=null;
            
        },
        refresh(state){
            state.cart=[];
            state.listedItems=[];
        },
        updateListedItems(state,payload){
            for(var i=0;i<state.listedItems.length;i++){
                if(state.listedItems[i].data.id==payload.id){
                    state.listedItems[i].added=!state.listedItems[i].added;
                    // console.log(payload.id+" "+state.listedItems[i].added);
                    break;
                }
            }
        }

    }
});

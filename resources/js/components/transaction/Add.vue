<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Transaction</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <select class="form-control" v-model="transa.type">
                                        <option value="Credit">Credit</option>
                                        <option value="Debit">Debit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" min="1" class="form-control" v-model="transa.amount">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" v-model="transa.description"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <router-link :to='{name:"transactions"}' class="btn btn-default">Back</router-link>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <br>
                            <span  v-show="isShowing">
                                <div class="col-12 alert alert-warning" role="alert">
                               {{message}}
                               </div>
                            </span>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-transation",
    data(){
        return {
            message:{},
            transa:{
                type:"",
                amount:null,
                description:""
            },
            isShowing:false,
        }
    },
    methods:{
        async create(){
            
            await this.axios.post('/api/transaction',this.transa).then(response=>{
                
                if(response.data.status == "success"){
                    this.$router.push({name:"transactions"});
                }else{
                    this.message = response.data.message;
                    //console.log(response.data.status,response.data.message);
                    this.isShowing = true;
                
                }
                
            }).catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>
<template>
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="col-10 text-start float-start">Transaction</h4>
                    <div class="col-2 text-end float-end">
                        <!--button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Transactions</button-->
                        <router-link :to='{name:"transactionsAdd"}' class="btn btn-primary">+ Transactions</router-link>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Running Balance</th>
                                </tr>
                            </thead>
                            <tbody v-if="transactions.length > 0">
                                <tr v-for="(transaction,key) in transactions" :key="key">
                                    <td>{{ transaction.id }}</td>
                                    <td>{{ transaction.date }}</td>
                                    <td>{{ transaction.description }}</td>
                                    <td v-if="transaction.credit != null">{{ transaction.credit }}</td><td v-else > - </td>
                                    <td v-if="transaction.debit != null">{{ transaction.debit }}</td><td v-else > - </td>
                                    <td>{{ transaction.runningBalance }}</td>
                                    
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Transction Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"transactions",
    data(){
        return {
            transactions:[]
        }
    },
    mounted(){
        this.getTransactions()
    },
    methods:{
        async getTransactions(){
            await this.axios.get('/api/transaction').then(response=>{
                this.transactions = response.data
            }).catch(error=>{
                console.log(error)
                this.transactions = []
            })
        }
    }
}
</script>
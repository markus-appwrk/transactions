
const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const transactions = () => import('./components/transaction/List.vue')
const transactionsAdd = () => import('./components/transaction/add.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'transactions',
        path: '/transactions',
        component: transactions
    },
    {
        name: 'transactionsAdd',
        path: '/transactions/add',
        component: transactionsAdd
    }
]
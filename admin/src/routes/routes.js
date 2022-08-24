import CurrencyPairsList from '../components/CurrencyPairsList';
import AddCurrencyPair from '../components/AddCurrencyPair';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'CurrencyPairsList',
        path: '/',
        component: CurrencyPairsList
    },
    {
        name: 'AddCurrencyPair',
        path: '/add_currency_pair',
        component: AddCurrencyPair
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
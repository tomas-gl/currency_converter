import CurrencyPairsList from '../components/administration/CurrencyPairsList';
import AddCurrencyPair from '../components/administration/AddCurrencyPair';
import EditCurrencyPair from '../components/administration/EditCurrencyPair';
import AddCurrency from '../components/administration/AddCurrency';
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
    },
    {
        name: 'EditCurrencyPair',
        path: '/currency_pair/edit/:id?',
        component: EditCurrencyPair
    },
    {
        name: 'AddCurrency',
        path: '/add_currency',
        component: AddCurrency
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
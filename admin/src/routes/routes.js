import CurrencyPairsList from '../components/administration/CurrencyPairsList';
import AddCurrencyPair from '../components/administration/AddCurrencyPair';
import EditCurrencyPair from '../components/administration/EditCurrencyPair';
import AddCurrency from '../components/administration/AddCurrency';
import Home from '../components/api/Home';
import Status from '../components/api/Status';
import CurrencyPairsAvailable from '../components/api/CurrencyPairsAvailable';
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
    {
        name: 'ApiHome',
        path: '/api',
        component: Home,
    },
    {
        name: 'ApiCurrencyPairsAvailable',
        path: '/api/currency_pairs',
        component: CurrencyPairsAvailable,
    },
    {
        name: 'ApiStatus',
        path: '/api/status',
        component: Status,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
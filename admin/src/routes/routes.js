import CurrencyPairsList from '../components/administration/CurrencyPairsList';
import AddCurrencyPair from '../components/administration/AddCurrencyPair';
import EditCurrencyPair from '../components/administration/EditCurrencyPair';
import AddCurrency from '../components/administration/AddCurrency';
import Api from '../components/api/Api';
import ApiStatus from '../components/api/ApiStatus';
import ApiCurrencyPairs from '../components/api/ApiCurrencyPairs';
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
        name: 'Api',
        path: '/api',
        component: Api,
    },
    {
        name: 'ApiCurrencyPairs',
        path: '/api/currency_pairs',
        component: ApiCurrencyPairs,
    },
    {
        name: 'ApiStatus',
        path: '/api/status',
        component: ApiStatus,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
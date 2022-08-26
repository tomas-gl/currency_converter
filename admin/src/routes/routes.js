import CurrencyPairsList from '../components/administration/CurrencyPairsList';
import AddCurrencyPair from '../components/administration/AddCurrencyPair';
import EditCurrencyPair from '../components/administration/EditCurrencyPair';
import AddCurrency from '../components/administration/AddCurrency';
import Home from '../components/api/Home';
import Status from '../components/api/Status';
import CurrencyPairsAvailable from '../components/api/CurrencyPairsAvailable';
// import NotFound from '../components/NotFound';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'AdminCurrencyPairsList',
        path: '/admin',
        component: CurrencyPairsList
    },
    {
        name: 'AdminAddCurrencyPair',
        path: '/admin/add_currency_pair',
        component: AddCurrencyPair
    },
    {
        name: 'AdminEditCurrencyPair',
        path: '/admin/currency_pair/edit/:id?',
        component: EditCurrencyPair
    },
    {
        name: 'AdminAddCurrency',
        path: '/admin/add_currency',
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
    },
    {
        path: '/:catchAll(.*)',
        redirect: "/admin",
      }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
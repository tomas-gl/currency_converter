import CurrencyPairsList from '../components/administration/CurrencyPairsList';
import AddCurrencyPair from '../components/administration/AddCurrencyPair';
import EditCurrencyPair from '../components/administration/EditCurrencyPair';
import AddCurrency from '../components/administration/AddCurrency';
import CurrencyPairsRequest from '../components/administration/CurrencyPairsRequest';

import Home from '../components/api/Home';
import Status from '../components/api/Status';
import CurrencyPairsSupported from '../components/api/CurrencyPairsSupported';
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
        name: 'CurrencyPairsRequest',
        path: '/admin/currency_pair_request',
        component: CurrencyPairsRequest
    },
    {
        name: 'ApiHome',
        path: '/api',
        component: Home,
    },
    {
        name: 'ApiCurrencyPairsSupported',
        path: '/api/currency_pairs',
        component: CurrencyPairsSupported,
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
    routes,
    linkActiveClass: "active-link",
    linkExactActiveClass: "exact-active-link",
})

export default router;
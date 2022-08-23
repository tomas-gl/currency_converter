import ConversionList from '../components/ConversionsList';
import AddConversion from '../components/AddConversion';
import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        name: 'ConversionsList',
        path: '/',
        component: ConversionList
    },
    {
        name: 'AddConversion',
        path: '/add_conversion',
        component: AddConversion
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;
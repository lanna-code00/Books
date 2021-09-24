import AllProduct from './components/myViews/AllProduct.vue';
import CreateProduct from './components/myViews/CreateProduct.vue';
import EditProduct from './components/myViews/EditProduct.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProduct
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditProduct
    }
];
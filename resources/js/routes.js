import AllProduct from './components/myViews/AllProduct.vue';
import CreateProduct from './components/myViews/CreateProduct.vue';
import EditProduct from './components/myViews/EditProduct.vue';
import ShowBook from './components/myViews/ShowBook.vue';
 
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
        name: 'show',
        path: '/show',
        component: ShowBook
    },
    {
        name: 'edit',
        path: '/edit',
        component: EditProduct
    }
];
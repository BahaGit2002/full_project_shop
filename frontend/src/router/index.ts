import {createRouter, createWebHistory} from 'vue-router'
import HomePage from "../views/HomePage.vue";
import OrderPage from "../views/OrderPage.vue";
import SalePage from "../views/SalePage.vue";
import NewItemsPage from "../views/NewItemsPage.vue";
import ProductDetailPage from "../views/ProductDetailPage.vue";
import SignUpPage from "../views/SignUpPage.vue";
import SignInPage from "../views/SignInPage.vue";
import FavoritePage from "../views/FavoritePage.vue";

const routes = [
    {path: '/', component: HomePage},
    {path: '/order', component: OrderPage},
    {path: '/sale', component: SalePage},
    {path: '/new-items', component: NewItemsPage},
    {path: '/product/:id', component: ProductDetailPage},
    {path: '/sign-up', component: SignUpPage},
    {path: '/sign-in', component: SignInPage},
    {path: '/favorite', component: FavoritePage},
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
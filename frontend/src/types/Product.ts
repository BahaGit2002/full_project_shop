import {Category} from "./Category.ts";
import {Price} from "./Price.ts";

export interface Product {
    id: string;
    name: string;
    price?: number;
    regular_price?: number;
    discount_price?: number;
    image: string;
    rating?: number;
    is_favorited?: boolean;
}

export interface ProductDetail extends Product {
    brand: string;
    country: string;
    packaging: string;
    category: Category;
    price_obj: Price;
}


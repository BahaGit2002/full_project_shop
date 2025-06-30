import {apiClient, API_URL} from './index.ts';

export const getProductsSale = () => apiClient.get(`${API_URL}/products/sale`);
export const getProducts = () => apiClient.get(`${API_URL}/products`);
export const getProductDetails = (id: string) => apiClient.get(`${API_URL}/products/${id}`);

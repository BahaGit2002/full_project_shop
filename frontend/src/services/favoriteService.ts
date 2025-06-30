import {apiClient, API_URL} from "./index.ts";

export const addToFavorites = async (data: unknown) => {
    try {
        const response = await apiClient.post(`${API_URL}/favorites`, data);
        return response.data;
    } catch (error) {
        console.error('Failed to add to favorites:', error);
        throw error;
    }
};
export const removeFromFavorites = async (productId: string) =>
    apiClient.delete(`${API_URL}/favorites/${productId}`);

export const getFavorites = async () => {
    try {
        const response = await apiClient.get(`${API_URL}/favorites`);
        return response.data.data;
    } catch (error) {
        console.error('Failed to get favorites:', error);
    }
};

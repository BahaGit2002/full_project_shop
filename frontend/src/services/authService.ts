import {apiClient, API_URL} from './index.ts';

export const register = (data: unknown) =>
    apiClient.post(`${API_URL}/auth/register`, data);
export const login = (data: unknown) =>
    apiClient.post(`${API_URL}/auth/login`, data);

import axios, { AxiosInstance, AxiosRequestConfig } from 'axios';
import { getCookie } from './cookies';

export const API_URL = 'http://localhost:8000/api';

const createApiClient = (): AxiosInstance => {
    const client = axios.create({
        baseURL: API_URL,
        headers: {
            'Content-Type': 'application/json',
        },
    });

    client.interceptors.request.use((config: AxiosRequestConfig) => {
        const token = getCookie('auth_token');
        if (token) {
            config.headers = config.headers || {};
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    });

    return client;
};

export const apiClient = createApiClient();
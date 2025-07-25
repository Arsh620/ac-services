/**
 * API Service for AC Service Booking
 */

import axios from 'axios';

// Configure axios for API requests
const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    }
});

// Add token to requests if available
api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
});

// Authentication APIs
export const auth = {
    login: async (email, password) => {
        const response = await api.post('/login', { email, password });
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
            console.log('Token generated and stored:', response.data.token.substring(0, 20) + '...');
        }
        return response.data;
    },
    
    hasToken: () => {
        const token = localStorage.getItem('token');
        return !!token;
    },

    register: async (userData) => {
        const response = await api.post('/register', userData);
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
            console.log('Token generated and stored:', response.data.token.substring(0, 20) + '...');
        }
        return response.data;
    },

    logout: async () => {
        await api.post('/logout');
        localStorage.removeItem('token');
    },

    getUser: async () => {
        return api.get('/user');
    }
};

// Booking APIs
export const bookings = {
    getAll: async () => {
        return api.get('/bookings');
    },

    create: async (bookingData) => {
        return api.post('/bookings', bookingData);
    },

    getOne: async (id) => {
        return api.get(`/bookings/${id}`);
    }
};

// Admin APIs
export const admin = {
    getDashboard: async () => {
        return api.get('/admin/dashboard');
    },

    getBookings: async () => {
        return api.get('/admin/bookings');
    },

    updateBookingStatus: async (id, status) => {
        return api.patch(`/admin/bookings/${id}/status`, { status });
    },

    getUsers: async () => {
        return api.get('/admin/users');
    }
};

export default { auth, bookings, admin };
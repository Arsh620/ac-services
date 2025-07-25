import './bootstrap';
import api from './api';
import { checkTokenStatus } from './token-checker';

// Make API available globally
window.api = api;

// Log token status on page load
document.addEventListener('DOMContentLoaded', () => {
    console.log('Checking token status...');
    if (api.auth.hasToken()) {
        console.log('Token exists in localStorage');
    } else {
        console.log('No token found in localStorage');
    }
    
    // Make token checker available globally
    window.checkTokenStatus = checkTokenStatus;
});

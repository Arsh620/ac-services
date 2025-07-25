/**
 * Token checker utility
 */

// Function to check token status
export function checkTokenStatus() {
    const token = localStorage.getItem('token');
    
    if (token) {
        console.log('✅ Token exists:', token.substring(0, 20) + '...');
        
        // Check if token is valid by making a test request
        window.api.auth.getUser()
            .then(response => {
                console.log('✅ Token is valid. User:', response.data);
            })
            .catch(error => {
                console.error('❌ Token is invalid or expired:', error);
            });
    } else {
        console.log('❌ No token found in localStorage');
    }
}

// Make the function available globally
window.checkTokenStatus = checkTokenStatus;

export default checkTokenStatus;
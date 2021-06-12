
export default function authHeader() {
    let user = localStorage.getItem('user');
    let token = localStorage.getItem('token');

    if (user && token) {
        return { Authorization: `Bearer ${token}` };
        // return { 'x-access-token': token };
    } else {
        return {};
    }
}

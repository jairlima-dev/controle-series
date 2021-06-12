import axios from "axios";

const http = axios.create({
    headers: {
    }
})

http.interceptors.request.use(function (config) {
    const token = localStorage.getItem('auth')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
        // config.headers.x-access.token = token
    }
    return config
}, function (error) {;
    return Promise.reject(error)
})

export default http



import http from "../http";

export default  {

    login(data) {
        return http.post('/api/login', data)
    },

    logout() {
        return http.post('api/logout')
    },

}

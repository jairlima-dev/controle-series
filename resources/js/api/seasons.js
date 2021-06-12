import http from "../http";

export default {

    all(id) {
        return http.get(`/api/seasons/${id}`)
    },

    create(data) {
        return http.post('/api/seasons', data)
    }

}


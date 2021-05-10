import axios from "axios";

export default {

    all(id) {
        return axios.get(`/api/serie/${id}`)
    },

    create(data) {
        return axios.post('/api/seasons', data)
    }

}


import axios from "axios";

export default {

    all(id) {
        return axios.get(`/api/season/${id}`)
    }

}

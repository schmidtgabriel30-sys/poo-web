import { defineBoot } from '#q-app';
import axios from 'axios'
import { Notify } from 'quasar'

const getToken = () => {
    return '5|t43ZxLSpsxYvPxhuk7lxoBj4PRVaBj1tWfUTohfV89c32d8d';
}

const api = axios.create({ baseURL: import.meta.env.QCLI_API_URL })

api.interceptors.request.use((config) => {
    const token = getToken()
    if (token && token.length > 10) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
}, (error) => Promise.reject(error));

api.interceptors.response.use((response) => response, (error) => {
    const { code } = error?.response?.data ?? {}

    if (code) {
        Notify.create({
            message: code,
            type: 'negative',
        })
    }

    return Promise.reject(error)
})

export default defineBoot(({ app }) => {
    app.config.globalProperties.$axios = axios
    app.config.globalProperties.$api = api
})

export { api }
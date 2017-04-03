import axios from 'axios'
import { Message } from 'element-ui'

export default function(Vue) {
    const instance = new axios.create()
    instance.interceptors.response.use( r => r, error => {
        if (error.response) {
            switch (error.response.status) {
                case 401:
                    Message.error("尚未登录，正在跳转")
                    window.location.href = '/login'
                    break
                case 500:
                    Message.error("服务器异常，请稍后重试")
                    return Promise.reject(error)                    
            }
        }
    })
    Vue.prototype.$http = instance
}
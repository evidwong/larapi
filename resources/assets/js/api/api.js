import axios from 'axios';

let base = 'http://larapi.test';

export const requestLogin = params => { return axios.post(`${base}/login`, params).then(res => res.data); };
export const getMerchants = params => { return axios.post(`${base}/getMerchants`, params).then(res => res.data); };
export const createMerchants = params => { return axios.post(`${base}/createMerchants`, params).then(res => res.data); };
export const deleteMerchants = params => { return axios.post(`${base}/deleteMerchants`, params).then(res => res.data); };
export const delayMerchants = params => { return axios.post(`${base}/delayMerchants`, params).then(res => res.data); };
export const getBaseInfo = params => { return axios.post(`${base}/getBaseInfo`, params).then(res => res.data); };
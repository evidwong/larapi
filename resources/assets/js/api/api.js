import axios from 'axios';

let base = 'http://larapi.test';

export const requestLogin = params => { return axios.post(`${base}/login`, params).then(res => res.data); };
export const getMerchants = params => { return axios.post(`${base}/getMerchants`, params).then(res => res.data); };
export const createMerchants = params => { return axios.post(`${base}/createMerchants`, params).then(res => res.data); };
export const deleteMerchants = params => { return axios.post(`${base}/deleteMerchants`, params).then(res => res.data); };
export const delayMerchants = params => { return axios.post(`${base}/delayMerchants`, params).then(res => res.data); };

export const getBaseInfos = params => { return axios.post(`${base}/getBaseInfos`, params).then(res => res.data); };
export const createBaseInfo = params => { return axios.post(`${base}/createBaseInfo`, params).then(res => res.data); };
export const deleteBaseInfo = params => { return axios.post(`${base}/deleteBaseInfo`, params).then(res => res.data); };

export const getBrands = params => { return axios.post(`${base}/getBrands`, params).then(res => res.data); };
export const getBrandConfigs = params => { return axios.post(`${base}/getBrandConfigs`, params).then(res => res.data); };

export const createBrandConfig = params => { return axios.post(`${base}/createBrandConfig`, params).then(res => res.data); };
export const deleteBrandConfig = params => { return axios.post(`${base}/deleteBrandConfig`, params).then(res => res.data); };

export const getVinConfigs = params => { return axios.post(`${base}/getVinConfigs`, params).then(res => res.data); };
export const createVinConfig = params => { return axios.post(`${base}/createVinConfig`, params).then(res => res.data); };
export const deleteVinConfig = params => { return axios.post(`${base}/deleteVinConfig`, params).then(res => res.data); };
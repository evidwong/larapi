import axios from 'axios';

let base = 'http://larapi.test';

export const requestLogin = params => { return axios.post(`${base}/api/login`, params).then(res => res.data); };
export const getMerchants = params => { return axios.post(`${base}/api/getMerchants`, params).then(res => res.data); };
export const createMerchants = params => { return axios.post(`${base}/api/createMerchants`, params).then(res => res.data); };
export const deleteMerchants = params => { return axios.post(`${base}/api/deleteMerchants`, params).then(res => res.data); };
export const delayMerchants = params => { return axios.post(`${base}/api/delayMerchants`, params).then(res => res.data); };

export const getBaseInfos = params => { return axios.post(`${base}/api/getBaseInfos`, params).then(res => res.data); };
export const createBaseInfo = params => { return axios.post(`${base}/api/createBaseInfo`, params).then(res => res.data); };
export const deleteBaseInfo = params => { return axios.post(`${base}/api/deleteBaseInfo`, params).then(res => res.data); };

export const getBrands = params => { return axios.post(`${base}/api/getBrands`, params).then(res => res.data); };
export const getBrandConfigs = params => { return axios.post(`${base}/api/getBrandConfigs`, params).then(res => res.data); };

export const createBrandConfig = params => { return axios.post(`${base}/api/createBrandConfig`, params).then(res => res.data); };
export const deleteBrandConfig = params => { return axios.post(`${base}/api/deleteBrandConfig`, params).then(res => res.data); };

export const getVinConfigs = params => { return axios.post(`${base}/api/getVinConfigs`, params).then(res => res.data); };
export const createVinConfig = params => { return axios.post(`${base}/api/createVinConfig`, params).then(res => res.data); };
export const deleteVinConfig = params => { return axios.post(`${base}/api/deleteVinConfig`, params).then(res => res.data); };

export const getNodes = params => { return axios.post(`${base}/api/getNodes`, params).then(res => res.data); };
export const createNode = params => { return axios.post(`${base}/api/createNode`, params).then(res => res.data); };
export const deleteNode = params => { return axios.post(`${base}/api/deleteNode`, params).then(res => res.data); };

export const getRoles = params => { return axios.post(`${base}/api/getRoles`, params).then(res => res.data); };
export const createRole = params => { return axios.post(`${base}/api/createRole`, params).then(res => res.data); };
export const deleteRole = params => { return axios.post(`${base}/api/deleteRole`, params).then(res => res.data); };

export const getUsers = params => { return axios.post(`${base}/api/getUsers`, params).then(res => res.data); };
export const createUser = params => { return axios.post(`${base}/api/createUser`, params).then(res => res.data); };
export const deleteUser = params => { return axios.post(`${base}/api/deleteUser`, params).then(res => res.data); };
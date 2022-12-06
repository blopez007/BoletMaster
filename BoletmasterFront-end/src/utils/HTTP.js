import axios from 'axios';

const baseURl = 'http://127.0.0.1:8000/api';

const HTTP = axios.create({
  baseURL: baseURl,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

HTTP.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default HTTP;
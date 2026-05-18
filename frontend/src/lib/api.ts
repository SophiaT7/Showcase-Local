import axios from 'axios'

const baseURL = process.env.NEXT_PUBLIC_API_URL
if (!baseURL) {
  throw new Error('NEXT_PUBLIC_API_URL não definida. Configure em frontend/.env.local (ou env do deploy).')
}

const api = axios.create({
  baseURL,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
})

export default api

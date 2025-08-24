// API Konfiguration
export const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:4000'

// API Endpoints
export const API_ENDPOINTS = {
  CONTACT: `${API_BASE_URL}/api/contact`,
  APPLY: `${API_BASE_URL}/api/apply`,
  SUBMIT_APPLICATION: `${API_BASE_URL}/api/submit-application`
}
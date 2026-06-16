import http from 'k6/http';

export const options = { vus: 50, duration: '60s',
    thresholds: { http_req_duration: ['p(95)<500'], http_req_failed: ['rate<0.01'], }, };
export default function () { const payload = JSON.stringify({ draw_count: 10 });
    const params = { headers: { 'Content-Type': 'application/json', }, };
    http.post( 'http://localhost/api/gacha/load-test', payload, params ); }

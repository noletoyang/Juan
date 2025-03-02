export const API_BASE_URL = 'https://ovent.cn/juan/api'

export const API_URLS = {
    DONATIONS: {
        LIST: `${API_BASE_URL}/donations/list.php`,
        CREATE: `${API_BASE_URL}/donations/create.php`,
        UPDATE: `${API_BASE_URL}/donations/update.php`,
        DELETE: `${API_BASE_URL}/donations/delete.php`,
        STATS: `${API_BASE_URL}/donations/stats.php`
    },
    VISITS: {
        RECORD: `${API_BASE_URL}/visits/record.php`,
        COUNT: `${API_BASE_URL}/visits/count.php`
    },
    PROXY: {
        HITOKOTO: `${API_BASE_URL}/proxy/hitokoto.php`
    }
} 
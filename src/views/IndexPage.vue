<template>
  <el-container class="app-container">
    <el-header class="gradient-header">
      <h1 class="page-title">杨乐乐开源项目捐赠记录</h1>
      <div class="header-stats">
        <div class="stat-item">
          <span class="stat-label">总捐赠</span>
          <span class="stat-value">¥{{ totalAmount }}</span>
        </div>
        <div class="stat-item">
          <span class="stat-label">捐赠次数</span>
          <span class="stat-value">{{ donations.length }}</span>
        </div>
        <div class="stat-item">
          <span class="stat-label">访问量</span>
          <span class="stat-value">{{ visitCount }}</span>
        </div>
      </div>
    </el-header>
    <el-main>
      <el-row :gutter="15">
        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8" class="system-info-col">
          <el-card class="system-info-card custom-card">
            <template #header>
              <div class="card-header">
                <span class="section-title">系统信息</span>
              </div>
            </template>
            <div class="system-info-content">
              <div class="info-grid">
                <div class="info-item">
                  <el-icon><Sunny /></el-icon>
                  <div class="info-detail">
                    <span class="info-label">天气</span>
                    <span class="info-value">{{ weather.temp }}°C {{ weather.text }}</span>
                    <span class="info-sub">{{ weather.city }}</span>
                </div>
                  </div>
                <div class="info-item">
                  <el-icon><Monitor /></el-icon>
                  <div class="info-detail">
                    <span class="info-label">访问IP</span>
                    <span class="info-value">{{ clientInfo.ip }}</span>
                    <span class="info-sub">{{ clientInfo.location }}</span>
                  </div>
                </div>
                <div class="info-item">
                  <el-icon><ChromeFilled /></el-icon>
                  <div class="info-detail">
                    <span class="info-label">浏览器</span>
                    <span class="info-value">{{ clientInfo.browser }}</span>
                    <span class="info-sub">{{ clientInfo.os }}</span>
                  </div>
                </div>
              </div>
            </div>
          </el-card>

          <el-card class="tech-stack-card custom-card">
            <template #header>
              <div class="card-header">
                <span class="section-title">本站使用技术栈</span>
              </div>
            </template>
            <div class="tech-stack-content">
              <div class="tech-group">
                <h4 class="tech-group-title">前端</h4>
                <div class="tech-item">
                  <img src="https://cn.vuejs.org/logo.svg" alt="Vue" />
                  <span>Vue 3</span>
                </div>
                <div class="tech-item">
                  <img src="https://element-plus.org/images/element-plus-logo.svg" alt="Element Plus" />
                  <span>Element Plus</span>
                </div>
                <div class="tech-item">
                  <img src="https://echarts.apache.org/en/images/logo.png" alt="ECharts" />
                  <span>ECharts</span>
                </div>
                <div class="tech-item">
                  <img src="https://vitejs.dev/logo.svg" alt="Vite" />
                  <span>Vite</span>
                </div>
              </div>
              <div class="tech-group">
                <h4 class="tech-group-title">后端</h4>
                <div class="tech-item">
                  <img src="https://www.php.net/images/logos/new-php-logo.svg" alt="PHP" />
                  <span>PHP</span>
                </div>
                <div class="tech-item">
                  <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" alt="MySQL" />
                  <span>MySQL</span>
                </div>
                <div class="tech-item">
                  <img src="https://nginx.org/nginx.png" alt="Nginx" />
                  <span>Nginx</span>
                </div>
              </div>
            </div>
          </el-card>
        </el-col>
        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8" class="chart-col">
          <el-card class="statistics-card custom-card">
            <template #header>
              <div class="card-header">
                <span class="section-title">捐赠统计</span>
              </div>
            </template>
            <div class="statistics-content">
              <div class="stats-grid">
                <div class="stat-box">
                  <div class="stat-info">
                    <span class="stat-label">总捐赠</span>
                    <span class="stat-value">¥{{ totalAmount }}</span>
              </div>
                </div>
                <div class="stat-box">
                  <div class="stat-info">
                    <span class="stat-label">最大单笔</span>
                    <span class="stat-value">¥{{ maxDonation }}</span>
                  </div>
                </div>
                <div class="stat-box">
                  <div class="stat-info">
                    <span class="stat-label">平均金额</span>
                    <span class="stat-value">¥{{ averageDonation }}</span>
                  </div>
                </div>
                <div class="stat-box">
                  <div class="stat-info">
                    <span class="stat-label">本月捐赠</span>
                    <span class="stat-value">¥{{ monthlyDonation }}</span>
                  </div>
                </div>
              </div>
            </div>
          </el-card>

          <el-card class="chart-card custom-card">
            <template #header>
              <div class="card-header">
                <span class="section-title">捐赠趋势</span>
              </div>
            </template>
            <div id="donationChart" class="chart-container"></div>
          </el-card>

          <el-card class="author-card custom-card">
            <template #header>
              <div class="card-header">
                <span class="section-title">关于作者</span>
              </div>
            </template>
            <div class="author-content">
              <div class="author-bg"></div>
              <div class="author-info">
                <div class="author-avatar">
                  <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23409EFF' d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E" alt="作者头像" />
                </div>
                <h3 class="author-name">杨乐乐</h3>
                <p class="author-quote" v-if="quote">{{ quote }}</p>
                <div class="author-links">
                  <a href="https://github.com/noletoyang" target="_blank" title="GitHub">
                    <el-button type="primary" circle>
                      <el-icon><Position /></el-icon>
                    </el-button>
                  </a>
                  <a href="mailto:noleit@icloud.com" title="Email">
                    <el-button type="primary" circle>
                      <el-icon><Message /></el-icon>
                    </el-button>
                  </a>
                  <a href="https://ovent.cn" target="_blank" title="个人网站">
                    <el-button type="primary" circle>
                      <el-icon><Link /></el-icon>
                    </el-button>
                  </a>
                </div>
              </div>
            </div>
          </el-card>
        </el-col>
        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8" class="donation-list-col">
          <el-card class="donation-list custom-card" :body-style="{ padding: '0' }">
            <template #header>
              <div class="card-header">
                <span class="section-title">捐赠记录列表</span>
                <div class="list-filter">
                  <el-date-picker
                    v-model="dateRange"
                    type="daterange"
                    range-separator="至"
                    start-placeholder="开始日期"
                    end-placeholder="结束日期"
                    :shortcuts="dateShortcuts"
                    @change="handleDateChange"
                    size="small"
                    style="width: 240px"
                  />
                </div>
              </div>
            </template>
            <div class="waterfall-container">
              <div v-for="(item, index) in filteredDonations" 
                   :key="index" 
                   class="donation-card"
                   :style="{ animationDelay: `${index * 0.1}s` }">
                <div class="donation-header">
                  <span class="donation-date">
                    <el-icon><Calendar /></el-icon>
                    {{ item.date }}
                  </span>
                  <span class="donation-amount">¥{{ item.amount }}</span>
                </div>
                <div class="donation-content">
                  <h3 class="donation-project">
                    <el-icon><Collection /></el-icon>
                    {{ item.project }}
                  </h3>
                  <div class="donation-info">
                    <span class="donation-name">
                      <el-icon><User /></el-icon>
                      {{ item.name }}
                    </span>
                    <p class="donation-comment">{{ item.comment }}</p>
                  </div>
                </div>
              </div>
              <div v-if="filteredDonations.length === 0" class="empty-state">
                <el-empty description="暂无捐赠记录" />
              </div>
            </div>
          </el-card>
        </el-col>
      </el-row>
    </el-main>
    <el-footer class="app-footer">
      <p>© 2025 杨乐乐开源项目捐赠记录 | 系统运行时间: {{ uptime }}</p>
    </el-footer>
  </el-container>
</template>

<script>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import * as echarts from 'echarts'
import { 
  Calendar, User, Collection,
  Position, Message, Link,
  Sunny, Monitor, ChromeFilled
} from '@element-plus/icons-vue'
import { ElNotification, ElMessage } from 'element-plus'
import { API_URLS } from '../config/api'

export default {
  name: 'IndexPage',
  components: {
    Calendar,
    User,
    Collection,
    Position,
    Message,
    Link,
    Sunny,
    Monitor,
    ChromeFilled
  },
  setup() {
    const donations = ref([])
    const totalAmount = ref(0)
    const visitCount = ref(0)
    const maxDonation = ref(0)
    const averageDonation = ref(0)
    const monthlyDonation = ref(0)
    const growthRate = ref(0)
    const uptime = ref('')
    const quote = ref('')

    const weather = ref({
      temp: '--',
      text: '加载中...',
      city: '定位中...'
    })

    const clientInfo = ref({
      ip: '加载中...',
      location: '--',
      browser: '加载中...',
      os: '--'
    })

    const dateRange = ref([])
    
    // 日期快捷选项
    const dateShortcuts = [
      {
        text: '最近一周',
        value: () => {
          const end = new Date()
          const start = new Date()
          start.setTime(start.getTime() - 3600 * 1000 * 24 * 7)
          return [start, end]
        }
      },
      {
        text: '最近一月',
        value: () => {
          const end = new Date()
          const start = new Date()
          start.setMonth(start.getMonth() - 1)
          return [start, end]
        }
      },
      {
        text: '最近三月',
        value: () => {
          const end = new Date()
          const start = new Date()
          start.setMonth(start.getMonth() - 3)
          return [start, end]
        }
      }
    ]
    
    // 根据日期范围过滤捐赠记录
    const filteredDonations = computed(() => {
      if (!dateRange.value || !dateRange.value.length) {
        return donations.value
      }
      
      const [start, end] = dateRange.value
      return donations.value.filter(donation => {
        const donationDate = new Date(donation.date)
        return donationDate >= start && donationDate <= end
      })
    })
    
    // 处理日期变化
    const handleDateChange = (val) => {
      dateRange.value = val
    }

    // 添加一个 ref 来存储统计数据
    const statsData = ref({
      total: 0,
      count: 0,
      max: 0,
      monthly: 0,
      daily: []
    })

    // 定义图表重置大小的处理函数
    const resizeHandler = ref(null)

    const loadDonations = async () => {
      try {
        console.log('Fetching from:', API_URLS.DONATIONS.LIST)
        
        const fetchWithRetry = async (url, options, retries = 3) => {
          for (let i = 0; i < retries; i++) {
            try {
              const response = await fetch(url, options)
              console.log('Response status:', response.status)
              
              if (!response.ok) {
                const errorText = await response.text()
                console.error('Error response:', errorText)
                throw new Error(`HTTP error! status: ${response.status}`)
              }
              
              return response
            } catch (error) {
              console.error(`Attempt ${i + 1} failed:`, error)
              if (i === retries - 1) throw error
              await new Promise(resolve => setTimeout(resolve, 1000 * (i + 1)))
            }
          }
        }

        const listResponse = await fetchWithRetry(API_URLS.DONATIONS.LIST, {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          mode: 'cors',
          credentials: 'omit'
        })

        const listData = await listResponse.json()
        console.log('Received data:', listData)
        
        if (listData.success) {
          donations.value = listData.data
        } else {
          throw new Error(listData.data.message || '获取数据失败')
        }

        // 获取统计数据
        const statsResponse = await fetch(API_URLS.DONATIONS.STATS)
        const statsResult = await statsResponse.json()
        
        if (statsResult.success) {
          statsData.value = statsResult.data
          totalAmount.value = statsResult.data.total
          maxDonation.value = statsResult.data.max
          monthlyDonation.value = statsResult.data.monthly
          
          // 计算平均捐赠金额
          if (statsResult.data.count > 0) {
            averageDonation.value = (parseFloat(statsResult.data.total) / parseFloat(statsResult.data.count)).toFixed(2)
          } else {
            averageDonation.value = '0.00'
          }
          
          // 更新图表
          updateChart()
        }
      } catch (error) {
        console.error('获取捐赠数据失败:', error)
        ElMessage.error('获取捐赠数据失败，请稍后重试')
      }
    }

    const updateChart = () => {
      const chartDom = document.getElementById('donationChart')
      echarts.dispose(chartDom)
      const myChart = echarts.init(chartDom)

      // 处理捐赠数据
      const processData = () => {
        console.log('Processing chart data with statsData:', statsData.value)
        // 获取最近7天的日期
        const dates = []
        const amounts = []
        const today = new Date()
        today.setHours(23, 59, 59, 999)  // 设置为今天的最后一刻
        
        // 获取最近7天的日期列表
        for (let i = 6; i >= 0; i--) {
          const date = new Date(today)
          date.setDate(date.getDate() - i)
          dates.push(date.toISOString().split('T')[0])
        }
        console.log('Generated dates:', dates)

        // 使用后端返回的每日统计数据
        const dailyStats = statsData.value?.daily || []
        console.log('Daily stats:', dailyStats)
        const statsMap = new Map(
          dailyStats.map(stat => [
            stat.date.split(' ')[0],  // 只取日期部分
            parseFloat(stat.total_amount)
          ])
        )
        console.log('Stats map:', Object.fromEntries(statsMap))
        
        // 填充金额数据，没有数据的日期填充0
        amounts.push(...dates.map(date => statsMap.get(date) || 0))
        console.log('Final amounts:', amounts)
        
        return { dates, amounts }
      }

      const { dates, amounts } = processData()
      console.log('Chart data:', { dates, amounts })

      const option = {
        title: {
          text: '近期捐赠趋势',
          textStyle: {
            fontSize: 14,
            fontWeight: 'normal'
          }
        },
        tooltip: {
          trigger: 'axis',
          formatter: function(params) {
            const data = params[0]
            return `${data.name}<br/>捐赠金额: ¥${data.value.toLocaleString('zh-CN', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            })}`
          }
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        xAxis: {
          type: 'category',
          data: dates.map(date => {
            const [, month, day] = date.split('-')
            return `${month}-${day}`
          }),
          axisLabel: {
            rotate: 45,
            interval: 0,
            fontSize: 12
          }
        },
        yAxis: {
          type: 'value',
          axisLabel: {
            formatter: function(value) {
              return '¥' + value.toLocaleString('zh-CN')
            }
          },
          splitLine: {
            show: true,
            lineStyle: {
              type: 'dashed'
            }
          }
        },
        series: [
          {
            data: amounts,
            type: 'line',
            smooth: true,
            symbolSize: 8,
            lineStyle: {
              width: 3
            },
            areaStyle: {
              opacity: 0.2,
              color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                {
                  offset: 0,
                  color: 'rgba(64, 158, 255, 0.5)'
                },
                {
                  offset: 1,
                  color: 'rgba(64, 158, 255, 0.1)'
                }
              ])
            },
            itemStyle: {
              color: '#409EFF'
            }
          }
        ]
      }

      myChart.setOption(option)
      
      // 更新 resize 处理函数
      if (resizeHandler.value) {
        window.removeEventListener('resize', resizeHandler.value)
      }
      resizeHandler.value = () => myChart.resize()
      window.addEventListener('resize', resizeHandler.value)
    }

    const updateVisitCount = async () => {
      try {
        // 记录访问
        const recordResponse = await fetch(API_URLS.VISITS.RECORD, {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          }
        })
        
        if (!recordResponse.ok) {
          throw new Error('记录访问失败')
        }
        
        // 获取访问统计
        const response = await fetch(API_URLS.VISITS.COUNT, {
          method: 'GET',
          headers: {
            'Accept': 'application/json'
          }
        })
        
        if (!response.ok) {
          throw new Error('获取访问统计失败')
        }
        
        const data = await response.json()
        
        if (data.success) {
          visitCount.value = data.data.visits
        }
      } catch (error) {
        console.error('获取访问统计失败:', error)
        // 如果获取失败，尝试从本地存储获取上次的访问量
        visitCount.value = parseInt(localStorage.getItem('visitCount') || '0')
      }
    }

    const updateUptime = () => {
      const startTime = localStorage.getItem('systemStartTime') || new Date().toISOString()
      if (!localStorage.getItem('systemStartTime')) {
        localStorage.setItem('systemStartTime', startTime)
      }
      
      const timeDiff = new Date() - new Date(startTime)
      const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24))
      const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
      uptime.value = `${days}天${hours}小时`
    }

    const getWeather = async () => {
      try {
        const response = await fetch('https://wttr.in/?format=j1')
        const data = await response.json()
        
        if (data) {
          weather.value = {
            temp: data.current_condition[0].temp_C,
            text: data.current_condition[0].lang_zh[0].value, // 中文天气描述
            city: data.nearest_area[0].areaName[0].value
          }
        }
      } catch (error) {
        console.error('获取天气信息失败:', error)
        weather.value = {
          temp: '--',
          text: '获取失败',
          city: '未知'
        }
      }
    }

    // 获取随机名言
    const getRandomQuote = async () => {
      try {
        const response = await fetch(API_URLS.PROXY.HITOKOTO)
        const data = await response.json()
        quote.value = data.data.hitokoto
      } catch (error) {
        console.error('获取名言失败:', error)
        quote.value = '用代码改变世界'
      }
    }

    // 添加欢迎通知函数
    const showWelcomeNotification = (location) => {
      const hour = new Date().getHours()
      let greeting = ''
      let message = ''

      if (hour < 6) {
        greeting = '深夜好'
        message = `欢迎${location}的夜归人。深夜虽静，但请适时休息，健康永远比工作更重要。`
      } else if (hour < 9) {
        greeting = '早上好'
        message = `欢迎来自${location}的朋友。晨光熹微，新的一天正待书写，愿你带着希望启程。`
      } else if (hour < 12) {
        greeting = '上午好'
        message = `欢迎${location}的朋友莅临。上午是一天中最富活力的时光，愿我们共同以饱满的热情开启今天的征程。`
      } else if (hour < 14) {
        greeting = '中午好'
        message = `欢迎${location}的朋友。阳光正好，万物生长，不妨稍作休息，让身心在午后得到片刻宁静。`
      } else if (hour < 17) {
        greeting = '下午好'
        message = `欢迎来自${location}的朋友。下午茶时光，愿这份温暖与芬芳，能为您的一天增添一抹惬意。`
      } else if (hour < 19) {
        greeting = '傍晚好'
        message = `欢迎${location}的朋友。夕阳西下，愿这温柔的晚霞，能让您在忙碌一天后感受生活的美好。`
      } else if (hour < 22) {
        greeting = '晚上好'
        message = `欢迎${location}的朋友。华灯初上，让我们在这静谧的夜晚，共同探讨技术，分享知识。`
      } else {
        greeting = '夜深了'
        message = `欢迎${location}的夜行者。已是深夜，愿您在追求技术的路上，也能好好关照自己，记得按时休息。`
      }

      ElNotification({
        title: greeting,
        message: message,
        type: 'success',
        duration: 4500,  // 增加显示时间，让用户能完整阅读
        customClass: 'welcome-notification'
      })
    }

    // 获取客户端信息
    const getClientInfo = async () => {
      try {
        const response = await fetch('https://ipapi.co/json/')
        const data = await response.json()
        
        if (data) {
          // 处理地区显示
          let location = ''
          // 判断是否是中国IP
          if (data.country === 'CN') {
            if (data.region) {
              // 移除"省"、"自治区"等后缀
              location = data.region
                .replace('省', '')
                .replace('自治区', '')
                .replace('维吾尔', '')
                .replace('回族', '')
                .replace('壮族', '')
            }
          } else {
            // 国外IP显示国家名称
            location = data.country_name || data.country
          }

          clientInfo.value = {
            ip: data.ip,
            location: location || '未知位置',
            browser: navigator.userAgent.split(' ').slice(-1)[0],
            os: navigator.platform
          }
          // 显示欢迎通知
          showWelcomeNotification(location || '未知位置')
        } else {
          throw new Error('获取地理位置失败')
        }
      } catch (error) {
        console.error('获取客户端信息失败:', error)
        clientInfo.value = {
          ip: '获取失败',
          location: '未知位置',
          browser: navigator.userAgent.split(' ').slice(-1)[0],
          os: '未知系统'
        }
        // 即使获取位置失败也显示通知
        showWelcomeNotification('未知位置')
      }
    }

    // 添加重试机制
    const retryGetClientInfo = async (retries = 3) => {
      for (let i = 0; i < retries; i++) {
        try {
          await getClientInfo()
          break
        } catch (error) {
          if (i === retries - 1) {
            console.error('获取客户端信息最终失败')
          } else {
            await new Promise(resolve => setTimeout(resolve, 2000)) // 等待2秒后重试
          }
        }
      }
    }

    // 添加更新状态栏颜色的函数
    const updateStatusBarColor = () => {
      const metaThemeColor = document.querySelector('meta[name="theme-color"]')
      if (metaThemeColor) {
        metaThemeColor.setAttribute('content', '#409EFF')
      }
    }

    onMounted(() => {
      loadDonations()
      updateChart()
      updateVisitCount()
      updateUptime()
      getWeather()
      getRandomQuote()
      retryGetClientInfo()
      
      // 定时更新数据
      setInterval(() => {
        loadDonations()
        updateVisitCount()
      }, 1000 * 60 * 5) // 每5分钟更新一次
      
      // 定时更新运行时间
      setInterval(updateUptime, 1000 * 60 * 60) // 每小时更新
      
      // 定时更新天气
      setInterval(getWeather, 1000 * 60 * 30) // 每30分钟更新一次
      updateStatusBarColor()
    })

    onUnmounted(() => {
      const chartDom = document.getElementById('donationChart')
      if (chartDom) {
        echarts.dispose(chartDom)
      }
      // 清理所有的定时器和事件监听器
      if (resizeHandler.value) {
        window.removeEventListener('resize', resizeHandler.value)
      }
      clearInterval(window.donationsTimer)
      clearInterval(window.uptimeTimer)
      clearInterval(window.weatherTimer)
    })

    return {
      donations,
      totalAmount,
      visitCount,
      maxDonation,
      averageDonation,
      monthlyDonation,
      growthRate,
      uptime,
      weather,
      clientInfo,
      quote,
      dateRange,
      dateShortcuts,
      filteredDonations,
      handleDateChange,
      resizeHandler
    }
  }
}
</script>

<style>
.app-container {
  min-height: 100vh;
  background-color: #f6f8fa;
  display: flex;
  flex-direction: column;
}

.gradient-header {
  background: linear-gradient(135deg, #409EFF, #36D1DC);
  color: white;
  padding: clamp(15px, 2vw, 25px);
  padding-top: calc(env(safe-area-inset-top, 20px) + clamp(15px, 2vw, 25px));
  height: auto !important;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}

.page-title {
  margin: 0;
  font-size: clamp(1.5rem, 4vw, 2rem);
  font-weight: 600;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.header-stats {
  display: flex;
  gap: 30px;
  margin-top: 15px;
  justify-content: center;
  width: 100%;
  padding: 0 15px;
}

.stat-item {
  text-align: center;
  flex: 1;
  max-width: 150px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 10px;
  backdrop-filter: blur(5px);
}

/* 统一的统计信息样式 */
.stat-label {
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.9);
  display: block;
  margin-bottom: 5px;
}

.stat-value {
  display: block;
  font-size: 1.2rem;
  font-weight: 600;
  color: #fff;
  margin-top: 0;
}

/* 卡片内的统计信息样式 */
.statistics-content .stat-label {
  color: #909399;
}

.statistics-content .stat-value {
  color: #409EFF;
}

.el-main {
  padding: 15px;
  width: 100%;
  max-width: 100%;
  margin: 0;
}

.custom-card {
  height: auto;
  margin-bottom: 16px;
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
}

.custom-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}

.section-title {
  font-size: clamp(1rem, 1.2vw, 1.2rem);
  font-weight: 600;
  color: #2c3e50;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: clamp(12px, 2vw, 20px);
  border-bottom: 1px solid #ebeef5;
}

.donation-list {
  height: 100%;
  display: flex;
  flex-direction: column;
}

.waterfall-container {
  height: auto;
  min-height: 300px;
  max-height: calc(100vh - 250px);
  padding: 15px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  overflow-y: auto;
}

.donation-card {
  width: 100%;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  padding: 15px;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.donation-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.donation-header {
  flex: 0 0 120px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
  border-right: 1px solid #ebeef5;
  padding-right: 15px;
}

.donation-date {
  margin-bottom: 10px;
}

.donation-amount {
  font-size: clamp(1.2rem, 1.5vw, 1.5rem);
}

.donation-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.donation-project {
  margin: 0;
  font-size: 1.2rem;
}

.donation-info {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.donation-name {
  display: flex;
  align-items: center;
  gap: 5px;
  color: #606266;
  margin-bottom: 10px;
}

.donation-comment {
  color: #909399;
  line-height: 1.6;
  margin: 0;
  font-size: 0.9rem;
}

.chart-container {
  height: 280px;
  margin-top: 20px;
}

.el-icon {
  vertical-align: middle;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

.stat-box {
  background: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  transition: all 0.3s ease;
}

.stat-box:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.stat-info {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.author-card {
  position: relative;
  overflow: hidden;
}

.author-content {
  position: relative;
  z-index: 1;
  padding: 30px 20px;
}

.author-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"%3E%3Cpath fill="%23409EFF" fill-opacity="0.05" d="M14 16H9v-2h5V9.87a4 4 0 1 1 2 0V14h5v2h-5v15.95A10 10 0 0 0 23.66 27l-3.46-2 8.2-2.2-2.9 5a12 12 0 0 1-21 0l-2.89-5 8.2 2.2-3.47 2A10 10 0 0 0 14 31.95V16zm40 40h-5v-2h5v-4.13a4 4 0 1 1 2 0V54h5v2h-5v15.95A10 10 0 0 0 63.66 67l-3.47-2 8.2-2.2-2.88 5a12 12 0 0 1-21.02 0l-2.88-5 8.2 2.2-3.47 2A10 10 0 0 0 54 71.95V56zm-39 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm40-40a2 2 0 1 1 0-4 2 2 0 0 1 0 4zM15 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm40 40a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"%3E%3C/path%3E%3C/svg%3E');
  background-size: 60px 60px;
  opacity: 0.8;
  z-index: 0;
}

.author-info {
  position: relative;
  z-index: 2;
  backdrop-filter: blur(5px);
  padding: 20px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.7);
}

.author-quote {
  font-size: 1rem;
  color: #666;
  font-style: italic;
  margin: 15px 0;
  line-height: 1.6;
  position: relative;
  padding: 0 20px;
}

.author-quote::before,
.author-quote::after {
  content: '"';
  position: absolute;
  font-size: 1.5em;
  color: #409EFF;
  opacity: 0.3;
}

.author-quote::before {
  left: 0;
  top: -5px;
}

.author-quote::after {
  right: 0;
  bottom: -15px;
}

.author-avatar {
  width: 100px;
  height: 100px;
  margin: 0 auto 15px;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid #409EFF;
}

.author-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.author-name {
  margin: 0 0 10px;
  color: #2c3e50;
  font-size: 1.2rem;
}

.author-bio {
  color: #606266;
  margin-bottom: 20px;
}

.author-links {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.app-footer {
  margin-top: auto;
  padding: 15px 20px;
  text-align: center;
  color: #606266;
  background: #fff;
  box-shadow: 0 -2px 12px 0 rgba(0, 0, 0, 0.05);
}

@media screen and (max-width: 768px) {
  .gradient-header {
    padding-top: calc(env(safe-area-inset-top, 20px) + 15px);
    padding-bottom: 15px;
  }

  .page-title {
    font-size: 1.3rem;
    margin-bottom: 15px;
  }

  .header-stats {
    flex-direction: row;
    gap: 10px;
    padding: 0 10px;
    justify-content: space-between;
  }

  .stat-item {
    flex: 1;
    max-width: none;
    padding: 8px 5px;
    background: rgba(255, 255, 255, 0.15);
  }

  .stat-label {
    font-size: 0.8rem;
    margin-bottom: 3px;
  }

  .stat-value {
    font-size: 1.1rem;
  }

  .el-main {
    padding: 10px;
  }

  .el-row {
    margin: 0 !important;
  }

  .el-col {
    padding: 0 !important;
    margin-bottom: 10px;
  }

  .custom-card {
    margin-bottom: 10px;
  }

  .card-header {
    padding: 12px;
  }

  .stats-grid {
    padding: 10px;
    gap: 8px;
  }

  .stat-box {
    padding: 10px;
  }

  .stat-box .el-icon {
    font-size: 20px;
  }

  .waterfall-container {
    padding: 10px;
    gap: 10px;
    max-height: none;
  }

  .donation-card {
    padding: 12px;
    gap: 8px;
  }

  .donation-header {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 8px;
    border-bottom: 1px solid #ebeef5;
    border-right: none;
    padding-right: 0;
    width: 100%;
  }

  .donation-content {
    padding-top: 8px;
  }

  .donation-project {
    font-size: 1rem;
    margin-bottom: 8px;
  }

  .donation-name {
    font-size: 0.9rem;
    margin-bottom: 4px;
  }

  .donation-comment {
    font-size: 0.85rem;
    line-height: 1.4;
  }

  .chart-card {
    margin-bottom: 10px;
  }

  .chart-container {
    height: 200px;
    margin: 10px 0;
  }

  .system-info-content {
    padding: 10px;
  }

  .info-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }

  .info-item {
    padding: 15px;
  }

  .tech-stack-content {
    grid-template-columns: repeat(2, 1fr);
    padding: 15px;
    gap: 15px;
  }

  .author-content {
    padding: 20px 15px;
  }

  .author-info {
    padding: 15px;
  }

  .author-quote {
    font-size: 0.9rem;
    padding: 0 15px;
    margin: 10px 0;
  }

  .app-footer {
    padding: 12px 10px;
    font-size: 0.8rem;
  }
}

@media screen and (max-width: 375px) {
  .el-main {
    padding: 8px;
  }

  .custom-card {
    margin-bottom: 8px;
  }

  .waterfall-container {
    padding: 8px;
    gap: 8px;
  }

  .donation-card {
    padding: 10px;
  }

  .donation-header {
    padding-bottom: 6px;
  }

  .donation-content {
    padding-top: 6px;
  }

  .stats-grid {
    grid-template-columns: 1fr;
    padding: 8px;
  }

  .header-stats {
    gap: 8px;
    padding: 0 5px;
  }

  .stat-item {
    padding: 6px 4px;
  }

  .stat-label {
    font-size: 0.75rem;
  }

  .stat-value {
    font-size: 1.1rem;
  }
}

@supports (padding-bottom: env(safe-area-inset-bottom)) {
  .app-container {
    padding-bottom: env(safe-area-inset-bottom, 0);
  }
}

.app-container {
  -webkit-overflow-scrolling: touch;
}

.donation-card,
.info-item,
.stat-box,
.author-links a {
  cursor: pointer;
  touch-action: manipulation;
}

.waterfall-container {
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}

.waterfall-container::-webkit-scrollbar {
  width: 4px;
}

.waterfall-container::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.waterfall-container::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 2px;
}

.stat-item {
  transition: all 0.3s ease;
}

.stat-item:hover {
  transform: translateY(-2px);
  background: rgba(255, 255, 255, 0.2);
}

.system-info-content {
  padding: 20px;
}

.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.info-item {
  background: #f8f9fa;
  border-radius: 12px;
  padding: 20px;
  display: flex;
  align-items: flex-start;
  gap: 15px;
  transition: all 0.3s ease;
}

.info-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.info-item .el-icon {
  font-size: 24px;
  color: #409EFF;
  margin-top: 3px;
}

.info-detail {
  flex: 1;
}

.info-label {
  display: block;
  font-size: 0.9rem;
  color: #909399;
  margin-bottom: 5px;
}

.info-value {
  display: block;
  font-size: 1.1rem;
  color: #303133;
  font-weight: 500;
  margin-bottom: 3px;
}

.info-sub {
  display: block;
  font-size: 0.85rem;
  color: #909399;
}

.tech-stack-content {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.tech-group {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  padding: 15px;
  background: rgba(64, 158, 255, 0.05);
  border-radius: 8px;
}

.tech-group-title {
  width: 100%;
  margin: 0 0 10px;
  color: #409EFF;
  font-size: 16px;
  font-weight: 600;
}

.tech-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  transition: all 0.3s ease;
  flex: 1;
  min-width: 100px;
  padding: 10px;
  background: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.tech-item:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(64, 158, 255, 0.15);
}

.tech-item img {
  width: 40px;
  height: 40px;
  object-fit: contain;
}

.tech-item span {
  font-size: 0.9rem;
  color: #606266;
}

@media screen and (max-width: 768px) {
  .info-grid {
    grid-template-columns: 1fr;
    gap: 10px;
  }

  .info-item {
    padding: 15px;
  }

  .tech-stack-content {
    grid-template-columns: repeat(2, 1fr);
    padding: 15px;
    gap: 15px;
  }

  .tech-group {
    padding: 10px;
  }
  
  .tech-item {
    min-width: calc(50% - 10px);
    padding: 8px;
  }
}

@media screen and (min-width: 1440px) {
  .info-grid {
    grid-template-columns: repeat(3, 1fr);
  }

  .tech-stack-content {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* 自定义通知样式 */
.welcome-notification {
  background: linear-gradient(135deg, #409EFF, #36D1DC);
  border: none;
  color: white;
}

.welcome-notification .el-notification__title {
  color: white;
  font-weight: 600;
}

.welcome-notification .el-notification__content {
  color: rgba(255, 255, 255, 0.9);
}

.welcome-notification .el-notification__closeBtn {
  color: white;
}

.welcome-notification:hover {
  transform: translateX(-5px);
}

.list-filter {
  display: flex;
  align-items: center;
  gap: 10px;
}

.empty-state {
  padding: 40px 0;
  text-align: center;
}

/* 移动端适配 */
@media screen and (max-width: 768px) {
  .card-header {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
  }
  
  .list-filter {
    width: 100%;
  }
  
  .el-date-picker {
    width: 100% !important;
  }
}

/* 移动端布局顺序调整 */
@media screen and (max-width: 768px) {
  .donation-list-col {
    order: 1;
  }
  
  .chart-col {
    order: 2;
  }
  
  .system-info-col {
    order: 3;
  }
  
  /* 调整间距 */
  .el-col {
    margin-bottom: 15px;
  }
  
  /* 确保最后一个元素没有底部间距 */
  .el-col:last-child {
    margin-bottom: 0;
  }
}

.statistics-card {
  margin-bottom: 15px;
}

.statistics-content {
  padding: 10px;
}

@media (prefers-color-scheme: dark) {
  .stat-box {
    background: #1c1c1c;
  }
  
  .statistics-content .stat-value {
    color: #409EFF;
  }
  
  .statistics-content .stat-label {
    color: #909399;
  }
}
</style>
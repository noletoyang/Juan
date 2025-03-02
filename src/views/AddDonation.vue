<template>
  <el-container class="app-container">
    <el-header class="gradient-header">
      <h1 class="page-title">捐赠记录管理</h1>
    </el-header>
    <el-main>
      <el-card v-if="!isAuthenticated" class="custom-card auth-card">
        <template #header>
          <div class="card-header">
            <span class="section-title">管理员验证</span>
          </div>
        </template>
        <el-form 
          :model="authForm" 
          label-width="100px"
          class="auth-form"
          :rules="authRules"
          ref="authFormRef"
        >
          <el-form-item label="密码" prop="password">
            <el-input 
              v-model="authForm.password" 
              type="password" 
              placeholder="请输入管理员密码"
              @keyup.enter="authenticate"
            >
              <template #prefix>
                <el-icon><Lock /></el-icon>
              </template>
            </el-input>
          </el-form-item>
          <el-form-item label="滑动验证" prop="slider">
            <div class="slider-container">
              <el-slider
                v-model="authForm.slider"
                :min="0"
                :max="100"
                :show-tooltip="false"
                @change="handleSliderChange"
              />
              <span class="slider-text">{{ sliderText }}</span>
            </div>
          </el-form-item>
          <el-form-item class="form-buttons">
            <el-button 
              type="primary" 
              @click="authenticate"
              :loading="authenticating"
              :disabled="!isSliderVerified"
              round
            >
              验证
            </el-button>
            <el-button 
              @click="$router.push('/')"
              round
            >
              返回首页
            </el-button>
          </el-form-item>
        </el-form>
      </el-card>

      <template v-if="isAuthenticated">
        <div class="operation-bar">
          <el-button type="primary" @click="showAddDialog" round>
            <el-icon><Plus /></el-icon>新增捐赠
          </el-button>
          <el-input
            v-model="searchQuery"
            placeholder="搜索捐赠记录..."
            clearable
            class="search-input"
          >
            <template #prefix>
              <el-icon><Search /></el-icon>
            </template>
          </el-input>
        </div>

        <el-card class="custom-card">
          <el-table
            :data="filteredDonations"
            style="width: 100%"
            v-loading="loading"
          >
            <el-table-column prop="date" label="日期" sortable width="180">
              <template #default="{ row }">
                {{ formatDate(row.date) }}
              </template>
            </el-table-column>
            <el-table-column prop="name" label="捐赠者" width="120" />
            <el-table-column prop="amount" label="金额" width="120">
              <template #default="{ row }">
                ¥{{ row.amount }}
              </template>
            </el-table-column>
            <el-table-column prop="project" label="项目" />
            <el-table-column prop="comment" label="留言" show-overflow-tooltip />
            <el-table-column label="操作" width="150" fixed="right">
              <template #default="{ row }">
                <el-button-group>
                  <el-button 
                    type="primary" 
                    link
                    @click="handleEdit(row)"
                  >
                    编辑
                  </el-button>
                  <el-button 
                    type="danger" 
                    link
                    @click="handleDelete(row)"
                  >
                    删除
                  </el-button>
                </el-button-group>
              </template>
            </el-table-column>
          </el-table>
        </el-card>

        <el-dialog
          v-model="dialogVisible"
          :title="editingDonation.id ? '编辑捐赠记录' : '新增捐赠记录'"
          width="500px"
        >
          <el-form
            ref="donationFormRef"
            :model="editingDonation"
            :rules="rules"
            label-width="100px"
          >
            <el-form-item label="日期" prop="date">
              <el-date-picker
                v-model="editingDonation.date"
                type="datetime"
                placeholder="选择日期时间"
                format="YYYY-MM-DD HH:mm:ss"
                value-format="YYYY-MM-DD HH:mm:ss"
                :shortcuts="dateShortcuts"
                :disabled-date="disabledDate"
                style="width: 100%"
              />
            </el-form-item>
            <el-form-item label="捐赠者" prop="name">
              <el-input 
                v-model="editingDonation.name" 
                placeholder="请输入捐赠者姓名"
              >
                <template #prefix>
                  <el-icon><User /></el-icon>
                </template>
              </el-input>
            </el-form-item>
            <el-form-item label="金额" prop="amount">
              <el-input-number 
                v-model="editingDonation.amount" 
                :min="0"
                :precision="2"
                :step="10"
                style="width: 100%"
              />
            </el-form-item>
            <el-form-item label="项目" prop="project">
              <el-input 
                v-model="editingDonation.project" 
                placeholder="请输入项目名称"
              >
                <template #prefix>
                  <el-icon><Collection /></el-icon>
                </template>
              </el-input>
            </el-form-item>
            <el-form-item label="留言" prop="comment">
              <el-input 
                v-model="editingDonation.comment" 
                type="textarea" 
                :rows="4"
                placeholder="请输入留言内容（选填）"
                resize="none"
              />
            </el-form-item>
          </el-form>
          <template #footer>
            <div class="dialog-footer">
              <el-button @click="dialogVisible = false">取消</el-button>
              <el-button type="primary" @click="handleSubmit">确定</el-button>
            </div>
          </template>
        </el-dialog>
      </template>
    </el-main>
  </el-container>
</template>

<script>
import { ref, computed, onMounted, watch } from 'vue'
import { ElMessage, ElMessageBox } from 'element-plus'
import { User, Lock, Collection, Plus, Search } from '@element-plus/icons-vue'
import { API_URLS } from '../config/api'

export default {
  name: 'AddDonation',
  components: {
    User,
    Lock,
    Collection,
    Plus,
    Search
  },
  setup() {
    const authFormRef = ref(null)
    const donationFormRef = ref(null)
    const isAuthenticated = ref(false)
    const authenticating = ref(false)

    const authForm = ref({
      password: '',
      slider: 0
    })

    const rules = {
      date: [
        { required: true, message: '请选择日期', trigger: 'change' }
      ],
      name: [
        { required: true, message: '请输入捐赠者姓名', trigger: 'blur' },
        { min: 2, max: 20, message: '长度在 2 到 20 个字符', trigger: 'blur' }
      ],
      amount: [
        { required: true, message: '请输入捐赠金额', trigger: 'blur' },
        { type: 'number', min: 0.01, message: '金额必须大于 0', trigger: 'blur' }
      ],
      project: [
        { required: true, message: '请输入项目名称', trigger: 'blur' },
        { min: 2, max: 50, message: '长度在 2 到 50 个字符', trigger: 'blur' }
      ]
    }

    const authRules = {
      password: [
        { required: true, message: '请输入管理员密码', trigger: 'blur' }
      ],
      slider: [
        { required: true, message: '请完成滑块验证', trigger: 'change' }
      ]
    }

    const isSliderVerified = ref(false)
    const sliderText = ref('请向右滑动验证')

    const handleSliderChange = (value) => {
      if (value >= 100) {
        isSliderVerified.value = true
        sliderText.value = '验证通过'
      } else {
        isSliderVerified.value = false
        sliderText.value = '请向右滑动验证'
      }
    }

    const authenticate = async () => {
      if (!authFormRef.value) return
      if (!isSliderVerified.value) {
        ElMessage.warning('请完成滑块验证')
        return
      }

      await authFormRef.value.validate(async (valid) => {
        if (valid) {
          authenticating.value = true
          try {
            await new Promise(resolve => setTimeout(resolve, 500))
            if (authForm.value.password === 'admin123') {
              isAuthenticated.value = true
              ElMessage.success('验证成功')
            } else {
              ElMessage.error('密码错误')
              authForm.value.slider = 0
              isSliderVerified.value = false
              sliderText.value = '请向右滑动验证'
            }
          } finally {
            authenticating.value = false
          }
        }
      })
    }

    const dateShortcuts = [
      {
        text: '今天',
        value: new Date()
      },
      {
        text: '昨天',
        value: () => {
          const date = new Date()
          date.setTime(date.getTime() - 3600 * 1000 * 24)
          return date
        }
      },
      {
        text: '一周前',
        value: () => {
          const date = new Date()
          date.setTime(date.getTime() - 3600 * 1000 * 24 * 7)
          return date
        }
      }
    ]

    const disabledDate = (time) => {
      return time.getTime() > Date.now()
    }

    const loading = ref(false)
    const searchQuery = ref('')
    const donations = ref([])
    const dialogVisible = ref(false)
    const editingDonation = ref({
      id: null,
      date: new Date().toISOString().slice(0, 19).replace('T', ' '),
      name: '',
      amount: 0,
      project: '',
      comment: ''
    })

    const filteredDonations = computed(() => {
      const query = searchQuery.value.toLowerCase()
      return donations.value.filter(item => 
        item.name.toLowerCase().includes(query) ||
        item.project.toLowerCase().includes(query) ||
        item.comment?.toLowerCase().includes(query)
      )
    })

    const loadDonations = async () => {
      loading.value = true
      try {
        const response = await fetch(API_URLS.DONATIONS.LIST)
        const data = await response.json()
        if (data.success) {
          donations.value = data.data
        }
      } catch (error) {
        ElMessage.error('加载捐赠记录失败')
      } finally {
        loading.value = false
      }
    }

    const showAddDialog = () => {
      editingDonation.value = {
        id: null,
        date: new Date().toISOString().slice(0, 19).replace('T', ' '),
        name: '',
        amount: 0,
        project: '',
        comment: ''
      }
      dialogVisible.value = true
    }

    const handleEdit = (row) => {
      editingDonation.value = { ...row }
      dialogVisible.value = true
    }

    const handleDelete = async (row) => {
      try {
        await ElMessageBox.confirm('确定要删除这条捐赠记录吗？', '提示', {
          type: 'warning'
        })
        
        const response = await fetch(API_URLS.DONATIONS.DELETE, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ id: row.id })
        })
        const data = await response.json()
        
        if (data.success) {
          ElMessage.success('删除成功')
          await loadDonations()
        } else {
          throw new Error(data.message || '删除失败')
        }
      } catch (error) {
        if (error.message !== 'cancel') {
          ElMessage.error('删除失败')
        }
      }
    }

    const handleSubmit = async () => {
      if (!donationFormRef.value) return
      
      await donationFormRef.value.validate(async (valid) => {
        if (valid) {
          try {
            const url = editingDonation.value.id 
              ? API_URLS.DONATIONS.UPDATE 
              : API_URLS.DONATIONS.CREATE
            
            const response = await fetch(url, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(editingDonation.value)
            })
            
            const data = await response.json()
            
            if (data.success) {
              ElMessage.success(
                editingDonation.value.id ? '更新成功' : '添加成功'
              )
              dialogVisible.value = false
              await loadDonations()
            } else {
              throw new Error(data.message || '操作失败')
            }
          } catch (error) {
            ElMessage.error(error.message || '操作失败')
          }
        }
      })
    }

    // 在组件挂载时加载数据
    onMounted(() => {
      if (isAuthenticated.value) {
        loadDonations()
      }
    })

    // 监听认证状态变化
    watch(isAuthenticated, (newValue) => {
      if (newValue) {
        loadDonations()
      }
    })

    // 格式化日期
    const formatDate = (dateStr) => {
      const date = new Date(dateStr)
      return date.toLocaleString('zh-CN', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      })
    }

    return {
      authFormRef,
      donationFormRef,
      isAuthenticated,
      authForm,
      authenticate,
      rules,
      authRules,
      authenticating,
      dateShortcuts,
      disabledDate,
      isSliderVerified,
      sliderText,
      handleSliderChange,
      loading,
      searchQuery,
      donations,
      filteredDonations,
      dialogVisible,
      editingDonation,
      showAddDialog,
      handleEdit,
      handleDelete,
      handleSubmit,
      loadDonations,
      formatDate
    }
  }
}
</script>

<style>
.app-container {
  min-height: 100vh;
  background-color: #f6f8fa;
}

.gradient-header {
  background: linear-gradient(135deg, #409EFF, #36D1DC);
  color: white;
  padding: 20px;
  height: auto !important;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
}

.page-title {
  margin: 0;
  font-size: clamp(1.5rem, 4vw, 2rem);
  font-weight: 600;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.custom-card {
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
  max-width: 600px;
  margin: 0 auto;
}

.section-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #2c3e50;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
  border-bottom: 1px solid #ebeef5;
}

.donation-form, .auth-form {
  padding: 20px;
}

.form-buttons {
  margin-top: 30px;
  text-align: center;
  margin-bottom: 0;
}

.auth-card {
  max-width: 500px;
}

@media screen and (max-width: 768px) {
  .gradient-header {
    padding: 15px;
  }

  .el-main {
    padding: 10px;
  }

  .donation-form, .auth-form {
    padding: 15px;
  }

  .el-form-item {
    margin-bottom: 18px;
  }
}

.el-date-picker {
  --el-datepicker-border-color: var(--el-border-color-lighter);
  --el-datepicker-off-text-color: var(--el-text-color-placeholder);
  --el-datepicker-header-text-color: var(--el-text-color-regular);
  --el-datepicker-icon-color: var(--el-text-color-primary);
}

@media screen and (max-width: 768px) {
  .el-date-picker {
    width: 100% !important;
  }
}

.slider-container {
  position: relative;
  padding: 0;
  width: 100%;
  height: 40px;
  margin-bottom: 20px;
  border-radius: 4px;
  overflow: hidden;
  border: 1px solid #dcdfe6;
  background-color: #fff;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
}

.slider-container:hover {
  border-color: #c0c4cc;
}

.slider-container:focus-within {
  border-color: #409EFF;
}

.slider-text {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  color: #909399;
  font-size: 14px;
  pointer-events: none;
  white-space: nowrap;
  z-index: 1;
  transition: all 0.3s ease;
}

.el-slider {
  width: 100%;
  margin: 0;
  height: 100%;
  display: flex;
  align-items: center;
}

.el-slider__runway {
  height: 100%;
  margin: 0;
  background-color: transparent;
  border: none;
  border-radius: 4px;
  width: 100%;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
}

.el-slider__bar {
  height: 100%;
  background-color: #f0f7ff;
  backdrop-filter: blur(4px);
  transition: all 0.3s ease;
}

.el-slider__button-wrapper {
  top: 50%;
  width: 40px;
  height: 100%;
  transform: translateY(-50%);
  display: flex;
  align-items: center;
}

.el-slider__button {
  width: 40px;
  height: 40px;
  border: 1px solid #dcdfe6;
  background-color: #fff;
  border-radius: 4px;
  transition: all .2s;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  margin: 0;
}

.el-slider__button:hover {
  transform: scale(1.05);
  box-shadow: 0 2px 6px rgba(64, 158, 255, 0.15);
  border-color: #409EFF;
}

.el-slider__button::after {
  content: '→';
  color: #409EFF;
  font-size: 16px;
  opacity: 0.8;
  transition: all 0.3s ease;
}

@media screen and (max-width: 768px) {
  .slider-container {
    height: 36px;
    border-radius: 4px;
  }
  
  .el-slider__runway,
  .el-slider__bar {
    height: 100%;
  }
  
  .el-slider__button-wrapper {
    height: 100%;
  }
  
  .el-slider__button {
    width: 36px;
    height: 36px;
  }
  
  .slider-text {
    font-size: 12px;
  }

  .el-slider__button::after {
    font-size: 14px;
  }
}

@media (prefers-color-scheme: dark) {
  .slider-container {
    background-color: #1c1c1c;
    border-color: #4c4c4c;
  }
  
  .slider-container:hover {
    border-color: #666;
  }

  .slider-container:focus-within {
    border-color: #409EFF;
  }

  .el-slider__runway {
    background-color: transparent;
    border-color: #4c4c4c;
  }
  
  .el-slider__bar {
    background-color: #409EFF22;
  }
  
  .el-slider__button {
    background-color: #2c2c2c;
    border-color: #4c4c4c;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  }
  
  .el-slider__button:hover {
    background-color: #363636;
    box-shadow: 0 2px 6px rgba(64, 158, 255, 0.1);
  }

  .el-slider__button::after {
    color: #409EFF;
    opacity: 0.6;
  }

  .slider-text {
    color: #909399;
  }
}

/* 验证通过的样式 */
.el-slider[aria-valuenow="100"] {
  .el-slider__bar {
    background-color: #f0f9eb;
  }
  
  .el-slider__button {
    border-color: #67C23A;
  }
  
  .el-slider__button::after {
    content: '✓';
    color: #67C23A;
  }
}

.operation-bar {
  margin-bottom: 20px;
  display: flex;
  gap: 15px;
  align-items: center;
}

.search-input {
  max-width: 300px;
}

.el-table {
  border-radius: 8px;
  overflow: hidden;
  margin-bottom: 20px;
}

.dialog-footer {
  padding-top: 20px;
  text-align: right;
}

@media screen and (max-width: 768px) {
  .operation-bar {
    flex-direction: column;
    gap: 10px;
  }
  
  .search-input {
    max-width: 100%;
  }
}
</style>
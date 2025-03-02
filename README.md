# juanzeng
MIT License

Copyright (c) 2025 noletoyang

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
## Project setup
```
yarn install
```

### Compiles and hot-reloads for development
```
yarn serve
```

### Compiles and minifies for production
```
yarn build
```

### Lints and fixes files
```
yarn lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

# 开源项目捐赠管理系统

一个现代化的捐赠管理系统，用于记录和展示开源项目的捐赠情况。系统采用响应式设计，支持多端访问，提供直观的数据可视化和完整的捐赠管理功能。

## 功能特点

### 数据展示
- 捐赠统计面板
- 实时趋势图表
- 捐赠记录瀑布流
- 访问量统计

### 管理功能
- 捐赠记录管理（增删改查）
- 数据筛选和搜索
- 日期范围过滤
- 管理员验证

### 其他特性
- 响应式设计
- 暗色主题支持
- 智能问候
- 实时天气
- 地理位置识别

## 技术栈

### 前端
- Vue 3
- Element Plus
- ECharts
- Vite

### 后端
- PHP
- MySQL
- Nginx

## 项目结构

```
Juan/
├── src/                # 前端源代码
│   ├── views/         # 视图组件
│   │   ├── IndexPage.vue    # 首页：展示捐赠统计、记录和趋势
│   │   └── AddDonation.vue  # 管理页：处理捐赠记录的增删改查
│   ├── config/        # 配置文件
│   │   └── api.js          # API接口配置
│   └── assets/        # 静态资源
├── server/            # 后端源代码
│   ├── api/          # API接口
│   │   ├── donations/      # 捐赠相关接口
│   │   ├── visits/         # 访问统计接口
│   │   └── proxy/          # 代理接口
│   ├── includes/     # 公共组件
│   │   ├── Database.php    # 数据库连接类
│   │   ├── Response.php    # 响应处理类
│   │   └── cors.php        # 跨域处理
│   └── database/     # 数据库相关
│       └── init.sql        # 数据库初始化脚本
└── public/           # 公共资源
    └── index.html         # 主页模板
```

## 安装部署

### 环境要求
- PHP 7.4+
- MySQL 5.7+
- Node.js 16+
- Nginx/Apache

### 安装步骤

1. 克隆项目
```bash
git clone https://github.com/noletoyang/Juan.git
cd Juan
```

2. 安装依赖
```bash
yarn install
```

3. 配置数据库
```bash
# 导入数据库结构
mysql -u username -p database_name < server/database/init.sql
```

4. 开发环境运行
```bash
yarn serve
```

5. 生产环境构建
```bash
yarn build
```

6. 代码检查
```bash
yarn lint
```

## API 文档

### 捐赠相关
- `GET /api/donations/list.php` - 获取捐赠列表
- `POST /api/donations/create.php` - 创建捐赠记录
- `POST /api/donations/update.php` - 更新捐赠记录
- `POST /api/donations/delete.php` - 删除捐赠记录
- `GET /api/donations/stats.php` - 获取捐赠统计

### 访问统计
- `POST /api/visits/record.php` - 记录访问
- `GET /api/visits/count.php` - 获取访问量

## 贡献指南

1. Fork 本仓库
2. 创建特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 提交 Pull Request

## 联系方式

杨乐乐 - [@noletoyang](https://github.com/noletoyang) - noleit@icloud.com

项目链接: [https://github.com/noletoyang/Juan](https://github.com/noletoyang/Juan)
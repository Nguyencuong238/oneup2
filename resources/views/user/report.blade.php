@extends('layouts.user')

@section('meta')
    <meta name="description" content="OneUp Reports - Generate and export campaign reports">
    <title>Reports - OneUp KOL Analytics</title>
@endsection

@section('css')
    <style>
        /* Base styles from dashboard */
        body {
            background: #F8F9FA;
            min-height: 100vh;
        }

        .dashboard-layout {
            display: block;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            border-right: 1px solid var(--gray-200);
            padding: 1.5rem 0;
            position: fixed;
            height: 100vh;
            width: 260px;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1rem;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-logo-icon {
            width: 42px;
            height: 42px;
            background: var(--gradient-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .sidebar-logo-text {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 4px;
            border-radius: 10px;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
        }

        .nav-item:hover {
            background: var(--gray-100);
            color: var(--primary);
        }

        .nav-item.active {
            background: var(--primary-lighter);
            color: var(--primary);
            font-weight: 500;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 24px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gray-100);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-profile:hover {
            background: var(--gray-200);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-blue);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            color: var(--gray-500);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 0;
            background: #F8F9FA;
        }

        /* Top Bar */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Reports Content */
        .reports-content {
            padding: 2rem;
        }

        /* Report Generator */
        .report-generator {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .generator-header {
            margin-bottom: 1.5rem;
        }

        .generator-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .generator-description {
            font-size: 14px;
            color: var(--gray-600);
        }

        .generator-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-select {
            padding: 10px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-input {
            padding: 10px 14px;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-size: 14px;
        }

        .generator-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        /* Report Templates */
        .templates-section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .template-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .template-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .template-preview {
            height: 160px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
        }

        .template-body {
            padding: 1rem;
        }

        .template-name {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .template-description {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .template-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .template-badge {
            display: inline-block;
            padding: 4px 10px;
            background: var(--primary-lighter);
            color: var(--primary);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .template-action {
            color: var(--primary);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        /* Recent Reports Table */
        .reports-table-container {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .reports-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reports-table th {
            text-align: left;
            padding: 12px 1.5rem;
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .reports-table td {
            padding: 16px 1.5rem;
            border-top: 1px solid var(--gray-100);
        }

        .reports-table tr:hover {
            background: var(--gray-50);
        }

        .report-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .report-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-lighter);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .report-details {
            flex: 1;
        }

        .report-name {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .report-campaign {
            font-size: 13px;
            color: var(--gray-600);
        }

        .report-type {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .type-performance {
            background: rgba(0, 102, 255, 0.1);
            color: var(--primary);
        }

        .type-financial {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .type-kol {
            background: rgba(139, 92, 246, 0.1);
            color: #8B5CF6;
        }

        .report-actions {
            display: flex;
            gap: 0.75rem;
        }

        .action-btn {
            padding: 6px;
            background: transparent;
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: var(--gray-50);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Schedule Modal */
        .schedule-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .schedule-modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
        }

        .modal-header {
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .modal-description {
            font-size: 14px;
            color: var(--gray-600);
        }

        .schedule-options {
            display: grid;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .schedule-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .schedule-option:hover {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .schedule-option.selected {
            border-color: var(--primary);
            background: var(--primary-lighter);
        }

        .schedule-radio {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
        }

        .schedule-label {
            flex: 1;
        }

        .schedule-title {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }

        .schedule-desc {
            font-size: 13px;
            color: var(--gray-600);
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        /* Export Status */
        .export-status {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: none;
            align-items: center;
            gap: 1rem;
            z-index: 100;
        }

        .export-status.active {
            display: flex;
        }

        .export-spinner {
            width: 24px;
            height: 24px;
            border: 3px solid var(--gray-200);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .export-text {
            font-size: 14px;
            color: var(--dark-blue);
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .templates-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .reports-content {
                padding: 1rem;
            }

            .generator-form {
                grid-template-columns: 1fr;
            }

            .templates-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('page')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="topbar-left">
                <h1 class="page-title">Reports & Export</h1>
            </div>

            <div class="topbar-right">
                <button class="btn btn-secondary btn-small" onclick="openScheduleModal()">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                    Schedule Report
                </button>
                <button class="btn btn-primary btn-small" onclick="generateReport()">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Generate Report
                </button>
            </div>
        </div>

        <!-- Reports Content -->
        <div class="reports-content">
            <!-- Report Generator -->
            <div class="report-generator">
                <div class="generator-header">
                    <h2 class="generator-title">Quick Report Generator</h2>
                    <p class="generator-description">Select parameters to generate a custom report</p>
                </div>

                <div class="generator-form">
                    <div class="form-group">
                        <label class="form-label">Report Type</label>
                        <select class="form-select">
                            <option>Campaign Performance Report</option>
                            <option>KOL Analysis Report</option>
                            <option>Financial Summary</option>
                            <option>Engagement Analytics</option>
                            <option>ROI Report</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Campaign</label>
                        <select class="form-select">
                            <option>All Campaigns</option>
                            <option>Summer Fashion 2024</option>
                            <option>Beauty Product Launch</option>
                            <option>Food Festival 2024</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date Range</label>
                        <select class="form-select">
                            <option>Last 30 Days</option>
                            <option>Last 7 Days</option>
                            <option>This Month</option>
                            <option>Last Month</option>
                            <option>Custom Range</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Format</label>
                        <select class="form-select">
                            <option>PDF Report</option>
                            <option>Excel Spreadsheet</option>
                            <option>CSV Data</option>
                            <option>PowerPoint Presentation</option>
                        </select>
                    </div>
                </div>

                <div class="generator-actions">
                    <button class="btn btn-secondary">Preview Report</button>
                    <button class="btn btn-primary" onclick="generateReport()">Generate & Download</button>
                    <button class="btn btn-secondary">Email Report</button>
                </div>
            </div>

            <!-- Report Templates -->
            <div class="templates-section">
                <div class="section-header">
                    <h2 class="section-title">Report Templates</h2>
                    <a href="#" class="btn btn-secondary btn-small">View All Templates</a>
                </div>

                <div class="templates-grid">
                    <div class="template-card">
                        <div class="template-preview">
                            📊
                        </div>
                        <div class="template-body">
                            <h3 class="template-name">Monthly Performance Report</h3>
                            <p class="template-description">Comprehensive monthly campaign performance analysis with KPIs
                                and trends</p>
                            <div class="template-footer">
                                <span class="template-badge">Popular</span>
                                <a href="#" class="template-action">Use Template →</a>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-preview"
                            style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            💰
                        </div>
                        <div class="template-body">
                            <h3 class="template-name">ROI Analysis Report</h3>
                            <p class="template-description">Detailed return on investment analysis with cost breakdown and
                                revenue metrics</p>
                            <div class="template-footer">
                                <span class="template-badge">Finance</span>
                                <a href="#" class="template-action">Use Template →</a>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-preview"
                            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            👥
                        </div>
                        <div class="template-body">
                            <h3 class="template-name">KOL Performance Comparison</h3>
                            <p class="template-description">Compare and analyze performance metrics across multiple KOLs</p>
                            <div class="template-footer">
                                <span class="template-badge">Analytics</span>
                                <a href="#" class="template-action">Use Template →</a>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-preview"
                            style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                            📈
                        </div>
                        <div class="template-body">
                            <h3 class="template-name">Executive Summary</h3>
                            <p class="template-description">High-level overview designed for executive stakeholders and
                                decision makers</p>
                            <div class="template-footer">
                                <span class="template-badge">Executive</span>
                                <a href="#" class="template-action">Use Template →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="reports-table-container">
                <div class="table-header">
                    <h2 class="table-title">Recent Reports</h2>
                    <a href="#" class="btn btn-secondary btn-small">View All</a>
                </div>

                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Type</th>
                            <th>Generated</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="report-info">
                                    <div class="report-icon">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="report-details">
                                        <div class="report-name">Summer Campaign Performance Report</div>
                                        <div class="report-campaign">Summer Fashion Collection 2024</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="report-type type-performance">Performance</span>
                            </td>
                            <td>Jul 25, 2024</td>
                            <td>2.4 MB</td>
                            <td>
                                <div class="report-actions">
                                    <button class="action-btn" title="Download">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Share">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="report-info">
                                    <div class="report-icon">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="report-details">
                                        <div class="report-name">Q2 Financial Summary</div>
                                        <div class="report-campaign">All Campaigns</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="report-type type-financial">Financial</span>
                            </td>
                            <td>Jul 20, 2024</td>
                            <td>1.8 MB</td>
                            <td>
                                <div class="report-actions">
                                    <button class="action-btn" title="Download">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Share">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="report-info">
                                    <div class="report-icon">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="report-details">
                                        <div class="report-name">Top KOLs Performance Analysis</div>
                                        <div class="report-campaign">Beauty Product Launch</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="report-type type-kol">KOL Analysis</span>
                            </td>
                            <td>Jul 18, 2024</td>
                            <td>3.1 MB</td>
                            <td>
                                <div class="report-actions">
                                    <button class="action-btn" title="Download">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Share">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                    </button>
                                    <button class="action-btn" title="Delete">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Schedule Modal -->
    <div class="schedule-modal" id="scheduleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Schedule Automated Reports</h3>
                <p class="modal-description">Set up recurring reports to be generated and sent automatically</p>
            </div>

            <div class="schedule-options">
                <div class="schedule-option">
                    <input type="radio" name="schedule" class="schedule-radio" id="daily">
                    <div class="schedule-label">
                        <div class="schedule-title">Daily Report</div>
                        <div class="schedule-desc">Receive report every day at 9:00 AM</div>
                    </div>
                </div>

                <div class="schedule-option">
                    <input type="radio" name="schedule" class="schedule-radio" id="weekly" checked>
                    <div class="schedule-label">
                        <div class="schedule-title">Weekly Report</div>
                        <div class="schedule-desc">Receive report every Monday at 9:00 AM</div>
                    </div>
                </div>

                <div class="schedule-option">
                    <input type="radio" name="schedule" class="schedule-radio" id="monthly">
                    <div class="schedule-label">
                        <div class="schedule-title">Monthly Report</div>
                        <div class="schedule-desc">Receive report on the 1st of every month</div>
                    </div>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeScheduleModal()">Cancel</button>
                <button class="btn btn-primary" onclick="saveSchedule()">Schedule Report</button>
            </div>
        </div>
    </div>

    <!-- Export Status -->
    <div class="export-status" id="exportStatus">
        <div class="export-spinner"></div>
        <span class="export-text">Generating report...</span>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Schedule Modal
        function openScheduleModal() {
            document.getElementById('scheduleModal').classList.add('active');
        }

        function closeScheduleModal() {
            document.getElementById('scheduleModal').classList.remove('active');
        }

        function saveSchedule() {
            closeScheduleModal();
            showNotification('Report scheduled successfully!');
        }

        // Generate Report
        function generateReport() {
            const exportStatus = document.getElementById('exportStatus');
            exportStatus.classList.add('active');

            // Simulate report generation
            setTimeout(() => {
                exportStatus.querySelector('.export-text').textContent = 'Preparing download...';

                setTimeout(() => {
                    exportStatus.classList.remove('active');
                    showNotification('Report downloaded successfully!');

                    // Trigger download
                    const link = document.createElement('a');
                    link.href = '#';
                    link.download = 'campaign-report.pdf';
                    link.click();
                }, 1500);
            }, 2000);
        }

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                display: flex;
                align-items: center;
                gap: 12px;
                z-index: 1000;
                animation: slideIn 0.3s ease;
            `;

            notification.innerHTML = `
                <svg width="20" height="20" fill="var(--success)" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span style="color: var(--dark-blue); font-size: 14px;">${message}</span>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Add animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Schedule option selection
        document.querySelectorAll('.schedule-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.schedule-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                this.querySelector('.schedule-radio').checked = true;
            });
        });
    </script>
@endsection

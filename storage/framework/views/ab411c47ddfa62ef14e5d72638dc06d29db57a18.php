<?php $__env->startSection('title'); ?> 
<?php echo e(__('messages.dashboard')); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    .dashboard-container {
        padding: 20px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .stat-card.students {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card.teachers {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .stat-card.drivers {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .stat-card.payments {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #333;
    }

    .stat-card.expenses {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #333;
    }

    .stat-card.outstanding {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #333;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .dashboard-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .chart-card, .activity-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #2c3e50;
        border-bottom: 3px solid #3498db;
        padding-bottom: 10px;
    }

    .recent-item {
        padding: 15px;
        border-left: 4px solid #3498db;
        background: #f8f9fa;
        margin-bottom: 10px;
        border-radius: 0 8px 8px 0;
        transition: background 0.3s ease;
    }

    .recent-item:hover {
        background: #e9ecef;
    }

    .recent-item-header {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .recent-item-details {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .amount-positive {
        color: #28a745;
        font-weight: 600;
    }

    .amount-negative {
        color: #dc3545;
        font-weight: 600;
    }

    .chart-container {
        height: 400px;
        position: relative;
    }

    .student-status-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 20px;
    }

    .status-item {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        background: #f8f9fa;
    }

    .status-active {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .status-inactive {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    .status-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .no-data {
        text-align: center;
        color: #6c757d;
        font-style: italic;
        padding: 20px;
    }

    /* RTL Support */
    [dir="rtl"] .stat-card::before {
        right: auto;
        left: 0;
        transform: translate(-30px, -30px);
    }

    [dir="rtl"] .recent-item {
        border-left: none;
        border-right: 4px solid #3498db;
        border-radius: 8px 0 0 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-row {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderlink'); ?>
<a href="<?php echo e(route('admin.dashboard')); ?>">
    <?php echo e(__('messages.home')); ?>

</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
<?php echo e(__('messages.dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card students">
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-number"><?php echo e(number_format($totalStudents)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_students')); ?></div>
        </div>

        <div class="stat-card teachers">
            <div class="stat-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-number"><?php echo e(number_format($totalTeachers)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_teachers')); ?></div>
        </div>

        <div class="stat-card drivers">
            <div class="stat-icon">
                <i class="fas fa-bus"></i>
            </div>
            <div class="stat-number"><?php echo e(number_format($totalDrivers)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_drivers')); ?></div>
        </div>

        <div class="stat-card payments">
            <div class="stat-icon">
                <i class="fas fa-coins"></i>
            </div>
            <div class="stat-number">$<?php echo e(number_format($totalPayments, 2)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_payments')); ?></div>
        </div>

        <div class="stat-card expenses">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-number">$<?php echo e(number_format($totalExpenses, 2)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.total_expenses')); ?></div>
        </div>

        <div class="stat-card outstanding">
            <div class="stat-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number">$<?php echo e(number_format($totalOutstanding, 2)); ?></div>
            <div class="stat-label"><?php echo e(__('messages.outstanding_balance')); ?></div>
        </div>
    </div>

    <!-- Main Dashboard Row -->
    <div class="dashboard-row">
        <!-- Chart Section -->
        <div class="chart-card">
            <h3 class="card-title">
                <i class="fas fa-chart-line"></i>
                <?php echo e(__('messages.monthly_financial_overview')); ?>

            </h3>
            <div class="chart-container">
                <canvas id="financialChart"></canvas>
            </div>
        </div>

        <!-- Student Status -->
        <div class="activity-card">
            <h3 class="card-title">
                <i class="fas fa-users"></i>
                <?php echo e(__('messages.student_status')); ?>

            </h3>
            <div class="student-status-grid">
                <div class="status-item status-active">
                    <div class="status-number"><?php echo e(number_format($activeStudents)); ?></div>
                    <div><?php echo e(__('messages.active_students')); ?></div>
                </div>
                <div class="status-item status-inactive">
                    <div class="status-number"><?php echo e(number_format($inactiveStudents)); ?></div>
                    <div><?php echo e(__('messages.inactive_students')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Row -->
    <div class="dashboard-row">
        <!-- Recent Payments -->
        <div class="activity-card">
            <h3 class="card-title">
                <i class="fas fa-credit-card"></i>
                <?php echo e(__('messages.recent_payments')); ?>

            </h3>
            <?php if($recentPayments->count() > 0): ?>
                <?php $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="recent-item">
                    <div class="recent-item-header">
                        <?php echo e($payment->user->name ?? __('messages.unknown_student')); ?>

                    </div>
                    <div class="recent-item-details">
                        <span class="amount-positive">$<?php echo e(number_format($payment->amount_paid, 2)); ?></span>
                        • <?php echo e($payment->payment_date); ?>

                        • <?php echo e(__('messages.receipt')); ?>: <?php echo e($payment->receipt_number); ?>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="no-data"><?php echo e(__('messages.no_recent_payments')); ?></div>
            <?php endif; ?>
        </div>

        <!-- Recent Expenses -->
        <div class="activity-card">
            <h3 class="card-title">
                <i class="fas fa-receipt"></i>
                <?php echo e(__('messages.recent_expenses')); ?>

            </h3>
            <?php if($recentExpenses->count() > 0): ?>
                <?php $__currentLoopData = $recentExpenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="recent-item">
                    <div class="recent-item-header">
                        <?php echo e($expense->typeExpense->name ?? __('messages.general_expense')); ?>

                    </div>
                    <div class="recent-item-details">
                        <span class="amount-negative">$<?php echo e(number_format($expense->amount, 2)); ?></span>
                        • <?php echo e($expense->created_at->format('Y-m-d')); ?>

                        <?php if($expense->note): ?>
                        • <?php echo e(Str::limit($expense->note, 50)); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="no-data"><?php echo e(__('messages.no_recent_expenses')); ?></div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Financial Chart
    const ctx = document.getElementById('financialChart').getContext('2d');
    const monthlyData = <?php echo json_encode($monthlyData, 15, 512) ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.map(item => item.month),
            datasets: [{
                label: '<?php echo e(__("messages.payments")); ?>',
                data: monthlyData.map(item => item.payments),
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: '<?php echo e(__("messages.expenses")); ?>',
                data: monthlyData.map(item => item.expenses),
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
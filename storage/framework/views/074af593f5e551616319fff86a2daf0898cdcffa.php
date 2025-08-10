<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo e(asset('assets/admin/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Battle</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('assets/admin/dist/img/user2-160x160.jpg')); ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo e(auth()->user()->name); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

            

                <?php if(
                $user->can('user-table') ||
                $user->can('user-add') ||
                $user->can('user-edit') ||
                $user->can('user-delete')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('users.index')); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> <?php echo e(__('messages.Students')); ?> </p>
                    </a>
                </li>
                <?php endif; ?>


             
                <?php if(
                    $user->can('clas-table') ||
                        $user->can('clas-add') ||
                        $user->can('clas-edit') ||
                        $user->can('clas-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('clas.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Classes')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>
             
                <?php if(
                    $user->can('teacher-table') ||
                        $user->can('teacher-add') ||
                        $user->can('teacher-edit') ||
                        $user->can('teacher-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('teachers.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Teachers')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>
               
               <?php if(
                    $user->can('driver-table') ||
                        $user->can('driver-add') ||
                        $user->can('driver-edit') ||
                        $user->can('driver-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('drivers.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Drivers')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>
             
             <?php if(
                    $user->can('typeExpense-table') ||
                        $user->can('typeExpense-add') ||
                        $user->can('typeExpense-edit') ||
                        $user->can('typeExpense-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('type-expenses.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Type Expenses')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>
             
             <?php if(
                    $user->can('expense-table') ||
                        $user->can('expense-add') ||
                        $user->can('expense-edit') ||
                        $user->can('expense-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('expenses.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Expenses')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>
            
            <?php if(
                    $user->can('studentPayment-table') ||
                        $user->can('studentPayment-add') ||
                        $user->can('studentPayment-edit') ||
                        $user->can('studentPayment-delete')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('student-payments.index')); ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> <?php echo e(__('messages.Student Payments')); ?>  </p>
                        </a>
                    </li>
                <?php endif; ?>


            



                <li class="nav-item">
                    <a href="<?php echo e(route('admin.login.edit',auth()->user()->id)); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo e(__('messages.Admin_account')); ?> </p>
                    </a>
                </li>

                <?php if($user->can('role-table') || $user->can('role-add') || $user->can('role-edit') ||
                $user->can('role-delete')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.role.index')); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <span><?php echo e(__('messages.Roles')); ?> </span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(
                $user->can('employee-table') ||
                $user->can('employee-add') ||
                $user->can('employee-edit') ||
                $user->can('employee-delete')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.employee.index')); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <span> <?php echo e(__('messages.Employee')); ?> </span>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>
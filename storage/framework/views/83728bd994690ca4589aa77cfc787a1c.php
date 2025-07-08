

<?php $__env->startSection('content'); ?>
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .login-card-header {
        background-color: #28a745;
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        padding: 1.5rem;
    }
    .login-btn {
        background-color: #28a745;
        border: none;
        font-weight: 600;
        transition: 0.3s ease;
    }
    .login-btn:hover {
        background-color: #218838;
    }
    .form-check-label {
        font-size: 0.9rem;
    }
</style>

<div class="login-wrapper">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card">
            <div class="login-card-header">Create Your Account</div>

            <div class="card-body p-4">
                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text"
                            class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email Address</label>
                        <input id="email" type="email"
                            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="email" value="<?php echo e(old('email')); ?>" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="password" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback d-block">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password"
                            class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group mt-4 mb-2 d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-success login-btn px-4">
                            Register
                        </button>

                        <a class="text-muted small" href="<?php echo e(route('login')); ?>">
                            Already have an account?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\selleaise\resources\views/auth/register.blade.php ENDPATH**/ ?>
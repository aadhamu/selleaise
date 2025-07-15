

<?php $__env->startSection('content'); ?>

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Contact Start -->
<div class="container-fluid pt-5">
  <div class="text-center mb-4">
      <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
  </div>
  <div class="row px-xl-5">
      <div class="col-lg-7 mb-5">
          <div class="contact-form">
              <!-- <div id="success"></div> -->
              <?php if(session('success')): ?>
    <div class="alert alert-success mt-2" id="success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST" action="<?php echo e(route('contact.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="control-group">
        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
            required="required" data-validation-required-message="Please enter your name" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email"
            required="required" data-validation-required-message="Please enter your email" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject"
            required="required" data-validation-required-message="Please enter a subject" />
        <p class="help-block text-danger"></p>
    </div>
    <div class="control-group">
        <textarea name="message" class="form-control" rows="6" id="message" placeholder="Message"
            required="required" data-validation-required-message="Please enter your message"></textarea>
        <p class="help-block text-danger"></p>
    </div>
    <div>
        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
    </div>
</form>

          </div>
      </div>
      <div class="col-lg-5 mb-5">
          <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
          <p>Have questions or need assistance? We’re always here to help.
Reach out to us via email or phone — we’d love to hear from you.</p>
          <div class="d-flex flex-column mb-3">
              <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
              <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Abuja,Nigeria</p>
              <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Lannasage@gmail.com</p>
              <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+2348037423752</p>
          </div>
  </div>
</div>
<!-- Contact End -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\selleaise\resources\views/frontend/contact.blade.php ENDPATH**/ ?>
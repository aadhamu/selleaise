@extends('layout.frontend')

@section('content')
<div class="container my-5 py-4 bg-white shadow rounded">
    <div class="px-4">
        <h2 class="mb-4 text-center font-weight-bold">Terms & Conditions</h2>

        <p class="lead">These Terms and Conditions ("Terms") govern your use of our platform, products, and services. By accessing or using our website, you agree to be bound by these Terms.</p>

        <hr>

        <h4>1. Acceptance of Terms</h4>
        <p>By using this website, you agree to comply with and be legally bound by these Terms. If you do not agree, please discontinue use immediately.</p>

        <h4>2. Eligibility</h4>
        <p>You must be at least 18 years old or using the site under the supervision of a parent or guardian. We reserve the right to refuse service or terminate accounts if false information is provided.</p>

        <h4>3. Orders & Payments</h4>
        <ul>
            <li>All orders are subject to product availability and confirmation of the order price.</li>
            <li>Prices are listed in Nigerian Naira (₦) and include VAT where applicable.</li>
            <li>Payment must be made through approved channels (Bank Transfer, Card Payment, Paystack, Flutterwave, etc.).</li>
        </ul>

        <h4>4. Delivery</h4>
        <ul>
            <li>Delivery timelines range between 1 – 5 working days depending on your location.</li>
            <li>We will not be responsible for delays caused by third-party logistics providers.</li>
            <li>Delivery fees are calculated at checkout based on your location.</li>
        </ul>

        <h4>5. Returns & Refunds</h4>
        <p>We accept returns within 7 days of delivery if the product is defective or not as described. Refunds will be processed within 5–7 business days after inspection.</p>

        <h4>6. Product Descriptions</h4>
        <p>We strive to ensure all product descriptions and images are accurate. However, colors and packaging may vary slightly from what is displayed on your screen.</p>

        <h4>7. User Responsibilities</h4>
        <ul>
            <li>You must not misuse this website by knowingly introducing viruses, trojans, or other malicious software.</li>
            <li>You must not attempt to gain unauthorized access to our servers or databases.</li>
        </ul>

        <h4>8. Intellectual Property</h4>
        <p>All content, branding, logos, and product descriptions are owned by the platform and may not be copied or reproduced without permission.</p>

        <h4>9. Account Security</h4>
        <p>Users are responsible for maintaining the confidentiality of their login credentials and for all activities under their account.</p>

        <h4>10. Pricing & Availability</h4>
        <p>Prices and availability are subject to change without notice. We reserve the right to modify or discontinue any product or service at any time.</p>

        <h4>11. Third-Party Links</h4>
        <p>We may provide links to third-party websites. We are not responsible for the content, privacy policies, or practices of any third-party sites.</p>

        <h4>12. Limitation of Liability</h4>
        <p>To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, or consequential damages resulting from the use of our services or website.</p>

        <h4>13. Governing Law</h4>
        <p>These Terms shall be governed and construed in accordance with the laws of the Federal Republic of Nigeria.</p>

        <h4>14. Changes to Terms</h4>
        <p>We reserve the right to update or change these Terms at any time. Changes take effect once posted. Please review this page periodically.</p>

        <h4>15. Contact Information</h4>
        <p>If you have any questions about these Terms, please contact us via the <a href="{{ route('contact') }}">Contact Us</a> page.</p>

        <p class="text-muted mt-4">Last updated: {{ now()->format('F d, Y') }}</p>
    </div>
</div>
@endsection

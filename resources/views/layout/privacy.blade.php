@extends('layout.frontend')

@section('content')
<div class="container my-5 py-4 bg-white shadow rounded">
    <div class="px-4">
        <h2 class="mb-4 text-center font-weight-bold">Privacy Policy</h2>

        <p class="lead">We value your privacy. This Privacy Policy outlines how we collect, use, and protect your personal information when you visit or make a purchase from our website.</p>

        <hr>

        <h4>1. Information We Collect</h4>
        <ul>
            <li>Personal details: Name, email address, phone number, shipping address.</li>
            <li>Payment details: Card information (processed securely via third-party providers).</li>
            <li>Device data: IP address, browser type, operating system, and interaction data.</li>
        </ul>

        <h4>2. How We Use Your Information</h4>
        <ul>
            <li>To process orders and deliver products.</li>
            <li>To communicate with you regarding purchases or support.</li>
            <li>To personalize your experience and improve our services.</li>
        </ul>

        <h4>3. Sharing Your Information</h4>
        <p>We only share your data with trusted service providers such as payment gateways and delivery partners. We do not sell or rent your personal information to third parties.</p>

        <h4>4. Cookies & Tracking</h4>
        <p>We use cookies to enhance user experience, analyze site traffic, and serve targeted ads. You can disable cookies in your browser settings.</p>

        <h4>5. Data Security</h4>
        <p>We implement reasonable security measures to protect your data. However, no method of transmission over the internet is 100% secure.</p>

        <h4>6. Your Rights</h4>
        <ul>
            <li>Access your personal data.</li>
            <li>Request correction of inaccurate data.</li>
            <li>Request deletion of your data, subject to legal exceptions.</li>
        </ul>

        <h4>7. Data Retention</h4>
        <p>We retain your data only as long as necessary for the purposes stated, or as required by law.</p>

        <h4>8. Third-Party Services</h4>
        <p>Our website may contain links to third-party platforms. We are not responsible for their privacy practices or content.</p>

        <h4>9. Changes to This Policy</h4>
        <p>We may update this Privacy Policy from time to time. Changes become effective upon posting. You are encouraged to review this page regularly.</p>

        <h4>10. Contact Us</h4>
        <p>If you have questions or concerns about this policy, please reach out via our <a href="{{ route('contact') }}">Contact page</a>.</p>

        <p class="text-muted mt-4">Last updated: {{ now()->format('F d, Y') }}</p>
    </div>
</div>
@endsection

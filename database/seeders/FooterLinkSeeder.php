<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterLink;

class FooterLinkSeeder extends Seeder
{
    public function run(): void
    {
        // Product column links
        $productLinks = [
            ['title' => 'Features', 'slug' => 'features', 'order' => 1],
            ['title' => 'Pricing', 'slug' => 'pricing', 'order' => 2],
            ['title' => 'Coaches', 'slug' => 'coaches', 'order' => 3],
            ['title' => 'Workouts', 'slug' => 'workouts', 'order' => 4],
            ['title' => 'Mobile App', 'slug' => 'mobile-app', 'order' => 5],
        ];

        foreach ($productLinks as $link) {
            FooterLink::updateOrCreate(
                ['slug' => $link['slug']],
                [
                    'title' => $link['title'],
                    'column' => 'product',
                    'order' => $link['order'],
                    'is_active' => true,
                    'content' => $this->getDefaultContent($link['slug'])
                ]
            );
        }

        // Company column links
        $companyLinks = [
            ['title' => 'About Us', 'slug' => 'about-us', 'order' => 1],
            ['title' => 'Careers', 'slug' => 'careers', 'order' => 2],
            ['title' => 'Blog', 'slug' => 'blog', 'order' => 3],
            ['title' => 'Press Kit', 'slug' => 'press-kit', 'order' => 4],
            ['title' => 'Partners', 'slug' => 'partners', 'order' => 5],
        ];

        foreach ($companyLinks as $link) {
            FooterLink::updateOrCreate(
                ['slug' => $link['slug']],
                [
                    'title' => $link['title'],
                    'column' => 'company',
                    'order' => $link['order'],
                    'is_active' => true,
                    'content' => $this->getDefaultContent($link['slug'])
                ]
            );
        }

        // Resources column links
        $resourcesLinks = [
            ['title' => 'Help Center', 'slug' => 'help-center', 'order' => 1],
            ['title' => 'Video Tutorials', 'slug' => 'video-tutorials', 'order' => 2],
            ['title' => 'Community', 'slug' => 'community', 'order' => 3],
            ['title' => 'Success Stories', 'slug' => 'success-stories', 'order' => 4],
            ['title' => 'API Docs', 'slug' => 'api-docs', 'order' => 5],
        ];

        foreach ($resourcesLinks as $link) {
            FooterLink::updateOrCreate(
                ['slug' => $link['slug']],
                [
                    'title' => $link['title'],
                    'column' => 'resources',
                    'order' => $link['order'],
                    'is_active' => true,
                    'content' => $this->getDefaultContent($link['slug'])
                ]
            );
        }

        // Legal column links
        $legalLinks = [
            ['title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'order' => 1],
            ['title' => 'Terms of Service', 'slug' => 'terms-of-service', 'order' => 2],
            ['title' => 'Cookie Policy', 'slug' => 'cookie-policy', 'order' => 3],
            ['title' => 'Disclaimer', 'slug' => 'disclaimer', 'order' => 4],
            ['title' => 'Contact', 'slug' => 'contact', 'order' => 5],
        ];

        foreach ($legalLinks as $link) {
            FooterLink::updateOrCreate(
                ['slug' => $link['slug']],
                [
                    'title' => $link['title'],
                    'column' => 'legal',
                    'order' => $link['order'],
                    'is_active' => true,
                    'content' => $this->getDefaultContent($link['slug'])
                ]
            );
        }
    }

    private function getPrivacyPolicyContent()
    {
        return '<div class="policy-content">
<h2>Privacy Policy</h2>
<p class="last-updated">Last Updated: January 2026</p>

<h3>1. Introduction</h3>
<p>Welcome to PathFit AI ("we," "our," or "us"). We are committed to protecting your privacy and ensuring you have a positive experience using our platform. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our PathFit AI mobile application, website, and services (collectively, the "Platform").</p>
<p>By accessing or using our Platform, you agree to this Privacy Policy. If you do not agree with the terms of this policy, please do not access the Platform.</p>

<h3>2. Information We Collect</h3>
<p>We collect information to provide better services to all our users. This includes:</p>
<ul>
<li><strong>Personal Information:</strong> Name, email address, phone number, date of birth, and profile photo when you create an account.</li>
<li><strong>Fitness Data:</strong> Health metrics, workout history, training schedules, performance data, and fitness goals you voluntarily provide.</li>
<li><strong>Usage Data:</strong> Information about how you interact with our Platform, including features used, time spent, and navigation patterns.</li>
<li><strong>Device Information:</strong> Device type, operating system, unique device identifiers, and mobile network information.</li>
<li><strong>Location Data:</strong> General location (city/region) for providing localized content and services.</li>
</ul>

<h3>3. How We Use Your Information</h3>
<p>We use the information we collect to:</p>
<ul>
<li>Provide, maintain, and improve our Platform and services</li>
<li>Personalize your experience and deliver tailored content</li>
<li>Match you with appropriate coaches based on your fitness goals</li>
<li>Track your progress and provide analytics and insights</li>
<li>Communicate with you about updates, support, and promotional materials</li>
<li>Respond to your comments, questions, and provide customer service</li>
<li>Detect, prevent, and address fraudulent activities and security issues</li>
<li>Comply with legal obligations and enforce our terms</li>
</ul>

<h3>4. Data Sharing and Disclosure</h3>
<p>We may share your information in the following circumstances:</p>
<ul>
<li><strong>With Coaches:</strong> When you opt-in to coaching services, we share relevant fitness data with assigned coaches to provide personalized guidance.</li>
<li><strong>Service Providers:</strong> With third-party vendors who perform services on our behalf (e.g., hosting, analytics, payment processing).</li>
<li><strong>Legal Requirements:</strong> When required by law, regulation, or legal process.</li>
<li><strong>Business Transfers:</strong> In connection with a merger, sale, or transfer of company assets.</li>
<li><strong>With Your Consent:</strong> For any other purpose disclosed at the time you provide information.</li>
</ul>
<p>We do <strong>not</strong> sell your personal information to third parties.</p>

<h3>5. Cookies and Tracking Technologies</h3>
<p>We use cookies and similar tracking technologies to:</p>
<ul>
<li>Keep you logged in and remember your preferences</li>
<li>Understand how you use our Platform</li>
<li>Improve our services and user experience</li>
<li>Deliver relevant advertisements</li>
</ul>
<p>You can control cookies through your browser settings. However, disabling cookies may affect certain features of our Platform.</p>

<h3>6. Data Security</h3>
<p>We implement appropriate technical and organizational measures to protect your personal information, including:</p>
<ul>
<li>Encryption of data in transit and at rest</li>
<li>Regular security audits and vulnerability assessments</li>
<li>Access controls and authentication mechanisms</li>
<li>Employee training on data protection</li>
</ul>
<p>While we strive to protect your information, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.</p>

<h3>7. Data Retention</h3>
<p>We retain your personal information for as long as your account is active or as needed to provide services. You may request deletion of your data at any time. After account deletion, we may retain certain information as required by law or for legitimate business purposes.</p>

<h3>8. Your Rights and Choices</h3>
<p>You have the following rights regarding your personal information:</p>
<ul>
<li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
<li><strong>Correction:</strong> Request correction of inaccurate or incomplete data</li>
<li><strong>Deletion:</strong> Request deletion of your personal information ("Right to be Forgotten")</li>
<li><strong>Data Portability:</strong> Request your data in a structured, machine-readable format</li>
<li><strong>Opt-Out:</strong> Unsubscribe from promotional communications at any time</li>
<li><strong>Restriction:</strong> Request restriction of processing under certain circumstances</li>
</ul>
<p>To exercise these rights, contact us at privacy@pathfit.ai.</p>

<h3>9. Children\'s Privacy</h3>
<p>Our Platform is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child under 13, please contact us immediately.</p>

<h3>10. Third-Party Links</h3>
<p>Our Platform may contain links to third-party websites, services, or applications. We are not responsible for the privacy practices of these third parties. We encourage you to review the privacy policies of any third-party sites you visit.</p>

<h3>11. Changes to This Privacy Policy</h3>
<p>We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on this page and updating the "Last Updated" date. Your continued use of the Platform after such changes constitutes acceptance of the new terms.</p>

<h3>12. Contact Us</h3>
<p>If you have any questions, concerns, or complaints about this Privacy Policy or our data practices, please contact us:</p>
<ul>
<li><strong>Email:</strong> privacy@pathfit.ai</li>
<li><strong>Address:</strong> PathFit AI, [Company Address]</li>
<li><strong>Phone:</strong> [Contact Number]</li>
</ul>
<p>We will respond to your inquiry within 30 days.</p>
</div>';
    }

    private function getDefaultContent($slug)
    {
        $contents = [
            'features' => '<h2>Features</h2><p>Discover the powerful features that make PathFit AI the ultimate fitness companion.</p><ul><li>Personalized AI workout plans</li><li>Real-time analytics</li><li>Expert coach matching</li><li>Nutrition tracking</li><li>Video workout library</li></ul>',
            'pricing' => '<h2>Pricing</h2><p>Choose the plan that fits your fitness goals.</p><ul><li><strong>Basic</strong> - Free</li><li><strong>Pro</strong> - $9.99/month</li><li><strong>Premium</strong> - $19.99/month</li></ul>',
            'coaches' => '<h2>Our Coaches</h2><p>Meet our team of certified professional coaches.</p>',
            'workouts' => '<h2>Workouts</h2><p>Access thousands of workouts designed by fitness experts.</p>',
            'mobile-app' => '<h2>Mobile App</h2><p>Take your fitness anywhere with our mobile app.</p>',
            'about-us' => '<h2>About Us</h2><p>PathFit AI is revolutionizing fitness through AI-powered training.</p>',
            'careers' => '<h2>Careers</h2><p>Join our team and help shape the future of fitness.</p>',
            'blog' => '<h2>Blog</h2><p>Stay updated with the latest fitness tips and news.</p>',
            'press-kit' => '<h2>Press Kit</h2><p>Download our press kit for media information.</p>',
            'partners' => '<h2>Partners</h2><p>Learn about partnership opportunities.</p>',
            'help-center' => '<h2>Help Center</h2><p>Find answers to common questions.</p>',
            'video-tutorials' => '<h2>Video Tutorials</h2><p>Learn how to use PathFit AI effectively.</p>',
            'community' => '<h2>Community</h2><p>Connect with fitness enthusiasts.</p>',
            'success-stories' => '<h2>Success Stories</h2><p>Inspiring stories from our community.</p>',
            'api-docs' => '<h2>API Documentation</h2><p>Integrate with PathFit AI.</p>',
            'privacy-policy' => $this->getPrivacyPolicyContent(),
            'terms-of-service' => '<h2>Terms of Service</h2><p>By using PathFit AI, you agree to our terms.</p>',
            'cookie-policy' => '<h2>Cookie Policy</h2><p>We use cookies to enhance your experience.</p>',
            'disclaimer' => '<h2>Disclaimer</h2><p>Information provided is for general purposes only.</p>',
            'contact' => '<h2>Contact Us</h2><p>Email: support@pathfit.ai</p>',
        ];

        return $contents[$slug] ?? '<h2>' . ucwords(str_replace('-', ' ', $slug)) . '</h2><p>This page is under construction.</p>';
    }
}


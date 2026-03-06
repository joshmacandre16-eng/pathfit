<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WelcomeContent;

class WelcomeContentSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        $heroContents = [
            ['key' => 'badge_text', 'value' => 'AI-Powered Fitness Platform', 'order' => 1],
            ['key' => 'title', 'value' => 'Your AI-Powered', 'order' => 2],
            ['key' => 'gradient_text', 'value' => 'Fitness Journey', 'order' => 3],
            ['key' => 'subtitle', 'value' => 'Experience personalized workout plans, intelligent progress tracking, and adaptive training powered by advanced artificial intelligence', 'order' => 4],
            ['key' => 'feature_1', 'value' => 'Personalized Plans', 'order' => 5],
            ['key' => 'feature_2', 'value' => 'Real-time Coaching', 'order' => 6],
            ['key' => 'feature_3', 'value' => 'Progress Analytics', 'order' => 7],
            ['key' => 'hero_image', 'value' => '', 'order' => 8],
        ];

        foreach ($heroContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'hero', 'key' => $content['key']],
                $content
            );
        }

        // Features Section
        $featuresContents = [
            ['key' => 'section_tag', 'value' => 'FEATURES', 'order' => 1],
            ['key' => 'section_title', 'value' => 'Everything You Need to Succeed', 'order' => 2],
            ['key' => 'section_subtitle', 'value' => 'Powered by advanced AI technology to deliver personalized fitness experiences that actually work.', 'order' => 3],
            ['key' => 'feature_1_title', 'value' => 'Smart Workout Plans', 'order' => 4],
            ['key' => 'feature_1_description', 'value' => 'AI-generated programs tailored to your fitness level, goals, and available equipment. Adapts in real-time based on your performance.', 'order' => 5],
            ['key' => 'feature_2_title', 'value' => 'Real-Time Analytics', 'order' => 6],
            ['key' => 'feature_2_description', 'value' => 'Track every metric that matters with comprehensive analytics and insights to optimize your training.', 'order' => 7],
            ['key' => 'feature_3_title', 'value' => 'Expert Coaching', 'order' => 8],
            ['key' => 'feature_3_description', 'value' => 'Get guidance from certified trainers and AI-powered form corrections to ensure safe, effective workouts.', 'order' => 9],
            ['key' => 'feature_4_title', 'value' => 'Nutrition Guidance', 'order' => 10],
            ['key' => 'feature_4_description', 'value' => 'Personalized meal plans and nutrition tracking integrated with your training program for optimal results.', 'order' => 11],
            ['key' => 'feature_5_title', 'value' => 'Progress Tracking', 'order' => 12],
            ['key' => 'feature_5_description', 'value' => 'Visualize your journey with detailed progress charts, milestone tracking, and achievement badges.', 'order' => 13],
            ['key' => 'feature_6_title', 'value' => 'Video Workouts', 'order' => 14],
            ['key' => 'feature_6_description', 'value' => 'Access thousands of HD workout videos with detailed instructions and multiple camera angles.', 'order' => 15],
        ];

        foreach ($featuresContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'features', 'key' => $content['key']],
                $content
            );
        }

        // How It Works Section
        $howItWorksContents = [
            ['key' => 'section_tag', 'value' => 'HOW IT WORKS', 'order' => 1],
            ['key' => 'section_title', 'value' => 'Get Started in 4 Simple Steps', 'order' => 2],
            ['key' => 'section_subtitle', 'value' => 'Begin your transformation journey with our streamlined onboarding process.', 'order' => 3],
            ['key' => 'step_1_title', 'value' => 'Create Your Profile', 'order' => 4],
            ['key' => 'step_1_description', 'value' => 'Tell us about your fitness level, goals, and preferences to personalize your experience.', 'order' => 5],
            ['key' => 'step_2_title', 'value' => 'Get Your AI Plan', 'order' => 6],
            ['key' => 'step_2_description', 'value' => 'Our AI analyzes your data and generates a customized workout and nutrition plan just for you.', 'order' => 7],
            ['key' => 'step_3_title', 'value' => 'Start Training', 'order' => 8],
            ['key' => 'step_3_description', 'value' => 'Follow guided workouts with real-time feedback and form corrections from our AI coach.', 'order' => 9],
            ['key' => 'step_4_title', 'value' => 'Track Progress', 'order' => 10],
            ['key' => 'step_4_description', 'value' => 'Monitor your improvements, celebrate milestones, and watch your plan adapt as you grow.', 'order' => 11],
        ];

        foreach ($howItWorksContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'how_it_works', 'key' => $content['key']],
                $content
            );
        }

        // Coaches Section
        $coachesContents = [
            ['key' => 'section_tag', 'value' => 'OUR TEAM', 'order' => 1],
            ['key' => 'section_title', 'value' => 'Train with Expert Coaches', 'order' => 2],
            ['key' => 'section_subtitle', 'value' => 'Learn from certified professionals who specialize in different areas of fitness and wellness.', 'order' => 3],
        ];

        foreach ($coachesContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'coaches', 'key' => $content['key']],
                $content
            );
        }

        // CTA Section
        $ctaContents = [
            ['key' => 'title', 'value' => 'Ready to Transform Your Fitness?', 'order' => 1],
            ['key' => 'subtitle', 'value' => 'Join thousands of athletes who have already transformed their fitness with PathFit AI', 'order' => 2],
        ];

        foreach ($ctaContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'cta', 'key' => $content['key']],
                $content
            );
        }

        // Footer Section
        $footerContents = [
            ['key' => 'brand_name', 'value' => 'PathFit AI', 'order' => 1],
            ['key' => 'description', 'value' => 'Revolutionizing fitness through AI-powered training and personalized coaching for athletes of all levels.', 'order' => 2],
            ['key' => 'product_title', 'value' => 'Product', 'order' => 3],
            ['key' => 'company_title', 'value' => 'Company', 'order' => 4],
            ['key' => 'resources_title', 'value' => 'Resources', 'order' => 5],
            ['key' => 'legal_title', 'value' => 'Legal', 'order' => 6],
            ['key' => 'copyright', 'value' => '© 2024 PathFit AI. All rights reserved. Powered by advanced artificial intelligence.', 'order' => 7],
        ];

        foreach ($footerContents as $content) {
            WelcomeContent::updateOrCreate(
                ['section' => 'footer', 'key' => $content['key']],
                $content
            );
        }
    }
}


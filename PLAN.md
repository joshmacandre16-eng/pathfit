# Footer CRUD Implementation Plan

## Information Gathered

- The project uses WelcomeContent model with section/key/value pattern
- WelcomeContentController already has full CRUD (index, edit, update, store, destroy)
- Footer section currently has basic fields in seeder: brand_name, description, product_title, company_title, resources_title, legal_title, copyright
- The welcome.blade.php displays hardcoded footer content instead of using database values

## Plan

### Step 1: Update Database Seeder

Add comprehensive footer content to WelcomeContentSeeder:

- Product links (features, pricing, coaches, workouts, mobile app)
- Company links (about us, careers, blog, press kit, partners)
- Resources links (help center, video tutorials, community, success stories, api docs)
- Legal links (privacy policy, terms of service, cookie policy, disclaimer, contact)
- Social media links (facebook, twitter, instagram, linkedin)

### Step 2: Update Admin Edit View

Modify resources/views/admin/welcome-content/edit.blade.php:

- Add footer link fields for each column
- Add social media link fields
- Group links properly for better UX

### Step 3: Update Welcome Page View

Modify resources/views/welcome.blade.php:

- Update footer section to use dynamic data from $welcomeData
- Make footer links dynamic
- Make social media links dynamic
- Display footer content from database

### Step 4: Run Migrations/Seeders

Run the seeder to populate footer data:

```
php artisan db:seed --class=WelcomeContentSeeder
```

## Dependent Files to Edit

1. database/seeders/WelcomeContentSeeder.php
2. resources/views/admin/welcome-content/edit.blade.php
3. resources/views/welcome.blade.php

## Followup Steps

1. Clear cache: php artisan cache:clear
2. Clear config: php artisan config:clear
3. View the welcome page to verify footer displays correctly
4. Access admin panel to test editing footer content

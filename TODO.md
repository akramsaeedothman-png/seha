# TODO List for Seha Portal Design Update

## 1. Update frontend/index.html
- [x] Add meta tags, links for Cairo font, icons, and jQuery.
- [x] Update head with title, description, and favicon.
- [x] Replace nav with fixed header including logo, navigation links, and sidebar toggle button.
- [x] Add sidebar overlay and sidebar with navigation and login button.
- [x] Update main content to use "inner-page" class, with heading, subheading, and form inside a row.
- [x] Modify form to match the provided page: two input fields (service_code, identity_number), search button, and results display below.
- [x] Add footer with about section, links, contact, and note.

## 2. Update frontend/style.css
- [x] Add Cairo font definitions (local and Google Fonts).
- [x] Update color variables to match Seha colors (primary blue, etc.).
- [x] Add styles for fixed header, sidebar, footer, and responsive layouts.
- [x] Ensure RTL direction and Cairo font application.
- [x] Add mobile-specific styles for sidebar and content adjustments.

## 3. Update frontend/script.js
- [x] Add sidebar toggle functionality (open/close, close on link click or overlay).
- [x] Update handleQuery to display results below the form (similar to provided page), using fetch.
- [x] Add logout functionality for add-leave.html (clear localStorage and redirect to index.html).

## 4. Update frontend/add-leave.html
- [x] Update form to include all required fields: serviceCode, nationalID, patientFullName, creationDate, startDate, endDate, durationDays, doctorName, jobTitle.
- [x] Set date inputs to format "يوم-شهر-سنة" (use placeholders or JS to format).
- [x] Add logout button that redirects to index.html.
- [x] Ensure form submits to backend and handles success/error.

## 5. Testing and Follow-up
- [ ] Test pages locally (run backend server if needed).
- [ ] Check responsiveness on mobile and desktop.
- [ ] Verify sidebar functionality, form submissions, and date formats.
- [ ] Make adjustments based on testing.

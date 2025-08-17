# 🏥 HomeCare - Marketplace Booking Bidan

## 📋 Project Overview
HomeCare adalah platform marketplace untuk booking layanan bidan dengan sistem escrow payment dan manajemen layanan kesehatan ibu dan anak.

## 🛠 Tech Stack
- **Backend**: Laravel 12 + PHP 8.2
- **Frontend**: Livewire + Volt + Flux UI
- **Database**: SQLite (development) / MySQL (production)
- **Styling**: TailwindCSS 4.x
- **Build Tool**: Vite 7.x
- **Testing**: PHPUnit

## 👥 User Roles & Authentication
### Roles:
1. **Pasien** - Pencari layanan bidan
2. **Bidan** - Penyedia layanan dengan verifikasi khusus
3. **Admin** - Pengelola platform

### Authentication Features:
- Email verification required
- Role-based access control
- Profile management per role

## 🏗 Database Schema Design

### Core Tables:
```sql
-- User roles
users: id, name, email, password, role_enum, email_verified_at, created_at, updated_at

-- Bidan profiles dengan verifikasi
bidan_profiles: id, user_id, license_number, license_file, verification_status, 
province_id, regency_id, district_id, village_id, detailed_address, 
google_maps_link, bio, experience_years, certification_files, 
is_approved, approved_at, approved_by, created_at, updated_at

-- Pasien profiles
patient_profiles: id, user_id, birth_date, phone, emergency_contact_name, 
emergency_contact_phone, medical_history, created_at, updated_at

-- Layanan yang ditawarkan bidan (dinamis)
bidan_services: id, bidan_id, service_name, description, price, duration_minutes, 
service_type_enum (home_visit/clinic), is_active, created_at, updated_at

-- Availability calendar
bidan_availability: id, bidan_id, date, start_time, end_time, is_available, 
created_at, updated_at

-- Portfolio/galeri bidan
bidan_galleries: id, bidan_id, image_path, caption, order_number, created_at, updated_at

-- Booking system
bookings: id, patient_id, bidan_id, service_id, booking_date, booking_time, 
total_amount, platform_fee (10%), bidan_amount, payment_status_enum, 
booking_status_enum, location_type_enum, patient_address, 
province_id, regency_id, district_id, village_id, notes, 
created_at, updated_at, cancelled_at, rescheduled_from

-- Escrow payment system
payments: id, booking_id, amount, platform_fee, payment_method, 
payment_gateway_response, paid_at, released_to_bidan_at, refunded_at, 
created_at, updated_at

-- Rating & review system
reviews: id, booking_id, patient_id, bidan_id, rating (1-5), review_text, 
is_anonymous, created_at, updated_at

-- Medical records
medical_records: id, patient_id, bidan_id, booking_id, record_date, 
diagnosis, treatment, recommendations, follow_up_date, created_at, updated_at

-- Chat/messaging system
conversations: id, booking_id, created_at, updated_at
messages: id, conversation_id, sender_id, message_text, sent_at, read_at

-- Notifications
notifications: id, user_id, type, title, message, data_json, read_at, created_at
```

## 🌍 External API Integration
### Wilayah Indonesia API
- **Purpose**: Master data wilayah Indonesia (Provinsi → Kabupaten → Kecamatan → Desa)
- **Storage**: Hanya simpan ID wilayah di database lokal
- **Implementation**: Service class untuk fetch data wilayah real-time

## 💰 Payment & Commission System
### Commission Model:
- Platform fee: **10%** dari setiap transaksi
- Automatic calculation saat booking
- Escrow system untuk keamanan pembayaran

### Payment Flow:
1. Pasien bayar total (harga layanan + fee platform)
2. Dana disimpan dalam escrow
3. Setelah layanan selesai → dana release ke bidan
4. Sistem cancellation/refund tersedia

## 🔧 Core Features Implementation

### 1. Bidan Registration & Verification
```php
// app/Livewire/Bidan/Registration.php
- Upload license document
- Automatic verification workflow
- Admin approval system
```

### 2. Service Management (Dynamic)
```php
// app/Livewire/Bidan/ServiceManagement.php
- CRUD layanan per bidan
- Pricing management
- Service type (home visit/clinic)
```

### 3. Booking System
```php
// app/Livewire/Booking/BookingFlow.php
- Slot-based availability checking
- Real-time calendar integration
- Cancellation & reschedule system
```

### 4. Chat System
```php
// app/Livewire/Chat/ConversationManager.php
- Real-time messaging (Livewire polling)
- Booking-based conversations
- Message history
```

### 5. Reviews & Ratings
```php
// app/Livewire/Reviews/ReviewSystem.php
- Post-service rating
- Anonymous review option
- Bidan rating aggregation
```

## 🔒 Security & Privacy

### Medical Data Protection:
- Encrypt sensitive medical data
- Role-based access control
- Audit trail untuk akses data medis

### GDPR Compliance:
- Data portability (export patient data)
- Right to be forgotten (anonymize data)
- Consent management
- Data retention policies

### Encryption:
```php
// config/app.php
'cipher' => 'AES-256-CBC'

// Sensitive fields
protected $casts = [
    'medical_history' => 'encrypted',
    'emergency_contact' => 'encrypted'
];
```

## 📊 Analytics & Reporting

### Admin Dashboard:
- Total bookings, revenue, active users
- Bidan performance metrics
- Patient satisfaction trends
- Financial reports

### Bidan Dashboard:
- Earnings summary
- Booking statistics
- Rating trends
- Calendar management

### Patient Dashboard:
- Booking history
- Medical records access
- Upcoming appointments

## 🧪 Testing Strategy
```bash
# Test commands
composer run test
php artisan test --coverage
```

### Test Coverage:
- Unit tests untuk business logic
- Feature tests untuk booking flow
- Browser tests untuk critical user journeys

## 🚀 Development Workflow

### Environment Setup:
```bash
# Development server
composer run dev  # Runs Laravel + Queue + Logs + Vite concurrently

# Database
php artisan migrate:fresh --seed
```

### Code Quality:
```bash
# Laravel Pint untuk code formatting
./vendor/bin/pint

# Static analysis
php artisan insights
```

## 📱 UI/UX Guidelines

### Design System:
- Flux UI components
- TailwindCSS utility classes
- Responsive design (mobile-first)
- Dark mode support

### Key User Flows:
1. **Bidan Onboarding**: Registration → Verification → Profile Setup
2. **Patient Booking**: Browse Bidan → Select Service → Choose Slot → Payment
3. **Service Delivery**: Chat → Medical Record → Review

## 🔄 Notification System
### Internal Notifications:
- Booking confirmations
- Payment updates
- Schedule reminders
- Review requests

### Implementation:
```php
// Real-time via Livewire polling
// Database notifications table
// Email notifications untuk critical updates
```

## 📋 Development Priorities

### Phase 1: MVP Core
1. User authentication & roles
2. Bidan registration & verification
3. Basic service management
4. Simple booking system
5. Payment integration

### Phase 2: Enhanced Features
1. Chat system
2. Medical records
3. Advanced calendar
4. Reviews & ratings
5. Analytics dashboard

### Phase 3: Optimization
1. Performance optimization
2. Advanced security features
3. Mobile app considerations
4. API documentation

---

## 🛡 Security Checklist
- [ ] Input validation & sanitization
- [ ] SQL injection prevention
- [ ] XSS protection
- [ ] CSRF protection
- [ ] Rate limiting
- [ ] Medical data encryption
- [ ] Secure file uploads
- [ ] API authentication

## 📚 External Dependencies
- Wilayah Indonesia API
- Payment gateway integration
- Email service provider
- File storage service
- Backup solutions

---
*Last updated: 2025-08-17*
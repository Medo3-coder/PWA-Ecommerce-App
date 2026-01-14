# 🚀 Ecommerce Full Stack PWA - Modern Event-Driven Architecture

This is a **Progressive Web App (PWA)** for an eCommerce platform built with **React (Frontend)** and **Laravel (Backend)**, featuring a modern, scalable architecture with **Event-Driven Design**, **RabbitMQ Message Queue**, **Repository Pattern**, and **Action-based Services**.

## 🎯 Project Architecture Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                    Frontend (React PWA)                          │
│  • Redux State Management                                        │
│  • Real-time Notifications via WebSockets                        │
│  • Offline Support with Service Workers                          │
│  • Responsive & Mobile-First UI                                  │
└────────────────┬────────────────────────────────────────────────┘
                 │
                 ↓ RESTful API (Passport)
┌─────────────────────────────────────────────────────────────────┐
│                    Backend (Laravel 11)                          │
│                                                                   │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │ API Controllers & Routes                                 │   │
│  │ (Authenticated via Passport)                             │   │
│  └──────────────────────────────────────────────────────────┘   │
│                         │                                         │
│  ┌──────────────────────↓──────────────────────────────────┐   │
│  │ Repository Pattern Layer                                │   │
│  │ (Data abstraction & business logic)                      │   │
│  │  • UserRepository    • OrderRepository                   │   │
│  │  • ProductRepository • NotificationRepository            │   │
│  └──────────────────────┬──────────────────────────────────┘   │
│                         │                                         │
│  ┌──────────────────────↓──────────────────────────────────┐   │
│  │ Actions (Domain Logic)                                  │   │
│  │ (Encapsulated business operations)                       │   │
│  │  • CreateOrderAction    • UpdateInventoryAction         │   │
│  │  • ProcessPaymentAction • SendNotificationAction        │   │
│  └──────────────────────┬──────────────────────────────────┘   │
│                         │                                         │
│  ┌──────────────────────↓──────────────────────────────────┐   │
│  │ Events & Event Listeners                                │   │
│  │ (Decoupled event handling)                               │   │
│  │  • OrderCreated → SendNotificationListener               │   │
│  │  • UserRegistered → SendWelcomeListener                  │   │
│  └──────────────────────┬──────────────────────────────────┘   │
│                         │                                         │
│  ┌──────────────────────↓──────────────────────────────────┐   │
│  │ Notification Service (Producer)                         │   │
│  │ (Publishes to RabbitMQ)                                  │   │
│  └──────────────────────┬──────────────────────────────────┘   │
└────────────────────────┼──────────────────────────────────────┘
                         │
                         ↓ AMQP Protocol
┌─────────────────────────────────────────────────────────────────┐
│                    RabbitMQ Message Broker                       │
│                                                                   │
│  Exchanges:                                                      │
│  • notifications.topic (Topic Exchange)                          │
│  • orders.events (Topic Exchange)                                │
│                                                                   │
│  Queues:                                                         │
│  • notifications.email.queue                                     │
│  • notifications.realtime.queue                                  │
│  • notifications.sms.queue                                       │
│  • orders.processing.queue                                       │
│                                                                   │
│  Dead Letter Queue (DLQ):                                        │
│  • notifications.dlq (for failed messages)                       │
└────┬──────────────────┬──────────────────┬──────────────────────┘
     │                  │                  │
     ↓                  ↓                  ↓
┌────────────────┐ ┌──────────────┐ ┌──────────────┐
│ Email Worker   │ │ Realtime     │ │ SMS Worker   │
│                │ │ Worker       │ │              │
│ • Sends emails │ │              │ │ • Sends SMS  │
│ • Logs results │ │ • Broadcasts │ │ • Logs calls │
│ • Retries fail │ │ • WebSocket  │ │ • Retries    │
└────────────────┘ │   messages   │ └──────────────┘
                   │ • Real-time  │
                   │   updates    │
                   └──────────────┘
                         │
                         ↓ Database
                   ┌──────────────┐
                   │ Logs & Audit │
                   │ Data Storage │
                   └──────────────┘
```

---

## ✨ Key Features

### 1. **Event-Driven Architecture**
- 🔥 Decoupled event handling with Laravel Events & Listeners
- 📡 Real-time event propagation via RabbitMQ
- ⚡ Asynchronous processing without blocking user requests
- 🔄 Automatic retry mechanism for failed operations

### 2. **RabbitMQ Notification System** 
- 📧 **Multi-Channel Notifications**: Email, SMS, Real-time (WebSocket), Browser Push
- ⚙️ **Scalable Workers**: Spin up multiple workers for parallel processing
- 💾 **Message Persistence**: Messages survive broker restarts
- 🔁 **Automatic Retries**: Failed messages automatically requeued
- 📊 **Complete Audit Trail**: Every delivery attempt logged
- 👤 **User Preferences**: Users control which notifications they receive

### 3. **Repository Pattern Implementation**
```php
// Clean separation of concerns
// Business Logic → Repository → Database

// Controllers use repositories
$userRepository = new UserRepository();
$users = $userRepository->getAllActive();
$user = $userRepository->findById(1);
$userRepository->update($id, $data);

// Repositories encapsulate queries
// Can swap database drivers without changing business logic
```

### 4. **Actions Pattern**
```php
// Domain-specific business operations
// Each action is a single responsibility

CreateOrderAction::execute($userId, $orderData);
ProcessPaymentAction::execute($orderId, $paymentMethod);
SendNotificationAction::execute($userId, $title, $message);
UpdateInventoryAction::execute($productId, $quantity);

// Benefits:
// • Clear intent (action name explains what happens)
// • Easy to test (single responsibility)
// • Reusable across controllers and console commands
// • Transaction management built-in
```

### 5. **User Authentication & Authorization**
- 🔐 Secure user registration and login
- 🔑 OAuth2 integration via Laravel Passport
- 🛡️ Role-based access control (RBAC)
- 📱 Mobile-friendly authentication

### 6. **Product Management**
- 📦 Full inventory management system
- 🏷️ Advanced filtering, sorting, and search
- ⭐ Product reviews and ratings
- 🎨 Product variants and attributes
- 📊 Admin dashboard for analytics

### 7. **Shopping Experience**
- 🛒 Persistent shopping cart
- 💳 Multiple payment gateway integration (Stripe, PayPal)
- 🎁 Coupon and discount system
- 📦 Order tracking and history
- ❤️ Wishlist functionality

### 8. **PWA Capabilities**
- 📵 Offline-first with Service Workers
- 🔔 Push notifications
- 📲 Installable on home screen
- 🎯 App-like experience on mobile
- ⚡ Optimized performance with code splitting

### 9. **Admin Features**
- 📊 Comprehensive dashboard with analytics
- 👥 User management and segmentation
- 📈 Sales reports and insights
- 🔧 System settings and configuration
- 🚀 SEO optimization tools
- 📋 Content management

### 10. **Testing & Quality**
- ✅ Unit tests for repositories and actions
- 🧪 Feature tests for API endpoints
- 📝 Code coverage tracking
- 🔍 Automated code quality checks

---

## 🏗️ Project Structure

```
PWA-Ecommerce-App/
│
├── backend/                          # Laravel API
│   ├── app/
│   │   ├── Actions/                 # Action classes (business logic)
│   │   │   ├── Orders/
│   │   │   │   ├── CreateOrderAction.php
│   │   │   │   ├── UpdateOrderAction.php
│   │   │   │   └── CancelOrderAction.php
│   │   │   ├── Notifications/
│   │   │   │   └── SendNotificationAction.php
│   │   │   └── Payments/
│   │   │       └── ProcessPaymentAction.php
│   │   │
│   │   ├── Repositories/            # Repository pattern (data access)
│   │   │   ├── Contracts/
│   │   │   │   ├── UserRepositoryContract.php
│   │   │   │   ├── OrderRepositoryContract.php
│   │   │   │   └── ProductRepositoryContract.php
│   │   │   ├── UserRepository.php
│   │   │   ├── OrderRepository.php
│   │   │   ├── ProductRepository.php
│   │   │   └── NotificationRepository.php
│   │   │
│   │   ├── Services/               # Service classes
│   │   │   ├── RabbitMQ/
│   │   │   │   ├── RabbitMQConnection.php
│   │   │   │   ├── RabbitMQProducer.php
│   │   │   │   └── RabbitMQConsumer.php
│   │   │   ├── Notifications/
│   │   │   │   ├── NotificationService.php
│   │   │   │   ├── EmailService.php
│   │   │   │   └── RealtimeService.php
│   │   │   └── Payments/
│   │   │       ├── StripeService.php
│   │   │       └── PayPalService.php
│   │   │
│   │   ├── Events/                 # Event classes
│   │   │   ├── Notifications/
│   │   │   │   ├── OrderCreated.php
│   │   │   │   ├── OrderShipped.php
│   │   │   │   └── PaymentProcessed.php
│   │   │   └── Users/
│   │   │       └── UserRegistered.php
│   │   │
│   │   ├── Listeners/              # Event listeners
│   │   │   ├── Notifications/
│   │   │   │   ├── SendOrderNotification.php
│   │   │   │   └── SendWelcomeEmail.php
│   │   │   └── Orders/
│   │   │       └── UpdateInventory.php
│   │   │
│   │   ├── Console/Commands/       # Console commands
│   │   │   ├── RabbitMQ/
│   │   │   │   └── SetupRabbitMQCommand.php
│   │   │   └── Worker/
│   │   │       ├── EmailWorkerCommand.php
│   │   │       ├── RealtimeWorkerCommand.php
│   │   │       └── SmsWorkerCommand.php
│   │   │
│   │   ├── Http/Controllers/       # API Controllers
│   │   │   ├── API/
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── NotificationController.php
│   │   │   │   └── UserController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       └── AnalyticsController.php
│   │   │
│   │   ├── Models/                 # Eloquent Models
│   │   │   ├── User.php
│   │   │   ├── Order.php
│   │   │   ├── Product.php
│   │   │   ├── Notification.php
│   │   │   ├── NotificationLogs.php
│   │   │   ├── NotificationSettings.php
│   │   │   └── NotificationTemplate.php
│   │   │
│   │   ├── Providers/              # Service providers
│   │   │   ├── RepositoryServiceProvider.php
│   │   │   └── EventServiceProvider.php
│   │   │
│   │   └── Traits/                 # Reusable traits
│   │       ├── HasApiTokens.php
│   │       └── Filterable.php
│   │
│   ├── config/
│   │   ├── rabbitmq.php           # RabbitMQ configuration
│   │   ├── payment.php            # Payment gateway config
│   │   └── notifications.php      # Notification settings
│   │
│   ├── database/
│   │   ├── migrations/            # Database migrations
│   │   ├── seeders/              # Database seeders
│   │   └── factories/            # Model factories for testing
│   │
│   ├── routes/
│   │   ├── api.php               # Public API routes
│   │   └── admin.php             # Admin routes
│   │
│   └── tests/                    # Tests
│       ├── Feature/              # Feature tests
│       └── Unit/                 # Unit tests
│
├── frontend/                       # React PWA
│   ├── src/
│   │   ├── components/
│   │   │   ├── Order/
│   │   │   ├── Product/
│   │   │   ├── Notification/
│   │   │   └── Admin/
│   │   │
│   │   ├── pages/
│   │   │   ├── HomePage.js
│   │   │   ├── ProductPage.js
│   │   │   ├── CheckoutPage.js
│   │   │   └── DashboardPage.js
│   │   │
│   │   ├── redux/
│   │   │   ├── slices/
│   │   │   │   ├── orderSlice.js
│   │   │   │   ├── cartSlice.js
│   │   │   │   └── notificationSlice.js
│   │   │   └── store.js
│   │   │
│   │   ├── services/
│   │   │   ├── api.js           # API client
│   │   │   ├── websocket.js     # WebSocket for real-time
│   │   │   └── auth.js          # Authentication
│   │   │
│   │   ├── hooks/
│   │   │   ├── useNotifications.js
│   │   │   ├── useOrders.js
│   │   │   └── useAuth.js
│   │   │
│   │   ├── utils/
│   │   │   ├── formatters.js
│   │   │   └── validators.js
│   │   │
│   │   └── App.js
│   │
│   └── public/
│       ├── manifest.json         # PWA manifest
│       └── service-worker.js     # Service worker
│
├── docker-compose.yml            # Docker configuration
├── NOTIFICATION_FLOW_DOCUMENTATION.md  # Detailed notification system docs
└── README.md
```

---

## 🚀 Technology Stack

### **Frontend**
| Technology | Purpose |
|-----------|---------|
| **React 18** | UI framework |
| **Redux Toolkit** | State management |
| **React Router v6** | Client-side routing |
| **Axios** | HTTP requests |
| **Socket.io** | Real-time WebSocket communication |
| **Tailwind CSS** | Utility-first styling |
| **Vite** | Fast build tool |

### **Backend**
| Technology | Purpose |
|-----------|---------|
| **Laravel 11** | PHP web framework |
| **MySQL 8** | Relational database |
| **Redis** | Caching & sessions |
| **Laravel Passport** | OAuth2 API authentication |
| **RabbitMQ 3.12** | Message queue broker |
| **PHP-AMQP-Lib** | RabbitMQ client library |

### **DevOps & Tools**
| Technology | Purpose |
|-----------|---------|
| **Docker** | Containerization |
| **Docker Compose** | Multi-container orchestration |
| **Nginx** | Web server / reverse proxy |
| **Git** | Version control |
| **PHPUnit** | Testing framework |
| **Laravel Horizon** | Queue monitoring |

### **External Services**
| Service | Purpose |
|---------|---------|
| **Stripe** | Payment processing |
| **SendGrid** | Email delivery |
| **AWS S3** | File storage |
| **Firebase** | Push notifications |

---

## 🔄 Architecture Patterns Used

### **1. Repository Pattern**
```php
// Abstraction layer between business logic and database
interface UserRepositoryContract {
    public function all();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
}

class UserRepository implements UserRepositoryContract {
    protected $model = User::class;
    
    public function all() { return $this->model::all(); }
    public function findById($id) { return $this->model::find($id); }
}

// Benefits:
// ✅ Easy to switch databases (MySQL → MongoDB)
// ✅ Easy to mock in tests
// ✅ Centralized query logic
// ✅ No query logic in controllers
```

### **2. Action Pattern**
```php
// Domain-specific operation encapsulation
class CreateOrderAction {
    public static function execute($userId, array $data) {
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $data['total'],
                'status' => 'pending',
            ]);
            
            // Add order items
            foreach ($data['items'] as $item) {
                $order->items()->create($item);
            }
            
            // Dispatch event (triggers notification)
            event(new OrderCreated($order));
            
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

// Usage in controller:
$order = CreateOrderAction::execute($userId, $orderData);

// Benefits:
// ✅ Single responsibility
// ✅ Easy to test
// ✅ Transaction management built-in
// ✅ Reusable across console commands
```

### **3. Event-Driven Architecture**
```php
// Event dispatcher
OrderCreated::dispatch($order);

// Automatic listener invocation
// ↓
SendOrderCreatedNotification listener triggers
// ↓
NotificationService publishes to RabbitMQ
// ↓
Workers process in background
```

### **4. Service Layer**
```php
// Business logic encapsulation
class OrderService {
    private OrderRepository $repository;
    private NotificationService $notificationService;
    
    public function createOrder($userId, $data) {
        $order = CreateOrderAction::execute($userId, $data);
        
        // Notify user asynchronously
        $this->notificationService->sendNotification(
            $order->user_id,
            'Order Confirmation',
            "Your order #{$order->order_number} has been received"
        );
        
        return $order;
    }
}
```

---

## 📊 Data Flow Example: Placing an Order

```
1️⃣ Frontend (React)
   User fills order form
   ↓
2️⃣ HTTP POST /api/orders
   Authenticated with Passport token
   ↓
3️⃣ OrderController
   Validates input
   Calls CreateOrderAction::execute()
   ↓
4️⃣ CreateOrderAction
   Uses OrderRepository to save to database
   Dispatches OrderCreated event
   Returns order with 200 OK
   ↓
5️⃣ Frontend receives response (~100ms)
   Shows success message to user ✅
   
   Meanwhile, in background:
   
6️⃣ Event Listener (SendOrderCreatedNotification)
   Triggered automatically by OrderCreated event
   Calls NotificationService
   ↓
7️⃣ NotificationService
   Creates notification record
   Checks user preferences
   Publishes messages to RabbitMQ queues
   ↓
8️⃣ RabbitMQ Broker
   Routes messages to appropriate queues
   Email queue, SMS queue, Realtime queue
   ↓
9️⃣ Worker Processes (running in background)
   Email Worker → Sends email (50-100ms)
   SMS Worker → Sends SMS (100-200ms)
   Realtime Worker → Broadcasts to browser (10-20ms)
   ↓
🔟 User receives notifications
   Email: In inbox after few seconds
   SMS: Delivered to phone
   Browser: Real-time notification immediately
```

---

## 🚀 Getting Started

### **Prerequisites**
- Docker & Docker Compose
- PHP 8.2+ (for local development)
- Node.js 18+
- Composer
- MySQL client (optional)

### **Installation**

```bash
# 1. Clone repository
git clone <repository-url>
cd PWA-Ecommerce-App

# 2. Setup backend
cd backend
composer install
cp .env.example .env
php artisan key:generate

# 3. Setup database
docker-compose up -d mysql
php artisan migrate
php artisan db:seed

# 4. Setup RabbitMQ
docker-compose up -d rabbitmq

# 5. Start workers (in separate terminals)
php artisan worker:email
php artisan worker:realtime
php artisan worker:sms

# 6. Setup frontend
cd ../frontend
npm install
npm run dev
```

### **Running the Application**

```bash
# Start all services
docker-compose up -d

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Start Laravel dev server
php artisan serve

# Start React dev server
npm run dev
```

---

## 📖 Documentation

- **[Notification System Flow](./NOTIFICATION_FLOW_DOCUMENTATION.md)** - Complete guide to RabbitMQ notification system
- **[API Documentation](./backend/README.md)** - API endpoints and usage
- **[Frontend Setup](./frontend/README.md)** - React PWA setup guide

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/OrderControllerTest.php

# Run with coverage
php artisan test --coverage

# Run only unit tests
php artisan test --filter Unit
```

---

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ XSS prevention with escaping
- ✅ SQL injection prevention with parameterized queries
- ✅ Password hashing with bcrypt
- ✅ OAuth2 token-based authentication
- ✅ Rate limiting on API endpoints
- ✅ Input validation on all endpoints
- ✅ HTTPS only in production
- ✅ Secure headers (HSTS, CSP, etc.)
- ✅ Data encryption for sensitive fields

---

## 📈 Performance Optimization

- ✅ Database query optimization with indexes
- ✅ Eager loading relationships (N+1 prevention)
- ✅ Redis caching for frequently accessed data
- ✅ Code splitting and lazy loading in React
- ✅ Service worker caching strategies
- ✅ CDN integration for static assets
- ✅ Database connection pooling
- ✅ Horizontal scaling with worker processes

---

## 🤝 Contributing

1. Create a feature branch (`git checkout -b feature/amazing-feature`)
2. Commit changes (`git commit -m 'Add amazing feature'`)
3. Push to branch (`git push origin feature/amazing-feature`)
4. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see LICENSE file for details.

---

## 📧 Support

For questions or issues, please create an issue in the repository or contact the development team.

---

**Built with ❤️ using modern web technologies**

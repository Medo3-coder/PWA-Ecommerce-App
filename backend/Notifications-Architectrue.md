- 
┌─────────────────────────────────────────────────────────────────────┐
│                          USER REQUEST                                 │
│  (Create Order / Trigger Notification Event)                          │
└────────────────────┬────────────────────────────────────────────────┘
                     │
                     ▼
        ┌──────────────────────────┐
        │  Laravel Controller      │
        │  (OrderController)       │
        └──────────────┬───────────┘
                       │
                       ▼
        ┌──────────────────────────────────┐
        │  Event Dispatcher                │
        │  (OrderCreated Event)            │
        │  - Does NOT wait for notification│
        │  - Returns immediately to user   │
        └──────────────┬───────────────────┘
                       │
                       ▼
        ┌──────────────────────────────────┐
        │  Event Listener / Producer       │
        │  (NotificationProducer)          │
        │  - Creates Message               │
        │  - Publishes to RabbitMQ         │
        └──────────────┬───────────────────┘
                       │
                       ▼
        ┌─────────────────────────────────────────────────────────────┐
        │              RABBITMQ (Message Broker)                       │
        │  ┌──────────────────────────────────────────────────┐       │
        │  │  Exchanges                                        │       │
        │  │  - notifications.topic                            │       │
        │  │  - emails.direct                                  │       │
        │  │  - realtime.fanout                                │       │
        │  └──────────────────────────────────────────────────┘       │
        │  ┌──────────────────────────────────────────────────┐       │
        │  │  Queues                                           │       │
        │  │  - notifications.email.queue     (Email Worker)  │       │
        │  │  - notifications.sms.queue       (SMS Worker)    │       │
        │  │  - notifications.realtime.queue  (WebSocket)     │       │
        │  │  - notifications.database.queue  (DB Storage)    │       │
        │  └──────────────────────────────────────────────────┘       │
        │  ┌──────────────────────────────────────────────────┐       │
        │  │  DLQ (Dead Letter Queue)                          │       │
        │  │  - Handle failed messages                         │       │
        │  └──────────────────────────────────────────────────┘       │
        └─┬─────────────────────────┬──────────────────────┬──────────┘
          │                         │                      │
    ┌─────▼──────┐        ┌────────▼────────┐    ┌────────▼─────────┐
    │   EMAIL     │        │  REALTIME       │    │  DATABASE        │
    │   WORKER    │        │  WORKER         │    │  WORKER          │
    │             │        │                 │    │                  │
    │ (Mailer)    │        │ (WebSocket /    │    │ (Save to DB)     │
    │             │        │  Redis Pub/Sub) │    │                  │
    │ php-mail    │        │                 │    │                  │
    │ Mailgun     │        │ Broadcasting:   │    │ Laravel DB        │
    │ SendGrid    │        │ - Pusher        │    │                  │
    │ AWS SES     │        │ - Socket.io     │    │ Users Table       │
    └─────┬───────┘        └────────┬────────┘    └────────┬─────────┘
          │                         │                      │
          ▼                         ▼                      ▼
    [Email Sent]          [Browser Notification]   [Notification Record]
    [Log & Status]        [Real-time Alert]         [Tracking]


backend/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       ├── Worker/
│   │       │   ├── EmailWorkerCommand.php
│   │       │   ├── RealtimeWorkerCommand.php
│   │       │   ├── SmsWorkerCommand.php
│   │       │   └── DatabaseWorkerCommand.php
│   │       └── RabbitMQ/
│   │           └── SetupRabbitMQCommand.php
│   │
│   ├── Events/
│   │   ├── Notifications/
│   │   │   ├── OrderCreatedEvent.php
│   │   │   ├── OrderShippedEvent.php
│   │   │   ├── OrderDeliveredEvent.php
│   │   │   └── PromotionalEvent.php
│   │
│   ├── Listeners/
│   │   ├── Notifications/
│   │   │   ├── OrderCreatedListener.php
│   │   │   ├── OrderShippedListener.php
│   │   │   └── SendNotificationListener.php
│   │
│   ├── Jobs/
│   │   └── (Laravel Queues - Optional alternative to RabbitMQ)
│   │       ├── SendEmailJob.php
│   │       ├── SendSmsJob.php
│   │       └── SendRealtimeNotificationJob.php
│   │
│   ├── Services/
│   │   ├── RabbitMQ/
│   │   │   ├── RabbitMQConnection.php      (Manages connection pool)
│   │   │   ├── RabbitMQProducer.php        (Publishes messages)
│   │   │   ├── RabbitMQConsumer.php        (Consumes messages)
│   │   │   └── RabbitMQConfig.php          (Configuration)
│   │   │
│   │   ├── Notifications/
│   │   │   ├── NotificationService.php     (Orchestrator)
│   │   │   ├── EmailService.php            (Send emails)
│   │   │   ├── SmsService.php              (Send SMS)
│   │   │   ├── RealtimeService.php         (WebSocket broadcasts)
│   │   │   └── NotificationBuilder.php     (Build messages)
│   │   │
│   │   └── Queue/
│   │       ├── MessageProducer.php
│   │       └── MessageConsumer.php
│   │
│   ├── Models/
│   │   ├── Notification.php                (Track all notifications)
│   │   ├── NotificationLog.php             (Store delivery attempts)
│   │   ├── NotificationTemplate.php        (Email templates)
│   │   └── NotificationSetting.php         (User preferences)
│   │
│   ├── Repositories/
│   │   ├── Contracts/
│   │   │   └── NotificationRepositoryInterface.php
│   │   └── Eloquent/
│   │       └── NotificationRepository.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       └── NotificationController.php (API endpoints)
│   │   │
│   │   ├── Resources/
│   │   │   └── NotificationResource.php
│   │   │
│   │   └── Requests/
│   │       └── NotificationRequest.php
│   │
│   ├── Channels/
│   │   └── RabbitMQChannel.php             (Laravel broadcast channel)
│   │
│   ├── Broadcasting/
│   │   └── NotificationBroadcast.php
│   │
│   ├── Exceptions/
│   │   ├── RabbitMQException.php
│   │   ├── NotificationException.php
│   │   └── FailedMessageException.php
│   │
│   └── Providers/
│       ├── NotificationServiceProvider.php  (Register services)
│       └── EventServiceProvider.php         (Register listeners)
│
├── config/
│   ├── rabbitmq.php                        (RabbitMQ config)
│   ├── notifications.php                   (Notification types)
│   └── queue.php                           (Queue driver settings)
│
├── database/
│   ├── migrations/
│   │   ├── [timestamp]_create_notifications_table.php
│   │   ├── [timestamp]_create_notification_logs_table.php
│   │   ├── [timestamp]_create_notification_templates_table.php
│   │   └── [timestamp]_create_notification_settings_table.php
│   │
│   └── seeders/
│       └── NotificationTemplateSeeder.php
│
├── routes/
│   └── api.php                             (Notification endpoints)
│
└── storage/
    └── notifications/                      (Backup & logs)
        ├── failed/                         (Failed messages)
        └── sent/                           (Sent history)

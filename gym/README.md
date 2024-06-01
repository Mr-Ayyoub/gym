# My Gym App

Welcome to My Gym, your go-to application for managing and enhancing your fitness journey.

## Overview

"My Gym" is a full-stack web application built on Laravel, offering expressive and elegant syntax for an enjoyable creative experience. Developed as part of the advanced Laravel course by Shruti Balasa, this app incorporates a range of advanced Laravel features to provide a robust fitness management solution.

## Application Overview

"My Gym" caters to two primary user roles:

1. **Instructors:** They can schedule fitness classes.
2. **Members:** They can book classes scheduled by instructors.

This application provides a practical implementation of the concepts covered in the course, demonstrating how to build a feature-rich Laravel application with multiple user roles and advanced functionalities.

Feel free to explore the codebase, leverage the features, and customize it to meet your specific requirements.

## Getting Started

To quickly set up and run "My Gym" on your local environment, follow these steps:

1. Clone the repository:

    ```bash
    git clone https://github.com/edriso/my-gym.git
    ```

2. Navigate to the project directory:

    ```bash
    cd my-gym
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Copy the example environment file and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

5. Create a MySQL database using the name specified in the `.env` file (`DB_DATABASE` variable).

6. Run database migrations to set up the necessary tables:

    ```bash
    php artisan migrate
    ```

7. Install JavaScript dependencies and compile assets:

    ```bash
    npm install && npm run dev
    ```

8. In a separate terminal, start the Laravel development server:

    ```bash
    php artisan serve
    ```

9. Open your web browser and go to [http://localhost:8000](http://localhost:8000) to access "My Gym."

**Note:** Ensure that you have PHP, Composer, Node.js, and MySQL installed on your system before proceeding with these steps.

**Email Notification:**
To enable email notifications for members when classes are canceled by the instructor, it's essential to run the Laravel queue worker to process background jobs efficiently. Execute the following command to start the queue worker:

```bash
php artisan queue:work
```

This command ensures that the notification tasks, including sending emails to affected members, are handled in the background, providing a seamless and responsive experience for both instructors and members. Keep the queue worker running to continually process queued jobs and deliver timely notifications.

## Demo Video

Explore the core features of "My Gym" app by watching this brief 45-second [Demo Video](https://youtu.be/UrEeeNQAZBA). This video provides a quick glimpse into the application, showcasing its main functionality, user interfaces, and how both instructors and members can seamlessly interact with the platform.

Feel free to hit play and get a sneak peek into the intuitive and powerful features that "My Gym" has to offer!

## Course Overview

As part of the [Advanced Laravel Course](https://www.linkedin.com/learning/advanced-laravel-22373805), I learned:

-   Establishing project requirements and project setup.
-   Creating user roles and implementing middleware for enhanced security.
-   Implementing gates and policies to precisely control access to specific features, ensuring a secure user experience.
-   Exploring advanced Eloquent features, including many-to-many relationships, eager loading, and writing complex queries and query scopes.
-   Utilizing custom commands, events, listeners, and logs for extended functionality.
-   Understanding notifications, queueing, and scheduling in Laravel.
-   Gaining insights into Laravel's inner workings, including service containers, service providers, and Facades.

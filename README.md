# _Service Tickets_

It's a project to generate service and support tickets where you can keep track of incidents that occur in a local network or company...
the problems that can be registered are open to the needs of the company

# Features

- A dashboard with statistics of solved tickets, pending tickets and in process tickets
- Admin of the users, support users and admin users
- View of the user's tickets
- User profile view where they can update their data like name or passwords
- Admin and support view of all of the tickets and where their can be changed their status and priority and you can assign a support user to the ticket
- Admin and support view of the users registered in the system
- Ticket view with all the ticket funtionalities like write feedback messages, upload images and/or open or close the ticket if it's solved
- Show notifications of the tickets

# Technologies

- [Laravel] - Laravel 9 as backend technology 
- [Livewire] - Livewire as frontend technology
- [AlpineJS] - It's used by livewire for _UX_
- [Bootstrap] - Bootstrap v5 as responsive design framework _UI_
- [Template] - The _Soft UI Dashboard Laravel Livewire_ design template is implemented in it's free version ([live_demo]) [docs]
- [MySQL] - as database technology


# Install y Requeriments


## _requeriments_

- php ^8.0
- composer ^2.2.4 

## _install_

0. Open one terminal or cmd
1. Clone this repo with `git clone repo` command 
2. Run command `composer install`
3. Copy file `.env.example` to `.env` and update the config variables like database
4. Run `php artisan key:generate` to generate the app key
5. Run `php artisan migrate --seed` to create database and generate admin user
6. Run `php artisan storage:link` to create the storage symlink 




[Template]: <https://www.creative-tim.com/product/soft-ui-dashboard-laravel-livewire>
[live_demo]: <https://soft-ui-dashboard-laravel-livewire.creative-tim.com/login>
[docs]: <https://soft-ui-dashboard-laravel-livewire.creative-tim.com/documentation/bootstrap/overview/soft-ui-dashboard/index.html>
[Laravel]: <https://laravel.com/docs/9.x>
[Livewire]: <https://laravel-livewire.com/>
[Bootstrap]: <https://getbootstrap.com/docs/5.0/getting-started/introduction/>
[MySQL]: <https://dev.mysql.com/doc/>

[AlpineJS]: <https://alpinejs.dev/>
[JQuery]: <https://jquery.com/>
[AJAX]: <https://api.jquery.com/jquery.ajax/>
[DatatablesJS]: <https://datatables.net/>
[ChartJS]: <https://www.chartjs.org/>
[SweetAlert]: <https://sweetalert2.github.io/>










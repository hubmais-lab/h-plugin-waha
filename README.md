# H+Plugin Waha

<p>Esse plugin foi construído com o objetivo de enviar mensagens via notificação por WhatsApp utlizando o serviço do Waha.</p>
<p>Aqui vamos mostrar como é facil a instalação e utilização.</p>

## Requisitos

* php (versão 7.2 ou >=8.1)
* composer (mais recente)
* waha (instalado e configurado conforme documentação do Waha https://waha.devlike.pro/docs/overview/quick-start/)


## Instalação

O plugin pode ser adicionado a seu projeto com o comando abaixo:

```shell
composer require hubmais/h-plugin-waha
```

## Laravel

Esse plugin desenvolvido para ser usado em Laravel, a partir da versão 10.
Após a instalação é necessário executar o comando abaixo:

```shell
php artisan vendor:publish --provider="Hubmais\HPluginWaha\Providers\HPluginWahaChannelServiceProvider"
```

Depois é necessário configurar o arquivo de configuração, presente em config/h-waha.php com as credenciais fornecidas.

***

# Exemplos de uso

## Crie uma notificação

```console
php artisan make:notification InvoicePaid

```

## Configure a Notificação

```php
<?php

namespace App\Notifications;

use App\Models\Invoice;
use Hubmais\HPluginWaha\Messages\HPluginWahaMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected Invoice $invoice,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['h-waha'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toHWaha(object $notifiable): MailMessage
    {
        return (new HPluginWahaMessage)
            ->content("Hello, payment for order {$this->invoice->id} has been confirmed! Thank you for your purchase!");
    }
}

```

## Configure a Model de origem

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the HPluginWaha channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForHWaha(Notification $notification): array|string
    {
        return $this->phone_number.'@c.us';
    }
}
```

## Disparando a notificação

```php
<?php

...

$user->notify(new InvoicePaid($invoice));

...
```